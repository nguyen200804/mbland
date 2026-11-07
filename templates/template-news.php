<?php
/*
Template Name: Tin tức
*/
/**
 * File này kế thừa toàn bộ giao diện và logic từ category.php
 * Giúp thống nhất quản lý HTML/CSS tại 1 nơi duy nhất.
 */
$category_template = locate_template( 'category.php' );
if ( ! empty( $category_template ) ) {
    load_template( $category_template );
}
