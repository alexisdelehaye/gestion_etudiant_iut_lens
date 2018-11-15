<?php

namespace App\Http\Controllers;

use App\Etudiant;
use App\Matiere;
use App\Note;
use App\Semestre;
use App\UE;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;

class jsonController extends Controller
{

    public static function exportAllStudentsMarksToJson($SemestreVoulu = null, $AnneeVoulue)
    {
        $AnneeCourante = $AnneeVoulue . '-' . ($AnneeVoulue + 1);
        $etudiants = Etudiant::all();
        $notes = Note::all();
        $data = [];

        foreach ($notes as $note) {
            foreach ($etudiants as $etudiant) {
                if ($note->Etudiant_idEtudiant == $etudiant->idEtudiant) {
                    $nomMatiere = Matiere::where('idMatiere', $note->Matiere_idMatiere)->first();
                    $nomUE = UE::where('idUE', $nomMatiere->UE_idUE)->first();
                    $nomSemestre = Semestre::where('idSemestre', $nomUE->Semestre_idSemestre)->first();

                    $data[$etudiant->numEtu][$etudiant->Semestre_idSemestre][] = [
                        $nomMatiere->abreviation => $note->note,
                        "UE" => $nomUE->nomUE,
                        "Semestre" => $nomSemestre->nom
                    ];

                }

            }
        }


        $pathFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $AnneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'notesEtudiants.json';

        //open or create the file
        $handle = fopen($pathFile, 'w+');

//write the data into the file
        fwrite($handle, json_encode($data));

//close the file
        fclose($handle);

    }

    public function exportNotesFromExcelToJson($annneeVoulu, $semestreVoulu, $matiereVoulu)
    {
        $nomSemestre = strtoupper($semestreVoulu);
        $anneeCourante = $annneeVoulu . '-' . ($annneeVoulu + 1);

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

        $idUeMatiere = Matiere::where("abreviation", $matiereVoulu)->first();
        $nomUe = UE::where('idUE', $idUeMatiere->UE_idUE)->first();

        $excelFile = public_path() . DIRECTORY_SEPARATOR . 'INFO' . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . $nomInfo . DIRECTORY_SEPARATOR . $nomSemestre . DIRECTORY_SEPARATOR . $nomUe->nomUE . DIRECTORY_SEPARATOR . $matiereVoulu . '.xlsx';
        $pathFile = public_path() . DIRECTORY_SEPARATOR . 'INFO' . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . $nomInfo . DIRECTORY_SEPARATOR . $nomSemestre . DIRECTORY_SEPARATOR . $nomUe->nomUE . DIRECTORY_SEPARATOR . $matiereVoulu . '.json';

        $inputFileType = PHPExcel_IOFactory::identify($excelFile);

        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        /**  Advise the Reader of which WorkSheets we want to load  **/
        $objReader->setLoadSheetsOnly($matiereVoulu);

        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($excelFile);
        $nombreLigneFeuille = $objPHPExcel->getActiveSheet()->getHighestRow();

        $data = [];
        for ($i = 0; $i <= $nombreLigneFeuille; $i++) {
            $numeroEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 3 + $i)->getValue();
            $nomEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 3 + $i)->getValue();
            $prenomEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, 3 + $i)->getValue();
            $groupeEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, 3 + $i)->getValue();
            $moyenneEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, 3 + $i)->getValue();

            $data[] = [
                'Numero' => $numeroEtudiantCourant,
                'Nom' => $nomEtudiantCourant,
                'Prenom' => $prenomEtudiantCourant,
                'groupe' => $groupeEtudiantCourant,
                'moyenne' => $moyenneEtudiantCourant

            ];
        }

        $handle = fopen($pathFile, 'w+');

//write the data into the file
        fwrite($handle, json_encode($data));

//close the file
        fclose($handle);

    }

    public static function exportAllStudentsToJson($year)
    {
        $etudiants = Etudiant::all();
        $jsonData = $etudiants->toJson();
        $anneeCourante = $year . '-' . ($year + 1);


        $pathFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'listeEtudiants.json';

        //open or create the file
        $handle = fopen($pathFile, 'w+');

//write the data into the file
        fwrite($handle, $jsonData);

//close the file
        fclose($handle);

    }


    public static function getMoyenneUeEtudiant($numerotudiant)
    {
        $getEtudiant = Etudiant::where('numEtu', $numerotudiant)->first();
        $data = [];

        foreach (UE::all() as $ue) {
            $moyenne = 0;
            $nbMatiere = 0;
        foreach (Note::where('Etudiant_idEtudiant', $getEtudiant->idEtudiant)->cursor() as $mark) {
            $getMatiere = Matiere::where("idMatiere", $mark->Matiere_idMatiere)->first();
                if ($ue->idUE == $getMatiere->UE_idUE) {
                    $moyenne += ($mark->note*$getMatiere->coefficient);
                    $nbMatiere+=$getMatiere->coefficient;
                }
            }
            $moyenne /= $nbMatiere;

            $data[$numerotudiant][] = [
                'nomUe' => $ue->nomUE,
                'moyenne' => round($moyenne,2)
            ];
        }

        $semestreMoyenneData= [];
        foreach (Semestre::all() as $semestre) {
            $moyenneSemestre =0;
            $nbUes =UE::where(['Semestre_idSemestre'=>$semestre->idSemestre])->count();

            foreach ($data[$numerotudiant] as $d) {
                $getUe = UE::where('nomUE',$d['nomUe'])->first();
                if($semestre->idSemestre == $getUe->Semestre_idSemestre){
                    $moyenneSemestre+=$d['moyenne'];
                }
            }
            if($nbUes>0) {
                $semestreMoyenneData[] = [
                    $semestre->nom => round($moyenneSemestre / $nbUes,2)
                ];
            }
        }
    array_push($data,$semestreMoyenneData);
     print_r(json_encode($data));
    }



    public function test()
    {
        //self::exportAllStudentsToJson('2018');
        // self::exportAllStudentsMarksToJson(null,'2018');
        self::getMoyenneUeEtudiant('20150934');
    }
}
