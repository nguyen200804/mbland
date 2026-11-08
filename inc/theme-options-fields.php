<?php
/**
 * Đăng ký ACF Options Page & Field Group cho Cài đặt chung: Đối tác (Brands) & Form liên hệ (Contact Form)
 * Hỗ trợ đa ngôn ngữ Polylang (tách biệt lưu trữ riêng cho từng ngôn ngữ).
 *
 * @package HomeNest Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// 1. Đăng ký ACF Options Page
add_action( 'acf/init', 'mbland_register_theme_options_page' );
function mbland_register_theme_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page( array(
			'page_title' => 'Cài đặt Theme',
			'menu_title' => 'Cài đặt Theme',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
			'icon_url'   => 'dashicons-admin-generic',
			'position'   => 30,
		) );
	}
}

// 2. Đăng ký ACF Fields cho Options Page
add_action( 'acf/init', 'mbland_register_shared_sections_acf_fields' );
function mbland_register_shared_sections_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'                   => 'group_theme_shared_sections',
		'title'                 => 'Cài đặt Section: Đối tác & Form liên hệ',
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'active'                => true,
		'location'              => array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'theme-general-settings',
				),
			),
		),
		'fields'                => array(

			// ==========================================
			// TAB 1: ĐỐI TÁC (BRANDS)
			// ==========================================
			array(
				'key'   => 'field_tab_options_brands',
				'label' => 'Đối tác (Brands)',
				'type'  => 'tab',
			),
			array(
				'key'         => 'field_options_brands_title',
				'label'       => 'Tiêu đề Section Đối tác',
				'name'        => 'brands_title',
				'type'        => 'text',
				'placeholder' => 'VD: Các đối tác của chúng tôi (hoặc Our Partners)',
			),
			array(
				'key'         => 'field_options_brands_desc',
				'label'       => 'Mô tả Section Đối tác',
				'name'        => 'brands_desc',
				'type'        => 'textarea',
				'rows'        => 3,
				'placeholder' => 'Mô tả giới thiệu đối tác...',
			),
			array(
				'key'          => 'field_options_brands_list',
				'label'        => 'Danh sách Logo Đối tác',
				'name'         => 'brands_list',
				'type'         => 'repeater',
				'instructions' => 'Thêm các logo đối tác để hiển thị trên dải chạy ngang. Nếu để trống ở ngôn ngữ phụ, hệ thống sẽ tự động dùng danh sách logo mặc định.',
				'layout'       => 'table',
				'button_label' => 'Thêm đối tác',
				'sub_fields'   => array(
					array(
						'key'           => 'field_options_brand_logo',
						'label'         => 'Logo',
						'name'          => 'logo',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'medium',
						'required'      => 1,
					),
					array(
						'key'         => 'field_options_brand_name',
						'label'       => 'Tên đối tác (Alt text)',
						'name'        => 'name',
						'type'        => 'text',
						'placeholder' => 'VD: Vietcombank, Savills...',
					),
					array(
						'key'         => 'field_options_brand_link',
						'label'       => 'Link website (Tùy chọn)',
						'name'        => 'link',
						'type'        => 'url',
						'placeholder' => 'https://...',
					),
				),
			),

			// ==========================================
			// TAB 2: FORM LIÊN HỆ (CONTACT FORM)
			// ==========================================
			array(
				'key'   => 'field_tab_options_contact',
				'label' => 'Form Liên hệ (Contact Form)',
				'type'  => 'tab',
			),
			array(
				'key'         => 'field_options_contact_title',
				'label'       => 'Tiêu đề Form liên hệ',
				'name'        => 'contact_title',
				'type'        => 'text',
				'placeholder' => 'VD: Liên hệ gửi yêu cầu tư vấn (hoặc Contact Us)',
			),
			array(
				'key'         => 'field_options_contact_desc',
				'label'       => 'Mô tả Form liên hệ',
				'name'        => 'contact_desc',
				'type'        => 'textarea',
				'rows'        => 3,
				'placeholder' => 'Mô tả ngắn gọn về dịch vụ tư vấn...',
			),
			array(
				'key'           => 'field_options_contact_bg',
				'label'         => 'Ảnh nền Section liên hệ',
				'name'          => 'contact_bg',
				'type'          => 'image',
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'instructions'  => 'Ảnh nền kích thước lớn (khuyến nghị 2560x1157px). Nếu để trống sẽ dùng ảnh mặc định.',
			),
			array(
				'key'          => 'field_options_contact_action',
				'label'        => 'Form Action URL',
				'name'         => 'contact_action',
				'type'         => 'text',
				'placeholder'  => '#',
				'instructions' => 'Đường dẫn nhận dữ liệu form (hoặc để # nếu xử lý bằng AJAX/Plugin khác).',
			),
		),
	) );
}

/**
 * 3. Hỗ trợ đa ngôn ngữ (Polylang) cho ACF Options Page:
 * Tự động phân tách bộ lưu trữ Options theo từng ngôn ngữ.
 * - Ngôn ngữ mặc định (vi): lưu vào 'options'
 * - Ngôn ngữ phụ (en, ja...): lưu vào 'options_en', 'options_ja'...
 */
add_filter( 'acf/validate_post_id', 'mbland_acf_options_multilingual_post_id', 10, 2 );
function mbland_acf_options_multilingual_post_id( $post_id, $original_post_id = null ) {
	if ( 'options' === $post_id || 'option' === $post_id ) {
		$default_lang = function_exists( 'pll_default_language' ) ? pll_default_language( 'slug' ) : '';
		$current_lang = '';

		if ( is_admin() ) {
			// Đang trong WP Admin: kiểm tra tham số lang trên URL hoặc POST
			if ( isset( $_GET['lang'] ) && 'all' !== $_GET['lang'] ) {
				$current_lang = sanitize_key( $_GET['lang'] );
			} elseif ( isset( $_POST['lang'] ) && 'all' !== $_POST['lang'] ) {
				$current_lang = sanitize_key( $_POST['lang'] );
			} elseif ( function_exists( 'pll_current_language' ) ) {
				$current_lang = pll_current_language( 'slug' );
			}
		} else {
			// Ngoài frontend: lấy theo ngôn ngữ đang truy cập
			if ( function_exists( 'pll_current_language' ) ) {
				$current_lang = pll_current_language( 'slug' );
			}
		}

		if ( empty( $current_lang ) ) {
			$current_lang = $default_lang;
		}

		// Nếu là ngôn ngữ phụ (khác ngôn ngữ mặc định), chuyển sang key riêng 'options_{lang}'
		if ( ! empty( $current_lang ) && ! empty( $default_lang ) && $current_lang !== $default_lang ) {
			return 'options_' . $current_lang;
		}
	}
	return $post_id;
}

/**
 * 4. Fallback tự động ngoài Frontend nếu ngôn ngữ phụ chưa nhập dữ liệu:
 * Giúp các trường như ảnh nền (contact_bg), danh sách đối tác (brands_list)
 * nếu chưa nhập ở tiếng Anh thì tự động lấy từ tiếng Việt sang.
 */
add_filter( 'acf/load_value', 'mbland_acf_options_multilingual_fallback', 10, 3 );
function mbland_acf_options_multilingual_fallback( $value, $post_id, $field ) {
	// Chỉ fallback ngoài frontend, KHÔNG fallback trong admin để tránh gây hiểu nhầm dữ liệu bị đồng bộ
	if ( ! is_admin() && is_string( $post_id ) && strpos( $post_id, 'options_' ) === 0 ) {
		if ( null === $value || '' === $value || false === $value || ( is_array( $value ) && empty( $value ) ) ) {
			$fallback_value = acf_get_value( 'options', $field );
			if ( ! empty( $fallback_value ) ) {
				return $fallback_value;
			}
		}
	}
	return $value;
}
