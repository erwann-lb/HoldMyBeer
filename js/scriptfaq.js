window.onload = function () {
  let navbar = document.querySelector(".navbar");

  document.querySelector("#menu-btn").onclick = () => {
    navbar.classList.toggle("active");
  };

  //PARTIE FAQ
  const toggles = document.querySelectorAll(".faq-toggle");

  toggles.forEach((toggle) => {
    toggle.addEventListener("click", () => {
      toggle.parentNode.classList.toggle("active");
    });
  });

  // SOCIAL PANEL JS
  const floating_btn = document.querySelector(".floating-btn");
  const close_btn = document.querySelector(".close-btn");
  const social_panel_container = document.querySelector(
    ".social-panel-container"
  );

  floating_btn.addEventListener("click", () => {
    social_panel_container.classList.toggle("visible");
  });

  close_btn.addEventListener("click", () => {
    social_panel_container.classList.remove("visible");
  });
  //Fin partie FAQ
};
