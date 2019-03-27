import { Component, OnInit } from '@angular/core';
import {Observable} from 'rxjs';
import { filter } from 'rxjs/operators';
import {Personne} from '../personne-model';
import {PersonnesServiceService} from '../personne.service';
import {ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-liste-etudiants',
  templateUrl: './liste-etudiants.component.html',
  styleUrls: ['./liste-etudiants.component.css']
})
export class ListeEtudiantsComponent implements OnInit {

  personnes$: Observable<Personne[]>;
  private student = {"nom":'', "prenom":''};

  constructor(private route: ActivatedRoute, private personneService: PersonnesServiceService) {
  }


  ngOnInit() {
    this.personnes$ = this.personneService.getPersonnes();
  }

  onSubmit() {
    let nom = this.student.nom;
    let prenom = this.student.prenom;
    if ((this.student.nom.length > 0) && (this.student.prenom.length === 0)) {
       this.personnes$ = this.personneService.findNom(nom);
    } else if ((this.student.prenom.length > 0) && (this.student.nom.length === 0)) {
      this.personnes$ = this.personneService.findPrenom(prenom);
    } else if ((this.student.prenom.length > 0) && (this.student.nom.length > 0)) {
      this.personnes$ = this.personneService.findPersos(nom, prenom);
    } else {
      this.personnes$ = this.personneService.getPersonnes();
    }
  }

}

