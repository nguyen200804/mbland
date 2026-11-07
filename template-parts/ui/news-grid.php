<?php
/**
 * Component UI: News Grid (Lưới bài viết tin tức 2 cột)
 * Dùng chung cho:
 * - Tin tức liên quan (Tuyển dụng: .mbland_recruitment_news_grid)
 * - Tin hoạt động (Chi tiết tin tức: .mbland_singlePost_activities_grid)
 * - Tin tức mới (Danh mục tin tức: .mbland_tintucTemplate_newPost_list)
 *
 * @package HomeNest Theme
 */

$args = wp_parse_args( $args, array(
	'posts_per_page' => 2,
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'category__in'   => array(),
	'post__not_in'   => array(),
	'cat'            => 0,
	'badge'          => '',
	'class'          => '',
	'card_class'     => '',
	'query'          => null,
) );

// Xây dựng query nếu chưa truyền sẵn
if ( ! empty( $args['query'] ) && $args['query'] instanceof WP_Query ) {
	$news_query = $args['query'];
} else {
	$query_args = array(
		'post_type'      => $args['post_type'],
		'posts_per_page' => $args['posts_per_page'],
		'post_status'    => $args['post_status'],
		'orderby'        => $args['orderby'],
		'order'          => $args['order'],
	);

	if ( ! empty( $args['cat'] ) ) {
		$query_args['cat'] = $args['cat'];
	}

	if ( ! empty( $args['category__in'] ) ) {
		$query_args['category__in'] = $args['category__in'];
	}

	if ( ! empty( $args['post__not_in'] ) ) {
		$query_args['post__not_in'] = $args['post__not_in'];
	}

	$news_query = new WP_Query( $query_args );
}

if ( ! $news_query->have_posts() ) {
	return;
}

$grid_classes = array(
	'mbland_newsGrid_list',
	'mbland_recruitment_news_grid',
	'mbland_singlePost_activities_grid',
	'mbland_tintucTemplate_newPost_list',
);
if ( ! empty( $args['class'] ) ) {
	$grid_classes[] = sanitize_html_class( $args['class'] );
}
?>
<div class="<?php echo esc_attr( implode( ' ', $grid_classes ) ); ?>">
	<?php
	while ( $news_query->have_posts() ) :
		$news_query->the_post();
		get_template_part( 'template-parts/ui/newCardItem', null, array(
			'post_id' => get_the_ID(),
			'class'   => $args['card_class'],
			'badge'   => $args['badge'],
		) );
	endwhile;
	wp_reset_postdata();
	?>
</div>

