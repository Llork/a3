<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator; // added this

class AnagramController extends Controller
{

    /**
    * GET
    * /
    */
    public function rearrange(Request $request) {

        $validator = Validator::make($request->all(), [
            'phraseToAnagram' => 'required|alpha_space',
        ]);

        if (null !== ($request->input('submit'))) {
            if ($validator->fails()) {
                return view('anagrams.rearrange')
                    ->withErrors($validator)
                    ->with([
                        'phraseToAnagram' => $request->input('phraseToAnagram', null),
                        'toLowerCase' => null,
                        'toUpperCase' => null,
                        'keepCase' => 'checked',
                        'removeBlanks' => null,
                        'outputString' => null
                        ]);
            }
        }

        /* Get phrase to anagram from user input. */
        $phraseToAnagram = $request->input('phraseToAnagram', null);

        /* If the user entered a phrase to be anagrammed, generated output where
           the letters have been shuffled.  If the user did not enter a phrase to be
           anagrammed, set the output to null.
        */
        if ($phraseToAnagram) {
            $arrayOfInputString = str_split($phraseToAnagram); // convert input to an array
            shuffle($arrayOfInputString); // shuffle the array, thus creating an anagram
            $outputString = implode($arrayOfInputString); // convert array back to a string
        }
        else {
            $outputString = null;
        }

        /* If the output string has content, modify to upper or lower case if this
           was requested by the user.
        */
        if ($outputString != null) {
            // Convert case or leave case as is, depending on what user chose:
            if($request->input('case')=='lower') { // change to lower case
                $outputString = strtolower($outputString);
                $toLowerCase='checked';
                $toUpperCase=null;
                $keepCase=null;
            }
            else if($request->input('case')=='upper') { // change to upper case
                $outputString = strtoupper($outputString);
                $toLowerCase=null;
                $toUpperCase='checked';
                $keepCase=null;
            }
            else if($request->input('case')=='keep') { // keep case as is
                $toLowerCase=null;
                $toUpperCase=null;
                $keepCase='checked';
            }
            else { // this else should never run, but is here 'just in case'
                $toLowerCase=null;
                $toUpperCase=null;
                $keepCase='checked';
            }
        }
        else { // this will execute if there's nothing to anagram
            $toLowerCase=null;
            $toUpperCase=null;
            $keepCase='checked';
        }

        /* If the output string has content, remove blanks if this was
           requested by the user.
        */
        if ($outputString != null) {
            if ($request->input('removeBlanks')=='yes') {
                $outputString = str_replace(' ', '', $outputString);
                $removeBlanks='checked';
            }
            else {
                $removeBlanks=null;
            }
        }
        else {
            $removeBlanks=null;
        }

        /* If the output string has content, append 'Anagram: ' to the front. */
        if ($outputString != null) {
            $outputString = 'Anagram: ' . $outputString;
        }

        /* Pass appropriate data to the view. */
        return view('anagrams.rearrange')->with([
            'phraseToAnagram' => $phraseToAnagram,
            'toLowerCase' => $toLowerCase,
            'toUpperCase' => $toUpperCase,
            'keepCase' => $keepCase,
            'removeBlanks' => $removeBlanks,
            'outputString' => $outputString
        ]);

    } // end of rearrange function



} // end of AnagramController
