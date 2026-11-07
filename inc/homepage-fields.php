<?php
/**
 * Đăng ký ACF Field Group cho Trang chủ (Post ID: 7, 359)
 *
 * @package HomeNest Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'acf/init', 'mbland_register_homepage_acf_fields' );
function mbland_register_homepage_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'                   => 'group_homepage_settings',
		'title'                 => 'Cài đặt nội dung Trang chủ',
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'active'                => true,
		'location'              => array(
			// Áp dụng cho Post ID = 7 HOẶC Post ID = 359
			array(
				array(
					'param'    => 'post',
					'operator' => '==',
					'value'    => '7',
				),
			),
			array(
				array(
					'param'    => 'post',
					'operator' => '==',
					'value'    => '359',
				),
			),
		),
		'fields'                => array(

			// ==========================================
			// TAB 1: HERO (ABOUT)
			// ==========================================
			array(
				'key'   => 'field_tab_home_hero',
				'label' => 'Hero (About)',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_home_hero',
				'label'      => 'Hero Section',
				'name'       => 'home_hero',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_home_hero_seo_h1',
						'label'         => 'H1 SEO (Ẩn)',
						'name'          => 'seo_h1',
						'type'          => 'text',
						'default_value' => 'TASMANIA & PARTNERS',
					),
					array(
						'key'           => 'field_home_hero_title_first',
						'label'         => 'Tiêu đề dòng 1',
						'name'          => 'title_first',
						'type'          => 'text',
						'default_value' => 'MBLAND',
					),
					array(
						'key'           => 'field_home_hero_title_second',
						'label'         => 'Tiêu đề dòng 2',
						'name'          => 'title_second',
						'type'          => 'text',
						'default_value' => 'ASSET MANAGEMENT',
					),
					array(
						'key'           => 'field_home_hero_cta',
						'label'         => 'Nút CTA',
						'name'          => 'cta',
						'type'          => 'link',
						'return_format' => 'array',
					),
					array(
						'key'           => 'field_home_hero_quote_icon',
						'label'         => 'Icon trích dẫn',
						'name'          => 'quote_icon',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'thumbnail',
					),
					array(
						'key'           => 'field_home_hero_slogan',
						'label'         => 'Slogan',
						'name'          => 'slogan',
						'type'          => 'text',
						'default_value' => 'Công - Tâm - Trí - Tín',
					),
					array(
						'key'           => 'field_home_hero_desc',
						'label'         => 'Nội dung mô tả',
						'name'          => 'description',
						'type'          => 'textarea',
						'rows'          => 3,
						'default_value' => 'Chúng tôi đang dần tạo nên một nền tảng vững chắc để hoàn thành Sứ mệnh: Cam kết những sản phẩm tốt nhất, đặc sắc nhất; là đối tác tin cậy và phát triển bền vững; Là doanh nghiệp có Trách nhiệm.',
					),
					array(
						'key'           => 'field_home_hero_scroll_image',
						'label'         => 'Ảnh Scroll To Explore',
						'name'          => 'scroll_image',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'thumbnail',
					),
					array(
						'key'           => 'field_home_hero_banner',
						'label'         => 'Ảnh Banner Hero chính',
						'name'          => 'banner',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'medium',
					),
				),
			),

			// ==========================================
			// TAB 2: THÔNG TIN & THỐNG KÊ (INFO)
			// ==========================================
			array(
				'key'   => 'field_tab_home_info',
				'label' => 'Thống kê & Giới thiệu',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_home_info',
				'label'      => 'Info Section',
				'name'       => 'home_info',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_home_info_marquee_text',
						'label'         => 'Chữ chạy (Marquee)',
						'name'          => 'marquee_text',
						'type'          => 'text',
						'default_value' => 'MBLAND ASSET MANAGEMENT',
					),
					array(
						'key'           => 'field_home_info_marquee_repeat',
						'label'         => 'Số lần lặp Marquee',
						'name'          => 'marquee_repeat',
						'type'          => 'number',
						'default_value' => 4,
						'min'           => 1,
						'max'           => 10,
					),
					array(
						'key'           => 'field_home_info_stat_number',
						'label'         => 'Con số thống kê',
						'name'          => 'stat_number',
						'type'          => 'text',
						'default_value' => '10',
					),
					array(
						'key'           => 'field_home_info_stat_plus',
						'label'         => 'Ký hiệu đính kèm',
						'name'          => 'stat_plus',
						'type'          => 'text',
						'default_value' => '+',
					),
					array(
						'key'           => 'field_home_info_stat_unit',
						'label'         => 'Đơn vị tính',
						'name'          => 'stat_unit',
						'type'          => 'text',
						'default_value' => 'Năm',
					),
					array(
						'key'           => 'field_home_info_stat_label',
						'label'         => 'Nhãn thống kê',
						'name'          => 'stat_label',
						'type'          => 'text',
						'default_value' => 'Hành Trình',
					),
					array(
						'key'           => 'field_home_info_stat_year',
						'label'         => 'Năm thành lập / Mốc',
						'name'          => 'stat_year',
						'type'          => 'text',
						'default_value' => '2015',
					),
					array(
						'key'           => 'field_home_info_desc',
						'label'         => 'Đoạn văn mô tả',
						'name'          => 'description',
						'type'          => 'textarea',
						'rows'          => 4,
					),
					array(
						'key'           => 'field_home_info_cta_primary',
						'label'         => 'Nút chính (Khám phá về chúng tôi)',
						'name'          => 'cta_primary',
						'type'          => 'link',
						'return_format' => 'array',
					),
					array(
						'key'           => 'field_home_info_cta_secondary',
						'label'         => 'Nút phụ (Lĩnh vực hoạt động)',
						'name'          => 'cta_secondary',
						'type'          => 'link',
						'return_format' => 'array',
					),
				),
			),

			// ==========================================
			// TAB 3: GIỚI THIỆU CÔNG TY (COMPANY)
			// ==========================================
			array(
				'key'   => 'field_tab_home_company',
				'label' => 'Giới thiệu công ty',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_home_company',
				'label'      => 'Company Section',
				'name'       => 'home_company',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_home_company_intro_image',
						'label'         => 'Ảnh giới thiệu',
						'name'          => 'intro_image',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'medium',
					),
					array(
						'key'           => 'field_home_company_title',
						'label'         => 'Tiêu đề',
						'name'          => 'title',
						'type'          => 'text',
						'default_value' => 'Giới thiệu về công ty chúng tôi',
					),
					array(
						'key'           => 'field_home_company_brand_prefix',
						'label'         => 'Tiền tố thương hiệu',
						'name'          => 'brand_prefix',
						'type'          => 'text',
						'default_value' => 'Công ty Cổ Phần TẬP ĐOÀN',
					),
					array(
						'key'           => 'field_home_company_brand_logo',
						'label'         => 'Logo thương hiệu',
						'name'          => 'brand_logo',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'thumbnail',
					),
					array(
						'key'           => 'field_home_company_desc',
						'label'         => 'Mô tả chi tiết',
						'name'          => 'description',
						'type'          => 'textarea',
						'rows'          => 4,
					),
					array(
						'key'           => 'field_home_company_showcase_image',
						'label'         => 'Ảnh showcase lớn',
						'name'          => 'showcase_image',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'medium',
					),
				),
			),

			// ==========================================
			// TAB 4: LĨNH VỰC HOẠT ĐỘNG (BRANCHES)
			// ==========================================
			array(
				'key'   => 'field_tab_home_branches',
				'label' => 'Lĩnh vực hoạt động',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_home_branches',
				'label'      => 'Branches Section',
				'name'       => 'home_branches',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_home_branches_title',
						'label'         => 'Tiêu đề',
						'name'          => 'title',
						'type'          => 'text',
						'default_value' => 'Lĩnh vực hoạt động',
					),
					array(
						'key'           => 'field_home_branches_desc',
						'label'         => 'Mô tả',
						'name'          => 'description',
						'type'          => 'textarea',
						'rows'          => 3,
					),
					array(
						'key'           => 'field_home_branches_cta',
						'label'         => 'Nút CTA',
						'name'          => 'cta',
						'type'          => 'link',
						'return_format' => 'array',
					),
					array(
						'key'           => 'field_home_branches_card_label',
						'label'         => 'Nhãn phụ trên thẻ',
						'name'          => 'card_label',
						'type'          => 'text',
						'default_value' => 'Lĩnh vực hoạt động',
					),
					array(
						'key'           => 'field_home_branches_terms',
						'label'         => 'Chọn danh sách Lĩnh vực',
						'name'          => 'terms',
						'type'          => 'taxonomy',
						'taxonomy'      => 'linh-vuc',
						'field_type'    => 'multi_select',
						'allow_null'    => 1,
						'add_term'      => 0,
						'save_terms'    => 0,
						'load_terms'    => 0,
						'return_format' => 'object',
						'instructions'  => 'Thứ tự chọn các lĩnh vực sẽ quyết định thứ tự hiển thị ra ngoài giao diện.',
					),
					array(
						'key'           => 'field_home_branches_placeholder',
						'label'         => 'Ảnh thay thế (Fallback)',
						'name'          => 'placeholder_image',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'thumbnail',
					),
				),
			),

			// ==========================================
			// TAB 5: DỰ ÁN NỔI BẬT (PROJECTS)
			// ==========================================
			array(
				'key'   => 'field_tab_home_projects',
				'label' => 'Dự án nổi bật',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_home_projects',
				'label'      => 'Projects Section',
				'name'       => 'home_projects',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_home_projects_title',
						'label'         => 'Tiêu đề',
						'name'          => 'title',
						'type'          => 'text',
						'default_value' => 'Dự án nổi bật',
					),
					array(
						'key'           => 'field_home_projects_desc',
						'label'         => 'Mô tả',
						'name'          => 'description',
						'type'          => 'textarea',
						'rows'          => 3,
					),
					array(
						'key'           => 'field_home_projects_cta',
						'label'         => 'Nút CTA (Xem thêm dự án)',
						'name'          => 'cta',
						'type'          => 'link',
						'return_format' => 'array',
					),
					array(
						'key'           => 'field_home_projects_source',
						'label'         => 'Cách lấy dữ liệu dự án',
						'name'          => 'source',
						'type'          => 'button_group',
						'choices'       => array(
                            'auto'   => 'Tự động (Taxonomy dự án nổi bật)',
							'manual' => 'Chọn thủ công',
						),
						'default_value' => 'auto',
					),
					array(
						'key'               => 'field_home_projects_items',
						'label'             => 'Chọn danh sách dự án',
						'name'              => 'projects',
						'type'              => 'relationship',
						'post_type'         => array( 'du-an' ),
						'max'               => 6,
						'return_format'     => 'object',
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_home_projects_source',
									'operator' => '==',
									'value'    => 'manual',
								),
							),
						),
					),
					array(
						'key'               => 'field_home_projects_limit',
						'label'             => 'Số lượng dự án lấy tự động',
						'name'              => 'limit',
						'type'              => 'number',
						'default_value'     => 6,
						'min'               => 1,
						'max'               => 12,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_home_projects_source',
									'operator' => '==',
									'value'    => 'auto',
								),
							),
						),
					),
				),
			),

			// ==========================================
			// TAB 6: HOẠT ĐỘNG & SỰ KIỆN (ACTIVITIES)
			// ==========================================
			array(
				'key'   => 'field_tab_home_activities',
				'label' => 'Hoạt động & Sự kiện',
				'type'  => 'tab',
			),
			array(
				'key'        => 'field_group_home_activities',
				'label'      => 'Activities Section',
				'name'       => 'home_activities',
				'type'       => 'group',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_home_activities_title',
						'label'         => 'Tiêu đề',
						'name'          => 'title',
						'type'          => 'text',
						'default_value' => 'Hoạt động & Sự kiện',
					),
					array(
						'key'           => 'field_home_activities_desc',
						'label'         => 'Mô tả',
						'name'          => 'description',
						'type'          => 'textarea',
						'rows'          => 3,
					),
					array(
						'key'           => 'field_home_activities_cta',
						'label'         => 'Nút CTA (Tất cả bài viết)',
						'name'          => 'cta',
						'type'          => 'link',
						'return_format' => 'array',
					),
					array(
						'key'           => 'field_home_activities_source',
						'label'         => 'Cách lấy tin tức',
						'name'          => 'source',
						'type'          => 'button_group',
						'choices'       => array(
                            'auto'   => 'Tự động (Tin nổi bật)',
							'manual' => 'Chọn thủ công',
						),
						'default_value' => 'auto',
					),
					array(
						'key'               => 'field_home_activities_items',
						'label'             => 'Chọn bài viết',
						'name'              => 'posts',
						'type'              => 'relationship',
						'post_type'         => array( 'post' ),
						'max'               => 6,
						'return_format'     => 'object',
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_home_activities_source',
									'operator' => '==',
									'value'    => 'manual',
								),
							),
						),
					),
					array(
						'key'               => 'field_home_activities_limit',
						'label'             => 'Số lượng bài lấy tự động',
						'name'              => 'limit',
						'type'              => 'number',
						'default_value'     => 6,
						'min'               => 1,
						'max'               => 12,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_home_activities_source',
									'operator' => '==',
									'value'    => 'auto',
								),
							),
						),
					),
				),
			),
		),
	) );
}

