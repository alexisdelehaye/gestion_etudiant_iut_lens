import { Component, OnInit } from '@angular/core';
import {Observable} from 'rxjs';
import {Personne} from '../personne-model';
import {PersonnesServiceService} from '../personne.service';
import {ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-liste-promo1',
  templateUrl: './liste-promo1.component.html',
  styleUrls: ['./liste-promo1.component.css']
})

export class ListePromo1Component implements OnInit {

  personnes$: Observable<Personne[]>;

  constructor(private route: ActivatedRoute, private personneService: PersonnesServiceService) {
  }

  ngOnInit() {
    this.personnes$ = this.personneService.getPromo1();
  }
}
