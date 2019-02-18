import { Component } from '@angular/core';
import { Router } from "@angular/router";


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'projetS4';
  private router:Router;

  goToPageEtudiants() {
    this.router.navigateByUrl('/page-etudiants');
  }
}
