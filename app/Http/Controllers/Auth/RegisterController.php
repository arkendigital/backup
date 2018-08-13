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
            $user->update([
                "internal_marketing" => true
            ]);
        }

        if (request()->has("external_marketing")) {
            $user->update([
                "external_marketing" => true
            ]);
        }

        Auth::loginUsingId($user->id);

        /**
         * Redirect user and show a popup confirmation registration
         *
         */
        return redirect(route("front.discussion.index"))->with([
            "alert" => true,
            "alert_title" => "Success",
            "alert_message" => "Your account has been created!",
            "alert_button" => "OK"
        ]);
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
