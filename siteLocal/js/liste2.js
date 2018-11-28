
var init = false;


var semestre = 1;

function rechercheNotesSemestre(numeroEtudiant) {

  var notesSemestre;

  moyenneSemestreEtudiants.forEach(function (etu) {
    if(etu[numeroEtudiant] != undefined){
      notesSemestre = etu[numeroEtudiant];
      return;
    }
  });

  if(notesSemestre['S4_IPI'] == 0)
    notesSemestre['S4'] = notesSemestre['S4_PEL'];
  else
    notesSemestre['S4'] = notesSemestre['S4_IPI'];

  return notesSemestre;
}


function ajouterEtudiant (etudiant) {
	// création d'une ligne étudiant  
	// <tr class='ligne'><th>NOM</th><th>PRENOM</th></tr>
	// Remarque : c'est beaucoup plus "propre" de procéder comme ça....
	
  if(!init) {
    var header = document.getElementById("header");

    var thS1 = document.createElement('TH');
    thS1.innerHTML = 'S1';
    header.appendChild(thS1);

    var thS2 = document.createElement('TH');
    thS2.innerHTML = 'S2';
    header.appendChild(thS2);

    var thS3 = document.createElement('TH');
    thS3.innerHTML = 'S3';
    header.appendChild(thS3);

    var thS4 = document.createElement('TH');
    thS4.innerHTML = 'S4';
    header.appendChild(thS4);

    init = true
  }
  

  var nodeTableau = document.getElementById("tableau"); 
  var newTR = document.createElement("TR"); 
  newTR.setAttribute("class","ligne"); 

  var numeroEtu = etudiant["numEtu"];


  var tdNom = document.createElement("TD");
  var aNom = document.createElement("a");
  aNom.setAttribute("href","etudiant.html?etu="+numeroEtu);
  aNom.innerHTML = etudiant["nom"];
  tdNom.appendChild(aNom);
  newTR.appendChild(tdNom);   

  var tdPrenom = document.createElement("TD");
  var aPrenom = document.createElement("a");
  aPrenom.setAttribute("href","etudiant.html?etu="+numeroEtu);
  aPrenom.innerHTML = etudiant["prenom"]; 
  tdPrenom.appendChild(aPrenom);
  newTR.appendChild(tdPrenom);

  var notes = rechercheNotesSemestre(numeroEtu);

  var tdS1 = document.createElement("TD");
  tdS1.innerHTML = notes['S1'];
  newTR.appendChild(tdS1);
  
  var tdS2 = document.createElement("TD");
  tdS2.innerHTML = notes['S2'];
  newTR.appendChild(tdS2);

  var tdS3 = document.createElement("TD");
  tdS3.innerHTML = notes['S3'];
  newTR.appendChild(tdS3);

  var tdS4 = document.createElement("TD");
  tdS4.innerHTML = notes['S4'];
  newTR.appendChild(tdS4);
  
  nodeTableau.appendChild(newTR); 

}


function initialisation () {
  listeEtudiants.forEach (function (etudiant) {
	                          ajouterEtudiant(etudiant);
	                        }
	                      );      
}

function initEventHandlers(element, event, fx) {
    if (element.addEventListener)
        element.addEventListener(event, fx, false);
    else if (element.attachEvent)
        element.attachEvent('on' + event, fx);
} // observe

initEventHandlers(window, 'load', initialisation);
