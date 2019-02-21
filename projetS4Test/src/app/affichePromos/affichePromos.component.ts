import { Component, OnInit } from '@angular/core';
import {Promotion} from './affichePromos.interface';
import {Router} from "@angular/router";
import {Observable} from "rxjs/Rx";
import {select, Store} from "@ngrx/store";

@Component({
  selector: 'app-affichePromos',
  templateUrl: './affichePromos.component.html',
  styleUrls: ['./affichePromos.component.css']
})
export class AffichePromosComponent implements OnInit {

  public promotions$: Observable<Promotion[]>;
  public  promotionsLoading: Observable<boolean>;

  constructor(private router: Router) {
  }

  ngOnInit() {
  }

  goToafficheEtudiants () {
    this.router.navigateByUrl('/afficheEtudiants');
  }

  promosListe = [
    {
      promo: '2015_2016',
      id: 0
    },
    {
      promo: '2016_2017',
      id: 1
    },{
      promo: '2017_2018',
      id: 2
    }
  ];


}
