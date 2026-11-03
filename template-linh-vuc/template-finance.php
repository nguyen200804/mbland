<?php
/**
 * Template Name: Financial Invesment
 */

// Redirect về trang chủ
wp_redirect( home_url() );
exit;
get_header(); 
?>
<meta name="robots" content="noindex">
<section class="hn-tasmania-bds">
	<div class="container">
		<?php echo do_shortcode('[hn_breadcrumb]'); ?>
	</div>
</section>
<?php get_footer(); ?>