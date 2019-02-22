import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AfficheGroupePromoComponent } from './affiche-groupe-promo.component';

describe('AfficheGroupePromoComponent', () => {
  let component: AfficheGroupePromoComponent;
  let fixture: ComponentFixture<AfficheGroupePromoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AfficheGroupePromoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AfficheGroupePromoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
