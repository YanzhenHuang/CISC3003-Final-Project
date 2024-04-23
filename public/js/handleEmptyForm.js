$emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

/**
 * @param {string} $submitButtonID The ID attribute of the submit button.
 */
function handleEmptyForm($submitButtonID) {
    let nonEmptyFields = document.querySelectorAll(".non-empty");

    function isEmailValid($emailStr) {
        return $emailRegex.test($emailStr);
    }

    // Clear error styles of all inputs.
    function clearAllFieldError() {
        nonEmptyFields.forEach((field) => {
            field.classList.remove('error');
        });
    }

    // Register event: User click submit, check if there is any empty fields.
    document.querySelector($submitButtonID).addEventListener('click', (e) => {
        nonEmptyFields.forEach((field) => {
            let curFieldVal = field.value;
            let isCurFieldEmail = field.classList.contains('email');
            if (curFieldVal == '' || (isCurFieldEmail && !isEmailValid(curFieldVal))) {
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


