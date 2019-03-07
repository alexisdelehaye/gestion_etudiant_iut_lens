import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { PersonneService } from './personne.service';
import {FontAwesomeModule} from '@fortawesome/angular-fontawesome';

import {fab} from '@fortawesome/free-brands-svg-icons';
import {far} from '@fortawesome/free-regular-svg-icons';
import {fas} from '@fortawesome/free-solid-svg-icons';
import {library} from '@fortawesome/fontawesome-svg-core';
import { NavComponent } from './nav/nav.component';
import { PersonneComponent } from './personne/personne.component';
import { ListePersonnesComponent } from './liste-personnes/liste-personnes.component';
import { DetailsPersonneComponent } from './details-personne/details-personne.component';
import { AProposComponent } from './a-propos/a-propos.component';
import { ContactComponent } from './contact/contact.component';
import { FormPersonneComponent } from './form-personne/form-personne.component';
import {FileDropModule} from 'ngx-file-drop';
import { ModalPersonneComponent } from './modal-personne/modal-personne.component';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';

library.add(fas, far, fab);

@NgModule({
  declarations: [
    AppComponent,
    NavComponent,
    PersonneComponent,
    ListePersonnesComponent,
    DetailsPersonneComponent,
    AProposComponent,
    ContactComponent,
    FormPersonneComponent,
    ModalPersonneComponent
  ],
  imports: [
    BrowserModule,
    FontAwesomeModule,
    AppRoutingModule,
    FileDropModule,
    NgbModule
  ],
  providers: [PersonneService],
  entryComponents: [ModalPersonneComponent],
  bootstrap: [AppComponent]
})
export class AppModule { }
