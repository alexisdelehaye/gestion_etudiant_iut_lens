import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DetailSemestreComponent } from './detail-semestre.component';

describe('DetailSemestreComponent', () => {
  let component: DetailSemestreComponent;
  let fixture: ComponentFixture<DetailSemestreComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DetailSemestreComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DetailSemestreComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
