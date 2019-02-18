import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AfficheEtudiantsComponent } from './afficheEtudiants.component';

describe('AfficheEtudiantsComponent', () => {
  let component: AfficheEtudiantsComponent;
  let fixture: ComponentFixture<AfficheEtudiantsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AfficheEtudiantsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AfficheEtudiantsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
