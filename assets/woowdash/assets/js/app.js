(function ($) {
  "use strict";

  // sidebar submenu collapsible js
  $(".sidebar-menu .dropdown").on("click", function () {
    var item = $(this);
    item.siblings(".dropdown").children(".sidebar-submenu").slideUp();

    item.siblings(".dropdown").removeClass("dropdown-open");

    item.siblings(".dropdown").removeClass("open");

    item.children(".sidebar-submenu").slideToggle();

    item.toggleClass("dropdown-open");
  });

  var sidebarStatus = localStorage.getItem("sidebar-active");

  if (sidebarStatus === "true") {
    $(".sidebar-toggle").addClass("active");
    $(".sidebar").addClass("active");
    $(".dashboard-main").addClass("active");
  }

  $(".sidebar-toggle").on("click", function () {
    $(this).toggleClass("active");
    $(".sidebar").toggleClass("active");
    $(".dashboard-main").toggleClass("active");

    var isActive = $(".sidebar").hasClass("active");
    localStorage.setItem("sidebar-active", isActive);
  });

  $(".sidebar-mobile-toggle").on("click", function () {
    $(".sidebar").addClass("sidebar-open");
    $("body").addClass("overlay-active");
  });

  $(".sidebar-close-btn").on("click", function () {
    $(".sidebar").removeClass("sidebar-open");
    $("body").removeClass("overlay-active");
  });

  //to keep the current page active
  $(function () {
    // 1. Ambil path utama dari URL browser saat ini (misal: "/admin/sales/penawaran")
    var currentPathname = window.location.pathname;

    for (
      var o = $("ul#sidebar-menu a")
        .filter(function () {
          // Ambil elemen path dari atribut href menu sidebar
          // Menggunakan properti DOM asli '.pathname' untuk mengambil path tanpa domain & tanpa query string
          var menuPathname = this.pathname;

          // Cegah menu 'dashboard' atau '/' ikut aktif di semua halaman
          if (menuPathname === "/" || menuPathname === "/admin") {
            return currentPathname === menuPathname;
          }

          // AKTIF JIKA: Path browser saat ini diawali dengan path dari menu sidebar tersebut
          // Mengatasi: /admin/sales/penawaran?data=2 DAN /admin/sales/penawaran/add-penawaran
          return currentPathname.indexOf(menuPathname) === 0;
        })
        .addClass("active-page") // anchor
        .parent()
        .addClass("active-page"); // li
      ;
    ) {
      if (!o.is("li")) break;
      o = o.parent().addClass("show").parent().addClass("open");
    }
  });

  /**
   * Utility function to calculate the current theme setting based on localStorage.
   */
  function calculateSettingAsThemeString({ localStorageTheme }) {
    if (localStorageTheme !== null) {
      return localStorageTheme;
    }
    return "light"; // default to light theme if nothing is stored
  }

  /**
   * Utility function to update the button text and aria-label.
   */
  function updateButton({ buttonEl, isDark }) {
    const newCta = isDark ? "dark" : "light";
    buttonEl.setAttribute("aria-label", newCta);
    buttonEl.innerText = newCta;
  }

  /**
   * Utility function to update the theme setting on the html tag.
   */
  function updateThemeOnHtmlEl({ theme }) {
    document.querySelector("html").setAttribute("data-theme", theme);
  }

  /**
   * 1. Grab what we need from the DOM and system settings on page load.
   */
  const button = document.querySelector("[data-theme-toggle]");
  const localStorageTheme = localStorage.getItem("theme");

  /**
   * 2. Work out the current site settings.
   */
  let currentThemeSetting = calculateSettingAsThemeString({
    localStorageTheme,
  });

  function calculateSettingAsThemeString({ localStorageTheme }) {
    // Jika user sudah pernah memilih manual, pakai pilihan itu
    if (localStorageTheme !== null) {
      return localStorageTheme;
    }

    // Jika belum ada pilihan manual (baru pertama buka), cek sistem Android/Chrome
    const systemSettingDark = window.matchMedia("(prefers-color-scheme: dark)");
    if (systemSettingDark.matches) {
      return "dark";
    }

    return "light";
  }
  /**
   * 3. If the button exists, update the theme setting and button text according to current settings.
   */
  if (button) {
    updateButton({ buttonEl: button, isDark: currentThemeSetting === "dark" });
    updateThemeOnHtmlEl({ theme: currentThemeSetting });

    /**
     * 4. Add an event listener to toggle the theme.
     */
    button.addEventListener("click", (event) => {
      const newTheme = currentThemeSetting === "dark" ? "light" : "dark";

      localStorage.setItem("theme", newTheme);
      updateButton({ buttonEl: button, isDark: newTheme === "dark" });
      updateThemeOnHtmlEl({ theme: newTheme });

      currentThemeSetting = newTheme;
    });
  } else {
    // If no button is found, just apply the current theme to the page
    updateThemeOnHtmlEl({ theme: currentThemeSetting });
  }

  // Listener untuk mendeteksi perubahan tema sistem secara real-time
  window
    .matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", (e) => {
      // Kita hanya ubah otomatis jika user BELUM pernah menset tema secara manual
      if (!localStorage.getItem("theme")) {
        const newTheme = e.matches ? "dark" : "light";

        updateThemeOnHtmlEl({ theme: newTheme });
        if (button) {
          updateButton({ buttonEl: button, isDark: e.matches });
        }
        currentThemeSetting = newTheme;
      }
    });

  // =========================== Table Header Checkbox checked all js Start ================================
  $("#selectAll").on("change", function () {
    $(".form-check .form-check-input").prop("checked", $(this).prop("checked"));
  });

  // Remove Table Tr when click on remove btn start
  $(".remove-btn").on("click", function () {
    $(this).closest("tr").remove();

    // Check if the table has no rows left
    if ($(".table tbody tr").length === 0) {
      $(".table").addClass("bg-danger");

      // Show notification
      $(".no-items-found").show();
    }
  });
  // Remove Table Tr when click on remove btn end
})(jQuery);
