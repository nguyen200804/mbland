<?php
/**
 * Template Name: Trang chủ
 */

get_header();

// Lấy dữ liệu ACF Field Groups
$home_hero       = get_field( 'home_hero' ) ?: array();
$home_info       = get_field( 'home_info' ) ?: array();
$home_company    = get_field( 'home_company' ) ?: array();
$home_branches   = get_field( 'home_branches' ) ?: array();
$home_projects   = get_field( 'home_projects' ) ?: array();
$home_activities = get_field( 'home_activities' ) ?: array();
?>

<!-- ===== START SECTION ABOUT ===== -->
<?php
$hero_seo_h1       = ! empty( $home_hero['seo_h1'] ) ? $home_hero['seo_h1'] : 'MBLAND ASSET MANAGEMENT';
$hero_title_first  = ! empty( $home_hero['title_first'] ) ? $home_hero['title_first'] : 'MBLAND';
$hero_title_second = ! empty( $home_hero['title_second'] ) ? $home_hero['title_second'] : 'ASSET MANAGEMENT';
$hero_cta          = ! empty( $home_hero['cta'] ) ? $home_hero['cta'] : array(
	'url'   => '/gioi-thieu',
	'title' => 'Kết nối hợp tác ngay!',
);
$hero_quote_icon   = ! empty( $home_hero['quote_icon']['url'] ) ? $home_hero['quote_icon']['url'] : '/wp-content/uploads/2025/10/quote.svg';
$hero_slogan       = ! empty( $home_hero['slogan'] ) ? $home_hero['slogan'] : 'Công - Tâm - Trí - Tín';
$hero_desc         = ! empty( $home_hero['description'] ) ? $home_hero['description'] : 'Chúng tôi đang dần tạo nên một nền tảng vững chắc để hoàn thành Sứ mệnh: Cam kết những sản phẩm tốt nhất, đặc sắc nhất; là đối tác tin cậy và phát triển bền vững; Là doanh nghiệp có Trách nhiệm.';
$hero_scroll_img   = ! empty( $home_hero['scroll_image']['url'] ) ? $home_hero['scroll_image']['url'] : '/wp-content/uploads/2025/10/explore.svg';
$hero_banner       = ! empty( $home_hero['banner']['url'] ) ? $home_hero['banner']['url'] : '/wp-content/uploads/2026/11/hero_mbland.jpg';
$hero_banner_w     = ! empty( $home_hero['banner']['width'] ) ? $home_hero['banner']['width'] : 2559;
$hero_banner_h     = ! empty( $home_hero['banner']['height'] ) ? $home_hero['banner']['height'] : 1007;
?>
<section class="mbland_homepage_about">
	<div class="container">
		<h1 style="display: none"><?php echo esc_html( $hero_seo_h1 ); ?></h1>
		<div class="mbland_homepage_about_title">
			<div class="mbland_homepage_about_titleFirst">
				<div class="mbland_homepage_about_titleImage">
					<?php echo esc_html( $hero_title_first ); ?>
				</div>
				<?php
				if ( ! empty( $hero_cta['url'] ) ) {
					get_template_part( 'template-parts/ui/button', null, array(
						'url'     => $hero_cta['url'],
						'label'   => ! empty( $hero_cta['title'] ) ? $hero_cta['title'] : 'Kết nối hợp tác ngay!',
						'class'   => 'mbland_homepage_about_titleCta',
						'loading' => 'eager', // icon nam trong hero (above the fold)
						'title'   => ! empty( $hero_cta['title'] ) ? $hero_cta['title'] : 'Thông tin chi tiết',
					) );
				}
				?>
			</div>
			<div class="mbland_homepage_about_titleSecond">
				<?php echo esc_html( $hero_title_second ); ?>
			</div>
		</div>
		<div class="mbland_homepage_about_desc">
			<div class="mbland_homepage_about_descIcon">
				<img loading="eager" decoding="async"
					 src="<?php echo esc_url( $hero_quote_icon ); ?>"
					 alt="Quote Icon"
					 title="Quote Icon"
					 width="21"
					 height="15"
					 fetchpriority="auto"
					 />
			</div>
			<span class="mbland_homepage_about_descTitle"><?php echo esc_html( $hero_slogan ); ?></span>
			<p>
				<?php echo nl2br( esc_html( $hero_desc ) ); ?>
			</p>
		</div>
		<div class="mbland_homepage_about_scrollToExplore">
			<img loading="eager" decoding="async"
				 src="<?php echo esc_url( $hero_scroll_img ); ?>"
				 alt="Scroll to explore"
				 title="Scroll to explore"
				 width="405"
				 height="309"
				 fetchpriority="auto"
				 />
		</div>
	</div>
	<div class="mbland_homepage_about_banner">
		<?php
		$hero_banner_data   = homenest_get_hero_banner();
		$hero_banner_srcset = $hero_banner_data['id'] ? wp_get_attachment_image_srcset( $hero_banner_data['id'], 'full' ) : '';
		?>
		<img loading="eager" decoding="async" fetchpriority="high"
			 <?php if ( $hero_banner_srcset ) : ?>srcset="<?php echo esc_attr( $hero_banner_srcset ); ?>" sizes="100vw"<?php endif; ?>
			 src="<?php echo esc_url( $hero_banner ); ?>"
			 alt="<?php echo esc_attr( $hero_title_first . ' ' . $hero_title_second ); ?>"
			 title="<?php echo esc_attr( $hero_title_first . ' ' . $hero_title_second ); ?>"
			 width="<?php echo esc_attr( $hero_banner_w ); ?>"
			 height="<?php echo esc_attr( $hero_banner_h ); ?>"
			 />
	</div>
</section>
<!-- ===== END SECTION ABOUT ===== -->





<!-- ===== START SECTION INFO ===== -->
<?php
$marquee_text    = ! empty( $home_info['marquee_text'] ) ? $home_info['marquee_text'] : 'MBLAND ASSET MANAGEMENT';
$marquee_repeat  = ! empty( $home_info['marquee_repeat'] ) ? max( 1, intval( $home_info['marquee_repeat'] ) ) : 4;
$stat_number     = ! empty( $home_info['stat_number'] ) ? $home_info['stat_number'] : '10';
$stat_plus       = isset( $home_info['stat_plus'] ) && $home_info['stat_plus'] !== '' ? $home_info['stat_plus'] : '+';
$stat_unit       = ! empty( $home_info['stat_unit'] ) ? $home_info['stat_unit'] : 'Năm';
$stat_label      = ! empty( $home_info['stat_label'] ) ? $home_info['stat_label'] : 'Hành Trình';
$stat_year       = ! empty( $home_info['stat_year'] ) ? $home_info['stat_year'] : '2015';
$info_desc       = ! empty( $home_info['description'] ) ? $home_info['description'] : 'Được thành lập vào năm 2015, MBLand Asset Management là tập đoàn đa ngành, đã và đang đầu tư một số dự án trong và ngoài nước thuộc lĩnh vực Tài chính - Bất động sản - Du lịch Dịch vụ dưới thương hiệu của một số Công ty con - Công ty liên kết như MBland Holdings, F&S Investment, Tonkin Properties, Golden Field,.. với các dự án trọng điểm tại Đà Nẵng, Hội An, Quảng Ngãi, Hà Nội, Quảng Ninh, Nha Trang, Tp Hồ Chí Minh,...';
$cta_primary     = ! empty( $home_info['cta_primary'] ) ? $home_info['cta_primary'] : array(
	'url'   => '/gioi-thieu',
	'title' => 'KHÁM PHÁ VỀ CHÚNG TÔI',
);
$cta_secondary   = ! empty( $home_info['cta_secondary'] ) ? $home_info['cta_secondary'] : array(
	'url'   => '/linh-vuc/bat-dong-san',
	'title' => 'LĨNH VỰC HOẠT ĐỘNG',
);
?>
<section class="mbland_homepage_info">
	<div class="mbland_homepage_info_marquee">
		<div class="mbland_homepage_info_marqueeItem">
			<?php for ( $m = 0; $m < $marquee_repeat; $m++ ) : ?>
				<p><?php echo esc_html( $marquee_text ); ?></p>
			<?php endfor; ?>
		</div>
	</div>
	<div class="container">
		<div class="mbland_homepage_info_title">
			<p class="mbland_homepage_info_titleNumber"><?php echo esc_html( $stat_number ); ?></p>
			<div class="mbland_homepage_info_titleGroup">
				<p class="mbland_homepage_info_titlePlus"><?php echo esc_html( $stat_plus ); ?></p>
				<div class="mbland_homepage_info_titleContent">
					<p class="mbland_homepage_info_titleUnit"><?php echo esc_html( $stat_unit ); ?></p>
					<p class="mbland_homepage_info_titleLabel">
						<span class="mbland_homepage_info_titleText"><?php echo esc_html( $stat_label ); ?></span>
						<span class="mbland_homepage_info_titleYear"><?php echo esc_html( $stat_year ); ?></span>
					</p>
				</div>
			</div>
		</div>
		<p class="mbland_homepage_info_desc">
			<?php echo nl2br( esc_html( $info_desc ) ); ?>
		</p>
		<div class="mbland_homepage_info_cta">
			<?php
			if ( ! empty( $cta_primary['url'] ) ) {
				get_template_part( 'template-parts/ui/button', null, array(
					'url'   => $cta_primary['url'],
					'label' => ! empty( $cta_primary['title'] ) ? $cta_primary['title'] : 'KHÁM PHÁ VỀ CHÚNG TÔI',
					'class' => 'mbland_homepage_info_ctaPrimary',
					'title' => ! empty( $cta_primary['title'] ) ? $cta_primary['title'] : 'KHÁM PHÁ VỀ CHÚNG TÔI',
				) );
			}

			if ( ! empty( $cta_secondary['url'] ) ) :
				?>
				<a class="hn-tasmania-cta-btn mbland_homepage_info_ctaOutline"
				   href="<?php echo esc_url( $cta_secondary['url'] ); ?>"
				   title="<?php echo esc_attr( ! empty( $cta_secondary['title'] ) ? $cta_secondary['title'] : 'Lĩnh vực hoạt động' ); ?>" aria-label="<?php echo esc_attr( ! empty( $cta_secondary['title'] ) ? $cta_secondary['title'] : 'Lĩnh vực hoạt động' ); ?>">
					<?php echo esc_html( ! empty( $cta_secondary['title'] ) ? $cta_secondary['title'] : 'LĨNH VỰC HOẠT ĐỘNG' ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>
<!-- ===== END SECTION INFO ===== -->





<!-- ==== START SECTION COMPANY ==== -->
<?php
$company_intro_img     = ! empty( $home_company['intro_image']['url'] ) ? $home_company['intro_image']['url'] : '/wp-content/uploads/2026/11/gioi-thieu-cong-ty-cua-chung-toi-image-1.jpg';
$company_intro_w       = ! empty( $home_company['intro_image']['width'] ) ? $home_company['intro_image']['width'] : 1634;
$company_intro_h       = ! empty( $home_company['intro_image']['height'] ) ? $home_company['intro_image']['height'] : 919;
$company_title         = ! empty( $home_company['title'] ) ? $home_company['title'] : 'Giới thiệu về công ty chúng tôi';
$company_brand_prefix  = ! empty( $home_company['brand_prefix'] ) ? $home_company['brand_prefix'] : 'Công ty Cổ Phần TẬP ĐOÀN';
$company_brand_logo    = ! empty( $home_company['brand_logo']['url'] ) ? $home_company['brand_logo']['url'] : '/wp-content/uploads/2026/11/logo_mbland-asset-management.png';
$company_logo_w        = ! empty( $home_company['brand_logo']['width'] ) ? $home_company['brand_logo']['width'] : 1408;
$company_logo_h        = ! empty( $home_company['brand_logo']['height'] ) ? $home_company['brand_logo']['height'] : 104;
$company_desc          = ! empty( $home_company['description'] ) ? $home_company['description'] : 'Tập đoàn đầu tư đa ngành được thành lập năm 2015, hoạt động trong ba lĩnh vực trọng tâm: Tài chính, Bất động sản và Du lịch – Dịch vụ. Với định hướng phát triển bền vững, lấy uy tín và chất lượng làm nền tảng, MBLand Asset Management không ngừng mở rộng hệ sinh thái đầu tư, kết nối các đối tác trong nước và quốc tế, hướng đến kiến tạo những giá trị lâu dài cho khách hàng, đối tác và cộng đồng.';
$company_showcase_img  = ! empty( $home_company['showcase_image']['url'] ) ? $home_company['showcase_image']['url'] : '/wp-content/uploads/2026/11/gioi-thieu-cong-ty-cua-chung-toi-image-2.jpg';
$company_showcase_w    = ! empty( $home_company['showcase_image']['width'] ) ? $home_company['showcase_image']['width'] : 1553;
$company_showcase_h    = ! empty( $home_company['showcase_image']['height'] ) ? $home_company['showcase_image']['height'] : 1036;
?>
<section class="mbland_homepage_company">
	<div class="container">
		<div class="mbland_homepage_company_wrapper mbland_homepage_company_introWrapper">
			<div class="mbland_homepage_company_media mbland_homepage_company_introMedia">
				<img loading="lazy" decoding="async"
					class="mbland_homepage_company_image mbland_homepage_company_introImage"
					<?php echo homenest_srcset_attr( ! empty( $home_company['intro_image']['ID'] ) ? $home_company['intro_image']['ID'] : attachment_url_to_postid( $company_intro_img ), '(max-width: 768px) 100vw, 1000px' ); ?>
					src="<?php echo esc_url( $company_intro_img ); ?>"
					alt="<?php echo esc_attr( $company_title ); ?>"
					title="<?php echo esc_attr( $company_title ); ?>"
					width="<?php echo esc_attr( $company_intro_w ); ?>"
					height="<?php echo esc_attr( $company_intro_h ); ?>"
				/>
			</div>
			<div class="mbland_homepage_company_body mbland_homepage_company_introBody">
				<header class="mbland_homepage_company_introHeader">
					<h2 class="mbland_homepage_company_introTitle"><?php echo esc_html( $company_title ); ?></h2>
				</header>
				<div class="mbland_homepage_company_introContent">
					<div class="mbland_homepage_company_introBrand">
						<p class="mbland_homepage_company_introBrandName"><?php echo esc_html( $company_brand_prefix ); ?></p>
						<img loading="lazy" decoding="async"
							class="mbland_homepage_company_introBrandLogo"
							src="<?php echo esc_url( $company_brand_logo ); ?>"
							alt="<?php echo esc_attr( $company_brand_prefix ); ?>"
							title="<?php echo esc_attr( $company_brand_prefix ); ?>"
							width="<?php echo esc_attr( $company_logo_w ); ?>"
							height="<?php echo esc_attr( $company_logo_h ); ?>"
						/>
					</div>
					<p class="mbland_homepage_company_introDesc">
						<?php echo nl2br( esc_html( $company_desc ) ); ?>
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
					<img loading="lazy" decoding="async"
						class="mbland_homepage_company_image mbland_homepage_company_showcaseImage"
						<?php echo homenest_srcset_attr( ! empty( $home_company['showcase_image']['ID'] ) ? $home_company['showcase_image']['ID'] : attachment_url_to_postid( $company_showcase_img ), '(max-width: 768px) 100vw, 1000px' ); ?>
						src="<?php echo esc_url( $company_showcase_img ); ?>"
						alt="<?php echo esc_attr( $company_title ); ?>"
						title="<?php echo esc_attr( $company_title ); ?>"
						width="<?php echo esc_attr( $company_showcase_w ); ?>"
						height="<?php echo esc_attr( $company_showcase_h ); ?>"
					/>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ==== END SECTION COMPANY ==== -->





<!-- ===== START SECTION BRANCHES ===== -->
<?php
$branches_title        = ! empty( $home_branches['title'] ) ? $home_branches['title'] : 'Lĩnh vực hoạt động';
$branches_desc         = ! empty( $home_branches['description'] ) ? $home_branches['description'] : 'Với hệ sinh thái đầu tư đa ngành, MBLand Asset Management tập trung phát triển các lĩnh vực chiến lược, tạo dựng giá trị bền vững và mở rộng cơ hội hợp tác trong nước và quốc tế.';
$branches_cta          = ! empty( $home_branches['cta'] ) ? $home_branches['cta'] : array(
	'url'   => '/linh-vuc',
	'title' => 'Tìm hiểu thêm',
);
$branches_card_label   = ! empty( $home_branches['card_label'] ) ? $home_branches['card_label'] : 'Lĩnh vực hoạt động';
$branches_placeholder  = ! empty( $home_branches['placeholder_image']['url'] ) ? $home_branches['placeholder_image']['url'] : '/wp-content/uploads/2025/10/branch-placeholder.jpg';

// Lấy danh sách terms từ ACF hoặc fallback theo query
if ( ! empty( $home_branches['terms'] ) && is_array( $home_branches['terms'] ) ) {
	$branches_terms = $home_branches['terms'];
} else {
	$branches_terms = get_terms( array(
		'taxonomy'   => 'linh-vuc',
		'hide_empty' => false,
		'parent'     => 0,
		'number'     => 3,
		'orderby'    => 'name',
		'order'      => 'ASC',
	) );
	$desired_order = array( 'bat-dong-san', 'dich-vu-du-lich', 'dau-tu-tai-chinh', 'real-estate', 'hospitality', 'commercial' );
	if ( ! empty( $branches_terms ) && ! is_wp_error( $branches_terms ) ) {
		usort( $branches_terms, function( $a, $b ) use ( $desired_order ) {
			$pos_a = array_search( $a->slug, $desired_order );
			$pos_b = array_search( $b->slug, $desired_order );
			$pos_a = $pos_a === false ? count( $desired_order ) : $pos_a;
			$pos_b = $pos_b === false ? count( $desired_order ) : $pos_b;
			return $pos_a - $pos_b;
		} );
	}
}
?>
<section class="mbland_homepage_branches">
	<div class="container">
		<header class="mbland_homepage_branches_header">
			<h2 class="mbland_homepage_branches_title"><?php echo esc_html( $branches_title ); ?></h2>
			<p class="mbland_homepage_branches_desc"><?php echo nl2br( esc_html( $branches_desc ) ); ?></p>
			
		</header>
	</div>

	<?php
			if ( ! empty( $branches_cta['url'] ) ) {
				get_template_part( 'template-parts/ui/button', null, array(
					'url'   => $branches_cta['url'],
					'label' => ! empty( $branches_cta['title'] ) ? $branches_cta['title'] : 'Tìm hiểu thêm',
					'class' => 'mbland_homepage_branches_btn',
					'title' => ! empty( $branches_cta['title'] ) ? $branches_cta['title'] : 'Thông tin chi tiết',
				) );
			}
			?>

	<div class="mbland_homepage_branches_list">
		<?php
		if ( ! empty( $branches_terms ) && ! is_wp_error( $branches_terms ) ) :
			$branch_index = 1;
			foreach ( $branches_terms as $index => $term ) :
				$is_active = ( $index === 0 ) ? ' mbland_homepage_branches_itemActive' : '';

				// Lấy featured image từ field feature_image của taxonomy term
				$scf_image          = get_field( 'feature_image', 'term_' . $term->term_id ) ?: array();
				$featured_image_url = ! empty( $scf_image['url'] ) ? $scf_image['url'] : false;
				$branch_w           = ! empty( $scf_image['width'] ) ? $scf_image['width'] : 800;
				$branch_h           = ! empty( $scf_image['height'] ) ? $scf_image['height'] : 550;
				$term_link          = get_term_link( $term );
				?>
				<div class="mbland_homepage_branches_item<?php echo esc_attr( $is_active ); ?>">
					<div class="mbland_homepage_branches_card">
						<a href="<?php echo esc_url( $term_link ); ?>" class="mbland_homepage_branches_link" title="<?php echo esc_attr( $term->name ); ?>" aria-label="<?php echo esc_attr( $term->name ); ?>">
							<div class="mbland_homepage_branches_arrow">
								<img loading="lazy" decoding="async"
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
								<p class="mbland_homepage_branches_label"><?php echo esc_html( $branches_card_label ); ?></p>
								<h3 class="equalh3 mbland_homepage_branches_name"><?php echo esc_html( $term->name ); ?></h3>
							</div>
						</a>
					</div>

					<div class="mbland_homepage_branches_media">
						<?php if ( $featured_image_url ) : ?>
							<img loading="lazy" decoding="async"
								class="mbland_homepage_branches_image"
								<?php echo homenest_srcset_attr( ! empty( $scf_image['ID'] ) ? $scf_image['ID'] : 0, '(max-width: 768px) 100vw, 800px' ); ?>
								src="<?php echo esc_url( $featured_image_url ); ?>"
								alt="<?php echo esc_attr( $term->name ); ?>"
								title="<?php echo esc_attr( $term->name ); ?>"
								width="<?php echo esc_attr( $branch_w ); ?>"
								height="<?php echo esc_attr( $branch_h ); ?>"
							/>
						<?php else : ?>
							<img loading="lazy" decoding="async"
								class="mbland_homepage_branches_image"
								src="<?php echo esc_url( $branches_placeholder ); ?>"
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
			echo '<p class="container">Chưa có lĩnh vực hoạt động nào.</p>';
		endif;
		?>
	</div>
</section>
<!-- ===== END SECTION BRANCHES ===== -->





<?php get_template_part( 'template-parts/sections/brands' ); ?>





<!-- ===== START SECTION PROJECTS ===== -->
<?php
$projects_title = ! empty( $home_projects['title'] ) ? $home_projects['title'] : 'Dự án nổi bật';
$projects_desc  = ! empty( $home_projects['description'] ) ? $home_projects['description'] : 'MBLand Asset Management là tập đoàn đa ngành với những dự án nổi bật trong suốt quá trình phát triển';
$projects_cta   = ! empty( $home_projects['cta'] ) ? $home_projects['cta'] : array(
	'url'   => '/linh-vuc/bat-dong-san',
	'title' => 'Xem thêm dự án',
);

$projects_source = ! empty( $home_projects['source'] ) ? $home_projects['source'] : 'auto';
$projects_limit  = ! empty( $home_projects['limit'] ) ? intval( $home_projects['limit'] ) : 6;

if ( $projects_source === 'manual' && ! empty( $home_projects['projects'] ) ) {
	$project_ids  = wp_list_pluck( $home_projects['projects'], 'ID' );
	$du_an_query = new WP_Query( array(
		'post_type'      => 'du-an',
		'post__in'       => $project_ids,
		'orderby'        => 'post__in',
		'posts_per_page' => count( $project_ids ),
	) );
} else {
	// Tự động: ưu tiên dự án thuộc term "du-an-noi-bat" (mới nhất trước), nếu chưa đủ thì bù bằng dự án mới nhất.
	// Lưu ý: get_posts() mặc định suppress_filters=true => Polylang KHÔNG lọc ngôn ngữ, lấy lẫn bài EN/VI,
	// sau đó WP_Query post__in lại lọc theo ngôn ngữ => bị thiếu bài. Vì vậy phải bật lọc ngôn ngữ ngay từ đầu.
	$lang_args = array( 'suppress_filters' => false );
	if ( function_exists( 'pll_current_language' ) && pll_current_language() ) {
		$lang_args['lang'] = pll_current_language();
	}

	$project_ids = array();
	if ( taxonomy_exists( 'du-an-noi-bat' ) ) {
		$featured_ids = get_posts( array_merge( $lang_args, array(
			'post_type'      => 'du-an',
			'post_status'    => 'publish',
			'posts_per_page' => $projects_limit,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'tax_query'      => array(
				array(
					'taxonomy' => 'du-an-noi-bat',
					'field'    => 'slug',
					'terms'    => array( 'du-an-noi-bat', 'featured-projects' ),
				),
			),
		) ) );
		$project_ids = array_map( 'intval', $featured_ids );
	}
	if ( count( $project_ids ) < $projects_limit ) {
		$latest_ids  = get_posts( array_merge( $lang_args, array(
			'post_type'      => 'du-an',
			'post_status'    => 'publish',
			'posts_per_page' => $projects_limit - count( $project_ids ),
			'post__not_in'   => $project_ids,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'orderby'        => 'date',
			'order'          => 'DESC',
		) ) );
		$project_ids = array_merge( $project_ids, array_map( 'intval', $latest_ids ) );
	}
	$du_an_query = new WP_Query( array(
		'post_type'      => 'du-an',
		'post_status'    => 'publish',
		'post__in'       => ! empty( $project_ids ) ? $project_ids : array( 0 ),
		'orderby'        => 'post__in',
		'posts_per_page' => $projects_limit,
	) );
}
?>
<section class="mbland_homepage_projects">
	<div class="container">
		
			<div class="mbland_homepage_projects_title">
				<h2><?php echo esc_html( $projects_title ); ?></h2>
				<p><?php echo nl2br( esc_html( $projects_desc ) ); ?></p>
			</div>
			<?php
			if ( ! empty( $projects_cta['url'] ) ) {
				get_template_part( 'template-parts/ui/button', null, array(
					'url'   => $projects_cta['url'],
					'label' => ! empty( $projects_cta['title'] ) ? $projects_cta['title'] : 'Xem thêm dự án',
					'class' => 'mbland_homepage_projects_button',
					'title' => ! empty( $projects_cta['title'] ) ? $projects_cta['title'] : 'Xem thêm dự án',
				) );
			}
			?>

		<div class="mbland_homepage_projects_wrapper">
			<?php
			if ( $du_an_query->have_posts() ) :
				$i = 1;
				while ( $du_an_query->have_posts() ) :
					$du_an_query->the_post();
					$banner_field = get_field( 'banner' );
					$item_title   = get_the_title();
					$thumb        = '';
					$thumb_w      = 0;
					$thumb_h      = 0;
					$thumb_id     = 0;

					if ( is_array( $banner_field ) ) {
						$thumb_id = ! empty( $banner_field['ID'] ) ? (int) $banner_field['ID'] : 0;
						$thumb   = ! empty( $banner_field['url'] ) ? $banner_field['url'] : '';
						$thumb_w = ! empty( $banner_field['width'] ) ? $banner_field['width'] : 0;
						$thumb_h = ! empty( $banner_field['height'] ) ? $banner_field['height'] : 0;
					} elseif ( is_numeric( $banner_field ) ) {
						$banner_img_data = wp_get_attachment_image_src( $banner_field, 'full' );
						if ( ! empty( $banner_img_data ) ) {
							$thumb_id = (int) $banner_field;
							$thumb   = $banner_img_data[0];
							$thumb_w = $banner_img_data[1];
							$thumb_h = $banner_img_data[2];
						}
					} elseif ( is_string( $banner_field ) && ! empty( $banner_field ) ) {
						$thumb = $banner_field;
					}

					if ( empty( $thumb ) ) {
						$thumb = get_the_post_thumbnail_url( get_the_ID(), 'full' );
						$thumb_id = get_post_thumbnail_id();
					}

					if ( ( ! $thumb_w || ! $thumb_h ) && has_post_thumbnail() ) {
						$post_thumb_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						if ( ! empty( $post_thumb_data ) ) {
							$thumb_w = $post_thumb_data[1];
							$thumb_h = $post_thumb_data[2];
						}
					}

					$thumb   = $thumb ?: '/wp-content/uploads/2025/10/branch-placeholder.jpg';
					$thumb_w = $thumb_w ?: 600;
					$thumb_h = $thumb_h ?: 350;
					?>
					<div class="mbland_homepage_projects_item mbland_homepage_projects_item<?php echo esc_attr( $i ); ?>">
						<div class="mbland_homepage_projects_itemImage">
							<img loading="lazy" decoding="async"
								 <?php echo homenest_srcset_attr( $thumb_id, '(max-width: 768px) 100vw, 800px' ); ?>
								 src="<?php echo esc_url( $thumb ); ?>"
								 alt="<?php the_title_attribute(); ?>"
								 title="<?php the_title_attribute(); ?>"
								 width="<?php echo esc_attr( $thumb_w ); ?>"
								 height="<?php echo esc_attr( $thumb_h ); ?>"
							/>
						</div>
						<div class="mbland_homepage_projects_itemContent">
							<div class="mbland_homepage_projects_itemContent1"></div>
							<div class="mbland_homepage_projects_itemContent2">
								<h3 class="small-h3">
									<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( $item_title ); ?>" aria-label="<?php echo esc_attr( $item_title ); ?>">
										<?php echo esc_html( $item_title ); ?>
									</a>
								</h3>
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
				echo '<p>Chưa có dự án nào.</p>';
			endif;
			?>
		</div>
	</div>
</section>
<!-- ===== END SECTION PROJECTS ===== -->





<!-- ===== START SECTION ACTIVITIES ===== -->
<?php
$activities_title  = ! empty( $home_activities['title'] ) ? $home_activities['title'] : 'Hoạt động & Sự kiện';
$activities_desc   = ! empty( $home_activities['description'] ) ? $home_activities['description'] : 'Được thành lập vào năm 2015, MBLand Asset Management là tập đoàn đa ngành, đã và đang đầu tư một số dự án trong và ngoài nước thuộc lĩnh vực Tài chính - Bất động sản - Du lịch Dịch vụ.';
$activities_cta    = ! empty( $home_activities['cta'] ) ? $home_activities['cta'] : array(
	'url'   => '/tin-tuc',
	'title' => 'Tất cả bài viết',
);
$activities_source = ! empty( $home_activities['source'] ) ? $home_activities['source'] : 'auto';
$activities_limit  = ! empty( $home_activities['limit'] ) ? intval( $home_activities['limit'] ) : 6;

if ( $activities_source === 'manual' && ! empty( $home_activities['posts'] ) ) {
	$activity_ids      = wp_list_pluck( $home_activities['posts'], 'ID' );
	$activities_query  = new WP_Query( array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'post__in'       => $activity_ids,
		'orderby'        => 'post__in',
		'posts_per_page' => count( $activity_ids ),
	) );
} else {
	$activities_query = new WP_Query( array(
		'post_type'      => 'post',
		'posts_per_page' => $activities_limit,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
		'tax_query'      => array(
			array(
				'taxonomy' => 'tin-noi-bat',
				'field'    => 'slug',
				'terms'    => array( 'tin-noi-bat', 'featured-news' ),
				'operator' => 'IN',
			),
		),
	) );
}
?>
<section class="mbland_homepage_activities">
	<div class="container">
		<div class="mbland_homepage_activities_wrapper">
			
				<div class="mbland_homepage_activities_heading">
					<h2 class="mbland_homepage_activities_title"><?php echo esc_html( $activities_title ); ?></h2>
					<p class="mbland_homepage_activities_desc"><?php echo nl2br( esc_html( $activities_desc ) ); ?></p>
				</div>
				<?php
				if ( ! empty( $activities_cta['url'] ) ) {
					get_template_part( 'template-parts/ui/button', null, array(
						'url'   => $activities_cta['url'],
						'label' => ! empty( $activities_cta['title'] ) ? $activities_cta['title'] : 'Tất cả bài viết',
						'class' => 'mbland_homepage_activities_cta',
						'title' => ! empty( $activities_cta['title'] ) ? $activities_cta['title'] : 'Tất cả bài viết',
					) );
				}
				?>
			

			<div class="mbland_homepage_activities_slider">
				<div class="swiper mbland_homepage_activities_swiper">
					<div class="swiper-wrapper">
						<?php
						if ( $activities_query->have_posts() ) :
							while ( $activities_query->have_posts() ) :
								$activities_query->the_post();
								$featured_img = get_the_post_thumbnail_url( get_the_ID(), 'full' );
								$act_w        = 620;
								$act_h        = 360;

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
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" aria-label="<?php the_title_attribute(); ?>">
										<div class="mbland_homepage_activities_slideImage">
											<img loading="lazy" decoding="async"
												 <?php echo homenest_srcset_attr( get_post_thumbnail_id(), '(max-width: 768px) 85vw, 620px' ); ?>
												 src="<?php echo esc_url( $featured_img ); ?>"
												 alt="<?php the_title_attribute(); ?>"
												 title="<?php the_title_attribute(); ?>"
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

<?php get_footer(); ?>
