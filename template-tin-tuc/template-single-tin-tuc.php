<?php
/*
Template Name: Chi tiết tin tức
*/
get_header();
?>
<section class="hn-tasmania-chitietduan">
	<div class="container"><?php echo do_shortcode('[hn_breadcrumb]'); ?></div>
	<div class="hn-tasmania-tintuc__banner">
          <img
            src="/wp-content/uploads/2025/10/about-banner.png"
            alt="Tintuc banner"
            title="Tintuc banner"
          />
        </div>
	<div class="container">
		<div class="hn-tasmania-chitietduan-content">
			<div class="hn-tasmania-chitietduan-ngaydang">
				<div class="hn-tasmania-chitietduan-ngaydang-icon">
					<img src="/wp-content/uploads/2025/10/clock.svg" alt="" title=""/>
				</div>
				<p class="hn-tasmania-chitietduan-ngaydang-date">
  					<?php echo get_the_date('d/m/Y'); ?>
				</p>

				 <?php
			    // Tính số ngày kể từ khi đăng
			    $post_date   = get_the_date('U'); // dạng timestamp
			    $current_time = current_time('timestamp');
			    $days_diff    = ($current_time - $post_date) / DAY_IN_SECONDS;
			
			    if ($days_diff <= 3) : // Nếu nhỏ hơn hoặc bằng 3 ngày
			  ?>
			    <p class="hn-tasmania-chitietduan-ngaydang-ttm">| <?php echo pll__('TIN TỨC MỚI'); ?></p>
			  <?php endif; ?>
			</div>
			<div class="hn-chitietduan-title">
				<h1><?php echo get_the_title(); ?></h1>
			</div>
			<div class="hn-chitietduan-article">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
<div class="container">
	<!-- Section Văn hóa công ty -->
	<div class="hn-tasmania-ttm">
		<div class="hn-tasmania-ttm-title">
			<h2 class="equalh3">
			  <?php
			  $terms = get_the_category( get_the_ID() );
			  if ( ! empty( $terms ) ) {
			      echo esc_html( $terms[0]->name );
			  }
			  ?>
			</h2>

			<div class="line"></div>
		</div>
		
		<div class="hn-tasmania-ttm-wrapper">
			<?php
			// ✅ Lấy category hiện tại của bài
			$terms = get_the_category( get_the_ID() );

			if ( ! empty( $terms ) ) {
				$term_ids = wp_list_pluck( $terms, 'term_id' );

				$ttm_query = new WP_Query( array(
					'post_type'      => 'post',
					'posts_per_page' => 2,
					'post_status'    => 'publish',
					'category__in'   => $term_ids, // bài cùng category
					'post__not_in'   => array( get_the_ID() ), // bỏ bài hiện tại
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
							<div class="hn-tasmania-ttm-item-image">
								<img src="<?php echo esc_url( $featured_img ); ?>" alt="<?php the_title_attribute(); ?>" />
							</div>
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
								<a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="<?php echo pll__('Xem chi tiết'); ?>">
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
			}
			?>
		</div>
	</div>
</div>

</section>


<?php get_footer(); ?>