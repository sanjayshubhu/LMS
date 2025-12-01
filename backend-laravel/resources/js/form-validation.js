// form-validation.js

document.addEventListener('DOMContentLoaded', () => {

    const validateInput = (input) => {
        const errorMsg = input.nextElementSibling; // assumes <p> is immediately after input
        if (!input.checkValidity()) {
            input.classList.add('border-red-500', 'focus:ring-red-500');
            input.classList.remove('border-green-500', 'focus:ring-green-500');
            if (errorMsg) errorMsg.classList.remove('hidden');
        } else {
            input.classList.remove('border-red-500', 'focus:ring-red-500');
            input.classList.add('border-green-500', 'focus:ring-green-500');
            if (errorMsg) errorMsg.classList.add('hidden');
        }
    };

    const validateEmail = (input) => {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const errorMsg = input.nextElementSibling;
        if (emailPattern.test(input.value)) {
            input.classList.remove('border-red-500', 'focus:ring-red-500');
            input.classList.add('border-green-500', 'focus:ring-green-500');
            if (errorMsg) errorMsg.classList.add('hidden');
        } else {
            input.classList.add('border-red-500', 'focus:ring-red-500');
            input.classList.remove('border-green-500', 'focus:ring-green-500');
            if (errorMsg) errorMsg.classList.remove('hidden');
        }
    };

    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        const inputs = form.querySelectorAll('input');

        inputs.forEach(input => {
            input.addEventListener('input', () => {
                if (input.type === 'email') {
                    validateEmail(input);
                } else {
                    validateInput(input);
                }
            });

            input.addEventListener('blur', () => {
                if (input.type === 'email') {
                    validateEmail(input);
                } else {
                    validateInput(input);
                }
            });
        });

        form.addEventListener('submit', (event) => {
            let formValid = true;
            inputs.forEach(input => {
                if (input.type === 'email') {
                    validateEmail(input);
                    if (!input.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) formValid = false;
                } else {
                    validateInput(input);
                    if (!input.checkValidity()) formValid = false;
                }
            });

            if (!formValid) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    });
});
