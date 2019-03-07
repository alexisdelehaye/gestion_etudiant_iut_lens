import { Component, OnInit } from '@angular/core';
import {Title} from '@angular/platform-browser';


@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.css']
})
export class NavComponent implements OnInit {

  constructor(private titleTagService: Title) { }

  public setTitle(pageTitle: string) {
    this.titleTagService.setTitle(pageTitle);
  }

  ngOnInit() {
  }

}
