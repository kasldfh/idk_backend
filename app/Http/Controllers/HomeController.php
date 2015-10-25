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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('entry');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
        $radius = Request::input('radius');
        $max_price = Request::input('max_price');
        $lat = Request::input('lat');
        $lon = Request::input('lon');
        $last_token = Request::input('last_token');

        //$params = [
        //    'radius' => $radius,
        //    'max_price' => $max_price,
        //    'lat' => $lat,
        //    'lon' => $lon,
        //    'last_token' => $last_token
        //];
        //dd($params);
        //$request = Request::create('api/', 'POST', $params);
    
        return View::make('show', compact('radius', 'max_price', 'lat', 'lon', 'last_token'));
    }

}
