<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = [
            "amusement_park",
            "aquarium",
            "art_gallery",
            "bakery",
            "bar",
            "book_store",
            "bowling_alley",
            "cafe",
            "campground",
            "casino",
            "clothing_store",
            "establishment",
            "food",
            "gym",
            "library",
            "meal_delivery",
            "meal_takeaway",
            "movie_theater",
            "museum",
            "night_club",
            "park",
            "restaurant",
            "spa",
            "zoo"
        ];
        $radius = 40233;
        //selected types
        $selected = "";
        $min_price = 1;
        $max_price = 3;
        $lat = "-33.8669710";
        $lon = "151.1958750";
        //indexes we have already used
        $nums = [];
        $nums[] = -1;
        $r = -1;
        for($i = 0; $i < 5; $i++) {
            while(in_array($r, $nums)) {
                $r = rand(0, sizeof($types)-1);
            }
            $nums[] = $r;
            $selected .= $types[$r] . "|";
        }
        $selected = substr($selected, 0, strlen($selected)-1);

        $http_q = file_get_contents('https://maps.googleapis.com/maps/api/'
            . 'place/nearbysearch/json?'
            . 'location=' . $lat . ',' . $lon 
            . '&radius=' . $radius 
            . '&types=' . $selected  
            . '&minprice=' . $min_price
            . '&maxprice=' . $max_price 
            . '&key=AIzaSyCslER7GnUDG3C241cqQDxidKMsbuwU1VU');
        $http_q = json_decode($http_resp);
        
        //$response = [];
        //$response["name"] = 


        dd($response);

        return $response;
        //$response = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8669710,151.1958750&key=AIzaSyCslER7GnUDG3C241cqQDxidKMsbuwU1VU');
        //return View::make('welcome', ['response' => $response]);
        return View::make('welcome', compact('response'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
