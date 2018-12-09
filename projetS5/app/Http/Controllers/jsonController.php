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
        $handle = fopen($pathFile, 'w+');
        fwrite($handle, $jsonData);
        fclose($handle);
    }


    public static function testUesAffichage($year, $dutJsonFile, $semestreJsonFile, $uesJsonFile)
    {
        $listeEtudiant = Etudiant::all();
        $data = array();
        $semestreMoyenneData = array();

        $moyenneAnnee = array();
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


            foreach (Semestre::all() as $semestre) {
                if ($semestre->idSemestre <= $etudiant->Semestre_idSemestre) {
                    $moyenneSemestre = 0;
                    $nbUes = UE::where(['Semestre_idSemestre' => $semestre->idSemestre])->count();

                    foreach ($data[$etudiant->numEtu] as $d) {
                        $getUe = UE::where('nomUE', $d['nomUe'])->first();
                        if ($semestre->idSemestre == $getUe->Semestre_idSemestre) {
                            $moyenneSemestre += $d['moyenne'];
                        }
                    }
                    if ($nbUes > 0) {
                        $semestreMoyenneData[$etudiant->numEtu][] = [
                            $semestre->nom => round($moyenneSemestre / $nbUes, 2)
                        ];
                    }
                }
            }


            self::creationMoyenneDutEtudiant($moyenneAnnee, $semestreMoyenneData, $etudiant->Semestre_idSemestre, $etudiant->numEtu);
        }
        self::saveDataInJson($semestreMoyenneData, $semestreJsonFile);
        self::saveDataInJson($data, $uesJsonFile);
        self::saveDataInJson($moyenneAnnee, $dutJsonFile);
    }


    public static function creationMoyenneDutEtudiant(&$moyenneDUT, $data, $idSemestre, $numEtu)
    {

        switch ($idSemestre) {
            case 1:
                $moyenneDUT[$numEtu] = array("DUT_1" => $data[$numEtu][0]["S1"]);
                return;
            case 2 :
                $moyenneDUT[$numEtu] = array("DUT_1" => ($data[$numEtu][0]["S1"] + $data[$numEtu][1]["S2"]) / 2);
                return;
            case 3 :
                $moyenneDUT[$numEtu] = array("DUT_1" => ($data[$numEtu][0]["S1"] + $data[$numEtu][1]["S2"]) / 2,
                    "DUT_2" => $data[$numEtu][3]["S3"]);
                return;
            case 4 :
                $moyenneDUT[$numEtu] = array("DUT_1" => ($data[$numEtu][0]["S1"] + $data[$numEtu][1]["S2"]) / 2,
                    "DUT_2" => ($data[$numEtu][3]["S3"] / $data[$numEtu][4]["S4_IPIP"]) / 2);
                return;
        }
    }

    public static function saveDataInJson($data, $pathFile)
    {

        //Convert updated array to JSON
        $jsondata = json_encode($data, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($pathFile, 'w+');

        fwrite($handle, $jsondata);

//close the file
        fclose($handle);


    }


    public static function ClassementDutEtudiant($year)
    {
        $result = array();
        $clasementDut1 = array();
        $classementDUT2 = array();
        $anneeCourante = $year . '-' . ($year + 1);
        $dutJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneDUTEtudiants.json';
        $jsondata = file_get_contents($dutJsonFile);
        $arr_data = json_decode($jsondata, true);
        $listeEtu = array_keys($arr_data);
        $i = 0;
        foreach ($arr_data as $value) {
            $clasementDut1[$listeEtu[$i]] = $value['DUT_1'];
            if (array_key_exists('DUT_2', $value)) {
                $classementDUT2[$listeEtu[$i]] = $value['DUT_2'];
            }
            $i++;
        }
        arsort($clasementDut1);
        arsort($classementDUT2);

        $moyennePromoDUT1 = array_sum($clasementDut1) / count($clasementDut1);
        $minPromoDUT1 = min($clasementDut1);
        $maxPromoDUT1 = max($clasementDut1);
        $statPromoDUT1 = array('minimum' => $minPromoDUT1, 'maximum' => $maxPromoDUT1, "moyenne" => round($moyennePromoDUT1, 3));

        if (!empty($classementDUT2)) {
            $moyennePromoDUT2 = array_sum($classementDUT2) / count($classementDUT2);
            $minPromoDUT2 = min($classementDUT2);
            $maxPromoDUT2 = max($classementDUT2);
            $statPromoDUT2 = array('minimum' => $minPromoDUT2, 'maximum' => $maxPromoDUT2, "moyenne" => round($moyennePromoDUT2, 3));
        }

        $pathFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'classementDUTEtudiants.json';

        self::trieClassement($clasementDut1);
        self::trieClassement($classementDUT2);
        $result['stats_DUT_1'] = $statPromoDUT1;
        $result['classement_DUT_1'] = $clasementDut1;
        if (!empty($statPromoDUT2)) {
            $result['stats_DUT_2'] = $statPromoDUT2;
            $result['classement_DUT_2'] = $classementDUT2;
        }
        //Convert updated array to JSON
        $jsondata = json_encode($result, JSON_PRETTY_PRINT);
        //open or create the file
        $handle = fopen($pathFile, 'w+');
        fwrite($handle, $jsondata);

        fclose($handle);
    }


    public static function classementEtudiantsUEs($year)
    {

        $anneeCourante = $year . '-' . ($year + 1);
        $uesJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneUEstudiants.json';

        $jsondata = file_get_contents($uesJsonFile);
        $arr_data = json_decode($jsondata, true);

        $listeEtu = array_keys($arr_data);


        $minUE11 = isset($arr_data[$listeEtu[0]][0]['moyenne']) ? $arr_data[$listeEtu[0]][0]['moyenne'] : null;

        $minUE12 = isset($arr_data[$listeEtu[0]][1]['moyenne']) ? $arr_data[$listeEtu[0]][1]['moyenne'] : null;
        $minUE21 = isset($arr_data[$listeEtu[0]][2]['moyenne']) ? $arr_data[$listeEtu[0]][2]['moyenne'] : null;
        $minUE22 = isset($arr_data[$listeEtu[0]][3]['moyenne']) ? $arr_data[$listeEtu[0]][3]['moyenne'] : null;
        $minUE31 = isset($arr_data[$listeEtu[0]][4]['moyenne']) ? $arr_data[$listeEtu[0]][4]['moyenne'] : null;
        $minUE32 = isset($arr_data[$listeEtu[0]][5]['moyenne']) ? $arr_data[$listeEtu[0]][5]['moyenne'] : null;
        $minUE33 = isset($arr_data[$listeEtu[0]][6]['moyenne']) ? $arr_data[$listeEtu[0]][6]['moyenne'] : null;
        $minUE41_IPI = isset($arr_data[$listeEtu[0]][7]['moyenne']) ? $arr_data[$listeEtu[0]][7]['moyenne'] : null;
        $minUE42_IPI = isset($arr_data[$listeEtu[0]][8]['moyenne']) ? $arr_data[$listeEtu[0]][8]['moyenne'] : null;
        $minUE43_IPI = isset($arr_data[$listeEtu[0]][9]['moyenne']) ? $arr_data[$listeEtu[0]][9]['moyenne'] : null;
        $minUE41_PEL = isset($arr_data[$listeEtu[0]][10]['moyenne']) ? $arr_data[$listeEtu[0]][10]['moyenne'] : null;
        $minUE42_PEL = isset($arr_data[$listeEtu[0]][11]['moyenne']) ? $arr_data[$listeEtu[0]][11]['moyenne'] : null;
        $minUE43_PEL = isset($arr_data[$listeEtu[0]][12]['moyenne']) ? $arr_data[$listeEtu[0]][12]['moyenne'] : null;
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
        $maxUE41_IPI = 0;
        $moyenneUE41_IPI = 0;
        $nbUE41_IPI = 0;
        $classementUE41_IPI = array();
        $maxUE42_IPI = 0;
        $moyenneUE42_IPI = 0;
        $nbUE42_IPI = 0;
        $classementUE42_IPI = array();
        $maxUE43_IPI = 0;
        $moyenneUE43_IPI = 0;
        $nbUE43_IPI = 0;
        $classementUE43_IPI = array();

        $maxUE41_PEL = 0;
        $moyenneUE41_PEL = 0;
        $nbUE41_PEL = 0;
        $classementUE41_PEL = array();
        $maxUE42_PEL = 0;
        $moyenneUE42_PEL = 0;
        $nbUE42_PEL = 0;
        $classementUE42_PEL = array();
        $maxUE43_PEL = 0;
        $moyenneUE43_PEL = 0;
        $nbUE43_PEL = 0;
        $classementUE43_PEL = array();

        $i = 0;
        foreach ($arr_data as $data) {
            self::testcompare2(isset($data[0]['moyenne']) ? $data[0]['moyenne'] : null, $minUE11, $maxUE11, $moyenneUE11, $nbUE11);
            self::testcompare2(isset($data[1], $data) ? $data[1]['moyenne'] : null, $minUE12, $maxUE12, $moyenneUE12, $nbUE12);
            self::testcompare2(isset($data[2], $data) ? $data[2]['moyenne'] : null, $minUE21, $maxUE21, $moyenneUE21, $nbUE21);
            self::testcompare2(isset($data[3], $data) ? $data[3]['moyenne'] : null, $minUE22, $maxUE22, $moyenneUE22, $nbUE22);
            self::testcompare2(isset($data[4], $data) ? $data[4]['moyenne'] : null, $minUE31, $maxUE31, $moyenneUE31, $nbUE31);;
            self::testcompare2(isset($data[5], $data) ? $data[5]['moyenne'] : null, $minUE32, $maxUE32, $moyenneUE32, $nbUE32);
            self::testcompare2(isset($data[6], $data) ? $data[6]['moyenne'] : null, $minUE33, $maxUE33, $moyenneUE33, $nbUE33);
            self::testcompare2(isset($data[7], $data) ? $data[7]['moyenne'] : null, $minUE41_IPI, $maxUE41_IPI, $moyenneUE41_IPI, $nbUE41_IPI);
            self::testcompare2(isset($data[8], $data) ? $data[8]['moyenne'] : null, $minUE42_IPI, $maxUE42_IPI, $moyenneUE42_IPI, $nbUE42_IPI);
            self::testcompare2(isset($data[9], $data) ? $data[9]['moyenne'] : null, $minUE43_IPI, $maxUE43_IPI, $moyenneUE43_IPI, $nbUE43_IPI);
            self::testcompare2(isset($data[10], $data) ? $data[10]['moyenne'] : null, $minUE41_PEL, $maxUE41_PEL, $moyenneUE41_PEL, $nbUE41_PEL);
            self::testcompare2(isset($data[11], $data) ? $data[11]['moyenne'] : null, $minUE42_PEL, $maxUE42_PEL, $moyenneUE42_PEL, $nbUE42_PEL);
            self::testcompare2(isset($data[12], $data) ? $data[12]['moyenne'] : null, $minUE43_PEL, $maxUE43_PEL, $moyenneUE43_PEL, $nbUE43_PEL);


            $classementUE11[$listeEtu[$i]] = isset($data[0]['moyenne']) ? $data[0]['moyenne'] : null;
            $classementUE12[$listeEtu[$i]] = isset($data[1]['moyenne']) ? $data[1]['moyenne'] : null;
            $classementUE21[$listeEtu[$i]] = isset($data[2]['moyenne']) ? $data[2]['moyenne'] : null;
            $classementUE22[$listeEtu[$i]] = isset($data[3]['moyenne']) ? $data[3]['moyenne'] : null;
            $classementUE31[$listeEtu[$i]] = isset($data[4]['moyenne']) ? $data[4]['moyenne'] : null;
            $classementUE32[$listeEtu[$i]] = isset($data[5]['moyenne']) ? $data[5]['moyenne'] : null;
            $classementUE33[$listeEtu[$i]] = isset($data[6]['moyenne']) ? $data[6]['moyenne'] : null;
            $classementUE41_IPI[$listeEtu[$i]] = isset($data[7]['moyenne']) ? $data[7]['moyenne'] : null;
            $classementUE42_IPI[$listeEtu[$i]] = isset($data[8]['moyenne']) ? $data[8]['moyenne'] : null;
            $classementUE43_IPI[$listeEtu[$i]] = isset($data[9]['moyenne']) ? $data[9]['moyenne'] : null;
            $classementUE41_PEL[$listeEtu[$i]] = isset($data[10]['moyenne']) ? $data[10]['moyenne'] : null;
            $classementUE42_PEL[$listeEtu[$i]] = isset($data[11]['moyenne']) ? $data[11]['moyenne'] : null;
            $classementUE43_PEL[$listeEtu[$i]] = isset($data[12]['moyenne']) ? $data[12]['moyenne'] : null;
            $i++;

        }

        arsort($classementUE11);
        arsort($classementUE12);
        arsort($classementUE21);
        arsort($classementUE22);
        arsort($classementUE31);
        arsort($classementUE32);
        arsort($classementUE33);
        arsort($classementUE41_IPI);
        arsort($classementUE42_IPI);
        arsort($classementUE43_IPI);
        arsort($classementUE43_PEL);
        arsort($classementUE43_PEL);
        arsort($classementUE43_PEL);
        self::trieClassement($classementUE11);
        self::trieClassement($classementUE12);
        self::trieClassement($classementUE21);
        self::trieClassement($classementUE22);
        self::trieClassement($classementUE31);
        self::trieClassement($classementUE32);
        self::trieClassement($classementUE33);
        self::trieClassement($classementUE41_IPI);
        self::trieClassement($classementUE42_IPI);
        self::trieClassement($classementUE43_IPI);
        self::trieClassement($classementUE43_PEL);
        self::trieClassement($classementUE43_PEL);
        self::trieClassement($classementUE43_PEL);

        $statsUEs = array();

        $statsUEs['stats_UE11'] = array("minimum" => $minUE11, "maximum" => $maxUE11, "moyenne" => round($moyenneUE11 / (empty($nbUE11) ? 1 : $nbUE11), 3));
        $statsUEs['stats_UE12'] = array("minimum" => $minUE12, "maximum" => $maxUE12, "moyenne" => round($moyenneUE12 / (empty($nbUE12) ? 1 : $nbUE12), 3));
        $statsUEs['stats_UE21'] = array("minimum" => $minUE21, "maximum" => $maxUE21, "moyenne" => round($moyenneUE21 / (empty($nbUE21) ? 1 : $nbUE21), 3));
        $statsUEs['stats_UE22'] = array("minimum" => $minUE22, "maximum" => $maxUE22, "moyenne" => round($moyenneUE22 / (empty($nbUE22) ? 1 : $nbUE22), 3));
        $statsUEs['stats_UE31'] = array("minimum" => $minUE31, "maximum" => $maxUE31, "moyenne" => round($moyenneUE31 / (empty($nbUE31) ? 1 : $nbUE31), 3));
        $statsUEs['stats_UE32'] = array("minimum" => $minUE32, "maximum" => $maxUE32, "moyenne" => round($moyenneUE32 / (empty($nbUE32) ? 1 : $nbUE32), 3));
        $statsUEs['stats_UE33'] = array("minimum" => $minUE33, "maximum" => $maxUE33, "moyenne" => round($moyenneUE33 / (empty($nbUE33) ? 1 : $nbUE33), 3));
        $statsUEs['stats_UE41_S4_IPI'] = array("minimum" => $minUE41_IPI, "maximum" => $maxUE41_IPI, "moyenne" => round($moyenneUE41_IPI / (empty($nbUE41_IPI) ? 1 : $nbUE41_IPI), 3));
        $statsUEs['stats_UE42_S4_IPI'] = array("minimum" => $minUE42_IPI, "maximum" => $maxUE42_IPI, "moyenne" => round($moyenneUE42_IPI / (empty($nbUE42_IPI) ? 1 : $nbUE42_IPI), 3));
        $statsUEs['stats_UE43_S4_IPI'] = array("minimum" => $minUE43_IPI, "maximum" => $maxUE43_IPI, "moyenne" => round($moyenneUE43_IPI / (empty($nbUE43_IPI) ? 1 : $nbUE43_IPI), 3));
        $statsUEs['stats_UE41_S4_PEL'] = array("minimum" => $minUE41_PEL, "maximum" => $maxUE43_PEL, "moyenne" => round($moyenneUE41_PEL / (empty($nbUE41_PEL) ? 1 : $nbUE41_PEL), 3));
        $statsUEs['stats_UE42_S4_PEL'] = array("minimum" => $minUE42_PEL, "maximum" => $maxUE42_PEL, "moyenne" => round($moyenneUE42_PEL / (empty($nbUE42_PEL) ? 1 : $nbUE42_PEL), 3));
        $statsUEs['stats_UE43_S4_PEL'] = array("minimum" => $minUE43_PEL, "maximum" => $maxUE43_PEL, "moyenne" => round($moyenneUE42_PEL / (empty($nbUE43_PEL) ? 1 : $nbUE43_PEL), 3));


        $statsUEs['rang_UE11'] = $classementUE11;
        $statsUEs['rang_UE12'] = $classementUE12;
        $statsUEs['rang_UE21'] = $classementUE21;
        $statsUEs['rang_UE22'] = $classementUE22;
        $statsUEs['rang_UE31'] = $classementUE31;
        $statsUEs['rang_UE32'] = $classementUE32;
        $statsUEs['rang_UE33'] = $classementUE33;
        $statsUEs['rang_UE41_S4_IPI'] = $classementUE41_IPI;
        $statsUEs['rang_UE42_S4_IPI'] = $classementUE42_IPI;
        $statsUEs['rang_UE43_S4_IPI'] = $classementUE43_IPI;
        $statsUEs['rang_UE41_S4_PEL'] = $classementUE41_PEL;
        $statsUEs['rang_UE42_S4_PEL'] = $classementUE42_PEL;
        $statsUEs['rang_UE43_S4_PEL'] = $classementUE43_PEL;


        $arr_data['stats_UES'] = $statsUEs;

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
        $listeEtu = array_keys($arr_data);

        $minS1 = isset($arr_data[$listeEtu[0]][0]['S1']) ? $arr_data[$listeEtu[0]][0]['S1'] : null;
        $minS2 = isset($arr_data[$listeEtu[0]][1]['S2']) ? $arr_data[$listeEtu[0]][1]['S2'] : null;
        $minS3 = isset($arr_data[$listeEtu[0]][2]['S3']) ? $arr_data[$listeEtu[0]][2]['S3'] : null;
        $minS4_IPI = isset($arr_data[$listeEtu[0]][3]['S4_IPI']) ? $arr_data[$listeEtu[0]][2]['S4_IPI'] : null;
        $minS4_PEL = isset($arr_data[$listeEtu[0]][4]['S4_PEL']) ? $arr_data[$listeEtu[0]][4]['S4_PEL'] : null;
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
        $maxS4_PEL = 0;
        $moyenneS4_PEL = 0;
        $nbS4_PEL = 0;

        $classementS1 = array();
        $classementS2 = array();
        $classementS3 = array();
        $classementS4_IPI = array();
        $classementS4_PEL = array();
        $i = 0;
        foreach ($arr_data as $data) {
            self::testcompare2(isset($data[0]['S1']) ? $data[0]['S1'] : null, $minS1, $maxS1, $moyenneS1, $nbSemestre1);
            self::testcompare2(isset($data[1]['S2']) ? $data[1]['S2'] : null, $minS2, $maxS2, $moyenneS2, $nbSemestre2);
            self::testcompare2(isset($data[2]['S3']) ? $data[2]['S3'] : null, $minS3, $maxS3, $moyenneS3, $nbSemestre3);
            self::testcompare2(isset($data[3]['S4_IPI']) ? $data[2]['S4_IPI'] : null, $minS4_IPI, $maxS4_IPI, $moyenneS4_IPI, $nbS4_IPI);
            $classementS1[$listeEtu[$i]] = isset($data[0]['S1']) ? $data[0]['S1'] : null;
            $classementS2[$listeEtu[$i]] = isset($data[1]['S2']) ? $data[1]['S2'] : null;
            $classementS3[$listeEtu[$i]] = isset($data[2]['S3']) ? $data[2]['S3'] : null;
            $classementS4_IPI[$listeEtu[$i]] = isset($data[3]['S4_IPI']) ? $data[2]['S4_IPI'] : null;
            $classementS4_PEL[$listeEtu[$i]] = isset($data[3]['S4_PEL']) ? $data[2]['S4_PEL'] : null;

            $i++;
        }
        arsort($classementS1);
        arsort($classementS2);
        arsort($classementS3);
        arsort($classementS4_IPI);
        arsort($classementS4_PEL);

        self::trieClassement($classementS1);
        self::trieClassement($classementS2);
        self::trieClassement($classementS3);
        self::trieClassement($classementS4_IPI);
        self::trieClassement($classementS4_PEL);


        $statsSemestre = array();

        $statsSemestre['stats_S1'] = array('minimum' => $minS1, 'maximum' => $maxS1, "moyenne" => round($moyenneS1 / (empty($nbSemestre1) ? 1 : $nbSemestre1), 3));
        $statsSemestre['stats_S2'] = array('minimum' => $minS2, 'maximum' => $maxS2, "moyenne" => round($moyenneS2 / (empty($nbSemestre2) ? 1 : $nbSemestre2), 3));
        $statsSemestre['stats_S3'] = array('minimum' => $minS3, 'maximum' => $maxS3, "moyenne" => round($moyenneS3 / (empty($nbSemestre3) ? 1 : $nbSemestre3), 3));
        $statsSemestre['stats_S4_IPI'] = array('minimum' => $minS4_IPI, 'maximum' => $maxS4_IPI, "moyenne" => round($moyenneS4_IPI / (empty($nbS4_IPI) ? 1 : $nbS4_IPI), 3));
        $statsSemestre['stats_S4_PEL'] = array('minimum' => $minS4_PEL, 'maximum' => $maxS4_PEL, "moyenne" => round($moyenneS4_PEL / (empty($nbS4_PEL) ? 1 : $nbS4_PEL), 3));
        $statsSemestre['rang_S1'] = $classementS1;
        $statsSemestre['rang_S2'] = $classementS2;
        $statsSemestre['rang_S3'] = $classementS3;
        $statsSemestre['rang_S4_IPI'] = $classementS4_IPI;
        $statsSemestre['rang_S4_PEL'] = $classementS4_PEL;

        $arr_data["classement_semestres"] = $statsSemestre;

        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        $handle = fopen($semestreJsonFile, 'w+');

        fwrite($handle, $jsondata);
        fclose($handle);

    }


    public static function testcompare2($value, &$minValue, &$maxValue, &$sum, &$nb)
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

    public static function trieClassement(&$arrayClassement)
    {
        $i = 1;
        foreach ($arrayClassement as &$c) {
            if (isset($c)) {
                $c = $i;
                $i++;
            }
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

    public static function getMoyenneAllStudents($year)
    {
        $anneeCourante = $year . '-' . ($year + 1);
        $semestresJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneSemestreEtudiants.json';

        $dutJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneDUTEtudiants.json';

        $uesJsonFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $anneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . 'moyenneUEstudiants.json';
        self::testUesAffichage('2018', $dutJsonFile, $semestresJsonFile, $uesJsonFile);
        //self::ClassementDutEtudiant($year);
        //self::classementEtudiantsSemestres($year);
        self::classementEtudiantsSemestres($year);

        echo "<br/> vous venez d'importer l'emsemble des résultats des étudiants dans les différents fichiers json";

    }

    public function test()
    {
        jsonController::getMoyenneAllStudents('2018');
    }

    public function testCorrectionClassementUe()
    {
        self::getMoyenneAllStudents('2018');
        self::classementEtudiantsUEs('2018');
        self::classementEtudiantsSemestres('2018');
        self::ClassementDutEtudiant('2018');
    }

}
