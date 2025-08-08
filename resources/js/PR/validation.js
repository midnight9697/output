export class Validator {

    constructor() {
        this.items = ['test'];
    }
    
    CreatePRValidation(action) {
        var self = this;
        $.fn.form.settings.rules['checkItems'] = function(value) {
            return self.items.length > 0;
        };

        this.form = 
        $('.ui.form')
        .form({
          fields: {
            entity_name: this.fieldsRules('entity_name', 'empty'),
            office: this.fieldsRules('office', 'empty'),
            // pr_number: this.fieldsRules('pr_number', 'empty'),
            date: this.fieldsRules('date', 'empty'),
            responsibility_center_code: this.fieldsRules('responsibility_center_code', 'empty'),
            property_number: this.fieldsRules('property_number[]', 'checkItems', 'Please add atleast 1 item'),
            // unit: this.fieldsRules('unit[]', 'empty'),
            // item_description: this.fieldsRules('item_description[]', 'empty'),
            // quantity: this.fieldsRules('quantity[]', 'empty'),
            // unit_cost: this.fieldsRules('unit_cost[]', 'empty'),
            // total_cost: this.fieldsRules('total_cost[]', 'empty'),
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

export const PRValidator = new Validator();