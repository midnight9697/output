export default class Validator {
    
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