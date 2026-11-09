<?php
/**
 * Đăng ký ACF Field Group cho Trang Tuyển Dụng (Post ID: 64, 405)
 *
 * @package HomeNest Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'acf/init', 'mbland_register_recruitment_acf_fields' );
function mbland_register_recruitment_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'                   => 'group_recruitment_settings',
		'title'                 => 'Cài đặt nội dung Trang Tuyển Dụng',
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'active'                => true,
		'location'              => array(
			// Áp dụng cho Post ID = 64 (VN) HOẶC Post ID = 405 (EN)
			array(
				array(
					'param'    => 'post',
					'operator' => '==',
					'value'    => '64',
				),
			),
			array(
				array(
					'param'    => 'post',
					'operator' => '==',
					'value'    => '405',
				),
			),
		),
		'fields'                => array(

			// ==========================================
			// TAB 1: GIỚI THIỆU & BANNER (INTRO)
			// ==========================================
			array(
				'key'   => 'field_tab_recruitment_intro',
				'label' => 'Giới thiệu & Banner',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_recruitment_intro',
				'label'      => 'Intro Section',
				'name'       => 'recruitment_intro',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_recruitment_intro_title',
						'label'         => 'Tiêu đề chính',
						'name'          => 'title',
						'type'          => 'text',
						'default_value' => 'MBLand Asset Management',
					),
					array(
						'key'          => 'field_recruitment_intro_content',
						'label'        => 'Nội dung giới thiệu',
						'name'         => 'content',
						'type'         => 'wysiwyg',
						'tabs'         => 'all',
						'toolbar'      => 'basic',
						'media_upload' => 0,
					),
					array(
						'key'           => 'field_recruitment_intro_banner',
						'label'         => 'Ảnh Banner tuyển dụng',
						'name'          => 'banner',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'medium',
					),
				),
			),

			// ==========================================
			// TAB 2: CƠ HỘI VIỆC LÀM (JOBS)
			// ==========================================
			array(
				'key'   => 'field_tab_recruitment_jobs',
				'label' => 'Cơ hội việc làm',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_recruitment_jobs',
				'label'      => 'Jobs Section',
				'name'       => 'recruitment_jobs',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_recruitment_jobs_title',
						'label'         => 'Tiêu đề khu vực việc làm',
						'name'          => 'title',
						'type'          => 'text',
						'default_value' => 'Cơ hội việc làm',
					),
					array(
						'key'           => 'field_recruitment_jobs_desc',
						'label'         => 'Đoạn mô tả',
						'name'          => 'desc',
						'type'          => 'textarea',
						'rows'          => 2,
						'default_value' => 'Cơ hội việc làm tại môi trường chuyên nghiệp trong và ngoài nước thuộc lĩnh vực Tài chính – Bất động sản – Du lịch Dịch vụ',
					),
					array(
						'key'           => 'field_recruitment_jobs_search_title',
						'label'         => 'Tiêu đề ô tìm kiếm',
						'name'          => 'search_title',
						'type'          => 'text',
						'default_value' => 'Tìm công việc',
					),
					array(
						'key'           => 'field_recruitment_jobs_search_placeholder',
						'label'         => 'Placeholder ô tìm kiếm',
						'name'          => 'search_placeholder',
						'type'          => 'text',
						'default_value' => 'Nhập từ khóa tìm kiếm',
					),
					array(
						'key'           => 'field_recruitment_jobs_search_btn_text',
						'label'         => 'Chữ trên nút tìm kiếm',
						'name'          => 'search_btn_text',
						'type'          => 'text',
						'default_value' => 'Tìm kiếm',
					),
					array(
						'key'           => 'field_recruitment_jobs_filter_title',
						'label'         => 'Tiêu đề khối bộ lọc',
						'name'          => 'filter_title',
						'type'          => 'text',
						'default_value' => 'Bộ lọc',
					),
					array(
						'key'           => 'field_recruitment_jobs_filter_reset_text',
						'label'         => 'Chữ trên nút xóa bộ lọc',
						'name'          => 'filter_reset_text',
						'type'          => 'text',
						'default_value' => 'Xóa bộ lọc',
					),
					array(
						'key'           => 'field_recruitment_jobs_per_page',
						'label'         => 'Số lượng công việc mỗi trang',
						'name'          => 'posts_per_page',
						'type'          => 'number',
						'default_value' => 6,
						'min'           => 1,
						'max'           => 24,
					),
					array(
						'key'           => 'field_recruitment_jobs_empty_text',
						'label'         => 'Thông báo khi không có việc làm phù hợp',
						'name'          => 'empty_text',
						'type'          => 'text',
						'default_value' => 'Không tìm thấy vị trí tuyển dụng phù hợp.',
					),
				),
			),

			// ==========================================
			// TAB 3: TIN TỨC LIÊN QUAN (NEWS)
			// ==========================================
			array(
				'key'   => 'field_tab_recruitment_news',
				'label' => 'Tin tức liên quan',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_recruitment_news',
				'label'      => 'News Section',
				'name'       => 'recruitment_news',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_recruitment_news_title',
						'label'         => 'Tiêu đề tin tức liên quan',
						'name'          => 'title',
						'type'          => 'text',
						'default_value' => 'Tin tức liên quan',
					),
					array(
						'key'           => 'field_recruitment_news_badge',
						'label'         => 'Nhãn huy hiệu (Badge)',
						'name'          => 'badge',
						'type'          => 'text',
						'default_value' => 'TIN NỔI BẬT',
					),
					array(
						'key'           => 'field_recruitment_news_per_page',
						'label'         => 'Số lượng bài viết',
						'name'          => 'posts_per_page',
						'type'          => 'number',
						'default_value' => 2,
						'min'           => 1,
						'max'           => 6,
					),
				),
			),
		),
	) );
}

