<?php
/**
 * Tính năng sắp xếp (Reorder) cho Taxonomy: Lĩnh Vực (linh-vuc)
 * Hỗ trợ kéo thả chuột (Drag & Drop) trực tiếp trong WP-Admin, nhập thứ tự thủ công, và tự động áp dụng khi query frontend.
 *
 * @package HomeNest Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class MBLand_Taxonomy_Order {

	/**
	 * Danh sách các taxonomy áp dụng tính năng sắp xếp
	 *
	 * @var array
	 */
	private static $taxonomies = array( 'linh-vuc' );

	/**
	 * Khởi tạo hooks
	 */
	public static function init() {
		// 1. Thêm cột thứ tự trong danh sách term
		foreach ( self::$taxonomies as $taxonomy ) {
			add_filter( "manage_edit-{$taxonomy}_columns", array( __CLASS__, 'add_order_column' ) );
			add_filter( "manage_{$taxonomy}_custom_column", array( __CLASS__, 'render_order_column' ), 10, 3 );
			add_filter( "manage_edit-{$taxonomy}_sortable_columns", array( __CLASS__, 'sortable_order_column' ) );

			// 2. Thêm trường nhập thứ tự trong Form Add / Edit
			add_action( "{$taxonomy}_add_form_fields", array( __CLASS__, 'add_order_field' ) );
			add_action( "{$taxonomy}_edit_form_fields", array( __CLASS__, 'edit_order_field' ), 10, 2 );

			// 3. Lưu giá trị thứ tự khi tạo / sửa term
			add_action( "created_{$taxonomy}", array( __CLASS__, 'save_order_field' ) );
			add_action( "edited_{$taxonomy}", array( __CLASS__, 'save_order_field' ) );
		}

		// 4. Quick edit
		add_action( 'quick_edit_custom_box', array( __CLASS__, 'quick_edit_order_field' ), 10, 3 );

		// 5. Enqueue script kéo thả trong trang quản trị
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_assets' ) );

		// 6. Xử lý AJAX kéo thả lưu thứ tự
		add_action( 'wp_ajax_mbland_save_taxonomy_order', array( __CLASS__, 'ajax_save_order' ) );

		// 7. Can thiệp query get_terms() tự động theo thứ tự
		add_filter( 'terms_clauses', array( __CLASS__, 'apply_terms_order_clauses' ), 10, 3 );
	}

	/**
	 * Kiểm tra trang hiện tại có thuộc taxonomy được hỗ trợ không
	 */
	private static function is_target_screen() {
		$screen = get_current_screen();
		if ( ! $screen ) {
			return false;
		}
		return ( 'edit-tags' === $screen->base || 'term' === $screen->base ) && in_array( $screen->taxonomy, self::$taxonomies, true );
	}

	/**
	 * 1. Thêm cột Thứ tự vào bảng term
	 */
	public static function add_order_column( $columns ) {
		$new_columns = array();
		foreach ( $columns as $key => $title ) {
			if ( 'posts' === $key ) {
				$new_columns['term_order'] = __( 'Thứ tự', 'homenest' );
			}
			$new_columns[ $key ] = $title;
		}
		if ( ! isset( $new_columns['term_order'] ) ) {
			$new_columns['term_order'] = __( 'Thứ tự', 'homenest' );
		}
		return $new_columns;
	}

	/**
	 * Hiển thị giá trị cột Thứ tự
	 */
	public static function render_order_column( $content, $column_name, $term_id ) {
		if ( 'term_order' === $column_name ) {
			$order = get_term_meta( $term_id, 'term_order', true );
			$order = ( '' !== $order && false !== $order ) ? (int) $order : 0;

			return sprintf(
				'<div class="mbland-order-cell" data-order="%1$d">
					<span class="mbland-drag-handle dashicons dashicons-menu" title="Kéo thả để sắp xếp"></span>
					<span class="mbland-order-number">%1$d</span>
				</div>',
				$order
			);
		}
		return $content;
	}

	/**
	 * Cho phép click sắp xếp theo cột Thứ tự
	 */
	public static function sortable_order_column( $columns ) {
		$columns['term_order'] = 'term_order';
		return $columns;
	}

	/**
	 * 2. Trường Thứ tự trong form Thêm mới term
	 */
	public static function add_order_field( $taxonomy ) {
		?>
		<div class="form-field term-order-wrap">
			<label for="term_order"><?php esc_html_e( 'Thứ tự sắp xếp', 'homenest' ); ?></label>
			<input type="number" name="term_order" id="term_order" value="0" min="0" step="1" style="max-width:120px;">
			<p class="description"><?php esc_html_e( 'Nhập số thứ tự (số nhỏ hiển thị trước), hoặc bạn có thể kéo thả trực tiếp trong bảng danh sách bên phải.', 'homenest' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Trường Thứ tự trong form Sửa term
	 */
	public static function edit_order_field( $term, $taxonomy ) {
		$order = get_term_meta( $term->term_id, 'term_order', true );
		$order = ( '' !== $order && false !== $order ) ? (int) $order : 0;
		?>
		<tr class="form-field term-order-wrap">
			<th scope="row"><label for="term_order"><?php esc_html_e( 'Thứ tự sắp xếp', 'homenest' ); ?></label></th>
			<td>
				<input type="number" name="term_order" id="term_order" value="<?php echo esc_attr( $order ); ?>" min="0" step="1" style="max-width:120px;">
				<p class="description"><?php esc_html_e( 'Nhập số thứ tự hiển thị (số nhỏ hiển thị trước) hoặc kéo thả trực tiếp trong bảng danh sách.', 'homenest' ); ?></p>
			</td>
		</tr>
		<?php
	}

	/**
	 * 3. Lưu giá trị Thứ tự
	 */
	public static function save_order_field( $term_id ) {
		if ( isset( $_POST['term_order'] ) ) {
			$order = intval( $_POST['term_order'] );
			update_term_meta( $term_id, 'term_order', $order );
		}
	}

	/**
	 * 4. Quick Edit
	 */
	public static function quick_edit_order_field( $column_name, $screen, $name ) {
		if ( 'term_order' !== $column_name || ! in_array( $name, self::$taxonomies, true ) ) {
			return;
		}
		?>
		<fieldset>
			<div class="inline-edit-col">
				<label>
					<span class="title"><?php esc_html_e( 'Thứ tự', 'homenest' ); ?></span>
					<span class="input-text-wrap">
						<input type="number" name="term_order" class="term_order" value="0" min="0" step="1" style="max-width:100px;">
					</span>
				</label>
			</div>
		</fieldset>
		<?php
	}

	/**
	 * 5. Tải assets (jQuery UI Sortable + CSS + JS kéo thả)
	 */
	public static function enqueue_admin_assets( $hook_suffix ) {
		if ( ! self::is_target_screen() ) {
			return;
		}

		wp_enqueue_script( 'jquery-ui-sortable' );

		// Inline CSS cho giao diện kéo thả
		$custom_css = '
			.column-term_order { width: 90px; text-align: center; }
			.mbland-order-cell { display: inline-flex; align-items: center; gap: 6px; }
			.mbland-drag-handle { color: #8c8f94; cursor: grab; font-size: 18px; line-height: 1; transition: color 0.15s ease; }
			.mbland-drag-handle:hover, tr:hover .mbland-drag-handle { color: #2271b1; }
			#the-list tr.ui-sortable-helper {
				background: #f0f6fc !important;
				border: 1px solid #72aee6 !important;
				box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
				display: table-row !important;
			}
			#the-list tr.ui-sortable-placeholder {
				background: #fbf0b5 !important;
				border: 1px dashed #cca20c !important;
				visibility: visible !important;
				height: 45px !important;
			}
			.mbland-toast-notice {
				position: fixed;
				bottom: 24px;
				right: 24px;
				background: #008a20;
				color: #fff;
				padding: 10px 18px;
				border-radius: 6px;
				font-size: 13px;
				font-weight: 500;
				box-shadow: 0 4px 12px rgba(0,0,0,0.2);
				z-index: 999999;
				display: flex;
				align-items: center;
				gap: 8px;
				opacity: 0;
				transform: translateY(10px);
				transition: all 0.25s ease;
				pointer-events: none;
			}
			.mbland-toast-notice.show {
				opacity: 1;
				transform: translateY(0);
			}
			.mbland-toast-notice.error {
				background: #d63638;
			}
		';
		wp_add_inline_style( 'common', $custom_css );

		// Inline JS xử lý kéo thả và gửi AJAX
		$nonce = wp_create_nonce( 'mbland_tax_order_nonce' );
		$screen = get_current_screen();
		$taxonomy = $screen->taxonomy;

		$custom_js = "
			jQuery(document).ready(function($) {
				var \$tbody = $('#the-list');
				if (!\$tbody.length) return;

				// Toast element
				var \$toast = $('<div class=\"mbland-toast-notice\"><span class=\"dashicons dashicons-yes-alt\"></span><span class=\"msg\"></span></div>').appendTo('body');

				function showToast(msg, isError) {
					\$toast.removeClass('error');
					if (isError) \$toast.addClass('error');
					\$toast.find('.msg').text(msg);
					\$toast.addClass('show');
					setTimeout(function() {
						\$toast.removeClass('show');
					}, 2200);
				}

				// Kích hoạt jQuery UI sortable
				\$tbody.sortable({
					items: 'tr',
					handle: '.mbland-drag-handle',
					cursor: 'grabbing',
					axis: 'y',
					containment: 'table.wp-list-table',
					distance: 4,
					opacity: 0.85,
					placeholder: 'ui-sortable-placeholder',
					helper: function(e, ui) {
						ui.children().each(function() {
							$(this).width($(this).width());
						});
						return ui;
					},
					stop: function(event, ui) {
						var order = [];
						\$tbody.find('tr').each(function(index) {
							var id = $(this).attr('id');
							if (id) {
								var termId = id.replace('tag-', '');
								order.push(termId);
								// Cập nhật số thứ tự hiển thị trực quan ngay lập tức
								$(this).find('.mbland-order-number').text(index + 1);
							}
						});

						if (!order.length) return;

						// Gửi AJAX lưu
						$.ajax({
							url: ajaxurl,
							type: 'POST',
							dataType: 'json',
							data: {
								action: 'mbland_save_taxonomy_order',
								nonce: '{$nonce}',
								taxonomy: '{$taxonomy}',
								order: order
							},
							success: function(response) {
								if (response && response.success) {
									showToast('Đã lưu thứ tự mới thành công!');
								} else {
									showToast(response.data || 'Lỗi khi lưu thứ tự.', true);
								}
							},
							error: function() {
								showToast('Lỗi kết nối máy chủ.', true);
							}
						});
					}
				});

				// Đồng bộ Quick Edit
				$('#the-list').on('click', '.editinline', function() {
					var \$tr = $(this).closest('tr');
					var orderVal = \$tr.find('.mbland-order-number').text().trim();
					setTimeout(function() {
						$('tr.inline-edit-row input.term_order').val(orderVal);
					}, 20);
				});
			});
		";
		wp_add_inline_script( 'jquery-ui-sortable', $custom_js );
	}

	/**
	 * 6. Xử lý AJAX lưu thứ tự
	 */
	public static function ajax_save_order() {
		check_ajax_referer( 'mbland_tax_order_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_categories' ) && ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_error( 'Bạn không có quyền thực hiện thao tác này.' );
		}

		$taxonomy = isset( $_POST['taxonomy'] ) ? sanitize_key( $_POST['taxonomy'] ) : '';
		if ( ! in_array( $taxonomy, self::$taxonomies, true ) ) {
			wp_send_json_error( 'Taxonomy không hợp lệ.' );
		}

		$order = isset( $_POST['order'] ) && is_array( $_POST['order'] ) ? array_map( 'intval', $_POST['order'] ) : array();
		if ( empty( $order ) ) {
			wp_send_json_error( 'Danh sách thứ tự rỗng.' );
		}

		// Lưu thứ tự (bắt đầu từ 1)
		foreach ( $order as $index => $term_id ) {
			if ( $term_id > 0 ) {
				update_term_meta( $term_id, 'term_order', $index + 1 );
			}
		}

		// Xóa cache terms để frontend nhận ngay lập tức
		clean_term_cache( $order, $taxonomy );

		wp_send_json_success( array( 'count' => count( $order ) ) );
	}

	/**
	 * 7. Can thiệp query get_terms() tự động sắp xếp theo term_order
	 */
	public static function apply_terms_order_clauses( $clauses, $taxonomies, $args ) {
		global $wpdb;

		// Kiểm tra có chứa taxonomy được hỗ trợ không
		$intersect = array_intersect( (array) $taxonomies, self::$taxonomies );
		if ( empty( $intersect ) ) {
			return $clauses;
		}

		// Trong WP-Admin: Nếu người dùng click sort thủ công theo một cột khác (ví dụ: posts, name, slug)
		if ( is_admin() && ! empty( $_GET['orderby'] ) && 'term_order' !== $_GET['orderby'] ) {
			return $clauses;
		}

		// Nếu query yêu cầu explicitly orderby đặc biệt (như 'include', 'term_id', 'slug')
		if ( isset( $args['orderby'] ) && in_array( $args['orderby'], array( 'include', 'term_id', 'slug' ), true ) ) {
			return $clauses;
		}

		// Xác định hướng sắp xếp (mặc định ASC)
		$direction = 'ASC';
		if ( is_admin() && isset( $_GET['order'] ) && 'DESC' === strtoupper( $_GET['order'] ) ) {
			$direction = 'DESC';
		}

		// Nối bảng wp_termmeta để lấy term_order
		$clauses['join']   .= " LEFT JOIN {$wpdb->termmeta} AS tm_order ON (t.term_id = tm_order.term_id AND tm_order.meta_key = 'term_order')";
		$clauses['orderby'] = "ORDER BY CAST(COALESCE(tm_order.meta_value, 999999) AS UNSIGNED) {$direction}, t.term_id {$direction}";

		return $clauses;
	}
}

// Khởi động
add_action( 'init', array( 'MBLand_Taxonomy_Order', 'init' ) );

