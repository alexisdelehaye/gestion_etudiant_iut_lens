<?php

namespace App\Http\Controllers;

use App\Etudiant;
use App\Matiere;
use Illuminate\Http\Request;

class NoteController extends Controller
{


    public function miseAjourNotesEtudiants()
    {

//        $excelFile = 'C:\Users\cdcde\Music\PROJET S5 LPDIOC GESTION ETUDIANT\GestionEtudiants2018\projetS5\public\fichierExcel\Bilan_INFO_S3_20162017.xls';
//
//
//        $sheetname = "Matieres";
//
//        $inputFileType = PHPExcel_IOFactory::identify($excelFile);
//
//        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
//
//        /**  Advise the Reader of which WorkSheets we want to load  **/
//        $objReader->setLoadSheetsOnly($sheetname);
//
//        /**  Load $inputFileName to a PHPExcel Object  **/
//        $objPHPExcel = $objReader->load($excelFile);
//        $nombreLigneFeuille = $objPHPExcel->getActiveSheet()->getHighestRow();
//        echo "nb ligne : " . $objPHPExcel->getActiveSheet()->getHighestRow() . PHP_EOL;
//        for ($i = 0; $i <= $nombreLigneFeuille; $i++) {
//
//            $referenceMatiereCourante = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 1 + $i)->getValue();
//            $nomModuleCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 1 + $i)->getValue();
//            $AbreviationMatiereCourante = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, 1 + $i)->getValue();
//            $coefficientMatiereCourante = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, 1 + $i)->getValue();
//            $UECourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, 1 + $i)->getValue();
//            $SemestreCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, 1 + $i)->getValue();
//
//            echo 'contenu de la ligne :' . $referenceMatiereCourante . '/ ';
//
//            if ($referenceMatiereCourante != null and $referenceMatiereCourante[0] == 'M') {
//
//            }
//        }
//    }


    }
}
