const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmPassword"]');

function isEmail(email) {
    return /\s+@\s+\.\s+/.test(email);
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid')
}

emailInput.addEventListener('keyup', function() {
    setTimeout( function() {
        markValidation(emailInput, isEmail(emailInput.value));
    }
        , 1000);
})

confirmedPasswordInput.addEventListener('keyup', function() {
    setTimeout( function() {
        console.log("event");
        const condition = arePasswordsSame(confirmedPasswordInput.value, confirmedPasswordInput.previousElementSibling.value);
        console.log(condition);
        markValidation(confirmedPasswordInput, condition);
    }
        , 1000);
})

function goToLogin() {
    window.location.href = "login";
}