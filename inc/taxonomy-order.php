<?php
/**
 * Sắp xếp thứ tự term (kéo thả) cho taxonomy `linh-vuc`.
 *
 * - Admin: /wp-admin/edit-tags.php?taxonomy=linh-vuc&post_type=du-an  -> kéo thả hàng để đổi thứ tự (chỉ trong cùng cấp cha).
 * - Lưu thứ tự vào term meta `term_order` qua AJAX.
 * - Frontend/Admin: get_terms() cho `linh-vuc` mặc định (orderby=name, không chọn sắp xếp khác) sẽ được sắp theo `term_order`,
 *   term chưa có thứ tự xếp cuối theo tên.
 *
 * @package HomeNest Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'MBLAND_TERM_ORDER_TAXONOMY' ) ) {
	define( 'MBLAND_TERM_ORDER_TAXONOMY', 'linh-vuc' );
}

/**
 * 1. Áp dụng thứ tự term_order vào truy vấn get_terms().
 */
add_filter( 'terms_clauses', 'mbland_term_order_clauses', 10, 3 );
function mbland_term_order_clauses( $clauses, $taxonomies, $args ) {
	if ( array( MBLAND_TERM_ORDER_TAXONOMY ) !== array_values( (array) $taxonomies ) ) {
		return $clauses;
	}
	// Tôn trọng lựa chọn sắp xếp thủ công (click tiêu đề cột trong admin) hoặc orderby khác 'name'.
	if ( isset( $_GET['orderby'] ) || ( isset( $args['orderby'] ) && 'name' !== $args['orderby'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		return $clauses;
	}
	if ( false !== strpos( $clauses['join'], 'mbland_tmo' ) ) {
		return $clauses;
	}

	global $wpdb;
	$clauses['join']   .= " LEFT JOIN {$wpdb->termmeta} AS mbland_tmo ON ( mbland_tmo.term_id = t.term_id AND mbland_tmo.meta_key = 'term_order' )";
	$clauses['orderby'] = 'ORDER BY CAST( IFNULL( mbland_tmo.meta_value, 999999 ) AS UNSIGNED ) ASC, t.name';
	$clauses['order']   = 'ASC';

	return $clauses;
}

/**
 * 2. Nạp script kéo thả trên trang danh sách term.
 */
add_action( 'admin_enqueue_scripts', 'mbland_term_order_admin_assets' );
function mbland_term_order_admin_assets( $hook ) {
	if ( 'edit-tags.php' !== $hook ) {
		return;
	}
	if ( empty( $_GET['taxonomy'] ) || MBLAND_TERM_ORDER_TAXONOMY !== $_GET['taxonomy'] || isset( $_GET['orderby'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		return;
	}
	if ( ! current_user_can( 'manage_categories' ) ) {
		return;
	}
	wp_enqueue_script( 'jquery-ui-sortable' );
	add_action( 'admin_footer', 'mbland_term_order_admin_footer' );
}

function mbland_term_order_admin_footer() {
	$terms  = get_terms( array(
		'taxonomy'   => MBLAND_TERM_ORDER_TAXONOMY,
		'hide_empty' => false,
		'fields'     => 'id=>parent',
	) );
	$parent = ( ! is_wp_error( $terms ) && is_array( $terms ) ) ? array_map( 'intval', $terms ) : array();
	?>
	<style>
		#the-list.mbland-sortable tr { cursor: move; }
		#the-list tr.mbland-placeholder td { background: #e8f0fe; height: 40px; }
		#the-list tr.mbland-saving { opacity: .6; }
		.mbland-order-note { margin: 8px 0; padding: 8px 12px; background: #fff; border-left: 4px solid #2271b1; }
	</style>
	<script>
	jQuery(function ($) {
		var $list = $('#the-list');
		if (!$list.length || !$list.find('tr[id^="tag-"]').length) { return; }

		var parents = <?php echo wp_json_encode( (object) $parent ); ?>;
		var ajaxNonce = <?php echo wp_json_encode( wp_create_nonce( 'mbland_term_order' ) ); ?>;

		function termId($tr) { return parseInt(($tr.attr('id') || '').replace('tag-', ''), 10); }
		function level($tr) {
			var m = ($tr.attr('class') || '').match(/level-(\d+)/);
			return m ? parseInt(m[1], 10) : 0;
		}
		function parentOf($tr) { return parseInt(parents[termId($tr)] || 0, 10); }

		$('.wp-list-table').before('<p class="mbland-order-note">Kéo thả các hàng để sắp xếp thứ tự hiển thị (chỉ di chuyển trong cùng cấp cha).</p>');
		$list.addClass('mbland-sortable');

		var $children = $(), startIndex = 0;

		function isValidDrop($row) {
			var L = level($row), pid = parentOf($row);
			var $next = $row.next('tr[id^="tag-"]');
			if ($next.length && level($next) > L) { return false; }
			var $p = $row.prevAll('tr[id^="tag-"]').filter(function () { return level($(this)) <= L; }).first();
			if (!$p.length) { return L === 0; }
			if (level($p) === L) { return parentOf($p) === pid; }
			return termId($p) === pid;
		}

		$list.sortable({
			items: '> tr[id^="tag-"]',
			axis: 'y',
			cursor: 'move',
			placeholder: 'mbland-placeholder',
			helper: function (e, tr) {
				var $cells = tr.children(), $helper = tr.clone();
				$helper.children().each(function (i) { $(this).width($cells.eq(i).width()); });
				return $helper;
			},
			start: function (e, ui) {
				var L = level(ui.item);
				startIndex = ui.item.index();
				// Gom các term con đi cùng term cha khi kéo.
				$children = ui.item.nextAll('tr[id^="tag-"]').filter(function () { return true; });
				var collected = [];
				ui.item.nextAll('tr[id^="tag-"]').each(function () {
					if (level($(this)) > L) { collected.push(this); } else { return false; }
				});
				$children = $(collected).detach();
				ui.placeholder.html('<td colspan="' + ui.item.children().length + '"></td>');
				$list.sortable('refreshPositions');
			},
			stop: function (e, ui) {
				var $row = ui.item;
				if (!isValidDrop($row)) {
					$list.sortable('cancel');
					$row.after($children);
					$children = $();
					return;
				}
				$row.after($children);
				$children = $();

				var ids = $list.find('> tr[id^="tag-"]').map(function () { return termId($(this)); }).get();
				$list.addClass('mbland-saving');
				$.post(ajaxurl, {
					action: 'mbland_save_term_order',
					nonce: ajaxNonce,
					taxonomy: <?php echo wp_json_encode( MBLAND_TERM_ORDER_TAXONOMY ); ?>,
					order: ids
				}).always(function () { $list.removeClass('mbland-saving'); })
				  .fail(function () { alert('Không lưu được thứ tự. Vui lòng tải lại trang và thử lại.'); });
			}
		});
	});
	</script>
	<?php
}

/**
 * 3. AJAX lưu thứ tự.
 */
add_action( 'wp_ajax_mbland_save_term_order', 'mbland_ajax_save_term_order' );
function mbland_ajax_save_term_order() {
	check_ajax_referer( 'mbland_term_order', 'nonce' );

	if ( ! current_user_can( 'manage_categories' ) ) {
		wp_send_json_error( 'forbidden', 403 );
	}

	$taxonomy = isset( $_POST['taxonomy'] ) ? sanitize_key( wp_unslash( $_POST['taxonomy'] ) ) : '';
	if ( MBLAND_TERM_ORDER_TAXONOMY !== $taxonomy || empty( $_POST['order'] ) || ! is_array( $_POST['order'] ) ) {
		wp_send_json_error( 'bad_request', 400 );
	}

	$position = 0;
	foreach ( array_map( 'absint', wp_unslash( $_POST['order'] ) ) as $term_id ) {
		if ( $term_id && term_exists( $term_id, $taxonomy ) ) {
			update_term_meta( $term_id, 'term_order', $position++ );
		}
	}

	wp_send_json_success( array( 'saved' => $position ) );
}

/**
 * 4. Term mới tạo: xếp cuối danh sách.
 */
add_action( 'created_' . MBLAND_TERM_ORDER_TAXONOMY, 'mbland_term_order_new_term' );
function mbland_term_order_new_term( $term_id ) {
	global $wpdb;
	$max = $wpdb->get_var( "SELECT MAX( CAST( meta_value AS UNSIGNED ) ) FROM {$wpdb->termmeta} WHERE meta_key = 'term_order'" );
	update_term_meta( $term_id, 'term_order', null === $max ? 0 : ( (int) $max + 1 ) );
}

