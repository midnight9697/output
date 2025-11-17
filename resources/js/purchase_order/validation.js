export class Validator {

    constructor() {
        this.items = [];
        this.members = [];
    }
    
    CreatePurchaseOrderValidation(action, element = 'formCreatePurchaseOrder') {
        var self = this;
        $.fn.form.settings.rules['checkItems'] = function(value) {
            return self.items.length > 0;
        };
        this.form =    
        $('.ui.form.'+element)
        .form({
          fields: {
            supplier_name: this.fieldsRules('supplier_name', 'empty'),
          },
          onSuccess: action
        });
    }

    UpdatePurchaseOrderValidation(action, element = 'formUpdatePurchaseOrder') {
        var self = this;
        $.fn.form.settings.rules['checkItems'] = function(value) {
            return self.items.length > 0;
        };
        this.form =    
        $('.ui.form.'+element)
        .form({
          fields: {
            province: this.fieldsRules('PurchaseOrder_province', 'empty'),
            municipality: this.fieldsRules('PurchaseOrder_municipality', 'empty'),
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

export class PurchaseOrderItemValidator {

    CreatePurchaseOrderItemValidation(action) {
        var self = this;
        $.fn.form.settings.rules['checkItems'] = function(value) {
            return self.items.length > 0;
        };

        this.form = 
        $('.ui.form.formCreatePurchaseOrderSpec')
        .form({
          fields: {
            specification: PurchaseOrderValidator.fieldsRules('specification', 'empty'),
            quantity: PurchaseOrderValidator.fieldsRules('quantity', 'empty'),
            total_price: PurchaseOrderValidator.fieldsRules('total_price', 'empty'),
          },
          onSuccess: action
        });
    }
}



export const PurchaseOrderValidator = new Validator();
export const PurchaseOrderSpecsValidation = new PurchaseOrderItemValidator();