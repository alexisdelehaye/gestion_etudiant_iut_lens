import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-affiche-groupe-promo',
  templateUrl: './affiche-groupe-promo.component.html',
  styleUrls: ['./affiche-groupe-promo.component.css']
})
export class AfficheGroupePromoComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }

  groupesPromo = [
    {
      groupe: 'A1',
      id: 1
    },
    {
      groupe: 'A2',
      id: 2
    },
    {
      groupe: 'B1',
      id: 3
    },
    {
      groupe: 'B2',
      id: 4
    },
    {
      groupe: 'C1',
      id: 5
    },
    {
      groupe: 'C2',
      id: 6
    },
  ];

}
