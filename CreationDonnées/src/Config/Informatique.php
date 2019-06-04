<?php
/**
 * Created by PhpStorm.
 * User: hsu
 * Date: 26/05/19
 * Time: 13:31
 */
namespace GestionNotes\Config;

class Informatique {

public static $listeSemestres = array ("s4", "s3", "s2", "s1");
public static $listeUE = array(
    "s4" => ["ue41", "ue42", "ue43"],
    "s3" => ["ue31", "ue32", "ue33"],
    "s2" => ["ue21", "ue22"],
    "s1" => ["ue11", "ue12"]
);
public static $listeMatieres = array(
    "ue11" => ["se", "ap", "sd", "bd", "cdin", "projet"],
    "ue12" => ["md", "alg", "ee", "orga", "fcom", "ai", "ppp"],
    "ue21" => ["se2", "rx", "poo","coo", "ihm", "bd2"],
    "ue22" => ["gl", "an", "ecfjs","gpi", "ecia","ang","ppp"],
    "ue31" => ["se3", "reseaux", "apa", "pweb", "cpa", "bda"],
    "ue32" => ["proba", "modmath", "droits", "gsi", "com", "anglais"],
    "ue33" => ["prodapp", "marathon", "ppp"],
    "ue41" => ["admsr", "compalgo","pfl","archilog","pweb2","pmobile","projet"],
    "ue42" => ["atelier","compmath","com","ro","anglais"],
    "ue43" => ["stage"]
);
}
