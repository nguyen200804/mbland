<?php
/*
Template Name: News
*/
get_header();

// Query for grid: 6 posts (3 columns × 2 rows)
$grid_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);
$grid_query = new WP_Query($grid_args);
?>

<section class="hn-tasmania-tintuc">
<div class="container">
	<?php echo do_shortcode('[hn_breadcrumb]'); ?>
	<h1 style="display: none;">
		News
	</h1>
	<!-- Featured News Section -->
	<div class="hn-tasmania-tnb">
		<div class="hn-tasmania-tnb-wrapper">
			<?php
			// Query posts from taxonomy 'tin-noi-bat' (featured news)
			$tnb_query = new WP_Query(array(
				'post_type'      => 'post',
				'posts_per_page' => 1,
				'post_status'    => 'publish',
				'tax_query'      => array(
					array(
						'taxonomy' => 'tin-noi-bat',
						'field'    => 'slug',
						'terms' => 'featured-news',
						'operator' => 'IN',
					),
				),
				'orderby'        => 'date',
				'order'          => 'DESC',
			));

			if ($tnb_query->have_posts()):
				while ($tnb_query->have_posts()): $tnb_query->the_post();
					$featured_img = get_the_post_thumbnail_url(get_the_ID());
					if (!$featured_img) {
						$featured_img = get_template_directory_uri() . '/images/default.jpg';
					}
					$desc = get_field('mo_ta_ngan_tin_tuc', get_the_ID());
					$has_tin_noi_bat = has_term('', 'tin-noi-bat');
			?>
					<div class="hn-tasmania-tnb-item">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hn-tasmania-tnb-item-image">
							<img src="<?php echo esc_url($featured_img); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( $featured_img, 768, 512 ) ); ?> />
						</a>								
						<div class="hn-tasmania-tnb-item-content">
							<div class="hn-tasmania-tintuc-date">
								<div class="hn-tasmania-tintuc-date-image">
									<img src="/wp-content/uploads/2025/10/clock.svg" alt="Posted date" title="Posted date" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/clock.svg', 20, 20 ) ); ?> />
								</div>
								<p class="hn-tasmania-date"><?php echo get_the_date('d/m/Y'); ?></p>
								<?php if ($has_tin_noi_bat): ?>
									<div class="hn-tasmania-tintuc-date-line"></div>
									<p>HOT NEWS</p>
								<?php endif; ?>
							</div>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<h3 class="small-h3"><?php the_title(); ?></h3>
							</a>
							<p class="desc-text tnb-desc"><?php echo wp_kses_post($desc ? $desc : get_the_excerpt()); ?></p>
							<a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="Read more">
								<div class="hn-tasmania-tintuc-cta-icon">
									<img src="/wp-content/uploads/2025/10/arrow-right-red.svg" alt="Read more" title="Read more" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/arrow-right-red.svg', 15, 15 ) ); ?> />
								</div>
								READ MORE
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
	<!-- Latest News Section -->
	<div class="hn-tasmania-ttm">
		<div class="hn-tasmania-ttm-title">
			<h2 class="equalh3">Latest News</h2>
			<div class="line"></div>
		</div>
		
		<div class="hn-tasmania-ttm-wrapper">
			<?php
			$ttm_query = new WP_Query(array(
				'post_type'      => 'post',
				'posts_per_page' => 2,
				'post_status'    => 'publish',
				'date_query'     => array(
					array(
						'after' => '2025-10-06',
					),
				),
				'orderby'        => 'date',
				'order'          => 'DESC',
			));

			if ($ttm_query->have_posts()):
				while ($ttm_query->have_posts()): $ttm_query->the_post();
					$featured_img = get_the_post_thumbnail_url(get_the_ID());
					if (!$featured_img) {
						$featured_img = get_template_directory_uri() . '/images/default.jpg';
					}
					$desc = get_field('mo_ta_ngan_tin_tuc', get_the_ID());
			?>
					<div class="hn-tasmania-ttm-item">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hn-tasmania-ttm-item-image">
							<img src="<?php echo esc_url($featured_img); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( $featured_img, 768, 512 ) ); ?> />
						</a>
						<div class="hn-tasmania-ttm-item-content">
							<div class="hn-tasmania-tintuc-date">
								<div class="hn-tasmania-tintuc-date-image">
									<img src="/wp-content/uploads/2025/10/clock.svg" alt="Posted date" title="Posted date" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/clock.svg', 20, 20 ) ); ?> />
								</div>
								<p class="hn-tasmania-date"><?php echo get_the_date('d/m/Y'); ?></p>
								<div class="hn-tasmania-tintuc-date-line"></div>
								<p>NEW</p>
							</div>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<h3 class="small-h3"><?php the_title(); ?></h3>
							</a>
							<p class="desc-text"><?php echo wp_kses_post($desc ? $desc : get_the_excerpt()); ?></p>
							<a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="Read more">
								<div class="hn-tasmania-tintuc-cta-icon">
									<img src="/wp-content/uploads/2025/10/arrow-right-red.svg" alt="Read more" title="Read more" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/arrow-right-red.svg', 15, 15 ) ); ?> />
								</div>
								READ MORE
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
	<!-- All News Section -->
	<div class="hn-tasmania-tt">
		<div class="hn-tasmania-ttm-title">
			<h2 class="equalh3">All News</h2>
			<div class="line"></div>
		</div>
		<div class="hn-tasmania-tt-grid">
			<?php if ($grid_query->have_posts()):
				$i = 0;
				while ($grid_query->have_posts()): $grid_query->the_post();
					$featured_img = get_the_post_thumbnail_url(get_the_ID());
					if (!$featured_img) {
						$featured_img = get_template_directory_uri() . '/images/default.jpg';
					}
					$desc = get_field('mo_ta_ngan_tin_tuc', get_the_ID());
					$has_tin_noi_bat = has_term('', 'tin-noi-bat');
					$column_class = ($i % 3 == 0) ? 'first-column' : '';
				?>
					<div class="hn-tasmania-tt-grid-item <?php echo esc_attr($column_class); ?>">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hn-tasmania-tt-grid-item-image">
							<img src="<?php echo esc_url($featured_img); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( $featured_img, 768, 512 ) ); ?> />
						</a>
						<div class="hn-tasmania-tt-grid-item-content">
							<div class="hn-tasmania-tintuc-date">
								<div class="hn-tasmania-tintuc-date-image">
									<img src="/wp-content/uploads/2025/10/clock.svg" alt="Posted date" title="Posted date" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/clock.svg', 20, 20 ) ); ?> />
								</div>
								<p class="hn-tasmania-date"><?php echo get_the_date('d/m/Y'); ?></p>
								<?php if ($has_tin_noi_bat): ?>
									<div class="hn-tasmania-tintuc-date-line"></div>
									<p>FEATURED NEWS</p>
								<?php endif; ?>
							</div>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<h3 class="small-h3"><?php the_title(); ?></h3>
							</a>
							<p class="desc-text"><?php echo wp_kses_post($desc ? $desc : get_the_excerpt()); ?></p>
							<a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="Read more">
								<div class="hn-tasmania-tintuc-cta-icon">
									<img src="/wp-content/uploads/2025/10/arrow-right-red.svg" alt="Read more" title="Read more" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/arrow-right-red.svg', 15, 15 ) ); ?> />
								</div>
								READ MORE
							</a>
						</div>
					</div>
				<?php
					$i++;
				endwhile;
				wp_reset_postdata();
			else: ?>
				<p>No news available in this category.</p>
			<?php endif; ?>
		</div>

        <!-- Load More Button -->
        <div class="load-more-container">
            <button class="load-more-btn" id="load-more-news">Load More</button>
        </div>
	</div>
</div>
</section>
<?php add_action('wp_footer', function () { ?>
<script>
// Safari/iOS fix: kích hoạt hover bằng click hoặc chạm
document.querySelectorAll(".hn__gia-tri .item-gia-tri").forEach((item) => {
  item.addEventListener("touchstart", function () {
    // Thêm class 'hover' để mô phỏng hiệu ứng hover
    this.classList.add("hover");
  });

  item.addEventListener("touchend", function () {
    // Gỡ class sau khi chạm ra ngoài
    setTimeout(() => this.classList.remove("hover"), 300);
  });

  // Cho phép click chuột cũng có hiệu ứng tương tự
  item.addEventListener("click", function () {
    this.classList.add("hover");
    setTimeout(() => this.classList.remove("hover"), 300);
  });
});
jQuery(document).ready(function($) {
    var currentPage = 1;
    var currentCat = 'all';

    $('#load-more-news').on('click', function() {
        var btn = $(this);
        if (btn.hasClass('loading')) return;

        btn.addClass('loading').text('Loading...');
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
