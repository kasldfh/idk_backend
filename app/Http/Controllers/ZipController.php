<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use DB;


class ZipController extends Controller
{
    /**
     * Return zip object in json 
     */
    public function index()
    {
        $code = Request::input('zip');
        $zip = DB::table('zip')->where('zip', $code)->first();
        $json = json_encode($zip);
        return $json;
    }

}
