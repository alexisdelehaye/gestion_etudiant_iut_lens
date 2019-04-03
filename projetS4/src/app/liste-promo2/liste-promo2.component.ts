import { Component, OnInit } from '@angular/core';
import {Observable} from 'rxjs';
import {Personne} from '../personne-model';
import {PersonnesServiceService} from '../personne.service';
import {ActivatedRoute} from '@angular/router';
import {PERSONNES, PROMO1, PROMO2} from "../mock-personne";

@Component({
  selector: 'app-liste-promo2',
  templateUrl: './liste-promo2.component.html',
  styleUrls: ['./liste-promo2.component.css']
})

export class ListePromo2Component implements OnInit {

  personnes$: Observable<Personne[]>;

  constructor(private route: ActivatedRoute, private personneService: PersonnesServiceService) {
  }


  triNom(){
    PROMO2.sort((n1,n2)=> {
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
    PROMO2.sort((n1,n2) => n1.id - n2.id);
  }

  triS1(){
    PROMO2.sort((n1,n2) => n1.s1 - n2.s1);
  }
  triS2(){
    PROMO2.sort((n1,n2) => n1.s2 - n2.s2);
  }
  triS3(){
    PROMO2.sort((n1,n2) => n1.s3 - n2.s3);
  }
  triS4(){
    PROMO2.sort((n1,n2) => n1.s4 - n2.s4);
  }


  ngOnInit() {
    this.personnes$ = this.personneService.getPromo2();
  }
}
