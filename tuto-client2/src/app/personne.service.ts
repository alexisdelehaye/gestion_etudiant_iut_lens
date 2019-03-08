import {Injectable} from '@angular/core';
import {Personne} from './personne';
import {Observable, of} from 'rxjs';
import {environment} from '../environments/environment';
import {HandleError, HttpErrorHandlerService} from './http-error-handler.service';
import {HttpClient} from '@angular/common/http';
import {catchError, map, tap} from 'rxjs/operators';
import {maListe} from './maListe';

@Injectable({
    providedIn: 'root'
})
export class PersonneService {
    private readonly apiUrl = environment.apiUrl;
    private personnesUrl = this.apiUrl + 'personnes';
    private avatarUrl = this.apiUrl + 'avatar';
    private handleError: HandleError;

    constructor(private  http: HttpClient, private httpErrorHandler: HttpErrorHandlerService) {
        this.handleError =
            httpErrorHandler.createHandleError('PersonnesService');
    }

    getPersonnes(): Observable<Personne[]> {

      let tab: Personne[] = [];

      maListe.forEach((a) => {
        tab.push(new Personne(a.id, a.nom,a.prenom,a.telephone,a.moyenne));
      });
      console.log(tab.length);

      return of(tab).pipe(
        tap(resp => console.log('réponse : ', resp)),
        map(resp => resp)
      );

      /*
       return this.http.get<any>(this.personnesUrl)
            .pipe(
                tap(resp => console.log('réponse : ', resp)),
                map(resp => resp.data),
                catchError(this.handleError('Liste personnes', []))
            );*/

    }

    getPersonne(id: number): Observable<Personne> {
        return this.http.get<any>(this.personnesUrl + '/' + id).pipe(
            tap(resp => console.log('réponse : ', resp)),
            map(resp => resp.data),
            catchError(this.handleError(`Détails personne: ${id}`, {}))
        );
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
        return this.http.post<Personne>(this.personnesUrl, formData)
            .pipe(
                catchError(this.handleError('Create personne', personne))
            );
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
        return this.http.post<Personne>(this.personnesUrl + '/' + personne.id, formData)
            .pipe(
                catchError(this.handleError('Create personne', personne))
            );
    }

    onDelete(id: number): Observable<any> {
        return this.http.delete(this.personnesUrl + '/' + id)
            .pipe(
                catchError(this.handleError('Delete personne', {}))
            );
    }

    sendFile(formData: any) {
        return this.http.post(
            this.avatarUrl, formData).subscribe(
            (response) => {
                console.log(response);
            });
    }


}
