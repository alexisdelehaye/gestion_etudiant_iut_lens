<?php

namespace App\Http\Controllers;

use App\Matiere;
use App\Semestre;
use App\UE;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;

class MatiereController extends Controller
{

    public static function creationMatieresDansDatabase($SemestreVoulu, $AnneeVoulue)
    {
        $AnneeCourante = $AnneeVoulue . '-' . ($AnneeVoulue + 1);
        $excelFile = public_path() .DIRECTORY_SEPARATOR.'INFO'.DIRECTORY_SEPARATOR.$AnneeCourante.DIRECTORY_SEPARATOR.'ADMIN'.DIRECTORY_SEPARATOR.'MATIERES'.DIRECTORY_SEPARATOR.'INFO_'.$AnneeCourante . '_ADMIN_MATIERES_' . $SemestreVoulu . '.xlsx';


        $sheetname = "Matières";

        $inputFileType = PHPExcel_IOFactory::identify($excelFile);

        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        /**  Advise the Reader of which WorkSheets we want to load  **/
        $objReader->setLoadSheetsOnly($sheetname);

        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($excelFile);
        $nombreLigneFeuille = $objPHPExcel->getActiveSheet()->getHighestRow();
        echo "nb ligne : " . $objPHPExcel->getActiveSheet()->getHighestRow() . PHP_EOL;
        for ($i = 1; $i <= $nombreLigneFeuille; $i++) {

            $referenceMatiereCourante = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 1 + $i)->getValue();
            $nomModuleCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 1 + $i)->getValue();
            $AbreviationMatiereCourante = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, 1 + $i)->getValue();
            $coefficientMatiereCourante = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, 1 + $i)->getValue();
            $UECourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, 1 + $i)->getValue();
            $SemestreCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, 1 + $i)->getValue();



            $checkIfMatiereExists = Matiere::where('ref', $referenceMatiereCourante)->first();
            //SemestreController::createIfNoteExitsSemestre($excelFile);

            if ($referenceMatiereCourante != null) {

                if (is_null($checkIfMatiereExists)) {
                    $matiere = new Matiere;
                    $matiere->nom = $nomModuleCourant;
                    $matiere->ref = $referenceMatiereCourante;
                    $matiere->abreviation = $AbreviationMatiereCourante;
                    $matiere->coefficient = floatval($coefficientMatiereCourante);

                    $getUE = UE::where('nomUE', $UECourant)->first();
                    $getSemestre = Semestre::where('nom', $SemestreCourant)->first();

                    if (is_null($getSemestre)) {
                        SemestreController::createIfNoteExitsSemestre($excelFile);
                    }

                    if (is_null($getUE)) {
                        UEController::createIfNotExistsUE($UECourant,$SemestreCourant);
                    }

                    $getUE = UE::where('nomUE', $UECourant)->first();
                    $matiere->UE_idUE = $getUE->idUE;
                    $matiere->save();

                }
            }

        }

    }

    public function test(){
        MatiereController::creationMatieresDansDatabase('S3','2018');
    }
}
