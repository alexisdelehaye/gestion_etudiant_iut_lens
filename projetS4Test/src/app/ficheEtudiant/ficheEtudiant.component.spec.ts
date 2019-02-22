import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FicheEtudiantComponent } from './ficheEtudiant.component';

describe('FicheEtudiantComponent', () => {
  let component: FicheEtudiantComponent;
  let fixture: ComponentFixture<FicheEtudiantComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FicheEtudiantComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FicheEtudiantComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
