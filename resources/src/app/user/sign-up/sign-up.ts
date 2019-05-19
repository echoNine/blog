export default class SignUp {
    constructor(
        public userName: string,
        public email: string
    ) {
    }

    toJson () {
        return JSON.stringify({"user_name": this.userName, "email": this.email})
    }
}
