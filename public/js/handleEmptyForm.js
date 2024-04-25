let userNameRegex = /^[a-zA-Z0-9_-]{5,16}$/;
let emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

let validFieldRegex = {
    'user-name': userNameRegex,
    'emaliRegex': emailRegex
};

function isFieldValueValid(fieldVal, fieldTag) {
    let regexRule = validFieldRegex[fieldTag];
    if (!regexRule) return false;

    return regexRule.test(fieldVal);
}


/**
 * @param {string} submitButtonID The ID attribute of the submit button.
 */
function handleEmptyForm(submitButtonID) {
    let nonEmptyFields = document.querySelectorAll(".non-empty");

    // Clear error styles of all inputs.
    function clearAllFieldError() {
        nonEmptyFields.forEach((field) => {
            field.classList.remove('error');
        });
    }

    // Register event: User click submit, check if there is any empty fields.
    document.querySelector(submitButtonID).addEventListener('click', (e) => {
        nonEmptyFields.forEach((field) => {
            let curFieldVal = field.value;
            let isCurFieldEmail = field.classList.contains('email');
            let isCurFieldUserName = field.classList.contains('user-name');

            if (
                curFieldVal == '' ||
                (isCurFieldEmail && !isFieldValueValid(curFieldVal, 'email')) ||
                (isCurFieldUserName && !isFieldValueValid(curFieldVal, 'user-name'))
            ) {
                e.preventDefault();
                field.classList.add('error');
            }
        })
    })

    // Register clear all error events.
    nonEmptyFields.forEach((field) => {
        field.addEventListener('focus', (e) => {
            clearAllFieldError();
        })
    });
}


