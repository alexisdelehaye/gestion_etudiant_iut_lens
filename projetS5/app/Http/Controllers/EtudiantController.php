<?php
namespace App\Http\Controllers;
use App\Etudiant;
use App\Formation;
use App\Semestre;
use Faker\Provider\DateTime;
use PHPExcel;
use PHPExcel_IOFactory;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public static function inscriptionEtudiantInBD($SemestreVoulu, $AnneeVoulue, $fileName)
    {
        $AnneeCourante = $AnneeVoulue . '-' . ($AnneeVoulue + 1);

        $excelFile = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $AnneeCourante . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . "LISTES" . DIRECTORY_SEPARATOR . $fileName;


        $sheetname = "LISTE_" . $SemestreVoulu;
        $inputFileType = PHPExcel_IOFactory::identify($excelFile);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        /**  Advise the Reader of which WorkSheets we want to load  **/
        $objReader->setLoadSheetsOnly($sheetname);
        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($excelFile);
        $nombreLigneFeuille = $objPHPExcel->getActiveSheet()->getHighestRow();
        echo "nb ligne : " . $objPHPExcel->getActiveSheet()->getHighestRow() . PHP_EOL;


        for ($i = 0; $i <= $nombreLigneFeuille; $i++) {
            $numeroEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 2 + $i)->getValue();
            $nomEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 2 + $i)->getValue();
            $prenomEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, 2 + $i)->getValue();
            $groupeEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, 2 + $i)->getValue();

            $formationCourante = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7, 2 + $i)->getValue();
            $getFormation = Formation::where('nom', $formationCourante)->first();

            if ($numeroEtudiantCourant != null) {

                if (is_null($getFormation)) {
                    $newFormation = new Formation;
                    $newFormation->nom = $formationCourante;
                    $newFormation->save();
                }


                $checkIfstudientExist = Etudiant::where('numEtu', $numeroEtudiantCourant)->first();
                if (is_null($checkIfstudientExist)) {
                    $etudiant = new Etudiant;
                    $etudiant->nom = $nomEtudiantCourant;
                    $etudiant->prenom = $prenomEtudiantCourant;
                    $etudiant->numEtu = $numeroEtudiantCourant;
                    $etudiant->groupe = $groupeEtudiantCourant;

                    $getFormation = Formation::where('nom', $formationCourante)->first();

                    $etudiant->Formation_idFormation = $getFormation->idFormation;
                    $idSemestre = Semestre::where('nom', strtoupper($SemestreVoulu))->first();
                    $etudiant->Semestre_idSemestre = $idSemestre->idSemestre;

                    $etudiant->save();
                }
            }


        }
    }


    public function inscriptionEtudiantByCsv($semestre, $anneeDebut)
    {
        $annees = $anneeDebut . '-' . ($anneeDebut + 1);

        $file = public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $annees . DIRECTORY_SEPARATOR . "ADMIN" .
            DIRECTORY_SEPARATOR . "LISTES" . DIRECTORY_SEPARATOR . "INFO_" . $annees . "_ADMIN_LISTES_" . $semestre . '.csv';

        if ($handle = fopen($file, "r") !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $colonnes = count($data);

                if ($colonnes[0] == "Numéro") // si c'est la premiere ligne
                    continue;

                // sinon
                $numero = $colonnes[0];
                $nom = $colonnes[1];
                $prenom = $colonnes[2];
                $groupe = $colonnes[3];
                $naissance = $colonnes[4];
                $bac = $colonnes[5];
                $etablissementPrec = $colonnes[6];
                $formation = $colonnes[7];
                $semestreAct = $colonnes[8];

                echo "$numero, $nom, $prenom, $groupe, $naissance";

            }
            fclose($handle);
        }
    }


    public function CreationArborescenceGenerale()
    {
        $CurrentYear = date('Y');
        echo $CurrentYear . '-' . ($CurrentYear + 1);

        echo public_path();

        if (is_dir(public_path() . DIRECTORY_SEPARATOR . "INFO" . DIRECTORY_SEPARATOR . $CurrentYear . '-' . ($CurrentYear + 1)))
            return;

        $racine = public_path() . DIRECTORY_SEPARATOR . "INFO";

        mkdir($racine . DIRECTORY_SEPARATOR . "INFO1" . DIRECTORY_SEPARATOR . "S1" . DIRECTORY_SEPARATOR . "UE11", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "INFO1" . DIRECTORY_SEPARATOR . "S1" . DIRECTORY_SEPARATOR . "UE12", 0777, true);

        mkdir($racine . DIRECTORY_SEPARATOR . "INFO1" . DIRECTORY_SEPARATOR . "S2" . DIRECTORY_SEPARATOR . "UE21", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "INFO1" . DIRECTORY_SEPARATOR . "S2" . DIRECTORY_SEPARATOR . "UE22", 0777, true);

        mkdir($racine . DIRECTORY_SEPARATOR . "INFO2" . DIRECTORY_SEPARATOR . "S3" . DIRECTORY_SEPARATOR . "UE31", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "INFO2" . DIRECTORY_SEPARATOR . "S3" . DIRECTORY_SEPARATOR . "UE32", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "INFO2" . DIRECTORY_SEPARATOR . "S3" . DIRECTORY_SEPARATOR . "UE33", 0777, true);

        mkdir($racine . DIRECTORY_SEPARATOR . "INFO2" . DIRECTORY_SEPARATOR . "S4" . DIRECTORY_SEPARATOR . "IPI" . DIRECTORY_SEPARATOR . "UE41", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "INFO2" . DIRECTORY_SEPARATOR . "S4" . DIRECTORY_SEPARATOR . "IPI" . DIRECTORY_SEPARATOR . "UE42", 0777, true);

        mkdir($racine . DIRECTORY_SEPARATOR . "INFO2" . DIRECTORY_SEPARATOR . "S4" . DIRECTORY_SEPARATOR . "PEL" . DIRECTORY_SEPARATOR . "UE41", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "INFO2" . DIRECTORY_SEPARATOR . "S4" . DIRECTORY_SEPARATOR . "PEL" . DIRECTORY_SEPARATOR . "UE42", 0777, true);

        mkdir($racine . DIRECTORY_SEPARATOR . "INFO2" . DIRECTORY_SEPARATOR . "S4" . DIRECTORY_SEPARATOR . "ETRANGER", 0777, true);

        mkdir($racine . DIRECTORY_SEPARATOR . "INFO2" . DIRECTORY_SEPARATOR . "S4" . DIRECTORY_SEPARATOR . "UE43", 0777, true);

        mkdir($racine . DIRECTORY_SEPARATOR . "LPDIOC" . DIRECTORY_SEPARATOR . "S5" . DIRECTORY_SEPARATOR . "UE1", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "LPDIOC" . DIRECTORY_SEPARATOR . "S5" . DIRECTORY_SEPARATOR . "UE2", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "LPDIOC" . DIRECTORY_SEPARATOR . "S5" . DIRECTORY_SEPARATOR . "UE3", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "LPDIOC" . DIRECTORY_SEPARATOR . "S5" . DIRECTORY_SEPARATOR . "UE4", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "LPDIOC" . DIRECTORY_SEPARATOR . "S5" . DIRECTORY_SEPARATOR . "UE5", 0777, true);

        mkdir($racine . DIRECTORY_SEPARATOR . "LPDIOC" . DIRECTORY_SEPARATOR . "S6" . DIRECTORY_SEPARATOR . "UE6", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "LPDIOC" . DIRECTORY_SEPARATOR . "S6" . DIRECTORY_SEPARATOR . "UE7", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "LPDIOC" . DIRECTORY_SEPARATOR . "S6" . DIRECTORY_SEPARATOR . "UE8", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "LPDIOC" . DIRECTORY_SEPARATOR . "S6" . DIRECTORY_SEPARATOR . "UE9", 0777, true);

        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "LISTES", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "MATIERES", 0777, true);

        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "TROMBIS" . DIRECTORY_SEPARATOR . "INFO1", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "TROMBIS" . DIRECTORY_SEPARATOR . "INFO2", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "TROMBIS" . DIRECTORY_SEPARATOR . "LPDIOC", 0777, true);

        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "DOCUMENTS" . DIRECTORY_SEPARATOR . "BULLETINS" . DIRECTORY_SEPARATOR . "S1", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "DOCUMENTS" . DIRECTORY_SEPARATOR . "BULLETINS" . DIRECTORY_SEPARATOR . "S2", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "DOCUMENTS" . DIRECTORY_SEPARATOR . "BULLETINS" . DIRECTORY_SEPARATOR . "S3", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "DOCUMENTS" . DIRECTORY_SEPARATOR . "BULLETINS" . DIRECTORY_SEPARATOR . "S4", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "DOCUMENTS" . DIRECTORY_SEPARATOR . "BULLETINS" . DIRECTORY_SEPARATOR . "S5", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "DOCUMENTS" . DIRECTORY_SEPARATOR . "BULLETINS" . DIRECTORY_SEPARATOR . "S6", 0777, true);


        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "DOCUMENTS" . DIRECTORY_SEPARATOR . "JURY", 0777, true);
        mkdir($racine . DIRECTORY_SEPARATOR . "ADMIN" . DIRECTORY_SEPARATOR . "DOCUMENTS" . DIRECTORY_SEPARATOR . "POURSUITES-ETUDES", 0777, true);


    }
}

