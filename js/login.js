document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm() {
        let isValid = true;

        // Email validation - Ashesi email only
        const email = document.getElementById('email');
        const emailRegex = /^[a-zA-Z0-9._%+-]+@ashesi\.edu\.gh$/;
        if (email.value.trim() === '') {
            showError(email, 'Email is required');
            isValid = false;
        } else if (!emailRegex.test(email.value)) {
            showError(email, 'Please enter a valid Ashesi email address.');
            isValid = false;
        } else {
            removeError(email);
        }

        // Password validation
        const password = document.getElementById('password');
        if (password.value.trim() === '') {
            showError(password, 'Password is required');
            isValid = false;
        } else if (password.value.length < 8) {
            showError(password, 'Password must be at least 8 characters long');
            isValid = false;
        } else {
            removeError(password);
        }

        return isValid;
    }

    function showError(input, message) {
        const formGroup = input.parentElement;
        let errorElement = formGroup.querySelector('.error');
        
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'error';
            formGroup.appendChild(errorElement);
        }
        
        errorElement.textContent = message;
    }

    function removeError(input) {
        const formGroup = input.parentElement;
        const errorElement = formGroup.querySelector('.error');
        if (errorElement) {
            formGroup.removeChild(errorElement);
        }
    }
});
