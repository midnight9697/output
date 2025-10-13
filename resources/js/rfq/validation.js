export class Validator {

    constructor() {
        this.items = [];
        this.members = [];
    }
    
    CreateRFQValidation(action, element = 'formCreateRFQ') {
        var self = this;
        $.fn.form.settings.rules['checkItems'] = function(value) {
            return self.items.length > 0;
        };
        this.form =    
        $('.ui.form.'+element)
        .form({
          fields: {
            project_purpose: this.fieldsRules('project_purpose', 'empty'),
            attachment_one: this.fieldsRules('attachment_one', 'empty'),
            classification: this.fieldsRules('classification', 'empty'),
            approved_budget: this.fieldsRules('approved_budget', 'empty'),
            standard_unit: this.fieldsRules('standard_unit', 'empty'),
            target_delivery_date: this.fieldsRules('target_delivery_date', 'empty'),
            specification: this.fieldsRules('specification', 'checkItems', 'Please add atleast 1 specification'),
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

    serializeArrayToJson(formElement) {
        let json = {};
        $(formElement).serializeArray().forEach(data => {
            json[data.name] = data.value;
        });

        return json;
    }
}

export class RFQItemValidator {

    CreateRFQItemValidation(action) {
        var self = this;
        $.fn.form.settings.rules['checkItems'] = function(value) {
            return self.items.length > 0;
        };

        this.form = 
        $('.ui.form.formCreateRFQSpec')
        .form({
          fields: {
            specification: RFQValidator.fieldsRules('specification', 'empty'),
            quantity: RFQValidator.fieldsRules('quantity', 'empty'),
            total_price: RFQValidator.fieldsRules('total_price', 'empty'),
          },
          onSuccess: action
        });
    }
}
export const RFQValidator = new Validator();
export const RFQSpecsValidation = new RFQItemValidator();