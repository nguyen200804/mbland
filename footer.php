<?php
/**
 * The template for displaying the footer
 *
 * @package HomeNest Theme
 * @since 1.0
 */

// Xác định nguồn Options: ưu tiên 'layout' (theo options page), fallback 'option'
$opt_id = 'option';
if ( function_exists('get_field') ) {
	if ( get_field('footer_address', 'layout') || get_field('footer_phone_fax', 'layout') || get_field('footer_logo', 'layout') || have_rows('footer_menu_columns', 'layout') ) {
		$opt_id = 'layout';
	}
}

$get_footer_field = function( $field_name, $default = '' ) use ( $opt_id ) {
	if ( ! function_exists('get_field') ) {
		return $default;
	}
	$val = get_field( $field_name, $opt_id );
	if ( ( $val === null || $val === false || $val === '' ) && $opt_id !== 'option' ) {
		$val = get_field( $field_name, 'option' );
	} elseif ( ( $val === null || $val === false || $val === '' ) && $opt_id !== 'layout' ) {
		$val = get_field( $field_name, 'layout' );
	}
	return ( $val !== null && $val !== false && $val !== '' ) ? $val : $default;
};

// 1. Logo
$footer_logo_raw = $get_footer_field('footer_logo');
$logo_url        = '';
$logo_alt        = 'Logo MBLand Asset Management White';

if ( is_array($footer_logo_raw) ) {
	$logo_url = $footer_logo_raw['url'] ?? '';
	if ( ! empty($footer_logo_raw['alt']) ) {
		$logo_alt = $footer_logo_raw['alt'];
	}
} elseif ( is_numeric($footer_logo_raw) ) {
	$logo_url = wp_get_attachment_image_url($footer_logo_raw, 'full');
} elseif ( is_string($footer_logo_raw) && ! empty($footer_logo_raw) ) {
	$logo_url = $footer_logo_raw;
}

if ( empty($logo_url) ) {
	$logo_url = '/wp-content/uploads/2026/11/Logo_MBLandAM_horonzial-white.png';
}

// 2. Thông tin liên hệ
$footer_address    = $get_footer_field('footer_address', '113 Nguyễn Văn Hưởng, Phường Thảo Điền, Quận 2, TP.Hồ Chí Minh.');
$footer_phone_fax  = $get_footer_field('footer_phone_fax', '028 38 258 816');
$footer_phone_call = $get_footer_field('footer_phone_call', preg_replace('/[^0-9]/', '', (string)$footer_phone_fax));
$footer_email      = $get_footer_field('footer_email', 'info@tasmaniapartners.vn');

// 3. Mạng xã hội (mặc định gán '#' nếu không có giá trị)
$social_title     = $get_footer_field('footer_social_title', 'Kết nối với chúng tôi');
$social_facebook  = $get_footer_field('social_facebook', '#');
$social_instagram = $get_footer_field('social_instagram', '#');
$social_linkedin  = $get_footer_field('social_linkedin', '#');
$social_youtube   = $get_footer_field('social_youtube', '#');
$social_zalo      = $get_footer_field('social_zalo', '#');

// Đảm bảo nếu để trống hoặc chuỗi trắng thì luôn là '#'
$social_facebook  = ! empty(trim((string)$social_facebook)) ? trim((string)$social_facebook) : '#';
$social_instagram = ! empty(trim((string)$social_instagram)) ? trim((string)$social_instagram) : '#';
$social_linkedin  = ! empty(trim((string)$social_linkedin)) ? trim((string)$social_linkedin) : '#';
$social_youtube   = ! empty(trim((string)$social_youtube)) ? trim((string)$social_youtube) : '#';
$social_zalo      = ! empty(trim((string)$social_zalo)) ? trim((string)$social_zalo) : '#';

// 4. Bản quyền
$footer_copyright = $get_footer_field('footer_copyright', '© 2025. MBLand Asset Management. Design by <a class="mbland-footer__copyright-link" href="https://homenest.com.vn/" target="_blank" rel="noopener">HomeNest Software</a>');

// 5. Cột menu (Repeater)
$menu_source = ( function_exists('have_rows') && have_rows('footer_menu_columns', 'layout') ) ? 'layout' : 'option';
$has_menu_repeater = ( function_exists('have_rows') && have_rows('footer_menu_columns', $menu_source) );
?>
</main>
<footer class="mbland-footer">
	<div class="container">
		<div class="mbland-footer__wrapper">

			<!-- Cột trái: thương hiệu + liên hệ + mạng xã hội -->
			<div class="mbland-footer__top">
				<div class="mbland-footer__brand">
					<a class="mbland-footer__logo-link" href="<?php echo esc_url(home_url('/')); ?>">
						<img class="mbland-footer__logo" 
						     src="<?php echo esc_url($logo_url); ?>" 
						     alt="<?php echo esc_attr($logo_alt); ?>" 
						     title="<?php echo esc_attr($logo_alt); ?>" 
						     loading="lazy" 
						     decoding="async" 
						     fetchpriority="low" 
						     <?php if ( function_exists('mbland_img_size_attr') ) { echo trim( mbland_img_size_attr( $logo_url, 1408, 104 ) ); } ?> >
					</a>
					<ul class="mbland-footer__contact-list">
						<?php if ( ! empty($footer_address) ) : ?>
							<li class="mbland-footer__contact-item">
								<svg class="mbland-footer__contact-icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path d="M10 1.25C8.1773 1.25215 6.42987 1.97717 5.14102 3.26602C3.85217 4.55486 3.12715 6.3023 3.125 8.125C3.12333 9.61443 3.60982 11.0634 4.51 12.25C4.51 12.25 4.6975 12.4969 4.72813 12.5325L10 18.75L15.2744 12.5294C15.3019 12.4963 15.49 12.25 15.49 12.25L15.4906 12.2481C16.3902 11.0619 16.8765 9.61372 16.875 8.125C16.8729 6.3023 16.1478 4.55486 14.859 3.26602C13.5701 1.97717 11.8227 1.25215 10 1.25ZM10 10.625C9.50555 10.625 9.0222 10.4784 8.61108 10.2037C8.19996 9.92897 7.87952 9.53852 7.69031 9.08171C7.50109 8.62489 7.45158 8.12223 7.54804 7.63727C7.6445 7.15232 7.88261 6.70686 8.23224 6.35723C8.58187 6.0076 9.02733 5.7695 9.51228 5.67304C9.99723 5.57657 10.4999 5.62608 10.9567 5.8153C11.4135 6.00452 11.804 6.32495 12.0787 6.73607C12.3534 7.1472 12.5 7.63055 12.5 8.125C12.4992 8.78779 12.2355 9.42319 11.7669 9.89185C11.2982 10.3605 10.6628 10.6242 10 10.625Z" />
								</svg>
								<span class="mbland-footer__contact-text"><?php echo esc_html($footer_address); ?></span>
							</li>
						<?php endif; ?>

						<?php if ( ! empty($footer_phone_fax) ) : ?>
							<li class="mbland-footer__contact-item">
								<svg class="mbland-footer__contact-icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path d="M16.025 12.7171L13.9084 12.4755C13.6595 12.4462 13.4072 12.4738 13.1705 12.5561C12.9338 12.6383 12.7188 12.7732 12.5417 12.9505L11.0084 14.4838C8.64286 13.2804 6.72009 11.3576 5.5167 8.99212L7.05837 7.45046C7.4167 7.09212 7.5917 6.59212 7.53337 6.08379L7.2917 3.98379C7.24463 3.5772 7.04959 3.20214 6.74375 2.93012C6.43792 2.65809 6.04268 2.50812 5.63337 2.50879H4.1917C3.25003 2.50879 2.4667 3.29212 2.52503 4.23379C2.9667 11.3505 8.65837 17.0338 15.7667 17.4755C16.7084 17.5338 17.4917 16.7505 17.4917 15.8088V14.3671C17.5 13.5255 16.8667 12.8171 16.025 12.7171Z" />
								</svg>
								<span class="mbland-footer__contact-text">
									Phone &amp; Fax: <a href="tel:<?php echo esc_attr($footer_phone_call); ?>" style="color: inherit; text-decoration: none;"><?php echo esc_html($footer_phone_fax); ?></a>
								</span>
							</li>
						<?php endif; ?>

						<?php if ( ! empty($footer_email) ) : ?>
							<li class="mbland-footer__contact-item">
								<svg class="mbland-footer__contact-icon" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path d="M18.3333 6.2793V14.1668C18.3333 14.8045 18.0897 15.4181 17.6522 15.882C17.2148 16.346 16.6165 16.6252 15.98 16.6626L15.8333 16.6668H4.16663C3.52895 16.6668 2.91536 16.4232 2.45141 15.9857C1.98745 15.5483 1.7082 14.95 1.67079 14.3135L1.66663 14.1668V6.2793L9.53746 11.5268L9.63413 11.5818C9.74805 11.6375 9.87317 11.6664 9.99996 11.6664C10.1268 11.6664 10.2519 11.6375 10.3658 11.5818L10.4625 11.5268L18.3333 6.2793Z" />
									<path d="M15.8333 3.33301C16.7333 3.33301 17.5225 3.80801 17.9625 4.52217L9.99998 9.83051L2.03748 4.52217C2.24647 4.18286 2.53355 3.89842 2.87479 3.69258C3.21602 3.48674 3.60152 3.36546 3.99914 3.33884L4.16664 3.33301H15.8333Z" fill-opacity="0.8"/>
								</svg>
								<a class="mbland-footer__contact-text" href="mailto:<?php echo esc_attr($footer_email); ?>" style="color: inherit; text-decoration: none;"><?php echo esc_html($footer_email); ?></a>
							</li>
						<?php endif; ?>
					</ul>
				</div>

				<div class="mbland-footer__social">
					<p class="mbland-footer__social-title"><?php echo esc_html($social_title); ?></p>
					<ul class="mbland-footer__social-list">
						<?php if ( $social_facebook || ! $has_social_data ) : ?>
							<li class="mbland-footer__social-item">
								<a class="mbland-footer__social-link mbland-footer__social-link--facebook" href="<?php echo esc_url($social_facebook ?: '#'); ?>" <?php echo ($social_facebook !== '#') ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
									<svg class="mbland-footer__social-icon" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
										<path d="M33 18C33 9.72 26.28 3 18 3C9.72 3 3 9.72 3 18C3 25.26 8.16 31.305 15 32.7V22.5H12V18H15V14.25C15 11.355 17.355 9 20.25 9H24V13.5H21C20.175 13.5 19.5 14.175 19.5 15V18H24V22.5H19.5V32.925C27.075 32.175 33 25.785 33 18Z"/>
									</svg>
								</a>
							</li>
						<?php endif; ?>

						<?php if ( $social_instagram || ! $has_social_data ) : ?>
							<li class="mbland-footer__social-item">
								<a class="mbland-footer__social-link mbland-footer__social-link--instagram" href="<?php echo esc_url($social_instagram ?: '#'); ?>" <?php echo ($social_instagram !== '#') ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
									<svg class="mbland-footer__social-icon" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
										<path d="M18 13.125C16.7071 13.125 15.4671 13.6386 14.5529 14.5529C13.6386 15.4671 13.125 16.7071 13.125 18C13.125 19.2929 13.6386 20.5329 14.5529 21.4471C15.4671 22.3614 16.7071 22.875 18 22.875C19.2929 22.875 20.5329 22.3614 21.4471 21.4471C22.3614 20.5329 22.875 19.2929 22.875 18C22.875 16.7071 22.3614 15.4671 21.4471 14.5529C20.5329 13.6386 19.2929 13.125 18 13.125Z"/>
										<path d="M10.1549 4.62266C15.369 4.04505 20.6309 4.04505 25.8449 4.62266C28.6934 4.94066 30.9899 7.18316 31.3244 10.0422C31.9423 15.3292 31.9423 20.6702 31.3244 25.9572C30.9899 28.8162 28.6934 31.0587 25.8464 31.3782C20.6319 31.9559 15.3695 31.9559 10.1549 31.3782C7.30643 31.0587 5.00993 28.8162 4.67543 25.9587C4.05741 20.6712 4.05741 15.3297 4.67543 10.0422C5.00993 7.18316 7.30643 4.94066 10.1549 4.62266ZM25.4999 8.99966C25.1021 8.99966 24.7206 9.15769 24.4393 9.439C24.158 9.7203 23.9999 10.1018 23.9999 10.4997C23.9999 10.8975 24.158 11.279 24.4393 11.5603C24.7206 11.8416 25.1021 11.9997 25.4999 11.9997C25.8978 11.9997 26.2793 11.8416 26.5606 11.5603C26.8419 11.279 26.9999 10.8975 26.9999 10.4997C26.9999 10.1018 26.8419 9.7203 26.5606 9.439C26.2793 9.15769 25.8978 8.99966 25.4999 8.99966ZM10.8749 17.9997C10.8749 16.11 11.6256 14.2977 12.9618 12.9615C14.298 11.6253 16.1103 10.8747 17.9999 10.8747C19.8896 10.8747 21.7019 11.6253 23.0381 12.9615C24.3743 14.2977 25.1249 16.11 25.1249 17.9997C25.1249 19.8893 24.3743 21.7016 23.0381 23.0378C21.7019 24.374 19.8896 25.1247 17.9999 25.1247C16.1103 25.1247 14.298 24.374 12.9618 23.0378C11.6256 21.7016 10.8749 19.8893 10.8749 17.9997Z" fill-rule="evenodd" clip-rule="evenodd"/>
									</svg>
								</a>
							</li>
						<?php endif; ?>

						<?php if ( $social_linkedin || ! $has_social_data ) : ?>
							<li class="mbland-footer__social-item">
								<a class="mbland-footer__social-link mbland-footer__social-link--linkedin" href="<?php echo esc_url($social_linkedin ?: '#'); ?>" <?php echo ($social_linkedin !== '#') ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
									<svg class="mbland-footer__social-icon" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
										<path d="M25.9545 3.375H10.0455C8.27637 3.375 6.57971 4.07778 5.32874 5.32874C4.07778 6.57971 3.375 8.27637 3.375 10.0455V25.9545C3.375 27.7236 4.07778 29.4203 5.32874 30.6713C6.57971 31.9222 8.27637 32.625 10.0455 32.625H25.9545C27.7236 32.625 29.4203 31.9222 30.6713 30.6713C31.9222 29.4203 32.625 27.7236 32.625 25.9545V10.0455C32.625 8.27637 31.9222 6.57971 30.6713 5.32874C29.4203 4.07778 27.7236 3.375 25.9545 3.375ZM13.2645 26.988C13.2692 27.0696 13.2572 27.1514 13.2291 27.2282C13.2011 27.305 13.1576 27.3753 13.1014 27.4347C13.0453 27.4942 12.9775 27.5415 12.9024 27.5738C12.8272 27.6061 12.7463 27.6226 12.6645 27.6225H9.9945C9.83349 27.6186 9.68044 27.5516 9.56824 27.4361C9.45605 27.3205 9.39367 27.1656 9.3945 27.0045V15.9C9.39229 15.8198 9.40618 15.74 9.43535 15.6653C9.46451 15.5906 9.50836 15.5225 9.56429 15.465C9.62023 15.4076 9.68712 15.3619 9.76101 15.3307C9.83491 15.2995 9.9143 15.2835 9.9945 15.2835H12.6645C12.7447 15.2835 12.8241 15.2995 12.898 15.3307C12.9719 15.3619 13.0388 15.4076 13.0947 15.465C13.1506 15.5225 13.1945 15.5906 13.2237 15.6653C13.2528 15.74 13.2667 15.8198 13.2645 15.9V26.988ZM11.28 12.948C10.9909 12.9458 10.7051 12.8868 10.4389 12.7741C10.1726 12.6615 9.93119 12.4975 9.72831 12.2916C9.52544 12.0857 9.36512 11.8418 9.2565 11.5739C9.14787 11.306 9.09308 11.0193 9.09525 10.7303C9.09742 10.4412 9.1565 10.1554 9.26912 9.88912C9.38175 9.62289 9.54571 9.38144 9.75165 9.17856C9.95759 8.97569 10.2015 8.81537 10.4694 8.70675C10.7373 8.59812 11.0239 8.54333 11.313 8.5455C11.8868 8.56416 12.4305 8.80631 12.8283 9.22029C13.226 9.63426 13.4462 10.1873 13.4419 10.7613C13.4376 11.3354 13.2091 11.8851 12.8052 12.293C12.4013 12.701 11.854 12.9349 11.28 12.945M27.5055 26.97C27.5048 27.1216 27.4453 27.2669 27.3395 27.3755C27.2338 27.4841 27.09 27.5473 26.9385 27.552H24.12C23.9682 27.5473 23.8243 27.4838 23.7185 27.375C23.6126 27.2661 23.5533 27.1203 23.553 26.9685V21.8325C23.553 21.066 23.787 18.498 21.519 18.498C19.7505 18.498 19.401 20.298 19.3335 21.099V27.0855C19.3336 27.2376 19.2744 27.3837 19.1686 27.4929C19.0627 27.6021 18.9185 27.6658 18.7665 27.6705H16.032C15.8771 27.6701 15.7287 27.6083 15.6193 27.4986C15.5099 27.389 15.4485 27.2404 15.4485 27.0855V15.846C15.4532 15.694 15.5169 15.5498 15.6261 15.4439C15.7353 15.3381 15.8814 15.2789 16.0335 15.279H18.7665C18.9186 15.2789 19.0647 15.3381 19.1739 15.4439C19.2831 15.5498 19.3468 15.694 19.3515 15.846V16.8135C19.7505 16.2294 20.3015 15.7654 20.9449 15.4715C21.5883 15.1775 22.2997 15.0648 23.0025 15.1455C27.555 15.1455 27.5385 19.398 27.5385 21.816L27.5055 26.97Z"/>
									</svg>
								</a>
							</li>
						<?php endif; ?>

						<?php if ( $social_youtube || ! $has_social_data ) : ?>
							<li class="mbland-footer__social-item">
								<a class="mbland-footer__social-link mbland-footer__social-link--youtube" href="<?php echo esc_url($social_youtube ?: '#'); ?>" <?php echo ($social_youtube !== '#') ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
									<svg class="mbland-footer__social-icon" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
										<path d="M8.64 3C7.14418 3 5.70962 3.59421 4.65192 4.65192C3.59421 5.70962 3 7.14418 3 8.64V27.36C3 28.8558 3.59421 30.2904 4.65192 31.3481C5.70962 32.4058 7.14418 33 8.64 33H27.36C28.1007 33 28.8341 32.8541 29.5183 32.5707C30.2026 32.2872 30.8244 31.8718 31.3481 31.3481C31.8718 30.8244 32.2872 30.2026 32.5707 29.5183C32.8541 28.8341 33 28.1007 33 27.36V8.64C33 7.89934 32.8541 7.16594 32.5707 6.48167C32.2872 5.79739 31.8718 5.17564 31.3481 4.65192C30.8244 4.1282 30.2026 3.71276 29.5183 3.42932C28.8341 3.14588 28.1007 3 27.36 3H8.64ZM11.4225 10.0395H24.5775C25.1913 10.0397 25.799 10.1608 26.366 10.3959C26.9331 10.6309 27.4482 10.9754 27.8821 11.4095C28.316 11.8437 28.6601 12.3591 28.8948 12.9262C29.1295 13.4934 29.2502 14.1012 29.25 14.715V21.288C29.25 22.5274 28.7578 23.716 27.8815 24.5925C27.0053 25.469 25.8169 25.9616 24.5775 25.962H11.4225C10.8086 25.9618 10.2007 25.8407 9.63361 25.6055C9.06651 25.3703 8.55129 25.0257 8.11739 24.5914C7.68349 24.1571 7.3394 23.6416 7.10478 23.0742C6.87016 22.5069 6.74961 21.8989 6.75 21.285V14.715C6.75 13.4756 7.24223 12.287 8.11845 11.4105C8.99467 10.534 10.1831 10.0399 11.4225 10.0395ZM15.1425 14.7345C15.0797 14.7379 15.0206 14.7651 14.9772 14.8105C14.9337 14.8559 14.9092 14.9162 14.9085 14.979V21.0315C14.9079 21.0737 14.9182 21.1152 14.9384 21.1523C14.9585 21.1893 14.9879 21.2205 15.0235 21.243C15.0592 21.2654 15.1001 21.2783 15.1422 21.2804C15.1843 21.2825 15.2262 21.2738 15.264 21.255L21.4155 18.3195C21.4568 18.2995 21.4918 18.2684 21.5164 18.2296C21.5411 18.1909 21.5545 18.146 21.5551 18.1001C21.5557 18.0542 21.5436 18.009 21.52 17.9696C21.4964 17.9302 21.4623 17.8981 21.4215 17.877L15.27 14.76C15.2312 14.7397 15.1877 14.7303 15.144 14.733L15.1425 14.7345Z"/>
									</svg>
								</a>
							</li>
						<?php endif; ?>

						<?php if ( $social_zalo || ! $has_social_data ) : ?>
							<li class="mbland-footer__social-item">
								<a class="mbland-footer__social-link mbland-footer__social-link--zalo" href="<?php echo esc_url($social_zalo ?: '#'); ?>" <?php echo ($social_zalo !== '#') ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
									<svg class="mbland-footer__social-icon" viewBox="7 8 35 35" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;display:inline-block">
										<path d="M25.004 10.45h-.015c-7.978 0-14.544 6.565-14.544 14.543 0 2.609.702 5.17 2.032 7.415l-1.951 5.367q-.08.219-.08.453a1.33 1.33 0 0 0 1.774 1.243l5.368-1.952a14.55 14.55 0 0 0 7.416 2.031c7.982 0 14.551-6.568 14.551-14.55s-6.569-14.55-14.551-14.55m.939 18.021v.021c0 .293.254.548.56.548h.752v-6.143h-1.312v.435a3.2 3.2 0 0 0-1.888-.613 3.187 3.187 0 1 0 1.888 5.752m7.976-5.803a3.214 3.214 0 0 0-3.212 3.211 3.214 3.214 0 0 0 3.212 3.212 3.214 3.214 0 0 0 3.211-3.212 3.214 3.214 0 0 0-3.211-3.211m-5.073 6.372h.931v-8.131h-1.402v7.659a.47.47 0 0 0 .471.472m-8.321-8.131h-6.538v1.402h4.537l-4.474 5.544c-.14.204-.242.395-.242.828v.357h6.169c.306 0 .56-.255.56-.561v-.752h-4.766l4.206-5.276.229-.28.026-.039c.242-.357.293-.662.293-1.032zm3.53 6.869a1.876 1.876 0 0 1-1.874-1.873c0-1.032.841-1.873 1.874-1.873 1.032 0 1.873.841 1.873 1.873a1.87 1.87 0 0 1-1.873 1.873m9.864 0a1.88 1.88 0 0 1-1.886-1.886c0-1.045.841-1.886 1.886-1.886s1.886.841 1.886 1.886a1.88 1.88 0 0 1-1.886 1.886"></path>
									</svg>
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>

			<!-- Cột phải: các nhóm menu -->
			<div class="mbland-footer__nav">
				<?php if ( $has_menu_repeater ) : ?>
					<?php while ( have_rows('footer_menu_columns', $menu_source) ) : the_row(); ?>
						<div class="mbland-footer__nav-col">
							<p class="mbland-footer__nav-title"><?php echo esc_html(get_sub_field('column_title')); ?></p>
							<?php if ( have_rows('column_links') ) : ?>
								<ul class="mbland-footer__nav-list">
									<?php while ( have_rows('column_links') ) : the_row(); 
										$raw_url    = get_sub_field('link_url');
										$link_url   = is_array($raw_url) ? ($raw_url['url'] ?? '') : ($raw_url ?: '');
										$link_url   = ! empty(trim((string)$link_url)) ? trim((string)$link_url) : '#';
										$link_label = get_sub_field('link_label') ?: (is_array($raw_url) ? ($raw_url['title'] ?? '') : '');
										$is_blank   = ( get_sub_field('is_blank') || (is_array($raw_url) && ! empty($raw_url['target']) && $raw_url['target'] === '_blank') ) && $link_url !== '#';
									?>
										<li class="mbland-footer__nav-item">
											<a class="mbland-footer__nav-link" href="<?php echo esc_url($link_url); ?>" <?php echo $is_blank ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
												<?php echo esc_html($link_label); ?>
											</a>
										</li>
									<?php endwhile; ?>
								</ul>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				<?php else : ?>
					<!-- Fallback mặc định khi chưa nhập repeater trong admin -->
					<div class="mbland-footer__nav-col">
						<p class="mbland-footer__nav-title">Menu</p>
						<ul class="mbland-footer__nav-list">
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Trang chủ</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Giới thiệu chúng tôi</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Lĩnh vực hoạt động</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Các đối tác</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Dự án nổi bật</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Hoạt động &amp; Sự kiện</a></li>
						</ul>
					</div>

					<div class="mbland-footer__nav-col">
						<p class="mbland-footer__nav-title">Giới thiệu</p>
						<ul class="mbland-footer__nav-list">
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Trang chủ</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Giới thiệu chúng tôi</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Lĩnh vực hoạt động</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Các đối tác</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Dự án nổi bật</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Hoạt động &amp; Sự kiện</a></li>
						</ul>
					</div>

					<div class="mbland-footer__nav-col">
						<p class="mbland-footer__nav-title">Lĩnh vực hoạt động</p>
						<ul class="mbland-footer__nav-list">
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Trang chủ</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Giới thiệu chúng tôi</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Lĩnh vực hoạt động</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Các đối tác</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Dự án nổi bật</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Hoạt động &amp; Sự kiện</a></li>
						</ul>
					</div>

					<div class="mbland-footer__nav-col">
						<p class="mbland-footer__nav-title">Tin tức</p>
						<ul class="mbland-footer__nav-list">
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Trang chủ</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Giới thiệu chúng tôi</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Lĩnh vực hoạt động</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Các đối tác</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Dự án nổi bật</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Hoạt động &amp; Sự kiện</a></li>
						</ul>
					</div>

					<div class="mbland-footer__nav-col">
						<p class="mbland-footer__nav-title">Tuyển dụng</p>
						<ul class="mbland-footer__nav-list">
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Trang chủ</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Giới thiệu chúng tôi</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Lĩnh vực hoạt động</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Các đối tác</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Dự án nổi bật</a></li>
							<li class="mbland-footer__nav-item"><a class="mbland-footer__nav-link" href="#">Hoạt động &amp; Sự kiện</a></li>
						</ul>
					</div>
				<?php endif; ?>
			</div>

			<!-- Dòng bản quyền -->
			<div class="mbland-footer__bottom">
				<hr class="mbland-footer__divider">
				<div class="mbland-footer__copyright">
					<?php echo wp_kses_post($footer_copyright); ?>
				</div>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>