var CheckoutViewModel = function(user)
{
    self.timeDelay = 500;
    self.currentStep = ko.observable(1);
    self.currentUser = ko.observableArray([]);
    self.dataBilling = ko.observableArray([]);
    self.dataShipping = ko.observableArray([]);

    self.currentUser(user);

    self.checkElementInput = function(selector)
    {
        if (!$(selector).val()) {
            $(selector).parent().addClass('has-error');
            $(selector).focus();
            return false;
        }

        return true;
    }

    self.preCheckoutStep = function(data, event)
    {
        $('#checkout-button-next').val($('#checkout-button-next').attr('data-text-first'));
        var currentStep = self.currentStep();
        if (currentStep == 3) {
            self.currentStep(2);
            self.activeStepSecond();
        }
        if (currentStep == 2) {
            self.currentStep(1);
            self.activeStepFirst();
        }
    }

    self.nextCheckoutStep = function(data, event)
    {
        var currentStep = self.currentStep();
        if (currentStep === 1) {
            if (!self.checkDataStepFirst()) return;
            self.currentStep(2);
            self.activeStepSecond();
        }
        if (currentStep === 2) {
            if (!self.checkDataStepSecond()) return;
            self.currentStep(3);
            $('#checkout-button-next').val($('#checkout-button-next').attr('data-text-last'));
            self.activeStepThird();
        }
        if (currentStep === 3) {
            $(event.target).parent().parent().submit();
        }
    }

    self.checkDataStepFirst = function(data, event)
    {
        var result = true;
        $('#checkout-step-first .form-group').removeClass('has-error');
        result &= self.checkElementInput('input[id="user_email"]');
        result &= self.checkElementInput('input[id="user_address"]');
        result &= self.checkElementInput('input[id="user_display_name"]');
        result &= self.checkElementInput('input[id="user_phone"]');

        return result;
    }

    self.checkDataStepSecond = function(data, event)
    {
        var result = true;
        $('#checkout-step-second .form-group').removeClass('has-error');
        result &= self.checkElementInput('input[id="billing_email"]');
        result &= self.checkElementInput('input[id="billing_display_name"]');
        result &= self.checkElementInput('input[id="billing_address"]');
        result &= self.checkElementInput('input[id="billing_phone"]');
        result &= self.checkElementInput('input[id="shipping_email"]');
        result &= self.checkElementInput('input[id="shipping_display_name"]');
        result &= self.checkElementInput('input[id="shipping_address"]');
        result &= self.checkElementInput('input[id="shipping_phone"]');

        return result;
    }

    self.activeStepFirst = function(data, event)
    {
        self.currentStep(1);
        $('#checkout-button-next').val($('#checkout-button-next').attr('data-text-first'));
        $('#frontend-checkout-indicator').removeClass('hide');
        setTimeout(function(){
            $('.ui-formwizard-content').addClass('hide');
            $('#checkout-step-first').removeClass('hide');
            $('#frontend-checkout-indicator').addClass('hide');
        }, self.timeDelay);

    }

    self.activeStepSecond = function(data, event)
    {
        $('#checkout-button-next').val($('#checkout-button-next').attr('data-text-first'));
        if (!self.checkDataStepFirst()) return;
        self.currentStep(2);
        $('#frontend-checkout-indicator').removeClass('hide');
        setTimeout(function(){
            $('.ui-formwizard-content').addClass('hide');
            $('#checkout-step-second').removeClass('hide');
            $('#frontend-checkout-indicator').addClass('hide');
        }, self.timeDelay);
    }

    self.activeStepThird = function(data, event)
    {
        if (!self.checkDataStepFirst()) {
            self.currentStep(1);
            self.activeStepFirst();
            return;
        }
        if (!self.checkDataStepSecond()) {
            self.currentStep(2);
            self.activeStepSecond();
            return;
        }
        $('#checkout-button-next').val($('#checkout-button-next').attr('data-text-last'));
        self.currentStep(3);

        var billing = shipping = {};

        billing.email = $('input[id="billing_email"]').val();
        billing.display_name = $('input[id="billing_display_name"]').val();
        billing.address = $('input[id="billing_address"]').val();
        billing.phone = $('input[id="billing_phone"]').val();
        self.dataBilling(billing);
        shipping.email = $('input[id="shipping_email"]').val();
        shipping.display_name = $('input[id="shipping_display_name"]').val();
        shipping.address = $('input[id="shipping_address"]').val();
        shipping.phone = $('input[id="shipping_phone"]').val();
        self.dataShipping(shipping);

        $('#frontend-checkout-indicator').removeClass('hide');
        setTimeout(function(){
            $('.ui-formwizard-content').addClass('hide');
            $('#checkout-step-third').removeClass('hide');
            $('#frontend-checkout-indicator').addClass('hide');
        }, self.timeDelay);
    }
}
