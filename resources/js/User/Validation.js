export default class Validator {
    
    StoreUserValidation(users, action) {
        $.fn.form.settings.rules['checkEmailExists'] = function(value) {
            return (users.filter(el => el.email == value).length == 0);
        };
        
        this.form = 
        $('.ui.form')
        .form({
          fields: {
            firstname     : {
              identifier: 'firstname',
              rules: [{
                type: 'empty'
              }]
            },
            lastname : {
              identifier: 'lastname',
              rules: [{
                type: 'empty',
              }]
            },
            email : {
              identifier: 'email',
              rules: [{
                  type: 'checkEmailExists',
                  prompt: 'Email already used.',
                }, {
                  type: 'email',
                  prompt: 'Please enter valid email email.',
                }, {
                  type: 'empty',
                }
              ]
            },
            position : {
              identifier: 'position',
              rules: [{
                type: 'empty'
              }]
            },
            division : {
              identifier: 'division',
              rules: [{
                type: 'empty'
              }]
            },
            section : {
              identifier: 'section',
              rules: [{
                type: 'empty'
              }]
            },
            password: {
              identifier: 'password',
              rules: [
                { type: 'empty'},
                { type: 'minLength[6]'},
                {
                  type: 'match[password_confirmation]',
                  prompt: 'Password does not match'
                }
              ]
            },
            password_confirmation: {
              identifier: 'password',
              rules: [
                { type: 'empty'},
                { 
                  type: 'match[password]',
                  prompt: 'Password does not match'
                }
              ]
            }
          },
          onSuccess: action
        });

    }

    UpdateUserValidation(users, action) {
      $.fn.form.settings.rules['checkEmailExists'] = function(value) {
        return (users.filter(el => el.email == value && localStorage.getItem('user') != el.id).length == 0);
      };
    
      this.form = 
      $('.ui.form')
      .form({
        fields: {
          firstname     : {
            identifier: 'firstname',
            rules: [{
              type: 'empty'
            }]
          },
          lastname : {
            identifier: 'lastname',
            rules: [{
              type: 'empty',
            }]
          },
          email : {
            identifier: 'email',
            rules: [{
                type: 'checkEmailExists',
                prompt: 'Email already used.',
              }, {
                type: 'email',
                prompt: 'Please enter valid email email.',
              }, {
                type: 'empty',
              }
            ]
          },
          position : {
            identifier: 'position',
            rules: [{
              type: 'empty'
            }]
          },
          division : {
            identifier: 'division',
            rules: [{
              type: 'empty'
            }]
          },
          section : {
            identifier: 'section',
            rules: [{
              type: 'empty'
            }]
          },
          password: {
            identifier: 'password',
            rules: [{
                type: 'match[password_confirmation]',
                prompt: 'Password does not match'
              }
            ]
          },
          password_confirmation: {
            identifier: 'password',
            rules: [{
                type: 'match[password]',
                prompt: 'Password does not match'
              }
            ]
          }
        },
        onSuccess: action
      });
    }
}

export const GValidator = new Validator();