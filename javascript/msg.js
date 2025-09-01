document.addEventListener("DOMContentLoaded", function () {
  const msg = document.querySelector(".msg-success, .msg-error");
  if (!msg) return; 

  // Auto-hide after 4s
  setTimeout(() => {
    msg.style.transition = "all 0.5s ease";

    // Animate with Web Animations API
    const anim = msg.animate(
      [
        { right: "49px", opacity: 1 },
        { right: "-700px", opacity: 0 },
      ],
      {
        duration: 500,
        iterations: 1,
        fill: "forwards",
      }
    );

    // Remove element after animation completes
    anim.onfinish = () => msg.remove();
  }, 4000);
});
