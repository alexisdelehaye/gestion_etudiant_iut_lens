import {Injectable} from '@angular/core';
import {Personne} from './personne';
import {Observable} from 'rxjs';
import {environment} from '../environments/environment';
import {HttpClient} from '@angular/common/http';


@Injectable({
  providedIn: 'root'
})
export class PersonneService {
  private readonly apiUrl = environment.apiUrl;
  private personnesUrl = this.apiUrl + 'personnes';
  private avatarUrl = this.apiUrl + 'avatar';

  constructor(private  http: HttpClient) {

  }

  getPersonnes(): Observable<Personne[]> {
    return this.http.get<any>(this.personnesUrl);

  }

  getPersonne(id: number): Observable<Personne> {
    return this.http.get<any>(this.personnesUrl + '/' + id);
  }

  onCreate(file: File, personne: Personne): Observable<Personne> {
    const formData: FormData = new FormData();
    formData.append('telephone', personne.telephone);
    formData.append('nom', personne.nom);
    formData.append('prenom', personne.prenom);
    if (file) {
      console.log('fichier avatar : ', file.name);
      formData.append('avatar', file, file.name);
    }
    return this.http.post<Personne>(this.personnesUrl, formData);
  }

  onUpdate(personne: Personne, file?: File): Observable<Personne> {
    console.log('Personne pour update : ', personne);
    const formData: FormData = new FormData();
    formData.append('telephone', personne.telephone);
    formData.append('nom', personne.nom);
    formData.append('prenom', personne.prenom);
    formData.append('_method', 'PUT');
    if (file) {
      console.log('fichier avatar : ', file.name);
      formData.append('avatar', file, file.name);
    }
    return this.http.post<Personne>(this.personnesUrl + '/' + personne.id, formData);
  }

  onDelete(id: number): Observable<any> {
    return this.http.delete(this.personnesUrl + '/' + id);
  }
}
