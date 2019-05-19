import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {SignUpComponent} from "./user/sign-up/sign-up.component";
import {ReactiveFormsModule} from "@angular/forms";
import { SignInComponent } from './user/sign-in/sign-in.component';

@NgModule({
  declarations: [
    AppComponent, SignUpComponent, SignInComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
