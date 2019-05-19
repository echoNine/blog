import {Component} from '@angular/core';
import {Validators, FormBuilder} from '@angular/forms';
import SignUp from './sign-up'
import {ajax} from "rxjs/ajax";
import {catchError, map} from "rxjs/operators";
import {of} from "rxjs";

@Component({
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css'],
})
export class SignUpComponent {
  constructor(private fb: FormBuilder) {
  }

  profileForm = this.fb.group({
    userName: ['', Validators.required],
    email: ['', Validators.required],
  });

  model = new SignUp("", "");

  get userName() {
    return this.profileForm.get('userName');
  }

  get email() {
    return this.profileForm.get('email');
  }

  onSubmit() {
    const apiData = ajax.post('http://127.0.0.1:8000/user/register', this.model.toJson(), {
      'Content-Type': 'application/json',
    });
    apiData.subscribe(res => console.log(res.status, res.response));

    console.warn(this.profileForm.value);
  }
}
