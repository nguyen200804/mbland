<?php
/*
Template Name: Contact
*/
get_header();
?>
<section class="hn-tasmania-contact">
  <div class="container">
		<?php echo do_shortcode('[hn_breadcrumb]'); ?>
    <div class="hn__banner">
      <img
        src="/wp-content/uploads/2025/10/about-banner.png"
            alt="Banner Liên hệ"
            class="img-banner-lien-he" title="Banner Liên hệ"
            loading="eager"
            decoding="async"
            fetchpriority="high"
            <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/about-banner.png', 1920, 700 ) ); ?>
      />
    </div>

    <div class="hn__lienhe">
      <div class="left">
        <h1>Contact Us</h1>
        <div class="container-location">

          <div class="location">
            <div class="title">
              <h2 class="tru-so">Head Office</h2>
            </div>
            <div class="dia-chi">
              <div class="title">
                <img src="/wp-content/uploads/2025/10/Location.svg" alt="Location" class="icon-location" title="Location" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Location.svg', 24, 24 ) ); ?> />
                 <p class="desc">113 Nguyen Van Huong, An Khanh Ward, Ho Chi Minh City.
              </p>
              </div>
            </div>
            <div class="phone-number">
              <div class="title">
                <img src="/wp-content/uploads/2025/10/phone-red.svg" alt="Phone" class="icon-location" title="Phone" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/phone-red.svg', 24, 24 ) ); ?> />
                 <p class="desc"><a href="tel:+842838258816" title="Phone & Tax">(+84) 28 3825 8816</a></p>
              </div>
            </div>
            <div class="email">
              <div class="title">
                <img src="/wp-content/uploads/2025/10/email-red.svg" alt="Email" class="icon-location" title="Email" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/email-red.svg', 24, 24 ) ); ?> />
                <p class="desc">info@fsinvest.vn</p>
              </div>
            </div>
          </div>

          <div class="location">
            <div class="title">
              <h2 class="tru-so">Hanoi Office</h2>
            </div>
            <div class="dia-chi">
              <div class="title">
                <img src="/wp-content/uploads/2025/10/Location.svg" alt="Location" class="icon-location" title="Location" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Location.svg', 24, 24 ) ); ?> />
               <p class="desc"> 12 Hang Dieu, Hoan Kiem Ward, Ha Noi
              </p>
              </div>
            </div>
            <div class="phone-number">
              <div class="title">
                <img src="/wp-content/uploads/2025/10/phone-red.svg" alt="Phone" class="icon-location" title="Phone" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/phone-red.svg', 24, 24 ) ); ?> />
                <p class="desc"><a href="tel:+842462764209" title="Phone & Tax">(+84) 24 6276 4209</a></p>
              </div>
            </div>
          </div>

          <div class="location">
            <div class="title">
              <h2 class="tru-so">Da Nang Office</h2>
            </div>
            <div class="dia-chi">
              <div class="title">
                <img src="/wp-content/uploads/2025/10/Location.svg" alt="Location" class="icon-location" title="Location" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Location.svg', 24, 24 ) ); ?> />
                <p class="desc">Hilton Building, 50 Bach Dang Street, Hai Chau Ward, Da Nang City
              </p>
              </div>
            </div>
            <div class="phone-number">
              <div class="title">
                <img src="/wp-content/uploads/2025/10/phone-red.svg" alt="Phone" class="icon-location" title="Phone" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/phone-red.svg', 24, 24 ) ); ?> />
                 <p class="desc"><a href="tel:+84935167672" title="Phone & Tax">(+84) 93 516 7672</a></p>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="right">
        <img
          src="/wp-content/uploads/2025/10/cong-trinh.png"
          alt="Tasmania Project"
          class="img-lien-he" title="Tasmania Project"
          loading="lazy"
          decoding="async"
          fetchpriority="low"
          <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/cong-trinh.png', 1200, 800 ) ); ?>
        />
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
