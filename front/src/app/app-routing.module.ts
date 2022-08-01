import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { IlluminationComponent } from './illumination/illumination.component';

const routes: Routes = [
  
  { path: '', redirectTo: 'illumitation', pathMatch: 'full' },
  { path: 'illumitation', component: IlluminationComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
