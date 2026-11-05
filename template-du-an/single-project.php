<?php
/*
Template Name: Chi tiết dự án
*/

// Lấy ID của page/post hiện tại
$post_id = get_the_ID();

// Lấy dữ liệu từ ACF fields
$banner = get_field('banner', $post_id);
$banner_url = '';
$banner_alt = '';
$banner_title = '';
if (!empty($banner) && is_array($banner)) {
    $banner_url = $banner['url'];
    $banner_alt = $banner['alt'] ?: get_the_title($post_id); // Fallback alt từ title nếu không có
    $banner_title = $banner['title'] ?: get_the_title($post_id); // Fallback title từ title nếu không có
}

$sub_title = get_field('sub_title', $post_id) ?: ''; // Subtitle từ field

$location = get_field('location', $post_id) ?: ''; // Địa chỉ từ field

$scale = get_field('scale', $post_id) ?: ''; // Quy mô từ field

// Nội dung: Sử dụng wp_kses_post để sanitize
$content = wp_kses_post(get_field('content', $post_id));

// Featured image cho image cuối (sidebar)
$featured_image_url = get_the_post_thumbnail_url($post_id); // Hoặc 'full' nếu cần kích thước lớn hơn
$featured_image_alt = get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true) ?: get_the_title($post_id);
$featured_image_title = get_the_title($post_id); // Title fallback từ post title

// Dự án liên quan
$related_args = array(
    'post_type' => 'du-an', // Thay nếu post type khác
    'post__not_in' => array($post_id),
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
	'tax_query' => array(
        array(
            'taxonomy' => 'danh-muc-du-an', 
            'field'    => 'slug',
            'terms'    => 'dau-tu-tai-chinh',
            'operator' => 'NOT IN',
        ),
    ),
);
$related_query = new WP_Query($related_args);
get_header();
?>




<!-- ===== START SECTION LINH VUC HERO ===== -->
<section class="mbland_linhvuc_hero">
	<?php if ( $term_image_url ) : ?>
	<img class="mbland_linhvuc_hero_background" src="<?php echo esc_url( $term_image_url ); ?>" alt="<?php echo esc_attr( $term_image_alt ); ?>" title="<?php echo esc_attr( $current_term->name ); ?>" loading="eager" decoding="async" fetchpriority="high" />
	<?php endif; ?>
	<div class="mbland_linhvuc_hero_inner">
		<div class="container mbland_linhvuc_hero_container">
			<div class="mbland_linhvuc_hero_content">
				<div class="mbland_linhvuc_hero_breadcrumb"><?php echo do_shortcode('[hn_breadcrumb]'); ?></div>
				
			</div>
			<div class="mbland_linhvuc_hero_aside">

			</div>

		</div>

	</div>
	<div class="mbland_linhvuc_hero_featured">
		<div class="container mbland_linhvuc_hero_featuredContainer">
			<div class="mbland_linhvuc_hero_featuredInfo">
				<h1 class="mbland_linhvuc_hero_featuredTitle">Thảo Điền Boutique Marina</h1>
				<p class="mbland_linhvuc_hero_featuredSubTitle">Khu căn hộ Resort cao cấp Thảo Điền Boutique Marina</p>
				<div class="mbland_linhvuc_hero_featuredDecor">
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
				</div>
				<hr class="mbland_linhvuc_hero_featuredDivider" />
				<p class="mbland_linhvuc_hero_featuredDesc">Được quy hoạch theo mô hình tổ hợp khép kín, dự án tích hợp hệ thống tiện ích và dịch vụ hiện đại, bao gồm khách sạn, nhà hàng, bến du thuyền, spa,.... Mang đến trải nghiệm trọn vẹn trong một không gian tiện nghi, riêng tư và đẳng cấp.</p>
				
				<hr class="mbland_linhvuc_hero_featuredDivider" />
				<div class="mbland_linhvuc_hero_featuredLocation">
					<span class="mbland_linhvuc_hero_featuredLocationIcon"><svg  viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 1.125C7.35957 1.12694 5.78688 1.77945 4.62692 2.93941C3.46696 4.09938 2.81444 5.67207 2.8125 7.3125C2.811 8.65299 3.24884 9.95704 4.059 11.025C4.059 11.025 4.22775 11.2472 4.25532 11.2793L9 16.875L13.7469 11.2764C13.7717 11.2466 13.941 11.025 13.941 11.025L13.9416 11.0233C14.7512 9.95574 15.1888 8.65235 15.1875 7.3125C15.1856 5.67207 14.5331 4.09938 13.3731 2.93941C12.2131 1.77945 10.6404 1.12694 9 1.125ZM9 9.5625C8.555 9.5625 8.11998 9.43054 7.74997 9.18331C7.37996 8.93607 7.09157 8.58467 6.92127 8.17354C6.75098 7.7624 6.70642 7.31 6.79324 6.87355C6.88005 6.43709 7.09434 6.03618 7.40901 5.72151C7.72368 5.40684 8.12459 5.19255 8.56105 5.10573C8.99751 5.01892 9.44991 5.06347 9.86104 5.23377C10.2722 5.40407 10.6236 5.69246 10.8708 6.06247C11.118 6.43248 11.25 6.86749 11.25 7.3125C11.2493 7.90901 11.012 8.48087 10.5902 8.90267C10.1684 9.32446 9.59651 9.56176 9 9.5625Z" fill="currentColor"/>
						</svg>
					</span>
					<div class="mbland_linhvuc_hero_featuredLocationText">
						<p class="mbland_linhvuc_hero_featuredLocationLabel">Vị trí DỰ ÁN</p>
						<p class="mbland_linhvuc_hero_featuredLocationValue">Số 68 An Phú, Phường An Khánh, Thành phố Hồ Chí Minh</p>
					</div>

				</div>
				<div class="mbland_linhvuc_hero_featuredLocation">
					<span class="mbland_linhvuc_hero_featuredLocationIcon"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_3093_10328)">
<path d="M15.0003 4.16675L10.0003 6.66675V1.66675L15.0003 4.16675Z" fill="currentColor"/>
<path d="M10.0003 6.66675L15.0003 4.16675L10.0003 1.66675V6.66675ZM10.0003 6.66675V10.0001M6.66692 9.99175L2.08359 12.6084C1.95534 12.6811 1.84867 12.7865 1.77445 12.9139C1.70024 13.0412 1.66113 13.186 1.66113 13.3334C1.66113 13.4808 1.70024 13.6256 1.77445 13.753C1.84867 13.8803 1.95534 13.9857 2.08359 14.0584L9.16692 18.1084C9.42029 18.2547 9.7077 18.3317 10.0003 18.3317C10.2928 18.3317 10.5802 18.2547 10.8336 18.1084L17.9169 14.0584C18.0452 13.9857 18.1518 13.8803 18.2261 13.753C18.3003 13.6256 18.3394 13.4808 18.3394 13.3334C18.3394 13.186 18.3003 13.0412 18.2261 12.9139C18.1518 12.7865 18.0452 12.6811 17.9169 12.6084L13.3336 10.0001M5.40859 10.7084L14.5919 15.9584M14.5919 10.7084L5.41692 15.9584" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"/>
</g>
<defs>
<clipPath id="clip0_3093_10328">
<rect width="20" height="20" fill="currentColor"/>
</clipPath>
</defs>
</svg>

					</span>
					<div class="mbland_linhvuc_hero_featuredLocationText">
						<p class="mbland_linhvuc_hero_featuredLocationLabel">Quy mô bất động sản</p>
						<p class="mbland_linhvuc_hero_featuredLocationValue">Khu nghĩ dưỡng phức hợp sang trọng & cao cấp</p>
					</div>

				</div>
			</div>
			

		</div>

	</div>
</section>
<!-- ===== END SECTION LINH VUC HERO ===== -->










<section class="hn-chitietduan-banner">
	<div class="container"><?php echo do_shortcode('[hn_breadcrumb]'); ?></div>
	<img
		 src="<?php echo esc_url($banner_url); ?>"
		 alt="<?php echo esc_attr($banner_alt); ?>"
		 title="<?php echo esc_attr($banner_title); ?>"
	/>
</section>

<section class="hn-chitietduan-content">
	<div class="container">
		<div class="hn-chitietduan-content-1">
			<h1 class="equalh2">
				<?php the_title(); ?>
			</h1>
			<subtitle><?php echo wp_kses_post($sub_title); ?></subtitle>
			<div class="line"></div>
			<div>
				<?php echo $content; ?>
			</div>
			
			<div class="hn-tasmania-chitietduan-item">
				<div class="hn-tasmania-chitietduan-item-icon">
					<img src="/wp-content/uploads/2025/10/Location.svg" alt="Vị trí" title="Vị trí"/>
				</div>
				<div class="hn-tasmania-chitietduan-item-text-wrapper">
					<span><?php echo pll__('VỊ TRÍ'); ?></span>
					<div class="hn-tasmania-chitietduan-text">
						<?php echo wp_kses_post($location); ?>
					</div>
				</div>
			</div>
			<div class="hn-tasmania-chitietduan-item">
				<div class="hn-tasmania-chitietduan-item-icon">
					<img src="/wp-content/uploads/2025/10/quy-mo.svg" alt="Quy mô" title="Quy mô"/>
				</div>
				<div class="hn-tasmania-chitietduan-item-text-wrapper">
					<span><?php echo pll__('QUY MÔ'); ?></span>
					<div class="hn-tasmania-chitietduan-text">
						<?php echo wp_kses_post($scale); ?>
					</div>
				</div>
			</div>

		</div>
		<div class="hn-tasmania-chitietduan-item-image">
			<img
			 src="<?php echo esc_url($featured_image_url); ?>"
			 alt="<?php echo esc_attr($featured_image_alt); ?>"
			 title="<?php echo esc_attr($featured_image_title); ?>"
		/>
		</div>
	</div>
</section>

<section class="hn-related-projects">
	<div class="container">
		<h2><?php echo pll__('Dự án khác'); ?></h2>
		<p>
			<?php echo pll__('Tasmania & Partner là tập đoàn đa ngành với những dự án nổi bật trong suốt quá trình phát triển'); ?>
		</p>
		<div class="hn-related-projects-slider swiper">
			<div class="swiper-wrapper">
				<?php if ($related_query->have_posts()) : ?>
					<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
						<div class="swiper-slide">
							<?php
							$banner_image = get_field('banner', get_the_ID());
							$banner_image_url = $banner_image['url'] ?? '';
							$banner_image_title = $banner_image['title'] ?? '';
							$item_title = get_the_title();
	$item_sub_title = wp_kses_post( get_field('sub_title'));
    $item_mo_ta = wp_kses_post( get_field( 'short_content' )  );
    $item_dia_chi = wp_kses_post( get_field( 'location' ));
							?>
							<div class="hn-tasmania-projects-item">
							  <div class="hn-tasmania-projects-item-image">
								<img
										src="<?php echo esc_url( $banner_image_url ); ?>"
										alt="<?php echo esc_attr($banner_image_title ); ?>"
										title="<?php echo esc_attr($banner_image_title ); ?>"
									/>
							  </div>
							  <div class="hn-tasmania-projects-item-content">
								  <div class="hn-tasmania-projects-item-content-1">

								  </div>
								  <div class="hn-tasmania-projects-item-content-2">
									  <a href="<?php the_permalink(); ?>" title="<?php echo $item_title ?>">
										<h3 class="small-h3"><?php echo $item_title ?></h3>
										</a>
									  <div class="hn-tasmania-projects-item-content-location">
										  <img src="/wp-content/uploads/2025/10/location.svg" alt="Vị trí" title="Vị trí"/>
										  <div>
											  <?php echo $item_dia_chi?>
										  </div>
									  </div>

									  <a href="<?php the_permalink(); ?>" title="<?php echo $item_title ?>" class="hn-tasmania-projects-view-detail">
										View detail
										</a>
								  </div>
							  </div>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<div class="swiper-slide">
						<p>Không có dự án liên quan.</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
<?php add_action('wp_footer', function () { ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.hn-related-projects-slider', {
            // Cấu hình cơ bản: slides per view = 3, space between = 30px
            slidesPerView: 'auto',
            spaceBetween: 20,
        });
    });
</script>
<?php }, 99); ?>
	</div>
</section>
<?php get_footer(); ?>