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

if ( ! function_exists( 'mbland_clean_plain_text' ) ) {
    function mbland_clean_plain_text( $text ) {
        if ( empty( $text ) ) return '';
        $decoded = html_entity_decode( html_entity_decode( (string) $text, ENT_QUOTES, 'UTF-8' ), ENT_QUOTES, 'UTF-8' );
        $clean = wp_strip_all_tags( $decoded, true );
        $clean = preg_replace( '/<[^>]*>/', '', $clean );
        $clean = str_replace( array( '&nbsp;', '&#160;' ), ' ', $clean );
        return trim( $clean );
    }
}

$sub_title     = mbland_clean_plain_text( get_field( 'sub_title', $post_id ) );

$short_content = mbland_clean_plain_text( get_field( 'short_content', $post_id ) );

$location      = mbland_clean_plain_text( get_field( 'location', $post_id ) );

$scale         = mbland_clean_plain_text( get_field( 'scale', $post_id ) );

// Nội dung: Sử dụng wp_kses_post để sanitize
$content = wp_kses_post(get_field('content', $post_id));

// Album ảnh Gallery
$gallery = get_field('gallery', $post_id);

// Featured image cho image cuối (sidebar)
$featured_thumb_id    = get_post_thumbnail_id($post_id);
$featured_image_url   = get_the_post_thumbnail_url($post_id, 'full'); // Hoặc 'full' nếu cần kích thước lớn hơn
$featured_image_alt   = get_post_meta($featured_thumb_id, '_wp_attachment_image_alt', true) ?: get_the_title($post_id);
$featured_image_title = get_the_title($post_id); // Title fallback từ post title
$featured_image_width  = 1920;
$featured_image_height = 1080;
if ( $featured_thumb_id ) {
    $featured_image_src = wp_get_attachment_image_src( $featured_thumb_id, 'full' );
    if ( ! empty( $featured_image_src ) ) {
        $featured_image_width  = ! empty( $featured_image_src[1] ) ? $featured_image_src[1] : 1920;
        $featured_image_height = ! empty( $featured_image_src[2] ) ? $featured_image_src[2] : 1080;
    }
}

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
	<?php if ( $featured_image_url ) : ?>
	<img class="mbland_linhvuc_hero_background" src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $featured_image_alt ); ?>" title="<?php echo esc_attr( get_the_title( $post_id ) ); ?>" width="<?php echo esc_attr( $featured_image_width ); ?>" height="<?php echo esc_attr( $featured_image_height ); ?>" loading="eager" decoding="async" fetchpriority="high"<?php echo homenest_srcset_attr( $featured_thumb_id, '100vw' ); ?> />
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
				<h1 class="mbland_linhvuc_hero_featuredTitle"><?php echo esc_html( get_the_title( $post_id ) ); ?></h1>
				<?php if ( ! empty( $sub_title ) ) : ?>
				<p class="mbland_linhvuc_hero_featuredSubTitle"><?php echo esc_html( $sub_title ); ?></p>
				<?php endif; ?>
				<div class="mbland_linhvuc_hero_featuredDecor">
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
				</div>
				<hr class="mbland_linhvuc_hero_featuredDivider" />
				<?php if ( ! empty( $short_content ) ) : ?>
				<div class="mbland_linhvuc_hero_featuredDesc"><?php echo esc_html( $short_content ); ?></div>
				<hr class="mbland_linhvuc_hero_featuredDivider" />
				<?php endif; ?>
				
				<?php if ( ! empty( $location ) ) : ?>
				<div class="mbland_linhvuc_hero_featuredLocation">
					<span class="mbland_linhvuc_hero_featuredLocationIcon"><svg  viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 1.125C7.35957 1.12694 5.78688 1.77945 4.62692 2.93941C3.46696 4.09938 2.81444 5.67207 2.8125 7.3125C2.811 8.65299 3.24884 9.95704 4.059 11.025C4.059 11.025 4.22775 11.2472 4.25532 11.2793L9 16.875L13.7469 11.2764C13.7717 11.2466 13.941 11.025 13.941 11.025L13.9416 11.0233C14.7512 9.95574 15.1888 8.65235 15.1875 7.3125C15.1856 5.67207 14.5331 4.09938 13.3731 2.93941C12.2131 1.77945 10.6404 1.12694 9 1.125ZM9 9.5625C8.555 9.5625 8.11998 9.43054 7.74997 9.18331C7.37996 8.93607 7.09157 8.58467 6.92127 8.17354C6.75098 7.7624 6.70642 7.31 6.79324 6.87355C6.88005 6.43709 7.09434 6.03618 7.40901 5.72151C7.72368 5.40684 8.12459 5.19255 8.56105 5.10573C8.99751 5.01892 9.44991 5.06347 9.86104 5.23377C10.2722 5.40407 10.6236 5.69246 10.8708 6.06247C11.118 6.43248 11.25 6.86749 11.25 7.3125C11.2493 7.90901 11.012 8.48087 10.5902 8.90267C10.1684 9.32446 9.59651 9.56176 9 9.5625Z" fill="currentColor"/>
						</svg>
					</span>
					<div class="mbland_linhvuc_hero_featuredLocationText">
						<p class="mbland_linhvuc_hero_featuredLocationLabel">Vị trí DỰ ÁN</p>
						<p class="mbland_linhvuc_hero_featuredLocationValue"><?php echo esc_html( $location ); ?></p>
					</div>
				</div>
				<?php endif; ?>

				<?php if ( ! empty( $scale ) ) : ?>
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
						<p class="mbland_linhvuc_hero_featuredLocationValue"><?php echo esc_html( $scale ); ?></p>
					</div>
				</div>
				<?php endif; ?>

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
					<p class="mbland_singleProject_details_subtitle"><?php echo esc_html( get_the_title( $post_id ) ); ?></p>
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
									$img_w = 1200;
									$img_h = 900;
									if ( is_array( $img ) ) {
										$img_url = $img['url'] ?? '';
										$img_alt = ! empty( $img['alt'] ) ? $img['alt'] : get_the_title( $post_id );
										$img_w   = ! empty( $img['width'] ) ? $img['width'] : 1200;
										$img_h   = ! empty( $img['height'] ) ? $img['height'] : 900;
									} elseif ( is_numeric( $img ) ) {
										$img_src = wp_get_attachment_image_src( $img, 'full' );
										$img_url = $img_src ? $img_src[0] : '';
										$img_w   = ! empty( $img_src[1] ) ? $img_src[1] : 1200;
										$img_h   = ! empty( $img_src[2] ) ? $img_src[2] : 900;
										$img_alt = get_post_meta( $img, '_wp_attachment_image_alt', true ) ?: get_the_title( $post_id );
									} else {
										$img_url = (string) $img;
										$img_alt = get_the_title( $post_id );
									}
								?>
									<div class="swiper-slide mbland_singleProject_gallery_mainSlide">
										<img class="mbland_singleProject_gallery_mainImage" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" title="<?php echo esc_attr( $img_alt ); ?>" width="<?php echo esc_attr( $img_w ); ?>" height="<?php echo esc_attr( $img_h ); ?>" loading="lazy" decoding="async" fetchpriority="low" />
									</div>
								<?php endforeach; ?>
							<?php else : ?>
								<!-- Ảnh mẫu demo khớp theo thiết kế -->
								<div class="swiper-slide mbland_singleProject_gallery_mainSlide">
									<img class="mbland_singleProject_gallery_mainImage" src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80" alt="Hilton Sky View" title="Hilton Sky View" width="1200" height="900" loading="lazy" decoding="async" fetchpriority="low" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_mainSlide">
									<img class="mbland_singleProject_gallery_mainImage" src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80" alt="Kiến trúc xanh & Tiện ích" title="Kiến trúc xanh & Tiện ích" width="1200" height="900" loading="lazy" decoding="async" fetchpriority="low" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_mainSlide">
									<img class="mbland_singleProject_gallery_mainImage" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80" alt="Cảnh quan ven sông" title="Cảnh quan ven sông" width="1200" height="900" loading="lazy" decoding="async" fetchpriority="low" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_mainSlide">
									<img class="mbland_singleProject_gallery_mainImage" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80" alt="Quy hoạch tổng thể" title="Quy hoạch tổng thể" width="1200" height="900" loading="lazy" decoding="async" fetchpriority="low" />
								</div>
							<?php endif; ?>
						</div>
					</div>

					<!-- Swiper ảnh thumbnail thu nhỏ bên dưới (Thumbs Slider) -->
					<div class="swiper mbland_singleProject_gallery_thumbs">
						<div class="swiper-wrapper">
							<?php if ( ! empty( $gallery ) && is_array( $gallery ) ) : ?>
								<?php foreach ( $gallery as $img ) : 
									$thumb_img_w = 400;
									$thumb_img_h = 364;
									if ( is_array( $img ) ) {
										$img_url     = $img['sizes']['medium_large'] ?? ( $img['url'] ?? '' );
										$img_alt     = ! empty( $img['alt'] ) ? $img['alt'] : get_the_title( $post_id );
										$thumb_img_w = $img['sizes']['medium_large-width'] ?? ( $img['width'] ?? 400 );
										$thumb_img_h = $img['sizes']['medium_large-height'] ?? ( $img['height'] ?? 364 );
									} elseif ( is_numeric( $img ) ) {
										$img_src     = wp_get_attachment_image_src( $img, 'medium_large' );
										$img_url     = $img_src ? $img_src[0] : '';
										$thumb_img_w = ! empty( $img_src[1] ) ? $img_src[1] : 400;
										$thumb_img_h = ! empty( $img_src[2] ) ? $img_src[2] : 364;
										$img_alt     = get_post_meta( $img, '_wp_attachment_image_alt', true ) ?: get_the_title( $post_id );
									} else {
										$img_url     = (string) $img;
										$img_alt     = get_the_title( $post_id );
									}
								?>
									<div class="swiper-slide mbland_singleProject_gallery_thumbSlide">
										<img class="mbland_singleProject_gallery_thumbImage" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" title="<?php echo esc_attr( $img_alt ); ?>" width="<?php echo esc_attr( $thumb_img_w ); ?>" height="<?php echo esc_attr( $thumb_img_h ); ?>" loading="lazy" decoding="async" fetchpriority="low" />
									</div>
								<?php endforeach; ?>
							<?php else : ?>
								<!-- Ảnh thumbnail mẫu demo -->
								<div class="swiper-slide mbland_singleProject_gallery_thumbSlide">
									<img class="mbland_singleProject_gallery_thumbImage" src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=400&q=80" alt="Hilton Sky View" title="Hilton Sky View" width="400" height="364" loading="lazy" decoding="async" fetchpriority="low" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_thumbSlide">
									<img class="mbland_singleProject_gallery_thumbImage" src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=400&q=80" alt="Kiến trúc xanh & Tiện ích" title="Kiến trúc xanh & Tiện ích" width="400" height="364" loading="lazy" decoding="async" fetchpriority="low" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_thumbSlide">
									<img class="mbland_singleProject_gallery_thumbImage" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Cảnh quan ven sông" title="Cảnh quan ven sông" width="400" height="364" loading="lazy" decoding="async" fetchpriority="low" />
								</div>
								<div class="swiper-slide mbland_singleProject_gallery_thumbSlide">
									<img class="mbland_singleProject_gallery_thumbImage" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=400&q=80" alt="Quy hoạch tổng thể" title="Quy hoạch tổng thể" width="400" height="364" loading="lazy" decoding="async" fetchpriority="low" />
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
				<?php
				$thong_ke = function_exists( 'get_field' ) ? get_field( 'thong_ke_du_an', $post_id ) : array();
				if ( ! empty( $thong_ke ) && is_array( $thong_ke ) ) :
					foreach ( $thong_ke as $stat ) :
						$stat_value = isset( $stat['con_so'] ) ? mbland_clean_plain_text( $stat['con_so'] ) : '';
						$stat_title = isset( $stat['tieu_de'] ) ? mbland_clean_plain_text( $stat['tieu_de'] ) : '';
						$stat_desc  = isset( $stat['mo_ta'] ) ? mbland_clean_plain_text( $stat['mo_ta'] ) : '';
						if ( $stat_value === '' && $stat_title === '' && $stat_desc === '' ) {
							continue;
						}
				?>
				<article class="mbland_singleProject_statistical_item">
					<div class="mbland_singleProject_statistical_itemTop">
						<span class="mbland_singleProject_statistical_itemIcon">
							<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="50" height="50" rx="8" fill="#FFEFEF"/>
								<path d="M25 18.601L34.5933 13.8005L25 9V18.601ZM25 18.601V25.0016M18.6044 24.9856L9.81055 30.0102C9.56449 30.1497 9.35982 30.3521 9.21742 30.5967C9.07503 30.8412 9 31.1192 9 31.4023C9 31.6854 9.07503 31.9633 9.21742 32.2079C9.35982 32.4525 9.56449 32.6549 9.81055 32.7944L23.4011 40.5712C23.8872 40.8521 24.4387 41 25 41C25.5613 41 26.1128 40.8521 26.5989 40.5712L40.1894 32.7944C40.4355 32.6549 40.6402 32.4525 40.7826 32.2079C40.925 31.9633 41 31.6854 41 31.4023C41 31.1192 40.925 30.8412 40.7826 30.5967C40.6402 30.3521 40.4355 30.1497 40.1894 30.0102L31.3956 25.0016M16.1901 26.3618L33.8099 36.4428M33.8099 26.3618L16.2061 36.4428" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke="#EC1846"/>
							</svg>
						</span>
						<span class="mbland_singleProject_statistical_itemValue"><?php echo esc_html( $stat_value ); ?></span>
					</div>
					<div class="mbland_singleProject_statistical_itemBody">
						<h3 class="mbland_singleProject_statistical_itemTitle"><?php echo esc_html( $stat_title ); ?></h3>
						<p class="mbland_singleProject_statistical_itemDesc"><?php echo esc_html( $stat_desc ); ?></p>
					</div>
				</article>
				<?php
					endforeach;
				endif;
				?>
			</div>
		</div>
	</div>
</section>





<?php get_template_part( 'template-parts/sections/procedure' ); ?>






<?php get_template_part( 'template-parts/sections/brands' ); ?>





<section class="mbland_singleProject_featuredProject">
	<div class="container">
		<div class="mbland_singleProject_featuredProject_wrapper">
			<header class="mbland_singleProject_featuredProject_header">
				<h2 class="mbland_singleProject_featuredProject_title">Các dự án nổi bật</h2>
				<p class="mbland_singleProject_featuredProject_desc">MBLand Asset Management là tập đoàn đa ngành với những dự án nổi bật trong suốt quá trình phát triển</p>
			</header>
			<div class="mbland_singleProject_featuredProject_list">
				<?php
				$featured_args = array(
					'post_type'      => 'du-an',
					'post_status'    => 'publish',
					'posts_per_page' => 3,
					'orderby'        => 'date',
					'order'          => 'DESC',
				);

				if ( taxonomy_exists( 'du-an-noi-bat' ) ) {
					$featured_args['tax_query'] = array(
						array(
							'taxonomy' => 'du-an-noi-bat',
							'field'    => 'slug',
							'terms'    => array( 'du-an-noi-bat', 'featured-projects' ),
						),
					);
				}

				$featured_query = new WP_Query( $featured_args );

				// Fallback: nếu chưa gán taxonomy du-an-noi-bat, lấy 3 dự án theo lĩnh vực hiện tại hoặc mới nhất
				if ( ! $featured_query->have_posts() ) {
					$fallback_tax = array();
					if ( ! empty( $target_term_id ) && taxonomy_exists( 'linh-vuc' ) ) {
						$fallback_tax[] = array(
							'taxonomy'         => 'linh-vuc',
							'field'            => 'term_id',
							'terms'            => $target_term_id,
							'include_children' => true,
						);
					}
					$featured_query = new WP_Query( array(
						'post_type'      => 'du-an',
						'post_status'    => 'publish',
						'posts_per_page' => 3,
						'orderby'        => 'date',
						'order'          => 'DESC',
						'tax_query'      => $fallback_tax,
					) );
					if ( ! $featured_query->have_posts() ) {
						$featured_query = new WP_Query( array(
							'post_type'      => 'du-an',
							'post_status'    => 'publish',
							'posts_per_page' => 3,
							'orderby'        => 'date',
							'order'          => 'DESC',
						) );
					}
				}
				?>
				<?php if ( $featured_query->have_posts() ) : ?>
					<?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
						<?php
						$f_id      = get_the_ID();
						$banner    = function_exists( 'get_field' ) ? get_field( 'banner', $f_id ) : false;
						$thumb_url = '';
						$thumb_alt = get_the_title( $f_id );

						if ( ! empty( $banner ) && is_array( $banner ) ) {
							$thumb_url = isset( $banner['url'] ) ? $banner['url'] : '';
							if ( ! empty( $banner['alt'] ) ) {
								$thumb_alt = $banner['alt'];
							}
						} elseif ( is_numeric( $banner ) ) {
							$thumb_url = wp_get_attachment_image_url( (int) $banner, 'large' );
						} elseif ( is_string( $banner ) && ! empty( $banner ) ) {
							$thumb_url = $banner;
						}

						if ( empty( $thumb_url ) && has_post_thumbnail( $f_id ) ) {
							$thumb_url = get_the_post_thumbnail_url( $f_id, 'large' );
							$thumb_id  = get_post_thumbnail_id( $f_id );
							$alt       = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
							if ( ! empty( $alt ) ) {
								$thumb_alt = $alt;
							}
						}

						if ( empty( $thumb_url ) ) {
							$thumb_url = '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg';
						}

						$short_desc = function_exists( 'get_field' ) ? get_field( 'short_content', $f_id ) : '';
						if ( empty( $short_desc ) ) {
							$short_desc = get_the_excerpt( $f_id );
						}

						$location = function_exists( 'mbland_clean_plain_text' ) ? mbland_clean_plain_text( get_field( 'location', $f_id ) ) : ( function_exists( 'get_field' ) ? get_field( 'location', $f_id ) : '' );
						?>
						<article class="mbland_singleProject_featuredProject_item">
							<div class="mbland_singleProject_featuredProject_itemMedia">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" style="display:block;width:100%;height:100%;" aria-label="<?php the_title_attribute(); ?>">
									<img class="mbland_singleProject_featuredProject_itemImage" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $thumb_alt ); ?>" title="<?php echo esc_attr( get_the_title( $f_id ) ); ?>" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( $thumb_url, 800, 600 ) ); ?> />
								</a>
							</div>
							<div class="mbland_singleProject_featuredProject_itemBody">
								<div class="mbland_singleProject_featuredProject_itemHeader">
									<h3 class="mbland_singleProject_featuredProject_itemTitle">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" style="color:inherit;text-decoration:none;" aria-label="<?php the_title_attribute(); ?>">
											<?php the_title(); ?>
										</a>
									</h3>
									<?php if ( ! empty( $short_desc ) ) : ?>
										<p class="mbland_singleProject_featuredProject_itemDesc"><?php echo wp_kses_post( wp_trim_words( $short_desc, 25, '...' ) ); ?></p>
									<?php endif; ?>
								</div>
								<hr class="mbland_singleProject_featuredProject_itemDivider" />
								<?php if ( ! empty( $location ) ) : ?>
									<div class="mbland_singleProject_featuredProject_itemLocation">
										<span class="mbland_singleProject_featuredProject_itemLocationIcon">
											<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M7 0.875C5.72411 0.876505 4.50091 1.38402 3.59871 2.28621C2.69652 3.1884 2.18901 4.41161 2.1875 5.6875C2.18633 6.7301 2.52687 7.74436 3.157 8.575C3.157 8.575 3.28825 8.74781 3.30969 8.77275L7 13.125L10.6921 8.77056C10.7113 8.74738 10.843 8.575 10.843 8.575L10.8434 8.57369C11.4731 7.74335 11.8135 6.7296 11.8125 5.6875C11.811 4.41161 11.3035 3.1884 10.4013 2.28621C9.4991 1.38402 8.2759 0.876505 7 0.875ZM7 7.4375C6.65389 7.4375 6.31554 7.33486 6.02776 7.14257C5.73997 6.95028 5.51567 6.67697 5.38321 6.3572C5.25076 6.03743 5.2161 5.68556 5.28363 5.34609C5.35115 5.00663 5.51782 4.6948 5.76257 4.45006C6.00731 4.20532 6.31913 4.03865 6.6586 3.97113C6.99806 3.9036 7.34993 3.93826 7.6697 4.07071C7.98947 4.20316 8.26278 4.42747 8.45507 4.71525C8.64737 5.00304 8.75 5.34138 8.75 5.6875C8.74942 6.15145 8.56486 6.59623 8.2368 6.9243C7.90874 7.25236 7.46395 7.43692 7 7.4375Z" fill="var(--primary-color)"/>
											</svg>
										</span>
										<div class="mbland_singleProject_featuredProject_itemLocationText">
											<p class="mbland_singleProject_featuredProject_itemLocationLabel"><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Vị trí địa chỉ' ) : 'Vị trí địa chỉ' ); ?></p>
											<p class="mbland_singleProject_featuredProject_itemLocationValue"><?php echo esc_html( $location ); ?></p>
										</div>
									</div>
								<?php endif; ?>
								<div class="mbland_singleProject_featuredProject_itemAction">
									<a href="<?php the_permalink(); ?>" class="mbland_singleProject_featuredProject_itemLink" aria-label="<?php echo esc_attr( ( function_exists( 'pll__' ) ? pll__( 'Xem chi tiết' ) : 'Xem chi tiết' ) . ': ' . get_the_title() ); ?>"><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Xem chi tiết' ) : 'Xem chi tiết' ); ?></a>
								</div>
							</div>
						</article>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<div class="mbland_singleProject_featuredProject_empty" style="text-align:center;width:100%;padding:40px 0;color:#888;">
						<p><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Chưa có dự án nổi bật nào.' ) : 'Chưa có dự án nổi bật nào.' ); ?></p>
					</div>
				<?php endif; ?>
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
		spaceBetween: 0,
		loop: true,
	});
});
</script>





<!-- ===== START SECTION CONTACT ===== -->
<?php get_template_part( 'template-parts/sections/contact-form' ); ?>
<!-- ===== END SECTION CONTACT ===== -->





<?php get_footer(); ?>