<?php
/*
Template Name: Tin tức & Danh mục tin tức
*/
get_header();

if ( is_category() ) {
    $term = get_queried_object();
    $page_title    = $term->name;
    $category_id   = $term->term_id;
    $category_slug = $term->slug;
} else {
    $page_title    = 'Tin tức';
    $category_id   = 0;
    $category_slug = 'all';
}

// Kiểm tra nếu là category và không có bài viết nào
$has_posts = is_category() ? ( $wp_query->found_posts > 0 ) : true;
?>
<section class="hn-tasmania-tintuc">
<div class="container">
	<?php echo do_shortcode('[hn_breadcrumb]'); ?>
	
	<!-- Tiêu đề trang (chỉ hiển thị ở category archive nếu có bài viết) -->
	<?php if ( is_category() && $has_posts ) : ?>
		<header class="page-header">
			<h1 class="page-title"><?php echo esc_html( $page_title ); ?></h1>
			<?php echo term_description( $term->term_id, 'category' ); ?>
		</header>
	<?php else : ?>
		<h1 style="display: none;"><?php echo esc_html( $page_title ); ?></h1>
	<?php endif; ?>
	
	<?php if ( ! $has_posts ) : ?>
		<div class="no-posts-message">Chưa có tin tức trong danh mục này.</div>
	<?php else : ?>
		<!-- Section Tin nổi bật (taxonomy 'tin-noi-bat') -->
		<div class="hn-tasmania-tnb">
			<div class="hn-tasmania-tnb-wrapper">
				<?php
				$tnb_args = array(
					'post_type'      => 'post',
					'posts_per_page' => 1,
					'post_status'    => 'publish',
					'orderby'        => 'date',
					'order'          => 'DESC',
				);

				if ( $category_id > 0 ) {
					$tnb_args['tax_query'] = array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'tin-noi-bat',
							'field'    => 'slug',
							'terms'    => 'tin-noi-bat',
						),
						array(
							'taxonomy' => 'category',
							'field'    => 'term_id',
							'terms'    => $category_id,
						),
					);
				} else {
					$tnb_args['tax_query'] = array(
						array(
							'taxonomy' => 'tin-noi-bat',
							'field'    => 'slug',
							'terms'    => 'tin-noi-bat',
						),
					);
				}

				$tnb_query = new WP_Query( $tnb_args );

				if ( $tnb_query->have_posts() ) :
					while ( $tnb_query->have_posts() ) : $tnb_query->the_post();
						$featured_img = get_the_post_thumbnail_url( get_the_ID() );
						if ( ! $featured_img ) {
							$featured_img = get_template_directory_uri() . '/images/default.jpg';
						}
						$desc = get_field( 'mo_ta_ngan_tin_tuc', get_the_ID() );
						$has_tin_noi_bat = has_term( '', 'tin-noi-bat' );
				?>
						<div class="hn-tasmania-tnb-item">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hn-tasmania-tnb-item-image">
								<img src="<?php echo esc_url( $featured_img ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" fetchpriority="low" />
							</a>								
							<div class="hn-tasmania-tnb-item-content">
								<div class="hn-tasmania-tintuc-date">
									<div class="hn-tasmania-tintuc-date-image">
										<img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng" loading="lazy" decoding="async" fetchpriority="low" />
									</div>
									<p class="hn-tasmania-date"><?php echo get_the_date( 'd/m/Y' ); ?></p>
									<?php if ( $has_tin_noi_bat ) : ?>
										<div class="hn-tasmania-tintuc-date-line"></div>
										<p><?php echo function_exists('pll__') ? pll__('TIN NỔI BẬT') : 'TIN NỔI BẬT'; ?></p>
									<?php endif; ?>
								</div>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<h3 class="small-h3"><?php the_title(); ?></h3>
								</a>
								<div class="desc-text tnb-desc"><?php echo wp_kses_post( $desc ? $desc : get_the_excerpt() ); ?></div>
								<a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="Xem chi tiết">
									<div class="hn-tasmania-tintuc-cta-icon">
										<img src="/wp-content/uploads/2025/10/arrow-right-red.svg" alt="Xem chi tiết" title="Xem chi tiết" loading="lazy" decoding="async" fetchpriority="low" />
									</div>
									<?php echo function_exists('pll__') ? pll__('XEM CHI TIẾT') : 'XEM CHI TIẾT'; ?>
								</a>
							</div>
						</div>
				<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
	<?php endif; ?>
</div>
	
<?php if ( $has_posts ) : ?>
<div class="container">
	<!-- Section Tin tức mới -->
	<div class="hn-tasmania-ttm">
		<div class="hn-tasmania-ttm-title">
			<h2 class="equalh3"><?php echo function_exists('pll__') ? pll__('Tin tức mới') : 'Tin tức mới'; ?></h2>
			<div class="line"></div>
		</div>
		
		<div class="hn-tasmania-ttm-wrapper">
			<?php
			$ttm_args = array(
				'post_type'      => 'post',
				'posts_per_page' => 2,
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'DESC',
			);

			if ( $category_id > 0 ) {
				$ttm_args['cat'] = $category_id;
			}

			$ttm_query = new WP_Query( $ttm_args );

			if ( $ttm_query->have_posts() ) :
				while ( $ttm_query->have_posts() ) : $ttm_query->the_post();
					$featured_img = get_the_post_thumbnail_url( get_the_ID() );
					if ( ! $featured_img ) {
						$featured_img = get_template_directory_uri() . '/images/default.jpg';
					}
					$desc = get_field( 'mo_ta_ngan_tin_tuc', get_the_ID() );
			?>
					<div class="hn-tasmania-ttm-item">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hn-tasmania-ttm-item-image">
							<img src="<?php echo esc_url( $featured_img ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" fetchpriority="low" />
						</a>
						<div class="hn-tasmania-ttm-item-content">
							<div class="hn-tasmania-tintuc-date">
								<div class="hn-tasmania-tintuc-date-image">
									<img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng" loading="lazy" decoding="async" fetchpriority="low" />
								</div>
								<p class="hn-tasmania-date"><?php echo get_the_date( 'd/m/Y' ); ?></p>
								<div class="hn-tasmania-tintuc-date-line"></div>
								<p><?php echo function_exists('pll__') ? pll__('TIN MỚI') : 'TIN MỚI'; ?></p>
							</div>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<h3 class="small-h3"><?php the_title(); ?></h3>
							</a>
							<p class="desc-text"><?php echo wp_kses_post( $desc ? $desc : get_the_excerpt() ); ?></p>
							<a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="Xem chi tiết">
								<div class="hn-tasmania-tintuc-cta-icon">
									<img src="/wp-content/uploads/2025/10/arrow-right-red.svg" alt="Xem chi tiết" title="Xem chi tiết" loading="lazy" decoding="async" fetchpriority="low" />
								</div>
								<?php echo function_exists('pll__') ? pll__('XEM CHI TIẾT') : 'XEM CHI TIẾT'; ?>
							</a>
						</div>
					</div>
			<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
</div>
	
<div class="container">
	<!-- Section Tất cả tin tức -->
	<div class="hn-tasmania-tt">
		<div class="hn-tasmania-ttm-title">
			<h2 class="equalh3"><?php echo function_exists('pll__') ? pll__('Tất cả tin tức') : 'Tất cả tin tức'; ?></h2>
			<div class="line"></div>
		</div>
		<div class="hn-tasmania-tt-grid">
			<?php
			$grid_args = array(
				'post_type'      => 'post',
				'posts_per_page' => 6,
				'paged'          => 1,
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'DESC',
			);
			if ( $category_id > 0 ) {
				$grid_args['cat'] = $category_id;
			}
			$grid_query = new WP_Query( $grid_args );

			if ( $grid_query->have_posts() ) :
				$i = 0;
				while ( $grid_query->have_posts() ) : $grid_query->the_post();
					$featured_img = get_the_post_thumbnail_url( get_the_ID() );
					if ( ! $featured_img ) {
						$featured_img = get_template_directory_uri() . '/images/default.jpg';
					}
					$desc = get_field( 'mo_ta_ngan_tin_tuc', get_the_ID() );
					$has_tin_noi_bat = has_term( '', 'tin-noi-bat' );
					$column_class = ( $i % 3 == 0 ) ? 'first-column' : '';
				?>
					<div class="hn-tasmania-tt-grid-item <?php echo esc_attr( $column_class ); ?>">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hn-tasmania-tt-grid-item-image">
							<img src="<?php echo esc_url( $featured_img ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" fetchpriority="low" />
						</a>
						<div class="hn-tasmania-tt-grid-item-content">
							<div class="hn-tasmania-tintuc-date">
								<div class="hn-tasmania-tintuc-date-image">
									<img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng" loading="lazy" decoding="async" fetchpriority="low" />
								</div>
								<p class="hn-tasmania-date"><?php echo get_the_date( 'd/m/Y' ); ?></p>
								<?php if ( $has_tin_noi_bat ) : ?>
									<div class="hn-tasmania-tintuc-date-line"></div>
									<p><?php echo function_exists('pll__') ? pll__('TIN NỔI BẬT') : 'TIN NỔI BẬT'; ?></p>
								<?php endif; ?>
							</div>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<h3 class="small-h3"><?php the_title(); ?></h3>
							</a>
							<div class="desc-text"><?php echo wp_kses_post( $desc ? $desc : get_the_excerpt() ); ?></div>
							<a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="Xem chi tiết">
								<div class="hn-tasmania-tintuc-cta-icon">
									<img src="/wp-content/uploads/2025/10/arrow-right-red.svg" alt="Xem chi tiết" title="Xem chi tiết" loading="lazy" decoding="async" fetchpriority="low" />
								</div>
								<?php echo function_exists('pll__') ? pll__('XEM CHI TIẾT') : 'XEM CHI TIẾT'; ?>
							</a>
						</div>
					</div>
				<?php
					$i++;
				endwhile;
				wp_reset_postdata();
			endif; ?>
		</div>

        <!-- Load More Button -->
        <?php if ( $grid_query->have_posts() && $grid_query->max_num_pages > 1 ) : ?>
        <div class="load-more-container">
            <button class="load-more-btn" id="load-more-news"><?php echo function_exists('pll__') ? pll__('Xem thêm') : 'Xem thêm'; ?></button>
        </div>
        <?php endif; ?>
	</div>
</div>
<?php endif; ?>
</section>

<?php add_action('wp_footer', function () use ( $category_slug ) { ?>
<script>
jQuery(document).ready(function($) {
    var currentPage = 1;
    var currentCat = '<?php echo esc_js( $category_slug ); ?>';

    $('#load-more-news').on('click', function() {
        var btn = $(this);
        if (btn.hasClass('loading')) return;

        btn.addClass('loading').text('<?php echo function_exists('pll__') ? esc_js( pll__('Đang tải...') ) : 'Đang tải...'; ?>');
        currentPage++;

        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'load_news',
                page: currentPage,
                cat: currentCat
            },
            success: function(res) {
                if (res.html) {
                    $('.hn-tasmania-tt-grid').append(res.html);
                }

                if (!res.has_more) {
                    btn.hide();
                }

                btn.removeClass('loading').text('<?php echo function_exists('pll__') ? esc_js( pll__('Xem thêm') ) : 'Xem thêm'; ?>');
            },
            error: function() {
                btn.removeClass('loading').text('<?php echo function_exists('pll__') ? esc_js( pll__('Xem thêm') ) : 'Xem thêm'; ?>');
                alert('Có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    });
});
</script>
<?php }, 99); ?>

<?php get_footer(); ?>
