
/**
 * @param {string} $submitButtonID The ID attribute of the submit button.
 */
function handleEmptyForm($submitButtonID) {
    let nonEmptyFields = document.querySelectorAll(".non-empty");

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
            if (curFieldVal == '') {
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


