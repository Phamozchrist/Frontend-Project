const sidebar = document.querySelector(".sidebar");
const mainExpand = document.querySelector("main");

sidebar.addEventListener("click", () => {
  sidebar.classList.toggle("sidebar-expand");
  mainExpand.classList.toggle("main-collapse");
});
if (
  window.location.pathname === "/user/settings.php" ||
  window.location.pathname === "/user/theme.php" ||
  window.location.pathname === "/user/edit_profile.php" ||
  window.location.pathname === "/user/two-factor-authentication.php" ||
  window.location.pathname === "/user/password_management.php"
) {
  const settingsSidebar = document.querySelector(".settings-sidebar");
  sidebar.addEventListener("click", () => {
    // sidebar.classList.toggle("sidebar-expand");
    mainExpand.classList.toggle("main-collapse-settings");
    settingsSidebar.classList.toggle("settings-sidebar-move");
  });
}
if (
  window.location.pathname === "/user/settings.php" ||
  window.location.pathname === "/user/theme.php" ||
  window.location.pathname === "/user/two-factor-authentication.php" ||
  window.location.pathname === "/user/password_management.php"
) {
  document.body.style.overflow = "hidden";
} else {
  document.body.style.removeProperty("overflow");
}

const toggleButton = document.querySelector(".user-dp");
const profileDropdown = document.querySelector(".profile-dropdown");
let bd = document.body;
if (profileDropdown) {
  bd.addEventListener("click", (e) => {
    if (
      !profileDropdown.contains(e.target) &&
      !toggleButton.contains(e.target)
    ) {
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
const angletoggle = document.querySelectorAll(
  ".settings-sidebar .sidebar-nav-container .nested-nav .fa-angle-down"
);
if (window.location.pathname === "/user/theme.php") {
  setNavTrigger.classList.toggle("open-nested-nav");
  angletoggle[0].classList.toggle("active");
}
if (window.location.pathname === "/user/edit_profile.php") {
  setNavTrigger1.classList.toggle("open-nested-nav");
  angletoggle[1].classList.toggle("active");
}
if (window.location.pathname === "/user/two-factor-authentication.php") {
  setNavTrigger2.classList.toggle("open-nested-nav2");
  angletoggle[2].classList.toggle("active");
}
if (window.location.pathname === "/user/password_management.php") {
  setNavTrigger2.classList.toggle("open-nested-nav2");
  angletoggle[2].classList.toggle("active");
}

if (setNavTrigger) {
  setNavTrigger.addEventListener("click", () => {
    setNavTrigger.classList.toggle("open-nested-nav");
    angletoggle[0].classList.toggle("active");
  });
  setNavTrigger1.addEventListener("click", () => {
    setNavTrigger1.classList.toggle("open-nested-nav");
    angletoggle[1].classList.toggle("active");
  });
  setNavTrigger2.addEventListener("click", () => {
    setNavTrigger2.classList.toggle("open-nested-nav2");
    angletoggle[2].classList.toggle("active");
  });
}

const fields = ["password", "confirm_password", "new_password"];
fields.forEach((field) => {
  document
    .getElementById(field)
    ?.addEventListener("input", () => validateField(field));
});

function validateField(field) {
  const input = document.getElementById(field);
  const error = document.querySelector(`.${field}-err`);
  const value = input.value.trim();

  switch (field) {
    case "password":
      const passwordRegex =
        /^(?=.*[A-Za-z])(?=.*[\d])(?=.*[!@#$%?*^])[A-Za-z\d!@#$%?*^]+$/;
      if (value === "") {
        setError(input, error, "Old Password is required");
      } else if (!passwordRegex.test(value)) {
        isValid = false;
        setError(
          input,
          error,
          "Password must include an uppercase, number, symbol e.g P@ssw0rd"
        );
      } else if (value.length < 8) {
        setError(input, error, "Minimum 8 characters");
      } else {
        setSuccess(input, error);
      }
      break;
    case "new_password":
      const newpasswordRegex =
        /^(?=.*[A-Za-z])(?=.*[\d])(?=.*[!@#$%?*^])[A-Za-z\d!@#$%?*^]+$/;
      if (value === "") {
        setError(input, error, "New Password is required");
      } else if (!newpasswordRegex.test(value)) {
        isValid = false;
        setError(
          input,
          error,
          "Password must include an uppercase, number, symbol e.g P@ssw0rd"
        );
      } else if (value.length < 8) {
        setError(input, error, "Minimum 8 characters");
      } else {
        setSuccess(input, error);
      }
      break;
    case "confirm_password":
      const password = document.getElementById("new_password").value.trim();
      if (value === "") {
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
    ) {
      allValid = false;
    }
  }

  button.disabled = !allValid;
}

const form = document.getElementById("form");
const btnText = document.getElementById("btnText");
const spinner = document.getElementById("spinner");
form?.addEventListener("submit", (e) => {
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
  eye?.addEventListener("click", () => {
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

input?.addEventListener("change", function () {
  const file = this.files[0];
  if (file) {
    let reader = new FileReader();
    reader.onload = function (e) {
      profilePic.src = e.target.result; // show preview
    };
    reader.readAsDataURL(file);
  }
});

// --- Cart Icon and Add to Cart Functionality for Flash Sales ---
document?.addEventListener("DOMContentLoaded", function () {
  function getCart() {
    return JSON.parse(localStorage.getItem("cart") || "{}");
  }
  function setCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartBadge();
  }
  function updateCartBadge() {
    let badge = document.querySelector(".cart-count-badge");
    if (!badge) return;
    let cart = getCart();
    let totalCount = Object.values(cart).reduce(
      (sum, item) => sum + item.qty,
      0
    );
    badge.textContent = totalCount > 0 ? totalCount : "";
  }

  // On page load, update cart badge
  updateCartBadge();
  document.querySelectorAll("#addToCart-container").forEach(function (item) {
    const addBtn = item.querySelectorAll(".addToCart");
    const incCart = item.querySelectorAll(".inc-cart-count");
    const minusBtn = incCart.querySelectoAllr("button:first-child");
    const plusBtn = incCart.querySelectorAll("button:last-child");
    const countSpan = incCart.querySelectorAll("span");

    // Get product info
    const prodName = item.querySelector("h3").textContent.trim();
    const prodImg = item.querySelector("img").getAttribute("src");
    const prodPrice = item.querySelector(".actual-price").textContent.trim();

    // Load count from cart
    let cart = getCart();
    let qty = cart[prodName]?.qty || 0;
    if (qty > 0) {
      addBtn.style.display = "none";
      incCart.style.display = "flex";
      countSpan.textContent = qty;
    } else {
      addBtn.style.display = "block";
      incCart.style.display = "none";
      countSpan.textContent = "0";
    }

    addBtn.addEventListener("click", function () {
      qty = 1;
      addBtn.style.display = "none";
      incCart.style.display = "flex";
      countSpan.textContent = qty;
      cart = getCart();
      cart[prodName] = { qty, prodImg, prodPrice };
      setCart(cart);
    });

    plusBtn.addEventListener("click", function () {
      qty++;
      countSpan.textContent = qty;
      cart = getCart();
      cart[prodName] = { qty, prodImg, prodPrice };
      setCart(cart);
    });

    minusBtn.addEventListener("click", function () {
      if (qty > 1) {
        qty--;
        countSpan.textContent = qty;
        cart = getCart();
        cart[prodName] = { qty, prodImg, prodPrice };
        setCart(cart);
      } else {
        qty = 0;
        addBtn.style.display = "block";
        incCart.style.display = "none";
        cart = getCart();
        delete cart[prodName];
        setCart(cart);
      }
    });
  });
});
