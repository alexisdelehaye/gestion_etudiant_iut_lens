<?php

namespace App\Http\Controllers;

use App\Etudiant;
use App\Matiere;
use App\Note;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;

class NoteController extends Controller
{


    public function miseAjourNotesEtudiants()
    {

        $excelFile = 'C:\Users\cdcde\Music\PROJET S5 LPDIOC GESTION ETUDIANT\GestionEtudiants2018\projetS5\public\notesEtudiants\Pweb-1_.xlsx';

        $matiereCourante = Matiere::where('idMatiere',4)->first();
        $Matiere_idMatiere = $matiereCourante->Matiere_idMatiere;

        $inputFileType = PHPExcel_IOFactory::identify($excelFile);

        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        /**  Advise the Reader of which WorkSheets we want to load  **/
        $objReader->setLoadSheetsOnly("Pweb-1");

        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($excelFile);
        $nombreLigneFeuille = $objPHPExcel->getActiveSheet()->getHighestRow();


        for ($i = 0; $i <= $nombreLigneFeuille; $i++) {
            $numeroEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 3 + $i)->getValue();

            $nombreNotes = 0;

            if (!is_null($numeroEtudiantCourant)) {
                $EtudiantCourant = Etudiant::where('numEtu', $numeroEtudiantCourant)->first();

                while (!is_null($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4 + $nombreNotes, 1 + $i)->getValue())) {
                    $nouvelleNotesEtudiant = new Note;
                    $nouvelleNotesEtudiant->note = (float)$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4 + $nombreNotes, 1 + $i)->getValue();
                    $nouvelleNotesEtudiant->Etudiant_idEtudiant = $EtudiantCourant->idEtudiant;
                    $nouvelleNotesEtudiant->Matiere_idMatiere = 4;
                    $nouvelleNotesEtudiant->save();
                    $nombreNotes++;
                }
            }
        }

    }

}
