class iepmcValidation {
    CreateIEPMCValidation(action, element = 'maintenance_form') {
        var self = this;
        this.form =
        $('.ui.form.'+element)
        .form({
          fields: {},
          onSuccess: action
        });
    }
    
    fieldsRules(identifier, rule, msg = false) {
        let result =   {
            identifier: identifier,
            rules: [{
                type: rule,
            },]
        }

        if (msg != false) {
            result =   {
                identifier: identifier,
                rules: [{
                    type: rule,
                    prompt: msg
                },]
            }
        }
        return result;
    }
}

export const iepmcValidator = new iepmcValidation();