import { Injectable } from '@angular/core';
import {Observable, of} from 'rxjs';
import {map} from 'rxjs/operators';
import {Etudiant} from './etudiant-model';
// import {ETUDIANTS} from './mock-etudiants';
import {DATA} from "./etudiants-data";


@Injectable({
  providedIn: 'root'
})
export class EtudiantService {
  private etudiants : Etudiant[];
  constructor() {
    let nbEtudiants =0;
    this.etudiants = [];
    for (var id in DATA) {
      console.log("numero "+id);
      nbEtudiants++;
      DATA[id].id = nbEtudiants;
      this.etudiants.push(new Etudiant (DATA[id]));
    }
    console.log("Nb etudiants : "+nbEtudiants);
  }

  getPromo(): Observable<Etudiant[]> {
    //return of(ETUDIANTS);
    return of (this.etudiants);
  }

}
