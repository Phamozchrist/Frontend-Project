const sidebar = document.querySelector(".sidebar");
const mainExpand = document.querySelector("main");

sidebar.addEventListener("click", () => {
  sidebar.classList.toggle("sidebar-expand");
  sidebar.classList.toggle("sidebar-collapse");
  mainExpand.classList.toggle("main-collapse");
});

const toggleButton = document.querySelector(".user-dp");
const profileDropdown = document.querySelector(".profile-dropdown");
let bd = document.body;
if (profileDropdown) {
  bd.addEventListener("click", (e) => {
    if (!profileDropdown.contains(e.target) && !toggleButton.contains(e.target)) {
      profileDropdown.classList.remove("show");
      profileDropdown.style.display = "none";
    }
  });
}

toggleButton.addEventListener("click", () => {
  profileDropdown.classList.toggle("show");
  if (profileDropdown.classList.contains("show")) {
    profileDropdown.style.display = "block";
  } else {
    profileDropdown.style.display = "none";
  }
});
let discounts = document.querySelectorAll(".discount");
let actualPrices = document.querySelectorAll(".actual-price");
let discountPrices = document.querySelectorAll(".discount-price");

for (let i = 0; i < actualPrices.length; i++) {
  let price = parseFloat(actualPrices[i].textContent);
  let discount = parseFloat(discounts[i].textContent);
  discount.textContent = `-${discounts}%`;

  if (!isNaN(price) && !isNaN(discount) && discount > 0) {
    let discountedPrice = price - price * (discount / 100);
    discountPrices[i].textContent = `$${discountedPrice.toFixed(2)}`;
    actualPrices[i].textContent = `$${price}`;
    actualPrices[i].style.textDecoration = "line-through";
    actualPrices[i].style.fontSize = "12px";
    actualPrices[i].style.color = "#2c2e2e";
  } else {
    discountPrices[i].style.display = "none";
    actualPrices[i].style.textDecoration = "none";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var cancelBtn = document.getElementById("cancelDelete");
  if (cancelBtn) {
    cancelBtn.addEventListener("click", function () {
      var modal = document.getElementById("deleteModal");
      if (modal) modal.classList.remove("show");
    });
  }
  window.addEventListener("click", function (event) {
    var modal = document.getElementById("deleteModal");
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });
});

function openDeleteModal(el) {
  var modal = document.getElementById("deleteModal");
  var confirmBtn = document.getElementById("confirmDelete");
  if (confirmBtn) confirmBtn.href = el.getAttribute("data-delete-url");
  if (modal) modal.classList.add("show");
}


const setNavTrigger = document.querySelector(
  ".settings-sidebar .sidebar-nav-container .nsn-1"
);
const setNavTrigger1 = document.querySelector(
  ".settings-sidebar .sidebar-nav-container .nsn-2"
);
const setNavTrigger2 = document.querySelector(
  ".settings-sidebar .sidebar-nav-container .nsn-3"
);
const nestedNav = document.querySelector(".settings-sidebar .sidebar-nav-container .nsn-1 .nested-sidebar-nav li");
const nestedNav1 = document.querySelector(".settings-sidebar .sidebar-nav-container .nsn-2 .nested-sidebar-nav li");
const nestedNav2 = document.querySelector(".settings-sidebar .sidebar-nav-container .nsn-3 .nested-sidebar-nav .passBtn");
const nestedNav3 = document.querySelector(".settings-sidebar .sidebar-nav-container .nsn-3 .nested-sidebar-nav .authBtn");

setNavTrigger.addEventListener("click", () => {
  setNavTrigger.classList.toggle("open-nested-nav");
  setNavTrigger.classList.toggle("close-nested-nav");
  nestedNav.onclick = (event) => {
    event.stopPropagation();
  };
});
setNavTrigger1.addEventListener("click", () => {
  setNavTrigger1.classList.toggle("open-nested-nav1");
  setNavTrigger1.classList.toggle("close-nested-nav");
  nestedNav1.onclick = (event) => {
    event.stopPropagation();
  };
});
setNavTrigger2.addEventListener("click", () => {
  setNavTrigger2.classList.toggle("open-nested-nav2");
  setNavTrigger2.classList.toggle("close-nested-nav");
  nestedNav2.onclick = (event) => {
    event.stopPropagation();
  };
  nestedNav3.onclick = (event) => {
    event.stopPropagation();
  };
});

document.addEventListener("DOMContentLoaded", function () {
  const themesBtn = document.querySelector(".themesBtn");
  const profileBtn= document.querySelector(".profileBtn");
  const authBtn = document.querySelector(".authBtn");
  const passBtn = document.querySelector(".passBtn");
  const themesCon = document.getElementById("themes-container");
  const profileCon = document.getElementById("profile-container");
  const authCon = document.getElementById("auth-container");
  const passCon = document.getElementById("pass-container");
  const defaultCon = document.getElementById('default-settings');

  defaultCon.style.display = "block";

  themesBtn.addEventListener("click", function () {
    themesCon.style.display = "block";
    profileCon.style.display = "none";
    authCon.style.display = "none";
    passCon.style.display = "none";
    defaultCon.style.display = "none";

    if (themesCon.style.display == "block") {
      themesBtn.style.backgroundColor = "#9bf7ea";
      profileBtn.style.backgroundColor = "";
      authBtn.style.backgroundColor = "";
      passBtn.style.backgroundColor = "";
    }
  });

  profileBtn.addEventListener("click", function () {
    themesCon.style.display = "none";
    profileCon.style.display = "block";
    authCon.style.display = "none";
    passCon.style.display = "none";
    defaultCon.style.display = "none";

    if (profileCon.style.display == "block") {
      themesBtn.style.backgroundColor = "";
      profileBtn.style.backgroundColor = "#9bf7ea";
      authBtn.style.backgroundColor = "";
      passBtn.style.backgroundColor = "";
    }
  });

  authBtn.addEventListener("click", function () {
    themesCon.style.display = "none";
    profileCon.style.display = "none";
    authCon.style.display = "block";
    passCon.style.display = "none";
    defaultCon.style.display = "none";

    if (authCon.style.display == "block") {
      themesBtn.style.backgroundColor = "";
      profileBtn.style.backgroundColor = "";
      authBtn.style.backgroundColor = "#9bf7ea";
      passBtn.style.backgroundColor = "";
    }
  });

  passBtn.addEventListener("click", function () {
    themesCon.style.display = "none";
    profileCon.style.display = "none";
    authCon.style.display = "none";
    passCon.style.display = "block";
    defaultCon.style.display = "none";

    if (passCon.style.display == "block") {
      themesBtn.style.backgroundColor = "";
      profileBtn.style.backgroundColor = "";
      authBtn.style.backgroundColor = "";
      passBtn.style.backgroundColor = "#9bf7ea";
    }
  });
});
const fields = [
  "password",
  "confirm_password",
  "new_password",
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
  const button = document.getElementById("button");
  let isValid = true;

  switch (field) {
    case "password":
      const passwordRegex =
        /^(?=.*[A-Za-z])(?=.*[\d])(?=.*[!@#$%?*^])[A-Za-z\d!@#$%?*^]+$/;
      if (value === "") {
        isValid = false;
        setError(input, error, "Old Password is required");
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
    case "new_password":
      const newpasswordRegex =
        /^(?=.*[A-Za-z])(?=.*[\d])(?=.*[!@#$%?*^])[A-Za-z\d!@#$%?*^]+$/;
      if (value === "") {
        isValid = false;
        setError(input, error, "New Password is required");
      } else if (!newpasswordRegex.test(value)) {
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
      const password = document.getElementById("new_password").value.trim();
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
    const value = input.value.trim();
    if (
      (input.type === "password" && !value) ||
      (input.type !== "password" && value === "") ||
      input.style.border === "1px solid red"
    ){
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

  btnText.textContent = " Saving...";
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

// document.addEventListener("DOMContentLoaded", function () {
//   let addToCartbtn = document.querySelectorAll('#addToCart');
//   let incCartCount = document.querySelectorAll('.inc-cart-count');
//   let addBtn = document.querySelectorAll('.inc-cart-count button:nth-child(2)');
//   let minusBtn = document.querySelectorAll('.inc-cart-count button:nth-child(1)');
//   let cartCount = document.querySelectorAll('.inc-cart-count span');
//   let totalCount = document.querySelector('.cart-count');
// });

  const input = document.getElementById("uploadProfile");
  const profilePic = document.getElementById("profilePic");

  input.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
      let reader = new FileReader();
      reader.onload = function (e) {
        profilePic.src = e.target.result; // show preview
      };
      reader.readAsDataURL(file);
    }
  });