import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {environment} from "../../environments/environment";
import {Observable} from "rxjs/Rx";
import {Promotion} from "./affichePromos.interface";
import {map} from "rxjs/internal/operators";

@Injectable()
export class AffichePromosService {
  constructor(private http: HttpClient) { }

  getPromotion(): Observable<Promotion[]> {
    // @ts-ignore
    return  this.http.get<Promotion[]>(`${environment.apiUrl}/affichePromos`);
  }

}
