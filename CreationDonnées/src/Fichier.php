<?php
/**
 * Created by PhpStorm.
 * User: hsu
 * Date: 23/05/19
 * Time: 11:22
 */

namespace GestionNotes;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

error_reporting(E_ALL);


class Fichier {
   private static  $helper;
   private $tabSheetNames ;
   private $spreadSheet;
   public function __construct ($filename){
       if(! self::$helper) {
           self::$helper = new Sample();
       }
       $inputFileType = 'Xls';
       $inputFileName = __DIR__ . '/../data/'.$filename;

       self::$helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' using IOFactory with a defined reader type of ' . $inputFileType);
       $reader = IOFactory::createReader($inputFileType);
       self::$helper->log('Loading all WorkSheets');
       $reader->setLoadAllSheets();
       $this->spreadsheet = $reader->load($inputFileName);
       self::$helper->log($this->spreadsheet->getSheetCount() . ' worksheet' . (($this->spreadsheet->getSheetCount() == 1) ? '' : 's') . ' loaded');

       $this->tabSheetNames = $this->spreadsheet->getSheetNames();
       foreach ($this->tabSheetNames as $sheetIndex => $loadedSheetName) {
           self::$helper->log($sheetIndex . ' -> ' . $loadedSheetName);
       }


       //$this->spreadsheet->setActiveSheetIndexByName("liste");
       // $currentSheet = $this->spreadsheet->getActiveSheet();
       // $this->lirePromotion("liste");

/*
       $loadedSheetNames = $spreadsheet->getSheetNames();
       foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
           self::$helper->log($sheetIndex . ' -> ' . $loadedSheetName);
           $spreadsheet->setActiveSheetIndexByName($loadedSheetName);
           $currentSheet = $spreadsheet->getActiveSheet();
           $this->lirePromotion($currentSheet);
       }
*/

   }
   public function getSheet ($sheetName) {
       if(in_array($sheetName,$this->tabSheetNames)) {
           $this->spreadsheet->setActiveSheetIndexByName($sheetName);
           return  $this->spreadsheet->getActiveSheet();
       } else {
           self::$helper->log("Erreur getSheet:  ".$sheetName. "n'existe pas");
           system.exit(1);
       }
   }

   public function getLabels($sheetName, $numLine=1 ) {
       $currentSheet=$this->getSheet($sheetName);
       $tabLabels = array();
       $nbElements=1;
       $value = $currentSheet->getCellByColumnAndRow($nbElements, $numLine)->getValue();
       while (strlen($value)>0) {
           self::$helper->log("titre :  ".$value);
           $tabLabels[$nbElements]=strtolower($value);
           $nbElements++;
           $value = $currentSheet->getCellByColumnAndRow($nbElements, $numLine)->getValue();
       }
       self::$helper->log("Nombre de Labels :".$nbElements);
       return $tabLabels;
   }

   public function getIndexLabel ($sheetName, $listLabels, $numLine=1) {
       $allLabels = $this->getLabels($sheetName,$numLine);
       $tabLabels = array();
       foreach ($allLabels as $index => $nameLabel) {
           if (in_array($nameLabel,$listLabels)) {
               $tabLabels[$nameLabel]=$index;
           }
       }
       if(count($listLabels)!=count($tabLabels)) {
           self::$helper->log("Erreur getIndexLabel : numLine=".$numLine );
           self::$helper->log("  Nombre de Labels obtenu :".count($tabLabels));
           print_r($tabLabels);
           self::$helper->log("  Nombre de Labels recherché:".count($listLabels));
           print_r($listLabels);
           system.exit(1);
       }
       // mettre les labels dans le même ordre
       $finalTabLabels = array();
       foreach ($listLabels as $label ) {
           $finalTabLabels[$label]=$tabLabels[$label];
       }
       return $finalTabLabels;
   }

   public function getDataFromSheet ($sheetName, $tabLabels, $nameLabel, $numLine , $excluLabels = [] ) {
       // echo "name Label :".$nameLabel.PHP_EOL;
       $currentSheet=$this->getSheet($sheetName);
       // $numLine = 2;
       $numCol = $tabLabels[$nameLabel];
       $nbData = 0 ;
       $tabData= array();
       $key = $currentSheet->getCellByColumnAndRow($numCol, $numLine)->getCalculatedValue();
       self::$helper->log("key name: ". $key);

       while (strlen($key)>0) {
           if (array_key_exists($key,$tabData)) {
               self::$helper->log(" .......   Erreur duplication numéro: ". $key);
               system.exit(1);
           }
           foreach ($tabLabels as $colName => $currentCol) {
               $value = $currentSheet->getCellByColumnAndRow($currentCol, $numLine)->getCalculatedValue();
               if (! in_array($colName,$excluLabels)) {
                   if ($colName == "nom" || $colName == "prenom") {
                       // utf8_decode($value);
                       $value = strtolower($value);
                   } else if ($colName == "date") {
                       // $value = $currentSheet->getCellByColumnAndRow($currentCol, $numLine)->getValue();
                       // Convertir la date execel en date php
                       $value = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('d-m-Y');
                   }
                   if (is_float($value)) $value = sprintf("%.2f",floatval($value));
                   $tabData[$key][$colName] = $value;
               }
           }
           $nbData++;
           $numLine++;
           $key = $currentSheet->getCellByColumnAndRow($numCol, $numLine)->getCalculatedValue();
       }
       self::$helper->log("Nb Etudiants : ".$nbData);
       echo "       ===== getDataFromSheet====";
       echo json_encode($tabData);
       return $tabData;
   }

   public function getList($sheetName, $labelName, $numLine) {
           // Liste des intitulés
           $labels = $this->getLabels($sheetName);
           $tabLabels = $this->getIndexLabel($sheetName,$labels);
           print_r($tabLabels);

           $list = $this->getDataFromSheet($sheetName, $tabLabels, $labelName, $numLine);
           return $list;
   }



}



// require __DIR__ . '/../Header.php';

