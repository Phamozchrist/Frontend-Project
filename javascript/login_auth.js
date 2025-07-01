particlesJS.load("particles-js", "particles.json");
// function disableScroll() {
//   document.body.style.overflow = "hidden";
// }

// function enableScroll() {
//   document.body.style.overflow = "auto";
// }

// window.onload = function () {
//   setTimeout(function () {
//     document.getElementById("loader-wrapper").style.display = "none";
//     enableScroll();
//   }, 2000);
//   disableScroll();
// };
const login_fields = ["emailOrUsername", "login_password"];

login_fields.forEach((field) => {
  document.getElementById(field).addEventListener("input", () => validateField(field));
});
function validateField(field) {
  const input = document.getElementById(field);
  const error = document.querySelector(`.${field}-err`);
  const value = input.value.trim();
  const label = document.querySelector(`label[for='${field}']`);
  // const button = document.getElementById("button");

  // isValid = true;

  switch (field) {
    case "emailOrUsername":
      if (value === "") {
        // isValid = false;
        setError(input, error, label, "Email or Username is required");
      } else {
        setSuccess(input, error, label);
      }
      break;

    case "login_password":
      if (value === "") {
        // isValid = false;
        setError(input, error, label, "Password is required");
      } else {
        setSuccess(input, error, label);
      }
      break;
  }
  // if (isValid) {
  //   button.removeAttribute("disabled");
  // } else {
  //   button.disabled = !isValid;
  // }
  checkAllFieldsValid();
}
function setError(input, error, label, message) {
  input.style.border = "1px solid red";
  label.style.color = "red";
  error.textContent = message;
}

function setSuccess(input, error, label) {
  input.style.border = "1px solid green";
  label.style.color = "green";
  error.textContent = "";
}

const btnText = document.getElementById("btnText");
const form = document.getElementById("form");
const spinner = document.getElementById("spinner");

form.addEventListener("submit", (e) => {
  e.preventDefault()

  const button = document.getElementById("button");

  btnText.textContent = "Logging in....";
  spinner.classList.remove('hidden');
  button.setAttribute("disabled", "true");

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

const toggleEyes = document.querySelector(".toggle-eye");

toggleEyes.addEventListener("click", () => {
  const inputId = toggleEyes.getAttribute("data-target");
  const input = document.getElementById(inputId);

  if (input.type === "password") {
    input.type = "text";
    toggleEyes.classList.add("fa-eye-slash");
    toggleEyes.classList.remove("fa-eye");
  } else {
    input.type = "password";
    toggleEyes.classList.remove("fa-eye-slash");
    toggleEyes.classList.add("fa-eye");
  }
});
function checkAllFieldsValid() {
  const button = document.getElementById("button");
  let allValid = true;

  login_fields.forEach((field) => {
    const input = document.getElementById(field);
    if (input.value.trim() === "") {
      allValid = false;
    }
  });

  button.disabled = !allValid;
}
