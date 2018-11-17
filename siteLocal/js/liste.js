
var notes = [];
var etudiants = [];

function chargerFichier(evt){
	
	var fichiers = evt.target.files;
	var reader = new FileReader();


	for(var i=0; i<fichiers.length; i++){

		

		reader.onload = function(event) { 
			var liste = JSON.parse(reader.result);
			ajouterListe(liste);
		};

		reader.readAsText(fichiers[i]);

		
	}
}

function ajouterListe(liste){
	if(liste == undefined)
		return;

	/* 
		on check si idEtudiant existe :
		si il existe alors c'est la liste d'etu
		sinon c'est la liste des notes
	*/
	if(liste[0].idEtudiant == undefined)
		ajouterNotes(liste);
	else
		ajouterEtudiants(liste);
}

function ajouterEtudiants(liste){

	for(var i=0; i<=liste.length; i++) {
		//document.getElementById('content').innerHTML = liste.nom;

		if(liste[i] == undefined)
			break;

		etudiants[i] = new Array();
		etudiants[i]['idEtudiant'] = liste[i].idEtudiant;
		etudiants[i]['nom'] = liste[i].nom;
		etudiants[i]['prenom'] = liste[i].prenom;
		etudiants[i]['numEtu'] = liste[i].numEtu;
		etudiants[i]['groupe'] = liste[i].groupe;
		etudiants[i]['formation'] = liste[i].formation;
	}

	if(notes.length > 0)
		afficher();

}

function ajouterNotes(liste){
	
	for(var k in liste[0]){
		notes[k] = new Array();
		for(var n in liste[0][k][1]) {
			for(var m in liste[0][k][1][n]){

				notes[k][m] = liste[0][k][1][n][m];
				break;
			}
		}
	}

	if(etudiants.length > 0)
		afficher();
}

function afficher(){
	var str = "<tr><th>Etudiant</th><th>Groupe</th>";

	for(var k in notes){
		for(var m in notes[k]){
			str += "<th>" + m + "</th>";
		}
		break;
	}

	str += "</tr>";


	for(var i = 0; i<etudiants.length; i++) {
		str += "<tr class='ligne'>";
		str += "<td>" + etudiants[i]['nom'] + " ";
		str += etudiants[i]['prenom'] + "</td>";
		str += "<td>" + etudiants[i]['groupe'] + "</td>";

		var num = etudiants[i]['numEtu'];
		for(var k in notes[num]){
			str += "<td>" + notes[num][k] + "</td>";
		}
		str += "</tr>"
	}

	document.getElementById('tableau').innerHTML = str;
}


window.onload = function(){
	document.getElementById('fichier').addEventListener('change', chargerFichier);
}


