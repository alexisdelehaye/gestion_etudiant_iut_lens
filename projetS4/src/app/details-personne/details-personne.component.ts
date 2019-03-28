import { Component, OnInit } from '@angular/core';
import {Personne} from '../personne-model';
import {ActivatedRoute, ParamMap} from '@angular/router';
import {Observable} from 'rxjs';
import {switchMap} from 'rxjs/operators';
import {PersonnesServiceService} from '../personne.service';

@Component({
  selector: 'app-details-personne',
  templateUrl: './details-personne.component.html',
  styleUrls: ['./details-personne.component.css']
})
export class DetailsPersonneComponent implements OnInit {
  personne$: Observable<Personne>;

  constructor(private route: ActivatedRoute,
              private service: PersonnesServiceService) { }

  ngOnInit() {
    this.personne$ = this.route.paramMap.pipe (
      switchMap((params: ParamMap) =>
        this.service.getPersonne(params.get('id')))
    );
  }


}
