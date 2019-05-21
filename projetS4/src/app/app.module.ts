import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';

import { NgbModule} from '@ng-bootstrap/ng-bootstrap';
import { FormsModule, ReactiveFormsModule} from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { DashboardComponent } from './dashboard/dashboard.component';
import { LayoutModule } from '@angular/cdk/layout';
import {
  MatToolbarModule,
  MatButtonModule,
  MatSidenavModule,
  MatIconModule,
  MatListModule,
  MatTab, MatTabsModule
} from '@angular/material';

import {TableModule} from 'primeng/table';

import { PageNotFoundComponent } from './page-not-found/page-not-found.component';

import { DetailsPersonneComponent } from './details-personne/details-personne.component';
import {ListePromo1Component} from './liste-promo1/liste-promo1.component';
import {ListePromo2Component} from './liste-promo2/liste-promo2.component';
import { ListeEtudiantsComponent } from './liste-etudiants/liste-etudiants.component';
import { TestFormulaireComponent } from './test-formulaire/test-formulaire.component';
import { DetailSemestreComponent } from './detail-semestre/detail-semestre.component';


@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,
    PageNotFoundComponent,
    DetailsPersonneComponent,
    ListePromo1Component,
    ListePromo2Component,
    ListeEtudiantsComponent,
    TestFormulaireComponent,
    DetailSemestreComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    NgbModule,
    TableModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    LayoutModule,
    MatToolbarModule,
    MatButtonModule,
    MatSidenavModule,
    MatIconModule,
    MatListModule,
    MatTabsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
