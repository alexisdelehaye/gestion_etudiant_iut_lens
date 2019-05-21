import { Injectable } from '@angular/core';
import {Observable, of} from 'rxjs';
import {map} from 'rxjs/operators';
import {Etudiant} from './etudiant-model';
import {ETUDIANTS} from './mock-etudiants';


@Injectable({
  providedIn: 'root'
})
export class EtudiantService {

  constructor() { }

  getPromo(): Observable<Etudiant[]> {
    return of(ETUDIANTS);
  }

}
