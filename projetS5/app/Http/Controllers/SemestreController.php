<?php

namespace App\Http\Controllers;

use App\Matiere;
use App\Semestre;
use App\UE;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;

/**
 * Created by PhpStorm.
 * User: cdcde
 * Date: 17/10/2018
 * Time: 16:40
 */


class SemestreController extends Controller {



    public static function createIfNoteExitsSemestre($cheminFichier,$anneeVoulu){
        $AnneeCourante = $anneeVoulu.'-'.($anneeVoulu+1);

        $inputFileType = PHPExcel_IOFactory::identify($cheminFichier);

        $sheetname = "Durée";

        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        /**  Advise the Reader of which WorkSheets we want to load  **/
        $objReader->setLoadSheetsOnly($sheetname);

        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($cheminFichier);


        $dateDebut = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,3)->getFormattedValue();
        $dateFin = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,4)->getFormattedValue();
        $SemestreCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,5)->getValue();
        $dateDebut =str_replace("/","-",$dateDebut);
        $dateFin =str_replace("/","-",$dateFin);

        $startDate = self::dateToMySQL($dateDebut);
        $endDate = self::dateToMySQL($dateFin);
        $checkIfSemestresExist = Semestre::where('nom',$SemestreCourant)->first();

        if(is_null($checkIfSemestresExist)) {

            $newSemestre = new Semestre;
            $newSemestre->nom = $SemestreCourant;
            $newSemestre->debut = new Carbon($startDate);
            $newSemestre->fin = new Carbon($endDate);
            $newSemestre->Formation_idFormation = 1;
            $newSemestre->save();

        }
    }

    public static function dateToMySQL($date){
        $tabDate = explode('-' , $date);
        if (count($tabDate)<3) {
           echo "<br>SemestreController.dateToMySQL ";  
           echo " Erreur Date :".$date.PHP_EOL;
           print_r($tabDate); 
           exit(1); 
        }
        $date  = $tabDate[2].'-'.$tabDate[0].'-'.$tabDate[1];
        $date = date( 'Y-m-d H:i:s', strtotime($date) );
        return $date;
    }
}
