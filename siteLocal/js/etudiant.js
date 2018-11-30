function getMoyennes(numeroEtudiant){
    var moyennes = Array();
    moyenneDUTEtudiants.forEach(function (etudiant) {
        if(etudiant[numeroEtudiant] != undefined){
            moyennes = etudiant[numeroEtudiant];
            return;
        }
    });
    var moyennesSemestre;
    moyenneSemestreEtudiants.forEach(function (etu){
        if(etu[numeroEtudiant] != undefined){
            moyennesSemestre = etu[numeroEtudiant];
        }
    })
    moyennes['S1'] = moyennesSemestre['S1'];
    moyennes['S2'] = moyennesSemestre['S2'];
    moyennes['S3'] = moyennesSemestre['S3'];
    if(moyennesSemestre['S4_IPI'] != 0)
        moyennes['S4'] = moyennesSemestre['S4_IPI'];
    else
        moyennes['S4'] = moyennesSemestre['S4_PEL'];
    // format UE a changer
    //var moyennesUE;
    console.log(moyennes);
    return moyennes;
}
function getInfos(numeroEtudiant){
    var info = Array();
    info['classement'] = Array();
    info['stats'] = Array();
    info['classement']['DUT_1'] = classementDUT[0]['classement_DUT_1'][numeroEtudiant];
    info['stats']['DUT_1'] = classementDUT[0]['stats_DUT_1'];
    info['classement']['DUT_2'] = classementDUT[0]['classement_DUT_2'][numeroEtudiant];
    info['stats']['DUT_2'] = classementDUT[0]['stats_DUT_2'];
    var classementSemestres;
    moyenneSemestreEtudiants.forEach(function (value){
        if(value['classement_semestres'] != undefined)
            classementSemestres = value['classement_semestres'];
    });

    info['classement']['S1'] = classementSemestres['rang_S1'][numeroEtudiant];
    info['stats']['S1'] = classementSemestres['stats_S1'];
    info['classement']['S2'] = classementSemestres['rang_S2'][numeroEtudiant];
    info['stats']['S2'] = classementSemestres['stats_S2'];
    info['classement']['S3'] = classementSemestres['rang_S3'][numeroEtudiant];
    info['stats']['S3'] = classementSemestres['stats_S3'];
    info['classement']['S4'] = classementSemestres['rang_S4_IPI'][numeroEtudiant];
    info['stats']['S4'] = classementSemestres['stats_S4_IPI'];
    return info;
}
function genererLignesFormation(numeroEtudiant){
    var lignes = Array();
    var moyennes = getMoyennes(numeroEtudiant);
    var infos = getInfos(numeroEtudiant);
    var parcours = ['DUT_1','S1','S2','DUT_2','S3','S4'];
    var tab = document.getElementById('tableContent');
    for(var i = 0; i < parcours.length; i++){
        var newTr = document.createElement('TR');
        newTr.setAttribute('class','ligne');

        var tdNom = document.createElement('TD');
        tdNom.innerHTML = parcours[i];
        newTr.appendChild(tdNom);
        var tdMoy = document.createElement('TD');
        tdMoy.innerHTML = moyennes[parcours[i]];
        newTr.appendChild(tdMoy);
        var tdClass = document.createElement('TD');
        tdClass.innerHTML = infos['classement'][parcours[i]];
        newTr.appendChild(tdClass);
        var tdMoyPro = document.createElement('TD');
        tdMoyPro.innerHTML = infos['stats'][parcours[i]]['moyenne'];
        newTr.appendChild(tdMoyPro);
        var tdMaxPro = document.createElement('TD');
        tdMaxPro.innerHTML = infos['stats'][parcours[i]]['maximum'];
        newTr.appendChild(tdMaxPro);
        var tdMinPro = document.createElement('TD');
        tdMinPro.innerHTML = infos['stats'][parcours[i]]['minimum'];
        newTr.appendChild(tdMinPro);
        tab.appendChild(newTr);
    }
    return lignes;
}
function genererTableauNotes(numeroEtudiant){
    var lignes = genererLignesFormation(numeroEtudiant);
    var tableau = document.getElementById('tableContent');
    for(var i=0; i<lignes.length; i++) {
        tableau.appendChild(lignes[i]);
    }
}
function trouveEtudiant(numeroEtudiant) {
    var etudiant;
    listeEtudiants.forEach(function(etu) {
        if(etu["numEtu"] == numeroEtudiant){
            etudiant = etu;
            return;
        }
    });
    var nom = document.getElementById('nom');
    nom.innerHTML = etudiant['nom'];

    var prenom = document.getElementById('prenom');
    prenom.innerHTML = etudiant['prenom'];
    var numero = document.getElementById('numEtu');
    numero.innerHTML = numeroEtudiant;
    genererTableauNotes(numeroEtudiant);
}
function initialisation(){

    trouveEtudiant(location.search.split("=")[1]);
}
function initEventHandlers(element, event, fx) {
    if (element.addEventListener)
        element.addEventListener(event, fx, false);
    else if (element.attachEvent)
        element.attachEvent('on' + event, fx);
} // observe
initEventHandlers(window, 'load', initialisation);