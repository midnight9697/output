export class Authentication {
    authenticate(credentials, action) {
        axios({
            method: 'post',
            url: './login/auth',
            data: credentials,
            responseType: 'json',
        }).then(action);
    }

    logout() {
        axios({
            method: 'post',
            url: './login/logout',
            data: {token_id: localStorage.getItem('token_id')},
            responseType: 'json',
        }).then(() => {
            localStorage.setItem('token_id', null);
            localStorage.setItem('bearer', null);
            window.location = 'login';
        });
    }
}

export const AuthClass = new Authentication();