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

// Album ảnh Gallery
$gallery = get_field('gallery', $post_id);

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









<section class="mbland_singleProject_details">
	<div class="container">
		<div class="mbland_singleProject_details_wrapper">
			<!-- Cột 1: Thông tin tổng quan dự án -->
			<div class="mbland_singleProject_details_colInfo">
				<header class="mbland_singleProject_details_header">
					<h2 class="mbland_singleProject_details_title">Tổng quan dự án</h2>
					<p class="mbland_singleProject_details_subtitle"><?php echo esc_html( $sub_title ?: 'Thảo Điền Boutique Marina' ); ?></p>
				</header>
				<div class="mbland_singleProject_details_content">
					<?php if ( ! empty( $content ) ) : ?>
						<?php echo $content; ?>
					<?php else : ?>
						<p>Dự án được quy hoạch theo mô hình tổ hợp khép kín với các tiêu chuẩn quốc tế, mang đến không gian sống đẳng cấp, biệt lập và tiện nghi bậc nhất khu vực.</p>
					<?php endif; ?>
				</div>
			</div>

			<!-- Cột 2: Gallery ảnh dạng Swiper (ảnh to ở trên, 3 ảnh thumbs ở dưới) -->
			<div class="mbland_singleProject_details_colGallery">
				<div class="mbland_singleProject_gallery">
					
					<!-- Swiper ảnh lớn chính (Main Slider) -->
					<div class="swiper mbland_singleProject_gallery_main">
						<div class="swiper-wrapper">
							<?php if ( ! empty( $gallery ) && is_array( $gallery ) ) : ?>
								<?php foreach ( $gallery as $img ) : 
									$img_url = is_array( $img ) ? ( $img['url'] ?? '' ) : ( is_numeric( $img ) ? wp_get_attachment_image_url( $img, 'full' ) : $img );
									$img_alt = is_array( $img ) ? ( $img['alt'] ?? get_the_title( $post_id ) ) : get_the_title( $post_id );
								?>
									<div class="swiper-slide mbland_singleProject_gallery_mainSlide">
										<img class="mbland_singleProject_gallery_mainImage" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" loading="lazy" />
									</div>
								<?php endforeach; ?>
							<?php else : ?>
								<!-- Ảnh mẫu demo khớp theo thiết kế -->
								<div class="swiper-slide mbland_singleProject_gallery_mainSlide">
									<img class="mbland_singleProject_gallery_mainImage" src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80" alt="Hilton Sky View" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_mainSlide">
									<img class="mbland_singleProject_gallery_mainImage" src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80" alt="Kiến trúc xanh & Tiện ích" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_mainSlide">
									<img class="mbland_singleProject_gallery_mainImage" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80" alt="Cảnh quan ven sông" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_mainSlide">
									<img class="mbland_singleProject_gallery_mainImage" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80" alt="Quy hoạch tổng thể" />
								</div>
							<?php endif; ?>
						</div>
					</div>

					<!-- Swiper ảnh thumbnail thu nhỏ bên dưới (Thumbs Slider) -->
					<div class="swiper mbland_singleProject_gallery_thumbs">
						<div class="swiper-wrapper">
							<?php if ( ! empty( $gallery ) && is_array( $gallery ) ) : ?>
								<?php foreach ( $gallery as $img ) : 
									$img_url = is_array( $img ) ? ( $img['url'] ?? '' ) : ( is_numeric( $img ) ? wp_get_attachment_image_url( $img, 'medium_large' ) : $img );
									$img_alt = is_array( $img ) ? ( $img['alt'] ?? get_the_title( $post_id ) ) : get_the_title( $post_id );
								?>
									<div class="swiper-slide mbland_singleProject_gallery_thumbSlide">
										<img class="mbland_singleProject_gallery_thumbImage" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" loading="lazy" />
									</div>
								<?php endforeach; ?>
							<?php else : ?>
								<!-- Ảnh thumbnail mẫu demo -->
								<div class="swiper-slide mbland_singleProject_gallery_thumbSlide">
									<img class="mbland_singleProject_gallery_thumbImage" src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=400&q=80" alt="Hilton Sky View" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_thumbSlide">
									<img class="mbland_singleProject_gallery_thumbImage" src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=400&q=80" alt="Kiến trúc xanh & Tiện ích" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_thumbSlide">
									<img class="mbland_singleProject_gallery_thumbImage" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Cảnh quan ven sông" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_thumbSlide">
									<img class="mbland_singleProject_gallery_thumbImage" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=400&q=80" alt="Quy hoạch tổng thể" />
								</div>
							<?php endif; ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>

<!-- Script khởi tạo Swiper Thumbs Gallery -->
<script>
document.addEventListener('DOMContentLoaded', function () {
	if (typeof Swiper === 'undefined') return;

	// 1. Khởi tạo slider thumbnail bên dưới
	var galleryThumbs = new Swiper('.mbland_singleProject_gallery_thumbs', {
		spaceBetween: 12,
		slidesPerView: 3,
		freeMode: true,
		watchSlidesProgress: true,
	});

	// 2. Khởi tạo slider ảnh lớn bên trên liên kết với thumbnail
	var galleryMain = new Swiper('.mbland_singleProject_gallery_main', {
		spaceBetween: 16,
		thumbs: {
			swiper: galleryThumbs,
		},
	});
});
</script>





<section class="mbland_singleProject_statistical">
	<div class="container">
		<div class="mbland_singleProject_statistical_wrapper">
			<div class="mbland_singleProject_statistical_list">
				
				<article class="mbland_singleProject_statistical_item">
					<div class="mbland_singleProject_statistical_itemTop">
						<span class="mbland_singleProject_statistical_itemIcon">
							<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="50" height="50" rx="8" fill="#FFEFEF"/>
								<path d="M25 18.601L34.5933 13.8005L25 9V18.601ZM25 18.601V25.0016M18.6044 24.9856L9.81055 30.0102C9.56449 30.1497 9.35982 30.3521 9.21742 30.5967C9.07503 30.8412 9 31.1192 9 31.4023C9 31.6854 9.07503 31.9633 9.21742 32.2079C9.35982 32.4525 9.56449 32.6549 9.81055 32.7944L23.4011 40.5712C23.8872 40.8521 24.4387 41 25 41C25.5613 41 26.1128 40.8521 26.5989 40.5712L40.1894 32.7944C40.4355 32.6549 40.6402 32.4525 40.7826 32.2079C40.925 31.9633 41 31.6854 41 31.4023C41 31.1192 40.925 30.8412 40.7826 30.5967C40.6402 30.3521 40.4355 30.1497 40.1894 30.0102L31.3956 25.0016M16.1901 26.3618L33.8099 36.4428M33.8099 26.3618L16.2061 36.4428" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke="#EC1846"/>
							</svg>
						</span>
						<span class="mbland_singleProject_statistical_itemValue">3.209,2 m2</span>
					</div>
					<div class="mbland_singleProject_statistical_itemBody">
						<h3 class="mbland_singleProject_statistical_itemTitle">Tổng diện tích thửa đất</h3>
						<p class="mbland_singleProject_statistical_itemDesc">Tổng hợp diện tích đất theo hồ sơ pháp lý và thông tin được ghi nhận trên hệ thống.</p>
					</div>
				</article>

				<article class="mbland_singleProject_statistical_item">
					<div class="mbland_singleProject_statistical_itemTop">
						<span class="mbland_singleProject_statistical_itemIcon">
							<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="50" height="50" rx="8" fill="#FFEFEF"/>
								<path d="M25 18.601L34.5933 13.8005L25 9V18.601ZM25 18.601V25.0016M18.6044 24.9856L9.81055 30.0102C9.56449 30.1497 9.35982 30.3521 9.21742 30.5967C9.07503 30.8412 9 31.1192 9 31.4023C9 31.6854 9.07503 31.9633 9.21742 32.2079C9.35982 32.4525 9.56449 32.6549 9.81055 32.7944L23.4011 40.5712C23.8872 40.8521 24.4387 41 25 41C25.5613 41 26.1128 40.8521 26.5989 40.5712L40.1894 32.7944C40.4355 32.6549 40.6402 32.4525 40.7826 32.2079C40.925 31.9633 41 31.6854 41 31.4023C41 31.1192 40.925 30.8412 40.7826 30.5967C40.6402 30.3521 40.4355 30.1497 40.1894 30.0102L31.3956 25.0016M16.1901 26.3618L33.8099 36.4428M33.8099 26.3618L16.2061 36.4428" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke="#EC1846"/>
							</svg>
						</span>
						<span class="mbland_singleProject_statistical_itemValue">3.209,2 m2</span>
					</div>
					<div class="mbland_singleProject_statistical_itemBody">
						<h3 class="mbland_singleProject_statistical_itemTitle">Tổng diện tích thửa đất</h3>
						<p class="mbland_singleProject_statistical_itemDesc">Tổng hợp diện tích đất theo hồ sơ pháp lý và thông tin được ghi nhận trên hệ thống.</p>
					</div>
				</article>

				<article class="mbland_singleProject_statistical_item">
					<div class="mbland_singleProject_statistical_itemTop">
						<span class="mbland_singleProject_statistical_itemIcon">
							<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="50" height="50" rx="8" fill="#FFEFEF"/>
								<path d="M25 18.601L34.5933 13.8005L25 9V18.601ZM25 18.601V25.0016M18.6044 24.9856L9.81055 30.0102C9.56449 30.1497 9.35982 30.3521 9.21742 30.5967C9.07503 30.8412 9 31.1192 9 31.4023C9 31.6854 9.07503 31.9633 9.21742 32.2079C9.35982 32.4525 9.56449 32.6549 9.81055 32.7944L23.4011 40.5712C23.8872 40.8521 24.4387 41 25 41C25.5613 41 26.1128 40.8521 26.5989 40.5712L40.1894 32.7944C40.4355 32.6549 40.6402 32.4525 40.7826 32.2079C40.925 31.9633 41 31.6854 41 31.4023C41 31.1192 40.925 30.8412 40.7826 30.5967C40.6402 30.3521 40.4355 30.1497 40.1894 30.0102L31.3956 25.0016M16.1901 26.3618L33.8099 36.4428M33.8099 26.3618L16.2061 36.4428" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke="#EC1846"/>
							</svg>
						</span>
						<span class="mbland_singleProject_statistical_itemValue">3.209,2 m2</span>
					</div>
					<div class="mbland_singleProject_statistical_itemBody">
						<h3 class="mbland_singleProject_statistical_itemTitle">Tổng diện tích thửa đất</h3>
						<p class="mbland_singleProject_statistical_itemDesc">Tổng hợp diện tích đất theo hồ sơ pháp lý và thông tin được ghi nhận trên hệ thống.</p>
					</div>
				</article>

				<article class="mbland_singleProject_statistical_item">
					<div class="mbland_singleProject_statistical_itemTop">
						<span class="mbland_singleProject_statistical_itemIcon">
							<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="50" height="50" rx="8" fill="#FFEFEF"/>
								<path d="M25 18.601L34.5933 13.8005L25 9V18.601ZM25 18.601V25.0016M18.6044 24.9856L9.81055 30.0102C9.56449 30.1497 9.35982 30.3521 9.21742 30.5967C9.07503 30.8412 9 31.1192 9 31.4023C9 31.6854 9.07503 31.9633 9.21742 32.2079C9.35982 32.4525 9.56449 32.6549 9.81055 32.7944L23.4011 40.5712C23.8872 40.8521 24.4387 41 25 41C25.5613 41 26.1128 40.8521 26.5989 40.5712L40.1894 32.7944C40.4355 32.6549 40.6402 32.4525 40.7826 32.2079C40.925 31.9633 41 31.6854 41 31.4023C41 31.1192 40.925 30.8412 40.7826 30.5967C40.6402 30.3521 40.4355 30.1497 40.1894 30.0102L31.3956 25.0016M16.1901 26.3618L33.8099 36.4428M33.8099 26.3618L16.2061 36.4428" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke="#EC1846"/>
							</svg>
						</span>
						<span class="mbland_singleProject_statistical_itemValue">3.209,2 m2</span>
					</div>
					<div class="mbland_singleProject_statistical_itemBody">
						<h3 class="mbland_singleProject_statistical_itemTitle">Tổng diện tích thửa đất</h3>
						<p class="mbland_singleProject_statistical_itemDesc">Tổng hợp diện tích đất theo hồ sơ pháp lý và thông tin được ghi nhận trên hệ thống.</p>
					</div>
				</article>

				<article class="mbland_singleProject_statistical_item">
					<div class="mbland_singleProject_statistical_itemTop">
						<span class="mbland_singleProject_statistical_itemIcon">
							<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="50" height="50" rx="8" fill="#FFEFEF"/>
								<path d="M25 18.601L34.5933 13.8005L25 9V18.601ZM25 18.601V25.0016M18.6044 24.9856L9.81055 30.0102C9.56449 30.1497 9.35982 30.3521 9.21742 30.5967C9.07503 30.8412 9 31.1192 9 31.4023C9 31.6854 9.07503 31.9633 9.21742 32.2079C9.35982 32.4525 9.56449 32.6549 9.81055 32.7944L23.4011 40.5712C23.8872 40.8521 24.4387 41 25 41C25.5613 41 26.1128 40.8521 26.5989 40.5712L40.1894 32.7944C40.4355 32.6549 40.6402 32.4525 40.7826 32.2079C40.925 31.9633 41 31.6854 41 31.4023C41 31.1192 40.925 30.8412 40.7826 30.5967C40.6402 30.3521 40.4355 30.1497 40.1894 30.0102L31.3956 25.0016M16.1901 26.3618L33.8099 36.4428M33.8099 26.3618L16.2061 36.4428" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke="#EC1846"/>
							</svg>
						</span>
						<span class="mbland_singleProject_statistical_itemValue">3.209,2 m2</span>
					</div>
					<div class="mbland_singleProject_statistical_itemBody">
						<h3 class="mbland_singleProject_statistical_itemTitle">Tổng diện tích thửa đất</h3>
						<p class="mbland_singleProject_statistical_itemDesc">Tổng hợp diện tích đất theo hồ sơ pháp lý và thông tin được ghi nhận trên hệ thống.</p>
					</div>
				</article>

				<article class="mbland_singleProject_statistical_item">
					<div class="mbland_singleProject_statistical_itemTop">
						<span class="mbland_singleProject_statistical_itemIcon">
							<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="50" height="50" rx="8" fill="#FFEFEF"/>
								<path d="M25 18.601L34.5933 13.8005L25 9V18.601ZM25 18.601V25.0016M18.6044 24.9856L9.81055 30.0102C9.56449 30.1497 9.35982 30.3521 9.21742 30.5967C9.07503 30.8412 9 31.1192 9 31.4023C9 31.6854 9.07503 31.9633 9.21742 32.2079C9.35982 32.4525 9.56449 32.6549 9.81055 32.7944L23.4011 40.5712C23.8872 40.8521 24.4387 41 25 41C25.5613 41 26.1128 40.8521 26.5989 40.5712L40.1894 32.7944C40.4355 32.6549 40.6402 32.4525 40.7826 32.2079C40.925 31.9633 41 31.6854 41 31.4023C41 31.1192 40.925 30.8412 40.7826 30.5967C40.6402 30.3521 40.4355 30.1497 40.1894 30.0102L31.3956 25.0016M16.1901 26.3618L33.8099 36.4428M33.8099 26.3618L16.2061 36.4428" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke="#EC1846"/>
							</svg>
						</span>
						<span class="mbland_singleProject_statistical_itemValue">3.209,2 m2</span>
					</div>
					<div class="mbland_singleProject_statistical_itemBody">
						<h3 class="mbland_singleProject_statistical_itemTitle">Tổng diện tích thửa đất</h3>
						<p class="mbland_singleProject_statistical_itemDesc">Tổng hợp diện tích đất theo hồ sơ pháp lý và thông tin được ghi nhận trên hệ thống.</p>
					</div>
				</article>

			</div>
		</div>
	</div>
</section>





<!-- ===== START SECTION PROCEDURE  ===== -->
<section class="mbland_linhvuc_procedure">
	<div class="container">
<div class="mbland_linhvuc_procedure_wrapper">
	<header class="mbland_linhvuc_procedure_heading">
		<h2 class="mbland_linhvuc_procedure_title">Quy trình phát triển khai dự án</h2>
		<p class="mbland_linhvuc_procedure_desc">Mỗi dự án được triển khai theo quy trình bài bản, từ nghiên cứu tiềm năng, hoạch định chiến lược đến phát triển và vận hành, nhằm tối ưu hiệu quả đầu tư và kiến tạo giá trị bền vững.</p>
	</header>
	<div  class="mbland_linhvuc_procedure_list">
		<article  class="mbland_linhvuc_procedure_item">
			<div class="mbland_linhvuc_procedure_itemContent">
				<span  class="mbland_linhvuc_procedure_itemNumber">01</span>
				<div  class="mbland_linhvuc_procedure_itemTexts">
					<p class="mbland_linhvuc_procedure_itemTag">Research & Assessment</p>
					<h3 class="mbland_linhvuc_procedure_itemTitle">Nghiên cứu & Đánh giá</h3>
					<p class="mbland_linhvuc_procedure_itemDesc">Phân tích thị trường, khảo sát vị trí, đánh giá tiềm năng phát triểnvà xác định cơ hội đầu tư phù hợp.</p>
				</div>
			</div>
			<div class="mbland_linhvuc_procedure_itemImage">
				<ul class="mbland_linhvuc_procedure_itemImageList">
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
				</ul>
			</div>

		</article>
		<article  class="mbland_linhvuc_procedure_item">
			<div class="mbland_linhvuc_procedure_itemContent">
				<span  class="mbland_linhvuc_procedure_itemNumber">02</span>
				<div  class="mbland_linhvuc_procedure_itemTexts">
					<p class="mbland_linhvuc_procedure_itemTag">Investment Strategy</p>
					<h3 class="mbland_linhvuc_procedure_itemTitle">Hoạch định chiến lược</h3>
					<p class="mbland_linhvuc_procedure_itemDesc">Xây dựng phương án đầu tư, đánh giá tính khả thi, xác định 
nguồn lực và định hướng phát triển dự án.</p>
				</div>
			</div>
			<div class="mbland_linhvuc_procedure_itemImage">
				<ul class="mbland_linhvuc_procedure_itemImageList">
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
				</ul>
			</div>

		</article>
		<article  class="mbland_linhvuc_procedure_item">
			<div class="mbland_linhvuc_procedure_itemContent">
				<span  class="mbland_linhvuc_procedure_itemNumber">03</span>
				<div  class="mbland_linhvuc_procedure_itemTexts">
					<p class="mbland_linhvuc_procedure_itemTag">Legal & Master Planning</p>
					<h3 class="mbland_linhvuc_procedure_itemTitle">Pháp lý & Quy hoạch</h3>
					<p class="mbland_linhvuc_procedure_itemDesc">Rà soát hồ sơ pháp lý, hoàn thiện các thủ tục cần thiết và xây 
dựng phương án quy hoạch phù hợp.</p>
				</div>
			</div>
			<div class="mbland_linhvuc_procedure_itemImage">
				<ul class="mbland_linhvuc_procedure_itemImageList">
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
				</ul>
			</div>

		</article>
		<article  class="mbland_linhvuc_procedure_item">
			<div class="mbland_linhvuc_procedure_itemContent">
				<span  class="mbland_linhvuc_procedure_itemNumber">04</span>
				<div  class="mbland_linhvuc_procedure_itemTexts">
					<p class="mbland_linhvuc_procedure_itemTag">Design & Development</p>
					<h3 class="mbland_linhvuc_procedure_itemTitle">Thiết kế & Phát triển</h3>
					<p class="mbland_linhvuc_procedure_itemDesc">Định hình concept kiến trúc, tổ chức không gian, hệ thống tiện 
ích và giải pháp thiết kế tối ưu.</p>
				</div>
			</div>
			<div class="mbland_linhvuc_procedure_itemImage">
				<ul class="mbland_linhvuc_procedure_itemImageList">
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
					<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg"/></li>
				</ul>
			</div>

		</article>

	</div>

</div>
	</div>

</section>

<!-- ===== END SECTION PROCEDURE  ===== -->






<?php get_template_part( 'template-parts/sections/brands' ); ?>





<section class="mbland_singleProject_featuredProject">
	<div class="container">
		<div class="mbland_singleProject_featuredProject_wrapper">
			<header class="mbland_singleProject_featuredProject_header">
				<h2 class="mbland_singleProject_featuredProject_title">Các dự án nổi bật</h2>
				<p class="mbland_singleProject_featuredProject_desc">MBLand Asset Management là tập đoàn đa ngành với những dự án nổi bật trong suốt quá trình phát triển</p>
			</header>
			<div class="mbland_singleProject_featuredProject_slider">
				<div class="swiper mbland_singleProject_featuredProject_swiper">
					<div class="swiper-wrapper">
						<?php
						if ( isset( $related_query ) && $related_query->have_posts() ) :
							$i = 1;
							while ( $related_query->have_posts() ) : $related_query->the_post();
								$banner_field = get_field('banner');
								$item_title   = get_the_title();
								$thumb        = !empty($banner_field) ? ( is_array($banner_field) ? ( $banner_field['url'] ?? '' ) : $banner_field ) : get_the_post_thumbnail_url( get_the_ID() );
								$thumb        = $thumb ?: '/wp-content/uploads/2025/10/branch-placeholder.jpg';
						?>
						<div class="swiper-slide mbland_singleProject_featuredProject_slide">
							<div class="mbland_homepage_projects_item mbland_homepage_projects_item<?php echo $i; ?>">
								<div class="mbland_homepage_projects_itemImage">
									<img loading="lazy" decoding="async" fetchpriority="low"
										 src="<?php echo esc_url( $thumb ); ?>"
										 alt="<?php the_title_attribute(); ?>"
										 title="<?php the_title_attribute(); ?>"
										 />
								</div>
								<div class="mbland_homepage_projects_itemContent">
									<div class="mbland_homepage_projects_itemContent1">

									</div>
									<div class="mbland_homepage_projects_itemContent2">
										<h3 class="small-h3"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( $item_title ); ?>"><?php echo esc_html( $item_title ); ?></a></h3>
										
										<?php
										get_template_part( 'template-parts/ui/button', null, array(
											'url'   => get_permalink(),
											'label' => '',
											'class' => 'mbland_homepage_projects_viewDetail',
											'title' => the_title_attribute( array( 'echo' => false ) ),
										) );
										?>
									</div>
								</div>
							</div>
						</div>
						<?php
								$i++;
							endwhile;
							wp_reset_postdata();
						else :
							echo '<p>Chưa có dự án nổi bật nào.</p>';
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Script khởi tạo Swiper cho Featured Projects Slider -->
<script>
document.addEventListener('DOMContentLoaded', function () {
	if (typeof Swiper === 'undefined') return;

	new Swiper('.mbland_singleProject_featuredProject_swiper', {
		slidesPerView: 'auto',
		spaceBetween: 24,
		loop: true,
	});
});
</script>





<!-- ===== START SECTION CONTACT ===== -->
<?php get_template_part( 'template-parts/sections/contact-form' ); ?>
<!-- ===== END SECTION CONTACT ===== -->





<?php get_footer(); ?>