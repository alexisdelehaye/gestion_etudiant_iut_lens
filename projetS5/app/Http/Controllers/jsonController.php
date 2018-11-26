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
        fwrite($handle, json_encode($data, JSON_PRETTY_PRINT));

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


    public static function getMoyenneEtudiant($numerotudiant, $uesJsonFile, $semestreJsonFile, $dutJsonFile)
    {
        $getEtudiant = Etudiant::where('numEtu', $numerotudiant)->first();
        $data = array();
        foreach (UE::all() as $ue) {
            $semestreConcerne = Semestre::where('idSemestre', $ue->Semestre_idSemestre)->first();
            $moyenne = 0;
            $nbMatiere = 0;
            foreach (Note::where('Etudiant_idEtudiant', $getEtudiant->idEtudiant)->cursor() as $mark) {
                $getMatiere = Matiere::where("idMatiere", $mark->Matiere_idMatiere)->first();
                if ($ue->idUE == $getMatiere->UE_idUE) {
                    $moyenne += ($mark->note * $getMatiere->coefficient);
                    $nbMatiere += floatval($getMatiere->coefficient);
                }
            }
            if ($nbMatiere > 0) {
                $moyenne /= $nbMatiere;
            }
            $data[$getEtudiant->numEtu][] = [
                'Semestre' => $semestreConcerne->nom,
                'nomUe' => $ue->nomUE,
                'moyenne' => round($moyenne, 2)
            ];
        }
        $semestreMoyenneData = array();
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
        $moyenneAnnee = array();

        $moyenneAnnee[$numerotudiant] = [
            "DUT_1" => ($semestreMoyenneData[$numerotudiant][0]["S1"] + $semestreMoyenneData[$numerotudiant][1]["S2"]) / 2,
            "DUT_2" => ($semestreMoyenneData[$numerotudiant][2]["S3"] + $semestreMoyenneData[$numerotudiant][3]["S4_IPI"]) / 2
        ];


        self::moyenneDutStudient($moyenneAnnee, $dutJsonFile);
        self::moyenneSemestreEtudiant($semestreMoyenneData, $semestreJsonFile);
        self::moyenneUEsEtudiant($data, $uesJsonFile);

    }


    public
    static function testUesAffichage($year)
    {
        $anneeCourante = $year . '-' . ($year + 1);
        $uesJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'testAffichageUes.json';

        $listeEtudiant = Etudiant::all();
        $data = array();
        foreach ($listeEtudiant as $etudiant) {
            foreach (UE::all() as $ue) {
                $semestreConcerne = Semestre::where('idSemestre', $ue->Semestre_idSemestre)->first();
                $moyenne = 0;
                $nbMatiere = 0;
                foreach (Note::where('Etudiant_idEtudiant', $etudiant->idEtudiant)->cursor() as $mark) {
                    $getMatiere = Matiere::where("idMatiere", $mark->Matiere_idMatiere)->first();
                    if ($ue->idUE == $getMatiere->UE_idUE) {
                        $moyenne += ($mark->note * $getMatiere->coefficient);
                        $nbMatiere += floatval($getMatiere->coefficient);
                    }
                }
                if ($nbMatiere > 0) {
                    $moyenne /= $nbMatiere;
                }
                $data[$etudiant->numEtu][] = [
                    'Semestre' => $semestreConcerne->nom,
                    'nomUe' => $ue->nomUE,
                    'moyenne' => round($moyenne, 2)
                ];
            }

        }


        $jsondata = json_encode($data, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($uesJsonFile, 'w+');


        fwrite($handle, $jsondata);

//close the file
        fclose($handle);

    }

    public
    static function getMoyenneAllStudents($year)
    {

        $anneeCourante = $year . '-' . ($year + 1);
        $uesJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneUEstudiants.json';

        $semestresJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneSemestreEtudiants.json';

        $dutJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneDUTEtudiants.json';


        ftruncate(fopen($uesJsonFile, 'r+'), 0);
        ftruncate(fopen($semestresJsonFile, 'r+'), 0);
        ftruncate(fopen($dutJsonFile, 'r+'), 0);

        fclose(fopen($uesJsonFile, 'r+'));
        fclose(fopen($semestresJsonFile, 'r+'));
        fclose(fopen($dutJsonFile, 'r+'));

        foreach (Etudiant::all() as $etu) {
            self::getMoyenneEtudiant($etu->numEtu, $uesJsonFile, $semestresJsonFile, $dutJsonFile);
        }

    }

    public
    static function moyenneUEsEtudiant($data, $pathFile)
    {


        //write the data into the file
        $jsondata = file_get_contents($pathFile);
        $arr_data = json_decode($jsondata, true);

        if (is_null($arr_data)) $arr_data = array();

        // Push user data to array
        array_push($arr_data, $data);

        //Convert updated array to JSON
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($pathFile, 'w+');


        fwrite($handle, $jsondata);

//close the file
        fclose($handle);

    }

    public
    static function moyenneSemestreEtudiant($data, $pathFile)
    {

        //write the data into the file
        $jsondata = file_get_contents($pathFile);
        $arr_data = json_decode($jsondata, true);

        if (is_null($arr_data)) $arr_data = array();
        // Push user data to array
        array_push($arr_data, $data);

        //Convert updated array to JSON
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($pathFile, 'w+');


        fwrite($handle, $jsondata);

//close the file
        fclose($handle);


    }

    public
    static function moyenneDutStudient($data, $pathFile)
    {

        //write the data into the file
        $jsondata = file_get_contents($pathFile);
        $arr_data = json_decode($jsondata, true);


        if (is_null($arr_data)) $arr_data = array();
        // Push user data to array
        array_push($arr_data, $data);


        //Convert updated array to JSON
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($pathFile, 'w+');


        fwrite($handle, $jsondata);

//close the file
        fclose($handle);
    }

    public
    static function ClassementDut1Etudiant($year)
    {
        $clasementDut1 = array();
        $anneeCourante = $year . '-' . ($year + 1);
        $dutJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneDUTEtudiants.json';
        $jsondata = file_get_contents($dutJsonFile);
        $arr_data = json_decode($jsondata, true);
        foreach ($arr_data as $value) {
            foreach ($value as $s) {
                $clasementDut1[key($value)] = $s['DUT_1'];

            }
        }
        arsort($clasementDut1);

        $moyennePromo = array_sum($clasementDut1) / count($clasementDut1);
        $minPromo = min($clasementDut1);
        $maxPromo = max($clasementDut1);
        $statPromoDUT1 = array('minimum' => $minPromo, 'maximum' => $maxPromo, "moyenne" => round($moyennePromo, 3));

        $pathFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'classementDUT1Etudiants.json';

        $clasementDut1['classement'] = $statPromoDUT1;
        //Convert updated array to JSON
        $jsondata = json_encode($clasementDut1, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($pathFile, 'w+');


        fwrite($handle, $jsondata);

//close the file
        fclose($handle);
    }

    public
    static function classementDut2Etudiants($year)
    {

        $clasementDut2 = array();
        $anneeCourante = $year . '-' . ($year + 1);
        $dutJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneDUTEtudiants.json';
        $jsondata = file_get_contents($dutJsonFile);
        $arr_data = json_decode($jsondata, true);
        foreach ($arr_data as $value) {
            foreach ($value as $s) {
                $clasementDut2[key($value)] = $s['DUT_2'];

            }
        }

        arsort($clasementDut2);


        $moyennePromo = array_sum($clasementDut2) / count($clasementDut2);
        $minPromo = min($clasementDut2);
        $maxPromo = max($clasementDut2);
        $statPromoDUT2 = array('minimum' => $minPromo, 'maximum' => $maxPromo, "moyenne" => round($moyennePromo, 3));

        $pathFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'classementDUT2Etudiants.json';

        $clasementDut2['classement'] = $statPromoDUT2;
        //Convert updated array to JSON
        $jsondata = json_encode($clasementDut2, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($pathFile, 'w+');

        fwrite($handle, $jsondata);

//close the file
        fclose($handle);
    }


    public
    static function classementEtudiantsUEs($year)
    {

        $anneeCourante = $year . '-' . ($year + 1);
        $uesJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneUEstudiants.json';

        $jsondata = file_get_contents($uesJsonFile);
        $arr_data = json_decode($jsondata, true);
        $minUE11 = $arr_data[0][key($arr_data[0])][0]['moyenne'];
        $minUE12 = $arr_data[0][key($arr_data[0])][1]['moyenne'];
        $minUE21 = $arr_data[0][key($arr_data[0])][2]['moyenne'];
        $minUE22 = $arr_data[0][key($arr_data[0])][3]['moyenne'];
        $minUE31 = $arr_data[0][key($arr_data[0])][4]['moyenne'];
        $minUE32 = $arr_data[0][key($arr_data[0])][5]['moyenne'];
        $minUE33 = $arr_data[0][key($arr_data[0])][6]['moyenne'];
        $minUE41 = $arr_data[0][key($arr_data[0])][7]['moyenne'];
        $minUE42 = $arr_data[0][key($arr_data[0])][8]['moyenne'];
        $minUE43 = $arr_data[0][key($arr_data[0])][9]['moyenne'];
        $maxUE11 = 0;
        $moyenneUE11 = 0;
        $nbUE11 = 0;
        $classementUE11 = array();
        $maxUE12 = 0;
        $moyenneUE12 = 0;
        $nbUE12 = 0;
        $classementUE12 = array();
        $maxUE21 = 0;
        $moyenneUE21 = 0;
        $nbUE21 = 0;
        $classementUE21 = array();
        $maxUE22 = 0;
        $moyenneUE22 = 0;
        $nbUE22 = 0;
        $classementUE22 = array();
        $maxUE31 = 0;
        $moyenneUE31 = 0;
        $nbUE31 = 0;
        $classementUE31 = array();
        $maxUE32 = 0;
        $moyenneUE32 = 0;
        $nbUE32 = 0;
        $classementUE32 = array();
        $maxUE33 = 0;
        $moyenneUE33 = 0;
        $nbUE33 = 0;
        $classementUE33 = array();
        $maxUE41 = 0;
        $moyenneUE41 = 0;
        $nbUE41 = 0;
        $classementUE41 = array();
        $maxUE42 = 0;
        $moyenneUE42 = 0;
        $nbUE42 = 0;
        $classementUE42 = array();
        $maxUE43 = 0;
        $moyenneUE43 = 0;
        $nbUE43 = 0;
        $classementUE43 = array();

        echo $minUE11;

        foreach ($arr_data as $numEtu) {
            foreach ($numEtu as $data) {
                self::compare($data[0]['moyenne'], $minUE11, $maxUE11, $moyenneUE11, $nbUE11);
                self::compare($data[1]['moyenne'], $minUE12, $maxUE12, $moyenneUE12, $nbUE12);
                self::compare($data[2]['moyenne'], $minUE21, $maxUE21, $moyenneUE21, $nbUE21);
                self::compare($data[3]['moyenne'], $minUE22, $maxUE22, $moyenneUE22, $nbUE22);
                self::compare($data[4]['moyenne'], $minUE31, $maxUE31, $moyenneUE31, $nbUE31);
                self::compare($data[5]['moyenne'], $minUE32, $maxUE32, $moyenneUE32, $nbUE32);
                self::compare($data[6]['moyenne'], $minUE33, $maxUE33, $moyenneUE33, $nbUE33);
                self::compare($data[7]['moyenne'], $minUE41, $maxUE41, $moyenneUE41, $nbUE41);
                self::compare($data[8]['moyenne'], $minUE42, $maxUE42, $moyenneUE42, $nbUE42);
                self::compare($data[9]['moyenne'], $minUE43, $maxUE43, $moyenneUE43, $nbUE43);

                $classementUE11[key($numEtu)] = $data[0]['moyenne'];
                $classementUE12[key($numEtu)] = $data[1]['moyenne'];
                $classementUE21[key($numEtu)] = $data[2]['moyenne'];
                $classementUE22[key($numEtu)] = $data[3]['moyenne'];
                $classementUE31[key($numEtu)] = $data[4]['moyenne'];
                $classementUE32[key($numEtu)] = $data[5]['moyenne'];
                $classementUE33[key($numEtu)] = $data[6]['moyenne'];
                $classementUE41[key($numEtu)] = $data[7]['moyenne'];
                $classementUE42[key($numEtu)] = $data[8]['moyenne'];
                $classementUE43[key($numEtu)] = $data[9]['moyenne'];
            }
        }

        arsort($classementUE11);
        arsort($classementUE12);
        arsort($classementUE21);
        arsort($classementUE22);
        arsort($classementUE31);
        arsort($classementUE32);
        arsort($classementUE33);
        arsort($classementUE41);
        arsort($classementUE42);
        arsort($classementUE43);
        self::trieClassement($classementUE11);
        self::trieClassement($classementUE12);
        self::trieClassement($classementUE21);
        self::trieClassement($classementUE22);
        self::trieClassement($classementUE31);
        self::trieClassement($classementUE32);
        self::trieClassement($classementUE33);
        self::trieClassement($classementUE41);
        self::trieClassement($classementUE42);
        self::trieClassement($classementUE43);

        $statsUEs = array();

        $statsUEs['stats_UE11'] = array("minimum" => $minUE11, "maximum" => $maxUE11, "moyenne" => round($moyenneUE11 / $nbUE11, 3));
        $statsUEs['stats_UE12'] = array("minimum" => $minUE12, "maximum" => $maxUE12, "moyenne" => round($moyenneUE12 / $nbUE12, 3));
        $statsUEs['stats_UE21'] = array("minimum" => $minUE21, "maximum" => $maxUE21, "moyenne" => round($moyenneUE21 / $nbUE21, 3));
        $statsUEs['stats_UE22'] = array("minimum" => $minUE22, "maximum" => $maxUE22, "moyenne" => round($moyenneUE22 / $nbUE22, 3));
        $statsUEs['stats_UE31'] = array("minimum" => $minUE31, "maximum" => $maxUE31, "moyenne" => round($moyenneUE31 / $nbUE31, 3));
        $statsUEs['stats_UE32'] = array("minimum" => $minUE32, "maximum" => $maxUE32, "moyenne" => round($moyenneUE32 / $nbUE32));
        $statsUEs['stats_UE33'] = array("minimum" => $minUE33, "maximum" => $maxUE33, "moyenne" => round($moyenneUE33 / $nbUE33, 3));
        $statsUEs['stats_UE41'] = array("minimum" => $minUE41, "maximum" => $maxUE41, "moyenne" => round($moyenneUE41 / $nbUE41, 3));
        $statsUEs['stats_UE42'] = array("minimum" => $minUE42, "maximum" => $maxUE42, "moyenne" => round($moyenneUE42 / $nbUE42, 3));
        $statsUEs['stats_UE43'] = array("minimum" => $minUE43, "maximum" => $maxUE43, "moyenne" => round($moyenneUE43 / $nbUE43, 3));
        $statsUEs['rang_UE11'] = $classementUE11;
        $statsUEs['rang_UE12'] = $classementUE12;
        $statsUEs['rang_UE21'] = $classementUE21;
        $statsUEs['rang_UE22'] = $classementUE22;
        $statsUEs['rang_UE31'] = $classementUE31;
        $statsUEs['rang_UE32'] = $classementUE32;
        $statsUEs['rang_UE33'] = $classementUE33;
        $statsUEs['rang_UE41'] = $classementUE41;
        $statsUEs['rang_UE42'] = $classementUE42;
        $statsUEs['rang_UE43'] = $classementUE43;

        $arr_data['stats_UES'] = $statsUEs;

        print_r($statsUEs['stats_UE11']);


        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($uesJsonFile, 'w+');

        fwrite($handle, $jsondata);

//close the file
        fclose($handle);
    }


    public
    static function classementEtudiantsSemestres($year)
    {

        $anneeCourante = $year . '-' . ($year + 1);
        $semestreJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneSemestreEtudiants.json';

        $jsondata = file_get_contents($semestreJsonFile);
        $arr_data = json_decode($jsondata, true);

        $minS1 = $arr_data[0][key($arr_data[0])][0]['S1'];
        $minS2 = $arr_data[0][key($arr_data[0])][1]['S2'];
        $minS3 = $arr_data[0][key($arr_data[0])][2]['S3'];
        $minS4_IPI = $arr_data[0][key($arr_data[0])][3]['S4_IPI'];
        $maxS1 = 0;
        $moyenneS1 = 0;
        $nbSemestre1 = 0;
        $maxS2 = 0;
        $moyenneS2 = 0;
        $nbSemestre2 = 0;
        $maxS3 = 0;
        $moyenneS3 = 0;
        $nbSemestre3 = 0;
        $maxS4_IPI = 0;
        $moyenneS4_IPI = 0;
        $nbS4_IPI = 0;

        $classementS1 = array();
        $classementS2 = array();
        $classementS3 = array();
        $classementS4_IPI = array();

        foreach ($arr_data as $numEtu) {
            foreach ($numEtu as $data) {
                self::compare($data[0]['S1'], $minS1, $maxS1, $moyenneS1, $nbSemestre1);
                self::compare($data[1]['S2'], $minS2, $maxS2, $moyenneS2, $nbSemestre2);
                self::compare($data[2]['S3'], $minS3, $maxS3, $moyenneS3, $nbSemestre3);
                self::compare($data[3]['S4_IPI'], $minS4_IPI, $maxS4_IPI, $moyenneS4_IPI, $nbS4_IPI);

                $classementS1[key($numEtu)] = $data[0]['S1'];
                $classementS2[key($numEtu)] = $data[1]['S2'];
                $classementS3[key($numEtu)] = $data[2]['S3'];
                $classementS4_IPI[key($numEtu)] = $data[3]['S4_IPI'];
            }

        }

        arsort($classementS1);
        arsort($classementS2);
        arsort($classementS3);
        arsort($classementS4_IPI);

        self::trieClassement($classementS1);
        self::trieClassement($classementS2);
        self::trieClassement($classementS3);
        self::trieClassement($classementS4_IPI);


        $statsSemestre = array();

        $statsSemestre['stats_S1'] = array('minimum' => $minS1, 'maximum' => $maxS1, "moyenne" => round($moyenneS1 / $nbSemestre1, 3));
        $statsSemestre['stats_S2'] = array('minimum' => $minS2, 'maximum' => $maxS2, "moyenne" => round($moyenneS2 / $nbSemestre2, 3));
        $statsSemestre['stats_S3'] = array('minimum' => $minS3, 'maximum' => $maxS3, "moyenne" => round($moyenneS3 / $nbSemestre3, 3));
        $statsSemestre['stats_S4_IPI'] = array('minimum' => $minS4_IPI, 'maximum' => $maxS4_IPI, "moyenne" => round($moyenneS4_IPI / $nbS4_IPI, 3));
        $statsSemestre['rang_S1'] = $classementS1;
        $statsSemestre['rang_S2'] = $classementS2;
        $statsSemestre['rang_S3'] = $classementS3;
        $statsSemestre['rang_S4_IPI'] = $classementS4_IPI;
        $arr_data["classement_semestres"] = $statsSemestre;

        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        $handle = fopen($semestreJsonFile, 'w+');

        fwrite($handle, $jsondata);
        fclose($handle);


    }

    public
    static function compare(&$value, &$minValue, &$maxValue, &$sum, &$nb)
    {
        if (!is_null($value)) {
            if ($value < $minValue) {
                $minValue = $value;
            } else if ($value > $maxValue) {
                $maxValue = $value;
            }
            $sum += $value;
            $nb++;
        }
    }

    public
    static function trieClassement(&$arrayClassement)
    {
        $i = 1;
        foreach ($arrayClassement as &$c) {
            $c = $i;
            $i++;
        }

    }

    public
    static function generationMatiereSemestre($year)
    {
        $anneeCourante = $year . '-' . ($year + 1);
        $matiereJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'listeMatieres.json';

        $listeSemestres = Semestre::all();
        $result = array();
        foreach ($listeSemestres as $semestre) {
            $result[$semestre->nom] = array();
            foreach (UE::where('Semestre_idSemestre', $semestre->idSemestre)->cursor() as $ue) {
                foreach (Matiere::where('UE_idUE', $ue->idUE)->cursor() as $matiere) {
                    array_push($result[$semestre->nom], $matiere->abreviation);
                }

            }
        }

        $jsondata = json_encode($result, JSON_PRETTY_PRINT);
        $handle = fopen($matiereJsonFile, 'w+');

        fwrite($handle, $jsondata);
        fclose($handle);
    }


    public
    function test()
    {
        /*
        self::exportAllStudentsMarksToJson('2018');
        self::classementDut2Etudiants('2018');
        self::exportAllStudentsToJson('2018');
        self::getMoyenneAllStudents('2018');
        */
        //self::classementEtudiantsUEs('2018');
        self::getMoyenneAllStudents('2018');
    }

    public
    function testClassementDUT()
    {
        self::classementEtudiantsUEs('2018');

    }
}
