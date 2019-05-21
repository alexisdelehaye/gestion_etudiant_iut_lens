import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {Observable} from 'rxjs';
import {Etudiant} from '../etudiant-model';
import {EtudiantService} from '../etudiant.service';


@Component({
  selector: 'app-liste-promo1',
  templateUrl: './liste-promo1.component.html',
  styleUrls: ['./liste-promo1.component.css']
})

export class ListePromo1Component implements OnInit {
  private loading : boolean=false;
  etudiants$: Etudiant[];
  cols: any[];

  constructor(private service: EtudiantService) {
  }

  ngOnInit() {

    this.loading = true;
    this.service.getPromo().subscribe(etudiants => {
      this.etudiants$ = etudiants;
      this.loading = false;
    });
    console.log("Liste promo1")
    console.log(this.etudiants$);
    this.cols = [
      { field: 'id', header: 'Id' },
      { field: 'nom', header: 'Nom' },
      { field: 'prenom', header: 'Prenom' },
      { field: 'avatar', header: 'Avatar' }
    ];
  }


}
