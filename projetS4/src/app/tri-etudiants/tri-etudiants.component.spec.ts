import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TriEtudiantsComponent } from './tri-etudiants.component';

describe('TriEtudiantsComponent', () => {
  let component: TriEtudiantsComponent;
  let fixture: ComponentFixture<TriEtudiantsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TriEtudiantsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TriEtudiantsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
