import {Injectable} from '@angular/core';
import {Observable, of} from 'rxjs';
import {PERSONNES, PERSONNES2, PROMO1, PROMO2} from './mock-personne';
import {map} from 'rxjs/operators';
import {Personne} from './personne-model';

@Injectable({
  providedIn: 'root'
})
export class PersonnesServiceService {
  constructor() {
  }

  getPromo1(): Observable<Personne[]> {
    return of(PROMO1);
  }
  getPromo2(): Observable<Personne[]> {
    return of(PROMO2);
  }

  getPersonnes(): Observable<Personne[]> {
    return of(PERSONNES);
  }

  findPersonnes(name:string): Observable<Personne[]> {
    let liste : Personne[] = PERSONNES.filter(p => p.nom==name);
    return of(liste);
  }

  getPersonne(id: number | string) {
    return this.getPersonnes().pipe(map(personnes => personnes.find(personne => personne.id === +id)));
  }
}
