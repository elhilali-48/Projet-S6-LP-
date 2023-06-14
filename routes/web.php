<?php

use App\Mail\Confirmaion_mail;

use App\Mail\OrderShipped;


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
Route::get('/home', 'Dashbord_Controller@index')->name('home')->middleware('auth');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/email', function () {
    return new OrderShipped();
});

Route::get('/confirmation', function () {
    return view('confirmation/index');
});
Route::post('confirmation/show','ConfirmationController@show' )->name('etudiant.show');

Route::match(['get', 'post'],'centre/{id}/examen','confirmationController@examen')->name('centre.examen');


// Route::get('confirmation/{id}', 'ConfirmationController@show')->name('confirmation'); 

Route::get('confirmation/affiche/{id}',function(){
    return view('confirmation.affiche');
})->name('confirmation');

Route::post('confirmation/{id}', 'ConfirmationController@update')->name('etudiant.confirm');
Auth::routes();

Route::resource('/etudiantt', 'EtudiantController')->middleware('auth');

Route::get('etudiants/economie','Dashbord_Controller@economie')->name('etudiants.economie')->middleware('auth');

Route::get('etudiants/economie/search','Dashbord_Controller@search_eco')->name('economie.search')->middleware('auth');

Route::get('etudiants/economie/filter','Dashbord_Controller@filter')->name('economie.filter')->middleware('auth');

Route::get('etudiants/droit','Dashbord_Controller@droit')->name('etudiants.droit')->middleware('auth');

Route::get('etudiants/droit/filter','Dashbord_Controller@filter_droit')->name('droit.filter')->middleware('auth');

Route::get('etudiants/droit/search','Dashbord_Controller@search_droit')->name('droit.search')->middleware('auth');

Route::put('etudiant/{id}/confirm', 'Economie_Controller@confirm')->name('etudiant.confirmation')->middleware('auth');

Route::get('etudiant/{id}/affiche', 'Dashbord_Controller@affiche')->name('etudiant.affiche')->middleware('auth');

Route::put('etudiant/{id}/rappel','Dashbord_Controller@rappel')->name('etudiant.rappel')->middleware('auth');

Route::get('etudiants/rappel_all','Dashbord_Controller@rappelall')->name('rappel.all')->middleware('auth');

Route::get('economie/semestre2','Economie_Controller@semestre2')->name('economie.semestre2')->middleware('auth');

Route::get('economie/semestre4','Economie_Controller@semestre4')->name('economie.semestre4')->middleware('auth');

Route::get('economie/semestre6','Economie_Controller@semestre6')->name('economie.semestre6')->middleware('auth');

Route::get('droit/semestre2','Droit_Controller@semestre2')->name('droit.semestre2')->middleware('auth');

Route::get('droit/semestre4','Droit_Controller@semestre4')->name('droit.semestre4')->middleware('auth');
 
Route::get('droit/semestre6','Droit_Controller@semestre6')->name('droit.semestre6')->middleware('auth');

Route::get('users/{user}/profile', 'User_Controller@edit')->name('users.edit')->middleware('auth');

Route::post('users/{user}/profile', 'User_Controller@update')->name('users.update')->middleware('auth');

Route::get('users/{user}/change', 'User_Controller@mdp')->name('users.change')->middleware('auth');

Route::post('users/{user}/update', 'User_Controller@change_mdp')->name('users.change_mdp')->middleware('auth');

// Route::get('users/index', 'User_Controller@index')->name('users.index')->middleware('auth');
// Route::post('users/{user}/make', 'User_Controller@make_admin')->name('users.make')->middleware('auth');

Route::get('/eco/pdf','Economie_Controller@eco_pdf')->middleware('auth');

Route::get('exportation',"Exportation_Controller@export")->middleware('auth')->name("export.index");

Route::get('export/pdf',"Exportation_Controller@export_all")->middleware('auth')->name("export.pdf");

Route::get('confirmation/{id}/pdf',"ConfirmationController@confirmation")->name("confirmation.pdf");

// Route::get('/trashed-post', 'EtudiantController@trashed')->name('trashed.index')->middleware('auth');

// Route::get('/restaure', 'EtudiantController@restoreall')->name('trashed.restoreall')->middleware('auth');

// Route::get('/trashed-post/{id}', 'EtudiantController@restore')->name('trashed.restore')->middleware('auth');

Route::middleware(['auth','verifyisadmin'])->group(function (){
    Route::get('users/index', 'User_Controller@index')->name('users.index');
    Route::post('users/{user}/make', 'User_Controller@make_admin')->name('users.make');
    Route::delete('users/{user}/delete', 'User_Controller@delete')->name('users.delete');
    Route::get('/trashed-post/{id}', 'EtudiantController@restore')->name('trashed.restore');
    Route::get('/restaure', 'EtudiantController@restoreall')->name('trashed.restoreall');
    Route::get('/trashed-post', 'EtudiantController@trashed')->name('trashed.index');
   });










// Route::get('economie/semestre2/sectionA','Economie_Controller@S2_SectionA')->name('semestre2.sectionA')->middleware('auth');
// Route::get('economie/semestre2/sectionB','Economie_Controller@S2_SectionB')->name('semestre2.sectionB')->middleware('auth');
// Route::get('economie/semestre2/sectionC','Economie_Controller@S2_SectionC')->name('semestre2.sectionC')->middleware('auth');

