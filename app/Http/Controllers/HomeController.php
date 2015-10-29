<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use Request;
use Route;

class HomeController extends Controller
{
    /**
     * Show the input page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('entry');
    }

    /**
     * show the results for given location
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $radius = Request::input('radius');
        $max_price = Request::input('max_price');
        $zip = Request::input('zip');
        $last_token = Request::input('last_token');

        //get lat and long for the zip code
        //TODO: if we get from db directly it is more efficient
        $request = Request::create('zip/', 'POST', ['zip' => $zip]);
        $response = Route::dispatch($request)->getContent();
        $coords = json_decode($response, true);

        $lat = $coords['lat'];
        $lon = $coords['lon'];

        return View::make('show', compact('radius', 'max_price', 'lat', 'lon', 'last_token'));
    }
}
