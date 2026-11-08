<?php
/**
 * Đăng ký ACF Field Group cho Trang Giới thiệu (Post ID: 73, 377)
 *
 * @package HomeNest Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'acf/init', 'mbland_register_about_acf_fields' );
function mbland_register_about_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'                   => 'group_about_settings',
		'title'                 => 'Cài đặt nội dung Trang Giới thiệu',
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'active'                => true,
		'location'              => array(
			// Áp dụng cho Post ID = 73 (VN) HOẶC Post ID = 377 (EN)
			array(
				array(
					'param'    => 'post',
					'operator' => '==',
					'value'    => '73',
				),
			),
			array(
				array(
					'param'    => 'post',
					'operator' => '==',
					'value'    => '377',
				),
			),
		),
		'fields'                => array(

			// ==========================================
			// TAB 1: HERO
			// ==========================================
			array(
				'key'   => 'field_tab_about_hero',
				'label' => 'Hero Banner',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_about_hero',
				'label'      => 'Hero Section',
				'name'       => 'about_hero',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_about_hero_banner',
						'label'         => 'Ảnh Banner Hero',
						'name'          => 'banner',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'medium',
					),
				),
			),

			// ==========================================
			// TAB 2: TỔNG QUAN & GIÁ TRỊ CỐT LÕI
			// ==========================================
			array(
				'key'   => 'field_tab_about_overview',
				'label' => 'Tổng quan & Giá trị',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_about_overview',
				'label'      => 'Overview Section',
				'name'       => 'about_overview',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_about_overview_intro_title',
						'label'         => 'Tiêu đề giới thiệu',
						'name'          => 'intro_title',
						'type'          => 'text',
						'default_value' => 'MBLand Asset Management',
					),
					array(
						'key'           => 'field_about_overview_intro_content',
						'label'         => 'Nội dung giới thiệu',
						'name'          => 'intro_content',
						'type'          => 'wysiwyg',
						'tabs'          => 'all',
						'toolbar'       => 'basic',
						'media_upload'  => 0,
					),
					array(
						'key'          => 'field_about_overview_values',
						'label'        => 'Danh sách Giá trị cốt lõi',
						'name'         => 'values',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => 'Thêm giá trị',
						'sub_fields'   => array(
							array(
								'key'           => 'field_about_val_title',
								'label'         => 'Tên giá trị',
								'name'          => 'title',
								'type'          => 'text',
								'placeholder'   => 'Công',
							),
							array(
								'key'           => 'field_about_val_label',
								'label'         => 'Nhãn phụ',
								'name'          => 'label',
								'type'          => 'text',
								'default_value' => 'Giá trị cốt lõi',
							),
							array(
								'key'           => 'field_about_val_tag',
								'label'         => 'Tagline hover',
								'name'          => 'tagline',
								'type'          => 'text',
								'default_value' => 'Công - tâm - trí - tín',
							),
							array(
								'key'           => 'field_about_val_desc',
								'label'         => 'Mô tả khi hover',
								'name'          => 'description',
								'type'          => 'textarea',
								'rows'          => 2,
							),
							array(
								'key'           => 'field_about_val_icon',
								'label'         => 'Icon nền',
								'name'          => 'bg_icon',
								'type'          => 'image',
								'return_format' => 'array',
								'preview_size'  => 'thumbnail',
							),
						),
					),
				),
			),

			// ==========================================
			// TAB 3: THỐNG KÊ (INFO)
			// ==========================================
			array(
				'key'   => 'field_tab_about_info',
				'label' => 'Thống kê & Hành trình',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_about_info',
				'label'      => 'Info Section',
				'name'       => 'about_info',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_about_info_marquee_text',
						'label'         => 'Chữ chạy (Marquee)',
						'name'          => 'marquee_text',
						'type'          => 'text',
						'default_value' => 'MBLAND ASSET MANAGEMENT',
					),
					array(
						'key'           => 'field_about_info_marquee_repeat',
						'label'         => 'Số lần lặp Marquee',
						'name'          => 'marquee_repeat',
						'type'          => 'number',
						'default_value' => 4,
						'min'           => 1,
						'max'           => 10,
					),
					array(
						'key'           => 'field_about_info_stat_number',
						'label'         => 'Con số thống kê',
						'name'          => 'stat_number',
						'type'          => 'text',
						'default_value' => '10',
					),
					array(
						'key'           => 'field_about_info_stat_plus',
						'label'         => 'Ký hiệu (+)',
						'name'          => 'stat_plus',
						'type'          => 'text',
						'default_value' => '+',
					),
					array(
						'key'           => 'field_about_info_stat_unit',
						'label'         => 'Đơn vị tính',
						'name'          => 'stat_unit',
						'type'          => 'text',
						'default_value' => 'Năm',
					),
					array(
						'key'           => 'field_about_info_stat_label',
						'label'         => 'Nhãn thống kê',
						'name'          => 'stat_label',
						'type'          => 'text',
						'default_value' => 'Hành Trình',
					),
					array(
						'key'           => 'field_about_info_stat_year',
						'label'         => 'Năm thành lập / Mốc',
						'name'          => 'stat_year',
						'type'          => 'text',
						'default_value' => '2015',
					),
					array(
						'key'           => 'field_about_info_desc',
						'label'         => 'Đoạn văn mô tả',
						'name'          => 'description',
						'type'          => 'textarea',
						'rows'          => 4,
					),
				),
			),

			// ==========================================
			// TAB 4: MỤC TIÊU (GOALS)
			// ==========================================
			array(
				'key'   => 'field_tab_about_goals',
				'label' => 'Tầm nhìn & Sứ mệnh',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_about_goals',
				'label'      => 'Goals Section',
				'name'       => 'about_goals',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'          => 'field_about_goals_list',
						'label'        => 'Danh sách Mục tiêu',
						'name'         => 'goals',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => 'Thêm mục tiêu',
						'sub_fields'   => array(
							array(
								'key'           => 'field_about_goal_icon',
								'label'         => 'Icon',
								'name'          => 'icon',
								'type'          => 'image',
								'return_format' => 'array',
								'preview_size'  => 'thumbnail',
							),
							array(
								'key'   => 'field_about_goal_title',
								'label' => 'Tiêu đề',
								'name'  => 'title',
								'type'  => 'text',
							),
							array(
								'key'   => 'field_about_goal_content',
								'label' => 'Nội dung',
								'name'  => 'content',
								'type'  => 'textarea',
								'rows'  => 3,
							),
						),
					),
				),
			),

			// ==========================================
			// TAB 5: HỆ THỐNG CÔNG TY CON
			// ==========================================
			array(
				'key'   => 'field_tab_about_subsidiaries',
				'label' => 'Hệ thống Công ty con',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_about_subsidiaries',
				'label'      => 'Subsidiaries Section',
				'name'       => 'about_subsidiaries',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_about_sub_intro_image',
						'label'         => 'Ảnh đại diện bên trái',
						'name'          => 'intro_image',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'medium',
					),
					array(
						'key'           => 'field_about_sub_intro_title',
						'label'         => 'Tiêu đề khối',
						'name'          => 'intro_title',
						'type'          => 'text',
						'default_value' => 'Hệ thống Công ty con',
					),
					array(
						'key'          => 'field_about_sub_companies',
						'label'        => 'Danh sách Công ty con',
						'name'         => 'companies',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => 'Thêm công ty',
						'sub_fields'   => array(
							array(
								'key'           => 'field_about_sub_item_prefix',
								'label'         => 'Tiền tố thương hiệu',
								'name'          => 'brand_prefix',
								'type'          => 'text',
								'default_value' => 'CÔNG TY CỔ PHẦN TẬP ĐOÀN',
								'placeholder'   => 'CÔNG TY CỔ PHẦN TẬP ĐOÀN',
							),
							array(
								'key'           => 'field_about_sub_item_logo',
								'label'         => 'Logo thương hiệu',
								'name'          => 'brand_logo',
								'type'          => 'image',
								'return_format' => 'array',
								'preview_size'  => 'thumbnail',
							),
							array(
								'key'         => 'field_about_sub_item_desc',
								'label'       => 'Mô tả công ty',
								'name'        => 'description',
								'type'        => 'textarea',
								'rows'        => 4,
								'placeholder' => 'Nhập nội dung giới thiệu công ty...',
							),
						),
					),
				),
			),

			// ==========================================
			// TAB 6: ĐỘI NGŨ LÃNH ĐẠO
			// ==========================================
			array(
				'key'   => 'field_tab_about_team',
				'label' => 'Đội ngũ Lãnh đạo',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_about_team',
				'label'      => 'Team Section',
				'name'       => 'about_team',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_about_team_title',
						'label'         => 'Tiêu đề khu vực',
						'name'          => 'title',
						'type'          => 'text',
						'default_value' => 'Đội ngũ lãnh đạo',
					),
					array(
						'key'           => 'field_about_team_desc',
						'label'         => 'Mô tả ngắn',
						'name'          => 'desc',
						'type'          => 'textarea',
						'rows'          => 2,
						'default_value' => 'Tầm nhìn chiến lược, bản lĩnh lãnh đạo và kinh nghiệm chuyên sâu là nền tảng tạo nên những giá trị khác biệt của MBLand Asset Management',
					),
					array(
						'key'           => 'field_about_team_featured_position',
						'label'         => 'Lãnh đạo nổi bật - Chức vụ',
						'name'          => 'featured_position',
						'type'          => 'text',
						'default_value' => 'Chủ tịch hội đồng sáng lập',
					),
					array(
						'key'           => 'field_about_team_featured_name',
						'label'         => 'Lãnh đạo nổi bật - Họ tên',
						'name'          => 'featured_name',
						'type'          => 'text',
						'default_value' => 'Vũ Thành Huế',
					),
					array(
						'key'           => 'field_about_team_featured_image',
						'label'         => 'Lãnh đạo nổi bật - Ảnh chân dung',
						'name'          => 'featured_image',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'medium',
					),
					array(
						'key'          => 'field_about_team_featured_bio',
						'label'        => 'Lãnh đạo nổi bật - Tiểu sử / Thông điệp',
						'name'         => 'featured_bio',
						'type'         => 'wysiwyg',
						'tabs'         => 'all',
						'toolbar'      => 'full',
						'media_upload' => 0,
					),
					array(
						'key'          => 'field_about_team_members',
						'label'        => 'Danh sách Ban Lãnh đạo',
						'name'         => 'members',
						'type'         => 'repeater',
						'layout'       => 'block',
						'button_label' => 'Thêm thành viên',
						'sub_fields'   => array(
							array(
								'key'           => 'field_about_mem_image',
								'label'         => 'Ảnh chân dung',
								'name'          => 'image',
								'type'          => 'image',
								'return_format' => 'array',
								'preview_size'  => 'thumbnail',
							),
							array(
								'key'   => 'field_about_mem_name',
								'label' => 'Họ và tên',
								'name'  => 'name',
								'type'  => 'text',
							),
							array(
								'key'   => 'field_about_mem_position',
								'label' => 'Chức vụ',
								'name'  => 'position',
								'type'  => 'text',
							),
							array(
								'key'          => 'field_about_mem_timeline',
								'label'        => 'Lịch sử công tác (Timeline)',
								'name'         => 'timeline',
								'type'         => 'repeater',
								'layout'       => 'table',
								'button_label' => 'Thêm mốc',
								'sub_fields'   => array(
									array(
										'key'         => 'field_about_mem_time_year',
										'label'       => 'Mốc thời gian',
										'name'        => 'year',
										'type'        => 'text',
										'placeholder' => '2012-2018:',
									),
									array(
										'key'         => 'field_about_mem_time_role',
										'label'       => 'Vị trí đảm nhiệm',
										'name'        => 'role',
										'type'        => 'text',
									),
								),
							),
						),
					),
				),
			),
		),
	) );
}

