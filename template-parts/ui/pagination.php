<?php
/**
 * Component UI: Pagination (Phân trang danh sách bài viết)
 *
 * Usage chuẩn với Custom WP_Query:
 * get_template_part( 'template-parts/ui/pagination', null, array(
 *     'query'    => $custom_query, // WP_Query object
 *     'current'  => $paged,        // Trang hiện tại
 *     'class'    => '',            // Class CSS bổ sung
 * ) );
 *
 * Usage cho rewrite rule /page/N/ có query params:
 * get_template_part( 'template-parts/ui/pagination', null, array(
 *     'query'    => $custom_query,
 *     'current'  => $paged,
 *     'base'     => trailingslashit( $page_url ) . '%_%',
 *     'format'   => 'page/%#%/',
 *     'add_args' => $active_params,
 *     'class'    => 'mbland_recruitment_jobs_pagination',
 * ) );
 *
 * @package HomeNest Theme
 */

$query = ( ! empty( $args['query'] ) && is_a( $args['query'], 'WP_Query' ) ) ? $args['query'] : $GLOBALS['wp_query'];
$total = ! empty( $args['total'] ) ? intval( $args['total'] ) : ( isset( $query->max_num_pages ) ? intval( $query->max_num_pages ) : 1 );

if ( $total <= 1 ) {
	return;
}

$paged = ! empty( $args['current'] ) ? intval( $args['current'] ) : ( ( get_query_var( 'paged' ) ) ? intval( get_query_var( 'paged' ) ) : ( ( get_query_var( 'page' ) ) ? intval( get_query_var( 'page' ) ) : 1 ) );
$current = max( 1, $paged );

$prev_text = ! empty( $args['prev_text'] ) ? $args['prev_text'] : ( function_exists( 'pll__' ) ? pll__( 'Trước' ) : 'Trước' );
$next_text = ! empty( $args['next_text'] ) ? $args['next_text'] : ( function_exists( 'pll__' ) ? pll__( 'Sau' ) : 'Sau' );

$big    = 999999999;
$base   = ! empty( $args['base'] ) ? $args['base'] : str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
$format = isset( $args['format'] ) ? $args['format'] : '?paged=%#%';

$paginate_args = array(
	'base'      => $base,
	'format'    => $format,
	'current'   => $current,
	'total'     => $total,
	'prev_text' => $prev_text,
	'next_text' => $next_text,
	'type'      => 'list',
);

if ( ! empty( $args['add_args'] ) && is_array( $args['add_args'] ) ) {
	$paginate_args['add_args'] = $args['add_args'];
}

$classes = array( 'mbland_pagination', 'mbland_tintucTemplate_post_listPostPagination' );
if ( ! empty( $args['class'] ) ) {
	$classes[] = sanitize_html_class( $args['class'] );
}
?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php echo paginate_links( $paginate_args ); ?>
</div>

