import { Component, OnInit } from '@angular/core';
import {Observable} from 'rxjs';
import { filter } from 'rxjs/operators';
import {Personne} from '../personne-model';
import {PersonnesServiceService} from '../personne.service';
import {ActivatedRoute} from '@angular/router';
import {PERSONNES} from '../mock-personne';

@Component({
  selector: 'app-tri-etudiants',
  templateUrl: './tri-etudiants.component.html',
  styleUrls: ['./tri-etudiants.component.css']
})
export class TriEtudiantsComponent implements OnInit {

  personnes$: Observable<Personne[]>;
  private student = {"nom":'', "prenom":''};

  prenom: string;

  personnes : Personne[] = PERSONNES.sort((n1,n2)=> {
    if (n1.nom > n2.nom) {
      return 1;
    }
    if (n1.nom < n2.nom) {
      return -1;
    }
    return 0;
  });

  constructor(private route: ActivatedRoute, private personneService: PersonnesServiceService) {
  }


  ngOnInit() {
    this.personnes$ = this.personneService.getPersonnes();
  }


  onSubmit() {
    let nom = this.student.nom;
    let prenom = this.student.prenom;
    if ((this.student.nom.length > 0) && (this.student.prenom.length === 0)) {
      this.personnes$ = this.personneService.findNom(nom);
    } else if ((this.student.prenom.length > 0) && (this.student.nom.length === 0)) {
      this.personnes$ = this.personneService.findPrenom(prenom);
    } else if ((this.student.prenom.length > 0) && (this.student.nom.length > 0)) {
      this.personnes$ = this.personneService.findPersos(nom, prenom);
    } else {
      this.personnes$ = this.personneService.getPersonnes();
    }
  }


  Search() {
    if ((this.student.nom.length > 0) && (this.student.prenom.length === 0)) {
      this.personnes = this.personnes.filter(res => {
        return res.nom.toLocaleLowerCase().match(this.student.nom.toLocaleLowerCase());
      });
    } else if ((this.student.prenom.length > 0) && (this.student.nom.length === 0)) {
      this.personnes = this.personnes.filter(res => {
        return res.prenom.toLocaleLowerCase().match(this.student.prenom.toLocaleLowerCase());
      });
    } else if ((this.student.prenom.length > 0) && (this.student.nom.length > 0)) {
      this.personnes = this.personnes.filter(res => {
        return res.prenom.toLocaleLowerCase().match(this.student.prenom.toLocaleLowerCase());
      });
      this.personnes = this.personnes.filter(res => {
        return res.nom.toLocaleLowerCase().match(this.student.nom.toLocaleLowerCase());
      });
    } else {
      this.personnes = PERSONNES;
    }
    /*

    let liste: Personne[] = PERSONNES.filter(p => p.nom.toLocaleLowerCase().match(nom.toLocaleLowerCase()));
    liste = liste.filter(p => p.prenom.toLocaleLowerCase().match(prenom.toLocaleLowerCase()));
    return of(liste);
  }


    this.personnes = this.personnes.filter(res => {
      return res.prenom.toLocaleLowerCase().match(this.prenom.toLocaleLowerCase());
    });
    */
  }


}

