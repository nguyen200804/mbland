<?php
/*
Template Name: Liên Hệ
*/
get_header();
?>
    <section class="mbland_contact_breadcrumb">
      <div class="container">
		<?php echo do_shortcode('[hn_breadcrumb]'); ?>
        
      </div>
    </section>



<!-- ===== START SECTION CONTACT ===== -->
<?php get_template_part( 'template-parts/sections/contact-form', null, array(
	'loading'       => 'eager',
	'fetchpriority' => 'high',
) ); ?>
<!-- ===== END SECTION CONTACT ===== -->
<?php get_footer(); ?>
