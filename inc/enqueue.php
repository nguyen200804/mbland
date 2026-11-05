<?php
/**
 * Phien ban asset = thoi gian sua file (filemtime) => tu dong xoa cache trinh duyet khi file doi.
 *
 * @param string $path Duong dan tuong doi tu thu muc theme, vd '/assets/css/style.css'.
 * @return string
 */
function homenest_asset_ver( $path ) {
    $file = get_template_directory() . $path;
    return file_exists( $file ) ? (string) filemtime( $file ) : '1.0';
}
function homenest_enqueue_scripts() {
    $version = '1.0';

    // CSS Chung
    wp_enqueue_style( 'homenest-style', get_stylesheet_uri(), array(), homenest_asset_ver( '/style.css' ) );
    wp_enqueue_style( 'homenest-footer-style', get_template_directory_uri() . '/assets/css/layout/footer.css', array('homenest-style'), homenest_asset_ver('/assets/css/layout/footer.css') );
    wp_enqueue_style( 'homenest-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), homenest_asset_ver('/assets/css/fonts.css') );
    wp_enqueue_style( 'homenest-assets-style', get_template_directory_uri() . '/assets/css/style.css', array('homenest-style', 'homenest-fonts'), homenest_asset_ver('/assets/css/style.css') );
    wp_enqueue_style( 'homenest-header-style', get_template_directory_uri() . '/assets/css/layout/header.css', array('homenest-assets-style'), homenest_asset_ver('/assets/css/layout/header.css') );

    // CSS component dung chung
    wp_enqueue_style( 'homenest-brands-style', get_template_directory_uri() . '/assets/css/sections/brands.css', array('homenest-assets-style'), homenest_asset_ver('/assets/css/sections/brands.css') );

    wp_enqueue_style( 'homenest-contact-form-style', get_template_directory_uri() . '/assets/css/sections/contact-form.css', array('homenest-assets-style'), homenest_asset_ver('/assets/css/sections/contact-form.css') );
    wp_enqueue_style( 'homenest-ui-button-detail-style', get_template_directory_uri() . '/assets/css/ui/button-detail.css', array('homenest-assets-style'), homenest_asset_ver('/assets/css/ui/button-detail.css') );

    // CSS/JS theo template (nap trong <head> / truoc </body>)
    $tpl = ! empty( $GLOBALS['template'] ) ? basename( $GLOBALS['template'] ) : '';
    $css_map = array(
        'single-project.php'               => array( 'homenest-project-detail-style', 'project-detail.css' ),
        'template-bat-dong-san.php'        => array( 'homenest-business-field-style', 'business-field.css' ),
        'template-dich-vu-du-lich.php'     => array( 'homenest-business-field-style', 'business-field.css' ),
        'template-hospitality.php'         => array( 'homenest-business-field-style', 'business-field.css' ),
        'template-real-estate.php'         => array( 'homenest-business-field-style', 'business-field.css' ),
        'template-dau-tu-tai-chinh.php'    => array( 'homenest-business-field-style', 'business-field.css' ),
        'template-finance.php'             => array( 'homenest-business-field-style', 'business-field.css' ),
        'template-single-tin-tuc.php'      => array( 'homenest-news-detail-style', 'news-detail.css' ),
        'template-tin-tuc-category.php'    => array( 'homenest-news-style', 'news.css' ),
        'template-news.php'                => array( 'homenest-news-style', 'news.css' ),
        'template-news-en.php'             => array( 'homenest-news-style', 'news.css' ),
        'template-single-tuyen-dung.php'   => array( 'homenest-recruitment-detail-style', 'recruitment-detail.css' ),
        'template-about-us.php'            => array( 'homenest-about-us-style', 'about-us.css' ),
        'template-about-en.php'            => array( 'homenest-about-us-style', 'about-us.css' ),
        'template-contact.php'             => array( 'homenest-contact-style', 'contact.css' ),
        'template-contact-en.php'          => array( 'homenest-contact-style', 'contact.css' ),
        'template-home.php'                => array( 'homenest-homepage-style', 'homepage.css' ),
        'template-homepage.php'            => array( 'homenest-homepage-style', 'homepage.css' ),
        'taxonomy-linh-vuc.php'    => array( 'homenest-linh-vuc-style', 'linh-vuc.css' ),
        'template-recruitment.php'         => array( 'homenest-recruitment-style', 'recruitment.css' ),
        'template-recruitment-en.php'      => array( 'homenest-recruitment-style', 'recruitment.css' ),
    );
    if ( isset( $css_map[ $tpl ] ) ) {
        wp_enqueue_style( $css_map[ $tpl ][0], get_template_directory_uri() . '/assets/css/' . $css_map[ $tpl ][1], array('homenest-style', 'homenest-assets-style'), homenest_asset_ver( '/assets/css/' . $css_map[ $tpl ][1] ) );
    }
    if ( in_array( $tpl, array( 'template-about-us.php', 'template-about-en.php' ), true ) ) {
        wp_enqueue_script( 'homenest-about-script', get_template_directory_uri() . '/assets/js/about.js', array(), homenest_asset_ver('/assets/js/about.js'), true );
    }
    if ( 'taxonomy-linh-vuc.php' === $tpl ) {
        wp_enqueue_script( 'homenest-linh-vuc-script', get_template_directory_uri() . '/assets/js/linh-vuc.js', array(), homenest_asset_ver('/assets/js/linh-vuc.js'), true );
    }
    if ( in_array( $tpl, array( 'template-home.php', 'template-homepage.php' ), true ) ) {
        wp_enqueue_script( 'homenest-homepage-script', get_template_directory_uri() . '/assets/js/homepage.js', array(), homenest_asset_ver('/assets/js/homepage.js'), true );
    }
    if ( is_front_page() && is_home() ) { 
        wp_enqueue_style( 'homenest-homepage-style', get_template_directory_uri() . '/assets/css/homepage.css', array('homenest-style'), homenest_asset_ver('/assets/css/homepage.css') );
    } elseif ( is_page_template('templates/template-about-us.php') ) { 
        wp_enqueue_style( 'homenest-about-us-style', get_template_directory_uri() . '/assets/css/about-us.css', array('homenest-style'), homenest_asset_ver('/assets/css/about-us.css') );
    } elseif ( is_home() || is_archive() || is_singular('post') ) { 
        wp_enqueue_style( 'homenest-blog-style', get_template_directory_uri() . '/assets/css/blog.css', array('homenest-style'), homenest_asset_ver('/assets/css/blog.css') );
    }

    // JS Chung
    wp_enqueue_script( 'homenest-main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), homenest_asset_ver('/assets/js/main.js'), true );

    // JS riêng cho từng trang
    if ( is_front_page() && is_home() ) {
        wp_enqueue_script( 'homenest-homepage-script', get_template_directory_uri() . '/assets/js/homepage.js', array('homenest-main-script'), homenest_asset_ver('/assets/js/homepage.js'), true );
    } elseif ( is_home() || is_archive() || is_singular('post') ) {
        wp_enqueue_script( 'homenest-blog-script', get_template_directory_uri() . '/assets/js/blog.js', array('homenest-main-script'), homenest_asset_ver('/assets/js/blog.js'), true );
    }
    // ... Thêm điều kiện cho các trang/template khác ...
}
add_action( 'wp_enqueue_scripts', 'homenest_enqueue_scripts' );