<?php

require './PHPExcel-1.8/Classes/PHPExcel.php';

global $conn;
$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=spartan") or die(pg_last_error());
pg_set_client_encoding($conn, "UNICODE");
ini_set("display_errors", 0);


/**  Create a new Reader of the type defined in $inputFileType  **/
$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
$cacheSettings = array('memoryCacheSize' => '128000MB');
PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);


function AddStudientsToDatabase()
{

    $argv = $_SERVER['argv'];
    $excelFile = $argv[1];
    global $conn;
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

        $etablissement = str_replace("'"," ", $etablissementEtudiantPrécédant);

       // echo "numero de la ligne : ".$i;
       // echo "contenu du numero : ".$numeroEtudiantCourant . PHP_EOL;
        if ($numeroEtudiantCourant != null) {

            // $numeroEtudiantCourant

            $sql = "insert into projets5.Etudiant(numeroEtudiant,nomEtudiant,prenomEtudiant,groupeEtudiant,dateNaissanceEtudiant,bacEtudiant,etablissementEtudiant) values('$numeroEtudiantCourant','$nomEtudiantCourant','$prenomEtudiantCourant','$groupeEtudiantCourant','$dateNaissanceEtudiantCourant','$bacEtudiantCourant','$etablissement')";
           // $test = "insert into projets5.test VALUES  ($numeroEtudiantCourant)";
            pg_query($conn, $sql) ;

        }
    }
}


AddStudientsToDatabase();