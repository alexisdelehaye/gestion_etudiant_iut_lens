import {Component, Inject, OnInit} from '@angular/core';

@Component({
  selector: 'app-afficheEtudiants',
  templateUrl: './afficheEtudiants.component.html',
  styleUrls: ['./afficheEtudiants.component.css']
})


export class AfficheEtudiantsComponent implements OnInit {

  constructor() { }

  ngOnInit() { }


  etudiantsListe = [
    {
      id: 0,
      nom: "nom0",
      prenom : "prenom0",
      moyenne :20
    },
    {
      id: 1,
      nom: "nom1",
      prenom : "prenom1",
      moyenne :13
    },
    {
      id: 0,
      nom: "nom2",
      prenom : "prenom2",
      moyenne :3
    }
  ];



}
