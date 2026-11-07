<?php
/**
 * Template dùng chung cho các term của taxonomy `linh-vuc`
 * (fallback khi không có template-linh-vuc/template-{slug}.php riêng).
 *
 * Dữ liệu: lấy các dự án (post type `du-an`) thuộc term `danh-muc-du-an` có cùng slug với term `linh-vuc` hiện tại.
 *
 * @package HomeNest Theme
 */
get_header();

$current_term = get_queried_object();
$term_slug    = $current_term->slug;

// Ảnh đại diện của term (ACF field 'feature_image', giống trang chủ) - hỗ trợ return format array / ID / URL
$term_image     = function_exists( 'get_field' ) ? get_field( 'feature_image', 'term_' . $current_term->term_id ) : false;
$term_image_url = '';
$term_image_alt = $current_term->name;
if ( is_array( $term_image ) ) {
	$term_image_url = isset( $term_image['url'] ) ? $term_image['url'] : '';
	if ( ! empty( $term_image['alt'] ) ) {
		$term_image_alt = $term_image['alt'];
	}
} elseif ( is_numeric( $term_image ) ) {
	$term_image_url = wp_get_attachment_image_url( (int) $term_image, 'full' );
} elseif ( is_string( $term_image ) ) {
	$term_image_url = $term_image;
}

// Term con (nhóm dự án) của danh-muc-du-an cùng slug
$project_term = get_term_by( 'slug', $term_slug, 'danh-muc-du-an' );
$sub_terms    = array();
if ( $project_term && ! is_wp_error( $project_term ) ) {
	$sub_terms = get_terms( array(
		'taxonomy'   => 'danh-muc-du-an',
		'hide_empty' => true,
		'parent'     => $project_term->term_id,
		'orderby'    => 'name',
		'order'      => 'ASC',
	) );
}

// Danh sách dự án thuộc lĩnh vực
$projects = new WP_Query( array(
	'post_type'      => 'du-an',
	'post_status'    => 'publish',
	'posts_per_page' => 12,
	'paged'          => max( 1, (int) get_query_var( 'paged' ) ),
	'tax_query'      => array(
		array(
			'taxonomy' => 'danh-muc-du-an',
			'field'    => 'slug',
			'terms'    => $term_slug,
		),
	),
	'orderby'        => 'date',
	'order'          => 'DESC',
) );
?>



<!-- ===== START SECTION LINH VUC HERO ===== -->
<section class="mbland_linhvuc_hero">
	<?php if ( $term_image_url ) : ?>
	<img class="mbland_linhvuc_hero_background" src="<?php echo esc_url( $term_image_url ); ?>" alt="<?php echo esc_attr( $term_image_alt ); ?>" title="<?php echo esc_attr( $current_term->name ); ?>" loading="eager" decoding="async" fetchpriority="high" <?php echo trim( mbland_img_size_attr( $term_image_url, 1920, 1080 ) ); ?> />
	<?php endif; ?>
	<div class="mbland_linhvuc_hero_inner">
		<div class="container mbland_linhvuc_hero_container">
			<div class="mbland_linhvuc_hero_content">
				<div class="mbland_linhvuc_hero_breadcrumb"><?php echo do_shortcode('[hn_breadcrumb]'); ?></div>
				<?php
				// Bỏ tiền tố "Lĩnh vực: " mà get_the_archive_title() tự thêm vào
				add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );
				?>
				<h1 class="mbland_linhvuc_hero_title"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
				<?php remove_filter( 'get_the_archive_title_prefix', '__return_empty_string' ); ?>
				<?php if ( get_the_archive_description() ) : ?>
				<div class="mbland_linhvuc_hero_desc"><?php echo wp_kses_post( get_the_archive_description() ); ?></div>
				<?php endif; ?>
			</div>
			<div class="mbland_linhvuc_hero_aside">

			</div>

		</div>

	</div>
	<div class="mbland_linhvuc_hero_featured">
		<div class="container mbland_linhvuc_hero_featuredContainer">
			<div class="mbland_linhvuc_hero_featuredInfo">
				<p class="mbland_linhvuc_hero_featuredTitle">Thảo Điền Boutique Marina</p>
				<p class="mbland_linhvuc_hero_featuredDesc">Được quy hoạch theo mô hình tổ hợp khép kín, dự án tích hợp hệ thống tiện ích và dịch vụ hiện đại, bao gồm khách sạn, nhà hàng, bến du thuyền, spa,.... Mang đến trải nghiệm trọn vẹn trong một không gian tiện nghi, riêng tư và đẳng cấp.</p>
				<div class="mbland_linhvuc_hero_featuredDecor">
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
				</div>
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
			</div>
			<div class="mbland_linhvuc_hero_featuredAction">
				<a class="mbland_linhvuc_hero_featuredLink">
					<span class="mbland_linhvuc_hero_featuredLinkLabel">Tìm hiểu thêm về dự án</span>
					<svg class="mbland_linhvuc_hero_featuredLinkIcon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.333 14.333V1H1m13.333 0L1 14.333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"/></svg>
				</a>

			</div>

		</div>

	</div>
</section>
<!-- ===== END SECTION LINH VUC HERO ===== -->






<!-- ===== START SECTION LIST PROJECT ===== -->
<section class="mbland_linhvuc_listProject">
	<div class="container">
		<div class="mbland_linhvuc_listProject_wrapper">
			<header class="mbland_linhvuc_listProject_header">
				<h2 class="mbland_linhvuc_listProject_title">Kiến tạo không gian - Nâng tầm bất động sản</h2>
				<p class="mbland_linhvuc_listProject_desc">Phát triển đa dạng phân khúc bất động sản, từ đô thị, nhà ở đến thương mại, văn phòng và nghỉ dưỡng, MBLand Asset Management hướng đến kiến tạo những không gian chất lượng, đáp ứng nhu cầu thị trường và mang lại giá trị đầu tư dài hạn.</p>
			</header>

			<div class="mbland_linhvuc_listProject_body">
				<!-- Xuất các term com trực tiếp của taxonomy=linh-vuc -->
				<div class="mbland_linhvuc_listProject_filter">
					<ul class="mbland_linhvuc_listProject_filterList">
						<li class="mbland_linhvuc_listProject_filterItem"><a class="mbland_linhvuc_listProject_filterLink">Đô thị & Nhà ở</a></li>
						<li class="mbland_linhvuc_listProject_filterItem"><a class="mbland_linhvuc_listProject_filterLink">Thương mại & Văn phòng</a></li>
						<li class="mbland_linhvuc_listProject_filterItem"><a class="mbland_linhvuc_listProject_filterLink">Khách sạn & Nghĩ dưỡng</a></li>
					</ul>
				</div>
				<div class="mbland_linhvuc_listProject_content">
					<!-- Xuất tất cả post-type=du-an theo term của taxonomy=linh-vuc -->
					<div class="mbland_linhvuc_listProject_item">
						<div class="mbland_linhvuc_listProject_itemMedia">
							<img class="mbland_linhvuc_listProject_itemImage"  src="/wp-content/uploads/2025/10/Da-Nang.jpg" alt="Dự án T18 - Đà Nẵng" title="Dự án T18 - Đà Nẵng" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Da-Nang.jpg', 800, 600 ) ); ?> />
						</div>
						<div class="mbland_linhvuc_listProject_itemBody">
							<h3 class="mbland_linhvuc_listProject_itemTitle"><a class="mbland_linhvuc_listProject_itemTitleLink">Dự án T18 - Đà Nẵng</a></h3>
							<div class="mbland_linhvuc_listProject_itemDesc">
								Tổ hợp khép kín với đầy đủ các tiện ích hiện đại khách sạn, căn hô cao cấp, nhà hàng, spa…<br />
								Với những tiện ích cao cấp hiện đại hàng đầu, cam kết mang đến chất lượng vượt trội nhất.
							</div>
							<hr class="mbland_linhvuc_listProject_itemDivider" />
							<div class="mbland_linhvuc_listProject_itemLocation">
								<span class="mbland_linhvuc_listProject_itemLocationIcon"><svg  viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9 1.125C7.35957 1.12694 5.78688 1.77945 4.62692 2.93941C3.46696 4.09938 2.81444 5.67207 2.8125 7.3125C2.811 8.65299 3.24884 9.95704 4.059 11.025C4.059 11.025 4.22775 11.2472 4.25532 11.2793L9 16.875L13.7469 11.2764C13.7717 11.2466 13.941 11.025 13.941 11.025L13.9416 11.0233C14.7512 9.95574 15.1888 8.65235 15.1875 7.3125C15.1856 5.67207 14.5331 4.09938 13.3731 2.93941C12.2131 1.77945 10.6404 1.12694 9 1.125ZM9 9.5625C8.555 9.5625 8.11998 9.43054 7.74997 9.18331C7.37996 8.93607 7.09157 8.58467 6.92127 8.17354C6.75098 7.7624 6.70642 7.31 6.79324 6.87355C6.88005 6.43709 7.09434 6.03618 7.40901 5.72151C7.72368 5.40684 8.12459 5.19255 8.56105 5.10573C8.99751 5.01892 9.44991 5.06347 9.86104 5.23377C10.2722 5.40407 10.6236 5.69246 10.8708 6.06247C11.118 6.43248 11.25 6.86749 11.25 7.3125C11.2493 7.90901 11.012 8.48087 10.5902 8.90267C10.1684 9.32446 9.59651 9.56176 9 9.5625Z" fill="currentColor"/>
									</svg>
								</span>
								<div class="mbland_linhvuc_listProject_itemLocationText">
									<p class="mbland_linhvuc_listProject_itemLocationLabel">Vị trí DỰ ÁN</p>
									<p class="mbland_linhvuc_listProject_itemLocationValue">Số 68 An Phú, Phường An Khánh, Thành phố Hồ Chí Minh</p>
								</div>

							</div>
							<div class="mbland_linhvuc_listProject_itemScale">
								<span class="mbland_linhvuc_listProject_itemScaleIcon"><svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14.9998 4.16675L9.99977 6.66675V1.66675L14.9998 4.16675Z" fill="var(--primary-color)"/>
									<path d="M9.99977 6.66675L14.9998 4.16675L9.99977 1.66675V6.66675ZM9.99977 6.66675V10.0001M6.66643 9.99175L2.0831 12.6084C1.95485 12.6811 1.84818 12.7865 1.77396 12.9139C1.69975 13.0412 1.66064 13.186 1.66064 13.3334C1.66064 13.4808 1.69975 13.6256 1.77396 13.753C1.84818 13.8803 1.95485 13.9857 2.0831 14.0584L9.16643 18.1084C9.4198 18.2547 9.70721 18.3317 9.99977 18.3317C10.2923 18.3317 10.5797 18.2547 10.8331 18.1084L17.9164 14.0584C18.0447 13.9857 18.1514 13.8803 18.2256 13.753C18.2998 13.6256 18.3389 13.4808 18.3389 13.3334C18.3389 13.186 18.2998 13.0412 18.2256 12.9139C18.1514 12.7865 18.0447 12.6811 17.9164 12.6084L13.3331 10.0001M5.4081 10.7084L14.5914 15.9584M14.5914 10.7084L5.41643 15.9584" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke="var(--primary-color)"/>
									</svg>

								</span>
								<div class="mbland_linhvuc_listProject_itemScaleText">
									<p class="mbland_linhvuc_listProject_itemScaleLabel">Quy mô bất động sản</p>
									<p class="mbland_linhvuc_listProject_itemScaleValue">Khu nghĩ dưỡng phức hợp sang trọng & cao cấp</p>
								</div>

							</div>
							<a class="mbland_linhvuc_listProject_itemLink">Xem chi tiết</a>
						</div>
					</div>
					<div class="mbland_linhvuc_listProject_item">
						<div class="mbland_linhvuc_listProject_itemMedia">
							<img class="mbland_linhvuc_listProject_itemImage" src="/wp-content/uploads/2025/10/Da-Nang.jpg" alt="Dự án T18 - Đà Nẵng" title="Dự án T18 - Đà Nẵng" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Da-Nang.jpg', 800, 600 ) ); ?> />
						</div>
						<div class="mbland_linhvuc_listProject_itemBody">
							<h3 class="mbland_linhvuc_listProject_itemTitle"><a class="mbland_linhvuc_listProject_itemTitleLink">Dự án T18 - Đà Nẵng</a></h3>
							<div class="mbland_linhvuc_listProject_itemDesc">
								Tổ hợp khép kín với đầy đủ các tiện ích hiện đại khách sạn, căn hô cao cấp, nhà hàng, spa…<br />
								Với những tiện ích cao cấp hiện đại hàng đầu, cam kết mang đến chất lượng vượt trội nhất.
							</div>
							<hr class="mbland_linhvuc_listProject_itemDivider" />
							<div class="mbland_linhvuc_listProject_itemLocation">
								<span class="mbland_linhvuc_listProject_itemLocationIcon"><svg  viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9 1.125C7.35957 1.12694 5.78688 1.77945 4.62692 2.93941C3.46696 4.09938 2.81444 5.67207 2.8125 7.3125C2.811 8.65299 3.24884 9.95704 4.059 11.025C4.059 11.025 4.22775 11.2472 4.25532 11.2793L9 16.875L13.7469 11.2764C13.7717 11.2466 13.941 11.025 13.941 11.025L13.9416 11.0233C14.7512 9.95574 15.1888 8.65235 15.1875 7.3125C15.1856 5.67207 14.5331 4.09938 13.3731 2.93941C12.2131 1.77945 10.6404 1.12694 9 1.125ZM9 9.5625C8.555 9.5625 8.11998 9.43054 7.74997 9.18331C7.37996 8.93607 7.09157 8.58467 6.92127 8.17354C6.75098 7.7624 6.70642 7.31 6.79324 6.87355C6.88005 6.43709 7.09434 6.03618 7.40901 5.72151C7.72368 5.40684 8.12459 5.19255 8.56105 5.10573C8.99751 5.01892 9.44991 5.06347 9.86104 5.23377C10.2722 5.40407 10.6236 5.69246 10.8708 6.06247C11.118 6.43248 11.25 6.86749 11.25 7.3125C11.2493 7.90901 11.012 8.48087 10.5902 8.90267C10.1684 9.32446 9.59651 9.56176 9 9.5625Z" fill="currentColor"/>
									</svg>
								</span>
								<div class="mbland_linhvuc_listProject_itemLocationText">
									<p class="mbland_linhvuc_listProject_itemLocationLabel">Vị trí DỰ ÁN</p>
									<p class="mbland_linhvuc_listProject_itemLocationValue">Số 68 An Phú, Phường An Khánh, Thành phố Hồ Chí Minh</p>
								</div>

							</div>
							<div class="mbland_linhvuc_listProject_itemScale">
								<span class="mbland_linhvuc_listProject_itemScaleIcon"><svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14.9998 4.16675L9.99977 6.66675V1.66675L14.9998 4.16675Z" fill="var(--primary-color)"/>
									<path d="M9.99977 6.66675L14.9998 4.16675L9.99977 1.66675V6.66675ZM9.99977 6.66675V10.0001M6.66643 9.99175L2.0831 12.6084C1.95485 12.6811 1.84818 12.7865 1.77396 12.9139C1.69975 13.0412 1.66064 13.186 1.66064 13.3334C1.66064 13.4808 1.69975 13.6256 1.77396 13.753C1.84818 13.8803 1.95485 13.9857 2.0831 14.0584L9.16643 18.1084C9.4198 18.2547 9.70721 18.3317 9.99977 18.3317C10.2923 18.3317 10.5797 18.2547 10.8331 18.1084L17.9164 14.0584C18.0447 13.9857 18.1514 13.8803 18.2256 13.753C18.2998 13.6256 18.3389 13.4808 18.3389 13.3334C18.3389 13.186 18.2998 13.0412 18.2256 12.9139C18.1514 12.7865 18.0447 12.6811 17.9164 12.6084L13.3331 10.0001M5.4081 10.7084L14.5914 15.9584M14.5914 10.7084L5.41643 15.9584" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke="var(--primary-color)"/>
									</svg>

								</span>
								<div class="mbland_linhvuc_listProject_itemScaleText">
									<p class="mbland_linhvuc_listProject_itemScaleLabel">Quy mô bất động sản</p>
									<p class="mbland_linhvuc_listProject_itemScaleValue">Khu nghĩ dưỡng phức hợp sang trọng & cao cấp</p>
								</div>

							</div>
							<a class="mbland_linhvuc_listProject_itemLink">Xem chi tiết</a>
						</div>
					</div>
					<div class="mbland_linhvuc_listProject_item">
						<div class="mbland_linhvuc_listProject_itemMedia">
							<img class="mbland_linhvuc_listProject_itemImage"  src="/wp-content/uploads/2025/10/Da-Nang.jpg" alt="Dự án T18 - Đà Nẵng" title="Dự án T18 - Đà Nẵng" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Da-Nang.jpg', 800, 600 ) ); ?> />
						</div>
						<div class="mbland_linhvuc_listProject_itemBody">
							<h3 class="mbland_linhvuc_listProject_itemTitle"><a class="mbland_linhvuc_listProject_itemTitleLink">Dự án T18 - Đà Nẵng</a></h3>
							<div class="mbland_linhvuc_listProject_itemDesc">
								Tổ hợp khép kín với đầy đủ các tiện ích hiện đại khách sạn, căn hô cao cấp, nhà hàng, spa…<br />
								Với những tiện ích cao cấp hiện đại hàng đầu, cam kết mang đến chất lượng vượt trội nhất.
							</div>
							<hr class="mbland_linhvuc_listProject_itemDivider" />
							<div class="mbland_linhvuc_listProject_itemLocation">
								<span class="mbland_linhvuc_listProject_itemLocationIcon"><svg  viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9 1.125C7.35957 1.12694 5.78688 1.77945 4.62692 2.93941C3.46696 4.09938 2.81444 5.67207 2.8125 7.3125C2.811 8.65299 3.24884 9.95704 4.059 11.025C4.059 11.025 4.22775 11.2472 4.25532 11.2793L9 16.875L13.7469 11.2764C13.7717 11.2466 13.941 11.025 13.941 11.025L13.9416 11.0233C14.7512 9.95574 15.1888 8.65235 15.1875 7.3125C15.1856 5.67207 14.5331 4.09938 13.3731 2.93941C12.2131 1.77945 10.6404 1.12694 9 1.125ZM9 9.5625C8.555 9.5625 8.11998 9.43054 7.74997 9.18331C7.37996 8.93607 7.09157 8.58467 6.92127 8.17354C6.75098 7.7624 6.70642 7.31 6.79324 6.87355C6.88005 6.43709 7.09434 6.03618 7.40901 5.72151C7.72368 5.40684 8.12459 5.19255 8.56105 5.10573C8.99751 5.01892 9.44991 5.06347 9.86104 5.23377C10.2722 5.40407 10.6236 5.69246 10.8708 6.06247C11.118 6.43248 11.25 6.86749 11.25 7.3125C11.2493 7.90901 11.012 8.48087 10.5902 8.90267C10.1684 9.32446 9.59651 9.56176 9 9.5625Z" fill="currentColor"/>
									</svg>
								</span>
								<div class="mbland_linhvuc_listProject_itemLocationText">
									<p class="mbland_linhvuc_listProject_itemLocationLabel">Vị trí DỰ ÁN</p>
									<p class="mbland_linhvuc_listProject_itemLocationValue">Số 68 An Phú, Phường An Khánh, Thành phố Hồ Chí Minh</p>
								</div>

							</div>
							<div class="mbland_linhvuc_listProject_itemScale">
								<span class="mbland_linhvuc_listProject_itemScaleIcon"><svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14.9998 4.16675L9.99977 6.66675V1.66675L14.9998 4.16675Z" fill="var(--primary-color)"/>
									<path d="M9.99977 6.66675L14.9998 4.16675L9.99977 1.66675V6.66675ZM9.99977 6.66675V10.0001M6.66643 9.99175L2.0831 12.6084C1.95485 12.6811 1.84818 12.7865 1.77396 12.9139C1.69975 13.0412 1.66064 13.186 1.66064 13.3334C1.66064 13.4808 1.69975 13.6256 1.77396 13.753C1.84818 13.8803 1.95485 13.9857 2.0831 14.0584L9.16643 18.1084C9.4198 18.2547 9.70721 18.3317 9.99977 18.3317C10.2923 18.3317 10.5797 18.2547 10.8331 18.1084L17.9164 14.0584C18.0447 13.9857 18.1514 13.8803 18.2256 13.753C18.2998 13.6256 18.3389 13.4808 18.3389 13.3334C18.3389 13.186 18.2998 13.0412 18.2256 12.9139C18.1514 12.7865 18.0447 12.6811 17.9164 12.6084L13.3331 10.0001M5.4081 10.7084L14.5914 15.9584M14.5914 10.7084L5.41643 15.9584" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke="var(--primary-color)"/>
									</svg>

								</span>
								<div class="mbland_linhvuc_listProject_itemScaleText">
									<p class="mbland_linhvuc_listProject_itemScaleLabel">Quy mô bất động sản</p>
									<p class="mbland_linhvuc_listProject_itemScaleValue">Khu nghĩ dưỡng phức hợp sang trọng & cao cấp</p>
								</div>

							</div>
							<a class="mbland_linhvuc_listProject_itemLink">Xem chi tiết</a>
						</div>
					</div>


					<button class="mbland_linhvuc_listProject_loadMore"><svg class="mbland_linhvuc_listProject_loadMoreIcon" width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 1L8 8L15 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
<span class="mbland_linhvuc_listProject_loadMoreLabel">Xem thêm</span></button>

				</div>
			</div>

		</div>
	</div>
</section>
<!-- ===== END SECTION LIST PROJECT  ===== -->







<!-- ===== START SECTION CORE STRENGTHS ===== -->
 <section class="mbland_linhvuc_coreStrengths">
	<div class="container">
		<div class="mbland_linhvuc_coreStrengths_wrapper">
			<header class="mbland_linhvuc_coreStrengths_header">
				<h2 class="mbland_linhvuc_coreStrengths_title">
					Khẳng định năng lực, kiến tạo dấu ấn
				</h2>
				<p class="mbland_linhvuc_coreStrengths_desc">Tầm nhìn chiến lược và định hướng đầu tư dài hạn, MBLand Asset Management không ngừng mở rộng danh mục dự án, phát huy thế mạnh trong phát triển bất động sản, hướng đến kiến tạo những công trình chất lượng và giá trị bền vững cho thị trường.</p>
			</header>

			<div class="mbland_linhvuc_coreStrengths_list">
			<div class="mbland_linhvuc_coreStrengths_item">
				<img src="/wp-content/uploads/2025/10/diamond.svg" alt="Icon kim cương" class="mbland_linhvuc_coreStrengths_itemBg" title="Icon kim cương" loading="lazy" decoding="async" fetchpriority="low" width="136" height="188" />
				<div class="mbland_linhvuc_coreStrengths_itemMain">
					<h3 class="mbland_linhvuc_coreStrengths_itemTitle">đa dạng phân khúc</h3>
					<p class="mbland_linhvuc_coreStrengths_itemLabel">Mở rộng đầu tư</p>
				</div>
				<div class="mbland_linhvuc_coreStrengths_itemHover">
					<p class="mbland_linhvuc_coreStrengths_itemTag">Đô thị · Thương mại · Bất động sản </p>
					<p class="mbland_linhvuc_coreStrengths_itemDesc">Đa dạng phân khúc & Mở rộng cơ hội đầu tư.</p>
				</div>
			</div>

			<div class="mbland_linhvuc_coreStrengths_item">
				<img src="/wp-content/uploads/2025/10/diamond.svg" alt="Icon kim cương" class="mbland_linhvuc_coreStrengths_itemBg" title="Icon kim cương" loading="lazy" decoding="async" fetchpriority="low" width="136" height="188" />
				<div class="mbland_linhvuc_coreStrengths_itemMain">
					<h3 class="mbland_linhvuc_coreStrengths_itemTitle">Đầu tư chiến lược</h3>
					<p class="mbland_linhvuc_coreStrengths_itemLabel">Kiến tạo lâu dài</p>
				</div>
				<div class="mbland_linhvuc_coreStrengths_itemHover">
					<p class="mbland_linhvuc_coreStrengths_itemTag">Đô thị · Thương mại · Bất động sản </p>
					<p class="mbland_linhvuc_coreStrengths_itemDesc">Đa dạng phân khúc & Mở rộng cơ hội đầu tư.</p>
				</div>
			</div>

			<div class="mbland_linhvuc_coreStrengths_item">
				<img src="/wp-content/uploads/2025/10/diamond.svg" alt="Icon kim cương" class="mbland_linhvuc_coreStrengths_itemBg" title="Icon kim cương" loading="lazy" decoding="async" fetchpriority="low" width="136" height="188" />
				<div class="mbland_linhvuc_coreStrengths_itemMain">
					<h3 class="mbland_linhvuc_coreStrengths_itemTitle">Phát triển bền vững</h3>
					<p class="mbland_linhvuc_coreStrengths_itemLabel">Chất lượng & hiệu quả</p>
				</div>
				<div class="mbland_linhvuc_coreStrengths_itemHover">
					<p class="mbland_linhvuc_coreStrengths_itemTag">Đô thị · Thương mại · Bất động sản </p>
					<p class="mbland_linhvuc_coreStrengths_itemDesc">Đa dạng phân khúc & Mở rộng cơ hội đầu tư.</p>
				</div>
			</div>

			<div class="mbland_linhvuc_coreStrengths_item">
				<img src="/wp-content/uploads/2025/10/diamond.svg" alt="Icon kim cương" class="mbland_linhvuc_coreStrengths_itemBg" title="Icon kim cương" loading="lazy" decoding="async" fetchpriority="low" width="136" height="188" />
				<div class="mbland_linhvuc_coreStrengths_itemMain">
					<h3 class="mbland_linhvuc_coreStrengths_itemTitle">Kiểm soát chi phí</h3>
					<p class="mbland_linhvuc_coreStrengths_itemLabel">Hợp tác lâu dài</p>
				</div>
				<div class="mbland_linhvuc_coreStrengths_itemHover">
					<p class="mbland_linhvuc_coreStrengths_itemTag">Đô thị · Thương mại · Bất động sản </p>
					<p class="mbland_linhvuc_coreStrengths_itemDesc">Đa dạng phân khúc & Mở rộng cơ hội đầu tư.</p>
				</div>
			</div>

			<div class="mbland_linhvuc_coreStrengths_item">
				<img src="/wp-content/uploads/2025/10/diamond.svg" alt="Icon kim cương" class="mbland_linhvuc_coreStrengths_itemBg" title="Icon kim cương" loading="lazy" decoding="async" fetchpriority="low" width="136" height="188" />
				<div class="mbland_linhvuc_coreStrengths_itemMain">
					<h3 class="mbland_linhvuc_coreStrengths_itemTitle">Hệ sinh thái đối tác</h3>
					<p class="mbland_linhvuc_coreStrengths_itemLabel">Cam kết & phát triển</p>
				</div>
				<div class="mbland_linhvuc_coreStrengths_itemHover">
					<p class="mbland_linhvuc_coreStrengths_itemTag">Đô thị · Thương mại · Bất động sản </p>
					<p class="mbland_linhvuc_coreStrengths_itemDesc">Đa dạng phân khúc & Mở rộng cơ hội đầu tư.</p>
				</div>
			</div>

			<div class="mbland_linhvuc_coreStrengths_item">
				<img src="/wp-content/uploads/2025/10/diamond.svg" alt="Icon kim cương" class="mbland_linhvuc_coreStrengths_itemBg" title="Icon kim cương" loading="lazy" decoding="async" fetchpriority="low" width="136" height="188" />
				<div class="mbland_linhvuc_coreStrengths_itemMain">
					<h3 class="mbland_linhvuc_coreStrengths_itemTitle">Đầu tư chiến lược</h3>
					<p class="mbland_linhvuc_coreStrengths_itemLabel">Kiến tạo lâu dài</p>
				</div>
				<div class="mbland_linhvuc_coreStrengths_itemHover">
					<p class="mbland_linhvuc_coreStrengths_itemTag">Đô thị · Thương mại · Bất động sản </p>
					<p class="mbland_linhvuc_coreStrengths_itemDesc">Đa dạng phân khúc & Mở rộng cơ hội đầu tư.</p>
				</div>
			</div>

			<div class="mbland_linhvuc_coreStrengths_item">
				<img src="/wp-content/uploads/2025/10/diamond.svg" alt="Icon kim cương" class="mbland_linhvuc_coreStrengths_itemBg" title="Icon kim cương" loading="lazy" decoding="async" fetchpriority="low" width="136" height="188" />
				<div class="mbland_linhvuc_coreStrengths_itemMain">
					<h3 class="mbland_linhvuc_coreStrengths_itemTitle">Phát triển bền vững</h3>
					<p class="mbland_linhvuc_coreStrengths_itemLabel">Chất lượng & hiệu quả</p>
				</div>
				<div class="mbland_linhvuc_coreStrengths_itemHover">
					<p class="mbland_linhvuc_coreStrengths_itemTag">Đô thị · Thương mại · Bất động sản </p>
					<p class="mbland_linhvuc_coreStrengths_itemDesc">Đa dạng phân khúc & Mở rộng cơ hội đầu tư.</p>
				</div>
			</div>

			<div class="mbland_linhvuc_coreStrengths_item">
				<img src="/wp-content/uploads/2025/10/diamond.svg" alt="Icon kim cương" class="mbland_linhvuc_coreStrengths_itemBg" title="Icon kim cương" loading="lazy" decoding="async" fetchpriority="low" width="136" height="188" />
				<div class="mbland_linhvuc_coreStrengths_itemMain">
					<h3 class="mbland_linhvuc_coreStrengths_itemTitle">Kiểm soát chi phí</h3>
					<p class="mbland_linhvuc_coreStrengths_itemLabel">Hợp tác lâu dài</p>
				</div>
				<div class="mbland_linhvuc_coreStrengths_itemHover">
					<p class="mbland_linhvuc_coreStrengths_itemTag">Đô thị · Thương mại · Bất động sản </p>
					<p class="mbland_linhvuc_coreStrengths_itemDesc">Đa dạng phân khúc & Mở rộng cơ hội đầu tư.</p>
				</div>
			</div>
		</div>
		</div>

	</div>
 </section>
<!-- ===== END SECTION CORE STRENGTHS  ===== -->






<?php get_template_part( 'template-parts/sections/procedure' ); ?>





<section class="mbland_linhvuc_featuredProject">
	<div class="container">
		<div class="mbland_linhvuc_featuredProject_wrapper">
			<header class="mbland_linhvuc_featuredProject_header">
				<h2 class="mbland_linhvuc_featuredProject_title">Các dự án nổi bật</h2>
			</header>
			<div class="mbland_linhvuc_featuredProject_list">
				<article class="mbland_linhvuc_featuredProject_item">
					<div class="mbland_linhvuc_featuredProject_itemMedia">
						<img class="mbland_linhvuc_featuredProject_itemImage" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Dự án T18 - Đà Nẵng" title="Dự án T18 - Đà Nẵng" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> />
					</div>
					<div class="mbland_linhvuc_featuredProject_itemBody">
						<div class="mbland_linhvuc_featuredProject_itemHeader">
							<h3 class="mbland_linhvuc_featuredProject_itemTitle">Dự án T18 - Đà Nẵng</h3>
							<p class="mbland_linhvuc_featuredProject_itemDesc">Phát triển các dự án bất động sản chất lượng cao, mang lại giá trị bền vững cho cộng đồng.</p>
						</div>
						<hr class="mbland_linhvuc_featuredProject_itemDivider" />
						<div class="mbland_linhvuc_featuredProject_itemLocation">
							<span class="mbland_linhvuc_featuredProject_itemLocationIcon">
								<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7 0.875C5.72411 0.876505 4.50091 1.38402 3.59871 2.28621C2.69652 3.1884 2.18901 4.41161 2.1875 5.6875C2.18633 6.7301 2.52687 7.74436 3.157 8.575C3.157 8.575 3.28825 8.74781 3.30969 8.77275L7 13.125L10.6921 8.77056C10.7113 8.74738 10.843 8.575 10.843 8.575L10.8434 8.57369C11.4731 7.74335 11.8135 6.7296 11.8125 5.6875C11.811 4.41161 11.3035 3.1884 10.4013 2.28621C9.4991 1.38402 8.2759 0.876505 7 0.875ZM7 7.4375C6.65389 7.4375 6.31554 7.33486 6.02776 7.14257C5.73997 6.95028 5.51567 6.67697 5.38321 6.3572C5.25076 6.03743 5.2161 5.68556 5.28363 5.34609C5.35115 5.00663 5.51782 4.6948 5.76257 4.45006C6.00731 4.20532 6.31913 4.03865 6.6586 3.97113C6.99806 3.9036 7.34993 3.93826 7.6697 4.07071C7.98947 4.20316 8.26278 4.42747 8.45507 4.71525C8.64737 5.00304 8.75 5.34138 8.75 5.6875C8.74942 6.15145 8.56486 6.59623 8.2368 6.9243C7.90874 7.25236 7.46395 7.43692 7 7.4375Z" fill="var(--primary-color)"/>
								</svg>
							</span>
							<div class="mbland_linhvuc_featuredProject_itemLocationText">
								<p class="mbland_linhvuc_featuredProject_itemLocationLabel">Vị trí địa chỉ</p>
								<p class="mbland_linhvuc_featuredProject_itemLocationValue">Trường Sa, Phường Hoà Hải, Quận Ngũ Hành Sơn, Đà Nẵng, Việt Nam</p>
							</div>
						</div>
						<div class="mbland_linhvuc_featuredProject_itemAction">
							<a href="#" class="mbland_linhvuc_featuredProject_itemLink">Xem chi tiết</a>
						</div>
					</div>
				</article>
				<article class="mbland_linhvuc_featuredProject_item">
					<div class="mbland_linhvuc_featuredProject_itemMedia">
						<img class="mbland_linhvuc_featuredProject_itemImage" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Dự án T18 - Đà Nẵng" title="Dự án T18 - Đà Nẵng" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> />
					</div>
					<div class="mbland_linhvuc_featuredProject_itemBody">
						<div class="mbland_linhvuc_featuredProject_itemHeader">
							<h3 class="mbland_linhvuc_featuredProject_itemTitle">Dự án T18 - Đà Nẵng</h3>
							<p class="mbland_linhvuc_featuredProject_itemDesc">Phát triển các dự án bất động sản chất lượng cao, mang lại giá trị bền vững cho cộng đồng.</p>
						</div>
						<hr class="mbland_linhvuc_featuredProject_itemDivider" />
						<div class="mbland_linhvuc_featuredProject_itemLocation">
							<span class="mbland_linhvuc_featuredProject_itemLocationIcon">
								<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7 0.875C5.72411 0.876505 4.50091 1.38402 3.59871 2.28621C2.69652 3.1884 2.18901 4.41161 2.1875 5.6875C2.18633 6.7301 2.52687 7.74436 3.157 8.575C3.157 8.575 3.28825 8.74781 3.30969 8.77275L7 13.125L10.6921 8.77056C10.7113 8.74738 10.843 8.575 10.843 8.575L10.8434 8.57369C11.4731 7.74335 11.8135 6.7296 11.8125 5.6875C11.811 4.41161 11.3035 3.1884 10.4013 2.28621C9.4991 1.38402 8.2759 0.876505 7 0.875ZM7 7.4375C6.65389 7.4375 6.31554 7.33486 6.02776 7.14257C5.73997 6.95028 5.51567 6.67697 5.38321 6.3572C5.25076 6.03743 5.2161 5.68556 5.28363 5.34609C5.35115 5.00663 5.51782 4.6948 5.76257 4.45006C6.00731 4.20532 6.31913 4.03865 6.6586 3.97113C6.99806 3.9036 7.34993 3.93826 7.6697 4.07071C7.98947 4.20316 8.26278 4.42747 8.45507 4.71525C8.64737 5.00304 8.75 5.34138 8.75 5.6875C8.74942 6.15145 8.56486 6.59623 8.2368 6.9243C7.90874 7.25236 7.46395 7.43692 7 7.4375Z" fill="var(--primary-color)"/>
								</svg>
							</span>
							<div class="mbland_linhvuc_featuredProject_itemLocationText">
								<p class="mbland_linhvuc_featuredProject_itemLocationLabel">Vị trí địa chỉ</p>
								<p class="mbland_linhvuc_featuredProject_itemLocationValue">Trường Sa, Phường Hoà Hải, Quận Ngũ Hành Sơn, Đà Nẵng, Việt Nam</p>
							</div>
						</div>
						<div class="mbland_linhvuc_featuredProject_itemAction">
							<a href="#" class="mbland_linhvuc_featuredProject_itemLink">Xem chi tiết</a>
						</div>
					</div>
				</article>
				<article class="mbland_linhvuc_featuredProject_item">
					<div class="mbland_linhvuc_featuredProject_itemMedia">
						<img class="mbland_linhvuc_featuredProject_itemImage" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Dự án T18 - Đà Nẵng" title="Dự án T18 - Đà Nẵng" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> />
					</div>
					<div class="mbland_linhvuc_featuredProject_itemBody">
						<div class="mbland_linhvuc_featuredProject_itemHeader">
							<h3 class="mbland_linhvuc_featuredProject_itemTitle">Dự án T18 - Đà Nẵng</h3>
							<p class="mbland_linhvuc_featuredProject_itemDesc">Phát triển các dự án bất động sản chất lượng cao, mang lại giá trị bền vững cho cộng đồng.</p>
						</div>
						<hr class="mbland_linhvuc_featuredProject_itemDivider" />
						<div class="mbland_linhvuc_featuredProject_itemLocation">
							<span class="mbland_linhvuc_featuredProject_itemLocationIcon">
								<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7 0.875C5.72411 0.876505 4.50091 1.38402 3.59871 2.28621C2.69652 3.1884 2.18901 4.41161 2.1875 5.6875C2.18633 6.7301 2.52687 7.74436 3.157 8.575C3.157 8.575 3.28825 8.74781 3.30969 8.77275L7 13.125L10.6921 8.77056C10.7113 8.74738 10.843 8.575 10.843 8.575L10.8434 8.57369C11.4731 7.74335 11.8135 6.7296 11.8125 5.6875C11.811 4.41161 11.3035 3.1884 10.4013 2.28621C9.4991 1.38402 8.2759 0.876505 7 0.875ZM7 7.4375C6.65389 7.4375 6.31554 7.33486 6.02776 7.14257C5.73997 6.95028 5.51567 6.67697 5.38321 6.3572C5.25076 6.03743 5.2161 5.68556 5.28363 5.34609C5.35115 5.00663 5.51782 4.6948 5.76257 4.45006C6.00731 4.20532 6.31913 4.03865 6.6586 3.97113C6.99806 3.9036 7.34993 3.93826 7.6697 4.07071C7.98947 4.20316 8.26278 4.42747 8.45507 4.71525C8.64737 5.00304 8.75 5.34138 8.75 5.6875C8.74942 6.15145 8.56486 6.59623 8.2368 6.9243C7.90874 7.25236 7.46395 7.43692 7 7.4375Z" fill="var(--primary-color)"/>
								</svg>
							</span>
							<div class="mbland_linhvuc_featuredProject_itemLocationText">
								<p class="mbland_linhvuc_featuredProject_itemLocationLabel">Vị trí địa chỉ</p>
								<p class="mbland_linhvuc_featuredProject_itemLocationValue">Trường Sa, Phường Hoà Hải, Quận Ngũ Hành Sơn, Đà Nẵng, Việt Nam</p>
							</div>
						</div>
						<div class="mbland_linhvuc_featuredProject_itemAction">
							<a href="#" class="mbland_linhvuc_featuredProject_itemLink">Xem chi tiết</a>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
</section>






<?php get_template_part( 'template-parts/sections/contact-form' ); ?>







<?php get_footer(); ?>

