import { Component, OnInit } from '@angular/core';
import {Observable} from 'rxjs';
import {Personne} from '../personne-model';
import {PersonnesServiceService} from '../personne.service';
import {ActivatedRoute, ParamMap} from '@angular/router';

@Component({
  selector: 'app-liste-personnes',
  templateUrl: './liste-personnes.component.html',
  styleUrls: ['./liste-personnes.component.css']
})
export class ListePersonnesComponent implements OnInit {

  personnes$: Observable<Personne[]>;

  constructor(private route: ActivatedRoute, private personneService: PersonnesServiceService) {
  }

  ngOnInit() {
    this.personnes$ = this.personneService.getPersonnes();
  }
}
