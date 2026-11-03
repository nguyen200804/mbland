<?php
/**
 * Template Name: Dịch vụ Du lịch
 */
get_header(); 

$current_term = get_queried_object();

// Lấy dự án mới nhất cho banner từ parent term
$latest_project = get_posts( array(
    'post_type'      => 'du-an',
    'numberposts'    => 1,
    'post_status'    => 'publish',
    'tax_query'      => array(
        array(
            'taxonomy' => 'danh-muc-du-an',
            'field'    => 'slug',
            'terms'    => $current_term->slug,
        ),
    ),
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

$parent_term = get_term_by( 'slug', $current_term->slug, 'danh-muc-du-an' ); // Lấy parent term object bằng slug
$sub_terms = get_terms( array(
    'taxonomy'   => 'danh-muc-du-an',
    'hide_empty' => true,
    'parent'     => $parent_term->term_id, // Child terms của parent (dùng ID từ slug)
    'orderby'    => 'name',
    'order'      => 'ASC',
) );
?>
<section class="hn-tasmania-bds">
	<div class="container">
		<?php echo do_shortcode('[hn_breadcrumb]'); ?>
		<div class="hn-tasmania-bds-header">
			<div class="hn-tasmania-bds-title">
				<h1><?php echo esc_html($current_term->name);?></h1>
				<p>
					<?php echo wp_kses_post( $current_term->description ); ?>
				</p>
			</div>
			<div class="hn-tasmania-scroll-to-explore">
				<img
					 src="/wp-content/uploads/2025/10/explore.svg"
					 alt="Scroll To Explore"
					 title="Scroll To Explore"
				/>
			</div>
		</div>
	</div>
</section>

<?php if ( ! empty( $latest_project ) ) : 
    $latest = $latest_project[0];
    setup_postdata( $latest );
    $banner_img = get_field( 'banner', $latest->ID ) ?: get_the_post_thumbnail_url( $latest->ID, 'large' ); 
    if ( ! $banner_img ) {
        $banner_img = get_template_directory_uri() . '/images/default.jpg';
    }
	$banner_subtitle = wp_kses_post( get_field('sub_title', $latest->ID) ?: '');
    $banner_mo_ta = wp_kses_post( get_field( 'short_content', $latest->ID ) ?: get_the_excerpt() );
    $banner_dia_chi = wp_kses_post( get_field( 'location', $latest->ID ) ?: 'Địa chỉ dự án' );
    $banner_title = $latest->post_title;
?>
<section class="hn-tasmania-banner">
    <img
		 class="hn-tasmania-banner-image"
		 src="<?php echo esc_url( $banner_img['url'] ); ?>" 
		 alt="<?php echo esc_attr( $banner_img['title'] ); ?> - Tasmania & Partner" 
		 title="<?php echo esc_attr( $banner_img['title'] ); ?>"
	/>
    <section class="hn-tasmania-banner-content">
        <div class="container">
            <div class="hn-tasmania-banner-content-1">
                <subtitle class="hn-tasmania-banner-content-subtitle"><?php echo $banner_subtitle ?></subtitle>
            </div>
            <div class="hn-tasmania-banner-content-2">
                <div class="hn-tasmania-banner-content-main">
                    <a href="<?php the_permalink($latest->ID); ?>" title="<?php echo $banner_title; ?>">
                        <h2 class="hn-tasmania-banner-content-title">
                            <?php echo esc_html($banner_title) ?>
                        </h2>
                    </a>
                    <div class="hn-tasmania-banner-content-desc">
                        <?php echo  $banner_mo_ta ?>
                    </div>
                    <div class="hn-tasmania-bds-term-item-location">
                        <div class="hn-tasmania-bds-term-item-location-icon">
                            <img src="/wp-content/uploads/2025/10/location.svg" alt="Vị trí" title="Vị trí"/>
                        </div>
                        <div class="hn-tasmania-bds-term-item-location-text-wrapper">
                            <span>
                                VỊ TRÍ
                            </span>
                            <div class="hn-tasmania-bds-term-item-location-text">
                                <?php echo $banner_dia_chi; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hn-tasmania-banner-content-cta">
                    <a class="hn-tasmania-cta-btn" href="<?php the_permalink($latest->ID); ?>" title="Đang triển khai">ĐANG TRIỂN KHAI</a>
                </div>
            </div>
        </div>
    </section>
</section>

<?php endif; wp_reset_postdata(); ?>

<?php if ( ! empty( $sub_terms ) ) : ?>
    <?php foreach ( $sub_terms as $sub_term ) : 
        // Lấy 3 dự án mới nhất thuộc sub-term
        $sub_posts = get_posts( array(
            'post_type'      => 'du-an',
            'numberposts'    => 3,
            'post_status'    => 'publish',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'danh-muc-du-an',
                    'field'    => 'term_id',
                    'terms'    => $sub_term->term_id,
                ),
            ),
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );
    ?>
        <section class="hn-tasmania-bds-term">
            <div class="container">
                <h2>
                    <?php echo esc_html( $sub_term->name ); ?>
                </h2>
                <p>
                    <?php echo esc_html( $sub_term->description ); ?>
                </p>
                <?php if ( ! empty( $sub_posts ) ) : ?>
                    <!-- Swiper Slider thay thế grid -->
                    <div class="hn-tasmania-bds-term-swiper swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ( $sub_posts as $sub_post ) : 
                                $sub_post_title = $sub_post->post_title; // Sử dụng post_title trực tiếp để tránh duplication
                                $sub_post_permalink = get_permalink( $sub_post->ID );
                                $sub_post_title_attr = get_the_title( $sub_post->ID ); // FIXED: Use get_the_title() instead of non-existent get_the_title_attribute()
                                setup_postdata( $sub_post );
                                $sub_img = get_the_post_thumbnail_url( $sub_post->ID);
                                if ( ! $sub_img ) {
                                    $sub_img = get_template_directory_uri() . '/images/default.jpg';
                                }
                                $sub_mo_ta = wp_kses_post( get_field( 'short_content', $sub_post->ID ) ?: get_the_excerpt() );
                                $sub_dia_chi = wp_kses_post( get_field( 'location', $sub_post->ID ) ?: 'Địa chỉ dự án' );
                            ?>
                                <div class="swiper-slide">
                                    <div class="hn-tasmania-bds-term-item">
                                        <div class="hn-tasmania-bds-term-item-image">
                                            <img src="<?php echo esc_url( $sub_img ); ?>" alt="<?php echo esc_attr( $sub_post_title ); ?> - Tasmania & Partner" title="<?php echo esc_attr( $sub_post_title ); ?>"/>
                                        </div>
                                        <div class="hn-tasmania-bds-term-item-content">
                                            <a href="<?php echo esc_url( $sub_post_permalink ); ?>" title="<?php echo esc_attr( $sub_post_title_attr ); ?>">
                                                <h3 class="small-h3">
                                                    <?php echo esc_html( $sub_post_title ); ?>
                                                </h3>
                                            </a>
                                            <div class="hn-tasmania-bds-term-item-content-desc">
                                                <?php echo wp_kses_post( $sub_mo_ta); ?>
                                            </div>
                                            <div class="hn-tasmania-bds-term-item-location">
                                                <div class="hn-tasmania-bds-term-item-location-icon">
                                                    <img src="/wp-content/uploads/2025/10/Location.svg" alt="Vị trí" title="Vị trí"/>
                                                </div>
                                                <div class="hn-tasmania-bds-term-item-location-text-wrapper">
                                                    <span>
                                                        VỊ TRÍ
                                                    </span>
                                                    <div class="hn-tasmania-bds-term-item-location-text">
                                                        <?php echo $sub_dia_chi; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hn-tasmania-bds-term-item-cta">
                                                <a class="hn-tasmania-cta-btn" 
                                                   href="<?php echo esc_url( $sub_post_permalink ); ?>" title="Xem chi tiết">XEM CHI TIẾT</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </div>
                        <!-- Không cần pagination, chỉ navigation nếu muốn (tùy chọn) -->
                        <!-- <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div> -->
                    </div>
                <?php else : ?>
                    <p>Chưa có dự án trong <?php echo esc_html( $sub_term->name ); ?>.</p>
                <?php endif; ?>
            </div>
        </section>
    <?php endforeach; ?>
<?php endif; ?>
<section>
	<?php echo do_shortcode('[logo_brand]'); ?>
</section>
<!-- Swiper JS CDN -->
<?php add_action('wp_footer', function () { ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll to explore
    const scrollToExplore = document.querySelector('.hn-tasmania-scroll-to-explore');
    if (scrollToExplore) {
        scrollToExplore.addEventListener('click', function() {
            const targetSection = document.querySelector('.hn-tasmania-bds-term');
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }

    // Initialize Swiper cho mỗi term grid (dynamic)
    const swipers = document.querySelectorAll('.hn-tasmania-bds-term-swiper');
    swipers.forEach(function(swiperEl, index) {
        new Swiper(swiperEl, {
            slidesPerView: 1, // Mặc định 1
            spaceBetween: 20, // Gap giữa slides
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1200: {
                    slidesPerView: 3,
                }
            },
            // Không pagination
            pagination: {
                el: null, // Tắt pagination
            },
            // Tùy chọn navigation nếu cần (comment nếu không dùng)
            // navigation: {
            //     nextEl: '.swiper-button-next',
            //     prevEl: '.swiper-button-prev',
            // },
            // Loop nếu ít slides
            loop: true,
            // Tự động play nếu cần
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    });
});
</script>
<?php }, 99); ?>

<?php get_footer(); ?>