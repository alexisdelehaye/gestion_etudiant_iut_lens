import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {PageNotFoundComponent} from './page-not-found/page-not-found.component';
import {DetailsPersonneComponent} from './details-personne/details-personne.component';
import {ListePromo1Component} from './liste-promo1/liste-promo1.component';
import {ListePromo2Component} from './liste-promo2/liste-promo2.component';
import {ListeEtudiantsComponent} from './liste-etudiants/liste-etudiants.component';

const routes: Routes = [
  {path: 'promo1', component: ListePromo1Component},
  {path: 'promo2', component: ListePromo2Component},
  {path: 'etudiants', component: ListeEtudiantsComponent},
  {path: 'personne/:id', component: DetailsPersonneComponent},
  {path: '', redirectTo: 'etudiants', pathMatch: 'full'},
  {path: '**', component: PageNotFoundComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
