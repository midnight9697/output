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
}

export const AuthClass = new Authentication();