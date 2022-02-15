function Validator(option) {
    function handleSubmit(form) {
        form.submit();
    }
    function validate(inputElement, rule) {
        var formError = inputElement.closest('.form__feild').querySelector('.form__mess-error')

        var messError = rule.test(inputElement.value)
        if(messError) {
            formError.innerText = messError
            inputElement.closest('.form__feild').classList.add('error')
        } else {
            formError.innerText = ''
            inputElement.closest('.form__feild').classList.remove('error')
        }
        return !messError;
    }

    formElement = document.querySelector(option.form)

    option.rules.forEach(function(rule) {
        var inputElement = formElement.querySelector(rule.selector)
        var formError = inputElement.closest('.form__feild').querySelector('.form__mess-error')
        
        if(inputElement) {
            inputElement.onblur = function() {
                validate(inputElement, rule)
            }
            inputElement.oninput = function() {
                formError.innerText = ""
                inputElement.closest('.form__feild').classList.add('error')
            }
        }
    })

    formElement.onsubmit = function (e) {
        e.preventDefault();
        var isFromValid = true;
        option.rules.forEach(function(rule) {
            var inputElement = formElement.querySelector(rule.selector)
            var isValid = validate(inputElement, rule)
            if(!isValid) {
                isFromValid = false
            }
        })

        if(isFromValid) {
            this.submit()
        }
    }
}

Validator.isRequired = function(selector, message) {
    return {
        selector,
        test(value) {
            return value.trim() ? undefined : message || "Vui lòng nhập trường này"
        }
    }
}

Validator.isPhoneNumber = function (selector, message) {
    return {
        selector,
        test(value) {
            var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im
            return regex.test(value) ? undefined : message || "Trường này phải là số điện thoại";
        }
    }
}
