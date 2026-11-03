<?php
/**
 * Template Name: Đầu tư tài chính
 */

// Redirect về trang chủ
wp_redirect( home_url() );
exit;
get_header(); 
?>
<section class="hn-tasmania-bds">
	<div class="container">
		<?php echo do_shortcode('[hn_breadcrumb]'); ?>
	</div>
</section>
<?php get_footer(); ?>