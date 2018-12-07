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

    public static function GenerationFichierExcelParMatiere($matiere, $annéeVoulu, $nomInfo, $nomSemestre, $nomUE)
    {
        $AnneeCourante = $annéeVoulu . '-' . ($annéeVoulu + 1);
        $getIdSemestre = Semestre::where('nom',$nomSemestre)->first();
        $listeEtudiant = Etudiant::where('Semestre_idSemestre',$getIdSemestre->idSemestre)->get();


        $objPHPExcel = new PHPExcel;
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
                $objSheet->setCellValue('E1', "Moyenne de l'étudiant");
                $objSheet->setCellValue('F1', "Rang");


                $objSheet->setCellValueByColumnAndRow(0, $i + 3, $listeEtudiant[$i]->numEtu);
                $objSheet->setCellValueByColumnAndRow(1, $i + 3, $listeEtudiant[$i]->nom);
                $objSheet->setCellValueByColumnAndRow(2, $i + 3, $listeEtudiant[$i]->prenom);
                $objSheet->setCellValueByColumnAndRow(3, $i + 3, $listeEtudiant[$i]->groupe);
                $objSheet->setCellValueByColumnAndRow(4, $i + 3, rand(5,20));


            }
        }

        $objSheet->getColumnDimension('A')->setAutoSize(true);
        $objSheet->getColumnDimension('B')->setAutoSize(true);
        $objSheet->getColumnDimension('C')->setAutoSize(true);
        $objSheet->getColumnDimension('D')->setAutoSize(true);
        $objSheet->getColumnDimension('E')->setAutoSize(true);
        // ob_end_clean();

        $repertoireFichier = public_path() . DIRECTORY_SEPARATOR . 'INFO' . DIRECTORY_SEPARATOR . $AnneeCourante . DIRECTORY_SEPARATOR . $nomInfo . DIRECTORY_SEPARATOR . $nomSemestre . DIRECTORY_SEPARATOR . $nomUE . DIRECTORY_SEPARATOR . $matiere->abreviation . '.xlsx';

        if ($nomSemestre == "S4_IPI" or $nomSemestre == "S4_PEL") {
            if ($nomSemestre == "S4_IPI") {
                $repertoireFichier = public_path() . DIRECTORY_SEPARATOR . 'INFO' . DIRECTORY_SEPARATOR . $AnneeCourante . DIRECTORY_SEPARATOR . $nomInfo . DIRECTORY_SEPARATOR . 'S4' . DIRECTORY_SEPARATOR . 'IPI' .DIRECTORY_SEPARATOR. $nomUE . DIRECTORY_SEPARATOR . $matiere->abreviation . '.xlsx';
            } else if ($nomSemestre == "S4_PEL") {
                $repertoireFichier = public_path() . DIRECTORY_SEPARATOR . 'INFO' . DIRECTORY_SEPARATOR . $AnneeCourante . DIRECTORY_SEPARATOR . $nomInfo . DIRECTORY_SEPARATOR . 'S4' . DIRECTORY_SEPARATOR . 'PEL' .DIRECTORY_SEPARATOR. $nomUE . DIRECTORY_SEPARATOR . $matiere->abreviation . '.xlsx';
            }

        }
        $objWriter->save(str_replace(__FILE__, $repertoireFichier, __FILE__));

    }


    public static function creationFicheNotesPourToutesLesMatieres($idUE, $annéeVoulu, $nomInfo, $nomSemestre, $nomUE)
    {

        $listeMatiere = Matiere::all();
        foreach ($listeMatiere as $matiere) {
            if ($matiere->UE_idUE == $idUE) {
                self::GenerationFichierExcelParMatiere($matiere, $annéeVoulu, $nomInfo, $nomSemestre, $nomUE);
            }
        }
    }


    public static function créationFicheMatièresSelonSemestre($annéeVoulu, $nomSemestre)
    {
        $nomSemestre = strtoupper($nomSemestre);
        $nomInfo = null;


        switch (intval($nomSemestre[1])) {

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

        $getIdSemestre = Semestre::where('nom', $nomSemestre)->first();
        $getUepourMatieres = UE::where('Semestre_idSemestre', $getIdSemestre->idSemestre)->get();

        foreach ($getUepourMatieres as $ue) {
            self::creationFicheNotesPourToutesLesMatieres($ue['idUE'], $annéeVoulu, $nomInfo, $nomSemestre, $ue['nomUE']);
        }

    }

    public function createAllMarksFile()
    {
        $semestre = Semestre::all();

        foreach ($semestre as $s){
            GenerationDocumentController::créationFicheMatièresSelonSemestre('2018', $s->nom);
            echo "<br/> vous venez de créer l'ensemble dez fiches de notes pour le semestre ".$s->nom;
        }


    }


}
