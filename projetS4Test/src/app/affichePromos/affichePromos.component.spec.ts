import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AffichePromosComponent } from './affichePromos.component';

describe('AffichePromosComponent', () => {
  let component: AffichePromosComponent;
  let fixture: ComponentFixture<AffichePromosComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AffichePromosComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AffichePromosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
