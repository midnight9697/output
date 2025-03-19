class Validator {
    
    StoreUserValidation(users) {
        $.fn.form.settings.rules.uemail = function(value, uemail) {
            return (users.data.filter(el => el.email == value).length == 0);
          };
          $('.ui.form')
          .form({
            fields: {
              firstname     : {
                identifier: 'firstname',
                rules: [{
                  type: 'empty'
                }]
              },
              middlename   : {
                identifier: 'middlename',
                rules: [{
                  type: 'empty'
                }]
              },
              lastname : {
                identifier: 'lastname',
                rules: [{
                  type: 'empty'
                }]
              },
              email : {
                identifier: 'email',
                rules: [{
                    type: 'uemail',
                    prompt: 'Email already used.'
                  }, {
                    type: 'empty',
                    propmt: 'Please enter email.'
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
                  { type: 'minLength[6]'}
                ]
              },
              password_confirmation: {
                identifier: 'password',
                rules: [
                  { type: 'empty'},
                  { type: 'match[password]'}
                ]
              }
            }
          });
    }
}

const GValidator = new Validator();