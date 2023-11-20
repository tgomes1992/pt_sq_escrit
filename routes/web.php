<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\ListFundos;

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
    return view('home');
});



// Route::get("/listfundos" , function() {
//     return ListFundos::ListFundosJcot();
// });




Route::get("/listfundos" , function() {
    $fundos = ListFundos::ListFundosJcot();
    return view('list_fundos' ,  compact('fundos'));
})->name('fundos_jcot');



