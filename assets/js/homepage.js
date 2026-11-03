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

document.addEventListener("DOMContentLoaded", function () {
  new Swiper(".mbland_homepage_activities_swiper", {
    slidesPerView: "auto",
    spaceBetween: 30,
    loop: true,
  });
});