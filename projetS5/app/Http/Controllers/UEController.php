<?php
/**
 * Created by PhpStorm.
 * User: cdcde
 * Date: 17/10/2018
 * Time: 18:33
 */
namespace App\Http\Controllers;

use App\Matiere;
use App\Semestre;
use App\UE;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;



class UEController extends Controller {

    public static function createIfNotExistsUE($nomUe,$nomSemestre){

        $getSemestre = Semestre::where('nom', $nomSemestre)->first();
        $newUE = new UE;
        $newUE->nomUE = $nomUe;
        $newUE->debut = $getSemestre->debut;
        $newUE->fin = $getSemestre->fin;
        $newUE->Semestre_idSemestre = $getSemestre->idSemestre;
        $newUE->save();
    }

}