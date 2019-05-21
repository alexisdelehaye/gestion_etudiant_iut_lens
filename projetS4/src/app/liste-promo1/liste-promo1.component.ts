import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {Observable} from 'rxjs';
import { trigger,state,style,transition,animate } from '@angular/animations';
import {Etudiant} from '../etudiant-model';
import {EtudiantService} from '../etudiant.service';


@Component({
  selector: 'app-liste-promo1',
  templateUrl: './liste-promo1.component.html',
  styleUrls: ['./liste-promo1.component.css'],
  animations: [
    trigger('rowExpansionTrigger', [
      state('void', style({
        transform: 'translateX(-10%)',
        opacity: 0
      })),
      state('active', style({
        transform: 'translateX(0)',
        opacity: 1
      })),
      transition('* <=> *', animate('400ms cubic-bezier(0.86, 0, 0.07, 1)'))
    ])
  ]
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
      //{ field: 'avatar', header: 'Avatar' },
      { field: 's1', header: 'S1' },
      { field: 's2', header: 'S2' },
      { field: 's3', header: 'S3' },
      { field: 's4', header: 'S4' }
    ];
  }


}
