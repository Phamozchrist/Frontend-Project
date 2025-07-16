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

