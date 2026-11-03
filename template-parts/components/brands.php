<?php
/**
 * Component: Section "Các đối tác" (tiêu đề + mô tả + danh sách logo qua shortcode [logo_brand]).
 *
 * Usage:
 * get_template_part( 'template-parts/components/brands', null, array(
 *     'title'     => 'Các đối tác của chúng tôi', // optional
 *     'desc'      => '...',                       // optional: để '' để ẩn mô tả
 *     'class'     => '',                          // optional: class thêm vào <section>
 *     'shortcode' => '[logo_brand]',              // optional
 * ) );
 *
 * @package HomeNest Theme
 */

$args = wp_parse_args( $args, array(
	'title'     => 'Các đối tác của chúng tôi',
	'desc'      => 'Chúng tôi trân trọng xây dựng những mối quan hệ hợp tác chiến lược, cùng kết nối nguồn lực, phát huy thế mạnh và hướng đến những giá trị phát triển bền vững.',
	'class'     => '',
	'shortcode' => '[logo_brand]',
) );

$classes = array( 'mbland_brands' );
if ( $args['class'] ) {
	$classes[] = $args['class'];
}
?>
<!-- ===== START SECTION BRANDS ===== -->
<section class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="container">
		<header class="mbland_brands_header">
			<h2 class="mbland_brands_title"><?php echo esc_html( $args['title'] ); ?></h2>
			<?php if ( '' !== $args['desc'] ) : ?>
				<p class="mbland_brands_desc"><?php echo esc_html( $args['desc'] ); ?></p>
			<?php endif; ?>
		</header>
	</div>
	<div class="mbland_brands_list">
		<?php echo do_shortcode( $args['shortcode'] ); ?>
	</div>
</section>
<!-- ===== END SECTION BRANDS ===== -->

