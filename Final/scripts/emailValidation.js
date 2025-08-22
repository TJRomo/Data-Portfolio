document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registerForm");
    const emailInput = document.getElementById("email");
    const phoneInput = document.getElementById("phone");

    form.addEventListener("submit", function (e) {
        let isValid = true;

        const email = emailInput.value.trim();
        if (!email.endsWith("@companyportal.com")) {
            emailInput.setCustomValidity("Email must end with @companyportal.com");
            isValid = false;
        } else {
            emailInput.setCustomValidity("");
        }
        const phone = phoneInput.value.trim();
        if (!/^\d{10}$/.test(phone)) {
            phoneInput.setCustomValidity("Phone number must be exactly 10 digits");
            isValid = false;
        } else {
            phoneInput.setCustomValidity("");
        }
        if (!isValid) {
            e.preventDefault();
        }
    });

    emailInput.addEventListener("input", () => emailInput.setCustomValidity(""));
    phoneInput.addEventListener("input", () => phoneInput.setCustomValidity(""));
});
