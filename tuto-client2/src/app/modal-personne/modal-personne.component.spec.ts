import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalPersonneComponent } from './modal-personne.component';

describe('ModalPersonneComponent', () => {
  let component: ModalPersonneComponent;
  let fixture: ComponentFixture<ModalPersonneComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalPersonneComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalPersonneComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
