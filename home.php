<?php
/**
 * Blog / Tin tức Home Template
 * Được WordPress tự động nạp khi chọn trang Tin tức làm "Trang bài viết" (Posts page) trong Settings > Reading.
 * Sử dụng chung file template với category archive để tiện bảo trì code HTML/CSS tại 1 nơi.
 *
 * @package HomeNest Theme
 */

$news_template = locate_template( 'template-tin-tuc/template-tin-tuc-category.php' );
if ( ! empty( $news_template ) ) {
    load_template( $news_template );
}
