<?php
namespace App\Http\Controllers;
use App\Etudiant;
use App\Formation;
use Faker\Provider\DateTime;
use PHPExcel;
use PHPExcel_IOFactory;
use Illuminate\Http\Request;
class EtudiantController extends Controller
{
    public static function inscriptionEtudiantInBD($SemestreVoulu,$AnneeVoulue){
        $AnneeCourante = $AnneeVoulue.'-'.($AnneeVoulue+1);
        $excelFile = public_path().'\INFO\\'.$AnneeCourante.'\ADMIN\LISTES\INFO_'.$AnneeCourante.'_ADMIN_LISTES_'.$SemestreVoulu.'.xlsx';
        $sheetname = "LISTE";
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

            echo $formationCourante.PHP_EOL;


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

/*
    public function MiseAjourSemetreEutdiant(Etudiant $etudiant){
    $etudiant

    }
*/



    public function CreationArborescenceGenerale() {
        $CurrentYear =  date('Y');
        echo $CurrentYear.'-'.($CurrentYear+1);


        if (!is_dir(public_path().'\\'.'INFO\\'.$CurrentYear.'-'.($CurrentYear+1))){
            mkdir(public_path().'\INFO\\');

            $DossierPrincipale = 'INFO\\'.$CurrentYear.'-'.($CurrentYear+1);
            mkdir(public_path().'\\'.$DossierPrincipale.'\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO1\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO1\S1\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO1\S1\UE11\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO1\S1\UE12\\');;

            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO1\S2\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO1\S2\UE21\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO1\S2\UE22\\');


            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S3\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S3\UE31\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S3\UE32\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S3\UE33\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S4\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S4\IPI\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S4\IPI\UE41\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S4\IPI\UE42\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S4\PEL\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S4\PEL\UE41\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S4\PEL\UE42\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S4\ETRANGER\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\INFO2\S4\\UE43\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\S5\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\S5\UE1\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\S5\UE2\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\S5\UE3\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\S5\UE4\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\S5\UE5\\');


            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\S6\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\S6\UE6\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\S6\UE7\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\S6\UE8\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\LPDIOC\S6\UE9\\');



            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\LISTES\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\MATIERES\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\TROMBIS\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\TROMBIS\INFO1\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\TROMBIS\INFO2\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\TROMBIS\LPDIOC\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\DOCUMENTS\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\DOCUMENTS\BULLETINS\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\DOCUMENTS\BULLETINS\S1\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\DOCUMENTS\BULLETINS\S2\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\DOCUMENTS\BULLETINS\S3\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\DOCUMENTS\BULLETINS\S4\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\DOCUMENTS\BULLETINS\S5\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\DOCUMENTS\BULLETINS\S6\\');

            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\DOCUMENTS\JURY\\');
            mkdir(public_path().'\\'.$DossierPrincipale.'\ADMIN\DOCUMENTS\POURSUITES-ETUDES\\');

        }

    }

    public function test(){
        EtudiantController::inscriptionEtudiantInBD('S3','2018');
    }
}

