<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnagramController extends Controller
{

    /**
    * GET
    * /
    */
    public function index(Request $request) {        

        $phraseToAnagram = $request->input('phraseToAnagram', null);

        if ($phraseToAnagram) {
            $arrayOfInputString = str_split($phraseToAnagram);
            // $arrayOfInputString = str_split($sanitizedPhrase);  convert input to an array
            shuffle($arrayOfInputString); // shuffle the array, thus creating an anagram
            $outputString = 'Anagram: ' . implode($arrayOfInputString); // convert array back to a string
        }
        else {
            $outputString = '(no output)';
        }

        // Convert case or leave case as is, depending on what user chose:
        if($request->input('case')=='lower') {
            //$outputString = strtolower($outputString);
            $toLowerCase='checked';
            $toUpperCase=null;
            $keepCase=null;
        }
        else if($request->input('case')=='upper') {
            //$outputString = strtoupper($outputString);
            $toLowerCase=null;
            $toUpperCase='checked';
            $keepCase=null;
        }
        else if($request->input('case')=='keep') { // keep case as is
            $toLowerCase=null;
            $toUpperCase=null;
            $keepCase='checked';
        }
        else { // this part of else will execute the first time code is run
            $toLowerCase=null;
            $toUpperCase=null;
            $keepCase='checked';
        }

        if ($request->input('removeBlanks')=='yes') {
            $removeBlanks='checked';
        }
        else {
            $removeBlanks=null;
        }

        return view('anagrams.home')->with([
            'phraseToAnagram' => $phraseToAnagram,
            'toLowerCase' => $toLowerCase,
            'toUpperCase' => $toUpperCase,
            'keepCase' => $keepCase,
            'removeBlanks' => $removeBlanks,
            'outputString' => $outputString
        ]);


    }



} // end of AnagramController
