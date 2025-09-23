const sidebar = document.querySelector(".sidebar");
const mainExpand = document.querySelector("main");

sidebar?.addEventListener("click", () => {
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
  sidebar?.addEventListener("click", () => {
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
  bd?.addEventListener("click", (e) => {
    if (
      !profileDropdown.contains(e.target) &&
      !toggleButton.contains(e.target)
    ) {
      profileDropdown.classList.remove("show");
      profileDropdown.style.display = "none";
    }
  });
}

toggleButton?.addEventListener("click", () => {
  profileDropdown.classList.toggle("show");
  if (profileDropdown.classList.contains("show")) {
    profileDropdown.style.display = "block";
  } else {
    profileDropdown.style.display = "none";
  }
});
let discountCon = document.querySelectorAll("cat-discounts");
let discounts = document.querySelectorAll(".discount");
let actualPrices = document.querySelectorAll(".actual-price");
let discountPrices = document.querySelectorAll(".discount-price");

for (let i = 0; i < actualPrices.length; i++) {
  let price = parseFloat(actualPrices[i].textContent);

  // keep element & numeric value separate
  let discountEl = discounts[i];
  let discountVal = parseFloat(discountEl ? discountEl.textContent : 0);

  if (!isNaN(price) && !isNaN(discountVal) && discountVal > 0) {
    let discountedPrice = price - price * (discountVal / 100);
    discountEl.textContent = `${discountVal}`;
    discountPrices[i].textContent = `$${discountedPrice.toFixed(2)}`;
    actualPrices[i].textContent = `$${price}`;
    actualPrices[i].style.textDecoration = "line-through";
    actualPrices[i].style.fontSize = "12px";
  } else {
    if (discountPrices[i]) discountPrices[i].style.display = "none";
    actualPrices[i].textContent = `$${price}`;
    actualPrices[i].style.textDecoration = "none";
    actualPrices[i].style.fontSize = "16px";
    actualPrices[i].style.fontWeight = "600";

    if (discountEl) discountEl.parentElement.style.display = "none"; // hide empty discount
  }
}

document?.addEventListener("DOMContentLoaded", function () {
  var cancelBtn = document.getElementById("cancelDelete");
  if (cancelBtn) {
    cancelBtn?.addEventListener("click", function () {
      var modal = document.getElementById("deleteModal");
      if (modal) modal.classList.remove("show");
    });
  }
  window?.addEventListener("click", function (event) {
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

if (form) {
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
}

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

// ----------------- API CALLER -----------------
// ----------------- CART ACTION -----------------
async function cartAction(action, productId = null, qty = 1) {
  try {
    let response = await fetch("cart_handler.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ action, product_id: productId, qty }),
    });

    let result = await response.json();

    // Always update badge after any action
    updateCartBadge();

    return result;
  } catch (err) {
    console.error("Cart action failed:", err);
    return { success: false };
  }
}

// ----------------- CART BADGE -----------------
async function updateCartBadge() {
  try {
    let response = await cartAction("count"); // fetch count from DB
    let count = response.count ?? 0;

    let badges = document.querySelectorAll(".cart-count-badge");
    badges.forEach((badge) => {
      badge.style.display = count > 0 ? "inline-block" : "none";
      badge.textContent = count > 0 ? count : "";
    });
  } catch (err) {
    console.error("Error updating badge:", err);
  }
}

// ----------------- INIT PRODUCT PAGE -----------------
function initProductPage() {
  document.querySelectorAll(".item").forEach(function (item) {
    const addBtn = item.querySelector(".addToCart");
    const incCart = item.querySelector(".inc-cart-count");
    const minusBtn = incCart.querySelector("button:first-child");
    const plusBtn = incCart.querySelector("button:last-child");
    const countSpan = incCart.querySelector("span");

    const prodId = item.dataset.id;

    // Load qty from server on page load
    cartAction("fetch").then((data) => {
      let product = data.items.find((p) => p.product_id == prodId);
      let qty = product ? product.quantity : 0;
      if (qty > 0) {
        addBtn.style.display = "none";
        incCart.style.display = "flex";
        countSpan.textContent = qty;
      }
      updateCartBadge(data.cart_count);
    });

    // Add
    addBtn.addEventListener("click", () => {
      cartAction("add", prodId, 1).then((data) => {
        addBtn.style.display = "none";
        incCart.style.display = "flex";
        countSpan.textContent = 1;
        updateCartBadge(data.cart_count);
      });
    });

    // Increase
    plusBtn.addEventListener("click", () => {
      let qty = parseInt(countSpan.textContent) + 1;
      cartAction("update", prodId, qty).then((data) => {
        countSpan.textContent = qty;
        updateCartBadge(data.cart_count);
      });
    });

    // Decrease
    minusBtn.addEventListener("click", () => {
      let qty = parseInt(countSpan.textContent) - 1;
      if (qty <= 0) {
        cartAction("remove", prodId).then((data) => {
          addBtn.style.display = "block";
          incCart.style.display = "none";
          countSpan.textContent = 0;
          updateCartBadge(data.cart_count);
        });
      } else {
        cartAction("update", prodId, qty).then((data) => {
          countSpan.textContent = qty;
          updateCartBadge(data.cart_count);
        });
      }
    });
  });
}

// ----------------- RENDER CART PAGE -----------------
function renderCart() {
  const cartTable = document.querySelector(".cart-table");
  const summary = document.querySelector(".cart-summary");
  if (!cartTable) return;

  cartAction("fetch").then((data) => {
    let items = data.items || [];
    cartTable.innerHTML = "";
    summary.innerHTML = "";

    if (items.length === 0) {
      cartTable.innerHTML = '<p class="emtpy-cart">Your cart is empty</p>';
      return;
    }

    let subtotal = 0;
    items.forEach((item) => {
      let price = item.product_discount_price
        ? parseFloat(item.product_discount_price)
        : parseFloat(item.product_price);
      subtotal += price * item.quantity;

      let discountPrice = item.product_discount_price;
      if (discountPrice !== undefined && discountPrice !== null) {
        if (typeof discountPrice === "number") {
          discountPrice = discountPrice;
        } else {
          discountPrice = parseFloat(
            String(discountPrice).replace(/[^\d.]/g, "")
          );
        }
      } else {
        discountPrice = 0;
      }
      let originalPrice = item.product_price;
      if (originalPrice !== undefined && originalPrice !== null) {
        if (typeof originalPrice === "number") {
          originalPrice = originalPrice;
        } else {
          originalPrice = parseFloat(
            String(originalPrice).replace(/[^\d.]/g, "")
          );
        }
      } else {
        originalPrice = 0;
      }
      cartTable.innerHTML += `
        <div class="cart-body">
          <div class="cart-product">
            <img src="../admin/uploads/${item.product_image}" alt="${
        item.product_name
      }" class="cart-product-img">
            <div class="cart-product-info">
              <p class="cart-product-name">${item.product_name}</p>
              <small>In stock</small>
            </div>
          </div>
          <div class="cart-product-price">
          ${
            item.product_discount && item.product_discount != 0
              ? `
                <span class="discounted-price">$${discountPrice.toLocaleString()}</span>
                <span class="original-price">$${originalPrice.toLocaleString()}</span>
                <span class="discount-percent">-${item.product_discount}%</span>
              `
              : `<span class="normal-price">$${originalPrice.toLocaleString()}</span>`
          }
        </div>
        </div>
        <div class="cart-actions">
          <button class="remove-btn" data-id="${
            item.product_id
          }"><i class="fas fa-trash"></i> Remove</button>
          <div class="quantity-box">
            <button class="qty-btn minus" data-id="${
              item.product_id
            }"><i class="fas fa-minus"></i></button>
            <input type="text" value="${
              item.quantity
            }" class="qty-input" readonly>
            <button class="qty-btn plus" data-id="${
              item.product_id
            }"><i class="fas fa-plus"></i></button>
          </div>
        </div>
      `;
    });

    if (summary) {
      const shipping = 5.8;
      const total = subtotal + shipping;

      summary.innerHTML = `
        <div class="summary-details">
          <h2>Cart Summary</h2>
          <div class="summary-row-wrap">
            <div class="summary-row"><span>Subtotal:</span><span>$${subtotal.toLocaleString()}</span></div>
            <div class="summary-row"><span>Shipping:</span><span>$${shipping}</span></div>
            <div class="summary-row total"><span>Total:</span><span>$${total.toLocaleString()}</span></div>
            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
          </div>
        </div>
      `;
    }

    // Event bindings
    document.querySelectorAll(".remove-btn").forEach((btn) => {
      btn.addEventListener("click", () => {
        cartAction("remove", btn.dataset.id).then(renderCart);
      });
    });

    document.querySelectorAll(".qty-btn.plus").forEach((btn) => {
      btn.addEventListener("click", () => {
        let input = btn.parentElement.querySelector(".qty-input");
        let qty = parseInt(input.value) + 1;
        cartAction("update", btn.dataset.id, qty).then(renderCart);
      });
    });

    document.querySelectorAll(".qty-btn.minus").forEach((btn) => {
      btn.addEventListener("click", () => {
        let input = btn.parentElement.querySelector(".qty-input");
        let qty = parseInt(input.value) - 1;
        if (qty <= 0) {
          cartAction("remove", btn.dataset.id).then(renderCart);
        } else {
          cartAction("update", btn.dataset.id, qty).then(renderCart);
        }
      });
    });

    updateCartBadge(data.cart_count);
  });
}

// ----------------- INIT -----------------
document.addEventListener("DOMContentLoaded", () => {
  initProductPage();
  renderCart();
  updateCartBadge();
});


