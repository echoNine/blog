import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {SignUpComponent} from "./user/sign-up/sign-up.component";
import {SignInComponent} from "./user/sign-in/sign-in.component";

const routes: Routes = [
  {
    path: "sign_up", component: SignUpComponent
  },
  {
    path: "sign_in", component: SignInComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
