const passwordRegex = /^(?=.*\d).{8,}$/;

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registerForm");
    if (!form) return;

    const password = form.querySelector("input[name='password']");
    const errorBox = document.getElementById("formError");

    form.addEventListener("submit", (e) => {
        errorBox.textContent = "";

        if (!passwordRegex.test(password.value)) {
            e.preventDefault();
            errorBox.textContent =
                "Password must be at least 8 characters long and contain at least one number.";
        }
    });
});
