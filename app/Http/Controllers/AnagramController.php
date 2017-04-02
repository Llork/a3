<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnagramController extends Controller
{

    /**
    * GET
    * /
    */
    public function index() {
        return view('anagrams.home');
    }    



} // end of AnagramController
