<?php
/*
Template Name: Tin tức category
*/
get_header();

if ( is_category() ) {
    $term = get_queried_object();
    $page_title = $term->name; // Tiêu đề trang từ category
    $category_id = $term->term_id;
    $category_slug = get_query_var('category_name');
} else {
    $page_title = 'Tin tức'; // Mặc định nếu không phải archive
    $category_id = 0; // Không filter nếu không phải category
    $category_slug = 'all';
}

// Kiểm tra nếu là category và không có posts nào
$has_posts = is_category() ? ($wp_query->found_posts > 0) : true;
?>
<section class="hn-tasmania-tintuc">
<div class="container">
	<?php echo do_shortcode('[hn_breadcrumb]'); ?>
	
	<?php if ( $has_posts ) : ?>
		<!-- Tiêu đề trang (nếu là category archive và có posts) -->
		<?php if ( is_category() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php echo esc_html( $page_title ); ?></h1>
				<?php echo term_description( $term->term_id, 'category' ); ?>
			</header>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if ( ! $has_posts ) : ?>
		<div class="no-posts-message">Chưa có tin tức trong danh mục này.</div>
	<?php else : ?>
		<!-- Section Tin nổi bật (taxonomy 'tin-noi-bat') -->
		<div class="hn-tasmania-tnb">
			<div class="hn-tasmania-tnb-wrapper">
				<?php
				// Query posts từ taxonomy 'tin-noi-bat' VÀ thuộc category hiện tại (lấy 1 post mới nhất)
				$tnb_query = new WP_Query( array(
					'post_type'      => 'post',
					'posts_per_page' => 1,
					'post_status'    => 'publish',
					'tax_query'      => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'tin-noi-bat',
							'field'    => 'term_id',
							'operator' => 'EXISTS', // Lấy posts có bất kỳ term nào trong taxonomy
						),
						array(
							'taxonomy' => 'category',
							'field'    => 'term_id',
							'terms'    => $category_id,
						),
					),
					'orderby'        => 'date',
					'order'          => 'DESC',
				) );

				if ( $tnb_query->have_posts() ) :
					while ( $tnb_query->have_posts() ) : $tnb_query->the_post();
						$featured_img = get_the_post_thumbnail_url( get_the_ID() );
						if ( ! $featured_img ) {
							$featured_img = get_template_directory_uri() . '/images/default.jpg'; // Fallback
						}
						$desc = get_field( 'mo_ta_ngan_tin_tuc', get_the_ID() );
						$has_tin_noi_bat = has_term( '', 'tin-noi-bat' ); // Kiểm tra có bất kỳ term nào trong taxonomy
				?>
						<div class="hn-tasmania-tnb-item">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hn-tasmania-tnb-item-image">
								<img src="<?php echo esc_url( $featured_img ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/>
							</a>								
							<div class="hn-tasmania-tnb-item-content">
								<div class="hn-tasmania-tintuc-date">
									<div class="hn-tasmania-tintuc-date-image">
										<img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng"/>
									</div>
									<p class="hn-tasmania-date"><?php echo get_the_date( 'd/m/Y' ); ?></p>
									<?php if ( $has_tin_noi_bat ) : ?>
										<div class="hn-tasmania-tintuc-date-line"></div>
										<p><?php echo pll__('TIN NỔI BẬT'); ?></p>
									<?php endif; ?>
								</div>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<h3 class="small-h3"><?php the_title(); ?></h3>
								</a>
								<div class="desc-text tnb-desc"><?php echo wp_kses_post( $desc ? $desc : get_the_excerpt() ); ?></div>
								<a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="Xem chi tiết">
									<div class="hn-tasmania-tintuc-cta-icon">
										<img src="/wp-content/uploads/2025/10/arrow-right-red.svg" alt="Xem chi tiết" title="Xem chi tiết"/>
									</div>
									<?php echo pll__('XEM CHI TIẾT'); ?>
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
	<!-- Section Tin tức mới (2 bài mới nhất sau ngày 6/10/2025, thuộc category hiện tại) -->
	<div class="hn-tasmania-ttm">
		<div class="hn-tasmania-ttm-title">
			<h2 class="equalh3"><?php echo pll__('Tin tức mới'); ?></h2>
			<div class="line"></div>
		</div>
		
		<div class="hn-tasmania-ttm-wrapper">
			<?php
			$ttm_query = new WP_Query( array(
				'post_type'      => 'post',
				'posts_per_page' => 2,
				'post_status'    => 'publish',
				'tax_query'      => array(
					array(
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $category_id,
					),
				),
				'date_query'     => array(
					array(
						'after' => '2025-10-06', // Sau ngày 6/10/2025 (tin mới)
					),
				),
				'orderby'        => 'date',
				'order'          => 'DESC',
			) );

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
							<img src="<?php echo esc_url( $featured_img ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/>
						</a>
						<div class="hn-tasmania-ttm-item-content">
							<div class="hn-tasmania-tintuc-date">
								<div class="hn-tasmania-tintuc-date-image">
									<img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng"/>
								</div>
								<p class="hn-tasmania-date"><?php echo get_the_date( 'd/m/Y' ); ?></p>
									<div class="hn-tasmania-tintuc-date-line"></div>
									<p><?php echo pll__('TIN MỚI'); ?></p>
							</div>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<h3 class="small-h3"><?php the_title(); ?></h3>
							</a>
							<p class="desc-text"><?php echo wp_kses_post( $desc ? $desc : get_the_excerpt() ); ?></p>
							<a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="Xem chi tiết">
								<div class="hn-tasmania-tintuc-cta-icon">
									<img src="/wp-content/uploads/2025/10/arrow-right-red.svg" alt="Xem chi tiết" title="Xem chi tiết"/>
								</div>
								<?php echo pll__('XEM CHI TIẾT'); ?>
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
	<!-- Section Tin liên quan -->
	<div class="hn-tasmania-tt">
		<div class="hn-tasmania-ttm-title">
			<h2 class="equalh3"><?php echo pll__('Tất cả tin tức'); ?></h2>
			<div class="line"></div>
		</div>
		<div class="hn-tasmania-tt-grid">
			<?php
			// Custom query cho grid: 6 posts đầu tiên thuộc category
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
				$i = 0; // Để style grid 3 cột
				while ( $grid_query->have_posts() ) : $grid_query->the_post();
					$featured_img = get_the_post_thumbnail_url( get_the_ID() );
					if ( ! $featured_img ) {
						$featured_img = get_template_directory_uri() . '/images/default.jpg';
					}
					$desc = get_field( 'mo_ta_ngan_tin_tuc', get_the_ID() );
					$has_tin_noi_bat = has_term( '', 'tin-noi-bat' ); // Kiểm tra có bất kỳ term nào trong taxonomy
					$column_class = ( $i % 3 == 0 ) ? 'first-column' : '';
				?>
					<div class="hn-tasmania-tt-grid-item <?php echo esc_attr( $column_class ); ?>">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hn-tasmania-tt-grid-item-image">
							<img src="<?php echo esc_url( $featured_img ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/>
						</a>
						<div class="hn-tasmania-tt-grid-item-content">
							<div class="hn-tasmania-tintuc-date">
								<div class="hn-tasmania-tintuc-date-image">
									<img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng"/>
								</div>
								<p class="hn-tasmania-date"><?php echo get_the_date( 'd/m/Y' ); ?></p>
								<?php if ( $has_tin_noi_bat ) : ?>
									<div class="hn-tasmania-tintuc-date-line"></div>
									<p><?php echo pll__('TIN NỔI BẬT'); ?></p>
								<?php endif; ?>
							</div>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<h3 class="small-h3"><?php the_title(); ?></h3>
							</a>
							<div class="desc-text"><?php echo wp_kses_post( $desc ? $desc : get_the_excerpt() ); ?></div>
							<a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="Xem chi tiết">
								<div class="hn-tasmania-tintuc-cta-icon">
									<img src="/wp-content/uploads/2025/10/arrow-right-red.svg" alt="Xem chi tiết" title="Xem chi tiết"/>
								</div>
								<?php echo pll__('XEM CHI TIẾT'); ?>
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
            <button class="load-more-btn" id="load-more-news"><?php echo pll__('Xem thêm'); ?></button>
        </div>
        <?php endif; ?>
	</div>
</div>
<?php endif; ?>
</section>
<?php add_action('wp_footer', function () { ?>
<script>
jQuery(document).ready(function($) {
    var currentPage = 1;
    var currentCat = 'all';

    $('#load-more-news').on('click', function() {
        var btn = $(this);
        if (btn.hasClass('loading')) return;

        btn.addClass('loading').text('<?php echo pll__('Đang tải...'); ?>');
        currentPage++;

        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            dataType: 'json', // ⚠️ Thêm dòng này
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
                    btn.hide(); // ✅ Ẩn ngay khi hết bài
                }

                btn.removeClass('loading').text('Xem thêm');
            },
            error: function() {
                btn.removeClass('loading').text('Xem thêm');
                alert('Có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    });
});
</script>
<?php }, 99); ?>

<?php get_footer(); ?>