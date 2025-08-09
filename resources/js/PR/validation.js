export class Validator {

    constructor() {
        this.items = [];
    }
    
    CreatePRValidation(action) {
        var self = this;
        $.fn.form.settings.rules['checkItems'] = function(value) {
            return self.items.length > 0;
        };

        this.form = 
        $('.ui.form.createpr')
        .form({
          fields: {
            entity_name: this.fieldsRules('entity_name', 'empty'),
            fund_cluster: this.fieldsRules('fund_cluster', 'empty'),
            office: this.fieldsRules('office', 'empty'),
            date: this.fieldsRules('date', 'empty'),
            responsibility_center_code: this.fieldsRules('responsibility_center_code', 'empty'),
            items: this.fieldsRules('items', 'checkItems', 'Please add atleast 1 item'),
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


export class PRItemValidator {

    CreatePRItemValidation(action) {
        var self = this;
        $.fn.form.settings.rules['checkItems'] = function(value) {
            return self.items.length > 0;
        };

        this.form = 
        $('.ui.form.formCreatePRItem')
        .form({
          fields: {
            // property_number: PRValidator.fieldsRules('property_number', 'empty'),
            unit: PRValidator.fieldsRules('unit', 'empty'),
            item_description: PRValidator.fieldsRules('item_description', 'empty'),
            quantity: PRValidator.fieldsRules('quantity', 'empty'),
            unit_cost: PRValidator.fieldsRules('unit_cost', 'empty'),
            total_cost: PRValidator.fieldsRules('total_cost', 'empty'),
          },
          onSuccess: action
        });
    }
}
export const PRValidator = new Validator();
export const PRVItemalidator = new PRItemValidator();