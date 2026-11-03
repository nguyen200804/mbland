<?php
/**
 * Template dùng chung cho các term của taxonomy `linh-vuc`
 * (fallback khi không có template-linh-vuc/template-{slug}.php riêng).
 *
 * Dữ liệu: lấy các dự án (post type `du-an`) thuộc term `danh-muc-du-an` có cùng slug với term `linh-vuc` hiện tại.
 *
 * @package HomeNest Theme
 */
get_header();

$current_term = get_queried_object();
$term_slug    = $current_term->slug;

// Term con (nhóm dự án) của danh-muc-du-an cùng slug
$project_term = get_term_by( 'slug', $term_slug, 'danh-muc-du-an' );
$sub_terms    = array();
if ( $project_term && ! is_wp_error( $project_term ) ) {
	$sub_terms = get_terms( array(
		'taxonomy'   => 'danh-muc-du-an',
		'hide_empty' => true,
		'parent'     => $project_term->term_id,
		'orderby'    => 'name',
		'order'      => 'ASC',
	) );
}

// Danh sách dự án thuộc lĩnh vực
$projects = new WP_Query( array(
	'post_type'      => 'du-an',
	'post_status'    => 'publish',
	'posts_per_page' => 12,
	'paged'          => max( 1, (int) get_query_var( 'paged' ) ),
	'tax_query'      => array(
		array(
			'taxonomy' => 'danh-muc-du-an',
			'field'    => 'slug',
			'terms'    => $term_slug,
		),
	),
	'orderby'        => 'date',
	'order'          => 'DESC',
) );
?>

<!-- ===== START SECTION LINH VUC HERO ===== -->
<section class="mbland_linhVuc_hero">
	<div class="container mbland_linhVuc_hero_container">
		<?php echo do_shortcode( '[hn_breadcrumb]' ); ?>
		<header class="mbland_linhVuc_hero_header">
			<h1 class="mbland_linhVuc_hero_title"><?php echo esc_html( $current_term->name ); ?></h1>
			<?php if ( $current_term->description ) : ?>
				<p class="mbland_linhVuc_hero_desc"><?php echo wp_kses_post( $current_term->description ); ?></p>
			<?php endif; ?>
		</header>
	</div>
</section>
<!-- ===== END SECTION LINH VUC HERO ===== -->

<?php if ( ! empty( $sub_terms ) && ! is_wp_error( $sub_terms ) ) : ?>
<!-- ===== START SECTION LINH VUC CATEGORIES ===== -->
<section class="mbland_linhVuc_categories">
	<div class="container">
		<ul class="mbland_linhVuc_categories_list">
			<?php foreach ( $sub_terms as $sub ) : ?>
				<li class="mbland_linhVuc_categories_item">
					<a class="mbland_linhVuc_categories_link" href="<?php echo esc_url( get_term_link( $sub ) ); ?>"><?php echo esc_html( $sub->name ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
<!-- ===== END SECTION LINH VUC CATEGORIES ===== -->
<?php endif; ?>

<!-- ===== START SECTION LINH VUC PROJECTS ===== -->
<section class="mbland_linhVuc_projects">
	<div class="container">
		<?php if ( $projects->have_posts() ) : ?>
			<div class="mbland_linhVuc_projects_list">
				<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
					<article class="mbland_linhVuc_projects_item">
						<a class="mbland_linhVuc_projects_link" href="<?php the_permalink(); ?>">
							<figure class="mbland_linhVuc_projects_media">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large', array( 'class' => 'mbland_linhVuc_projects_image', 'loading' => 'lazy' ) ); ?>
								<?php endif; ?>
							</figure>
							<h3 class="mbland_linhVuc_projects_title"><?php the_title(); ?></h3>
						</a>
					</article>
				<?php endwhile; ?>
			</div>
			<nav class="mbland_linhVuc_projects_pagination">
				<?php
				echo paginate_links( array(
					'total'   => $projects->max_num_pages,
					'current' => max( 1, (int) get_query_var( 'paged' ) ),
				) );
				?>
			</nav>
		<?php else : ?>
			<p class="mbland_linhVuc_projects_empty">Chưa có dự án nào trong lĩnh vực này.</p>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
<!-- ===== END SECTION LINH VUC PROJECTS ===== -->

<?php get_footer(); ?>

