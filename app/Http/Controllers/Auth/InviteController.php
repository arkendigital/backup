<?php

namespace App\Http\Controllers\Auth;

use Doorman;
use App\User;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

class InviteController extends Controller
{

    /**
     * Check an invite code is valid and display a registration form
     *
     * @return Illuminate\View\View
     */
    public function check(Request $request)
    {
        $this->seo()->setTitle('Example is Coming Soon');

        $check = Doorman::check($request->invite_code, $request->email);
        if (!$check) {
            alert()->error('Invalid Code. Please try again');
            return back();
        }

        session(['invite_code' => $request->invite_code, 'email' => $request->email]);

        alert()->success('Woohoo! You have been invited to the closed beta of Example.com');
        return view('invites.register');
    }

    /**
     * Register the invited user
     *
     * @return Illuminate\Http\Response
     */
    public function registerInvitedUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',
            'terms_accept' => 'required'
        ]);

        try {
            $user = (new User)->registerUser($request->name, $request->email, $request->password, [], 'gf_beta');
            event(new Registered($user));
            event(new UserRegistered($user));

            Doorman::redeem(session()->get('invite_code'), session()->get('email'));

            alert()
                ->info("Thanks for registering. We've just sent you an email with a link which you need to click in order to activate your account.")
                ->persistent();
            return redirect(route('index'));
        } catch (DoormanException $e) {
            alert()->error($e->getMessage);
            return redirect(route('index'));
        }
    }
}
