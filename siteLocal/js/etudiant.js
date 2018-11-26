
function genererLignesFormation(formation, numeroEtudiant){
	var lignes = Array();

	
	

	var moyennes = Array();

	// Recuperation des moyennes de dut de l'etudiant
	var etudiant;
	moyennesDUT.forEach(function (etu) {
		if(etu[numeroEtudiant] != undefined){
			console.log(numeroEtudiant);
			etudiant = etu[numeroEtudiant];
		}
	});

	/*
	Revoir le fichier

	var etuSem;
	moyennesSemestre.forEach(function (etu) {
		if(etu[numeroEtudiant] != undefined){
			console.log(numeroEtudiant);
			etudiant = etu[numeroEtudiant];
		}
	});
	*/


	var etuUE;
	moyennesUE.forEach(function (etu){
		if(etu[numeroEtudiant] != undefined) {
			etuUE = etu[numeroEtudiant];
		}
	});

	console.log(etuUE);

	// parcour DUT
	for(var i=1;i<=2; i++) {

		var ligne = document.createElement('tr');
		ligne.setAttribute("class","ligne"); 

		var dut = document.createElement('td');
		dut.innerHTML = 'DUT_' + i;
		ligne.appendChild(dut);

		var dutMoyenne = document.createElement('td');
		dutMoyenne.innerHTML = etudiant['DUT_'+ i];
		ligne.appendChild(dutMoyenne);

		lignes.push(ligne);

		//parcour Semestre/DUT
		for(var j=1; j<=2; j++){
			var c = 2;
			if(i==1){
				c = 0;
			} 

			ligne = document.createElement('tr');
			ligne.setAttribute("class","ligne"); 

			var sem = document.createElement('td');
			sem.innerHTML = 'S' + (c+j);
			ligne.appendChild(sem);

			/*
			var semMoy = document.createELement('td');
			semMoy.innerHTML = etuSem['S'];
			ligne.appendChild(semMoy);
			*/

			lignes.push(ligne);

			var cpt = 1;
			for(var k=0;k<=100;k++){


				if(etuUE[k] == undefined){
					//console.log(etuUE[k] + " " + k);
					//console.log('UE'+(c+j)+''+cpt);
					break;
				}

				if(etuUE[k]["nomUe"] != 'UE'+(c+j)+''+cpt){
					console.log('UE'+(c+j)+''+cpt);
					continue;
				}

				

				ligne = document.createElement('tr');
				ligne.setAttribute("class","ligne"); 

				var ue = document.createElement('td');
				ue.innerHTML = etuUE[k]["nomUe"];
				ligne.appendChild(ue);

				var noteUE = document.createElement('td');
				noteUE.innerHTML = etuUE[k]["moyenne"];
				ligne.appendChild(noteUE);

				cpt++;
				lignes.push(ligne);
				console.log(etuUE[k]["nomUe"] + " : " + etuUE[k]["moyenne"])
			}
		}
		

		/*
			Ajout de la moyenne dans la ligne
		*/

		lignes.push(ligne);

	}
	return lignes;
}


function genererTableauNotes(numeroEtudiant){
	var lignes = genererLignesFormation("DUT_2",numeroEtudiant);
	

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