<?php
/**
 * The header for our theme
 *
 * @package HomeNest Theme
 * @since 1.0
 */
?>
<!doctype html>
<html lang="<?php language_attributes(); ?>">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<header class="hn-tasmania-header">
			<div class="container">
				<?php
				$logo_id   = get_theme_mod( 'custom_logo' );
				$logo_data = $logo_id ? wp_get_attachment_image_src( $logo_id, 'full' ) : null;
				$logo_url  = $logo_data ? $logo_data[0] : '';
				$logo_w    = $logo_data ? $logo_data[1] : '';
				$logo_h    = $logo_data ? $logo_data[2] : '';
				$logo_alt  = $logo_id ? ( get_post_meta( $logo_id, '_wp_attachment_image_alt', true ) ?: get_bloginfo( 'name' ) ) : get_bloginfo( 'name' );
				$home_url  = function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' );
				$site_name = get_bloginfo( 'name' );
				?>
				<a
				   class="hn-tasmania-header__logo"
				   href="<?php echo esc_url( $home_url ); ?>"
				   title="<?php echo esc_attr( $site_name ); ?>"
				   >
					<img
						 src="<?php echo esc_url( $logo_url ); ?>"
						 alt="<?php echo esc_attr( $logo_alt ); ?>"
						 title="<?php echo esc_attr( $site_name ); ?>"
						 <?php if ( ! empty( $logo_w ) && ! empty( $logo_h ) ) : ?>
						 width="<?php echo esc_attr( $logo_w ); ?>"
						 height="<?php echo esc_attr( $logo_h ); ?>"
						 <?php endif; ?>
						 loading="eager"
						 decoding="async"
						 fetchpriority="high"
						 />
				</a>
				<div class="hn-tasmania-header-group">
					<nav class="hn-tasmania-header__nav">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container'       => false,    // Không wrap thêm container
							'menu_class'      => 'hn-tasmania-header__nav-list', // Class cho ul chính
							'menu_id'         => '',       // Không cần ID
							'fallback_cb'     => false,    // Không fallback nếu menu không tồn tại
							'depth'           => 2,        // Hiển thị tối đa 2 cấp (parent + children)
							'walker'          => new Custom_Walker_Nav_Menu(), // Sử dụng custom walker để tùy chỉnh class sub-menu (xem code walker bên dưới)
						) );
						?>
					</nav>
					<!-- Header Menu Button -->
					<button class="hn-tasmania-header-menu" id="hamburger-btn">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 640 640">
							<path fill="var(--primary-color)" d="M96 160c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H128c-17.7 0-32-14.3-32-32m0 160c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H128c-17.7 0-32-14.3-32-32m448 160c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32s14.3-32 32-32h384c17.7 0 32 14.3 32 32"/>
						</svg>
					</button>

					<!-- Overlay (di chuyển ra ngoài popup) -->
					<div class="hn-tasmania-header-overlay" id="menu-overlay"></div>

					<!-- Popup Menu -->
					<div class="hn-tasmania-header-menu-popup" id="menu-popup">
						<!-- Close Button X -->
						<button class="hn-tasmania-header-menu-close" id="close-btn">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path fill="var(--primary-color)" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
							</svg>
						</button>

						<!-- Logo in Popup -->
						<a class="hn-tasmania-header__logo" href="<?php echo esc_url( $home_url ); ?>" title="<?php echo esc_attr( $site_name ); ?>">
							<img
								src="<?php echo esc_url( $logo_url ); ?>"
								alt="<?php echo esc_attr( $logo_alt ); ?>"
								title="<?php echo esc_attr( $site_name ); ?>"
								<?php if ( ! empty( $logo_w ) && ! empty( $logo_h ) ) : ?>
								width="<?php echo esc_attr( $logo_w ); ?>"
								height="<?php echo esc_attr( $logo_h ); ?>"
								<?php endif; ?>
								loading="lazy"
								decoding="async"
								fetchpriority="low"
							/>
						</a>

						<!-- Nav Items in Popup -->
						<nav class="hn-tasmania-header-menu-nav">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'container'       => false,
								'menu_class'      => 'hn-tasmania-header-menu-nav-list',
								'menu_id'         => '',
								'fallback_cb'     => false,
								'depth'           => 2,
								'walker'          => new Popup_Walker_Nav_Menu(),
							) );
							?>
						</nav>
					</div>
					<div class="polylang-switcher">
						<?php
						$languages = pll_the_languages(array('raw' => 1));
						if ($languages):
						?>
						<div class="custom-lang-dropdown">
							<button class="lang-toggle">
								<?php
								$current = array_filter($languages, fn($l) => $l['current_lang']);
								$current = reset($current);
								?>
								<img src="<?php echo esc_url($current['flag']); ?>" alt="<?php echo esc_attr($current['name']); ?>" title="<?php echo esc_attr($current['name']); ?>">
								<span><?php echo esc_html($current['name']); ?></span>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24"><path stroke="#1A1D29" stroke-linecap="round" stroke-linejoin="round" d="M6 9.5l6 6 6-6"/></svg>
							</button>

							<ul class="lang-menu">
								<?php foreach ($languages as $lang): ?>
								<?php if (!$lang['current_lang']): ?>
								<li>
									<a href="<?php echo esc_url($lang['url']); ?>" title="<?php echo esc_html($lang['name']); ?>">
										<img src="<?php echo esc_url($lang['flag']); ?>" alt="<?php echo esc_attr($lang['name']); ?>"  title="<?php echo esc_html($lang['name']); ?>">
										<span><?php echo esc_html($lang['name']); ?></span>
									</a>
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</div>
						<?php endif; ?>
					</div>

				</div>

			</div>
		</header>
		<main class="hn-tasmania">
			

