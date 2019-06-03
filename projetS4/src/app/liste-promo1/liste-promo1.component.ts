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
    //  { field: 'id', header: 'Id' },
      { field: 'nom', header: 'Nom' },
      { field: 'prenom', header: 'Prenom' },
      { field: 'groupe', header: 'Groupe' },
      { field: 'date', header: 'Date' },
      //{ field: 'avatar', header: 'Avatar' },
      { field: 's4', header: 'S4' },
      { field: 'ue41', header: 'UE 41' },
      { field: 'ue42', header: 'UE 42' },
      { field: 'ue43', header: 'UE 43' },
      { field: 's3', header: 'S3' },
      { field: 'ue31', header: 'UE 31' },
      { field: 'ue32', header: 'UE 32' },
      { field: 'ue33', header: 'UE 33' },
      { field: 's2', header: 'S2' },
      { field: 'ue21', header: 'UE 21' },
      { field: 'ue22', header: 'UE 22' },
      { field: 's1', header: 'S1' },
      { field: 'ue11', header: 'UE 11' },
      { field: 'ue12', header: 'UE 12' }
    ];
  }


}
