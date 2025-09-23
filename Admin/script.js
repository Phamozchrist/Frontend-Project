/*!
 * Start Bootstrap - SB Admin v7.0.7
 */

// Initialize Froala editor only if element exists
if (document.querySelector("#productDetails")) {
  var editor = new FroalaEditor("#productDetails");
}

window.addEventListener("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector("#sidebarToggle");
  if (sidebarToggle) {
    // Persist state from localStorage if needed
    if (localStorage.getItem("sb|sidebar-toggle") === "true") {
      document.body.classList.toggle("sb-sidenav-toggled");
    }

    sidebarToggle.addEventListener("click", (event) => {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        document.body.classList.contains("sb-sidenav-toggled")
      );
    });
  }
});

// Auto-hide alerts
setTimeout(() => {
  const alertBox = document.querySelector(".alert");
  if (alertBox) alertBox.style.display = "none";
}, 5000);

// File input label
const productImageInput = document.getElementById("productImage");
if (productImageInput) {
  productImageInput.addEventListener("change", function () {
    const fileName = this.files[0]?.name || "No file chosen";
    let label = document.getElementById("fileLabel");

    if (!label) {
      label = document.createElement("small");
      label.id = "fileLabel";
      label.className = "text-primary d-block mt-1";
      this.parentNode.appendChild(label);
    }

    label.textContent = "Selected: " + fileName;
  });
}

// TinyMCE init (use specific selector if needed)
if (document.querySelector("textarea")) {
  tinymce.init({
    selector: "textarea", // change to '#productDetailsTextarea' if only for one field
    plugins:
      "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss",
    toolbar:
      "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat",
    tinycomments_mode: "embedded",
    tinycomments_author: "Author name",
  });
}
