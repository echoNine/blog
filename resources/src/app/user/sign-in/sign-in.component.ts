import {Component, OnInit} from '@angular/core';
import {FormBuilder, Validators} from "@angular/forms";
import {ajax} from "rxjs/ajax";
import SignIn from "./sign-in";

@Component({
  selector: 'app-sign-in',
  templateUrl: './sign-in.component.html',
  styleUrls: ['./sign-in.component.css']
})
export class SignInComponent implements OnInit {
  ngOnInit() {
  }

  constructor(private fb: FormBuilder) {
  }

  profileForm = this.fb.group({
    userName: ['', Validators.required],
    password: ['', Validators.required],
  });

  model = new SignIn("", "");

  get userName() {
    return this.profileForm.get('userName');
  }

  get password() {
    return this.profileForm.get('password');
  }

  onSubmit() {
    const apiData = ajax({
      url: 'http://127.0.0.1:8000/user/login',
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      crossDomain: true,
      body: this.model.toJson(),
      withCredentials: true
    });

    apiData.subscribe(res => console.log(res.status, res.response));

    console.warn(this.profileForm.value);
  }
}
