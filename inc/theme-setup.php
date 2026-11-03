<?php
/**
 * Thiết lập các tính năng cơ bản của theme
 * @package HomeNest Theme
 */
function homenest_theme_setup() {
    // Cho phép sử dụng title tag (tên trang)
    add_theme_support( 'title-tag' );

    // Hỗ trợ ảnh đại diện (Post Thumbnails)
    add_theme_support( 'post-thumbnails' );
    
    // =======================================================
    // ** THÊM HỖ TRỢ CUSTOM LOGO **
    // =======================================================
    add_theme_support( 'custom-logo', array(
        'height'      => 100, // Chiều cao tối đa (ví dụ)
        'width'       => 400,  // Chiều rộng tối đa (ví dụ)
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );
    // =======================================================

    // Đăng ký menu locations
    register_nav_menus( array(
        'primary-menu' => esc_html__( 'Main Navigation', 'homenest' ),
        'footer-menu'  => esc_html__( 'Footer Navigation', 'homenest' ),
    ) );

    // Kích hoạt HTML5 cho các form (search, comment, gallery, caption)
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
}
add_action( 'after_setup_theme', 'homenest_theme_setup' );

// KHÔNG CÓ THẺ ĐÓNG PHP ?>