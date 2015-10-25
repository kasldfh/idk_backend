<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use Request;

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

        $radius = Request::input('radius');
        $max_price = Request::input('max_price');
        $lat = Request::input('lat');
        $lon = Request::input('lon');
        $last_token = Request::input('last_token');
        $min_price = 0;

        ////TODO: remove
        //$radius = 40233;
        ////selected types
        //$min_price = 1;
        //$max_price = 3;
        //$lat = "-33.8669710";
        //$lon = "151.1958750";

        //indexes we have already used
        $nums = [];
        $nums[] = -1;
        $r = -1;
        $selected = "";
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
            . '&key=AIzaSyCslER7GnUDG3C241cqQDxidKMsbuwU1VU'
            . '&pagetoken=' . $last_token);
        $http_resp = json_decode($http_q, true);
        //dd($http_resp);

        //prepare response
        
        $items = [];
        foreach($http_resp["results"] as $result) {
            $item = [];
            $item["name"] = $result["name"];
            $item["price_level"] = $result["price_level"];
            $item["rating"] = array_key_exists("rating", $result) ? 
                $result["rating"] : "";
            $item["vicinity"] = $result["vicinity"];
            $item["icon"] = $result["icon"];
            $item["types"] = $result["types"];


            if(array_key_exists("opening_hours", $result) && 
                $result["opening_hours"]["open_now"])
                $items[] = $item;
        }
        $response = [];
        $response["next_page_token"] = $http_resp["next_page_token"];
        $response["items"] = $items;


        $json_resp = json_encode($response);

        return $json_resp;
    }
}
