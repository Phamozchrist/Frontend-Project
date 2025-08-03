const sidebar = document.querySelector(".sidebar");
const nav_ul = document.querySelector("ul");
const nav_ul_li = document.querySelector("ul li");
const nav_ul_li_i = document.querySelector("ul li i");
const nav_ul_a = document.querySelector("ul li a");
const mainExpand = document.querySelector("main");

sidebar.addEventListener("click", () => {
  sidebar.classList.toggle("sidebar-collapse");
  sidebar.classList.toggle("sidebar-expand");
  mainExpand.classList.toggle("main-expand");
});

let discounts = document.querySelectorAll('.discount');
let actualPrices = document.querySelectorAll('.actual-price');
let discountPrices = document.querySelectorAll('.discount-price');


for (let i = 0; i < actualPrices.length; i++) {
  let price =parseFloat(actualPrices[i].textContent);
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
