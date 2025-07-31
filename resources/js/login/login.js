import { MessageMod } from "../app";

export class Authentication {
    authenticate(credentials, action) {
        axios({
            method: 'post',
            url: './login/auth',
            data: credentials,
            responseType: 'json',
        }).then(action)
    }

    logout() {
        axios({
            method: 'post',
            url: './login/logout',
            data: {token_id: localStorage.getItem('token_id')},
            responseType: 'json',
        }, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            }
        }).then(() => {
            localStorage.setItem('token_id', null);
            localStorage.setItem('bearer', null);
            window.location.reload();
        });
    }

    forgot_password(action, email) {
        axios({
            method: 'post',
            url: './api/login/forgot_password',
            data: {
                'email': email
            },
            responseType: 'json',
        }).then(action)
    }

    reset_password(action, password) {
        axios({
            method: 'post',
            url: './api/login/reset_password',
            data: {
                'email': localStorage.getItem('email'),
                'password': password,
                
            },
            responseType: 'json',
        }).then(action)
    }
}

export const AuthClass = new Authentication();