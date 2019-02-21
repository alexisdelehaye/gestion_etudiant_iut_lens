import {Component, Inject, OnInit} from '@angular/core';
import {Promotion} from "../affichePromos/affichePromos.interface";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Store} from "@ngrx/store";
import {Router} from "@angular/router";

@Component({
  selector: 'app-afficheEtudiants',
  templateUrl: './afficheEtudiants.component.html',
  styleUrls: ['./afficheEtudiants.component.css']
})
export class AfficheEtudiantsComponent implements OnInit {

  public etudiantForm: FormGroup;

  constructor(private router: Router, @Inject(FormBuilder) fb: FormBuilder) {
    this.etudiantForm = fb.group({
      nom: ['', Validators.required],
      prenom: ['', Validators.required]
    });
  }

  ngOnInit() {
  }

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
      id: 2,
      nom: "nom2",
      prenom : "prenom2",
      moyenne :3
    }
  ];

}
