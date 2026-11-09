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

// ==========================================================================
// DỮ LIỆU ACF CỦA TERM (taxonomy linh-vuc) - có fallback mặc định
// ==========================================================================
$lv_term_key = 'term_' . $current_term->term_id;
$lv_get      = function ( $name ) use ( $lv_term_key ) {
	return function_exists( 'get_field' ) ? get_field( $name, $lv_term_key ) : '';
};

$lv_list_title = $lv_get( 'lv_list_title' ) ?: 'Kiến tạo không gian - Nâng tầm bất động sản';
$lv_list_desc  = $lv_get( 'lv_list_desc' ) ?: 'Phát triển đa dạng phân khúc bất động sản, từ đô thị, nhà ở đến thương mại, văn phòng và nghỉ dưỡng, MBLand Asset Management hướng đến kiến tạo những không gian chất lượng, đáp ứng nhu cầu thị trường và mang lại giá trị đầu tư dài hạn.';

$lv_strengths_title = $lv_get( 'lv_strengths_title' ) ?: 'Khẳng định năng lực, kiến tạo dấu ấn';
$lv_strengths_desc  = $lv_get( 'lv_strengths_desc' ) ?: 'Tầm nhìn chiến lược và định hướng đầu tư dài hạn, MBLand Asset Management không ngừng mở rộng danh mục dự án, phát huy thế mạnh trong phát triển bất động sản, hướng đến kiến tạo những công trình chất lượng và giá trị bền vững cho thị trường.';
$lv_strengths_raw   = $lv_get( 'lv_strengths_items' );
$lv_strengths_items = array();
if ( ! empty( $lv_strengths_raw ) && is_array( $lv_strengths_raw ) ) {
	foreach ( $lv_strengths_raw as $row ) {
		$lv_strengths_items[] = array(
			'title' => isset( $row['title'] ) ? $row['title'] : '',
			'label' => isset( $row['label'] ) ? $row['label'] : '',
			'tag'   => isset( $row['tag'] ) ? $row['tag'] : '',
			'desc'  => isset( $row['desc'] ) ? $row['desc'] : '',
		);
	}
} else {
	$lv_default_tag  = 'Đô thị · Thương mại · Bất động sản';
	$lv_default_desc = 'Đa dạng phân khúc & Mở rộng cơ hội đầu tư.';
	$lv_defaults     = array(
		array( 'Đa dạng phân khúc', 'Mở rộng đầu tư' ),
		array( 'Đầu tư chiến lược', 'Kiến tạo lâu dài' ),
		array( 'Phát triển bền vững', 'Chất lượng & hiệu quả' ),
		array( 'Kiểm soát chi phí', 'Hợp tác lâu dài' ),
		array( 'Hệ sinh thái đối tác', 'Cam kết & phát triển' ),
		array( 'Đầu tư chiến lược', 'Kiến tạo lâu dài' ),
		array( 'Phát triển bền vững', 'Chất lượng & hiệu quả' ),
		array( 'Kiểm soát chi phí', 'Hợp tác lâu dài' ),
	);
	foreach ( $lv_defaults as $d ) {
		$lv_strengths_items[] = array(
			'title' => $d[0],
			'label' => $d[1],
			'tag'   => $lv_default_tag,
			'desc'  => $lv_default_desc,
		);
	}
}

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

// Xác định danh mục chỉ định để lọc dự án (ưu tiên query string ?danh-muc= / ?category= / ?term=, mặc định lấy term hiện tại)
$target_term_slug = '';
$target_term_id   = 0;

if ( ! empty( $_GET['danh-muc'] ) ) {
	$target_term_slug = sanitize_title( wp_unslash( $_GET['danh-muc'] ) );
} elseif ( ! empty( $_GET['category'] ) ) {
	$target_term_slug = sanitize_title( wp_unslash( $_GET['category'] ) );
} elseif ( ! empty( $_GET['term'] ) ) {
	$target_term_slug = sanitize_title( wp_unslash( $_GET['term'] ) );
}

if ( ! empty( $target_term_slug ) ) {
	$found_term = get_term_by( 'slug', $target_term_slug, 'linh-vuc' );
	if ( ! $found_term || is_wp_error( $found_term ) ) {
		$found_term = get_term_by( 'slug', $target_term_slug, 'danh-muc-du-an' );
	}
	if ( $found_term && ! is_wp_error( $found_term ) ) {
		$target_term_id   = (int) $found_term->term_id;
		$target_term_slug = $found_term->slug;
	}
}

if ( empty( $target_term_id ) && ! empty( $current_term->term_id ) ) {
	$target_term_id   = (int) $current_term->term_id;
	$target_term_slug = $current_term->slug;
}

// Xây dựng tax_query lọc theo danh mục chỉ định
$tax_conditions = array();

if ( ! empty( $target_term_id ) ) {
	$tax_conditions[] = array(
		'taxonomy'         => 'linh-vuc',
		'field'            => 'term_id',
		'terms'            => $target_term_id,
		'include_children' => true,
	);
}

if ( ! empty( $target_term_slug ) ) {
	$tax_conditions[] = array(
		'taxonomy'         => 'danh-muc-du-an',
		'field'            => 'slug',
		'terms'            => $target_term_slug,
		'include_children' => true,
	);
}

$tax_query = array();
if ( count( $tax_conditions ) > 1 ) {
	$tax_query = array_merge( array( 'relation' => 'OR' ), $tax_conditions );
} elseif ( count( $tax_conditions ) === 1 ) {
	$tax_query = $tax_conditions;
}

$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );

// ==========================================================================
// TAB LĨNH VỰC: các term con (hoặc term cùng cấp nếu term hiện tại không có con)
// Mỗi tab có 1 panel chứa danh sách dự án; chuyển tab bằng JS (không chuyển trang).
// ==========================================================================
$lv_tab_terms = get_terms( array(
	'taxonomy'   => 'linh-vuc',
	'parent'     => ! empty( $current_term->term_id ) ? $current_term->term_id : 0,
	'hide_empty' => false,
	'orderby'    => 'name',
	'order'      => 'ASC',
) );
if ( ( empty( $lv_tab_terms ) || is_wp_error( $lv_tab_terms ) ) && ! empty( $current_term->parent ) ) {
	$lv_tab_terms = get_terms( array(
		'taxonomy'   => 'linh-vuc',
		'parent'     => $current_term->parent,
		'hide_empty' => false,
		'orderby'    => 'name',
		'order'      => 'ASC',
	) );
}
if ( is_wp_error( $lv_tab_terms ) || empty( $lv_tab_terms ) ) {
	$lv_tab_terms = array();
}

$lv_build_projects_query = function ( $term_id, $term_slug ) {
	return new WP_Query( array(
		'post_type'      => 'du-an',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'no_found_rows'  => true,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'tax_query'      => array(
			'relation' => 'OR',
			array(
				'taxonomy'         => 'linh-vuc',
				'field'            => 'term_id',
				'terms'            => (int) $term_id,
				'include_children' => true,
			),
			array(
				'taxonomy'         => 'danh-muc-du-an',
				'field'            => 'slug',
				'terms'            => $term_slug,
				'include_children' => true,
			),
		),
	) );
};

// Tab đang mở: term hiện tại (hoặc ?danh-muc=) nếu nằm trong danh sách tab, mặc định tab đầu tiên
$lv_active_term_id = 0;
foreach ( $lv_tab_terms as $lv_tab_term ) {
	if ( (int) $lv_tab_term->term_id === (int) $target_term_id ) {
		$lv_active_term_id = (int) $lv_tab_term->term_id;
		break;
	}
}
// Chưa active tab nào mặc định: chỉ active khi term hiện tại trùng với tab (bỏ mặc định tab đầu tiên)
// if ( ! $lv_active_term_id && ! empty( $lv_tab_terms ) ) {
// 	$lv_active_term_id = (int) reset( $lv_tab_terms )->term_id;
// }

$lv_panels = array();
if ( ! empty( $lv_tab_terms ) ) {
	foreach ( $lv_tab_terms as $lv_tab_term ) {
		$lv_panels[] = array(
			'term'   => $lv_tab_term,
			'query'  => $lv_build_projects_query( $lv_tab_term->term_id, $lv_tab_term->slug ),
			'active' => ( (int) $lv_tab_term->term_id === $lv_active_term_id ),
		);
	}
} else {
	// Không có term con/anh em: 1 panel duy nhất (không hiện tab)
	$lv_panels[] = array(
		'term'   => $current_term,
		'query'  => new WP_Query( array(
			'post_type'      => 'du-an',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'no_found_rows'  => true,
			'tax_query'      => $tax_query,
			'orderby'        => 'date',
			'order'          => 'DESC',
		) ),
		'active' => true,
	);
}
$lv_per_page = 12;

// ==========================================================================
// DỰ ÁN HIỂN THỊ Ở HERO (khung nổi bật)
// Ưu tiên: dự án mới nhất thuộc taxonomy `du-an-noi-bat` (trong lĩnh vực hiện tại)
// -> nếu không có: dự án mới nhất trong lĩnh vực hiện tại
// -> nếu vẫn không có: dự án mới nhất của toàn bộ post-type `du-an`.
// ==========================================================================
$hero_base_args = array(
	'post_type'           => 'du-an',
	'post_status'         => 'publish',
	'posts_per_page'      => 1,
	'orderby'             => 'date',
	'order'               => 'DESC',
	'no_found_rows'       => true,
	'ignore_sticky_posts' => true,
);
$hero_noi_bat_clause = array(
	'taxonomy' => 'du-an-noi-bat',
	'operator' => 'EXISTS',
);

$hero_attempts = array();
if ( ! empty( $tax_query ) ) {
	$hero_attempts[] = array_merge( $hero_base_args, array( 'tax_query' => array( 'relation' => 'AND', $hero_noi_bat_clause, $tax_query ) ) );
}
$hero_attempts[] = array_merge( $hero_base_args, array( 'tax_query' => array( $hero_noi_bat_clause ) ) );
if ( ! empty( $tax_query ) ) {
	$hero_attempts[] = array_merge( $hero_base_args, array( 'tax_query' => $tax_query ) );
}
$hero_attempts[] = $hero_base_args;

$hero_project_id = 0;
foreach ( $hero_attempts as $hero_attempt_args ) {
	$hero_query = new WP_Query( $hero_attempt_args );
	if ( $hero_query->have_posts() ) {
		$hero_project_id = (int) $hero_query->posts[0]->ID;
		break;
	}
}
wp_reset_postdata();

// Chưa có tab nào active: hiện panel "tất cả" = mọi dự án thuộc danh mục hiện tại, trừ dự án đang hiện ở hero
if ( ! empty( $lv_tab_terms ) && ! $lv_active_term_id ) {
	$lv_all_args = array(
		'post_type'      => 'du-an',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'no_found_rows'  => true,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post__not_in'   => $hero_project_id ? array( $hero_project_id ) : array(),
	);
	if ( ! empty( $tax_query ) ) {
		$lv_all_args['tax_query'] = $tax_query;
	}
	$lv_panels[] = array(
		'term'   => $current_term,
		'query'  => new WP_Query( $lv_all_args ),
		'active' => true,
		'is_all' => true,
	);
}

$hero_title    = '';
$hero_desc     = '';
$hero_location = '';
$hero_link     = '';
if ( $hero_project_id ) {
	$hero_title = get_the_title( $hero_project_id );
	$hero_link  = get_permalink( $hero_project_id );
	$hero_desc  = function_exists( 'get_field' ) ? get_field( 'short_content', $hero_project_id ) : '';
	if ( empty( $hero_desc ) ) {
		$hero_desc = has_excerpt( $hero_project_id ) ? get_the_excerpt( $hero_project_id ) : wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $hero_project_id ) ), 50, '...' );
	}
	$hero_location_raw = function_exists( 'get_field' ) ? get_field( 'location', $hero_project_id ) : '';
	$hero_location     = function_exists( 'mbland_clean_plain_text' ) ? mbland_clean_plain_text( $hero_location_raw ) : wp_strip_all_tags( (string) $hero_location_raw );
}
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
	<?php if ( $hero_project_id ) : ?>
	<div class="mbland_linhvuc_hero_featured">
		<div class="container mbland_linhvuc_hero_featuredContainer">
			<div class="mbland_linhvuc_hero_featuredInfo">
				<p class="mbland_linhvuc_hero_featuredTitle"><?php echo esc_html( $hero_title ); ?></p>
				<p class="mbland_linhvuc_hero_featuredDesc"><?php echo esc_html( $hero_desc ); ?></p>
				<div class="mbland_linhvuc_hero_featuredDecor">
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
					<svg viewBox="0 0 27 26" xmlns="http://www.w3.org/2000/svg"><path d="M12.19.691c.3-.921 1.603-.921 1.902 0l2.417 7.438a1 1 0 0 0 .95.69h7.821c.97 0 1.372 1.24.588 1.81l-6.327 4.596a1 1 0 0 0-.363 1.118l2.417 7.438c.299.921-.755 1.688-1.54 1.118l-6.326-4.597a1 1 0 0 0-1.176 0L6.226 24.9c-.783.57-1.838-.197-1.538-1.118l2.416-7.438a1 1 0 0 0-.363-1.118L.414 10.63c-.784-.57-.38-1.81.588-1.81h7.82a1 1 0 0 0 .951-.69z" fill="currentColor"/></svg>
				</div>
				<?php if ( ! empty( $hero_location ) ) : ?>
				<hr class="mbland_linhvuc_hero_featuredDivider" />
				<div class="mbland_linhvuc_hero_featuredLocation">
					<span class="mbland_linhvuc_hero_featuredLocationIcon"><svg  viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 1.125C7.35957 1.12694 5.78688 1.77945 4.62692 2.93941C3.46696 4.09938 2.81444 5.67207 2.8125 7.3125C2.811 8.65299 3.24884 9.95704 4.059 11.025C4.059 11.025 4.22775 11.2472 4.25532 11.2793L9 16.875L13.7469 11.2764C13.7717 11.2466 13.941 11.025 13.941 11.025L13.9416 11.0233C14.7512 9.95574 15.1888 8.65235 15.1875 7.3125C15.1856 5.67207 14.5331 4.09938 13.3731 2.93941C12.2131 1.77945 10.6404 1.12694 9 1.125ZM9 9.5625C8.555 9.5625 8.11998 9.43054 7.74997 9.18331C7.37996 8.93607 7.09157 8.58467 6.92127 8.17354C6.75098 7.7624 6.70642 7.31 6.79324 6.87355C6.88005 6.43709 7.09434 6.03618 7.40901 5.72151C7.72368 5.40684 8.12459 5.19255 8.56105 5.10573C8.99751 5.01892 9.44991 5.06347 9.86104 5.23377C10.2722 5.40407 10.6236 5.69246 10.8708 6.06247C11.118 6.43248 11.25 6.86749 11.25 7.3125C11.2493 7.90901 11.012 8.48087 10.5902 8.90267C10.1684 9.32446 9.59651 9.56176 9 9.5625Z" fill="currentColor"/>
						</svg>
					</span>
					<div class="mbland_linhvuc_hero_featuredLocationText">
						<p class="mbland_linhvuc_hero_featuredLocationLabel"><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Vị trí DỰ ÁN' ) : 'Vị trí DỰ ÁN' ); ?></p>
						<p class="mbland_linhvuc_hero_featuredLocationValue"><?php echo esc_html( $hero_location ); ?></p>
					</div>

				</div>
				<?php endif; ?>
			</div>
			<div class="mbland_linhvuc_hero_featuredAction">
				<a class="mbland_linhvuc_hero_featuredLink" href="<?php echo esc_url( $hero_link ); ?>" title="<?php echo esc_attr( $hero_title ); ?>">
					<span class="mbland_linhvuc_hero_featuredLinkLabel"><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Tìm hiểu thêm về dự án' ) : 'Tìm hiểu thêm về dự án' ); ?></span>
					<svg class="mbland_linhvuc_hero_featuredLinkIcon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.333 14.333V1H1m13.333 0L1 14.333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"/></svg>
				</a>

			</div>

		</div>

	</div>
	<?php endif; ?>
</section>
<!-- ===== END SECTION LINH VUC HERO ===== -->






<!-- ===== START SECTION LIST PROJECT ===== -->
<section class="mbland_linhvuc_listProject">
	<div class="container">
		<div class="mbland_linhvuc_listProject_wrapper">
			<header class="mbland_linhvuc_listProject_header">
				<h2 class="mbland_linhvuc_listProject_title"><?php echo esc_html( $lv_list_title ); ?></h2>
				<p class="mbland_linhvuc_listProject_desc"><?php echo esc_html( $lv_list_desc ); ?></p>
			</header>

			<div class="mbland_linhvuc_listProject_body">
				<!-- Tab các term con của taxonomy=linh-vuc: bấm để đổi danh sách dự án, không chuyển trang -->
				<?php if ( ! empty( $lv_tab_terms ) ) : ?>
					<div class="mbland_linhvuc_listProject_filter">
						<ul class="mbland_linhvuc_listProject_filterList" role="tablist">
							<?php foreach ( $lv_panels as $lv_panel ) : ?>
								<?php
								if ( ! empty( $lv_panel['is_all'] ) ) {
									continue; // panel "tất cả" không có tab riêng
								}
								$lv_pt = $lv_panel['term'];
								?>
								<li class="mbland_linhvuc_listProject_filterItem" role="presentation">
									<a class="mbland_linhvuc_listProject_filterLink<?php echo $lv_panel['active'] ? ' active' : ''; ?>"
									   href="<?php echo esc_url( get_term_link( $lv_pt ) ); ?>"
									   role="tab"
									   id="lv-tab-<?php echo esc_attr( $lv_pt->term_id ); ?>"
									   aria-controls="lv-panel-<?php echo esc_attr( $lv_pt->term_id ); ?>"
									   aria-selected="<?php echo $lv_panel['active'] ? 'true' : 'false'; ?>"
									   data-tab="<?php echo esc_attr( $lv_pt->term_id ); ?>"
									   data-slug="<?php echo esc_attr( $lv_pt->slug ); ?>">
										<?php echo esc_html( $lv_pt->name ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<div class="mbland_linhvuc_listProject_content">
					<?php foreach ( $lv_panels as $lv_panel ) : ?>
						<?php
						$lv_pt    = $lv_panel['term'];
						$lv_query = $lv_panel['query'];
						?>
						<div class="mbland_linhvuc_listProject_panel"
							 id="lv-panel-<?php echo esc_attr( $lv_pt->term_id ); ?>"
							 role="tabpanel"
							 aria-labelledby="lv-tab-<?php echo esc_attr( $lv_pt->term_id ); ?>"
							 data-per-page="<?php echo esc_attr( $lv_per_page ); ?>"
							<?php echo $lv_panel['active'] ? '' : 'hidden'; ?>>
							<?php if ( $lv_query->have_posts() ) : ?>
								<?php
								while ( $lv_query->have_posts() ) :
									$lv_query->the_post();
									get_template_part( 'template-parts/ui/linhvuc-project-item' );
								endwhile;
								wp_reset_postdata();
								?>
								<?php if ( $lv_query->post_count > $lv_per_page ) : ?>
									<button type="button" class="mbland_linhvuc_listProject_loadMore">
										<svg class="mbland_linhvuc_listProject_loadMoreIcon" width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M1 1L8 8L15 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
										<span class="mbland_linhvuc_listProject_loadMoreLabel"><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Xem thêm' ) : 'Xem thêm' ); ?></span>
									</button>
								<?php endif; ?>
							<?php else : ?>
								<div class="mbland_linhvuc_projects_empty" style="text-align: center; padding: 40px 0; color: #888;">
									<p><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Chưa có dự án nào trong lĩnh vực này.' ) : 'Chưa có dự án nào trong lĩnh vực này.' ); ?></p>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
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
					<?php echo esc_html( $lv_strengths_title ); ?>
				</h2>
				<p class="mbland_linhvuc_coreStrengths_desc"><?php echo esc_html( $lv_strengths_desc ); ?></p>
			</header>

			<div class="mbland_linhvuc_coreStrengths_list">
			<?php foreach ( $lv_strengths_items as $lv_item ) : ?>
			<div class="mbland_linhvuc_coreStrengths_item">
				<img src="/wp-content/uploads/2025/10/diamond.svg" alt="Icon kim cương" class="mbland_linhvuc_coreStrengths_itemBg" title="Icon kim cương" loading="lazy" decoding="async" fetchpriority="low" width="136" height="188" />
				<div class="mbland_linhvuc_coreStrengths_itemMain">
					<h3 class="mbland_linhvuc_coreStrengths_itemTitle"><?php echo esc_html( $lv_item['title'] ); ?></h3>
					<p class="mbland_linhvuc_coreStrengths_itemLabel"><?php echo esc_html( $lv_item['label'] ); ?></p>
				</div>
				<div class="mbland_linhvuc_coreStrengths_itemHover">
					<p class="mbland_linhvuc_coreStrengths_itemTag"><?php echo esc_html( $lv_item['tag'] ); ?></p>
					<p class="mbland_linhvuc_coreStrengths_itemDesc"><?php echo esc_html( $lv_item['desc'] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		</div>

	</div>
 </section>
<!-- ===== END SECTION CORE STRENGTHS  ===== -->






<?php
get_template_part( 'template-parts/sections/procedure', null, array(
	'title' => $lv_get( 'lv_procedure_title' ),
	'desc'  => $lv_get( 'lv_procedure_desc' ),
	'items' => $lv_get( 'lv_procedure_items' ),
) );
?>





<section class="mbland_linhvuc_featuredProject">
	<div class="container">
		<div class="mbland_linhvuc_featuredProject_wrapper">
			<header class="mbland_linhvuc_featuredProject_header">
				<h2 class="mbland_linhvuc_featuredProject_title">Các dự án nổi bật</h2>
			</header>
			<div class="mbland_linhvuc_featuredProject_list">
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
						<article class="mbland_linhvuc_featuredProject_item">
							<div class="mbland_linhvuc_featuredProject_itemMedia">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" style="display:block;width:100%;height:100%;">
									<img class="mbland_linhvuc_featuredProject_itemImage" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $thumb_alt ); ?>" title="<?php echo esc_attr( get_the_title( $f_id ) ); ?>" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( $thumb_url, 800, 600 ) ); ?> />
								</a>
							</div>
							<div class="mbland_linhvuc_featuredProject_itemBody">
								<div class="mbland_linhvuc_featuredProject_itemHeader">
									<h3 class="mbland_linhvuc_featuredProject_itemTitle">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" style="color:inherit;text-decoration:none;">
											<?php the_title(); ?>
										</a>
									</h3>
									<?php if ( ! empty( $short_desc ) ) : ?>
										<p class="mbland_linhvuc_featuredProject_itemDesc"><?php echo wp_kses_post( wp_trim_words( $short_desc, 25, '...' ) ); ?></p>
									<?php endif; ?>
								</div>
								<hr class="mbland_linhvuc_featuredProject_itemDivider" />
								<?php if ( ! empty( $location ) ) : ?>
									<div class="mbland_linhvuc_featuredProject_itemLocation">
										<span class="mbland_linhvuc_featuredProject_itemLocationIcon">
											<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M7 0.875C5.72411 0.876505 4.50091 1.38402 3.59871 2.28621C2.69652 3.1884 2.18901 4.41161 2.1875 5.6875C2.18633 6.7301 2.52687 7.74436 3.157 8.575C3.157 8.575 3.28825 8.74781 3.30969 8.77275L7 13.125L10.6921 8.77056C10.7113 8.74738 10.843 8.575 10.843 8.575L10.8434 8.57369C11.4731 7.74335 11.8135 6.7296 11.8125 5.6875C11.811 4.41161 11.3035 3.1884 10.4013 2.28621C9.4991 1.38402 8.2759 0.876505 7 0.875ZM7 7.4375C6.65389 7.4375 6.31554 7.33486 6.02776 7.14257C5.73997 6.95028 5.51567 6.67697 5.38321 6.3572C5.25076 6.03743 5.2161 5.68556 5.28363 5.34609C5.35115 5.00663 5.51782 4.6948 5.76257 4.45006C6.00731 4.20532 6.31913 4.03865 6.6586 3.97113C6.99806 3.9036 7.34993 3.93826 7.6697 4.07071C7.98947 4.20316 8.26278 4.42747 8.45507 4.71525C8.64737 5.00304 8.75 5.34138 8.75 5.6875C8.74942 6.15145 8.56486 6.59623 8.2368 6.9243C7.90874 7.25236 7.46395 7.43692 7 7.4375Z" fill="var(--primary-color)"/>
											</svg>
										</span>
										<div class="mbland_linhvuc_featuredProject_itemLocationText">
											<p class="mbland_linhvuc_featuredProject_itemLocationLabel"><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Vị trí địa chỉ' ) : 'Vị trí địa chỉ' ); ?></p>
											<p class="mbland_linhvuc_featuredProject_itemLocationValue"><?php echo esc_html( $location ); ?></p>
										</div>
									</div>
								<?php endif; ?>
								<div class="mbland_linhvuc_featuredProject_itemAction">
									<a href="<?php the_permalink(); ?>" class="mbland_linhvuc_featuredProject_itemLink"><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Xem chi tiết' ) : 'Xem chi tiết' ); ?></a>
								</div>
							</div>
						</article>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<div class="mbland_linhvuc_featuredProject_empty" style="text-align:center;width:100%;padding:40px 0;color:#888;">
						<p><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Chưa có dự án nổi bật nào.' ) : 'Chưa có dự án nổi bật nào.' ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>






<?php get_template_part( 'template-parts/sections/contact-form' ); ?>







<?php get_footer(); ?>

