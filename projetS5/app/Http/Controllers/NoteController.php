<?php

namespace App\Http\Controllers;

use App\Etudiant;
use App\Matiere;
use App\Note;
use App\UE;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;

class NoteController extends Controller
{


    public function miseAjourNotesEtudiants($annneeVoulu,$semestreVoulu,$matiereVoulu)
    {
        $nomSemestre = strtoupper($semestreVoulu);
        $anneeCourante = $annneeVoulu . '-' . ($annneeVoulu + 1);

        $nomInfo=null;


        switch (intval($nomSemestre[1])){

            case 1 :
                $nomInfo = "INFO1";
                break;
            case 2 :
                $nomInfo = "INFO1";
                break;
            case 3 :
                $nomInfo = "INFO2";
                break;
            case 4 :
                $nomInfo = "INFO2";
                break;
            case 5:
                $nomInfo = "LPDIOC";
                break;
            case 6:
                $nomInfo = "LPDIOC";
                break;

        }

        $idUeMatiere = Matiere::where("abreviation",$matiereVoulu)->first();
        $nomUe = UE::where('idUE',$idUeMatiere->UE_idUE)->first();

        $excelFile =  public_path().DIRECTORY_SEPARATOR.'INFO'.DIRECTORY_SEPARATOR.$anneeCourante.DIRECTORY_SEPARATOR.$nomInfo.DIRECTORY_SEPARATOR.$nomSemestre.DIRECTORY_SEPARATOR.$nomUe->nomUE.DIRECTORY_SEPARATOR.$matiereVoulu.'.xlsx';

        $inputFileType = PHPExcel_IOFactory::identify($excelFile);

        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        /**  Advise the Reader of which WorkSheets we want to load  **/
        $objReader->setLoadSheetsOnly($matiereVoulu);

        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($excelFile);
        $nombreLigneFeuille = $objPHPExcel->getActiveSheet()->getHighestRow();


        for ($i = 0; $i <= $nombreLigneFeuille; $i++) {
            $numeroEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 3 + $i)->getValue();

            if (!is_null($numeroEtudiantCourant)) {
                $EtudiantCourant = Etudiant::where('numEtu', $numeroEtudiantCourant)->first();
                    $nouvelleNotesEtudiant = new Note;
                    $nouvelleNotesEtudiant->note = (float)$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4 ,  3 + $i)->getValue();
                    $nouvelleNotesEtudiant->Etudiant_idEtudiant = $EtudiantCourant->idEtudiant;
                    $nouvelleNotesEtudiant->Matiere_idMatiere = $idUeMatiere->idMatiere;
                    $nouvelleNotesEtudiant->save();
                }
            }
        }




    public function test(){
        NoteController::miseAjourNotesEtudiants("2018","S3","APA");

    }

}
