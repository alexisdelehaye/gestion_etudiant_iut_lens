import { Component, OnInit } from '@angular/core';
import {PersonneService} from '../personne.service';
import {Personne} from '../personne';

@Component({
  selector: 'app-liste-personnes',
  templateUrl: './liste-personnes.component.html',
  styleUrls: ['./liste-personnes.component.css']
})
export class ListePersonnesComponent implements OnInit {
  personnes: Personne[];
  isLoading = false;
  service: PersonneService;


  constructor(personneService: PersonneService) {
    this.service = personneService;
  }

  ngOnInit() {
    this.getLesPersonnes();
  }

  getLesPersonnes(): void {
    this.isLoading = true;
    this.service.getPersonnes().subscribe(
      response => this.handleResponse(response),
      error => this.handleError(error));
  }

  protected handleResponse(response: Personne[]) {
    this.isLoading = false;
    this.personnes = response;
    response.forEach(personne => console.log('handle réponse personnes ...', personne));
  }

  protected handleError(error: any) {
    this.isLoading = false;
    console.error(error);
  }

}
