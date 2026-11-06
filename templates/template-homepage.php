<?php
/**
 * Template Name: Trang chủ
 */

get_header(); ?>
<!-- ===== START SECTION ABOUT ===== -->
<section class="mbland_homepage_about">
	<div class="container">
		<h1 style="display: none">TASMANIA & PARTNERS</h1>
		<div class="mbland_homepage_about_title">
			<div class="mbland_homepage_about_titleFirst">
				<div class="mbland_homepage_about_titleImage">
					MBLAND
				</div>
				<?php
				get_template_part( 'template-parts/ui/button', null, array(
					'url'   => '/gioi-thieu',
					'label' => 'Kết nối hợp tác ngay!',
					'class' => 'mbland_homepage_about_titleCta',
					'loading' => 'eager', // icon nam trong hero (above the fold)
					'title' => 'Thông tin chi tiết',
				) );
				?>
			</div>
			<div class="mbland_homepage_about_titleSecond">
				ASSET MANAGEMENT
			</div>
		</div>
		<div class="mbland_homepage_about_desc">
			<div class="mbland_homepage_about_descIcon">
				<img loading="eager" decoding="async"
					 src="/wp-content/uploads/2025/10/quote.svg"
					 alt="Qoute Icon"
					 title="Qoute Icon"
					 width="21"
					 height="15"
					 />
			</div>
			<span class="mbland_homepage_about_descTitle">Công - Tâm - Trí - Tín</span>
			<p>
				Chúng tôi đang dần tạo nên một nền tảng vững chắc để hoàn thành Sứ
				mệnh: Cam kết những sản phẩm tốt nhất, đặc sắc nhất; là đối tác
				tin cậy và phát triển bền vững; Là doanh nghiệp có Trách nhiệm.
			</p>
		</div>
		<div class="mbland_homepage_about_scrollToExplore">
			<img loading="eager" decoding="async"
				 src="/wp-content/uploads/2025/10/explore.svg"
				 alt="Scroll to explore"
				 title="Scroll to explore"
				 width="405"
				 height="309"
				 />
		</div>
	</div>
	<div class="mbland_homepage_about_banner">
		<img loading="eager" decoding="async" fetchpriority="high"
			 src="/wp-content/uploads/2026/11/hero_mbland.jpg"
			 alt="Hero MBLand"
			 title="Hero MBLand"
			 width="2559"
			 height="1007"
			 />
	</div>
</section>
<!-- ===== END SECTION ABOUT ===== -->





<!-- ===== START SECTION INFO ===== -->
<section class="mbland_homepage_info">
	<div class="mbland_homepage_info_marquee">
		<div class="mbland_homepage_info_marqueeItem">
<p>MBLAND ASSET MANAGEMENT</p>
		<p>MBLAND ASSET MANAGEMENT</p>
		<p>MBLAND ASSET MANAGEMENT</p>
		<p>MBLAND ASSET MANAGEMENT</p>
</div>
	</div>
	<div class="container">
		<div class="mbland_homepage_info_title">
			<p class="mbland_homepage_info_titleNumber">10</p>
			<div class="mbland_homepage_info_titleGroup">
				<p class="mbland_homepage_info_titlePlus">+</p>
				<div class="mbland_homepage_info_titleContent">
					<p class="mbland_homepage_info_titleUnit">Năm</p>
					<p class="mbland_homepage_info_titleLabel"><span class="mbland_homepage_info_titleText">Hành Trình</span><span class="mbland_homepage_info_titleYear">2015 </span></p>
				</div>
			</div>
		</div>
		<p class="mbland_homepage_info_desc">
			Được thành lập vào năm 2015, MBLand Asset Management là tập đoàn đa ngành, đã và đang đầu tư một số dự án trong và ngoài nước thuộc lĩnh vực Tài chính - Bất động sản - Du lịch Dịch vụ dưới thương hiệu của một số Công ty con - Công ty liên kết như MBland Holdings, F&S Investment, Tonkin Properties, Golden Field,.. với các dự án trọng điểm tại Đà Nẵng, Hội An, Quảng Ngãi, Hà Nội, Quảng Ninh, Nha Trang, Tp Hồ Chí Minh,...
		</p>
		<div class="mbland_homepage_info_cta">
			
      <?php 
      get_template_part( 'template-parts/ui/button', null, array(
    'url'   => '/gioi-thieu',
    'label' => 'KHÁM PHÁ VỀ CHÚNG TÔI',
    'class' => 'mbland_homepage_info_ctaPrimary',
    'title' => 'KHÁM PHÁ VỀ CHÚNG TÔI',
) );
      ?>
			<a
			   class="hn-tasmania-cta-btn mbland_homepage_info_ctaOutline"
			   href="/linh-vuc/bat-dong-san"
			   title="Lĩnh vực hoạt động"
			   >
				LĨNH VỰC HOẠT ĐỘNG
			</a>
		</div>
	</div>
</section>
<!-- ===== END SECTION INFO ===== -->





<!-- ==== START SECTION COMPANY ==== -->
<section class="mbland_homepage_company">
  <div class="container">
    <div class="mbland_homepage_company_wrapper mbland_homepage_company_introWrapper">
      <div class="mbland_homepage_company_media mbland_homepage_company_introMedia">
        <img loading="lazy" decoding="async" fetchpriority="low"
          class="mbland_homepage_company_image mbland_homepage_company_introImage"
          src="/wp-content/uploads/2026/11/gioi-thieu-cong-ty-cua-chung-toi-image-1.jpg"
          alt="Giới thiệu về công ty chúng tôi"
          title="Giới thiệu về công ty chúng tôi"
          width="1634"
          height="919"
        />
      </div>
      <div class="mbland_homepage_company_body mbland_homepage_company_introBody">
        <header class="mbland_homepage_company_introHeader">
          <h2 class="mbland_homepage_company_introTitle">Giới thiệu về công ty chúng tôi</h2>
        </header>
        <div class="mbland_homepage_company_introContent">
          <div class="mbland_homepage_company_introBrand">
            <p class="mbland_homepage_company_introBrandName">Công ty Cổ Phần TẬP ĐOÀN</p>
            <img loading="lazy" decoding="async" fetchpriority="low"
              class="mbland_homepage_company_introBrandLogo"
              src="/wp-content/uploads/2026/11/logo_mbland-asset-management.png"
              alt="MBLand Asset Management"
              title="MBLand Asset Management"
              width="1408"
              height="104"
            />
          </div>
          <p class="mbland_homepage_company_introDesc">
            Tập đoàn đầu tư đa ngành được thành lập năm 2015, hoạt động trong ba lĩnh vực trọng tâm: Tài chính, Bất động sản và Du lịch – Dịch vụ. Với định hướng phát triển bền vững, lấy uy tín và chất lượng làm nền tảng, Tasmania & Partners không ngừng mở rộng hệ sinh thái đầu tư, kết nối các đối tác trong nước và quốc tế, hướng đến kiến tạo những giá trị lâu dài cho khách hàng, đối tác và cộng đồng.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="mbland_homepage_company_showcase">
    <div class="container">
      <div class="mbland_homepage_company_wrapper mbland_homepage_company_showcaseWrapper">
        <div class="mbland_homepage_company_media mbland_homepage_company_showcaseMedia"></div>
        <div class="mbland_homepage_company_body mbland_homepage_company_showcaseBody">
			<img loading="lazy" decoding="async" fetchpriority="low"
            class="mbland_homepage_company_image mbland_homepage_company_showcaseImage"
            src="/wp-content/uploads/2026/11/gioi-thieu-cong-ty-cua-chung-toi-image-2.jpg"
            alt="Giới thiệu về công ty chúng tôi"
            title="Giới thiệu về công ty chúng tôi"
            width="1553"
            height="1036"
          />
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ==== END SECTION COMPANY ==== -->





<!-- ===== START SECTION BRANCHES ===== -->
<section class="mbland_homepage_branches">
  <div class="container">
    <header class="mbland_homepage_branches_header">
      <h2 class="mbland_homepage_branches_title">Lĩnh vực hoạt động</h2>
      <p class="mbland_homepage_branches_desc">Với hệ sinh thái đầu tư đa ngành, MBLand Asset Management tập trung phát triển các lĩnh vực chiến lược, tạo dựng giá trị bền vững và mở rộng cơ hội hợp tác trong nước và quốc tế.</p>
      <?php 
      get_template_part( 'template-parts/ui/button', null, array(
    'url'   => '/#',
    'label' => 'Tìm hiểu thêm',
    'class' => 'mbland_homepage_branches_btn',
    'title' => 'Thông tin chi tiết',
) );
      ?>
    </header>

  </div>

  <div class="mbland_homepage_branches_list">
	<?php
	$branches_terms = get_terms( array(
		'taxonomy'   => 'linh-vuc',
		'hide_empty' => false,
		'parent'     => 0, // Chỉ terms cha
		'number'     => 3, // Giới hạn số lượng
		'orderby'    => 'name', // Sắp xếp theo tên
		'order'      => 'ASC',
	) );
	$desired_order = ['bat-dong-san', 'dich-vu-du-lich', 'dau-tu-tai-chinh'];
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
	$branch_w = ! empty( $scf_image['width'] ) ? $scf_image['width'] : 800;
	$branch_h = ! empty( $scf_image['height'] ) ? $scf_image['height'] : 550;
	$term_link = get_term_link( $term ); // Nếu cần link
	?>
	<div class="mbland_homepage_branches_item<?php echo esc_attr( $is_active ); ?>">

		<div class="mbland_homepage_branches_card">
			<a href="<?php echo esc_url( $term_link ); ?>" class="mbland_homepage_branches_link" title="<?php echo esc_attr( $term->name ); ?>">
				<div class="mbland_homepage_branches_arrow">
					<img loading="lazy" decoding="async" fetchpriority="low"
						 class="mbland_homepage_branches_icon"
						 src="/wp-content/uploads/2025/10/arrow-right.svg"
						 alt="Arrow Up Right"
						 title="Arrow Up Right"
						 width="15"
						 height="15"
						 />
				</div>
				<p class="mbland_homepage_branches_number"><?php echo sprintf( '%02d', $branch_index ); ?></p>
				<div class="mbland_homepage_branches_info">
					<p class="mbland_homepage_branches_label">Lĩnh vực hoạt động</p>
					<h3 class="equalh3 mbland_homepage_branches_name"><?php echo esc_html( $term->name ); ?></h3>
				</div>
			</a>
		</div>

		<div class="mbland_homepage_branches_media">
			<?php if ( $featured_image_url ) : ?>
			<img loading="lazy" decoding="async" fetchpriority="low"
				 class="mbland_homepage_branches_image"
				 src="<?php echo esc_url( $featured_image_url ); ?>"
				 alt="<?php echo esc_attr( $term->name ); ?>"
				 title="<?php echo esc_attr( $term->name ); ?>"
				 width="<?php echo esc_attr( $branch_w ); ?>"
				 height="<?php echo esc_attr( $branch_h ); ?>"
				 />
			<?php else : ?>
			<!-- Fallback: Hình mặc định nếu chưa set field -->
			<img loading="lazy" decoding="async" fetchpriority="low"
				 class="mbland_homepage_branches_image"
				 src="/wp-content/uploads/2025/10/branch-placeholder.jpg"
			alt="<?php echo esc_attr( $term->name ); ?>"
			title="<?php echo esc_attr( $term->name ); ?>"
			width="800"
			height="550"
			/>
			<?php endif; ?>
			<p class="equalh3 mbland_homepage_branches_caption"><?php echo esc_html( $term->name ); ?></p>
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
  </div>
</section>
<!-- ===== END SECTION BRANCHES ===== -->





<?php get_template_part( 'template-parts/sections/brands' ); ?>







<!-- ===== START SECTION PROJECTS ===== -->
<section class="mbland_homepage_projects">
	<div class="container">
		<div class="mbland_homepage_projects_heading">
			<div class="mbland_homepage_projects_title">
				<h2>Dự án nổi bật</h2>
				<p>
					MBLand Asset Management là tập đoàn đa ngành với những dự án nổi bật trong suốt quá trình phát triển
				</p>
			</div>
      <?php 
      get_template_part( 'template-parts/ui/button', null, array(
    'url'   => '/linh-vuc/bat-dong-san',
    'label' => 'Xem thêm dự án',
    'class' => 'mbland_homepage_projects_button',
    'title' => 'Xem thêm dự án',
) );
      ?>
			
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
						'terms'    => ['du-an-noi-bat'],
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
			$thumb = '';
			$thumb_w = 0;
			$thumb_h = 0;
			if ( is_array( $banner_field ) ) {
				$thumb = ! empty( $banner_field['url'] ) ? $banner_field['url'] : '';
				$thumb_w = ! empty( $banner_field['width'] ) ? $banner_field['width'] : 0;
				$thumb_h = ! empty( $banner_field['height'] ) ? $banner_field['height'] : 0;
			} elseif ( is_numeric( $banner_field ) ) {
				$banner_img_data = wp_get_attachment_image_src( $banner_field, 'full' );
				if ( ! empty( $banner_img_data ) ) {
					$thumb = $banner_img_data[0];
					$thumb_w = $banner_img_data[1];
					$thumb_h = $banner_img_data[2];
				}
			} elseif ( is_string( $banner_field ) && ! empty( $banner_field ) ) {
				$thumb = $banner_field;
			}

			if ( empty( $thumb ) ) {
				$thumb = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			}

			if ( ( ! $thumb_w || ! $thumb_h ) && has_post_thumbnail() ) {
				$post_thumb_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if ( ! empty( $post_thumb_data ) ) {
					$thumb_w = $post_thumb_data[1];
					$thumb_h = $post_thumb_data[2];
				}
			}

			$thumb = $thumb ?: '/wp-content/uploads/2025/10/branch-placeholder.jpg'; // ảnh fallback
			$thumb_w = $thumb_w ?: 600;
			$thumb_h = $thumb_h ?: 350;
			?>
			<div class="mbland_homepage_projects_item mbland_homepage_projects_item<?php echo $i; ?>">
				<div class="mbland_homepage_projects_itemImage">
					<img loading="lazy" decoding="async" fetchpriority="low"
						 src="<?php echo esc_url( $thumb ); ?>"
						 alt="<?php the_title_attribute(); ?>"
						 title="<?php the_title_attribute(); ?>"
						 width="<?php echo esc_attr( $thumb_w ); ?>"
						 height="<?php echo esc_attr( $thumb_h ); ?>"
						 />
				</div>
				<div class="mbland_homepage_projects_itemContent">
					<div class="mbland_homepage_projects_itemContent1">

					</div>
					<div class="mbland_homepage_projects_itemContent2">
						
							<h3 class="small-h3"><a href="<?php the_permalink(); ?>" title="<?php echo $item_title ?>"><?php echo $item_title ?></a></h3>
						
						

						
						<?php
						get_template_part( 'template-parts/ui/button', null, array(
							'url'   => get_permalink(),
							'label' => '',
							'class' => 'mbland_homepage_projects_viewDetail',
							'title' => the_title_attribute( array( 'echo' => false ) ),
						) );
						?>
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
	
</section>
<!-- ===== END SECTION PROJECTS ===== -->





<!-- ===== START SECTION ACTIVITIES ===== -->
<section class="mbland_homepage_activities">
	<div class="container">
		<div class="mbland_homepage_activities_wrapper">
      <div class="mbland_homepage_activities_content">
			<div class="mbland_homepage_activities_heading">
        <h2  class="mbland_homepage_activities_title">Hoạt động & Sự kiện</h2>
			<p class="mbland_homepage_activities_desc">
				Được thành lập vào năm 2015, MBLand Asset Management là tập đoàn đa ngành, đã và đang đầu tư một số dự án trong và ngoài nước thuộc lĩnh vực Tài chính - Bất động sản - Du lịch Dịch vụ.
			</p>
      </div>
			
      <?php 
      get_template_part( 'template-parts/ui/button', null, array(
    'url'   => '/tin-tuc',
    'label' => 'Tất cả bài viết',
    'class' => 'mbland_homepage_activities_cta',
    'title' => 'Tất cả bài viết',
) );
      ?>
		</div>
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
								'terms'    => 'tin-noi-bat',
								'operator' => 'IN',
							),
						),
					) );

					if ( $activities_query->have_posts() ) :
					while ( $activities_query->have_posts() ) : $activities_query->the_post();
					$featured_img = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					$act_w = 620;
					$act_h = 360;
					if ( has_post_thumbnail() ) {
						$act_thumb_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						if ( ! empty( $act_thumb_data ) ) {
							$act_w = $act_thumb_data[1];
							$act_h = $act_thumb_data[2];
						}
					}
					if ( ! $featured_img ) {
						$featured_img = get_template_directory_uri() . '/images/default-activity.jpg';
					}
					?>
					<div class="swiper-slide mbland_homepage_activities_slide">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<div class="mbland_homepage_activities_slideImage">
							<img loading="lazy" decoding="async" fetchpriority="low"
								 src="<?php echo esc_url( $featured_img ); ?>"
								 alt="<?php echo esc_attr( get_the_title() ); ?>"
								 title="<?php echo esc_attr( get_the_title() ); ?>"
								 width="<?php echo esc_attr( $act_w ); ?>"
								 height="<?php echo esc_attr( $act_h ); ?>"
								 />
						</div>
						
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

		
    </div>
	</div>
</section>
<!-- ===== END SECTION ACTIVITIES ===== -->





<!-- ===== START SECTION CONTACT ===== -->
<?php get_template_part( 'template-parts/sections/contact-form' ); ?>
<!-- ===== END SECTION CONTACT ===== -->






<?php get_footer();?>