<?php

namespace App\Http\Controllers;

use App\Etudiant;
use App\Matiere;
use App\Note;
use App\Semestre;
use App\UE;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;

class NoteController extends Controller
{


    public static function miseAjourNotesEtudiantsparMatiere($annneeVoulu,$semestreVoulu,$idmatiereVoulu)
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

        $idUeMatiere = Matiere::where("idMatiere",$idmatiereVoulu)->first();
        $nomUe = UE::where('idUE',$idUeMatiere->UE_idUE)->first();

        $excelFile =  public_path().DIRECTORY_SEPARATOR.'INFO'.DIRECTORY_SEPARATOR.$anneeCourante.DIRECTORY_SEPARATOR.$nomInfo.DIRECTORY_SEPARATOR.$nomSemestre.DIRECTORY_SEPARATOR.$nomUe->nomUE.DIRECTORY_SEPARATOR.$idUeMatiere->abreviation.'.xlsx';


        if ($nomSemestre == "S4_IPI" or $nomSemestre == "S4_PEL") {
            if ($nomSemestre == "S4_IPI") {
                $excelFile = public_path() . DIRECTORY_SEPARATOR . 'INFO' . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . $nomInfo . DIRECTORY_SEPARATOR . 'S4' . DIRECTORY_SEPARATOR . 'IPI' .DIRECTORY_SEPARATOR. $nomUe->nomUE . DIRECTORY_SEPARATOR . $idUeMatiere->abreviation . '.xlsx';
            } else if ($nomSemestre == "S4_PEL") {
                $excelFile = public_path() . DIRECTORY_SEPARATOR . 'INFO' . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . $nomInfo . DIRECTORY_SEPARATOR . 'S4' . DIRECTORY_SEPARATOR . 'PEL' .DIRECTORY_SEPARATOR. $nomUe->nomUE . DIRECTORY_SEPARATOR . $idUeMatiere->abreviation . '.xlsx';
            }

        }

        $inputFileType = PHPExcel_IOFactory::identify($excelFile);

        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        /**  Advise the Reader of which WorkSheets we want to load  **/
        $objReader->setLoadSheetsOnly($idUeMatiere->abreviation);

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


        public static function miseAjourNotesEtudiantsparSemestre($anneeVoulu,$semestreVoulu){
        $idSemestre = Semestre::where('nom',$semestreVoulu)->first();
      foreach (UE::where('Semestre_idSemestre',$idSemestre->idSemestre)->cursor() as $ue){
          foreach (Matiere::where('UE_idUE',$ue->idUE)->cursor() as $matiere) {
              self::miseAjourNotesEtudiantsparMatiere($anneeVoulu,$semestreVoulu,$matiere->idMatiere);
          }
      }
        }


    public function test(){
        self::miseAjourNotesEtudiantsparSemestre('2018','S4_IPI');
        //NoteController::miseAjourNotesEtudiantsparMatiere("2018","S3","CPA");

    }

}
