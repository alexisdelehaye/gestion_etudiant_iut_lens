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
    return view('index');
});


Route::get('testEtudiant', 'EtudiantController@test');


Route::get('testCreationExcelNotesAuBonneEndroit', 'GenerationDocumentController@createAllMarksFile');

Route::get('testMiseAjourNotesEtudiant','NoteController@test');


Route::get('testCréationArborescence','EtudiantController@CreationArborescenceGenerale');

Route::get('testCréationNotesDansBonRépertoire','GenerationDocumentController@test');// création excel des matieres dans les dossiers voulues selon le semestre demandé


Route::get('testJsonEtudiant','jsonController@testCorrectionClassementUe'); //export en json des notes (moyennes des étudiants) , moyennes de leurs ues, semestres et dut (1 et 2), ainsi que la liste des étudiants

Route::get("initialisationDonnées",'initializationController@test');//initialization (insertion de tous les étudiants et matières présents dans les dossiers admin correspondant)

Route::get('testClassementEtudiant','jsonController@testClassementDUT');


