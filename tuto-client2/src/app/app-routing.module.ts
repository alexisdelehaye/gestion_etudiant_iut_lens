import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {PersonneComponent} from './personne/personne.component';
import {ListePersonnesComponent} from './liste-personnes/liste-personnes.component';
import {ContactComponent} from './contact/contact.component';
import {AProposComponent} from './a-propos/a-propos.component';
import {DetailsPersonneComponent} from './details-personne/details-personne.component';

const routes: Routes = [
  {path: 'create', component: PersonneComponent},
  {path: 'personnes', component: ListePersonnesComponent},
  {path: 'personnes/:id', component: DetailsPersonneComponent},
  {path: 'contact', component: ContactComponent},
  {path: 'apropos', component: AProposComponent},
  {
    path: '',
    redirectTo: '/personnes',
    pathMatch: 'full'
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
