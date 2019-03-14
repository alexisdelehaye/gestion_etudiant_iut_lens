import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ListePromo2Component } from './liste-promo2.component';

describe('ListePromo2Component', () => {
  let component: ListePromo2Component;
  let fixture: ComponentFixture<ListePromo2Component>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ListePromo2Component ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ListePromo2Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
