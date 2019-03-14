import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {ListePersonnesComponent} from './liste-personnes/liste-personnes.component';
import {ListeTachesComponent} from './liste-taches/liste-taches.component';
import {PageNotFoundComponent} from './page-not-found/page-not-found.component';
import {DetailsPersonneComponent} from './details-personne/details-personne.component';

const routes: Routes = [
  {path: 'personnes', component: ListePersonnesComponent},
  {path: 'personne/:id', component: DetailsPersonneComponent},
  {path: 'liste-taches', component: ListeTachesComponent},
  {path: '', redirectTo: 'personnes', pathMatch: 'full'},
  {path: '**', component: PageNotFoundComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
