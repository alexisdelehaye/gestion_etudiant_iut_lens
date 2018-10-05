<?php
namespace App\Http\Controllers;
use App\Etudiant;
use App\Formation;
use PHPExcel;
use PHPExcel_IOFactory;
use Illuminate\Http\Request;
class EtudiantController extends Controller
{
    public function insertStudiantInDatabase(){
        $excelFile = 'C:\Users\cdcde\Music\PROJET S5 LPDIOC GESTION ETUDIANT\GestionEtudiants2018\projetS5\public\fichierExcel\Bilan_INFO_S3_20162017.xls';
        $sheetname = "Liste";
        $inputFileType = PHPExcel_IOFactory::identify($excelFile);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        /**  Advise the Reader of which WorkSheets we want to load  **/
        $objReader->setLoadSheetsOnly($sheetname);
        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($excelFile);
        $nombreLigneFeuille = $objPHPExcel->getActiveSheet()->getHighestRow();
        echo "nb ligne : ".$objPHPExcel->getActiveSheet()->getHighestRow().PHP_EOL;


        for ($i = 0; $i <= $nombreLigneFeuille; $i++) {
            $numeroEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 2 + $i)->getValue();
            $nomEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 2 + $i)->getValue();
            $prenomEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, 2 + $i)->getValue();
            $groupeEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, 2 + $i)->getValue();
            $dateNaissanceEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, 2 + $i)->getValue();
            $bacEtudiantCourant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, 2 + $i)->getValue();
            $etablissementEtudiantPrécédant = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6, 2 + $i)->getValue();
            $formationCourante = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7, 2 + $i)->getValue();
            $getFormation = Formation::where('nom',$formationCourante)->first();


            $etablissement = str_replace("'"," ", $etablissementEtudiantPrécédant);




            if ($numeroEtudiantCourant != null) {

                if (is_null($getFormation)){
                    $newFormation = new Formation;
                    $newFormation->nom = $formationCourante;
                    $newFormation->save();
                }



                $checkIfstudientExist = Etudiant::where('numEtu',$numeroEtudiantCourant)->first();
                if (is_null($checkIfstudientExist)) {
                    $etudiant = new Etudiant;
                    $etudiant->nom = $nomEtudiantCourant;
                    $etudiant->prenom = $prenomEtudiantCourant;
                    $etudiant->numEtu = $numeroEtudiantCourant;
                    $etudiant->groupe = $groupeEtudiantCourant;
                    $getFormation = Formation::where('nom', $formationCourante)->first();
                    $etudiant->Formation_idFormation = $getFormation->idFormation;
                    $etudiant->save();
                }
            }
        }
    }
}