document.addEventListener('DOMContentLoaded', function () {
    var burguerMenu = document.getElementById("burguer_menu");
    var navItems = document.querySelector(".header-nav_items");
    burguerMenu.addEventListener("click", function () {
        if (navItems.style.maxHeight === "0rem" || navItems.style.maxHeight === "") {
            navItems.style.maxHeight = "100rem";
          } else {
            navItems.style.maxHeight = "0rem";
          }
    });
});