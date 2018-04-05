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
        "api_token" => str_random()
      ]);

        Auth::loginUsingId($user->id);

        /**
        * Redirect user to account.
        */
        return redirect(route("account.index"));
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
