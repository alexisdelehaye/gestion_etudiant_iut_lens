import { Component, OnInit } from '@angular/core';
import {Observable} from 'rxjs';
import {Personne} from '../personne-model';
import {PersonnesServiceService} from '../personne.service';
import {ActivatedRoute} from '@angular/router';
import {PERSONNES, PROMO1} from "../mock-personne";

@Component({
  selector: 'app-liste-promo1',
  templateUrl: './liste-promo1.component.html',
  styleUrls: ['./liste-promo1.component.css']
})

export class ListePromo1Component implements OnInit {

  personnes$: Observable<Personne[]>;

  constructor(private route: ActivatedRoute, private personneService: PersonnesServiceService) {
  }
  triNom(){
    PROMO1.sort((n1,n2)=> {
      if (n1.nom > n2.nom) {
        return 1;
      }
      if (n1.nom < n2.nom) {
        return -1;
      }
      return 0;
    });
  }
  triId(){
    PROMO1.sort((n1,n2) => n1.id - n2.id);
  }
  ngOnInit() {
    this.personnes$ = this.personneService.getPromo1();
  }
}
