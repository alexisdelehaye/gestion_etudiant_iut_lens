import {Component, Input, OnInit} from '@angular/core';
import {Personne} from '../personne';
import {NgbActiveModal} from '@ng-bootstrap/ng-bootstrap';

@Component({
    selector: 'app-modal-personne',
    templateUrl: './modal-personne.component.html',
    styleUrls: ['./modal-personne.component.css']
})
export class ModalPersonneComponent implements OnInit {
    @Input() personne: Personne;

    constructor(public activeModal: NgbActiveModal) {
    }

    ngOnInit() {
    }

}
