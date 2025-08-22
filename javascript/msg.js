document.addEventListener("DOMContentLoaded", function () {
    const msg = document.querySelector(".msg-success, .msg-error");
    if (msg) {
      setTimeout(() => {
          msg.style.transition = "opacity 0.5s ease";
          msg.style.opacity = "0";
          setTimeout(() => msg.remove(), 500); // remove from DOM after fade
      }, 4000); // disappear after 4 seconds
    }
});