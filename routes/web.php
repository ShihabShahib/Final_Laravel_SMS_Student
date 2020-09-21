<?php

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
Route::get('/','LoginController@land')->name('landing');
Route::get('/login','LoginController@index')->name('login');
Route::post('/login',['uses'=>'LoginController@varify'] );
Route::get('/logout','LogoutController@index');


Route::middleware(['sess'])->group(function(){
	Route::group(['middleware'=>['studenttype']], function(){
		Route::get('/student/stdash','StudentController@stdash')->name('student.stdash');
		Route::get('/student/teacher','StudentController@teacher')->name('student.teacher');
		Route::post('/student/teachersearch', 'studentController@teachersearch')->name('student.search');
		Route::get('/student/routine','StudentController@routine')->name('student.routine');
		Route::get('/student/subject','StudentController@subject')->name('student.subject');
		Route::get('/student/syllabus','StudentController@syllabus')->name('student.syllabus');
		Route::get('/student/notes','StudentController@notes')->name('student.notes');
		Route::get('/student/assignment','StudentController@assignment')->name('student.assignment');
		Route::post('/student/upload/{id}', 'StudentController@upload');
		Route::get('/student/generatepdf','StudentController@generatepdf')->name('student.generatepdf');
		Route::get('/student/found','StudentController@found')->name('student.found');
		Route::get('/student/stprofile','StudentController@stprofile')->name('student.stprofile');
		Route::get('/student/updateprofile','StudentController@updateprofile')->name('student.updateprofile');
		Route::post('/student/updateprofile',['uses'=>'StudentController@saveprofile'] );
    });
});