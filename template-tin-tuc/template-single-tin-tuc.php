<?php
/*
Template Name: Chi tiết tin tức
*/
get_header();

$post_id            = get_the_ID();
$featured_image_url = get_the_post_thumbnail_url( $post_id, 'full' );
if ( ! $featured_image_url ) {
	$featured_image_url = '/wp-content/uploads/2025/10/about-banner.png';
}
$featured_image_alt = get_post_meta( get_post_thumbnail_id( $post_id ), '_wp_attachment_image_alt', true ) ?: get_the_title( $post_id );
$categories         = get_the_category( $post_id );
?>

<!-- ==========================================================================
     SECTION 1: BREADCRUMB VÀ HÌNH ĐẠI DIỆN BÀI VIẾT
     ========================================================================== -->
<section class="mbland_singlePost_hero">
	<div class="container">
		<div class="mbland_singlePost_hero_breadcrumb">
			<?php echo do_shortcode( '[hn_breadcrumb]' ); ?>
		</div>

		<div class="mbland_singlePost_hero_banner">
		<img
			class="mbland_singlePost_hero_bannerImage"
			src="<?php echo esc_url( $featured_image_url ); ?>"
			alt="<?php echo esc_attr( $featured_image_alt ); ?>"
			title="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"
			loading="eager"
			decoding="async"
			fetchpriority="high"
		/>
	</div>
	</div>
	
</section>

<!-- ==========================================================================
     SECTION 2: NGÀY, DANH MỤC, TÁC GIẢ, NỘI DUNG BÀI VIẾT
     ========================================================================== -->
<section class="mbland_singlePost_content">
	<div class="container">
		<div class="mbland_singlePost_content_wrapper">
			<!-- Meta: Ngày đăng, Danh mục, Tác giả -->
			<div class="mbland_singlePost_content_meta">
				<!-- Ngày đăng -->
				<div class="mbland_singlePost_content_date">
					<span class="mbland_singlePost_content_dateIcon">
						<img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng" loading="lazy" decoding="async" />
					</span>
					<p class="mbland_singlePost_content_dateText"><?php echo get_the_date( 'd/m/Y' ); ?></p>
					<?php
					$post_date    = get_the_date( 'U' );
					$current_time = current_time( 'timestamp' );
					$days_diff    = ( $current_time - $post_date ) / DAY_IN_SECONDS;
					if ( $days_diff <= 3 ) :
					?>
						<span class="mbland_singlePost_content_dateBadge">| <?php echo function_exists( 'pll__' ) ? pll__( 'TIN TỨC MỚI' ) : 'TIN TỨC MỚI'; ?></span>
					<?php endif; ?>
				</div>

				<!-- Danh mục -->
				<?php if ( ! empty( $categories ) ) : ?>
					<span class="mbland_singlePost_content_metaDivider">|</span>
					<div class="mbland_singlePost_content_category">
						<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="mbland_singlePost_content_categoryLink" title="<?php echo esc_attr( $categories[0]->name ); ?>">
							<?php echo esc_html( $categories[0]->name ); ?>
						</a>
					</div>
				<?php endif; ?>

				<!-- Tác giả -->
				<span class="mbland_singlePost_content_metaDivider">|</span>
				<div class="mbland_singlePost_content_author">
					<img class="mbland_singlePost_content_authorAvatar" src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => 48 ) ) ); ?>" alt="<?php the_author(); ?>" title="<?php the_author(); ?>" loading="lazy" decoding="async" />
					<span class="mbland_singlePost_content_authorName"><?php the_author(); ?></span>
				</div>
			</div>

			<!-- Tiêu đề bài viết -->
			<div class="mbland_singlePost_content_header">
				<h1 class="mbland_singlePost_content_title"><?php the_title(); ?></h1>
			</div>

			<!-- Nội dung bài viết -->
			<article class="mbland_singlePost_content_article">
				<?php the_content(); ?>
			</article>
		</div>
	</div>
</section>

<!-- ==========================================================================
     SECTION 3: TIN HOẠT ĐỘNG
     ========================================================================== -->
<section class="mbland_singlePost_activities">
	<div class="container">
		<div class="mbland_singlePost_activities_header">
			<h2 class="mbland_singlePost_activities_heading">
				<?php echo function_exists( 'pll__' ) ? pll__( 'TIN HOẠT ĐỘNG' ) : 'TIN HOẠT ĐỘNG'; ?>
			</h2>
			<div class="mbland_singlePost_activities_line"></div>
		</div>

		<div class="mbland_singlePost_activities_grid">
			<?php
			$term_ids = ! empty( $categories ) ? wp_list_pluck( $categories, 'term_id' ) : array();

			$activities_args = array(
				'post_type'      => 'post',
				'posts_per_page' => 2,
				'post_status'    => 'publish',
				'post__not_in'   => array( $post_id ),
				'orderby'        => 'date',
				'order'          => 'DESC',
			);

			if ( ! empty( $term_ids ) ) {
				$activities_args['category__in'] = $term_ids;
			}

			$activities_query = new WP_Query( $activities_args );

			if ( $activities_query->have_posts() ) :
				while ( $activities_query->have_posts() ) : $activities_query->the_post();
					$activity_img = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
					if ( ! $activity_img ) {
						$activity_img = get_template_directory_uri() . '/images/default.jpg';
					}
					$desc = get_field( 'mo_ta_ngan_tin_tuc', get_the_ID() );
			?>
					<article class="mbland_singlePost_activities_card">
						<a href="<?php the_permalink(); ?>" class="mbland_singlePost_activities_cardThumb" title="<?php the_title_attribute(); ?>">
							<img class="mbland_singlePost_activities_cardImage" src="<?php echo esc_url( $activity_img ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" fetchpriority="low" />
						</a>
						<div class="mbland_singlePost_activities_cardContent">
							<div class="mbland_singlePost_activities_cardMeta">
								<div class="mbland_singlePost_activities_cardDate">
									<div class="mbland_singlePost_activities_cardDateIcon">
										<img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng" loading="lazy" decoding="async" />
									</div>
									<p class="mbland_singlePost_activities_cardDateText"><?php echo get_the_date( 'd/m/Y' ); ?></p>
								</div>
								<div class="mbland_singlePost_activities_cardDivider"></div>
								<p class="mbland_singlePost_activities_cardBadge"><?php echo function_exists( 'pll__' ) ? pll__( 'TIN MỚI' ) : 'TIN MỚI'; ?></p>
							</div>
							<a href="<?php the_permalink(); ?>" class="mbland_singlePost_activities_cardTitleLink" title="<?php the_title_attribute(); ?>">
								<h3 class="mbland_singlePost_activities_cardTitle"><?php the_title(); ?></h3>
							</a>
							<p class="mbland_singlePost_activities_cardDesc"><?php echo wp_kses_post( $desc ? $desc : get_the_excerpt() ); ?></p>
							<?php
							get_template_part( 'template-parts/ui/button-detail', null, array(
								'url'   => get_permalink(),
								'class' => 'mbland_singlePost_activities_cardButton',
								'title' => the_title_attribute( array( 'echo' => false ) ),
							) );
							?>
						</div>
					</article>
			<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
