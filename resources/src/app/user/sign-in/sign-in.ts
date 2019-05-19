export default class SignIn {
  constructor(
    public userName: string,
    public password: string
  ) {
  }

  toJson () {
    return JSON.stringify({"user_name": this.userName, "password": this.password})
  }
}
