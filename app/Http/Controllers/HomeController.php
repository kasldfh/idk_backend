<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use Request;
use Route;
use DB;

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
        $code = Request::input('zip');
        $coords = DB::table('zip')->where('zip', $code)->first();
        $lat = $coords->lat;
        $lon = $coords->lon;

        return View::make('show', compact('radius', 'max_price', 'lat', 'lon', 'last_token'));
    }
}
