<?php

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home',["title" => "Home"]);
});
Route::get('/data', [UserController::class, 'index']);
Route::get('/register', function () {
    return view('login',["title" => "Register"]);
});
Route::get('/{name}', function ($name) {
    if(View::exists($name))
    {
        return view($name,["title" => ucfirst($name)]);
    }else{
        return abort(404);
    }
});

// Route::get('/services', function () {
//     return view('services',["title" => "Services"]);
// });
// Route::get('/about', function () {
//     return view('about',["title" => "About"]);
// });
// Route::get('/about', function () {
//     return view('about',["title" => "About"]);
// });
// Route::get('/about', function () {
//     return view('about',["title" => "About"]);
// });
// Route::get('/blog', function () {
//     return "Halaman Blog";
// });
