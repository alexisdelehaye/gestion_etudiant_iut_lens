import {Component, OnInit} from '@angular/core';
import {Personne} from '../personne';

@Component({
    selector: 'app-personne',
    templateUrl: './personne.component.html',
    styleUrls: ['./personne.component.css']
})
export class PersonneComponent implements OnInit {
    personne: Personne= new Personne();


    constructor() {
    }

    ngOnInit() {

    }
}
