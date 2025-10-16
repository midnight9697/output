class appValidation {
    CreateAPPValidation(action, element = 'formCreatePPMP') {
        var self = this;
        $.fn.form.settings.rules['checkProjects'] = function(value) {
            return self.items.length > 0;
        };
        this.form =
        $('.ui.form.'+element)
        .form({
          fields: {
            files: this.fieldsRules('files', 'empty', 'Please upload atleast 1 file'),
          },
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

export const appValidator = new appValidation();