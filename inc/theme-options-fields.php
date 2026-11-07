<?php
/**
 * Đăng ký ACF Options Page & Field Group cho Cài đặt chung: Đối tác (Brands) & Form liên hệ (Contact Form)
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
				'key'           => 'field_options_brands_title',
				'label'         => 'Tiêu đề Section Đối tác',
				'name'          => 'brands_title',
				'type'          => 'text',
				'default_value' => 'Các đối tác của chúng tôi',
			),
			array(
				'key'           => 'field_options_brands_desc',
				'label'         => 'Mô tả Section Đối tác',
				'name'          => 'brands_desc',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'Chúng tôi trân trọng xây dựng những mối quan hệ hợp tác chiến lược, cùng kết nối nguồn lực, phát huy thế mạnh và hướng đến những giá trị phát triển bền vững.',
			),
			array(
				'key'          => 'field_options_brands_list',
				'label'        => 'Danh sách Logo Đối tác',
				'name'         => 'brands_list',
				'type'         => 'repeater',
				'instructions' => 'Thêm các logo đối tác để hiển thị trên dải chạy ngang. Nếu để trống, hệ thống sẽ sử dụng danh sách logo mặc định.',
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
						'key'           => 'field_options_brand_name',
						'label'         => 'Tên đối tác (Alt text)',
						'name'          => 'name',
						'type'          => 'text',
						'placeholder'   => 'VD: Vietcombank, Savills...',
					),
					array(
						'key'           => 'field_options_brand_link',
						'label'         => 'Link website (Tùy chọn)',
						'name'          => 'link',
						'type'          => 'url',
						'placeholder'   => 'https://...',
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
				'key'           => 'field_options_contact_title',
				'label'         => 'Tiêu đề Form liên hệ',
				'name'          => 'contact_title',
				'type'          => 'text',
				'default_value' => 'Liên hệ gửi yêu cầu tư vấn',
			),
			array(
				'key'           => 'field_options_contact_desc',
				'label'         => 'Mô tả Form liên hệ',
				'name'          => 'contact_desc',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'Kết nối cùng MBLand Asset Management để khám phá những cơ hội hợp tác và giải pháp đầu tư phù hợp với mục tiêu của bạn.',
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
				'key'           => 'field_options_contact_action',
				'label'         => 'Form Action URL',
				'name'          => 'contact_action',
				'type'          => 'text',
				'default_value' => '#',
				'instructions'  => 'Đường dẫn nhận dữ liệu form (hoặc để # nếu xử lý bằng AJAX/Plugin khác).',
			),
		),
	) );
}

