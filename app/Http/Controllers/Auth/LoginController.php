<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;

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
    protected $redirectTo = '/account';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        if (isset(request()->forward)) {
          $this->redirectTo = request()->forward;
        }

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
        $user = Socialite::driver($provider)->user();
        $method = 'handle'.ucfirst($provider).'User';

        $authUser = $this->fetchProviderUser($user, $provider);

        if (!$authUser) {
            $authUser = $this->{$method}($user);
            if (!in_array($provider, ['steam'])) {
                alert()->success('Thanks for signing up! We have sent you a email with a link to verify your account');
            }
        }

        Auth::login($authUser);

        return redirect()->route('index');
    }

    public function fetchProviderUser($apiResponse, $provider)
    {
        $user = User::where('provider', $provider)->where('provider_id', $apiResponse->getId())->first();
        return $user;
    }

    public function handleFacebookUser($apiResponse)
    {
        $user = (new User)->registerUser($apiResponse->user['name'], $apiResponse->user['email'], null);
        $user->update([
            'provider' => 'facebook',
            'provider_id' => $apiResponse->getId()
        ]);
        return $user;
    }

    public function handleGoogleUser($apiResponse)
    {
        $user = (new User)->registerUser($apiResponse->getName(), $apiResponse->getEmail(), null);
        $user->update([
            'provider' => 'google',
            'provider_id' => $apiResponse->getId()
        ]);
        return $user;
    }

    public function handleTwitterUser($apiResponse)
    {
        $user = (new User)->registerUser($apiResponse->nickname, $apiResponse->email, null);
        $user->update([
            'provider' => 'twitter',
            'provider_id' => $apiResponse->getId()
        ]);
        return $user;
    }

    public function handleSteamUser($apiResponse)
    {
        $user = (new User)->registerUser($apiResponse->nickname, $apiResponse->getId(), null, [], 'steam');
        $user->update([
            'provider' => 'steam',
            'provider_id' => $apiResponse->getId()
        ]);
        return $user;
    }

    public function handleDiscordUser($apiResponse)
    {
        $user = (new User)->registerUser($apiResponse->getName(), $apiResponse->getEmail(), null);
        $user->update([
            'provider' => 'discord',
            'provider_id' => $apiResponse->getId()
        ]);
        return $user;
    }

    public function handleTwitchUser($apiResponse)
    {
        $user = (new User)->registerUser($apiResponse->getName(), $apiResponse->getEmail(), null);
        $user->update([
            'provider' => 'twitch',
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
}
