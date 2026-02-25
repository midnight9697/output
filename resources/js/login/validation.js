import { AuthClass } from "./login";

export default class Validator {
    
    loginValidation(success) {
      $('#loginForm')
      .form({
        fields: {
          email: {
            identifier: 'email',
            rules: [
              {
                type: 'empty',
                prompt: 'Please enter your email'
              },
              {
                type: 'email',
                prompt: 'Please enter a valid email address'
              }
            ]
          },
          password: {
            identifier: 'password',
            rules: [
              {
                type: 'empty',
                prompt: 'Please enter your password'
              },
              {
                type: 'minLength[6]',
                prompt: 'Your password must be at least 6 characters'
              }
            ]
          }
        },
        onSuccess: success,
        onFailure: function(e) {
          const dimmer = $('#loginSegment .ui.dimmer');
            $('#loginSegment').dimmer('hide', { silent: true }).promise().done(() => {
              dimmer.removeClass('blinking').addClass('failure');
            });
          return false;
        }
      });
    }

    passwordResetValidation(action) {
        this.form = 
        $('.ui.form')
        .form({
          fields: {
            email     : {
              identifier: 'email',
              rules: [{
                    type: 'empty',
                }, {
                    type: 'email'
                }]
            }
          },
          onSuccess: action
        });
    }

    passwordChangeValidation(action) {
        
        this.form = 
        $('.ui.form')
        .form({
            fields: {
              password: {
              identifier: 'password',
              rules: [{
                      type: 'match[password_confirmation]',
                      prompt: 'Password does not match'
                  }, {
                    type: 'empty',
                    prompt: 'Password confirmation must have a value'
                  }
              ]},
              password_confirmation: {
                identifier: 'password',
                rules: [{
                    type: 'match[password]',
                    prompt: 'Password does not match'
                  }, {
                    type: 'empty'
                  }
                ]
              }
            },
            onSuccess: action
        });
    }
}

export const GValidator = new Validator();