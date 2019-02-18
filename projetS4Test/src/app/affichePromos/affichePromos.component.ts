import { Component, OnInit } from '@angular/core';
import {Matiere} from './affichePromos.interface';
import {Router} from "@angular/router";
import {Observable} from "rxjs/Rx";
import {AppState} from "../store/index";
import {select, Store} from "@ngrx/store";
import {MatiereListModule} from "../store/actions/matiere.action";
import {selectMatiereListEntitiesConverted$, selectMatieresLoading$} from "../store/selectors/matiere.selector";

@Component({
  selector: 'app-matieres',
  templateUrl: './affichePromos.component.html',
  styleUrls: ['./affichePromos.component.css']
})
export class AffichePromosComponent implements OnInit {

  public matieres$: Observable<Matiere[]>;
  public  matieresLoading: Observable<boolean>;

  constructor(private router: Router, private store: Store<AppState>) {
    this.matieres$ = store
      .pipe(select(selectMatiereListEntitiesConverted$));

    this.matieresLoading = store.pipe(select(selectMatieresLoading$));
  }

  ngOnInit() {
    this.store.dispatch(new  MatiereListModule.LoadInitMatieres());
  }

  goToAddMatiere () {
    this.router.navigateByUrl('/afficheEtudiants');
  }


}
