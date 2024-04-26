function bindPasswordVisibilityToggles() {
    let passwordVisibilityToggles = document.querySelectorAll(".password-visibility-toggle");
    if (!passwordVisibilityToggles) return;

    passwordVisibilityToggles.forEach((toggle) => {
        toggle.addEventListener('click', (e) => {
            e.preventDefault();
            let siblingPasswordField = toggle.previousElementSibling;
            let status = siblingPasswordField.getAttribute('type');
            toggle.innerHTML = status === 'password' ? 'Hide' : 'Show';
            siblingPasswordField.setAttribute('type', status === 'password' ? 'text' : 'password');
        });
    });
}