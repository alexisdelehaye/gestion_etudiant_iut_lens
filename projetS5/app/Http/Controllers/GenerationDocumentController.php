<?php

namespace App\Http\Controllers;

use App\Etudiant;
use App\Matiere;
use App\Semestre;
use App\UE;
use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;

class GenerationDocumentController extends Controller
{

    public static function GenerationFichierExcelParMatiere($matiere,$annéeVoulu,$nomInfo,$nomSemestre,$nomUE)
    {
        $AnneeCourante = $annéeVoulu.'-'.($annéeVoulu+1);
        $listeEtudiant = Etudiant::all();


        $objPHPExcel = new PHPExcel;
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');

        $objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
        $objSheet = $objPHPExcel->getActiveSheet();
        $objSheet->setTitle($matiere->abreviation);


        for ($i = 0; $i < sizeof($listeEtudiant); $i++) {

            $ueCourant = UE::where('idUE', $matiere->UE_idUE)->first();
            $semestreCourant = Semestre::where('idSemestre', $ueCourant->Semestre_idSemestre)->first();

            if ($semestreCourant->Formation_idFormation == $listeEtudiant[$i]->Formation_idFormation) {


                $objSheet->setCellValue('A1', 'Numéro');
                $objSheet->setCellValue('B1', 'Nom');
                $objSheet->setCellValue('C1', 'Prénom');
                $objSheet->setCellValue('D1', 'Groupe');
                $objSheet->setCellValue('E1', "suite de note de l'étudiant");


                $objSheet->setCellValueByColumnAndRow(0, $i + 3, $listeEtudiant[$i]->numEtu);
                $objSheet->setCellValueByColumnAndRow(1, $i + 3, $listeEtudiant[$i]->nom);
                $objSheet->setCellValueByColumnAndRow(2, $i + 3, $listeEtudiant[$i]->prenom);
                $objSheet->setCellValueByColumnAndRow(3, $i + 3, $listeEtudiant[$i]->groupe);


            }
        }

        $objSheet->getColumnDimension('A')->setAutoSize(true);
        $objSheet->getColumnDimension('B')->setAutoSize(true);
        $objSheet->getColumnDimension('C')->setAutoSize(true);
        $objSheet->getColumnDimension('D')->setAutoSize(true);
        $objSheet->getColumnDimension('E')->setAutoSize(true);
       // ob_end_clean();

        $repertoireFichier =  public_path().'\INFO\\'.$AnneeCourante.'\\'.$nomInfo.'\\'.$nomSemestre.'\\'.$nomUE.'\\'.$matiere->abreviation.'.xlsx';
        $objWriter->save(str_replace(__FILE__,$repertoireFichier,__FILE__));

    }


    public static function creationFicheNotesPourToutesLesMatieres($idUE,$annéeVoulu,$nomInfo,$nomSemestre,$nomUE)
    {

        $listeMatiere = Matiere::all();
        foreach ($listeMatiere as $matiere) {
            echo $matiere->abreviation;
            if ($matiere->UE_idUE == $idUE) {
                self::GenerationFichierExcelParMatiere($matiere,$annéeVoulu,$nomInfo,$nomSemestre,$nomUE);
            }
        }
    }


    public static function créationFicheMatièresSelonSemestre($annéeVoulu,$nomSemestre,$nomInfo){
        $getIdSemestre = Semestre::where('nom',$nomSemestre)->first();
        $getUepourMatieres = UE::where('Semestre_idSemestre',$getIdSemestre->idSemestre)->get();
        foreach ($getUepourMatieres as $ue ) {
             self::creationFicheNotesPourToutesLesMatieres($ue['idUE'],$annéeVoulu,$nomInfo,$nomSemestre,$ue['nomUE']);
        }

    }

    public function test(){
        GenerationDocumentController::créationFicheMatièresSelonSemestre('2018','S3',"INFO2");

    }
}
/*
echo "pass";
$testmatiere = Matiere::where('idMatiere',4)->first();
GenerationDocumentController::GenerationFichierExcelParMatiere($testmatiere);
*/