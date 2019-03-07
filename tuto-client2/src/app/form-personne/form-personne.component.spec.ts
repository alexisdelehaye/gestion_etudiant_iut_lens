import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FormPersonneComponent } from './form-personne.component';

describe('FormPersonneComponent', () => {
  let component: FormPersonneComponent;
  let fixture: ComponentFixture<FormPersonneComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FormPersonneComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FormPersonneComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
