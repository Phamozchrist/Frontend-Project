function disableScroll() {
  document.body.style.overflow = "hidden";
}

function enableScroll() {
  document.body.style.overflow = "auto";
}

window.onload = function () {
  setTimeout(function () {
    document.getElementById("loader-wrapper").style.display = "none";
    enableScroll();
  }, 3000);
  disableScroll();
};
const fields = [
  "firstname",
  "lastname",
  "username",
  "email",
  "password",
  "confirm_password",
  "emailOrUsername",
  "login_password",
];

fields.forEach((field) => {
  document
    .getElementById(field)
    .addEventListener("input", () => validateField(field));
});

function validateField(field) {
  const input = document.getElementById(field);
  const error = document.querySelector(`.${field}-err`);
  const value = input.value.trim();
  const label = document.querySelector(
    "label[for='emailOrUsername'], label[for='password']"
  );
  const button = document.getElementById("button");

  isValid = true;
  button.disabled = !isValid;

  switch (field) {
    case "firstname":
    case "lastname":
      // For firstname and lastname, we can use the same validation logic
      const nameRegex = /^[a-zA-Z]+$/;
      if (value === "") {
        isValid = false;
        setError(input, error, `${capitalize(field)} is required`);
      } else if (!nameRegex.test(value)) {
        isValid = false;
        setError(input, error, "Only letters allowed");
      } else if (value.length < 3) {
        isValid = false;
        setError(input, error, "At least 3 characters");
      } else {
        setSuccess(input, error);
      }
      break;

    case "username":
      const usernameRegex = /^(?=.*[\d!@#$%?A-Za-z])[A-Za-z\d!@#$%?]+$/;
      if (value === "") {
        isValid = false;
        setError(input, error, "Username is required");
      } else if (!usernameRegex.test(value)) {
        isValid = false;
        setError(
          input,
          error,
          "Username may only contain alphanumeric characters e.g phamozChrist33"
        );
      } else if (value.length < 3) {
        isValid = false;
        setError(input, error, "At least 3 characters");
      } else {
        setSuccess(input, error);
      }
      break;

    case "emailOrUsername":
      if (value === "") {
        isValid = false;
        setError(input, error, label, "Email or Username is required");
      } else {
        setSuccess(input, error, label);
      }
      break;

    case "email":
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (value === "") {
        isValid = false;
        setError(input, error, "Email is required");
      } else if (!emailRegex.test(value)) {
        isValid = false;
        setError(input, error, "Invalid email format");
      } else {
        setSuccess(input, error);
      }
      break;

    case "password":
      const passwordRegex =
        /^(?=.*[A-Za-z])(?=.*[\d])(?=.*[!@#$%?])[A-Za-z\d!@#$%?]+$/;
      if (value === "") {
        isValid = false;
        setError(input, label, error, "Password is required");
      } else if (!passwordRegex.test(value)) {
        isValid = false;
        setError(
          input,
          error,
          "Password must include an uppercase, number, symbol e.g P@ssw0rd"
        );
      } else if (value.length < 8) {
        isValid = false;
        setError(input, error, "Minimum 8 characters");
      } else {
        setSuccess(input, error);
      }
      break;

    case "confirm_password":
      const password = document.getElementById("password").value.trim();
      if (value === "") {
        isValid = false;
        setError(input, error, "Please confirm password");
      } else if (value !== password) {
        isValid = false;
        setError(input, error, "Passwords do not match");
      } else {
        setSuccess(input, error);
      }
      break;
    case "login_password":
      if (value === "") {
        isValid = false;
        setError(input, error, label, "Password is required");
      } else {
        setSuccess(input, error, label);
      }
      break;
  }
}

function setError(input, errorEl, message, label) {
  input.style.border = "1px solid red";
  errorEl.textContent = message;
  label.style.color = "red";
}

function setSuccess(input, errorEl) {
  input.style.border = "1px solid green";
  errorEl.textContent = "";
  label.style.color = "green";
}
function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

const inputs = document.querySelectorAll("input");

inputs.forEach((input, index) => {
  input.addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
      e.preventDefault();
      const next = inputs[index + 1];
      if (next) next.focus();
    }
  });
});
