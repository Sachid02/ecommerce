let email = document.getElementById("email");
let password = document.getElementById("password");
let confirmpassword = document.getElementById("confirmpassword");
let form = document.getElementsByTagName("form")[0];
let errorList = document.getElementsByClassName("errors")[0];

form.addEventListener("submit", (e) => {
    if (!validatePassword()) {
        e.preventDefault();
        password.style.borderColor = "red";
        confirmpassword.style.borderColor = "red";
        errorList.style.display = "block";
        return;
    }
});

const validatePassword = () => {
    return password.value === confirmpassword.value;
};
