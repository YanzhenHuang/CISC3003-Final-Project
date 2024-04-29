let validFieldRegex = {
    'user-name': /^[a-zA-Z0-9_\s-]{3,16}$/,
    'email': /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
};

function isFieldValueValid(fieldVal, fieldTag) {
    if (!fieldVal) return false;

    // Empty field is not valid
    if (/^[\s\t]+$/.test(fieldVal)) return false;

    let regexRule = validFieldRegex[fieldTag];
    if (!regexRule) return false;

    return regexRule.test(fieldVal);
}


/**
 * @param {string} submitButtonID The ID attribute of the submit button.
 */
function handleEmptyForm(submitButtonID) {
    let nonEmptyFields = document.querySelectorAll(".non-empty");
    console.log(nonEmptyFields);

    // Clear error styles of all inputs.
    function clearAllFieldError() {
        nonEmptyFields.forEach((field) => {
            field.classList.remove('error');
        });
    }

    // Register event: User click submit, check if there is any empty fields.
    document.querySelector(submitButtonID).addEventListener('click', (e) => {
        nonEmptyFields.forEach((field) => {
            if (field.type === "checkbox" && !field.checked) {
              e.preventDefault();
              field.classList.add("error");
              window.alert("You need to agree to our Terms & Conditions.");
            } else if (field.type === "text") {
              const curFieldVal = field.value;
              const isCurFieldEmail = field.classList.contains("email");
              const isCurFieldUserName = field.classList.contains("user-name");
          
              if (
                curFieldVal === "" ||
                (isCurFieldEmail && !isFieldValueValid(curFieldVal, "email")) ||
                (isCurFieldUserName && !isFieldValueValid(curFieldVal, "user-name"))
              ) {
                e.preventDefault();
                field.classList.add("error");
              }
            }
          });
    })

    // Register clear all error events.
    nonEmptyFields.forEach((field) => {
        field.addEventListener('focus', (e) => {
            clearAllFieldError();
        })
    });
}


