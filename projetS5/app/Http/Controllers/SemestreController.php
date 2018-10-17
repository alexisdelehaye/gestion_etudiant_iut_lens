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



    public static function createIfNoteExitsSemestre($cheminFichier){
        //date_default_timezone_set('Europe/Paris');

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
        $dateFin =str_replace("/","-",$dateFin);

        $startDate = self::dateToMySQL($dateDebut);
        $endDate = self::dateToMySQL($dateFin);
        echo "date de fin ".$dateFin;

        $newSemestre = new Semestre;
        $newSemestre->nom = $SemestreCourant;
        $newSemestre->debut = new Carbon($startDate);
        $newSemestre->fin = new Carbon($endDate);
        $newSemestre->Formation_idFormation = 1;
        $newSemestre->save();


    }

    public static function dateToMySQL($date){
        $tabDate = explode('-' , $date);
        $date  = $tabDate[2].'-'.$tabDate[0].'-'.$tabDate[1];
        $date = date( 'Y-m-d H:i:s', strtotime($date) );
        return $date;
    }
}