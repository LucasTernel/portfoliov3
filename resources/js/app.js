import './bootstrap';

document.addEventListener("DOMContentLoaded", () => {
  const burger = document.querySelector("[data-burger]");
  const menu = document.querySelector("[data-mobile-menu]");

  if (!burger || !menu) return;

  const openMenu = () => {
    burger.setAttribute("aria-expanded", "true");
    menu.classList.add("open");
    menu.setAttribute("aria-hidden", "false");
    document.body.classList.add("no-scroll");
  };

  const closeMenu = () => {
    burger.setAttribute("aria-expanded", "false");
    menu.classList.remove("open");
    menu.setAttribute("aria-hidden", "true");
    document.body.classList.remove("no-scroll");
  };

  burger.addEventListener("click", () => {
    const isOpen = burger.getAttribute("aria-expanded") === "true";
    isOpen ? closeMenu() : openMenu();
  });

  // Ferme au clic sur un lien du menu
  menu.querySelectorAll("a").forEach((a) => a.addEventListener("click", closeMenu));

  // Ferme avec ESC
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeMenu();
  });

  // Ferme si clic en dehors
  document.addEventListener("click", (e) => {
    const isOpen = burger.getAttribute("aria-expanded") === "true";
    if (!isOpen) return;
    if (!menu.contains(e.target) && !burger.contains(e.target)) closeMenu();
  });
});

import.meta.glob(['../img/**']);
