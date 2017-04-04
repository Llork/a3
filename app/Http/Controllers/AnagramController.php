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

    /*  I ran into these issues regarding validation:
        - Needed validation rule of "input must be alpha or spaces".  Laravel's alpha rule doesn't allow spaces, so I couldn't use that.
        - Needed better control over what form fields persist after validation success or failure.
        - Found that main processing was executing even when validation flagged an error.
        To address these issues I created a custom validation rule (https://laravel.com/docs/5.4/validation#custom-validation-rules) *and also* a manually created validator (https://laravel.com/docs/5.4/validation#manually-creating-validators).
        In addition to the DWA-15 course materials, Piazza discussions and the Laravel doc, credit to the following:
        http://stackoverflow.com/questions/34099777/laravel-5-1-validation-rule-alpha-cannot-take-whitespace (credit to Chris Landeza)
        https://www.webniraj.com/2016/02/19/laravel-5-x-custom-validation-rules/
        http://blog.elenakolevska.com/laravel-alpha-validator-that-allows-spaces/

        In addition to this controller file and the view/template files, I modified these files in order to implement the custom validation:
        app/Providers/AppServiceProvider.php
        resources/lang/en/validation.php
    */
    public function rearrange(Request $request) {

        /* Validate the input.  Word or phrase to anagram is a required field, and must
           contain only letters and spaces.  Due to the nature of the anagram interface,
           I intentionally persist display of the user-entered word or phrase to anagram
           in all cases: both when validation succeeds and when it fails.
        */
        $validator = Validator::make($request->all(), [
            'wordOrPhraseToAnagram' => 'required|alpha_space',
        ]);

        if (null !== ($request->input('submit'))) {
            if ($validator->fails()) {
                return view('anagrams.rearrange')
                    ->withErrors($validator)
                    ->with([
                        'wordOrPhraseToAnagram' => $request->input('wordOrPhraseToAnagram', null),
                        'toLowerCase' => null,
                        'toUpperCase' => null,
                        'keepCase' => 'checked',
                        'removeBlanks' => null,
                        'outputString' => null
                        ]);
            }
        }

        /* Get phrase to anagram from user input. */
        $wordOrPhraseToAnagram = $request->input('wordOrPhraseToAnagram', null);

        /* If the user entered a phrase to be anagrammed, generated output where
           the letters have been shuffled.  If the user did not enter a phrase to be
           anagrammed, set the output to null.
        */
        if ($wordOrPhraseToAnagram) {
            $arrayOfInputString = str_split($wordOrPhraseToAnagram); // convert input to an array
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
            'wordOrPhraseToAnagram' => $wordOrPhraseToAnagram,
            'toLowerCase' => $toLowerCase,
            'toUpperCase' => $toUpperCase,
            'keepCase' => $keepCase,
            'removeBlanks' => $removeBlanks,
            'outputString' => $outputString
        ]);

    } // end of rearrange function



} // end of AnagramController
