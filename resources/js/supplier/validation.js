export class Validator {

    constructor() {
        this.items = [];
        this.members = [];
    }
    
    CreateSupplierValidation(action, element = 'formCreateSupplier') {
        var self = this;
        $.fn.form.settings.rules['checkItems'] = function(value) {
            return self.items.length > 0;
        };
        this.form =    
        $('.ui.form.'+element)
        .form({
          fields: {
            province: this.fieldsRules('supplier_province', 'empty'),
            municipality: this.fieldsRules('supplier_municipality', 'empty'),
            barangay: this.fieldsRules('supplier_barangay', 'empty'),
            supplier_name: this.fieldsRules('supplier_name', 'empty'),
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

export class SupplierItemValidator {

    CreateSupplierItemValidation(action) {
        var self = this;
        $.fn.form.settings.rules['checkItems'] = function(value) {
            return self.items.length > 0;
        };

        this.form = 
        $('.ui.form.formCreateSupplierSpec')
        .form({
          fields: {
            specification: SupplierValidator.fieldsRules('specification', 'empty'),
            quantity: SupplierValidator.fieldsRules('quantity', 'empty'),
            total_price: SupplierValidator.fieldsRules('total_price', 'empty'),
          },
          onSuccess: action
        });
    }
}
export const SupplierValidator = new Validator();
export const SupplierSpecsValidation = new SupplierItemValidator();