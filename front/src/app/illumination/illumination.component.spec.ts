import { ComponentFixture, TestBed } from '@angular/core/testing';

import { IlluminationComponent } from './illumination.component';

describe('IlluminationComponent', () => {
  let component: IlluminationComponent;
  let fixture: ComponentFixture<IlluminationComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ IlluminationComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(IlluminationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
