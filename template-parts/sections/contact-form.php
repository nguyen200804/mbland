<?php
/**
 * Component: Section "Liên hệ gửi yêu cầu tư vấn" (nền ảnh + form liên hệ).
 *
 * Usage:
 * get_template_part( 'template-parts/sections/contact-form', null, array(
 *     'title'         => 'Liên hệ gửi yêu cầu tư vấn', // optional
 *     'desc'          => '...',                        // optional: '' để ẩn mô tả
 *     'bg'            => '/wp-content/uploads/...jpg', // optional: ảnh nền ('' để bỏ ảnh nền)
 *     'action'        => '#',                          // optional: action của form
 *     'class'         => '',                           // optional: class thêm vào <section>
 *     'id_prefix'     => '',                           // optional: tiền tố id input, tránh trùng id khi dùng nhiều form / trang
 *     'loading'       => 'lazy',                       // optional: 'lazy' (mặc định cho below-the-fold) hoặc 'eager' (nếu ở đầu trang)
 *     'fetchpriority' => 'low',                        // optional: 'low' hoặc 'high'
 * ) );
 *
 * @package HomeNest Theme
 */

$opt_title  = function_exists( 'get_field' ) ? get_field( 'contact_title', 'option' ) : '';
$opt_desc   = function_exists( 'get_field' ) ? get_field( 'contact_desc', 'option' ) : '';
$opt_bg     = function_exists( 'get_field' ) ? get_field( 'contact_bg', 'option' ) : '';
$opt_action = function_exists( 'get_field' ) ? get_field( 'contact_action', 'option' ) : '';

$bg_url = '';
if ( is_array( $opt_bg ) && ! empty( $opt_bg['url'] ) ) {
	$bg_url = $opt_bg['url'];
} elseif ( is_string( $opt_bg ) && ! empty( $opt_bg ) ) {
	$bg_url = $opt_bg;
}

$args = wp_parse_args( $args, array(
	'title'         => ! empty( $opt_title ) ? $opt_title : 'Liên hệ gửi yêu cầu tư vấn',
	'desc'          => ( '' !== $opt_desc && null !== $opt_desc ) ? $opt_desc : 'Kết nối cùng MBLand Asset Management để khám phá những cơ hội hợp tác và giải pháp đầu tư phù hợp với mục tiêu của bạn.',
	'bg'            => ! empty( $bg_url ) ? $bg_url : '/wp-content/uploads/2026/11/background-contact-section.jpg',
	'action'        => ! empty( $opt_action ) ? $opt_action : '#',
	'class'         => '',
	'id_prefix'     => '',
	'loading'       => 'lazy',
	'fetchpriority' => 'low',
) );

$classes = array( 'mbland_contactForm' );
if ( $args['class'] ) {
	$classes[] = $args['class'];
}
$pfx = $args['id_prefix'] ? sanitize_html_class( $args['id_prefix'] ) . '_' : '';
?>
<!-- ===== START SECTION CONTACT FORM ===== -->
<section class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php if ( $args['bg'] ) : ?>
		<img loading="<?php echo esc_attr( $args['loading'] ); ?>" decoding="async" fetchpriority="<?php echo esc_attr( $args['fetchpriority'] ); ?>" class="mbland_contactForm_background" src="<?php echo esc_url( $args['bg'] ); ?>" alt="" aria-hidden="true" width="2560" height="1157" />
	<?php endif; ?>
	<div class="container">
		<div class="mbland_contactForm_wrapper">
			<header class="mbland_contactForm_header">
				<h2 class="mbland_contactForm_title"><?php echo esc_html( $args['title'] ); ?></h2>
				<?php if ( '' !== $args['desc'] ) : ?>
					<p class="mbland_contactForm_desc"><?php echo esc_html( $args['desc'] ); ?></p>
				<?php endif; ?>
			</header>
			<div class="mbland_contactForm_body">
				<form class="mbland_contactForm_form" action="<?php echo esc_url( $args['action'] ); ?>" method="post">
					<div class="mbland_contactForm_field mbland_contactForm_fieldFull">
						<label class="mbland_contactForm_label" for="<?php echo esc_attr( $pfx ); ?>fullname">Họ và tên</label>
						<input class="mbland_contactForm_input" type="text" id="<?php echo esc_attr( $pfx ); ?>fullname" name="fullname" placeholder="Nhập họ &amp; tên của bạn tại đây" autocomplete="name" required>
					</div>

					<div class="mbland_contactForm_field">
						<label class="mbland_contactForm_label" for="<?php echo esc_attr( $pfx ); ?>email">Email</label>
						<input class="mbland_contactForm_input" type="email" id="<?php echo esc_attr( $pfx ); ?>email" name="email" placeholder="mbland@gmail.com" autocomplete="email" required>
					</div>

					<div class="mbland_contactForm_field">
						<label class="mbland_contactForm_label" for="<?php echo esc_attr( $pfx ); ?>phone">Số điện thoại</label>
						<input class="mbland_contactForm_input" type="tel" id="<?php echo esc_attr( $pfx ); ?>phone" name="phone" placeholder="Nhập số điện thoại của bạn" autocomplete="tel" pattern="[0-9+\s]{9,15}" required>
					</div>

					<div class="mbland_contactForm_field mbland_contactForm_fieldFull">
						<label class="mbland_contactForm_label" for="<?php echo esc_attr( $pfx ); ?>message">Nhập nội dung bạn muốn tư vấn</label>
						<textarea class="mbland_contactForm_textarea" id="<?php echo esc_attr( $pfx ); ?>message" name="message" placeholder="Nhập nội dung bạn muốn tư vấn"></textarea>
					</div>

					<div class="mbland_contactForm_submitWrap">
						<button type="submit" class="mbland_contactForm_submitButton">
							<span class="mbland_contactForm_submitLabel">Gửi yêu cầu</span>
							<svg class="mbland_contactForm_submitIcon" viewBox="0 0 24 24" aria-hidden="true"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!-- ===== END SECTION CONTACT FORM ===== -->

