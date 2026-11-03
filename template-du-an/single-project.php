<?php
/*
Template Name: Chi tiết dự án
*/

// Lấy ID của page/post hiện tại
$post_id = get_the_ID();

// Lấy dữ liệu từ ACF fields
$banner = get_field('banner', $post_id);
$banner_url = '';
$banner_alt = '';
$banner_title = '';
if (!empty($banner) && is_array($banner)) {
    $banner_url = $banner['url'];
    $banner_alt = $banner['alt'] ?: get_the_title($post_id); // Fallback alt từ title nếu không có
    $banner_title = $banner['title'] ?: get_the_title($post_id); // Fallback title từ title nếu không có
}

$sub_title = get_field('sub_title', $post_id) ?: ''; // Subtitle từ field

$location = get_field('location', $post_id) ?: ''; // Địa chỉ từ field

$scale = get_field('scale', $post_id) ?: ''; // Quy mô từ field

// Nội dung: Sử dụng wp_kses_post để sanitize
$content = wp_kses_post(get_field('content', $post_id));

// Featured image cho image cuối (sidebar)
$featured_image_url = get_the_post_thumbnail_url($post_id); // Hoặc 'full' nếu cần kích thước lớn hơn
$featured_image_alt = get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true) ?: get_the_title($post_id);
$featured_image_title = get_the_title($post_id); // Title fallback từ post title

// Dự án liên quan
$related_args = array(
    'post_type' => 'du-an', // Thay nếu post type khác
    'post__not_in' => array($post_id),
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
	'tax_query' => array(
        array(
            'taxonomy' => 'danh-muc-du-an', 
            'field'    => 'slug',
            'terms'    => 'dau-tu-tai-chinh',
            'operator' => 'NOT IN',
        ),
    ),
);
$related_query = new WP_Query($related_args);
get_header();
?>
<section class="hn-chitietduan-banner">
	<div class="container"><?php echo do_shortcode('[hn_breadcrumb]'); ?></div>
	<img
		 src="<?php echo esc_url($banner_url); ?>"
		 alt="<?php echo esc_attr($banner_alt); ?>"
		 title="<?php echo esc_attr($banner_title); ?>"
	/>
</section>

<section class="hn-chitietduan-content">
	<div class="container">
		<div class="hn-chitietduan-content-1">
			<h1 class="equalh2">
				<?php the_title(); ?>
			</h1>
			<subtitle><?php echo wp_kses_post($sub_title); ?></subtitle>
			<div class="line"></div>
			<div>
				<?php echo $content; ?>
			</div>
			
			<div class="hn-tasmania-chitietduan-item">
				<div class="hn-tasmania-chitietduan-item-icon">
					<img src="/wp-content/uploads/2025/10/Location.svg" alt="Vị trí" title="Vị trí"/>
				</div>
				<div class="hn-tasmania-chitietduan-item-text-wrapper">
					<span><?php echo pll__('VỊ TRÍ'); ?></span>
					<div class="hn-tasmania-chitietduan-text">
						<?php echo wp_kses_post($location); ?>
					</div>
				</div>
			</div>
			<div class="hn-tasmania-chitietduan-item">
				<div class="hn-tasmania-chitietduan-item-icon">
					<img src="/wp-content/uploads/2025/10/quy-mo.svg" alt="Quy mô" title="Quy mô"/>
				</div>
				<div class="hn-tasmania-chitietduan-item-text-wrapper">
					<span><?php echo pll__('QUY MÔ'); ?></span>
					<div class="hn-tasmania-chitietduan-text">
						<?php echo wp_kses_post($scale); ?>
					</div>
				</div>
			</div>

		</div>
		<div class="hn-tasmania-chitietduan-item-image">
			<img
			 src="<?php echo esc_url($featured_image_url); ?>"
			 alt="<?php echo esc_attr($featured_image_alt); ?>"
			 title="<?php echo esc_attr($featured_image_title); ?>"
		/>
		</div>
	</div>
</section>

<section class="hn-related-projects">
	<div class="container">
		<h2><?php echo pll__('Dự án khác'); ?></h2>
		<p>
			<?php echo pll__('Tasmania & Partner là tập đoàn đa ngành với những dự án nổi bật trong suốt quá trình phát triển'); ?>
		</p>
		<div class="hn-related-projects-slider swiper">
			<div class="swiper-wrapper">
				<?php if ($related_query->have_posts()) : ?>
					<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
						<div class="swiper-slide">
							<?php
							$banner_image = get_field('banner', get_the_ID());
							$banner_image_url = $banner_image['url'] ?? '';
							$banner_image_title = $banner_image['title'] ?? '';
							$item_title = get_the_title();
	$item_sub_title = wp_kses_post( get_field('sub_title'));
    $item_mo_ta = wp_kses_post( get_field( 'short_content' )  );
    $item_dia_chi = wp_kses_post( get_field( 'location' ));
							?>
							<div class="hn-tasmania-projects-item">
							  <div class="hn-tasmania-projects-item-image">
								<img
										src="<?php echo esc_url( $banner_image_url ); ?>"
										alt="<?php echo esc_attr($banner_image_title ); ?>"
										title="<?php echo esc_attr($banner_image_title ); ?>"
									/>
							  </div>
							  <div class="hn-tasmania-projects-item-content">
								  <div class="hn-tasmania-projects-item-content-1">

								  </div>
								  <div class="hn-tasmania-projects-item-content-2">
									  <a href="<?php the_permalink(); ?>" title="<?php echo $item_title ?>">
										<h3 class="small-h3"><?php echo $item_title ?></h3>
										</a>
									  <div class="hn-tasmania-projects-item-content-location">
										  <img src="/wp-content/uploads/2025/10/location.svg" alt="Vị trí" title="Vị trí"/>
										  <div>
											  <?php echo $item_dia_chi?>
										  </div>
									  </div>

									  <a href="<?php the_permalink(); ?>" title="<?php echo $item_title ?>" class="hn-tasmania-projects-view-detail">
										View detail
										</a>
								  </div>
							  </div>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<div class="swiper-slide">
						<p>Không có dự án liên quan.</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
<?php add_action('wp_footer', function () { ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.hn-related-projects-slider', {
            // Cấu hình cơ bản: slides per view = 3, space between = 30px
            slidesPerView: 'auto',
            spaceBetween: 20,
        });
    });
</script>
<?php }, 99); ?>
	</div>
</section>
<?php get_footer(); ?>