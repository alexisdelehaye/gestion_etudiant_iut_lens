import { Component, OnInit } from '@angular/core';
import {Observable} from "rxjs";
import {Personne} from "../personne-model";
import {ActivatedRoute, ParamMap} from "@angular/router";
import {PersonnesServiceService} from "../personne.service";
import {switchMap} from "rxjs/operators";

@Component({
  selector: 'app-detail-semestre',
  templateUrl: './detail-semestre.component.html',
  styleUrls: ['./detail-semestre.component.css']
})
export class DetailSemestreComponent implements OnInit {

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
