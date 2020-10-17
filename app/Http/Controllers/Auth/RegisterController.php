<?php

namespace App\Http\Controllers\Auth;

// use App\Events\UserRegistered;
// use Illuminate\Auth\Events\Registered;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use \DrewM\MailChimp\MailChimp;

use App\Http\Requests\Register;

class RegisterController extends Controller
{

    /**
    * Handle a registration request for the application.
    *
    * @param Register $request
    * @return \Illuminate\Http\Response
    *
    */
    public function register(Register $request)
    {

        /**
        * Check if this user already exists.
        */
        $check = User::where("email", request()->email)
            ->orWhere("username", request()->username)
            ->first();

        if ($check !== null) {
            return redirect(route("register"))
                ->withErrors([
                    "exists" => "A user with these details already exists"
                ])
                ->withInput();
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
            return redirect(route("register"))
                ->withErrors([
                    "captcha" => "ReCaptcha Error"
                ])
                ->withInput();
        }
        if ($resultJson->score < 0.3) {
                return redirect(route("register"))
                ->withErrors([
                    "captcha" => "ReCaptcha Error"
                ])
                ->withInput();
        } else {

            /**
            * Add user to database.
            */
            $user = User::create([
                "name" => request()->name,
                "email" => request()->email,
                "username" => request()->username,
                "password" => Hash::make(request()->password),
                "email_token" => base64_encode(request()->email),
                "api_token" => str_random(),
                "arn" => request()->arn,
                "current_role" => request()->current_role,
                "company_name" => request()->company_name,
                "location" => request()->location,
                "experience" => request()->experience
            ]);

            /**
             * Check marketing preferences
             *
             */
            if (request()->has("internal_marketing")) {
                Auth::loginUsingId($user->id);
                $MailChimp = new MailChimp(env('MAILCHIMP_APIKEY'));
                $mailChimpEmailCheck = $MailChimp->get('lists/'.env('MAILCHIMP_LISTID').'/members/'.request()->email);
            
                //subscribe user to mailchimp newsletter
                if($mailChimpEmailCheck['status']===404){
                    $result = $MailChimp->post("lists/".env('MAILCHIMP_LISTID')."/members", [
                        'email_address' => request()->email,
                        'status'        => 'subscribed',
                    ]);
                }
                $user->update([
                    "internal_marketing" => true
                ]);
            }

            if (request()->has("external_marketing")) {
                $user->update([
                    "external_marketing" => true
                ]);
            }

            

            /**
             * Redirect user and show a popup confirmation registration
             *
             */
            return redirect('/')->with([
                "alert" => true,
                "alert_title" => "Success",
                "alert_message" => "Your account has been created!",
                "alert_button" => "OK",
                "new_user" => true
            ]);
        }
    }

    public function showRegistrationForm()
    {
        return view("auth.register");
    }

    /**
     * Handle a registration request for the application.
     *
     * @param $token
     *
     * @return \Illuminate\Http\Response
     */
    public function verify($token)
    {
        $user = User::where('email_token', $token)->first();

        $user->verified = 1;
        $user->email_token = null;

        if ($user->save()) {
            Auth::login($user, true);
            alert()
                ->success('Thanks for confirming your email address. You are now logged in.')
                ->persistent();

            return redirect(route('index'));
        }
    }
}
