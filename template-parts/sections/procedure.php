<?php
/**
 * Section "Quy trình phát triển khai dự án".
 *
 * Usage:
 * get_template_part( 'template-parts/sections/procedure', null, array(
 *     'title' => '',        // optional
 *     'desc'  => '',        // optional
 *     'items' => array(),   // optional: mỗi phần tử gồm tag, title, desc, images (mảng ảnh ACF)
 * ) );
 * Nếu không truyền dữ liệu sẽ hiển thị nội dung mặc định.
 */
$proc_args  = isset( $args ) && is_array( $args ) ? $args : array();
$proc_items = ( ! empty( $proc_args['items'] ) && is_array( $proc_args['items'] ) ) ? $proc_args['items'] : array();
$proc_title = ! empty( $proc_args['title'] ) ? $proc_args['title'] : null;
$proc_desc  = ! empty( $proc_args['desc'] ) ? $proc_args['desc'] : null;
?>
<!-- ===== START SECTION PROCEDURE ===== -->
<section class="mbland_linhvuc_procedure">
	<div class="container">
		<div class="mbland_linhvuc_procedure_wrapper">
			<header class="mbland_linhvuc_procedure_heading">
				<h2 class="mbland_linhvuc_procedure_title"><?php echo null !== $proc_title ? esc_html( $proc_title ) : 'Quy trình phát triển khai dự án'; ?></h2>
				<p class="mbland_linhvuc_procedure_desc"><?php echo null !== $proc_desc ? esc_html( $proc_desc ) : 'Mỗi dự án được triển khai theo quy trình bài bản, từ nghiên cứu tiềm năng, hoạch định chiến lược đến phát triển và vận hành, nhằm tối ưu hiệu quả đầu tư và kiến tạo giá trị bền vững.'; ?></p>
			</header>
			<div class="mbland_linhvuc_procedure_list">
				<?php if ( ! empty( $proc_items ) ) : ?>
					<?php foreach ( $proc_items as $proc_index => $proc_item ) : ?>
				<article class="mbland_linhvuc_procedure_item">
					<div class="mbland_linhvuc_procedure_itemContent">
						<span class="mbland_linhvuc_procedure_itemNumber"><?php echo esc_html( sprintf( '%02d', $proc_index + 1 ) ); ?></span>
						<div class="mbland_linhvuc_procedure_itemTexts">
							<?php if ( ! empty( $proc_item['tag'] ) ) : ?>
							<p class="mbland_linhvuc_procedure_itemTag"><?php echo esc_html( $proc_item['tag'] ); ?></p>
							<?php endif; ?>
							<h3 class="mbland_linhvuc_procedure_itemTitle"><?php echo esc_html( isset( $proc_item['title'] ) ? $proc_item['title'] : '' ); ?></h3>
							<p class="mbland_linhvuc_procedure_itemDesc"><?php echo esc_html( isset( $proc_item['desc'] ) ? $proc_item['desc'] : '' ); ?></p>
						</div>
					</div>
					<?php if ( ! empty( $proc_item['images'] ) && is_array( $proc_item['images'] ) ) : ?>
					<div class="mbland_linhvuc_procedure_itemImage">
						<ul class="mbland_linhvuc_procedure_itemImageList">
							<?php foreach ( $proc_item['images'] as $proc_img ) : ?>
								<?php
								$proc_img_url = is_array( $proc_img ) && ! empty( $proc_img['url'] ) ? $proc_img['url'] : ( is_string( $proc_img ) ? $proc_img : '' );
								if ( ! $proc_img_url ) {
									continue;
								}
								$proc_img_alt = ( is_array( $proc_img ) && ! empty( $proc_img['alt'] ) ) ? $proc_img['alt'] : ( isset( $proc_item['title'] ) ? $proc_item['title'] : '' );
								?>
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="<?php echo esc_url( $proc_img_url ); ?>" alt="<?php echo esc_attr( $proc_img_alt ); ?>" title="<?php echo esc_attr( $proc_img_alt ); ?>" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( $proc_img_url, 800, 600 ) ); ?> /></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>
				</article>
					<?php endforeach; ?>
				<?php else : ?>
				<article class="mbland_linhvuc_procedure_item">
					<div class="mbland_linhvuc_procedure_itemContent">
						<span class="mbland_linhvuc_procedure_itemNumber">01</span>
						<div class="mbland_linhvuc_procedure_itemTexts">
							<p class="mbland_linhvuc_procedure_itemTag">Research & Assessment</p>
							<h3 class="mbland_linhvuc_procedure_itemTitle">Nghiên cứu & Đánh giá</h3>
							<p class="mbland_linhvuc_procedure_itemDesc">Phân tích thị trường, khảo sát vị trí, đánh giá tiềm năng phát triểnvà xác định cơ hội đầu tư phù hợp.</p>
						</div>
					</div>
					<div class="mbland_linhvuc_procedure_itemImage">
						<ul class="mbland_linhvuc_procedure_itemImageList">
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
						</ul>
					</div>
				</article>

				<article class="mbland_linhvuc_procedure_item">
					<div class="mbland_linhvuc_procedure_itemContent">
						<span class="mbland_linhvuc_procedure_itemNumber">02</span>
						<div class="mbland_linhvuc_procedure_itemTexts">
							<p class="mbland_linhvuc_procedure_itemTag">Investment Strategy</p>
							<h3 class="mbland_linhvuc_procedure_itemTitle">Hoạch định chiến lược</h3>
							<p class="mbland_linhvuc_procedure_itemDesc">Xây dựng phương án đầu tư, đánh giá tính khả thi, xác định nguồn lực và định hướng phát triển dự án.</p>
						</div>
					</div>
					<div class="mbland_linhvuc_procedure_itemImage">
						<ul class="mbland_linhvuc_procedure_itemImageList">
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
						</ul>
					</div>
				</article>

				<article class="mbland_linhvuc_procedure_item">
					<div class="mbland_linhvuc_procedure_itemContent">
						<span class="mbland_linhvuc_procedure_itemNumber">03</span>
						<div class="mbland_linhvuc_procedure_itemTexts">
							<p class="mbland_linhvuc_procedure_itemTag">Legal & Master Planning</p>
							<h3 class="mbland_linhvuc_procedure_itemTitle">Pháp lý & Quy hoạch</h3>
							<p class="mbland_linhvuc_procedure_itemDesc">Rà soát hồ sơ pháp lý, hoàn thiện các thủ tục cần thiết và xây dựng phương án quy hoạch phù hợp.</p>
						</div>
					</div>
					<div class="mbland_linhvuc_procedure_itemImage">
						<ul class="mbland_linhvuc_procedure_itemImageList">
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
						</ul>
					</div>
				</article>

				<article class="mbland_linhvuc_procedure_item">
					<div class="mbland_linhvuc_procedure_itemContent">
						<span class="mbland_linhvuc_procedure_itemNumber">04</span>
						<div class="mbland_linhvuc_procedure_itemTexts">
							<p class="mbland_linhvuc_procedure_itemTag">Design & Development</p>
							<h3 class="mbland_linhvuc_procedure_itemTitle">Thiết kế & Phát triển</h3>
							<p class="mbland_linhvuc_procedure_itemDesc">Định hình concept kiến trúc, tổ chức không gian, hệ thống tiện ích và giải pháp thiết kế tối ưu.</p>
						</div>
					</div>
					<div class="mbland_linhvuc_procedure_itemImage">
						<ul class="mbland_linhvuc_procedure_itemImageList">
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
							<li class="mbland_linhvuc_procedure_itemImageItem"><img class="mbland_linhvuc_procedure_itemImagePhoto" src="/wp-content/uploads/2025/10/Bat-dong-san-1.jpg" alt="Quy trình thực hiện dự án" title="Quy trình thực hiện dự án" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/Bat-dong-san-1.jpg', 800, 600 ) ); ?> /></li>
						</ul>
					</div>
				</article>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<!-- ===== END SECTION PROCEDURE ===== -->

