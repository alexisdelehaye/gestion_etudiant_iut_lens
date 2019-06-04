<?php
/**
 * Created by PhpStorm.
 * User: hsu
 * Date: 26/05/19
 * Time: 11:08
 */

namespace GestionNotes;
use GestionNotes\Fichier;
use GestionNotes\Config\Informatique;


class Promotion {
    private $fileList;
    private $fileNotes;
    private $studentList; // La liste des étudiants
    private $avgNotesList;   // La liste des moyennes
    public function __construct($fileList, $fileNotes) {
        $this->fileList = new Fichier($fileList);
        $this->fileNotes = new Fichier($fileNotes);
    }
    public function getList($sheetName,$labelName, $numLine) {
        $this->studentList =  $this->fileList->getList($sheetName,$labelName, $numLine);
        return $this->studentList;
    }

    public function getStudentList () {
        return $this->studentList;
    }

    public function getMoyenneNotes($sheetName, $labelName, $labelLine, $dataLine) {
        $startLabelLine = $labelLine;
        $startDataLine = $dataLine;
        // $listLabels = $this->fileNotes->getLabels($sheetName,$startLabelLine);
        // $listLabels = ["numero","s3","ue31","se3","réseaux","ue32","proba","modmath","anglais"];

        $listLabels = Informatique::$listeUE[$labelName];
        array_unshift($listLabels,"numero",$labelName);

        $tabLabels= $this->fileNotes->getIndexLabel($sheetName,$listLabels,$startLabelLine);
        print_r($tabLabels);
        $this->avgNotesList = $this->fileNotes->getDataFromSheet($sheetName, $tabLabels, "numero", $startDataLine, ["numero"]);
        return $this->avgNotesList;
    }

    public function getNotes($sheetName, $labelUE, $labelLine, $dataLine) {
        $startLabelLine = $labelLine;
        $startDataLine = $dataLine;
        // $listLabels = $this->fileNotes->getLabels($sheetName,$startLabelLine);
        // $listLabels = ["numero","s3","ue31","se3","réseaux","ue32","proba","modmath","anglais"];

        $listLabels = Informatique::$listeMatieres[$labelUE];
        array_unshift($listLabels,"numero");

        $tabLabels= $this->fileNotes->getIndexLabel($sheetName,$listLabels,$startLabelLine);
        print_r($tabLabels);
        $this->notesList = $this->fileNotes->getDataFromSheet($sheetName, $tabLabels, "numero", $startDataLine, ["numero"]);
        return $this->notesList;
    }


    public function attributeNotesToStudent() {
        foreach ($this->studentList as $num => $content) {
            if (! array_key_exists($num,$this->avgNotesList)) {
               echo " ..... Attention pas de notes pour ". $content["nom"];
               system.exit(1);
            }
            foreach ($this->avgNotesList[$num] as $label => $value) {
                $this->studentList[$num][$label] = $value;
            }
        }
        echo json_encode($this->studentList["20170588"]);
    }

    public function attributeDetailNotesToStudent ($ref, $semester, $ue, $isNullNotTake=false) {
        foreach ($this->studentList as $num => $content) {
            if (! array_key_exists($num,$this->notesList)) {
                echo " ..... Attention pas de notes pour ". $content["nom"];
                system.exit(1);
            }
            if(! array_key_exists($ref,$this->studentList[$num]) ) $this->studentList[$num][$ref]=array();
            if(! array_key_exists($semester,$this->studentList[$num][$ref])) $this->studentList[$num][$ref][$semester]=array();
            if(! array_key_exists($ue,$this->studentList[$num][$ref][$semester]))$this->studentList[$num][$ref][$semester][$ue]=array();
            foreach ($this->notesList[$num] as $label => $value) {
                //$this->studentList[$num][$label] = $value;
                if ($isNullNotTake) { // si c'est une matière du semestre 4 ...
                    if ($value) $this->studentList[$num][$ref][$semester][$ue][$label] = $value;
                } else $this->studentList[$num][$ref][$semester][$ue][$label] = $value;
            }
        }
        //echo json_encode($this->studentList["20171317"]);
        echo json_encode($this->studentList["20164210"],JSON_FORCE_OBJECT|JSON_UNESCAPED_UNICODE);

        // addslashes(json_encode($array,JSON_FORCE_OBJECT|JSON_UNESCAPED_UNICODE));

    }

/*

$notes = new Fichier("notes.xls");
$listLabels = $notes->getLabels("S3",3);
$listLabels = ["numero","s3","ue31","se3","réseaux","ue32","proba","modmath","anglais"];
$tabLabels= $notes->getIndexLabel("S3",$listLabels,3);
print_r($tabLabels);
$data = $notes->getDataFromSheet("S3", $tabLabels, "numero", 5);
print_r($data);
*/

}