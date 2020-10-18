<?php

namespace App\Http\Controllers\Contact;

/**
* Load modules.
*/
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendContactEmail;

/**
* Load requests.
*/
use App\Http\Requests\Contact as ContactRequest;

/**
* Load models.
*/
use App\Models\Page;

class ContactController extends Controller
{

  /**
  * Show contact page to user.
  *
  */
    public function index()
    {
        return view("contact.index");
    }

    /**
    * Handles submission of the contact form.
    *
    * @param ContactRequest $request
    *
    */
    public function submit(ContactRequest $request)
    {
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
            return redirect(route("contact"))
                ->withErrors([
                    "captcha" => "ReCaptcha Error"
                ])
                ->withInput();
        }
        if ($resultJson->score < 0.3) {
                return redirect(route("contact"))
                ->withErrors([
                    "captcha" => "ReCaptcha Error"
                ])
                ->withInput();
        } else {
        /**
        * Build contact object.
        *
        */
            $contact_submission = collect();
            $contact_submission->first_name = request()->first_name;
            $contact_submission->second_name = request()->second_name;
            $contact_submission->email = request()->email;
            $contact_submission->phone = request()->phone;
            $contact_submission->comment = request()->comment;

            /**
            * Initiate the send contact email job.
            *
            */
            dispatch(new SendContactEmail($contact_submission));

            /**
            * Redirect user.
            *
            */
            return redirect(route("index"))->with([
                "alert" => true,
                "alert_title" => "Success",
                "alert_message" => "Your message has been sent to us",
                "alert_button" => "OK"
            ]);
        }
    }
}
