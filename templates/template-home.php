<?php
/**
 * Template Name: Home EN
 */

get_header(); ?>
<section class="mbland_homepage_about">
        <div class="container">
          <h1 style="display: none">TASMANIA & PARTNERS</h1>
          <div class="mbland_homepage_about_title">
            <div class="mbland_homepage_about_titleFirst">
              <div class="mbland_homepage_about_titleImage">
				  <img src="/wp-content/uploads/2025/10/Chu-Tasmania-Partners-1.svg"
					   alt="Chữ Tasmania & Partners"
					   title="Chữ Tasmania & Partners" loading="eager" decoding="async" fetchpriority="high" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Chu-Tasmania-Partners-1.svg', 600, 120 ) ); ?> />
				</div>
              <a
                class="hn-tasmania-cta-btn mbland_homepage_about_titleCta"
                href="/about"
                title="DETAILED INFORMATION"
              >
                DETAILED INFORMATION
                <img
                  src="/wp-content/uploads/2025/10/arrow-right.svg"
                  alt="Arrow Right"
                  title="Arrow Right"
                  loading="eager"
                  decoding="async"
                  fetchpriority="auto"
                  width="15" height="15"
                />
              </a>
            </div>
            <div class="mbland_homepage_about_titleSecond">
              <div class="mbland_homepage_about_titleImage">
				  <img src="/wp-content/uploads/2025/10/Chu-Tasmania-Partners-2.svg"
					   alt="Chữ Tasmania & Partners"
					   title="Chữ Tasmania & Partners" loading="eager" decoding="async" fetchpriority="high" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Chu-Tasmania-Partners-2.svg', 600, 120 ) ); ?> />
				</div>
            </div>
          </div>
          <div class="mbland_homepage_about_desc">
            <div class="mbland_homepage_about_descIcon">
              <img
                src="/wp-content/uploads/2025/10/quote.svg"
                alt="Qoute Icon"
                title="Qoute Icon"
                loading="eager"
                decoding="async"
                fetchpriority="auto"
                width="21" height="15"
              />
            </div>
            <span class="mbland_homepage_about_descTitle">Fairness – Compassion – Wisdom – Trustworthiness</span>
            <p>
              We are building a strong foundation to achieve our mission — delivering exceptional products, being a trusted and sustainable partner, and acting as a responsible business.
            </p>
          </div>
          <div class="mbland_homepage_about_scrollToExplore">
            <img
              src="/wp-content/uploads/2025/10/explore.svg"
              alt="Scroll to explore"
              title="Scroll to explore"
              loading="eager"
              decoding="async"
              fetchpriority="auto"
              width="405" height="309"
            />
          </div>
        </div>
        <div class="mbland_homepage_about_banner">
          <img
            src="/wp-content/uploads/2025/10/about-banner.png"
            alt="About banner"
            title="About banner"
            loading="lazy"
            decoding="async"
            fetchpriority="low"
            <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/about-banner.png', 1920, 700 ) ); ?>
          />
        </div>
      </section>
      <section class="mbland_homepage_info">
        <div class="mbland_homepage_info_marquee">
          <p>TASMANIA & PARTNERS</p>
          <p>TASMANIA & PARTNERS</p>
          <p>TASMANIA & PARTNERS</p>
        </div>
        <div class="container">
          <div class="mbland_homepage_info_title">
            <img
              src="/wp-content/uploads/2025/10/Ten-year.png"
              alt="Mười năm hành trình"
              title="Mười năm hành trình"
              loading="lazy"
              decoding="async"
              fetchpriority="low"
              <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Ten-year.png', 600, 600 ) ); ?>
            />
          </div>
          <p class="mbland_homepage_info_desc">
            Founded in 2015, Tasmania & Partners is a diversified corporation with investments in Finance, Real Estate, and Tourism. Through its subsidiaries and affiliates - MBland Holdings, F&S Investment, Tonkin Properties, and Golden Field - the Group has developed major projects across Da Nang, Hoi An, Quang Ngai, Hanoi, Quang Ninh, Nha Trang, and Ho Chi Minh City.
          </p>
          <div class="mbland_homepage_info_cta">
            <a
              class="hn-tasmania-cta-btn mbland_homepage_info_ctaPrimary"
              href="/about"
              title="Discover the Story Behind Us"
            >
              Discover Our Story
              <img
                src="/wp-content/uploads/2025/10/arrow-right.svg"
                alt="Arrow Right"
                title="Arrow Right"
                loading="lazy"
                decoding="async"
                fetchpriority="low"
                width="15" height="15"
              />
            </a>
            <a
              class="hn-tasmania-cta-btn mbland_homepage_info_ctaOutline"
              href="/linh-vuc/real-estate"
              title="BUSINESS FIELD"
            >
              BUSINESS FIELD
            </a>
          </div>
        </div>
      </section>
      <section class="mbland_homepage_branches">
    <?php
		  $desired_order = ['real-estate', 'hospitality', 'commercial'];
    
    // Sort sub_terms by the desired order using slugs
   
    $branches_terms = get_terms( array(
        'taxonomy'   => 'linh-vuc',
        'hide_empty' => false,
        'parent'     => 0, // Chỉ terms cha
        'number'     => 3, // Giới hạn số lượng
        'orderby'    => 'name', // Sắp xếp theo tên
        'order'      => 'ASC',
    ) );
	 usort($branches_terms, function($a, $b) use ($desired_order) {
        $pos_a = array_search($a->slug, $desired_order);
        $pos_b = array_search($b->slug, $desired_order);
        $pos_a = $pos_a === false ? count($desired_order) : $pos_a;
        $pos_b = $pos_b === false ? count($desired_order) : $pos_b;
        return $pos_a - $pos_b;
    });
    if ( ! empty( $branches_terms ) && ! is_wp_error( $branches_terms ) ) :
        $branch_index = 1; // Số thứ tự từ 1
        foreach ( $branches_terms as $index => $term ) :
            $is_active = ( $index === 0 ) ? ' mbland_homepage_branches_itemActive' : ''; // Item đầu active
            // Lấy featured image từ SCF field group (thay 'featured_image' bằng slug thực tế)
            $scf_image = get_field( 'feature_image', 'term_' . $term->term_id ) ?? []; // Sử dụng 'term_' . term_id cho taxonomy terms
			$featured_image_url = !empty( $scf_image ) ? $scf_image['url'] : false; // Lấy URL từ array ACF Image field
            $term_link = get_term_link( $term ); // Nếu cần link
    ?>
    <div class="mbland_homepage_branches_item<?php echo esc_attr( $is_active ); ?>">
		
        <div class="mbland_homepage_branches_card">
			<a href="<?php echo esc_url( $term_link ); ?>" class="mbland_homepage_branches_link" title="<?php echo esc_attr( $term->name ); ?>">
				<div class="mbland_homepage_branches_arrow">
					<img
						src="/wp-content/uploads/2025/10/arrow-right.svg"
						alt="Arrow Up Right"
						title="Arrow Up Right"
						loading="lazy"
						decoding="async"
						fetchpriority="low"
						width="15" height="15"
					/>
				</div>
				<p class="mbland_homepage_branches_number"><?php echo sprintf( '%02d', $branch_index ); ?></p>
				<div class="mbland_homepage_branches_info">
					<p>BUSINESS FIELD</p>
					<h2 class="equalh3"><?php echo esc_html( $term->name ); ?></h2>
				</div>
			</a>
        </div>

        <div class="mbland_homepage_branches_media">
            <?php if ( $featured_image_url ) : ?>
                <img
                    src="<?php echo esc_url( $featured_image_url ); ?>"
                    alt="<?php echo esc_attr( $term->name ); ?>"
                    title="<?php echo esc_attr( $term->name ); ?>"
                    loading="lazy"
                    decoding="async"
                    fetchpriority="low"
                    <?php echo trim( mbland_img_size_attr( $featured_image_url, 800, 550 ) ); ?>
                />
            <?php else : ?>
                <!-- Fallback: Hình mặc định nếu chưa set field -->
                <img
                    src="/wp-content/uploads/2025/10/branch-placeholder.jpg"
                    alt="<?php echo esc_attr( $term->name ); ?>"
                    title="<?php echo esc_attr( $term->name ); ?>"
                    loading="lazy"
                    decoding="async"
                    fetchpriority="low"
                    width="800" height="550"
                />
            <?php endif; ?>
            <h2 class="equalh3 mbland_homepage_branches_caption"><?php echo esc_html( $term->name ); ?></h2>
        </div>
    </div>
    <?php
            $branch_index++;
        endforeach;
    else :
        // Fallback nếu chưa có terms: Hiển thị thông báo hoặc hard-coded tạm thời
        echo '<p>Chưa có lĩnh vực hoạt động nào. Vui lòng tạo terms trong Admin > Lĩnh vực hoạt động.</p>';
        // Hoặc paste HTML gốc 3 items nếu cần
    endif;
    ?>
</section>
<section class="mbland_homepage_activities">
  <div class="container">
    <div class="mbland_homepage_activities_slider">
      <div class="swiper mbland_homepage_activities_swiper">
        <div class="swiper-wrapper">
          <?php
			// Lấy taxonomy terms nếu cần, nhưng ở đây query tất cả posts thuộc taxonomy 'tin-noi-bat'
			$activities_query = new WP_Query( array(
				'post_type'      => 'post',
				'posts_per_page' => 6,
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'tax_query'      => array(
					array(
						'taxonomy' => 'tin-noi-bat',
						'field'    => 'slug',      // Hoặc 'slug' nếu dùng slug
                		'terms'    => 'featured-news',
						'operator' => 'IN',
					),
				),
			) );

			if ( $activities_query->have_posts() ) :
				while ( $activities_query->have_posts() ) : $activities_query->the_post();
					$featured_img = get_the_post_thumbnail_url( get_the_ID() );
					if ( ! $featured_img ) {
						$featured_img = get_template_directory_uri() . '/images/default-activity.jpg';
					}
			?>
                  <div class="swiper-slide mbland_homepage_activities_slide">
                    <div class="mbland_homepage_activities_slideImage">
                      <img
                        src="<?php echo esc_url( $featured_img ); ?>"
                        alt="<?php echo esc_attr( get_the_title() ); ?>"
                        title="<?php echo esc_attr( get_the_title() ); ?>"
                        loading="lazy"
                        decoding="async"
                        fetchpriority="low"
                        <?php echo trim( mbland_img_size_attr( $featured_img, 768, 512 ) ); ?>
                      />
                    </div>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                      <h3 class="small-h3"><?php the_title(); ?></h3>
                    </a>
                  </div>
          <?php
              endwhile;
              wp_reset_postdata();
          else :
              echo '<p>Chưa có hoạt động nào.</p>';
          endif;
          ?>
        </div>
      </div>
    </div>

    <div class="mbland_homepage_activities_content">
      <h2>Activities & Events</h2>
      <p class="mbland_homepage_activities_desc">
        Established in 2015, Tasmania & Partners is a multi-industry corporation that leads numerous domestic and international projects in the fields of Finance, Real Estate, and Tourism and Hospitality.
      </p>
      <a
        class="hn-tasmania-cta-btn mbland_homepage_activities_cta"
        href="/news"
        title="All news"
      >
        All News
        <img
          src="/wp-content/uploads/2025/10/arrow-right.svg"
          alt="Arrow Right"
          title="Arrow Right"
          loading="lazy"
          decoding="async"
          fetchpriority="low"
          width="15" height="15"
        />
      </a>
    </div>
  </div>
</section>

<section class="mbland_homepage_projects">
  <div class="container">
    <div class="mbland_homepage_projects_heading">
      <div class="mbland_homepage_projects_title">
        <h2>Highlight Projects</h2>
        <p>
          Tasmania & Partners is a diversified corporation with a portfolio of outstanding projects developed throughout its growth journey.
        </p>
      </div>
      <a
        class="hn-tasmania-cta-btn"
        href="/linh-vuc/real-estate"
        aria-label="View all"
        title="View all"
      >
        View all
        <img
          src="/wp-content/uploads/2025/10/arrow-right.svg"
          alt="Arrow Right"
          title="Arrow Right"
          loading="lazy"
          decoding="async"
          fetchpriority="low"
          width="15" height="15"
        />
      </a>
    </div>

    <div class="mbland_homepage_projects_wrapper">
      <?php
      $du_an_query = new WP_Query([
        'post_type'      => 'du-an',
        'posts_per_page' => 6,
        'tax_query'      => [
          [
            'taxonomy' => 'du-an-noi-bat',
            'field'    => 'slug',
            'terms'    => ['featured-projects'],
          ],
        ],
      ]);

      if ( $du_an_query->have_posts() ) :
        $i = 1; // đếm thứ tự để thêm class item1, item2,...
        while ( $du_an_query->have_posts() ) : $du_an_query->the_post();
          $banner_field = get_field('banner'); // Lấy field banner (ACF)
		$item_title = get_the_title();
	$item_sub_title = wp_kses_post( get_field('sub_title'));
    $item_mo_ta = wp_kses_post( get_field( 'short_content' )  );
    $item_dia_chi = wp_kses_post( get_field( 'location' ));
          $thumb = !empty($banner_field) ? $banner_field['url'] : get_the_post_thumbnail_url( get_the_ID() );
          $thumb = $thumb ?: '/wp-content/uploads/2025/10/branch-placeholder.jpg'; // ảnh fallback
      ?>
        <div class="mbland_homepage_projects_item mbland_homepage_projects_item<?php echo $i; ?>">
          <div class="mbland_homepage_projects_itemImage">
            <img
              src="<?php echo esc_url( $thumb ); ?>"
              alt="<?php the_title_attribute(); ?>"
              title="<?php the_title_attribute(); ?>"
              loading="lazy"
              decoding="async"
              fetchpriority="low"
              <?php echo trim( mbland_img_size_attr( $thumb, 600, 350 ) ); ?>
            />
          </div>
          <div class="mbland_homepage_projects_itemContent">
			  <div class="mbland_homepage_projects_itemContent1">
				  
			  </div>
			  <div class="mbland_homepage_projects_itemContent2">
				  <a href="<?php the_permalink(); ?>" title="<?php echo $item_title ?>">
				  	<h3 class="small-h3"><?php echo $item_title ?></h3>
					</a>
				  <div class="mbland_homepage_projects_itemContentLocation">
					  <img src="/wp-content/uploads/2025/10/location.svg" alt="Vị trí" title="Vị trí" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/location.svg', 24, 24 ) ); ?> />
					  <div>
						  <?php echo $item_dia_chi?>
					  </div>
				  </div>
			  	
				  <a href="<?php the_permalink(); ?>" title="<?php echo $item_title ?>" class="mbland_homepage_projects_viewDetail">
				  	View detail
					</a>
			  </div>
          </div>
        </div>
      <?php
          $i++;
        endwhile;
        wp_reset_postdata();
      else :
        echo '<p>Have no special project yet.</p>';
      endif;
      ?>
    </div>
  </div>
  <?php echo do_shortcode('[logo_brand]'); ?>
</section>
<?php get_footer();?>