<?php
/**
 * Component: CTA button (link styled as a button).
 *
 * Usage (label co the de trong => nut chi hien icon, nen truyen 'title' hoac 'aria'):
 * get_template_part( 'template-parts/ui/button', null, array(
 *     'url'     => '/gioi-thieu',
 *     'label'   => 'Kết nối hợp tác ngay!',
 *     'class'   => 'hn-tasmania-about__title-cta', // optional: extra classes (layout/position)
 *     'variant' => '',                             // optional: 'outline' => hn-tasmania-cta-btn--outline
 *     'icon'    => true,                           // optional: show arrow icon (default true)
 *     'title'   => '',                             // optional: title attribute
 *     'aria'    => '',                             // optional: aria-label
 *     'target'  => '',                             // optional: '_blank' adds rel="noopener noreferrer"
 *     'loading' => 'lazy',                         // optional: 'eager' cho nut o hero (above the fold)
 * ) );
 *
 * @package HomeNest Theme
 */

$args = wp_parse_args( $args, array(
	'url'     => '#',
	'label'   => '',
	'class'   => '',
	'variant' => '',
	'icon'    => true,
	'title'   => '',
	'aria'    => '',
	'target'  => '',
	'loading' => 'lazy',
) );

// Label rong (nut chi co icon): bat buoc co aria-label de truy cap duoc
if ( '' === $args['label'] && '' === $args['aria'] ) {
	$args['aria'] = $args['title'];
}

$classes = array( 'hn-tasmania-cta-btn' );
if ( $args['variant'] ) {
	$classes[] = 'hn-tasmania-cta-btn--' . sanitize_html_class( $args['variant'] );
}
if ( $args['class'] ) {
	$classes[] = $args['class'];
}
?>
<a
	class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
	href="<?php echo esc_url( $args['url'] ); ?>"
	<?php if ( $args['title'] ) : ?>title="<?php echo esc_attr( $args['title'] ); ?>"<?php endif; ?>
	<?php if ( $args['aria'] ) : ?>aria-label="<?php echo esc_attr( $args['aria'] ); ?>"<?php endif; ?>
	<?php if ( $args['target'] ) : ?>target="<?php echo esc_attr( $args['target'] ); ?>" rel="noopener noreferrer"<?php endif; ?>
>
	<?php if ( '' !== $args['label'] ) : ?><?php echo esc_html( $args['label'] ); ?><?php endif; ?>
	<?php if ( $args['icon'] ) : ?>
		<img
			class="hn-tasmania-cta-btn__icon"
			src="/wp-content/uploads/2025/10/arrow-right.svg"
			alt=""
			aria-hidden="true"
			loading="<?php echo esc_attr( 'eager' === $args['loading'] ? 'eager' : 'lazy' ); ?>"
			decoding="async"
			fetchpriority="<?php echo esc_attr( 'eager' === $args['loading'] ? 'auto' : 'low' ); ?>"
			width="15" height="15"
		/>
	<?php endif; ?>
</a>