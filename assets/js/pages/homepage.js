// Trang chủ
const branchItems = document.querySelectorAll(".mbland_homepage_branches_item");

branchItems.forEach((item) => {
  item.addEventListener("click", () => {
    document
      .querySelector(".mbland_homepage_branches_itemActive")
      .classList.remove("mbland_homepage_branches_itemActive");
    item.classList.add("mbland_homepage_branches_itemActive");
  });
});

// Thêm sự kiện click cho scroll to explore để scroll xuống section about (giả sử là section info tiếp theo, vì scroll to explore nằm trong about)
document.addEventListener("DOMContentLoaded", function () {
  const scrollToExplore = document.querySelector(
    ".mbland_homepage_about_scrollToExplore"
  );
  if (scrollToExplore) {
    scrollToExplore.addEventListener("click", function () {
      const targetSection = document.querySelector(".mbland_homepage_info");
      if (targetSection) {
        targetSection.scrollIntoView({ behavior: "smooth" });
      }
    });
  }
});

// Swiper chỉ dùng cho slider Hoạt động ở cuối trang => chỉ tải CSS/JS Swiper
// khi section sắp vào viewport (giảm "JavaScript không dùng đến" lúc tải trang).
(function () {
  var SWIPER_VER = "11";
  var SWIPER_CSS = "https://cdn.jsdelivr.net/npm/swiper@" + SWIPER_VER + "/swiper-bundle.min.css";
  var SWIPER_JS = "https://cdn.jsdelivr.net/npm/swiper@" + SWIPER_VER + "/swiper-bundle.min.js";
  var loaded = false;

  function initSlider() {
    new Swiper(".mbland_homepage_activities_swiper", {
      slidesPerView: "auto",
      spaceBetween: 0,
      loop: true,
    });
  }

  function loadSwiper() {
    if (loaded) return;
    loaded = true;

    if (typeof window.Swiper === "function") {
      initSlider();
      return;
    }

    var link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = SWIPER_CSS;
    document.head.appendChild(link);

    var script = document.createElement("script");
    script.src = SWIPER_JS;
    script.async = true;
    script.onload = initSlider;
    document.body.appendChild(script);
  }

  function setup() {
    var el = document.querySelector(".mbland_homepage_activities_swiper");
    if (!el) return;

    if (!("IntersectionObserver" in window)) {
      loadSwiper();
      return;
    }

    var io = new IntersectionObserver(
      function (entries) {
        if (entries[0].isIntersecting) {
          io.disconnect();
          loadSwiper();
        }
      },
      { rootMargin: "600px 0px" }
    );
    io.observe(el);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", setup);
  } else {
    setup();
  }
})();