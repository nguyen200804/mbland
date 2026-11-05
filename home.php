<?php
/**
 * Blog / Tin tức Home Template
 * Được WordPress tự động nạp khi chọn trang Tin tức làm "Trang bài viết" (Posts page) trong Settings > Reading.
 *
 * @package HomeNest Theme
 */

$news_template = locate_template( 'templates/template-news.php' );
if ( ! empty( $news_template ) ) {
    load_template( $news_template );
} else {
    get_template_part( 'templates/template', 'news' );
}

