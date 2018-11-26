
// trouver un moyen de retirer les compteurs
var cpt = 0;
var cptMat = 0

var semestre = 1;

// generer une liste des matieres par semestre en JSON ?
var matieres = ["SE-3","RX-2","APA","Pweb-1","CPA"];

function ajouterEtudiant (etudiant) {
	// création d'une ligne étudiant  
	// <tr class='ligne'><th>NOM</th><th>PRENOM</th></tr>
	// Remarque : c'est beaucoup plus "propre" de procéder comme ça....
	

  var header = document.getElementById("header");
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

  

  matieres.forEach(function(matiere){
    if(cpt == 0) {
      //Ajout entete
      var trMat = document.createElement("TH");
      trMat.innerHTML = matiere;
      header.appendChild(trMat);
    }

    var tdNote = document.createElement("TD");
    tdNote.innerHTML = notes[cpt][numeroEtu][semestre][cptMat][matiere];
    newTR.appendChild(tdNote);
    cptMat++;
  })

  cptMat = 0;
  console.log(notes[cpt][numeroEtu][1][0]["SE-3"]);
  
  
  nodeTableau.appendChild(newTR);    
  cpt++;

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
