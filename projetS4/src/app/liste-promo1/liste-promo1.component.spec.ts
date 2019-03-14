import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ListePromo1Component } from './liste-promo1.component';

describe('ListePromo1Component', () => {
  let component: ListePromo1Component;
  let fixture: ComponentFixture<ListePromo1Component>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ListePromo1Component ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ListePromo1Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
