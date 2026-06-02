class PSValidation {
    CreatePSValidation(action, element = 'insert-form') {
        var self = this;
        this.form =
        $('.ui.form.'+element)
        .form({
            fields: {
                tentative_date_and_time: this.fieldsRules('tentative_date_and_time', 'empty'),
                public_scoping_location: this.fieldsRules('public_scoping_location', 'empty'),
                project_name: this.fieldsRules('project_name', 'empty'),
                project_proponent: this.fieldsRules('project_proponent', 'empty'),
                project_location: this.fieldsRules('project_location', 'empty'),
                project_description: this.fieldsRules('project_description', 'empty'),
              },
          onSuccess: action
        });
    }

    UpdatePSValidation(action, element = 'update-form') {
        var self = this;
        this.form =
        $('.ui.form.'+element)
        .form({
          fields: {
            tentative_date_and_time: this.fieldsRules('tentative_date_and_time', 'empty'),
            public_scoping_location: this.fieldsRules('public_scoping_location', 'empty'),
            project_name: this.fieldsRules('project_name', 'empty'),
            project_proponent: this.fieldsRules('project_proponent', 'empty'),
            project_location: this.fieldsRules('project_location', 'empty'),
            project_description: this.fieldsRules('project_description', 'empty'),
          },
          onSuccess: action
        });
    }
    
    CreatePHValidation(action, element = 'insert-ph-form') {
        var self = this;
        this.form =
        $('.ui.form.'+element)
        .form({
            fields: {
                tentative_date_and_time: this.fieldsRules('tentative_date_and_time', 'empty'),
                public_hearing_location: this.fieldsRules('public_hearing_location', 'empty'),
                project_name: this.fieldsRules('project_name', 'empty'),
                project_proponent: this.fieldsRules('project_proponent', 'empty'),
                project_location: this.fieldsRules('project_location', 'empty'),
                project_description: this.fieldsRules('project_description', 'empty'),
              },
          onSuccess: action
        });
    }

    UpdatePHValidation(action, element = 'insert-ph-form') {
        var self = this;
        this.form =
        $('.ui.form.'+element)
        .form({
            fields: {
                tentative_date_and_time: this.fieldsRules('tentative_date_and_time', 'empty'),
                public_hearing_location: this.fieldsRules('public_hearing_location', 'empty'),
                project_name: this.fieldsRules('project_name', 'empty'),
                project_proponent: this.fieldsRules('project_proponent', 'empty'),
                project_location: this.fieldsRules('project_location', 'empty'),
                project_description: this.fieldsRules('project_description', 'empty'),
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

export const PScValidator = new PSValidation();
