<?php
/**
 * Template Name: Giới thiệu
 */

get_header();

// Lấy dữ liệu ACF Field Groups
$about_hero         = get_field( 'about_hero' ) ?: array();
$about_overview     = get_field( 'about_overview' ) ?: array();
$about_info         = get_field( 'about_info' ) ?: array();
$about_goals        = get_field( 'about_goals' ) ?: array();
$about_subsidiaries = get_field( 'about_subsidiaries' ) ?: array();
$about_team         = get_field( 'about_team' ) ?: array();
?>

<!-- ===== START HERO ===== -->
<?php
$hero_banner   = ! empty( $about_hero['banner']['url'] ) ? $about_hero['banner']['url'] : '/wp-content/uploads/2026/11/hero_aboutus.jpg';
$hero_banner_w = ! empty( $about_hero['banner']['width'] ) ? $about_hero['banner']['width'] : 1920;
$hero_banner_h = ! empty( $about_hero['banner']['height'] ) ? $about_hero['banner']['height'] : 1080;
?>
<section class="mbland_about_hero">
	<div class="container mbland_about_hero_container">
		<?php echo do_shortcode( '[hn_breadcrumb]' ); ?>
	</div>
	<div class="mbland_about_hero_image">
		<img loading="eager" decoding="async" fetchpriority="high"
			 src="<?php echo esc_url( $hero_banner ); ?>"
			 class="mbland_about_hero_img"
			 alt="<?php echo esc_attr( get_the_title() ); ?>"
			 title="<?php echo esc_attr( get_the_title() ); ?>"
			 width="<?php echo esc_attr( $hero_banner_w ); ?>"
			 height="<?php echo esc_attr( $hero_banner_h ); ?>"
		/>
	</div>
</section>
<!-- ===== END HERO ===== -->





<!-- ===== START OVERVIEW ===== -->
<?php
$intro_title   = ! empty( $about_overview['intro_title'] ) ? $about_overview['intro_title'] : 'MBLand Asset Management';
$intro_content = ! empty( $about_overview['intro_content'] ) ? $about_overview['intro_content'] : '';

// Values list fallback
$values_list = ! empty( $about_overview['values'] ) && is_array( $about_overview['values'] ) ? $about_overview['values'] : array(
	array(
		'title'       => 'Công',
		'label'       => 'Giá trị cốt lõi',
		'tagline'     => 'Công - tâm - trí - tín',
		'description' => 'Cam kết sự công minh trong từng việc làm',
	),
	array(
		'title'       => 'Tâm',
		'label'       => 'Giá trị cốt lõi',
		'tagline'     => 'Công - tâm - trí - tín',
		'description' => 'Luôn tận tâm trong công việc - đặt cái tâm vào nghề',
	),
	array(
		'title'       => 'Trí',
		'label'       => 'Giá trị cốt lõi',
		'tagline'     => 'Công - tâm - trí - tín',
		'description' => 'Phương châm dùng trí tuệ để quản trị',
	),
	array(
		'title'       => 'Tín',
		'label'       => 'Giá trị cốt lõi',
		'tagline'     => 'Công - tâm - trí - tín',
		'description' => 'Coi trọng chữ tín - Luôn đặt uy tín lên hàng đầu',
	),
);
?>
<section class="mbland_about_overview">
	<div class="container mbland_about_overview_container">

		<!-- ===== START INTRO ===== -->
		<div class="mbland_about_intro">
			<h2 class="mbland_about_intro_title"><?php echo esc_html( $intro_title ); ?></h2>
			<?php if ( ! empty( $intro_content ) ) : ?>
				<div class="mbland_about_intro_contentWrapper">
					<?php echo wp_kses_post( $intro_content ); ?>
				</div>
			<?php else : ?>
				<p class="mbland_about_intro_content">
					Được thành lập vào năm 2015, MBLand Asset Management là tập đoàn đa ngành, đã và đang đầu tư một số dự án trong và ngoài nước thuộc lĩnh vực Tài chính - Bất động sản - Du lịch Dịch vụ dưới thương hiệu của một số Công ty con - Công ty liên kết như MBland Holdings, F&S Investment, Tonkin Properties, Golden Field,.. với các dự án trọng điểm tại Đà Nẵng, Hội An, Quảng Ngãi, Hà Nội, Quảng Ninh, Nha Trang, Tp Hồ Chí Minh,...
				</p>
				<p class="mbland_about_intro_content">
					MBLand Asset Management đã và đang hợp tác với nhiều đối tác tại thị trường Châu Âu và Châu Á để mở rộng đầu tư và phát triển tại Úc, Singapore, Hungary, Thái Lan, Hy Lạp,... dưới các thương hiệu Blooming Elite, Sentosa Holdings và Moni Galery,...
				</p>
			<?php endif; ?>
		</div>
		<!-- ===== END INTRO ===== -->

		<!-- ===== START VALUES ===== -->
		<div class="mbland_about_values">
			<?php
			foreach ( $values_list as $val ) :
				$v_title   = ! empty( $val['title'] ) ? $val['title'] : '';
				$v_label   = ! empty( $val['label'] ) ? $val['label'] : 'Giá trị cốt lõi';
				$v_tag     = ! empty( $val['tagline'] ) ? $val['tagline'] : 'Công - tâm - trí - tín';
				$v_desc    = ! empty( $val['description'] ) ? $val['description'] : '';
				$v_icon    = ! empty( $val['bg_icon']['url'] ) ? $val['bg_icon']['url'] : '/wp-content/uploads/2025/10/diamond.svg';
				$v_icon_w  = ! empty( $val['bg_icon']['width'] ) ? $val['bg_icon']['width'] : 136;
				$v_icon_h  = ! empty( $val['bg_icon']['height'] ) ? $val['bg_icon']['height'] : 188;
				?>
				<div class="mbland_about_values_item">
					<img loading="lazy" decoding="async" fetchpriority="low"
						 src="<?php echo esc_url( $v_icon ); ?>"
						 alt="<?php echo esc_attr( $v_title ); ?>"
						 class="mbland_about_values_bg"
						 title="<?php echo esc_attr( $v_title ); ?>"
						 width="<?php echo esc_attr( $v_icon_w ); ?>"
						 height="<?php echo esc_attr( $v_icon_h ); ?>"
					/>
					<div class="mbland_about_values_center">
						<h3 class="mbland_about_values_title"><?php echo esc_html( $v_title ); ?></h3>
						<p class="mbland_about_values_label"><?php echo esc_html( $v_label ); ?></p>
					</div>
					<div class="mbland_about_values_hover">
						<p class="mbland_about_values_tag"><?php echo esc_html( $v_tag ); ?></p>
						<p class="mbland_about_values_desc"><?php echo esc_html( $v_desc ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<!-- ===== END VALUES ===== -->

	</div>
</section>
<!-- ===== END OVERVIEW ===== -->





<!-- ===== START SECTION INFO ===== -->
<?php
$marquee_text   = ! empty( $about_info['marquee_text'] ) ? $about_info['marquee_text'] : 'MBLAND ASSET MANAGEMENT';
$marquee_repeat = ! empty( $about_info['marquee_repeat'] ) ? max( 1, intval( $about_info['marquee_repeat'] ) ) : 4;
$stat_number    = ! empty( $about_info['stat_number'] ) ? $about_info['stat_number'] : '10';
$stat_plus      = isset( $about_info['stat_plus'] ) && $about_info['stat_plus'] !== '' ? $about_info['stat_plus'] : '+';
$stat_unit      = ! empty( $about_info['stat_unit'] ) ? $about_info['stat_unit'] : 'Năm';
$stat_label     = ! empty( $about_info['stat_label'] ) ? $about_info['stat_label'] : 'Hành Trình';
$stat_year      = ! empty( $about_info['stat_year'] ) ? $about_info['stat_year'] : '2015';
$info_desc      = ! empty( $about_info['description'] ) ? $about_info['description'] : 'Được thành lập vào năm 2015, MBLand Asset Management là tập đoàn đa ngành, đã và đang đầu tư một số dự án trong và ngoài nước thuộc lĩnh vực Tài chính - Bất động sản - Du lịch Dịch vụ dưới thương hiệu của một số Công ty con - Công ty liên kết như MBland Holdings, F&S Investment, Tonkin Properties, Golden Field,.. với các dự án trọng điểm tại Đà Nẵng, Hội An, Quảng Ngãi, Hà Nội, Quảng Ninh, Nha Trang, Tp Hồ Chí Minh,...';
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
	</div>
</section>
<!-- ===== END SECTION INFO ===== -->





<!-- ===== START GOALS ===== -->
<?php
$goals_list = ! empty( $about_goals['goals'] ) && is_array( $about_goals['goals'] ) ? $about_goals['goals'] : array(
	array(
		'title'   => 'Tầm Nhìn',
		'content' => 'Trở thành tập đoàn uy tín toàn cầu, tiên phong trong việc ứng dụng công nghệ và mô hình quản trị hiện đại.',
	),
	array(
		'title'   => 'Sứ Mệnh',
		'content' => 'Mang đến giải pháp tối ưu, hỗ trợ doanh nghiệp và nhà đầu tư đạt được sự thịnh vượng, thúc đẩy phát triển bền vững.',
	),
	array(
		'title'   => 'Giá Trị Cốt Lõi',
		'content' => 'Coi trọng uy tín làm đầu; Dùng trí tuệ để quản trị; Luôn tận tâm phục vụ; Cam kết sự công minh.',
	),
);
?>
<section class="mbland_about_goals">
	<div class="container mbland_about_goals_container">
		<div class="mbland_about_goals_list">
			<?php
			$total_goals = count( $goals_list );
			foreach ( $goals_list as $g_index => $g_item ) :
				$g_title   = ! empty( $g_item['title'] ) ? $g_item['title'] : '';
				$g_content = ! empty( $g_item['content'] ) ? $g_item['content'] : '';
				$g_icon    = ! empty( $g_item['icon']['url'] ) ? $g_item['icon']['url'] : '/wp-content/uploads/2025/10/qlementine-icons_target-16.svg';
				$g_icon_w  = ! empty( $g_item['icon']['width'] ) ? $g_item['icon']['width'] : 50;
				$g_icon_h  = ! empty( $g_item['icon']['height'] ) ? $g_item['icon']['height'] : 50;
				?>
				<div class="mbland_about_goals_item">
					<div class="mbland_about_goals_head">
						<img loading="lazy" decoding="async" fetchpriority="low"
							 src="<?php echo esc_url( $g_icon ); ?>"
							 alt="<?php echo esc_attr( $g_title ); ?>"
							 class="mbland_about_goals_icon"
							 title="<?php echo esc_attr( $g_title ); ?>"
							 width="<?php echo esc_attr( $g_icon_w ); ?>"
							 height="<?php echo esc_attr( $g_icon_h ); ?>"
						/>
						<h3 class="mbland_about_goals_title"><?php echo esc_html( $g_title ); ?></h3>
					</div>
					<p class="mbland_about_goals_content">
						<?php echo nl2br( esc_html( $g_content ) ); ?>
					</p>
				</div>

				<?php if ( $g_index < $total_goals - 1 ) : ?>
					<div class="mbland_about_goals_itemDivider">
						<span class="mbland_about_goals_itemDividerDot"></span>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- ===== END GOALS ===== -->





<!-- ==== START SECTION COMPANY ==== -->
<?php
$sub_intro_img   = ! empty( $about_subsidiaries['intro_image']['url'] ) ? $about_subsidiaries['intro_image']['url'] : '/wp-content/uploads/2026/11/gioi-thieu-cong-ty-cua-chung-toi-image-1.jpg';
$sub_intro_w     = ! empty( $about_subsidiaries['intro_image']['width'] ) ? $about_subsidiaries['intro_image']['width'] : 1634;
$sub_intro_h     = ! empty( $about_subsidiaries['intro_image']['height'] ) ? $about_subsidiaries['intro_image']['height'] : 919;
$sub_intro_title = ! empty( $about_subsidiaries['intro_title'] ) ? $about_subsidiaries['intro_title'] : 'Hệ thống Công ty con';

$companies_list = ! empty( $about_subsidiaries['companies'] ) && is_array( $about_subsidiaries['companies'] ) ? $about_subsidiaries['companies'] : array(
	array(
		'brand_prefix' => 'CÔNG TY CỔ PHẦN TẬP ĐOÀN',
		'brand_logo'   => array(
			'url'    => '/wp-content/uploads/2026/11/logo_mbland-asset-management.png',
			'width'  => 1408,
			'height' => 104,
		),
		'description'  => 'Với định hướng phát triển bền vững, lấy uy tín và chất lượng làm nền tảng, MBLand Asset Management không ngừng mở rộng hệ sinh thái đầu tư, kết nối các đối tác trong nước và quốc tế, hướng đến kiến tạo những giá trị lâu dài cho khách hàng, đối tác và cộng đồng.',
	),
	array(
		'brand_prefix' => 'CÔNG TY ĐẦU TƯ',
		'brand_logo'   => array(
			'url'    => '/wp-content/uploads/2025/10/logo-fs.png',
			'width'  => 1844,
			'height' => 841,
		),
		'description'  => 'F&S Investment là công ty thành viên chuyên sâu trong lĩnh vực đầu tư tài chính và phát triển dự án, mang lại hiệu quả vượt trội cho đối tác và khách hàng.',
	),
	array(
		'brand_prefix' => 'CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN',
		'brand_logo'   => array(
			'url'    => '/wp-content/uploads/2025/10/logo-mb-landdanang.png',
			'width'  => 366,
			'height' => 134,
		),
		'description'  => 'MBLand Đà Nẵng đóng vai trò phát triển các dự án bất động sản trọng điểm tại miền Trung với chất lượng và đẳng cấp hàng đầu.',
	),
	array(
		'brand_prefix' => 'CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN',
		'brand_logo'   => array(
			'url'    => '/wp-content/uploads/2026/11/MBLand-Tonkin-Hoi-an.png',
			'width'  => 196,
			'height' => 58,
		),
		'description'  => 'MBLand Tonkin Hội An định hình các sản phẩm bất động sản nghỉ dưỡng cao cấp, kết nối văn hóa bản địa và chuẩn mực quốc tế.',
	),
);

// Lấy thông tin công ty đầu tiên để hiển thị mặc định ở trên
$first_company    = ! empty( $companies_list[0] ) ? $companies_list[0] : array();
$sub_brand_prefix = ! empty( $first_company['brand_prefix'] ) ? $first_company['brand_prefix'] : 'CÔNG TY CỔ PHẦN TẬP ĐOÀN';
$sub_brand_logo   = ! empty( $first_company['brand_logo']['url'] ) ? $first_company['brand_logo']['url'] : '/wp-content/uploads/2026/11/logo_mbland-asset-management.png';
$sub_logo_w       = ! empty( $first_company['brand_logo']['width'] ) ? $first_company['brand_logo']['width'] : 1408;
$sub_logo_h       = ! empty( $first_company['brand_logo']['height'] ) ? $first_company['brand_logo']['height'] : 104;
$sub_intro_desc   = ! empty( $first_company['description'] ) ? $first_company['description'] : '';
?>
<section class="mbland_homepage_company">
	<div class="container">
		<div class="mbland_homepage_company_wrapper mbland_homepage_company_introWrapper">
			<div class="mbland_homepage_company_media mbland_homepage_company_introMedia">
				<img loading="lazy" decoding="async" fetchpriority="low"
					 class="mbland_homepage_company_image mbland_homepage_company_introImage"
					 src="<?php echo esc_url( $sub_intro_img ); ?>"
					 alt="<?php echo esc_attr( $sub_intro_title ); ?>"
					 title="<?php echo esc_attr( $sub_intro_title ); ?>"
					 width="<?php echo esc_attr( $sub_intro_w ); ?>"
					 height="<?php echo esc_attr( $sub_intro_h ); ?>"
				/>
			</div>
			<div class="mbland_homepage_company_body mbland_homepage_company_introBody">
				<header class="mbland_homepage_company_introHeader">
					<h2 class="mbland_homepage_company_introTitle"><?php echo esc_html( $sub_intro_title ); ?></h2>
					<div class="mbland_homepage_company_nav">
						<button type="button" class="mbland_homepage_company_btn mbland_homepage_company_btnPrev" aria-label="Previous slide">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M15 19L8 12L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
						<button type="button" class="mbland_homepage_company_btn mbland_homepage_company_btnNext" aria-label="Next slide">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
					</div>
				</header>
				<div class="mbland_homepage_company_introContent">
					<div class="mbland_homepage_company_introBrand">
						<p class="mbland_homepage_company_introBrandName"><?php echo esc_html( $sub_brand_prefix ); ?></p>
						<img loading="lazy" decoding="async" fetchpriority="low"
							 class="mbland_homepage_company_introBrandLogo"
							 src="<?php echo esc_url( $sub_brand_logo ); ?>"
							 alt="<?php echo esc_attr( $sub_brand_prefix ); ?>"
							 title="<?php echo esc_attr( $sub_brand_prefix ); ?>"
							 width="<?php echo esc_attr( $sub_logo_w ); ?>"
							 height="<?php echo esc_attr( $sub_logo_h ); ?>"
						/>
					</div>
					<p class="mbland_homepage_company_introDesc">
						<?php echo nl2br( esc_html( $sub_intro_desc ) ); ?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="mbland_homepage_company_showcase">
		<div class="container">
			<div class="mbland_homepage_company_wrapper mbland_homepage_company_showcaseWrapper">
				<div class="mbland_homepage_company_media mbland_homepage_company_showcaseMedia"></div>
				<div class="mbland_homepage_company_showcaseBody mbland_homepage_company_body">
					<div class="swiper mbland_homepage_company_showcaseList">
						<div class="swiper-wrapper mbland_homepage_company_showcaseWrapperList">
							<?php
							foreach ( $companies_list as $c_idx => $c_item ) :
								$c_num      = sprintf( '%02d', $c_idx + 1 );
								$c_prefix   = ! empty( $c_item['brand_prefix'] ) ? $c_item['brand_prefix'] : '';
								$c_logo     = ! empty( $c_item['brand_logo']['url'] ) ? $c_item['brand_logo']['url'] : '';
								$c_logo_w   = ! empty( $c_item['brand_logo']['width'] ) ? $c_item['brand_logo']['width'] : 300;
								$c_logo_h   = ! empty( $c_item['brand_logo']['height'] ) ? $c_item['brand_logo']['height'] : 150;
								$c_desc     = ! empty( $c_item['description'] ) ? $c_item['description'] : '';
								if ( empty( $c_logo ) ) {
									continue;
								}
								$is_active = ( $c_idx === 0 ) ? ' active' : '';
								?>
								<div class="swiper-slide mbland_homepage_company_showcaseItem<?php echo esc_attr( $is_active ); ?>"
									 data-prefix="<?php echo esc_attr( $c_prefix ); ?>"
									 data-logo="<?php echo esc_url( $c_logo ); ?>"
									 data-desc="<?php echo esc_attr( $c_desc ); ?>">
									<p class="mbland_homepage_company_showcaseNumber"><?php echo esc_html( $c_num ); ?></p>
									<img loading="lazy" decoding="async" fetchpriority="low"
										 class="mbland_homepage_company_showcaseImage mbland_homepage_company_showcaseLogo"
										 src="<?php echo esc_url( $c_logo ); ?>"
										 alt="<?php echo esc_attr( $c_prefix ); ?>"
										 title="<?php echo esc_attr( $c_prefix ); ?>"
										 width="<?php echo esc_attr( $c_logo_w ); ?>"
										 height="<?php echo esc_attr( $c_logo_h ); ?>"
									/>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-pagination mbland_homepage_company_showcasePagination"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ==== END SECTION COMPANY ==== -->





<!-- ==== START SECTION TEAMS ==== -->
<?php
$team_title   = ! empty( $about_team['title'] ) ? $about_team['title'] : 'Đội ngũ lãnh đạo';
$team_desc    = ! empty( $about_team['desc'] ) ? $about_team['desc'] : 'Tầm nhìn chiến lược, bản lĩnh lãnh đạo và kinh nghiệm chuyên sâu là nền tảng tạo nên những giá trị khác biệt của MBLand Asset Management';
$featured_pos = ! empty( $about_team['featured_position'] ) ? $about_team['featured_position'] : 'Chủ tịch hội đồng sáng lập';
$featured_name = ! empty( $about_team['featured_name'] ) ? $about_team['featured_name'] : 'Vũ Thành Huế';
$featured_img  = ! empty( $about_team['featured_image']['url'] ) ? $about_team['featured_image']['url'] : '/wp-content/uploads/2026/11/Vu-Thanh-Hue.jpg';
$featured_img_w = ! empty( $about_team['featured_image']['width'] ) ? $about_team['featured_image']['width'] : 600;
$featured_img_h = ! empty( $about_team['featured_image']['height'] ) ? $about_team['featured_image']['height'] : 600;
$featured_bio  = ! empty( $about_team['featured_bio'] ) ? $about_team['featured_bio'] : '';

$team_members = ! empty( $about_team['members'] ) && is_array( $about_team['members'] ) ? $about_team['members'] : array();
?>
<section class="mbland_aboutUs_teamSection">
	<div class="container mbland_aboutUs_teamSection_container">
		<div class="mbland_aboutUs_teamSection_wrapper">
			<header class="mbland_aboutUs_teamSection_header">
				<h2 class="mbland_aboutUs_teamSection_title"><?php echo esc_html( $team_title ); ?></h2>
				<p class="mbland_aboutUs_teamSection_desc"><?php echo nl2br( esc_html( $team_desc ) ); ?></p>
			</header>
			<div class="mbland_aboutUs_teamSection_body">
				<article class="mbland_aboutUs_teamSection_featured">
					<div class="mbland_aboutUs_teamSection_featuredContent">
						<header class="mbland_aboutUs_teamSection_featuredHeader">
							<p class="mbland_aboutUs_teamSection_featuredPosition"><?php echo esc_html( $featured_pos ); ?></p>
							<h3 class="mbland_aboutUs_teamSection_featuredName"><?php echo esc_html( $featured_name ); ?></h3>
						</header>
						<div class="mbland_aboutUs_teamSection_featuredBio">
							<?php if ( ! empty( $featured_bio ) ) : ?>
								<?php echo wp_kses_post( $featured_bio ); ?>
							<?php else : ?>
								<p class="mbland_aboutUs_teamSection_featuredText">Tuổi lên 10 chính là thời điểm vàng, là lúc đủ độ nén, độ chín, độ bật. Dù từng trải qua sóng gió, người Tasman luôn được nhắc nhở: Khởi đầu vào mùa xuân, chúng ta phải kiến tạo nên những mùa xuân đẹp của sức trẻ và sáng tạo, mãi tươi xanh như màu áo lính!</p>
								<p class="mbland_aboutUs_teamSection_featuredText">Ông Vũ Thành Huế hiện đang giữ vị trí Chủ tịch Hội đồng Quản trị Tập đoàn MBLand Asset Management – người đặt nền móng và dẫn dắt tập đoàn trong suốt chặng đường hình thành và phát triển. Với tầm nhìn chiến lược, tư duy đổi mới và tinh thần tiên phong, ông đã góp phần đưa MBLand Asset Management trở thành một trong những tập đoàn uy tín, đa ngành và có sức ảnh hưởng trên thị trường trong nước lẫn quốc tế.</p>
								<p class="mbland_aboutUs_teamSection_featuredText">Với quan điểm “Con người là trung tâm, giá trị bền vững là mục tiêu”, ông Vũ Thành Huế luôn chú trọng đến việc phát triển đội ngũ nhân sự, xem đây là tài sản quý giá nhất của MBLand Asset Management. Bằng sự dẫn dắt quyết đoán, ông không chỉ định hình chiến lược kinh doanh mà còn truyền cảm hứng đổi mới, kiến tạo môi trường làm việc chuyên nghiệp, năng động và nhân văn.</p>
							<?php endif; ?>
						</div>
					</div>
					<figure class="mbland_aboutUs_teamSection_featuredMedia">
						<img loading="lazy" decoding="async" fetchpriority="low"
							 class="mbland_aboutUs_teamSection_featuredImage"
							 src="<?php echo esc_url( $featured_img ); ?>"
							 alt="<?php echo esc_attr( $featured_name ); ?>"
							 title="<?php echo esc_attr( $featured_name ); ?>"
							 width="<?php echo esc_attr( $featured_img_w ); ?>"
							 height="<?php echo esc_attr( $featured_img_h ); ?>"
						/>
					</figure>
				</article>

				<?php if ( ! empty( $team_members ) ) : ?>
					<div class="swiper mbland_aboutUs_teamSection_members">
						<div class="swiper-wrapper mbland_aboutUs_teamSection_membersWrapper">
							<?php
							foreach ( $team_members as $member ) :
								$m_name      = ! empty( $member['name'] ) ? $member['name'] : '';
								$m_pos       = ! empty( $member['position'] ) ? $member['position'] : '';
								$m_img       = ! empty( $member['image']['url'] ) ? $member['image']['url'] : '/wp-content/uploads/2026/11/Vu-Thanh-Hue.jpg';
								$m_img_w     = ! empty( $member['image']['width'] ) ? $member['image']['width'] : 450;
								$m_img_h     = ! empty( $member['image']['height'] ) ? $member['image']['height'] : 600;
								$m_timelines = ! empty( $member['timeline'] ) && is_array( $member['timeline'] ) ? $member['timeline'] : array();
								?>
								<article class="swiper-slide mbland_aboutUs_teamSection_member">
									<div class="mbland_aboutUs_teamSection_memberCard">
										<img loading="lazy" decoding="async" fetchpriority="low"
											 class="mbland_aboutUs_teamSection_memberImage"
											 src="<?php echo esc_url( $m_img ); ?>"
											 alt="<?php echo esc_attr( $m_name ); ?>"
											 title="<?php echo esc_attr( $m_name ); ?>"
											 width="<?php echo esc_attr( $m_img_w ); ?>"
											 height="<?php echo esc_attr( $m_img_h ); ?>"
										/>
										<div class="mbland_aboutUs_teamSection_memberInfo">
											<h3 class="mbland_aboutUs_teamSection_memberName"><?php echo esc_html( $m_name ); ?></h3>
											<p class="mbland_aboutUs_teamSection_memberPosition"><?php echo esc_html( $m_pos ); ?></p>
										</div>
									</div>
									<div class="mbland_aboutUs_teamSection_memberDetail">
										<header class="mbland_aboutUs_teamSection_memberDetailHeader">
											<p class="mbland_aboutUs_teamSection_memberDetailName"><?php echo esc_html( $m_name ); ?></p>
											<p class="mbland_aboutUs_teamSection_memberDetailPosition"><?php echo esc_html( $m_pos ); ?></p>
										</header>
										<?php if ( ! empty( $m_timelines ) ) : ?>
											<ul class="mbland_aboutUs_teamSection_memberTimeline">
												<?php foreach ( $m_timelines as $t_item ) : ?>
													<li class="mbland_aboutUs_teamSection_memberTimelineItem">
														<strong class="mbland_aboutUs_teamSection_memberTimelineYear"><?php echo esc_html( ! empty( $t_item['year'] ) ? $t_item['year'] : '' ); ?> </strong>
														<?php echo esc_html( ! empty( $t_item['role'] ) ? $t_item['role'] : '' ); ?>
													</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</div>
								</article>
							<?php endforeach; ?>
						</div>
					</div>
				<?php else : ?>
					<!-- Fallback khi chưa nhập danh sách thành viên -->
					<div class="swiper mbland_aboutUs_teamSection_members">
						<div class="swiper-wrapper mbland_aboutUs_teamSection_membersWrapper">
							<?php for ( $fb = 0; $fb < 4; $fb++ ) : ?>
								<article class="swiper-slide mbland_aboutUs_teamSection_member">
									<div class="mbland_aboutUs_teamSection_memberCard">
										<img loading="lazy" decoding="async" fetchpriority="low"
											 class="mbland_aboutUs_teamSection_memberImage"
											 src="/wp-content/uploads/2026/11/Vu-Thanh-Hue.jpg"
											 alt="Vũ Thị Hương Giang"
											 title="Vũ Thị Hương Giang"
											 width="450" height="600"
										/>
										<div class="mbland_aboutUs_teamSection_memberInfo">
											<h3 class="mbland_aboutUs_teamSection_memberName">Vũ Thị Hương Giang</h3>
											<p class="mbland_aboutUs_teamSection_memberPosition">Chủ tịch Hội đồng Quản Trị</p>
										</div>
									</div>
									<div class="mbland_aboutUs_teamSection_memberDetail">
										<header class="mbland_aboutUs_teamSection_memberDetailHeader">
											<p class="mbland_aboutUs_teamSection_memberDetailName">Vũ Thị Hương Giang</p>
											<p class="mbland_aboutUs_teamSection_memberDetailPosition">Chủ tịch Hội đồng Quản Trị</p>
										</header>
										<ul class="mbland_aboutUs_teamSection_memberTimeline">
											<li class="mbland_aboutUs_teamSection_memberTimelineItem"><strong class="mbland_aboutUs_teamSection_memberTimelineYear">2012-2018: </strong> Phó Tổng Giám đốc thường trực – CEN LAND</li>
											<li class="mbland_aboutUs_teamSection_memberTimelineItem"><strong class="mbland_aboutUs_teamSection_memberTimelineYear">2012-2018: </strong> Phó Tổng Giám đốc thường trực – CEN LAND</li>
										</ul>
									</div>
								</article>
							<?php endfor; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<!-- ==== END SECTION TEAMS ==== -->





<?php get_template_part( 'template-parts/sections/brands' ); ?>

<!-- ===== START SECTION CONTACT ===== -->
<?php get_template_part( 'template-parts/sections/contact-form' ); ?>
<!-- ===== END SECTION CONTACT ===== -->

<?php get_footer(); ?>
