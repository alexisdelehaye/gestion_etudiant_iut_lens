import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-ficheEtudiant',
  templateUrl: './ficheEtudiant.component.html',
  styleUrls: ['./ficheEtudiant.component.css']
})
export class FicheEtudiantComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }

  etudiantListe = [
    {
      moyenne: 13.34,
      classement: 24,
      moyennePromo: 14,
      promoMax : 12,
      promoMin : 17
    },
    {
      moyenne: 13.34,
      classement: 24,
      moyennePromo: 14,
      promoMax : 12,
      promoMin : 17
    },
    {
      moyenne: 13.34,
      classement: 24,
      moyennePromo: 14,
      promoMax : 12,
      promoMin : 17
    }
  ];
}
