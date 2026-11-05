<?php
/*
Template Name: Tin tức & Danh mục tin tức
*/
get_header();

if ( is_category() ) {
    $term          = get_queried_object();
    $page_title    = $term->name;
    $category_id   = $term->term_id;
    $category_slug = $term->slug;
} else {
    $page_title    = 'Tin tức';
    $category_id   = 0;
    $category_slug = 'all';
}
?>

<!-- ===== START SECTION BREADCRUMB ===== -->
<section class="mbland_tintucTemplate_breadcrumb">
    <div class="container">
        <div class="mbland_tintucTemplate_breadcrumb_wrapper">
            <?php echo do_shortcode('[hn_breadcrumb]'); ?>
        </div>
    </div>
</section>
<!-- ===== END SECTION BREADCRUMB ===== -->

<!-- ===== START SECTION POST ===== -->
<section class="mbland_tintucTemplate_post">
    <div class="container">
        <div class="mbland_tintucTemplate_post_wrapper">
            
            <!-- 1. Tin nổi bật (Featured Post) -->
            <div class="mbland_tintucTemplate_post_featuredPost">
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
                        $featured_img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        if ( ! $featured_img ) {
                            $featured_img = get_template_directory_uri() . '/images/default.jpg';
                        }
                        $desc = get_field( 'mo_ta_ngan_tin_tuc', get_the_ID() );
                        $has_tin_noi_bat = has_term( '', 'tin-noi-bat' );
                ?>
                <article class="mbland_tintucTemplate_featuredCard">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="mbland_tintucTemplate_featuredCard_thumb">
                        <img class="mbland_tintucTemplate_featuredCard_img" src="<?php echo esc_url( $featured_img ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" fetchpriority="low" />
                    </a>								
                    <div class="mbland_tintucTemplate_featuredCard_content">
                        <div class="mbland_tintucTemplate_featuredCard_meta">
                            <span class="mbland_tintucTemplate_featuredCard_metaIcon">
                                <img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng" loading="lazy" decoding="async" fetchpriority="low" />
                            </span>
                            <span class="mbland_tintucTemplate_featuredCard_date"><?php echo get_the_date( 'd/m/Y' ); ?></span>
                            <?php if ( $has_tin_noi_bat ) : ?>
                                <span class="mbland_tintucTemplate_featuredCard_metaDivider"></span>
                                <span class="mbland_tintucTemplate_featuredCard_badge"><?php echo function_exists('pll__') ? pll__('TIN NỔI BẬT') : 'TIN NỔI BẬT'; ?></span>
                            <?php endif; ?>
                        </div>
                        <h2 class="mbland_tintucTemplate_featuredCard_title">
                            <a href="<?php the_permalink(); ?>" class="mbland_tintucTemplate_featuredCard_titleLink" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <div class="mbland_tintucTemplate_featuredCard_desc"><?php echo wp_kses_post( $desc ? $desc : get_the_excerpt() ); ?></div>

						<div  class="mbland_tintucTemplate_featuredCard_author">
							<img  class="mbland_tintucTemplate_featuredCard_authorImage" src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ) ); ?>" alt="<?php the_author(); ?>" title="<?php the_author(); ?>" loading="lazy" decoding="async" fetchpriority="low" />
							<p class="mbland_tintucTemplate_featuredCard_authorName"><?php the_author(); ?></p>
						</div>

                        <a class="mbland_tintucTemplate_featuredCard_cta" href="<?php the_permalink(); ?>" title="Xem chi tiết">
							<span class="mbland_tintucTemplate_featuredCard_ctaLabel"><?php echo function_exists('pll__') ? pll__('XEM CHI TIẾT') : 'XEM CHI TIẾT'; ?></span>
                            <span class="mbland_tintucTemplate_featuredCard_ctaIcon">
                                <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="32" height="32" rx="16" fill="#f0d5d9"/><g clip-path="url(#a)"><path d="m22.163 19.984-.026-9.847-9.846-.025a.724.724 0 1 0 .01 1.43l7.379.031-9.775 9.776a.723.723 0 1 0 1.022 1.021l9.775-9.775.03 7.379a.723.723 0 0 0 1.446-.005z" fill="#b70c2c"/></g><defs><clipPath id="a"><path fill="#fff" d="M6 6h20v20H6z"/></clipPath></defs></svg>
                            </span>
                        </a>
                    </div>
                </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <!-- 2. Tin mới (New Post) -->
            <div class="mbland_tintucTemplate_post_newPost">
				<header class="mbland_tintucTemplate_post_newPostHeader">
					<h2 class="mbland_tintucTemplate_post_newPostTitle">Tin tức mới</h2>
					<span class="mbland_tintucTemplate_post_newPostLine"></span>
				</header>
                <div class="mbland_tintucTemplate_newPost_list">
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
                            $featured_img = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
                            if ( ! $featured_img ) {
                                $featured_img = get_template_directory_uri() . '/images/default.jpg';
                            }
                            $desc = get_field( 'mo_ta_ngan_tin_tuc', get_the_ID() );
                    ?>
                    <article class="mbland_tintucTemplate_newCard">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="mbland_tintucTemplate_newCard_thumb">
                            <img class="mbland_tintucTemplate_newCard_img" src="<?php echo esc_url( $featured_img ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" fetchpriority="low" />
                        </a>
                        <div class="mbland_tintucTemplate_newCard_content">
                            <div class="mbland_tintucTemplate_newCard_meta">
                                <span class="mbland_tintucTemplate_newCard_metaIcon">
                                    <img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng" loading="lazy" decoding="async" fetchpriority="low" />
                                </span>
                                <span class="mbland_tintucTemplate_newCard_date"><?php echo get_the_date( 'd/m/Y' ); ?></span>
                                <span class="mbland_tintucTemplate_newCard_metaDivider"></span>
                                <span class="mbland_tintucTemplate_newCard_badge"><?php echo function_exists('pll__') ? pll__('TIN MỚI') : 'TIN MỚI'; ?></span>
                            </div>
                            <h3 class="mbland_tintucTemplate_newCard_title">
                                <a href="<?php the_permalink(); ?>" class="mbland_tintucTemplate_newCard_titleLink" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <div class="mbland_tintucTemplate_newCard_desc"><?php echo wp_kses_post( $desc ? $desc : get_the_excerpt() ); ?></div>

							<div  class="mbland_tintucTemplate_newCard_author">
								<img  class="mbland_tintucTemplate_newCard_authorImage" src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ) ); ?>" alt="<?php the_author(); ?>" title="<?php the_author(); ?>" loading="lazy" decoding="async" fetchpriority="low" />
								<p class="mbland_tintucTemplate_newCard_authorName"><?php the_author(); ?></p>
							</div>

                            <a class="mbland_tintucTemplate_newCard_cta" href="<?php the_permalink(); ?>" title="Xem chi tiết">
								<span class="mbland_tintucTemplate_newCard_ctaLabel"><?php echo function_exists('pll__') ? pll__('XEM CHI TIẾT') : 'XEM CHI TIẾT'; ?></span>
                                <span class="mbland_tintucTemplate_newCard_ctaIcon">
                                    <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="32" height="32" rx="16" fill="#f0d5d9"/><g clip-path="url(#a)"><path d="m22.163 19.984-.026-9.847-9.846-.025a.724.724 0 1 0 .01 1.43l7.379.031-9.775 9.776a.723.723 0 1 0 1.022 1.021l9.775-9.775.03 7.379a.723.723 0 0 0 1.446-.005z" fill="#b70c2c"/></g><defs><clipPath id="a"><path fill="#fff" d="M6 6h20v20H6z"/></clipPath></defs></svg>

                                </span>
                            </a>
                        </div>
                    </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>

            <!-- 3. Danh sách bài viết & Danh mục & Phân trang (List Post) -->
            <div class="mbland_tintucTemplate_post_listPost">
                
                <!-- Danh mục lọc -->
                <ul class="mbland_tintucTemplate_post_listPostCategories">
                    <li class="mbland_tintucTemplate_post_listPostCategoriesItem">
                        <a href="<?php echo esc_url( home_url('/tin-tuc/') ); ?>" class="mbland_tintucTemplate_post_listPostCategoriesLink <?php echo ( $category_id === 0 ) ? 'active' : ''; ?>">
                            <?php echo function_exists('pll__') ? pll__('Tất cả') : 'Tất cả'; ?>
                        </a>
                    </li>
                    <?php
                    $all_categories = get_categories( array(
                        'hide_empty' => true,
                        'orderby'    => 'name',
                        'order'      => 'ASC',
                    ) );
                    if ( ! empty( $all_categories ) ) :
                        foreach ( $all_categories as $cat ) :
                            $is_active = ( $category_id === $cat->term_id ) ? 'active' : '';
                    ?>
                    <li class="mbland_tintucTemplate_post_listPostCategoriesItem">
                        <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="mbland_tintucTemplate_post_listPostCategoriesLink <?php echo esc_attr( $is_active ); ?>">
                            <?php echo esc_html( $cat->name ); ?>
                        </a>
                    </li>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </ul>

                <!-- Grid bài viết -->
                <div class="mbland_tintucTemplate_post_listPostGrid">
                    <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
                    $grid_args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 6,
                        'paged'          => $paged,
                        'post_status'    => 'publish',
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    );
                    if ( $category_id > 0 ) {
                        $grid_args['cat'] = $category_id;
                    }
                    $grid_query = new WP_Query( $grid_args );

                    if ( $grid_query->have_posts() ) :
                        while ( $grid_query->have_posts() ) : $grid_query->the_post();
                            $featured_img = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
                            if ( ! $featured_img ) {
                                $featured_img = get_template_directory_uri() . '/images/default.jpg';
                            }
                            $desc = get_field( 'mo_ta_ngan_tin_tuc', get_the_ID() );
                            $has_tin_noi_bat = has_term( '', 'tin-noi-bat' );
                    ?>
                    <article class="mbland_tintucTemplate_postCard">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="mbland_tintucTemplate_postCard_thumb">
                            <img class="mbland_tintucTemplate_postCard_img" src="<?php echo esc_url( $featured_img ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" fetchpriority="low" />
                        </a>
                        <div class="mbland_tintucTemplate_postCard_content">
                            <div class="mbland_tintucTemplate_postCard_meta">
                                <span class="mbland_tintucTemplate_postCard_metaIcon">
                                    <img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng" loading="lazy" decoding="async" fetchpriority="low" />
                                </span>
                                <span class="mbland_tintucTemplate_postCard_date"><?php echo get_the_date( 'd/m/Y' ); ?></span>
                                <?php if ( $has_tin_noi_bat ) : ?>
                                    <span class="mbland_tintucTemplate_postCard_metaDivider"></span>
                                    <span class="mbland_tintucTemplate_postCard_badge"><?php echo function_exists('pll__') ? pll__('TIN NỔI BẬT') : 'TIN NỔI BẬT'; ?></span>
                                <?php endif; ?>
                            </div>
                            <h3 class="mbland_tintucTemplate_postCard_title">
                                <a href="<?php the_permalink(); ?>" class="mbland_tintucTemplate_postCard_titleLink" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <div class="mbland_tintucTemplate_postCard_desc"><?php echo wp_kses_post( $desc ? $desc : get_the_excerpt() ); ?></div>
							<div  class="mbland_tintucTemplate_postCard_author">
								<img  class="mbland_tintucTemplate_postCard_authorImage" src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ) ); ?>" alt="<?php the_author(); ?>" title="<?php the_author(); ?>" loading="lazy" decoding="async" fetchpriority="low" />
								<p class="mbland_tintucTemplate_postCard_authorName"><?php the_author(); ?></p>
							</div>
                            <a class="mbland_tintucTemplate_postCard_cta" href="<?php the_permalink(); ?>" title="Xem chi tiết">
								<span class="mbland_tintucTemplate_postCard_ctaLabel"><?php echo function_exists('pll__') ? pll__('XEM CHI TIẾT') : 'XEM CHI TIẾT'; ?></span>
                                <span class="mbland_tintucTemplate_postCard_ctaIcon">
                                    <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="32" height="32" rx="16" fill="#f0d5d9"/><g clip-path="url(#a)"><path d="m22.163 19.984-.026-9.847-9.846-.025a.724.724 0 1 0 .01 1.43l7.379.031-9.775 9.776a.723.723 0 1 0 1.022 1.021l9.775-9.775.03 7.379a.723.723 0 0 0 1.446-.005z" fill="#b70c2c"/></g><defs><clipPath id="a"><path fill="#fff" d="M6 6h20v20H6z"/></clipPath></defs></svg>
                                </span>
                            </a>
                        </div>
                    </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p class="mbland_tintucTemplate_noPosts">' . ( function_exists('pll__') ? pll__('Chưa có bài viết nào.') : 'Chưa có bài viết nào.' ) . '</p>';
                    endif;
                    ?>
                </div>

                <!-- Phân trang (Pagination) -->
                <?php if ( $grid_query->max_num_pages > 1 ) : ?>
                <div class="mbland_tintucTemplate_post_listPostPagination">
                    <?php
                    $big = 999999999;
                    echo paginate_links( array(
                        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format'    => '?paged=%#%',
                        'current'   => max( 1, $paged ),
                        'total'     => $grid_query->max_num_pages,
                        'prev_text' => 'Trước',
                        'next_text' => 'Sau',
                        'type'      => 'list',
                    ) );
                    ?>
                </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</section>
<!-- ===== END SECTION POST ===== -->

<?php get_footer(); ?>
