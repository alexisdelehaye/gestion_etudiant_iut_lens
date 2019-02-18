import {Component, Inject, OnInit} from '@angular/core';
import {Matiere} from "../affichePromos/affichePromos.interface";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {AppState} from "../store/index";
import {Store} from "@ngrx/store";
import {MatiereListModule} from "../store/actions/matiere.action";
import {Router} from "@angular/router";

@Component({
  selector: 'app-afficheEtudiants',
  templateUrl: './afficheEtudiants.component.html',
  styleUrls: ['./afficheEtudiants.component.css']
})
export class AfficheEtudiantsComponent implements OnInit {

  public etudiantForm: FormGroup;

  constructor(private router: Router, @Inject(FormBuilder) fb: FormBuilder, private store: Store<AppState>) {
    this.etudiantForm = fb.group({
      nom: ['', Validators.required],
      prenom: ['', Validators.required]
    });
  }

  ngOnInit() {
  }

}
