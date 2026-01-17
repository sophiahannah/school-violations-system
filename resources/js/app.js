import "./bootstrap";
import "./appeal-search";
import "./violations-search";

/* Password eye button */
document.addEventListener("DOMContentLoaded", () => {
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");
    const icon = togglePassword.querySelector("i");

    togglePassword.addEventListener("click", () => {
        // Toggle input type
        const type =
            password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // Toggle icon class
        if (type === "password") {
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
    });
});
