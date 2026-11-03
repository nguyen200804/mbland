<?php
/*
Template Name: Chi tiết bài tuyển dụng
*/
get_header();
?>
<section class="hn-tasmania-career-detaiL">
  <div class="container">
	  <?php echo do_shortcode('[hn_breadcrumb]'); ?>
		<?php
		while (have_posts()) : the_post();
		
		  $terms_noilam = get_the_terms(get_the_ID(), 'noi-lam-viec');
		  $noilam = ($terms_noilam && !is_wp_error($terms_noilam))
		      ? join(', ', wp_list_pluck($terms_noilam, 'name'))
		      : 'Đang cập nhật';
		
		  $terms_hinhthuc = get_the_terms(get_the_ID(), 'hinh-thuc-lam-viec');
		  $hinhthuc = ($terms_hinhthuc && !is_wp_error($terms_hinhthuc))
		      ? join(', ', wp_list_pluck($terms_hinhthuc, 'name'))
		      : 'Không xác định';
		
		  $luong = get_field('muc_luong');
		  $diadiem = get_field('dia_diem_lam_viec');
		  $hannop = get_field('han_nop_ho_so');
		  $capbac = get_field('cap_bac');
		  $kinhnghiem = get_field('yeu_cau_kinh_nghiem');
		?>

	<div class="job-detail-header">
      <div class="left">
        <h1><?php the_title(); ?></h1>
        <p class="address">
          <span class="title"><?php echo pll__('Địa điểm làm việc'); ?>: </span
          ><?php echo $noilam; ?>
        </p>
      </div>
      <div class="right">
        <div class="badges">
          <span class="badge"><?php echo $hinhthuc; ?></span>
          <span class="badge"><?php echo $noilam; ?></span>
        </div>
      </div>
    </div>

    <div class="job-detail-body">
      <div class="job-sidebar">
        <div class="deadline-box">
          <div class="deadline">
            <img
              src="/wp-content/uploads/2025/10/clock.svg"
              alt="Clock"
              class="img-clock" title="Clock"
            />
            <p class="deadline-title">
               <?php echo pll__('Hạn nộp hồ sơ'); ?>: <?php echo $hannop ?: pll__('Đang cập nhật'); ?>
            </p>
          </div>
          <div class="section-sidebar">
             <p class="title"><?php echo pll__('Mức lương'); ?>:</p>
            <?php echo $luong ?: 'Thỏa thuận'; ?>
          </div>
		  <div class="section-sidebar">
            <p class="title"><?php echo pll__('Địa chỉ'); ?>:</p>
            <?php echo $noilam ?>
          </div>
          <div class="section-sidebar">
            <p class="title"><?php echo pll__('Cấp bậc'); ?>:</p>
            <?php echo $capbac ?: 'Không yêu cầu'; ?>
          </div>
          <div class="section-sidebar">
            <p class="title"><?php echo pll__('Kinh nghiệm'); ?>:</p>
            <?php echo $kinhnghiem ?: 'Không yêu cầu'; ?>
          </div>
        </div>
      </div>

      <div class="job-main">
        <?php the_content(); ?>
      </div>
    </div>
    <?php endwhile; ?>

	 <div class="banner-section">
        <img src="/wp-content/uploads/2025/10/Banner-Tuyen-dung-1.png" alt="Banner tuyển dụng" title="Banner tuyển dụng">
    </div>
	
	<!-- ==================== TIN TUYỂN DỤNG KHÁC ==================== -->
	<div class="related-jobs">
  <h2><?php echo pll__('Tin tuyển dụng khác'); ?>
    <a href="/<?php echo pll__('tuyen dung'); ?>" class="view-all" title="<?php echo pll__('Về trang tuyển dụng'); ?>"><?php echo pll__('Về trang tuyển dụng'); ?></a>
  </h2>

  <div class="hn__job-grid">
    <?php
    $related_jobs = new WP_Query(array(
      'post_type' => 'tuyen-dung',
      'posts_per_page' => 4,
      'post__not_in' => array(get_the_ID()), // bỏ bài hiện tại
      'post_status' => 'publish',
      'orderby' => 'date',
      'order' => 'DESC'
    ));

    if ($related_jobs->have_posts()) :
      while ($related_jobs->have_posts()) : $related_jobs->the_post();
        $hannop = get_field('han_nop_ho_so');
        $luong = get_field('muc_luong');
        $terms_noilam = get_the_terms(get_the_ID(), 'noi-lam-viec');
       $noilam = ($terms_noilam && !is_wp_error($terms_noilam))
		      ? join(', ', wp_list_pluck($terms_noilam, 'name'))
		      : 'Đang cập nhật';
    ?>
        <div class="hn__job-item-other">
            <div class="deadline">
				 <img
					  src="/wp-content/uploads/2025/10/clock.svg"
					  alt="Clock"
					  class="img-clock"
					  title="Clock"
					/>
              <span class="deadline-title"><?php echo pll__('Hạn nộp hồ sơ'); ?>: </span> <?php echo $hannop ?: 'Đang cập nhật'; ?>
            </div>
            <h3>[<?php echo get_the_terms(get_the_ID(), 'hinh-thuc-lam-viec')[0]->name ?? 'Full-time'; ?>] - <?php the_title(); ?></h3>
            <p class="info"><b><?php echo pll__('Mức lương'); ?>:</b> <?php echo $luong ?: 'Thỏa thuận'; ?></p>
            <p class="info"><b><?php echo pll__('Địa điểm làm việc'); ?>:</b> <?php echo $noilam; ?></p>
          <a href="<?php the_permalink(); ?>" class="apply-btn" title="<?php the_title(); ?>"><?php echo pll__('Ứng tuyển ngay'); ?></a>
        </div>
    <?php
      endwhile;
      wp_reset_postdata();
    else :
      echo '<p>Hiện chưa có tin tuyển dụng khác.</p>';
    endif;
    ?>
  </div>
</div>
</div>
</section>
<?php get_footer(); ?>
