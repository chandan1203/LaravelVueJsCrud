<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('save-student', 'StudentController@SaveStudent');
Route::get('all-students', 'StudentController@AllStudents');
Route::get('edit-student/{id}', 'StudentController@EditStudent');
Route::put('update-student', 'StudentController@UpdateStudent');
Route::delete('delete-student/{id}', 'StudentController@DeleteStudent');
