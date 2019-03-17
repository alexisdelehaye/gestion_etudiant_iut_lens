import { Component, OnInit } from '@angular/core';

import {NgForm} from '@angular/forms';

@Component({
  selector: 'app-test-formulaire',
  templateUrl: './test-formulaire.component.html',
  styleUrls: ['./test-formulaire.component.css']
})
export class TestFormulaireComponent implements OnInit {
  private roles = ['Administrateur', 'Editeur', 'Rédacteur', 'Utilisateur'];
  private user = {"name":'Martin', "role":this.roles[1]};

  constructor() { }

  ngOnInit() {
  }
  onSubmit() {
    console.log(this.user);
  }

}
