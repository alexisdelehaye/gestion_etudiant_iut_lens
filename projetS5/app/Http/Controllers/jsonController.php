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

    public static function exportAllStudentsMarksToJson($AnneeVoulue)
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

                    $data[$etudiant->numEtu][] = [
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
        fwrite($handle, json_encode($data,JSON_PRETTY_PRINT));

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


    public static function getMoyenneEtudiant($numerotudiant,$uesJsonFile, $semestreJsonFile, $dutJsonFile)
    {
        $getEtudiant = Etudiant::where('numEtu', $numerotudiant)->first();
        $data = [];
        foreach (UE::all() as $ue) {
            $moyenne = 0;
            $nbMatiere = 0;
            foreach (Note::where('Etudiant_idEtudiant', $getEtudiant->idEtudiant)->cursor() as $mark) {
                $getMatiere = Matiere::where("idMatiere", $mark->Matiere_idMatiere)->first();
                if ($ue->idUE == $getMatiere->UE_idUE) {
                    $moyenne += ($mark->note * $getMatiere->coefficient);
                    $nbMatiere += $getMatiere->coefficient;
                }
            }
            $moyenne /= $nbMatiere;

            $data[$numerotudiant][] = [
                'nomUe' => $ue->nomUE,
                'moyenne' => round($moyenne, 2)
            ];
        }

        $semestreMoyenneData = [];
        foreach (Semestre::all() as $semestre) {
            $moyenneSemestre = 0;
            $nbUes = UE::where(['Semestre_idSemestre' => $semestre->idSemestre])->count();

            foreach ($data[$numerotudiant] as $d) {
                $getUe = UE::where('nomUE', $d['nomUe'])->first();
                if ($semestre->idSemestre == $getUe->Semestre_idSemestre) {
                    $moyenneSemestre += $d['moyenne'];
                }
            }
            if ($nbUes > 0) {
                $semestreMoyenneData[$numerotudiant][] = [
                    $semestre->nom => round($moyenneSemestre / $nbUes, 2)
                ];
            }
        }

            $moyenneAnnee = [];

            $moyenneAnnee[$numerotudiant] = [
                "DUT_1" => ($semestreMoyenneData[$numerotudiant][0]["S1"] +$semestreMoyenneData[$numerotudiant][1]["S2"])/2,
                "DUT_2" => ($semestreMoyenneData[$numerotudiant][2]["S3"] +$semestreMoyenneData[$numerotudiant][3]["S4_IPI"])/2
            ];


    self::moyenneDutStudient($moyenneAnnee,$dutJsonFile);
    self::moyenneSemestreEtudiant($semestreMoyenneData,$semestreJsonFile);
    self::moyenneUEsEtudiant($data,$uesJsonFile);
        //print_r(json_encode($data));

    }

    public static function getMoyenneAllStudents($year){

        $anneeCourante = $year . '-' . ($year + 1);
        $uesJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneUEstudiants.json';

        $semestresJsonFile =  public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneSemestreEtudiants.json';

        $dutJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneDUTEtudiants.json';




        ftruncate(fopen($uesJsonFile,'r+'),0);
        ftruncate(fopen($semestresJsonFile,'r+'),0);
        ftruncate(fopen($dutJsonFile,'r+'),0);

        fclose(fopen($uesJsonFile,'r+'));
        fclose(fopen($semestresJsonFile,'r+'));
        fclose(fopen($dutJsonFile,'r+'));

        foreach (Etudiant::all() as $etu){
            self::getMoyenneEtudiant($etu->numEtu,$uesJsonFile,$semestresJsonFile,$dutJsonFile);
        }

    }
    public static function moyenneUEsEtudiant($data,$pathFile){



        //write the data into the file
        $jsondata = file_get_contents($pathFile);
        $arr_data = json_decode($jsondata, true);

        if (is_null($arr_data)) $arr_data = array();

        // Push user data to array
        array_push($arr_data,$data);

        //Convert updated array to JSON
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($pathFile, 'w+');


        fwrite($handle, $jsondata);

//close the file
        fclose($handle);

    }

    public static function moyenneSemestreEtudiant($data, $pathFile){

        //write the data into the file
        $jsondata = file_get_contents($pathFile);
        $arr_data = json_decode($jsondata, true);

        if (is_null($arr_data)) $arr_data = array();
        // Push user data to array
        array_push($arr_data,$data);

        //Convert updated array to JSON
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($pathFile, 'w+');



        fwrite($handle, $jsondata);

//close the file
        fclose($handle);


    }

    public static function moyenneDutStudient($data,$pathFile){

        //write the data into the file
        $jsondata = file_get_contents($pathFile);
        $arr_data = json_decode($jsondata, true);


        if (is_null($arr_data)) $arr_data = array();
        // Push user data to array
        array_push($arr_data,$data);



        //Convert updated array to JSON
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($pathFile, 'w+');



        fwrite($handle, $jsondata);

//close the file
        fclose($handle);


    }



    public function test()
    {
       // self::getMoyenneEtudiant('20150983');
        //self::exportAllStudentsToJson('2018');
        // self::exportAllStudentsMarksToJson(null,'2018');
      // self::getMoyenneAllStudents('2018');
    self::exportAllStudentsMarksToJson('2018');
    }
}
