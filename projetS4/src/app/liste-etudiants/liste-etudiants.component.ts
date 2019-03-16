import { Component, OnInit } from '@angular/core';
import {Observable} from 'rxjs';
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

  constructor(private route: ActivatedRoute, private personneService: PersonnesServiceService) {
  }

  ngOnInit() {
    this.personnes$ = this.personneService.getPersonnes();
  }

}

