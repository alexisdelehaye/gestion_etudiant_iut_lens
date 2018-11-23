function ajouterEtudiant (etudiant) {
	// création d'une ligne étudiant  
	// <tr class='ligne'><th>NOM</th><th>PRENOM</th></tr>
	// Remarque : c'est beaucoup plus "propre" de procéder comme ça....
	
  var nodeTableau = document.getElementById("tableau"); 
  var newTR = document.createElement("TR"); 
  newTR.setAttribute("class","ligne"); 

  var tdNom = document.createElement("TD");
  tdNom.innerHTML = etudiant["nom"]; 
  newTR.appendChild(tdNom);   

  var tdPrenom = document.createElement("TD");
  tdPrenom.innerHTML = etudiant["prenom"]; 
  newTR.appendChild(tdPrenom);
  
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
