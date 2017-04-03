@extends('layouts.master')

@section('title')
	Anagram Generator
@endsection

@section('content')
    <h2>Anagram Generator</h2>
    <p>Click the submit button as often as you'd like, to see different ways to rearrange the letters.</p>

    <form method="GET" action="index.php">
        <label for='phraseToAnagram'>Word or phrase to anagram (required):</label>
        <input type='text' size="50" name='phraseToAnagram' id='phraseToAnagram' value='{{ $phraseToAnagram or '' }}'><br><br>
        <fieldset class='radios'>
            <legend>Case</legend>
            <label><input type='radio' name='case' value='lower' {{ $toLowerCase }} > Convert to lower case &#160;&#160;</label>
            <label><input type='radio' name='case' value='upper' {{ $toUpperCase }} > Convert to upper case &#160;&#160;</label>
            <label><input type='radio' name='case' value='keep' {{ $keepCase }} > Leave as is</label>
        </fieldset><br>
        <label><input type='checkbox' name='removeBlanks' value='yes' {{ $removeBlanks }} > Remove blanks from output</label><br><br>
        <input type="submit"><br><br>
    </form>
@endsection

@section('content2')
    {{ $outputString }}
@endsection
