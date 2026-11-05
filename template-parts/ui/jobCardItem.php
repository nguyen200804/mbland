<?php
/**
 * Component UI: Job Card Item (Card danh sách bài tuyển dụng)
 *
 * Usage trong WordPress Loop:
 * get_template_part( 'template-parts/ui/jobCardItem' );
 *
 * Usage truyền tham số tùy biến:
 * get_template_part( 'template-parts/ui/jobCardItem', null, array(
 *     'post_id' => get_the_ID(), // optional: ID bài viết (mặc định lấy post hiện tại)
 *     'class'   => '',           // optional: class CSS bổ sung
 * ) );
 *
 * @package HomeNest Theme
 */

$post_id = ! empty( $args['post_id'] ) ? $args['post_id'] : get_the_ID();
if ( ! $post_id ) {
	return;
}

$title        = get_the_title( $post_id );
$permalink    = get_permalink( $post_id );
$hannop       = get_field( 'han_nop_ho_so', $post_id );
$luong        = get_field( 'muc_luong', $post_id );
$terms_noilam = get_the_terms( $post_id, 'noi-lam-viec' );
$noilam       = ( $terms_noilam && ! is_wp_error( $terms_noilam ) )
	? join( ', ', wp_list_pluck( $terms_noilam, 'name' ) )
	: ( get_field( 'dia_diem_lam_viec', $post_id ) ?: ( function_exists( 'pll__' ) ? pll__( 'Đang cập nhật' ) : 'Đang cập nhật' ) );

$classes = array( 'mbland_jobCard', 'hn__job-item' );
if ( ! empty( $args['class'] ) ) {
	$classes[] = sanitize_html_class( $args['class'] );
}
?>
<article class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="mbland_jobCard_left job-item-left">
		<div class="mbland_jobCard_deadline deadline">
			<span class="mbland_jobCard_deadlineTitle deadline-title"><?php echo function_exists( 'pll__' ) ? pll__( 'Hạn nộp hồ sơ' ) : 'Hạn nộp hồ sơ'; ?>:</span> 
			<?php echo esc_html( $hannop ?: ( function_exists( 'pll__' ) ? pll__( 'Đang cập nhật' ) : 'Đang cập nhật' ) ); ?>
		</div>
		<h2 class="mbland_jobCard_title">
			<a href="<?php echo esc_url( $permalink ); ?>" title="<?php echo esc_attr( $title ); ?>">
				<?php echo esc_html( $title ); ?>
			</a>
		</h2>
		<p class="mbland_jobCard_info info">
			<b><?php echo function_exists( 'pll__' ) ? pll__( 'Mức lương' ) : 'Mức lương'; ?>:</b> <?php echo esc_html( $luong ?: ( function_exists( 'pll__' ) ? pll__( 'Thỏa thuận' ) : 'Thỏa thuận' ) ); ?>
		</p>
		<p class="mbland_jobCard_info info">
			<b><?php echo function_exists( 'pll__' ) ? pll__( 'Địa điểm làm việc' ) : 'Địa điểm làm việc'; ?>:</b> <?php echo esc_html( $noilam ); ?>
		</p>
	</div>
	<div class="mbland_jobCard_right">
		<a href="<?php echo esc_url( $permalink ); ?>" class="mbland_jobCard_applyBtn apply-btn" title="<?php echo esc_attr( $title ); ?>">
			<?php echo function_exists( 'pll__' ) ? pll__( 'Ứng tuyển ngay' ) : 'Ứng tuyển ngay'; ?>
		</a>
	</div>
</article>

