<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller {

  /**
  * Get the location of a postcode
  */
  public static function fromPostcode($postcode) {

    /**
    * Initialize Guzzle client.
    */
    $client = new \GuzzleHttp\Client();

    /**
    * Send the request.
    */
    $request = $client->request('GET', 'https://api.postcodes.io/postcodes/'.$postcode);

    /**
    * Parse the response.
    */
    $response = json_decode($request->getBody());

    /**
    * Send it back.
    */
    $response = $response->result;

    return $response;

  }

}
