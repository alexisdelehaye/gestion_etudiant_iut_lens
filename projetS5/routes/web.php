<?php

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


Route::get('users', function()
{
    return 'Users!';
});


Route::get('testEtudiant', 'EtudiantController@insertStudiantInDatabase');


Route::get('testMatiere', 'MatiereController@creationMatieresDansDatabase');

Route::get('testCreationExcelNotes', 'GenerationDocumentController@creationFicheNotesPourToutesLesMatieres');

Route::get('testMiseAjourNotesEtudiant','NoteController@miseAjourNotesEtudiants');