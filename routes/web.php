<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/user/{name?}', function (?string $name = "guest") {
    return "Welcome to this route, ".$name.".";
});


Route::post('/submit', function () {
    return "Form has been successfully submitted";
});


Route::match(['get', 'post'], '/method', function (){
    if (request()->isMethod('get')) {
        return "You are using the GET method in this route right now";
    }
    elseif (request()->isMethod('post')) {
        return "You are using the POST method in this route right now";
    }
    else {
        abort(405); // Returns a 405 Method Not Allowed response for other methods
    }
});


Route::get('/number/{number}', function ($number) {
    if (is_numeric($number)) {
        // $number contains only numbers
        return "The number you put on the parameter was: $number";
    }
    else {
        abort(404); // Return a 404 Not Found response for invalid numbers
    }
})->where('number', '[0-9]+');


Route::get('/alphanumeric/{letters}/{numbers}', function ($letters, $numbers) {
    // Check if $letters consists of only alphabetic characters (letters)
    // and check if $numbers consists of only numbers:
    if (ctype_alpha($letters) && ctype_digit($numbers)){
        // Both parameters meet the criteria
        return "Letters used in the parameter: $letters<br>Numbers used in the parameter: $numbers";
    }

    abort(404); // Return a 404 Not Found response for invalid parameters
})->where(['letters' => '[A-Za-z]+', 'numbers' => '[0-9]+']);


Route::get('/host', function (){
    return "The IP used to store the database is: ".env('DB_HOST');
});

Route::get('/timezone', function (){
    return "Your current timezone: ".config("app.timezone");
});

Route::view("/home", "home");

/*
Route::get("/date", function (){
    return view("date", ["day" => date("d"), "month" => date("m"), "year" => date("Y")]);
});
*/

Route::get("/date", function () {
    $day = date("d");
    $month = date("m");
    $year = date("Y");

    return view("date", compact('day', 'month', 'year'));
});
