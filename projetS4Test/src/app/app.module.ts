import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { LayoutModule } from '@angular/cdk/layout';
import { MatToolbarModule, MatButtonModule, MatSidenavModule, MatIconModule, MatListModule, MatTableModule, MatPaginatorModule, MatSortModule, MatGridListModule, MatCardModule, MatMenuModule } from '@angular/material';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import { RouterModule, Routes } from '@angular/router';
import {HttpClientModule} from "@angular/common/http";
import { AffichePromosComponent } from './affichePromos/affichePromos.component';
import { AfficheEtudiantsComponent } from './afficheEtudiants/afficheEtudiants.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {ToastrModule} from "ngx-toastr";
import {ConfirmationPopoverModule} from "angular-confirmation-popover";
import {environment} from "../environments/environment";
import {StoreDevtoolsModule} from "@ngrx/store-devtools";
import { FicheEtudiantComponent } from './ficheEtudiant/ficheEtudiant.component';
import { AfficheGroupePromoComponent } from './affiche-groupe-promo/affiche-groupe-promo.component';

const appRoutes: Routes = [
  { path: '', redirectTo: '/affichePromos', pathMatch: 'full' },
  { path: 'affichePromos', component: AffichePromosComponent },
  { path: 'afficheEtudiants', component: AfficheEtudiantsComponent },
  { path: 'ficheEtudiant', component: FicheEtudiantComponent },
  { path: 'affiche-groupe-promo', component: AfficheGroupePromoComponent }
];

@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,
    AffichePromosComponent,
    AfficheEtudiantsComponent,
    FicheEtudiantComponent,
    AfficheGroupePromoComponent,
  ],
  imports: [
    BrowserModule,
    LayoutModule,
    MatToolbarModule,
    MatButtonModule,
    MatSidenavModule,
    MatIconModule,
    MatListModule,
    BrowserAnimationsModule,
    MatTableModule,
    MatPaginatorModule,
    MatSortModule,
    MatGridListModule,
    MatCardModule,
    MatMenuModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    StoreDevtoolsModule.instrument({
      name: '[TODOLIST]',
      maxAge: 25, // Retains last 25 states
      logOnly: environment.production // Restrict extension to log-only mode
    }),
    RouterModule.forRoot(appRoutes),
    ToastrModule.forRoot(),
    FormsModule,
    ConfirmationPopoverModule.forRoot({
      confirmButtonType: 'danger' // set defaults here
    })
  ],
  providers: [
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
