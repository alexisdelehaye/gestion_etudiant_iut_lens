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
    // En fonction de la saisise : si l'utilisateur entre une chaine, on recherche, sinon on réinitialise ....
    // Je pense qu'il est possible de faire mieux...
    if (this.student.nom.length > 0  ) {
       let nom = this.student.nom;
       this.personnes$ = this.personneService.findPersonnes(nom);
    } else {
      this.personnes$ = this.personneService.getPersonnes();
    }
  }

}

