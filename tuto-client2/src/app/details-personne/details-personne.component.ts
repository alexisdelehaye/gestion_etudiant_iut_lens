import {AfterViewInit, Component, OnInit, ViewChild} from '@angular/core';
import {PersonneService} from '../personne.service';
import {ActivatedRoute, Router} from '@angular/router';
import {Personne} from '../personne';
import {NgbModal, NgbTabChangeEvent, NgbTabset} from '@ng-bootstrap/ng-bootstrap';
import {ModalPersonneComponent} from '../modal-personne/modal-personne.component';

@Component({
    selector: 'app-details-personne',
    templateUrl: './details-personne.component.html',
    styleUrls: ['./details-personne.component.css']
})
export class DetailsPersonneComponent implements OnInit, AfterViewInit {
    @ViewChild(NgbTabset) tabSet: NgbTabset;

    isLoading: Boolean = false;
    personne: Personne;

    constructor(private  service: PersonneService,
                private router: Router,
                private  route: ActivatedRoute,
                private modalService: NgbModal) {
        this.getPersonneDetail();
    }

    ngOnInit() {
    }

    getPersonneDetail() {
        this.isLoading = true;
        const id = +this.route.snapshot.paramMap.get('id');
        this.service.getPersonne(id)
            .subscribe(personne => {
                this.isLoading = false;
                this.personne = personne;
                console.log('La personne : ', this.personne);
            });
    }

    onTabChange($event: NgbTabChangeEvent) {
        console.log('tabChangeEvent : ', $event);
        if ($event.nextId === 'delete') {
            this.open();
        }
    }

    open() {
        const modalRef = this.modalService.open(ModalPersonneComponent);
        modalRef.componentInstance.personne = this.personne;
        modalRef.result.then((result) => {
            console.log('retour du modal : ', result);
            if (result === 'Valide') {
                this.service.onDelete(this.personne.id).subscribe(res =>
                    this.router.navigate(['/'])
                );

            } else {
                this.tabSet.select('show');
            }
        }, error => this.tabSet.select('show'));
    }

    ngAfterViewInit() {
        console.log('Values on ngAfterViewInit():');
        console.log('NgbTabSet:', this.tabSet);
    }
}
