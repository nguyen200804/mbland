<?php
/**
 * Component UI: New Card Item (Card bài viết tin mới)
 *
 * Usage trong WordPress Loop:
 * get_template_part( 'template-parts/ui/new-card-item' );
 *
 * Usage truyền tham số tùy biến:
 * get_template_part( 'template-parts/ui/new-card-item', null, array(
 *     'post_id' => get_the_ID(), // optional: ID bài viết (mặc định lấy post hiện tại)
 *     'class'   => '',           // optional: class CSS bổ sung
 *     'badge'   => '',           // optional: nhãn badge (mặc định 'TIN MỚI', hỗ trợ Polylang)
 * ) );
 *
 * @package HomeNest Theme
 */

$post_id = ! empty( $args['post_id'] ) ? $args['post_id'] : get_the_ID();
if ( ! $post_id ) {
	return;
}

$featured_img = get_the_post_thumbnail_url( $post_id, 'medium_large' );
if ( ! $featured_img ) {
	$featured_img = get_template_directory_uri() . '/images/default.jpg';
}

$post_title    = get_the_title( $post_id );
$post_url      = get_permalink( $post_id );
$post_date     = get_the_date( 'd/m/Y', $post_id );
$author_id     = get_post_field( 'post_author', $post_id );
$author_name   = get_the_author_meta( 'display_name', $author_id );
$author_avatar = get_avatar_url( $author_id );
$desc          = get_field( 'mo_ta_ngan_tin_tuc', $post_id );
if ( empty( $desc ) ) {
	$desc = get_the_excerpt( $post_id );
}

$badge = ! empty( $args['badge'] ) ? $args['badge'] : ( function_exists( 'pll__' ) ? pll__( 'TIN MỚI' ) : 'TIN MỚI' );

$classes = array( 'mbland_tintucTemplate_newCard' );
if ( ! empty( $args['class'] ) ) {
	$classes[] = sanitize_html_class( $args['class'] );
}
?>
<article class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<a href="<?php echo esc_url( $post_url ); ?>" title="<?php echo esc_attr( $post_title ); ?>" class="mbland_tintucTemplate_newCard_thumb">
		<img class="mbland_tintucTemplate_newCard_img" src="<?php echo esc_url( $featured_img ); ?>" alt="<?php echo esc_attr( $post_title ); ?>" title="<?php echo esc_attr( $post_title ); ?>" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( $featured_img, 768, 512 ) ); ?> />
	</a>
	<div class="mbland_tintucTemplate_newCard_content">
		<div class="mbland_tintucTemplate_newCard_meta">
			<span class="mbland_tintucTemplate_newCard_metaIcon">
				<img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/clock.svg', 20, 20 ) ); ?> />
			</span>
			<span class="mbland_tintucTemplate_newCard_date"><?php echo esc_html( $post_date ); ?></span>
			<?php if ( ! empty( $badge ) ) : ?>
				<span class="mbland_tintucTemplate_newCard_metaDivider"></span>
				<span class="mbland_tintucTemplate_newCard_badge"><?php echo esc_html( $badge ); ?></span>
			<?php endif; ?>
		</div>
		<h3 class="mbland_tintucTemplate_newCard_title">
			<a href="<?php echo esc_url( $post_url ); ?>" class="mbland_tintucTemplate_newCard_titleLink" title="<?php echo esc_attr( $post_title ); ?>">
				<?php echo esc_html( $post_title ); ?>
			</a>
		</h3>
		<div class="mbland_tintucTemplate_newCard_desc"><?php echo wp_kses_post( $desc ); ?></div>

		<div class="mbland_tintucTemplate_newCard_author">
			<img class="mbland_tintucTemplate_newCard_authorImage" src="<?php echo esc_url( $author_avatar ); ?>" alt="<?php echo esc_attr( $author_name ); ?>" title="<?php echo esc_attr( $author_name ); ?>" loading="lazy" decoding="async" fetchpriority="low" width="96" height="96" />
			<p class="mbland_tintucTemplate_newCard_authorName"><?php echo esc_html( $author_name ); ?></p>
		</div>

		<?php
		get_template_part( 'template-parts/ui/button-detail', null, array(
			'url'   => $post_url,
			'class' => 'mbland_tintucTemplate_newCard_button',
			'title' => $post_title,
		) );
		?>
	</div>
</article>

