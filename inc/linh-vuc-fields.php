<?php
/**
 * Đăng ký ACF Field Group cho Taxonomy `linh-vuc` (trang chi tiết Lĩnh vực: taxonomy-linh-vuc.php).
 * Giá trị lưu theo từng term (mỗi ngôn ngữ Polylang có term riêng nên nhập riêng từng ngôn ngữ).
 * Nếu để trống, giao diện tự dùng nội dung mặc định.
 *
 * Các section:
 *  1. Danh sách dự án  : tiêu đề + mô tả
 *  2. Năng lực cốt lõi : tiêu đề + mô tả + repeater (tiêu đề, nhãn, tag hover, mô tả hover)
 *  3. Quy trình        : tiêu đề + mô tả + repeater (tag, tiêu đề, mô tả, thư viện ảnh)
 *
 * @package HomeNest Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'acf/init', 'mbland_register_linh_vuc_acf_fields' );
function mbland_register_linh_vuc_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'                   => 'group_linh_vuc_term',
		'title'                 => 'Nội dung trang Lĩnh vực',
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'active'                => true,
		'location'              => array(
			array(
				array(
					'param'    => 'taxonomy',
					'operator' => '==',
					'value'    => 'linh-vuc',
				),
			),
		),
		'fields'                => array(

			// ==========================================
			// TAB 1: DANH SÁCH DỰ ÁN
			// ==========================================
			array(
				'key'   => 'field_lv_tab_list',
				'label' => 'Danh sách dự án',
				'type'  => 'tab',
			),
			array(
				'key'         => 'field_lv_list_title',
				'label'       => 'Tiêu đề',
				'name'        => 'lv_list_title',
				'type'        => 'text',
				'placeholder' => 'Kiến tạo không gian - Nâng tầm bất động sản',
			),
			array(
				'key'         => 'field_lv_list_desc',
				'label'       => 'Mô tả',
				'name'        => 'lv_list_desc',
				'type'        => 'textarea',
				'rows'        => 4,
				'new_lines'   => '',
				'placeholder' => 'Phát triển đa dạng phân khúc bất động sản...',
			),

			// ==========================================
			// TAB 2: NĂNG LỰC CỐT LÕI
			// ==========================================
			array(
				'key'   => 'field_lv_tab_strengths',
				'label' => 'Năng lực cốt lõi',
				'type'  => 'tab',
			),
			array(
				'key'         => 'field_lv_strengths_title',
				'label'       => 'Tiêu đề',
				'name'        => 'lv_strengths_title',
				'type'        => 'text',
				'placeholder' => 'Khẳng định năng lực, kiến tạo dấu ấn',
			),
			array(
				'key'         => 'field_lv_strengths_desc',
				'label'       => 'Mô tả',
				'name'        => 'lv_strengths_desc',
				'type'        => 'textarea',
				'rows'        => 4,
				'new_lines'   => '',
				'placeholder' => 'Tầm nhìn chiến lược và định hướng đầu tư dài hạn...',
			),
			array(
				'key'          => 'field_lv_strengths_items',
				'label'        => 'Danh sách năng lực',
				'name'         => 'lv_strengths_items',
				'type'         => 'repeater',
				'instructions' => 'Mỗi mục là một thẻ. Nếu để trống sẽ dùng danh sách mặc định.',
				'layout'       => 'block',
				'button_label' => 'Thêm năng lực',
				'sub_fields'   => array(
					array(
						'key'     => 'field_lv_strength_title',
						'label'   => 'Tiêu đề (VD: Đa dạng phân khúc)',
						'name'    => 'title',
						'type'    => 'text',
						'wrapper' => array( 'width' => '50' ),
					),
					array(
						'key'     => 'field_lv_strength_label',
						'label'   => 'Nhãn nhỏ (VD: Mở rộng đầu tư)',
						'name'    => 'label',
						'type'    => 'text',
						'wrapper' => array( 'width' => '50' ),
					),
					array(
						'key'          => 'field_lv_strength_tag',
						'label'        => 'Tag khi hover (VD: Đô thị · Thương mại · Bất động sản)',
						'name'         => 'tag',
						'type'         => 'text',
						'wrapper'      => array( 'width' => '50' ),
					),
					array(
						'key'     => 'field_lv_strength_desc',
						'label'   => 'Mô tả khi hover',
						'name'    => 'desc',
						'type'    => 'text',
						'wrapper' => array( 'width' => '50' ),
					),
				),
			),

			// ==========================================
			// TAB 3: QUY TRÌNH
			// ==========================================
			array(
				'key'   => 'field_lv_tab_procedure',
				'label' => 'Quy trình phát triển',
				'type'  => 'tab',
			),
			array(
				'key'         => 'field_lv_procedure_title',
				'label'       => 'Tiêu đề',
				'name'        => 'lv_procedure_title',
				'type'        => 'text',
				'placeholder' => 'Quy trình phát triển khai dự án',
			),
			array(
				'key'         => 'field_lv_procedure_desc',
				'label'       => 'Mô tả',
				'name'        => 'lv_procedure_desc',
				'type'        => 'textarea',
				'rows'        => 3,
				'new_lines'   => '',
				'placeholder' => 'Mỗi dự án được triển khai theo quy trình bài bản...',
			),
			array(
				'key'          => 'field_lv_procedure_items',
				'label'        => 'Các bước quy trình',
				'name'         => 'lv_procedure_items',
				'type'         => 'repeater',
				'instructions' => 'Số thứ tự (01, 02...) tự động theo thứ tự các bước. Nếu để trống sẽ dùng quy trình mặc định.',
				'layout'       => 'block',
				'button_label' => 'Thêm bước',
				'sub_fields'   => array(
					array(
						'key'     => 'field_lv_procedure_item_tag',
						'label'   => 'Tag (VD: Research & Assessment)',
						'name'    => 'tag',
						'type'    => 'text',
						'wrapper' => array( 'width' => '50' ),
					),
					array(
						'key'     => 'field_lv_procedure_item_title',
						'label'   => 'Tiêu đề (VD: Nghiên cứu & Đánh giá)',
						'name'    => 'title',
						'type'    => 'text',
						'wrapper' => array( 'width' => '50' ),
					),
					array(
						'key'       => 'field_lv_procedure_item_desc',
						'label'     => 'Mô tả',
						'name'      => 'desc',
						'type'      => 'textarea',
						'rows'      => 3,
						'new_lines' => '',
					),
					array(
						'key'           => 'field_lv_procedure_item_images',
						'label'         => 'Hình ảnh (nên chọn 3 ảnh)',
						'name'          => 'images',
						'type'          => 'gallery',
						'return_format' => 'array',
						'preview_size'  => 'medium',
						'insert'        => 'append',
						'library'       => 'all',
						'min'           => 0,
						'max'           => 3,
					),
				),
			),
		),
	) );
}

