document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    
    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm() {
        let isValid = true;

        // Full Name validation
        const fullName = document.getElementById('fullName');
        if (fullName.value.trim() === '') {
            showError(fullName, 'Full name is required');
            isValid = false;
        } else {
            removeError(fullName);
        }

        // Email validation
        const email = document.getElementById('email');
        const emailRegex = /^[a-zA-Z0-9._%+-]+@ashesi\.edu\.gh$/;
        if (!emailRegex.test(email.value)) {
            showError(email, 'Please enter a valid Ashesi email address');
            isValid = false;
        } else {
            removeError(email);
        }

        // Password validation
        const password = document.getElementById('password');
        if (password.value.length < 8) {
            showError(password, 'Password must be at least 8 characters long');
            isValid = false;
        } else {
            removeError(password);
        }

        // Country validation
        const country = document.getElementById('country');
        if (country.value.trim() === '') {
            showError(country, 'Country is required');
            isValid = false;
        } else {
            removeError(country);
        }

        // City validation
        const city = document.getElementById('city');
        if (city.value.trim() === '') {
            showError(city, 'City is required');
            isValid = false;
        } else {
            removeError(city);
        }

        // Contact Number validation
        const contactNumber = document.getElementById('contactNumber');
        const phoneRegex = /^\+[1-9]\d{1,14}$/;
        if (!phoneRegex.test(contactNumber.value)) {
            showError(contactNumber, 'Please enter a valid phone number in E.164 format');
            isValid = false;
        } else {
            removeError(contactNumber);
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