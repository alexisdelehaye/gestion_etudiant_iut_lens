import { Component, OnInit } from '@angular/core';
import {Observable} from 'rxjs';
import {Personne} from '../personne-model';
import {PersonnesServiceService} from '../personne.service';
import {ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-liste-promo2',
  templateUrl: './liste-promo2.component.html',
  styleUrls: ['./liste-promo2.component.css']
})

export class ListePromo2Component implements OnInit {

  personnes$: Observable<Personne[]>;

  constructor(private route: ActivatedRoute, private personneService: PersonnesServiceService) {
  }

  ngOnInit() {
    this.personnes$ = this.personneService.getPromo2();
  }
}
