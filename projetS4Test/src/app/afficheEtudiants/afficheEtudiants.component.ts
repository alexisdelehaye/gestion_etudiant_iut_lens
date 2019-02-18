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

}
