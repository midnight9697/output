export class Authentication {
    authenticate(credentials, action) {
        axios({
            method: 'post',
            url: './login/auth',
            data: credentials,
            responseType: 'json',
        }).then(action);
    }
}

export const AuthClass = new Authentication();