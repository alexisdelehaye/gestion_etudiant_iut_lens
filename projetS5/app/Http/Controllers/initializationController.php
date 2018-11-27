<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

    class initializationController extends Controller
{
    public static function initializationMatieres($year) {
        $AnneeCourante = $year.'-'.($year+1);
        $pathFile = public_path().DIRECTORY_SEPARATOR."INFO".DIRECTORY_SEPARATOR.$AnneeCourante.DIRECTORY_SEPARATOR."ADMIN".
            DIRECTORY_SEPARATOR."MATIERES";

        $matieresFiles = scandir($pathFile);
        for($i=2;$i<sizeof($matieresFiles);$i++){
            MatiereController::creationMatieresDansDatabase($matieresFiles[$i],$year);
        }
    }

    public static function initializationEtudiant($year){
        $AnneeCourante = $year.'-'.($year+1);
        $pathFile = public_path().DIRECTORY_SEPARATOR."INFO".DIRECTORY_SEPARATOR.$AnneeCourante.DIRECTORY_SEPARATOR."ADMIN".
            DIRECTORY_SEPARATOR."LISTES";

        $studentsFiles = scandir($pathFile);
        for($i=2;$i<sizeof($studentsFiles);$i++){
            $nomSemestreCourant = $studentsFiles[$i][-7].$studentsFiles[$i][-6];

            if($studentsFiles[$i][-7] != "S"){
                $nomSemestreCourant= "S4_".$studentsFiles[$i][-8].$studentsFiles[$i][-7].$studentsFiles[$i][-6];
            }
            EtudiantController::inscriptionEtudiantInBD($nomSemestreCourant,$year,$studentsFiles[$i]);
        }
    }


    public function test(){
        self::initializationMatieres('2018');
    self::initializationEtudiant('2018');
    }
}
