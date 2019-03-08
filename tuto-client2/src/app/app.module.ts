import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';

import {AppComponent} from './app.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {FileDropModule} from 'ngx-file-drop';
import {HttpClientModule} from '@angular/common/http';
import {FileUploadService} from './file-upload.service';
import {PersonneComponent} from './personne/personne.component';
import {PersonneService} from './personne.service';
import {HttpErrorHandlerService} from './http-error-handler.service';
import {AppRoutingModule} from './app-routing.module';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import {ListePersonnesComponent} from './liste-personnes/liste-personnes.component';
import {NavComponent} from './nav/nav.component';
import {AProposComponent} from './a-propos/a-propos.component';
import {ContactComponent} from './contact/contact.component';
import {DetailsPersonneComponent} from './details-personne/details-personne.component';
import {FormPersonneComponent} from './form-personne/form-personne.component';
import {ModalPersonneComponent} from './modal-personne/modal-personne.component';
import {FontAwesomeModule} from '@fortawesome/angular-fontawesome';
import {MapComponent} from './map/map.component';
import {fab} from '@fortawesome/free-brands-svg-icons';
import {far} from '@fortawesome/free-regular-svg-icons';
import {fas} from '@fortawesome/free-solid-svg-icons';
import {library} from '@fortawesome/fontawesome-svg-core';
import {LeafletModule} from '@asymmetrik/ngx-leaflet';

library.add(fas, far, fab);

@NgModule({
  declarations: [
    AppComponent,
    PersonneComponent,
    ListePersonnesComponent,
    NavComponent,
    AProposComponent,
    ContactComponent,
    DetailsPersonneComponent,
    FormPersonneComponent,
    ModalPersonneComponent,
    MapComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    FileDropModule,
    NgbModule,
    AppRoutingModule,
    FontAwesomeModule,
    LeafletModule.forRoot(),
  ],
  providers: [FileUploadService, PersonneService, HttpErrorHandlerService],
  entryComponents: [ModalPersonneComponent],
  bootstrap: [AppComponent]
})
export class AppModule {
}
