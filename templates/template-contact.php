<?php
/*
Template Name: Liên Hệ
*/
get_header();
?>
    <section class="mbland_contact_breadcrumb">
      <div class="container">
		<?php echo do_shortcode('[hn_breadcrumb]'); ?>
        
      </div>
    </section>



<!-- ===== START SECTION CONTACT ===== -->
<section class="mbland_homepage_contact">
  <img loading="eager" decoding="async" fetchpriority="high" class="mbland_homepage_contact_background" src="/wp-content/uploads/2026/11/background-contact-section.jpg" alt="" aria-hidden="true" />
  <div class="container">
    <div class="mbland_homepage_contact_wrapper">
      <header class="mbland_homepage_contact_header">
        <h2 class="mbland_homepage_contact_title">Liên hệ gửi yêu cầu tư vấn</h2>
        <p class="mbland_homepage_contact_desc">
          Kết nối cùng MBLand Asset Management để khám phá những cơ hội hợp tác và giải pháp đầu tư phù hợp với mục tiêu của bạn.
        </p>
      </header>
      <div class="mbland_homepage_contact_body">
        <form class="mbland_homepage_contact_form" action="#" method="post">
          <div class="mbland_homepage_contact_field mbland_homepage_contact_fieldFull">
            <label class="mbland_homepage_contact_label" for="fullname">Họ và tên</label>
            <input class="mbland_homepage_contact_input" type="text" id="fullname" name="fullname" placeholder="Nhập họ &amp; tên của bạn tại đây" autocomplete="name" required>
          </div>

          <div class="mbland_homepage_contact_field">
            <label class="mbland_homepage_contact_label" for="email">Email</label>
            <input class="mbland_homepage_contact_input" type="email" id="email" name="email" placeholder="mbland@gmail.com" autocomplete="email" required>
          </div>

          <div class="mbland_homepage_contact_field">
            <label class="mbland_homepage_contact_label" for="phone">Số điện thoại</label>
            <input class="mbland_homepage_contact_input" type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn" autocomplete="tel" pattern="[0-9+\s]{9,15}" required>
          </div>

          <div class="mbland_homepage_contact_field mbland_homepage_contact_fieldFull">
            <label class="mbland_homepage_contact_label" for="message">Nhập nội dung bạn muốn tư vấn</label>
            <textarea class="mbland_homepage_contact_textarea" id="message" name="message" placeholder="Nhập nội dung bạn muốn tư vấn"></textarea>
          </div>

          <div class="mbland_homepage_contact_submitWrap">
            <button type="submit" class="mbland_homepage_contact_submitButton">
              <span class="mbland_homepage_contact_submitLabel">Gửi yêu cầu</span>
              <svg class="mbland_homepage_contact_submitIcon" viewBox="0 0 24 24" aria-hidden="true"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- ===== END SECTION CONTACT ===== -->
<?php get_footer(); ?>