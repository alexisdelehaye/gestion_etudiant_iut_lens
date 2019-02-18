import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { StoreModule } from '@ngrx/store';

import { AppComponent } from './app.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { LayoutModule } from '@angular/cdk/layout';
import { MatToolbarModule, MatButtonModule, MatSidenavModule, MatIconModule, MatListModule, MatTableModule, MatPaginatorModule, MatSortModule, MatGridListModule, MatCardModule, MatMenuModule } from '@angular/material';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import { RouterModule, Routes } from '@angular/router';
import {HttpClientModule} from "@angular/common/http";
import { AffichePromosComponent } from './affichePromos/affichePromos.component';
import {AffichePromosService} from "./affichePromos/affichePromos.service";
import { AfficheEtudiantsComponent } from './afficheEtudiants/afficheEtudiants.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {ToastrModule} from "ngx-toastr";
import {ConfirmationPopoverModule} from "angular-confirmation-popover";
import {environment} from "../environments/environment";
import {StoreDevtoolsModule} from "@ngrx/store-devtools";
import {EffectsModule} from "@ngrx/effects";
import {appEffects, getReducers, REDUCER_TOKEN} from "./store/index";

const appRoutes: Routes = [
  { path: '', redirectTo: '/matiere', pathMatch: 'full' },
  { path: 'matiere', component: AffichePromosComponent },
  { path: 'afficheEtudiants', component: AfficheEtudiantsComponent }
];

@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,
    AffichePromosComponent,
    AfficheEtudiantsComponent,
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
    StoreModule.forRoot(REDUCER_TOKEN),
    EffectsModule.forRoot(appEffects),
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
  providers: [{
      provide: REDUCER_TOKEN,
      useFactory: getReducers
    },
    AffichePromosService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
