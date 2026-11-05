<?php
/**
 * Component UI: Button Detail (Nút Xem chi tiết với hiệu ứng icon thu gọn khi hover).
 *
 * Usage:
 * get_template_part( 'template-parts/ui/button-detail', null, array(
 *     'url'     => get_permalink(),
 *     'label'   => 'XEM CHI TIẾT',      // optional: mặc định 'XEM CHI TIẾT' (tự động dịch Polylang nếu có)
 *     'class'   => '',                  // optional: class bổ sung
 *     'title'   => 'Xem chi tiết',      // optional: thuộc tính title
 *     'target'  => '',                  // optional: '_blank' thêm rel="noopener noreferrer"
 *     'aria'    => '',                  // optional: aria-label
 * ) );
 *
 * @package HomeNest Theme
 */

$default_label = function_exists( 'pll__' ) ? pll__( 'XEM CHI TIẾT' ) : 'XEM CHI TIẾT';

$args = wp_parse_args( $args, array(
	'url'    => '#',
	'label'  => $default_label,
	'class'  => '',
	'title'  => 'Xem chi tiết',
	'target' => '',
	'aria'   => '',
) );

$classes = array( 'mbland-ui-btn-detail' );
if ( ! empty( $args['class'] ) ) {
	$classes[] = sanitize_html_class( $args['class'] );
}
?>
<a
	class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
	href="<?php echo esc_url( $args['url'] ); ?>"
	<?php if ( ! empty( $args['title'] ) ) : ?>title="<?php echo esc_attr( $args['title'] ); ?>"<?php endif; ?>
	<?php if ( ! empty( $args['aria'] ) ) : ?>aria-label="<?php echo esc_attr( $args['aria'] ); ?>"<?php endif; ?>
	<?php if ( '_blank' === $args['target'] ) : ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>
>
	<span class="mbland-ui-btn-detail__label"><?php echo esc_html( $args['label'] ); ?></span>
	<span class="mbland-ui-btn-detail__icon" aria-hidden="true">
		<svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect width="32" height="32" rx="16" fill="#f0d5d9"/>
			<path d="m22.163 19.984-.026-9.847-9.846-.025a.724.724 0 1 0 .01 1.43l7.379.031-9.775 9.776a.723.723 0 1 0 1.022 1.021l9.775-9.775.03 7.379a.723.723 0 0 0 1.446-.005z" fill="var(--primary-color)"/>
		</svg>
	</span>
</a>

