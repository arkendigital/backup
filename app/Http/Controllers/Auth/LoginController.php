<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use App\Setting;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $redirect = Setting::where('key', 'user_redirect')->first();
        $this->redirectTo = $redirect->value;
        /*
         * This has been removed for now as they want ALL LOGINS to redirect to the discussion page
         *
            if (isset(request()->forward)) {
                $this->redirectTo = request()->forward;
            }
        */
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        $url = config('services.recaptcha.verify_url');
        $remoteip = $_SERVER['REMOTE_ADDR'];


        $data = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->get('recaptcha'),
            'remoteip' => $remoteip
        ];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);


        if ($resultJson->success !== true) {
            return redirect(route("login"))
                ->withErrors([
                    "captcha" => "ReCaptcha Error"
                ])
                ->withInput();
        }
        if ($resultJson->score < 0.3) {
                return redirect(route("login"))
                ->withErrors([
                    "captcha" => "ReCaptcha Error"
                ])
                ->withInput();
        } else {
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Redirect the user to the providers authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from providers.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $method = 'handle'.ucfirst($provider).'User';

            $authUser = $this->fetchProviderUser($user, $provider);

            if (!$authUser) {
                $authUser = $this->{$method}($user);
                if (!in_array($provider, ['steam'])) {
                    // alert()->success('Thanks for signing up! We have sent you a email with a link to verify your account');
                }
            }

            Auth::login($authUser);

            return redirect()->route('index');
        } catch (\Exception $e) {
            return redirect(route("register"));
        }
    }

    public function fetchProviderUser($apiResponse, $provider)
    {
        $user = User::where('provider', $provider)->where('provider_id', $apiResponse->getId())->first();
        return $user;
    }

    /**
    * Facebook login / registration.
    *
    * @param $apiResponse
    *
    */
    public function handleFacebookUser($apiResponse)
    {

        /**
        * Lets check if there is a user already with this email address.
        *
        */
        $user = User::where("email", $apiResponse->user["email"])
            ->first();

        /**
        * No user registered, register them.
        *
        */
        if ($user === null) {

            /**
            * Assign them a username from their Facebook name.
            */
            $username = str_slug($apiResponse->user["name"]);

            /**
            * Now lets check if this generated username already exists,
            * if it does we lets append the username with a unique date string which they can change later.
            *
            */
            $usernameCheck = User::where("username", $username)
                ->first();

            if ($usernameCheck !== null) {
                $username = $username.microtime();
            }

            /**
            * Now we can create ourselfs a user.
            *
            */
            $user = User::create([
                "name" => $apiResponse->user["name"],
                "email" => $apiResponse->user["email"],
                "username" => $username,
                "password" => Hash::make(rand(0, 999999)),
                "email_token" => base64_encode($apiResponse->user["email"]),
                "api_token" => str_random(60)
            ]);

            /**
            * Finally lets add their Facebook avatar as their Actuaries Account avatar.
            *
            */
            if (isset($apiResponse->avatar_original) && $apiResponse->avatar_original != "") {
                $image = \Image::make($apiResponse->avatar_original)->stream();

                $uuid = Uuid::generate()->string;

                $path = "/user/".$uuid.".png";

                $s3 = \Storage::disk('s3');

                $s3->delete($user->avatar_path);

                $s3->getDriver()->put($path, $image->__toString(), ["visibility" => "public", "Expires" => gmdate('D, d M Y H:i:s \G\M\T', time() + (60000 * 60000))]);

                $user->update([
          "avatar_path" => $path
        ]);
            }
        }

        /**
        * Set provider and provider id for user.
        *
        */
        $user->update([
            'provider' => 'facebook',
            'provider_id' => $apiResponse->getId()
        ]);

        return $user;
    }

    public function handleTwitterUser($apiResponse)
    {

        /**
        * Lets check if there is a user already with this email address.
        *
        */
        $user = User::where("email", $apiResponse->email)
            ->first();

        /**
        * No user registered, register them.
        *
        */
        if ($user === null) {

            /**
            * Take their twitter username so we can use it as their Actuaries username.
            */
            $username = str_slug($apiResponse->nickname);

            /**
            * Now lets check if this generated username already exists,
            * if it does we lets append the username with a unique date string which they can change later.
            *
            */
            $usernameCheck = User::where("username", $username)
                ->first();

            if ($usernameCheck !== null) {
                $username = $username.microtime();
            }

            /**
            * Now we can create ourselfs a user.
            *
            */
            $user = User::create([
                "name" => $apiResponse->name,
                "email" => $apiResponse->email,
                "username" => $username,
                "password" => Hash::make(rand(0, 999999)),
                "email_token" => base64_encode($apiResponse->email),
                "api_token" => str_random(60)
            ]);

            /**
            * Finally lets add their Facebook avatar as their Actuaries Account avatar.
            *
            */
            if (isset($apiResponse->avatar_original) && $apiResponse->avatar_original != "") {
                $image = \Image::make($apiResponse->avatar_original)->stream();

                $uuid = Uuid::generate()->string;

                $path = "/user/".$uuid.".png";

                $s3 = \Storage::disk('s3');

                $s3->delete($user->avatar_path);

                $s3->getDriver()->put($path, $image->__toString(), ["visibility" => "public", "Expires" => gmdate('D, d M Y H:i:s \G\M\T', time() + (60000 * 60000))]);

                $user->update([
                    "avatar_path" => $path
                ]);
            }
        }


        $user->update([
            'provider' => 'twitter',
            'provider_id' => $apiResponse->getId()
        ]);

        return $user;
    }

    public function handleLiveUser($apiResponse)
    {
        $user = (new User)->registerUser($apiResponse->getName(), $apiResponse->getEmail(), null);
        $user->update([
          'provider' => 'live',
          'provider_id' => $apiResponse->getId()
      ]);
        return $user;
    }










    public function handleLinkedInUser($apiResponse)
    {

        /**
        * Lets check if there is a user already with this email address.
        *
        */
        $user = User::where("email", $apiResponse->email)
            ->first();

        /**
        * No user registered, register them.
        *
        */
        if ($user === null) {

            /**
            * Take their linkedin name so we can use it as their Actuaries username.
            */
            $username = str_slug($apiResponse->name);

            /**
            * Now lets check if this generated username already exists,
            * if it does we lets append the username with a unique date string which they can change later.
            *
            */
            $usernameCheck = User::where("username", $username)
                ->first();

            if ($usernameCheck !== null) {
                $username = $username.microtime();
            }

            /**
            * Now we can create ourselfs a user.
            *
            */
            $user = User::create([
                "name" => $apiResponse->name,
                "email" => $apiResponse->email,
                "username" => $username,
                "password" => Hash::make(rand(0, 999999)),
                "email_token" => base64_encode($apiResponse->email),
                "api_token" => str_random(60)
            ]);

            /**
            * Finally lets add their Facebook avatar as their Actuaries Account avatar.
            *
            */
            if (isset($apiResponse->avatar_original) && $apiResponse->avatar_original != "") {
                $image = \Image::make($apiResponse->avatar_original)->stream();

                $uuid = Uuid::generate()->string;

                $path = "/user/".$uuid.".png";

                $s3 = \Storage::disk('s3');

                $s3->delete($user->avatar_path);

                $s3->getDriver()->put($path, $image->__toString(), ["visibility" => "public", "Expires" => gmdate('D, d M Y H:i:s \G\M\T', time() + (60000 * 60000))]);

                $user->update([
                    "avatar_path" => $path
                ]);
            }
        }


        $user->update([
            'provider' => 'linkedin',
            'provider_id' => $apiResponse->getId()
        ]);

        return $user;
    }
}
