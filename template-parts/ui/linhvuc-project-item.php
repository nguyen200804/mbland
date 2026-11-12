<?php
/**
 * Component UI: Card dự án trong danh sách Lĩnh vực (taxonomy-linh-vuc.php).
 * Dùng trong WP Loop (the_post đã được gọi).
 *
 * @package HomeNest Theme
 */

$post_id   = get_the_ID();
$image     = function_exists( 'get_field' ) ? get_field( 'featured_image', $post_id ) : false;
$thumb_url = '';
$thumb_alt = get_the_title( $post_id );

if ( ! empty( $image ) && is_array( $image ) ) {
	$thumb_url = isset( $image['url'] ) ? $image['url'] : '';
	if ( ! empty( $image['alt'] ) ) {
		$thumb_alt = $image['alt'];
	}
} elseif ( is_numeric( $image ) ) {
	$thumb_url = wp_get_attachment_image_url( (int) $image, 'large' );
} elseif ( is_string( $image ) && ! empty( $image ) ) {
	$thumb_url = $image;
}

if ( empty( $thumb_url ) && has_post_thumbnail( $post_id ) ) {
	$thumb_url = get_the_post_thumbnail_url( $post_id, 'large' );
	$thumb_id  = get_post_thumbnail_id( $post_id );
	$alt       = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
	if ( ! empty( $alt ) ) {
		$thumb_alt = $alt;
	}
}

if ( empty( $thumb_url ) ) {
	$thumb_url = '/wp-content/uploads/2025/10/Da-Nang.jpg';
}

$short_content = function_exists( 'get_field' ) ? get_field( 'short_content', $post_id ) : '';
if ( empty( $short_content ) ) {
	$short_content = get_the_excerpt( $post_id );
}

$location = function_exists( 'mbland_clean_plain_text' ) ? mbland_clean_plain_text( get_field( 'location', $post_id ) ) : ( function_exists( 'get_field' ) ? get_field( 'location', $post_id ) : '' );
$scale    = function_exists( 'mbland_clean_plain_text' ) ? mbland_clean_plain_text( get_field( 'scale', $post_id ) ) : ( function_exists( 'get_field' ) ? get_field( 'scale', $post_id ) : '' );
?>
<div class="mbland_linhvuc_listProject_item">
	<div class="mbland_linhvuc_listProject_itemMedia">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" style="display:flex;width:100%;height:100%;" aria-label="<?php the_title_attribute(); ?>">
			<img class="mbland_linhvuc_listProject_itemImage" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $thumb_alt ); ?>" title="<?php echo esc_attr( get_the_title( $post_id ) ); ?>" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( $thumb_url, 800, 600 ) ); ?> />
		</a>
	</div>
	<div class="mbland_linhvuc_listProject_itemBody">
		<h3 class="mbland_linhvuc_listProject_itemTitle">
			<a class="mbland_linhvuc_listProject_itemTitleLink" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" aria-label="<?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<?php if ( ! empty( $short_content ) ) : ?>
			<div class="mbland_linhvuc_listProject_itemDesc">
				<?php echo wp_kses_post( $short_content ); ?>
			</div>
		<?php endif; ?>
		<hr class="mbland_linhvuc_listProject_itemDivider" />
		<?php if ( ! empty( $location ) ) : ?>
			<div class="mbland_linhvuc_listProject_itemLocation">
				<span class="mbland_linhvuc_listProject_itemLocationIcon">
					<svg viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9 1.125C7.35957 1.12694 5.78688 1.77945 4.62692 2.93941C3.46696 4.09938 2.81444 5.67207 2.8125 7.3125C2.811 8.65299 3.24884 9.95704 4.059 11.025C4.059 11.025 4.22775 11.2472 4.25532 11.2793L9 16.875L13.7469 11.2764C13.7717 11.2466 13.941 11.025 13.941 11.025L13.9416 11.0233C14.7512 9.95574 15.1888 8.65235 15.1875 7.3125C15.1856 5.67207 14.5331 4.09938 13.3731 2.93941C12.2131 1.77945 10.6404 1.12694 9 1.125ZM9 9.5625C8.555 9.5625 8.11998 9.43054 7.74997 9.18331C7.37996 8.93607 7.09157 8.58467 6.92127 8.17354C6.75098 7.7624 6.70642 7.31 6.79324 6.87355C6.88005 6.43709 7.09434 6.03618 7.40901 5.72151C7.72368 5.40684 8.12459 5.19255 8.56105 5.10573C8.99751 5.01892 9.44991 5.06347 9.86104 5.23377C10.2722 5.40407 10.6236 5.69246 10.8708 6.06247C11.118 6.43248 11.25 6.86749 11.25 7.3125C11.2493 7.90901 11.012 8.48087 10.5902 8.90267C10.1684 9.32446 9.59651 9.56176 9 9.5625Z" fill="currentColor"/>
					</svg>
				</span>
				<div class="mbland_linhvuc_listProject_itemLocationText">
					<p class="mbland_linhvuc_listProject_itemLocationLabel"><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Vị trí DỰ ÁN' ) : 'Vị trí DỰ ÁN' ); ?></p>
					<p class="mbland_linhvuc_listProject_itemLocationValue"><?php echo esc_html( $location ); ?></p>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $scale ) ) : ?>
			<div class="mbland_linhvuc_listProject_itemScale">
				<span class="mbland_linhvuc_listProject_itemScaleIcon">
					<svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M14.9998 4.16675L9.99977 6.66675V1.66675L14.9998 4.16675Z" fill="var(--primary-color)"/>
						<path d="M9.99977 6.66675L14.9998 4.16675L9.99977 1.66675V6.66675ZM9.99977 6.66675V10.0001M6.66643 9.99175L2.0831 12.6084C1.95485 12.6811 1.84818 12.7865 1.77396 12.9139C1.69975 13.0412 1.66064 13.186 1.66064 13.3334C1.66064 13.4808 1.69975 13.6256 1.77396 13.753C1.84818 13.8803 1.95485 13.9857 2.0831 14.0584L9.16643 18.1084C9.4198 18.2547 9.70721 18.3317 9.99977 18.3317C10.2923 18.3317 10.5797 18.2547 10.8331 18.1084L17.9164 14.0584C18.0447 13.9857 18.1514 13.8803 18.2256 13.753C18.2998 13.6256 18.3389 13.4808 18.3389 13.3334C18.3389 13.186 18.2998 13.0412 18.2256 12.9139C18.1514 12.7865 18.0447 12.6811 17.9164 12.6084L13.3331 10.0001M5.4081 10.7084L14.5914 15.9584M14.5914 10.7084L5.41643 15.9584" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke="var(--primary-color)"/>
					</svg>
				</span>
				<div class="mbland_linhvuc_listProject_itemScaleText">
					<p class="mbland_linhvuc_listProject_itemScaleLabel"><?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Quy mô bất động sản' ) : 'Quy mô bất động sản' ); ?></p>
					<p class="mbland_linhvuc_listProject_itemScaleValue"><?php echo esc_html( $scale ); ?></p>
				</div>
			</div>
		<?php endif; ?>
		<a class="mbland_linhvuc_listProject_itemLink" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( ( function_exists( 'pll__' ) ? pll__( 'Xem chi tiết' ) : 'Xem chi tiết' ) . ': ' . get_the_title() ); ?>">
			<?php echo esc_html( function_exists( 'pll__' ) ? pll__( 'Xem chi tiết' ) : 'Xem chi tiết' ); ?>
		</a>
	</div>
</div>
