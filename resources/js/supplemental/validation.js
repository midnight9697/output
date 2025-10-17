export class Validator {

    constructor() {
        this.items = [];
        this.members = [];
    }
    
    CreateSupplementalValidation(action, element = 'formCreateSupplemental') {
        var self = this;
        $.fn.form.settings.rules['checkProjects'] = function(value) {
            return self.items.length > 0;
        };
        this.form =
        $('.ui.form.'+element)
        .form({
          fields: {
            title: this.fieldsRules('title', 'empty'),
            projects: this.fieldsRules('projects', 'checkProjects', 'Please add atleast 1 specification'),
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

export class SupplementalProjecValidator {

    constructor() {
        this.items = [];
        this.action = () => {};
    }

    CreateSupplementalProjectValidation(action) {
        this.action = action;
        var self = this;
        $.fn.form.settings.rules['checkItems'] = function(value) {
            return self.items.length > 0;
        };

        this.form = 
        $('.ui.form.formCreateSupplementalSpec')
        .form({
          fields: {
            code: this.fieldsRules('code', 'empty'),
            procurement_project: this.fieldsRules('procurement_project', 'empty'),
            end_user: this.fieldsRules('end_user', 'empty'),
            early_procurement: this.fieldsRules('early_procurement', 'empty'),
            mode_of_procurement: this.fieldsRules('mode_of_procurement', 'empty'),
            source_of_funds: this.fieldsRules('source_of_funds', 'empty'),
            total: this.fieldsRules('total', 'empty'),
            mooe: this.fieldsRules('mooe', 'empty'),
            co: this.fieldsRules('co', 'empty'),
          },
          onSuccess: this.action
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

export const SupplementalValidator = new Validator();
export const SupplementalPojectControl = new SupplementalProjecValidator();