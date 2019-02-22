import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-affichePromos',
  templateUrl: './affichePromos.component.html',
  styleUrls: ['./affichePromos.component.css']
})
export class AffichePromosComponent implements OnInit {

  constructor() { }

  ngOnInit() {  }

  promosListe = [
    {
      promo: '2015_2016',
      id: 0
    },
    {
      promo: '2016_2017',
      id: 1
    },
    {
      promo: '2017_2018',
      id: 2
    }
  ];


}
