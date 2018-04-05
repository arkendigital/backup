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
        return redirect(route("index"))
      ->with([
        "alert" => true,
        "alert_title" => "Success",
        "alert_message" => "Your message has been sent to us",
        "alert_button" => "OK"
      ]);
    }
}
