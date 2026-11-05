<?php
/*
Template Name: Chi tiết bài tuyển dụng
*/
get_header();

while ( have_posts() ) :
	the_post();

	$post_id        = get_the_ID();
	$terms_noilam   = get_the_terms( $post_id, 'noi-lam-viec' );
	$noilam         = ( $terms_noilam && ! is_wp_error( $terms_noilam ) )
		? join( ', ', wp_list_pluck( $terms_noilam, 'name' ) )
		: 'Đang cập nhật';

	$terms_hinhthuc = get_the_terms( $post_id, 'hinh-thuc-lam-viec' );
	$hinhthuc       = ( $terms_hinhthuc && ! is_wp_error( $terms_hinhthuc ) )
		? join( ', ', wp_list_pluck( $terms_hinhthuc, 'name' ) )
		: 'Không xác định';

	$luong          = get_field( 'muc_luong', $post_id );
	$diadiem        = get_field( 'dia_diem_lam_viec', $post_id );
	$hannop         = get_field( 'han_nop_ho_so', $post_id );
	$capbac         = get_field( 'cap_bac', $post_id );
	$kinhnghiem     = get_field( 'yeu_cau_kinh_nghiem', $post_id );
?>

<!-- ==========================================================================
     SECTION 1: BREADCRUMB VÀ HEADER
     ========================================================================== -->
<section class="mbland_singleRecruitment_header">
	<div class="container">
		<div class="mbland_singleRecruitment_header_breadcrumb">
			<?php echo do_shortcode( '[hn_breadcrumb]' ); ?>
		</div>

		<div class="mbland_singleRecruitment_header_wrapper">
			<div class="mbland_singleRecruitment_header_info">
				<h1 class="mbland_singleRecruitment_header_title"><?php the_title(); ?></h1>
				<p class="mbland_singleRecruitment_header_location">
					<span class="mbland_singleRecruitment_header_locationLabel"><?php echo function_exists( 'pll__' ) ? pll__( 'Địa điểm làm việc' ) : 'Địa điểm làm việc'; ?>: </span>
					<span class="mbland_singleRecruitment_header_locationValue"><?php echo esc_html( $noilam ); ?></span>
				</p>
			</div>
			<div class="mbland_singleRecruitment_header_meta">
				<div class="mbland_singleRecruitment_header_badges">
					<span class="mbland_singleRecruitment_header_badge"><?php echo esc_html( $hinhthuc ); ?></span>
					<span class="mbland_singleRecruitment_header_badge"><?php echo esc_html( $noilam ); ?></span>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ==========================================================================
     SECTION 2: CỘT TRÁI LÀ HẠN NỘP HỒ SƠ & NỘI DUNG CHI TIẾT
     ========================================================================== -->
<section class="mbland_singleRecruitment_detail">
	<div class="container">
		<div class="mbland_singleRecruitment_detail_wrapper">
			<!-- Cột trái: Hạn nộp hồ sơ & Thông tin việc làm -->
			<aside class="mbland_singleRecruitment_detail_sidebar">
				<div class="mbland_singleRecruitment_detail_infoBox">
					<div class="mbland_singleRecruitment_detail_deadline">
						<span class="mbland_singleRecruitment_detail_deadlineIcon">
							<img src="/wp-content/uploads/2025/10/clock.svg" alt="Clock" title="Clock" loading="lazy" decoding="async" />
						</span>
						<p class="mbland_singleRecruitment_detail_deadlineText">
							<?php echo function_exists( 'pll__' ) ? pll__( 'Hạn nộp hồ sơ' ) : 'Hạn nộp hồ sơ'; ?>: <?php echo esc_html( $hannop ?: ( function_exists( 'pll__' ) ? pll__( 'Đang cập nhật' ) : 'Đang cập nhật' ) ); ?>
						</p>
					</div>

					<div class="mbland_singleRecruitment_detail_infoItem">
						<p class="mbland_singleRecruitment_detail_infoLabel"><?php echo function_exists( 'pll__' ) ? pll__( 'Mức lương' ) : 'Mức lương'; ?>:</p>
						<span class="mbland_singleRecruitment_detail_infoValue"><?php echo esc_html( $luong ?: 'Thỏa thuận' ); ?></span>
					</div>

					<div class="mbland_singleRecruitment_detail_infoItem">
						<p class="mbland_singleRecruitment_detail_infoLabel"><?php echo function_exists( 'pll__' ) ? pll__( 'Địa chỉ' ) : 'Địa chỉ'; ?>:</p>
						<span class="mbland_singleRecruitment_detail_infoValue"><?php echo esc_html( $noilam ); ?></span>
					</div>

					<div class="mbland_singleRecruitment_detail_infoItem">
						<p class="mbland_singleRecruitment_detail_infoLabel"><?php echo function_exists( 'pll__' ) ? pll__( 'Cấp bậc' ) : 'Cấp bậc'; ?>:</p>
						<span class="mbland_singleRecruitment_detail_infoValue"><?php echo esc_html( $capbac ?: 'Không yêu cầu' ); ?></span>
					</div>

					<div class="mbland_singleRecruitment_detail_infoItem">
						<p class="mbland_singleRecruitment_detail_infoLabel"><?php echo function_exists( 'pll__' ) ? pll__( 'Kinh nghiệm' ) : 'Kinh nghiệm'; ?>:</p>
						<span class="mbland_singleRecruitment_detail_infoValue"><?php echo esc_html( $kinhnghiem ?: 'Không yêu cầu' ); ?></span>
					</div>
				</div>
			</aside>

			<!-- Cột phải: Nội dung bài viết -->
			<div class="mbland_singleRecruitment_detail_main">
				<article class="mbland_singleRecruitment_detail_article">
					<?php the_content(); ?>
				</article>
			</div>
		</div>
	</div>
</section>

<?php endwhile; ?>

<!-- ==========================================================================
     SECTION 3: BANNER HÌNH ẢNH
     ========================================================================== -->
<section class="mbland_singleRecruitment_banner">
	<div class="container">
		<div class="mbland_singleRecruitment_banner_wrapper">
			<img
				class="mbland_singleRecruitment_banner_image"
				src="/wp-content/uploads/2025/10/Banner-Tuyen-dung-1.png"
				alt="Banner tuyển dụng"
				title="Banner tuyển dụng"
				loading="lazy"
				decoding="async"
			/>
		</div>
	</div>
</section>

<!-- ==========================================================================
     SECTION 4: TIN TUYỂN DỤNG KHÁC
     ========================================================================== -->
<section class="mbland_singleRecruitment_otherJobs">
	<div class="container">
		<div class="mbland_singleRecruitment_otherJobs_header">
			<h2 class="mbland_singleRecruitment_otherJobs_heading">
				<?php echo function_exists( 'pll__' ) ? pll__( 'Tin tuyển dụng khác' ) : 'Tin tuyển dụng khác'; ?>
			</h2>
			<a href="<?php echo esc_url( home_url( '/tuyen-dung/' ) ); ?>" class="mbland_singleRecruitment_otherJobs_viewAll" title="<?php echo function_exists( 'pll__' ) ? pll__( 'Về trang tuyển dụng' ) : 'Về trang tuyển dụng'; ?>">
				<?php echo function_exists( 'pll__' ) ? pll__( 'Về trang tuyển dụng' ) : 'Về trang tuyển dụng'; ?>
			</a>
		</div>

		<div class="mbland_singleRecruitment_otherJobs_grid">
			<?php
			$related_jobs = new WP_Query( array(
				'post_type'      => 'tuyen-dung',
				'posts_per_page' => 4,
				'post__not_in'   => array( get_the_ID() ),
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'DESC',
			) );

			if ( $related_jobs->have_posts() ) :
				while ( $related_jobs->have_posts() ) : $related_jobs->the_post();
					$other_hannop         = get_field( 'han_nop_ho_so', get_the_ID() );
					$other_luong          = get_field( 'muc_luong', get_the_ID() );
					$other_terms_noilam   = get_the_terms( get_the_ID(), 'noi-lam-viec' );
					$other_noilam         = ( $other_terms_noilam && ! is_wp_error( $other_terms_noilam ) )
						? join( ', ', wp_list_pluck( $other_terms_noilam, 'name' ) )
						: 'Đang cập nhật';
					$other_hinhthuc_terms = get_the_terms( get_the_ID(), 'hinh-thuc-lam-viec' );
					$other_hinhthuc_name  = ( $other_hinhthuc_terms && ! is_wp_error( $other_hinhthuc_terms ) )
						? $other_hinhthuc_terms[0]->name
						: 'Full-time';
			?>
					<article class="mbland_singleRecruitment_otherJobs_card">
						<div class="mbland_singleRecruitment_otherJobs_deadline">
							<span class="mbland_singleRecruitment_otherJobs_deadlineIcon">
								<img src="/wp-content/uploads/2025/10/clock.svg" alt="Clock" title="Clock" loading="lazy" decoding="async" />
							</span>
							<p class="mbland_singleRecruitment_otherJobs_deadlineText">
								<span class="mbland_singleRecruitment_otherJobs_deadlineLabel"><?php echo function_exists( 'pll__' ) ? pll__( 'Hạn nộp hồ sơ' ) : 'Hạn nộp hồ sơ'; ?>: </span>
								<?php echo esc_html( $other_hannop ?: 'Đang cập nhật' ); ?>
							</p>
						</div>

						<h3 class="mbland_singleRecruitment_otherJobs_title">
							<a href="<?php the_permalink(); ?>" class="mbland_singleRecruitment_otherJobs_titleLink" title="<?php the_title_attribute(); ?>">
								[<?php echo esc_html( $other_hinhthuc_name ); ?>] - <?php the_title(); ?>
							</a>
						</h3>

						<p class="mbland_singleRecruitment_otherJobs_info">
							<b><?php echo function_exists( 'pll__' ) ? pll__( 'Mức lương' ) : 'Mức lương'; ?>:</b> <?php echo esc_html( $other_luong ?: 'Thỏa thuận' ); ?>
						</p>
						<p class="mbland_singleRecruitment_otherJobs_info">
							<b><?php echo function_exists( 'pll__' ) ? pll__( 'Địa điểm làm việc' ) : 'Địa điểm làm việc'; ?>:</b> <?php echo esc_html( $other_noilam ); ?>
						</p>

						<a href="<?php the_permalink(); ?>" class="mbland_singleRecruitment_otherJobs_applyBtn" title="<?php the_title_attribute(); ?>">
							<?php echo function_exists( 'pll__' ) ? pll__( 'Ứng tuyển ngay' ) : 'Ứng tuyển ngay'; ?>
						</a>
					</article>
			<?php
				endwhile;
				wp_reset_postdata();
			else :
				echo '<p>' . ( function_exists( 'pll__' ) ? pll__( 'Hiện chưa có tin tuyển dụng khác.' ) : 'Hiện chưa có tin tuyển dụng khác.' ) . '</p>';
			endif;
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
