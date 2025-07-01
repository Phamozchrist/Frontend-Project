function enableScroll() {
  document.body.style.overflow = "auto";
}
function disableScroll() {
  document.body.style.overflow = "hidden";
}


window.onload = function () {
  setTimeout(function () {
    document.getElementById("loader-wrapper").style.display = "none";
    enableScroll();
  }, 2000);
  disableScroll();
};

const fields = [
  "firstname",
  "lastname",
  "username",
  "email",
  "password",
  "confirm_password",
  "terms"
];
fields.forEach((field) => {
  document
    .getElementById(field)
    .addEventListener("input", () => validateField(field));
});

function validateField(field) {
  const input = document.getElementById(field);
  const error = document.querySelector(`.${field}-err`);
  const value = input.type === "checkbox" ? input.checked :input.value.trim();
  const button = document.getElementById("button");

  let isValid = true;


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
        /^(?=.*[A-Za-z])(?=.*[\d])(?=.*[!@#$%?*^])[A-Za-z\d!@#$%?*^]+$/;    
      if (value === "") {
        isValid = false;
        setError(input, error, "Password is required");
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

      case "terms" :
        if(!input.checked){
          isValid = false;
          setError( input, error, "You must agree to the terms and conditions");
        }else{
          setSuccess(input, error);
        }
        break;
    }
 
    checkFormValidity();
}

function setError(input, errorEl, message) {
  input.style.border = "1px solid red";
  errorEl.textContent = message;
}

function setSuccess(input, errorEl) {
  input.style.border = "1px solid green";
  errorEl.textContent = "";
}
function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}
function checkFormValidity() {
  const button = document.getElementById("button");
  let allValid = true;

  for (let field of fields) {
    const input = document.getElementById(field);
    const value = input.type === "checkbox" ? input.checked : input.value.trim();
    if (
      (input.type === "checkbox" && !value) ||
      (input.type !== "checkbox" && value === "") ||
      input.style.border === "1px solid red"
    ) {
      allValid = false;
    }
  }

  button.disabled = !allValid;
}

const form = document.getElementById("form");
const btnText = document.getElementById("btnText");
const spinner = document.getElementById("spinner");
form.addEventListener("submit", (e) => {
  e.preventDefault();

  const button = document.getElementById("button");

  btnText.textContent = " Redirecting...";
  button.setAttribute("disabled", "true");
  spinner.classList.remove("hidden");

  setTimeout(() => {
    form.submit();
  }, 2000);
});

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


const toggleEyes = document.querySelectorAll(".toggle-eye");

toggleEyes.forEach((eye) => {
  eye.addEventListener("click", () => {
    const inputId = eye.getAttribute("data-target");
    const input = document.getElementById(inputId);

    if (input.type === "password") {
      input.type = "text";
      eye.classList.add("fa-eye-slash");
      eye.classList.remove("fa-eye");
    } else {
      input.type = "password";
      eye.classList.remove("fa-eye-slash");
      eye.classList.add("fa-eye");
    }
  });
});
