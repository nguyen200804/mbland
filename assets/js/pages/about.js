// Trang giới thiệu
// ===== Swiper: showcase công ty =====
document.addEventListener("DOMContentLoaded", function () {
  if (typeof Swiper === "undefined") return;

  const showcaseList = document.querySelector(".mbland_homepage_company_showcaseList");
  if (showcaseList) {
    const brandName = document.querySelector(".mbland_homepage_company_introBrandName");
    const brandLogo = document.querySelector(".mbland_homepage_company_introBrandLogo");
    const brandDesc = document.querySelector(".mbland_homepage_company_introDesc");
    const introContent = document.querySelector(".mbland_homepage_company_introContent");

    function updateCompanyInfo(slide) {
      if (!slide) return;
      const prefix = slide.getAttribute("data-prefix");
      const logo = slide.getAttribute("data-logo");
      const desc = slide.getAttribute("data-desc");

      const allSlides = showcaseList.querySelectorAll(".mbland_homepage_company_showcaseItem");
      allSlides.forEach((s) => s.classList.remove("active"));
      slide.classList.add("active");

      if (introContent) {
        introContent.style.transition = "opacity 0.2s ease";
        introContent.style.opacity = "0.2";
        setTimeout(() => {
          if (brandLogo && logo) brandLogo.src = logo;
          if (brandDesc && desc !== null && desc !== undefined) brandDesc.innerHTML = desc.replace(/\n/g, "<br>");
          introContent.style.opacity = "1";
        }, 200);
      } else {
        if (brandLogo && logo) brandLogo.src = logo;
        if (brandDesc && desc !== null && desc !== undefined) brandDesc.innerHTML = desc.replace(/\n/g, "<br>");
      }
    }

    const swiperShowcase = new Swiper(".mbland_homepage_company_showcaseList", {
      slidesPerView: "auto",
      spaceBetween: 15,
      loop: false,
      navigation: {
        nextEl: ".mbland_homepage_company_btnNext",
        prevEl: ".mbland_homepage_company_btnPrev",
      },
      pagination: {
        el: ".mbland_homepage_company_showcasePagination",
        clickable: true,
      },
      on: {
        slideChange: function () {
          const activeSlide = this.slides[this.activeIndex];
          updateCompanyInfo(activeSlide);
        },
      },
    });

    const slides = showcaseList.querySelectorAll(".mbland_homepage_company_showcaseItem");
    slides.forEach((slide, index) => {
      slide.addEventListener("click", () => {
        swiperShowcase.slideTo(index);
        updateCompanyInfo(slide);
      });
    });
  }

  if (document.querySelector(".mbland_aboutUs_teamSection_members")) {
    new Swiper(".mbland_aboutUs_teamSection_members", {
      slidesPerView: "auto",
      spaceBetween: 24,
      loop: false,
      // navigation: {
      //   nextEl: ".mbland_aboutUs_teamSection_membersNext",
      //   prevEl: ".mbland_aboutUs_teamSection_membersPrev",
      // },
      // pagination: {
      //   el: ".mbland_aboutUs_teamSection_membersPagination",
      //   clickable: true,
      // },
      // breakpoints: {
      //   768: { slidesPerView: 2, spaceBetween: 20 },
      //   1200: { slidesPerView: 3, spaceBetween: 24 },
      // },
    });
  }
});
// ===== Kéo ngang bằng chuột =====
const carousel = document.querySelector(".hn__he-thong .carousel-he-thong");
if (carousel) {
  let isDown = false;
  let isDragging = false;
  let startX;
  let scrollLeft;

  carousel.addEventListener("mousedown", (e) => {
    isDown = true;
    isDragging = false;
    carousel.classList.add("active");
    startX = e.pageX - carousel.offsetLeft;
    scrollLeft = carousel.scrollLeft;
  });

  carousel.addEventListener("mouseleave", () => {
    isDown = false;
    carousel.classList.remove("active");
  });

  carousel.addEventListener("mouseup", () => {
    isDown = false;
    carousel.classList.remove("active");
  });

  carousel.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - carousel.offsetLeft;
    const walk = (x - startX) * 1.2; // tốc độ kéo
    if (Math.abs(walk) > 10) isDragging = true;
    carousel.scrollLeft = scrollLeft - walk;
  });
}

// ===== Các hàm hỗ trợ =====
const items = document.querySelectorAll(".hn__he-thong .item-carousel");
const leftBtn = document.querySelector(
  ".hn__he-thong .con-button .button:nth-child(1)"
);
const rightBtn = document.querySelector(
  ".hn__he-thong .con-button .button:nth-child(2)"
);

function updateContent(item) {
  document.querySelector(".hn__he-thong .sub-title").textContent =
    item.dataset.subTitle;
  document.querySelector(".hn__he-thong .title").textContent =
    item.dataset.title;
  document.querySelector(".hn__he-thong .desc").textContent = item.dataset.desc;
}

// ✅ Hiệu ứng gradient cho số .number khi active
function updateActiveNumberStyle() {
  items.forEach((item) => {
    const number = item.querySelector(".number");
    if (item.classList.contains("active")) {
      number.style.background =
        "linear-gradient(180deg, var(--primary-color) 0%, rgba(183, 12, 44, 0.05) 100%)";
      number.style.webkitBackgroundClip = "text";
      number.style.webkitTextFillColor = "transparent";
      number.style.opacity = "1";
      number.style.webkitTextStroke = "0";
    } else {
      number.style.background = "none";
      number.style.webkitBackgroundClip = "unset";
      number.style.webkitTextFillColor = "unset";
      number.style.opacity = "0.4";
      number.style.webkitTextStroke = "1px var(--primary-color)";
    }
  });
}

function scrollToItem(item, index) {
  const itemWidth = 350;
  const gap = 20;
  const scrollLeft = index * (itemWidth + gap);
  carousel.scrollTo({
    left: scrollLeft,
    behavior: "smooth",
  });
}

function goToIndex(index) {
  items.forEach((i) => i.classList.remove("active"));
  const newItem = items[index];
  newItem.classList.add("active");
  updateContent(newItem);
  scrollToItem(newItem, index);
  updateActiveNumberStyle();
}

// ===== Click vào item để cập nhật nội dung =====
items.forEach((item, index) => {
  item.addEventListener("click", () => {
    if (isDragging) return;
    items.forEach((i) => i.classList.remove("active"));
    item.classList.add("active");
    updateContent(item);
    scrollToItem(item, index);
    updateActiveNumberStyle();
  });
});

// ===== Nút chevron trái/phải =====
if (rightBtn) {
  rightBtn.addEventListener("click", () => {
    let currentIndex = Array.from(items).findIndex((item) =>
      item.classList.contains("active")
    );
    if (currentIndex === -1) currentIndex = 0;
    let newIndex = (currentIndex + 1) % items.length;
    goToIndex(newIndex);
  });
}

if (leftBtn) {
  leftBtn.addEventListener("click", () => {
    let currentIndex = Array.from(items).findIndex((item) =>
      item.classList.contains("active")
    );
    if (currentIndex === -1) currentIndex = 0;
    let newIndex = (currentIndex - 1 + items.length) % items.length;
    goToIndex(newIndex);
  });
}

// ===== Khởi tạo nội dung cho item đầu tiên =====
if (items.length > 0) {
  const firstItem = items[0];
  if (!firstItem.classList.contains("active")) {
    firstItem.classList.add("active");
  }
  updateContent(firstItem);
  scrollToItem(firstItem, 0);
  updateActiveNumberStyle();
}

// ===== Tự động cập nhật khi lướt ngang (scroll) chỉ hoạt động ở màn hình <= 992px =====
if (window.innerWidth <= 992) {
  let scrollTimeout;
  carousel.addEventListener("scroll", () => {
    clearTimeout(scrollTimeout);
    scrollTimeout = setTimeout(() => {
      const carouselCenter = carousel.scrollLeft + carousel.offsetWidth / 2;

      let closestItem = null;
      let closestDistance = Infinity;
      let closestIndex = 0;

      items.forEach((item, index) => {
        const itemCenter = item.offsetLeft + item.offsetWidth / 2;
        const distance = Math.abs(itemCenter - carouselCenter);
        if (distance < closestDistance) {
          closestDistance = distance;
          closestItem = item;
          closestIndex = index;
        }
      });

      if (closestItem && !closestItem.classList.contains("active")) {
        items.forEach((i) => i.classList.remove("active"));
        closestItem.classList.add("active");
        updateContent(closestItem);
        updateActiveNumberStyle();

        // ✅ Thêm dòng này: tự căn giữa item active
        scrollToItem(closestItem, closestIndex);
      }
    }, 35); // debounce 100ms tránh lag khi kéo
  });
}

// Safari/iOS fix: kích hoạt hover bằng click hoặc chạm
document.querySelectorAll(".hn__gia-tri .item-gia-tri").forEach((item) => {
  item.addEventListener("touchstart", function () {
    // Thêm class 'hover' để mô phỏng hiệu ứng hover
    this.classList.add("hover");
  });

  item.addEventListener("touchend", function () {
    // Gỡ class sau khi chạm ra ngoài
    setTimeout(() => this.classList.remove("hover"), 300);
  });

  // Cho phép click chuột cũng có hiệu ứng tương tự
  item.addEventListener("click", function () {
    this.classList.add("hover");
    setTimeout(() => this.classList.remove("hover"), 300);
  });
});



