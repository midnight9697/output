class abstractBidValidation {
    
    CreateAbstractValidation(action, element = 'form-create-abstract') {
        var self = this;

        $.fn.form.settings.rules['rfqs'] = function(value) {
            return $('.ui.dropdown.rfqs').dropdown('get value').length > 0;
        };

        this.form =
        $('.ui.form.'+element)
        .form({
          fields: {
            purpose: this.fieldsRules('purpose', 'empty'),
            quotation: this.fieldsRules('quotation', 'rfqs', 'Please select at least 1 RFQ.'),
          },
          onSuccess: action
        });
    }

    CreateAbstractBidValidation(action, element = 'form-abstract-bid') {
        var self = this;
        $.fn.form.settings.rules['checkProjects'] = function(value) {
            return self.items.length > 0;
        };
        this.form =
        $('.ui.form.'+element)
        .form({
          fields: {
            unit_price: this.fieldsRules('unit_price', 'empty'),
            unit_cost: this.fieldsRules('unit_cost', 'empty'),
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

export const abstractBidValidator = new abstractBidValidation();