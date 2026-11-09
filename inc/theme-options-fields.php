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

// 2b. Đăng ký ACF Fields cho Footer (đọc trong footer.php)
add_action( 'acf/init', 'mbland_register_footer_acf_fields' );
function mbland_register_footer_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'                   => 'group_theme_footer',
		'title'                 => 'Cài đặt Footer',
		'menu_order'            => 1,
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

			// ---------- TAB: THƯƠNG HIỆU & LIÊN HỆ ----------
			array(
				'key'   => 'field_tab_footer_brand',
				'label' => 'Footer: Thương hiệu & Liên hệ',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_footer_logo',
				'label'         => 'Logo Footer',
				'name'          => 'footer_logo',
				'type'          => 'image',
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'instructions'  => 'Logo màu trắng (khuyến nghị PNG nền trong suốt). Để trống sẽ dùng logo mặc định.',
			),
			array(
				'key'         => 'field_footer_address',
				'label'       => 'Địa chỉ',
				'name'        => 'footer_address',
				'type'        => 'text',
				'placeholder' => '113 Nguyễn Văn Hưởng, Phường Thảo Điền, Quận 2, TP.Hồ Chí Minh.',
			),
			array(
				'key'         => 'field_footer_phone_fax',
				'label'       => 'Điện thoại & Fax (hiển thị)',
				'name'        => 'footer_phone_fax',
				'type'        => 'text',
				'placeholder' => '028 38 258 816',
			),
			array(
				'key'          => 'field_footer_phone_call',
				'label'        => 'Số điện thoại gọi (tel:)',
				'name'         => 'footer_phone_call',
				'type'         => 'text',
				'placeholder'  => '02838258816',
				'instructions' => 'Chỉ nhập số, không khoảng trắng. Để trống sẽ tự lấy từ số hiển thị.',
			),
			array(
				'key'         => 'field_footer_email',
				'label'       => 'Email',
				'name'        => 'footer_email',
				'type'        => 'email',
				'placeholder' => 'info@tasmaniapartners.vn',
			),

			// ---------- TAB: MẠNG XÃ HỘI ----------
			array(
				'key'   => 'field_tab_footer_social',
				'label' => 'Footer: Mạng xã hội',
				'type'  => 'tab',
			),
			array(
				'key'         => 'field_footer_social_title',
				'label'       => 'Tiêu đề khối mạng xã hội',
				'name'        => 'footer_social_title',
				'type'        => 'text',
				'placeholder' => 'Kết nối với chúng tôi',
			),
			array(
				'key'         => 'field_social_facebook',
				'label'       => 'Facebook',
				'name'        => 'social_facebook',
				'type'        => 'url',
				'placeholder' => 'https://facebook.com/...',
			),
			array(
				'key'         => 'field_social_instagram',
				'label'       => 'Instagram',
				'name'        => 'social_instagram',
				'type'        => 'url',
				'placeholder' => 'https://instagram.com/...',
			),
			array(
				'key'         => 'field_social_linkedin',
				'label'       => 'LinkedIn',
				'name'        => 'social_linkedin',
				'type'        => 'url',
				'placeholder' => 'https://linkedin.com/...',
			),
			array(
				'key'         => 'field_social_youtube',
				'label'       => 'YouTube',
				'name'        => 'social_youtube',
				'type'        => 'url',
				'placeholder' => 'https://youtube.com/...',
			),
			array(
				'key'         => 'field_social_zalo',
				'label'       => 'Zalo',
				'name'        => 'social_zalo',
				'type'        => 'url',
				'placeholder' => 'https://zalo.me/...',
			),

			// ---------- TAB: CỘT MENU ----------
			array(
				'key'   => 'field_tab_footer_menu',
				'label' => 'Footer: Các cột Menu',
				'type'  => 'tab',
			),
			array(
				'key'          => 'field_footer_menu_columns',
				'label'        => 'Cột menu Footer',
				'name'         => 'footer_menu_columns',
				'type'         => 'repeater',
				'instructions' => 'Mỗi dòng là một cột menu. Nếu để trống, footer hiển thị menu mặc định.',
				'layout'       => 'block',
				'button_label' => 'Thêm cột menu',
				'sub_fields'   => array(
					array(
						'key'   => 'field_footer_column_title',
						'label' => 'Tiêu đề cột',
						'name'  => 'column_title',
						'type'  => 'text',
					),
					array(
						'key'          => 'field_footer_column_links',
						'label'        => 'Danh sách liên kết',
						'name'         => 'column_links',
						'type'         => 'repeater',
						'layout'       => 'table',
						'button_label' => 'Thêm liên kết',
						'sub_fields'   => array(
							array(
								'key'   => 'field_footer_link_label',
								'label' => 'Tên liên kết',
								'name'  => 'link_label',
								'type'  => 'text',
							),
							array(
								'key'         => 'field_footer_link_url',
								'label'       => 'Đường dẫn',
								'name'        => 'link_url',
								'type'        => 'text',
								'placeholder' => '/ hoặc https://...',
							),
							array(
								'key'           => 'field_footer_link_blank',
								'label'         => 'Mở tab mới',
								'name'          => 'is_blank',
								'type'          => 'true_false',
								'ui'            => 1,
								'default_value' => 0,
							),
						),
					),
				),
			),

			// ---------- TAB: BẢN QUYỀN ----------
			array(
				'key'   => 'field_tab_footer_copyright',
				'label' => 'Footer: Bản quyền',
				'type'  => 'tab',
			),
			array(
				'key'          => 'field_footer_copyright',
				'label'        => 'Dòng bản quyền',
				'name'         => 'footer_copyright',
				'type'         => 'wysiwyg',
				'tabs'         => 'all',
				'toolbar'      => 'basic',
				'media_upload' => 0,
				'instructions' => 'Cho phép chèn liên kết. Để trống sẽ dùng nội dung mặc định.',
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
