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
    // CSS Chung
    wp_enqueue_style( 'homenest-style', get_stylesheet_uri(), array(), homenest_asset_ver( '/style.css' ) );
    wp_enqueue_style( 'homenest-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), homenest_asset_ver( '/assets/css/fonts.css' ) );
    wp_enqueue_style( 'homenest-assets-style', get_template_directory_uri() . '/assets/css/style.css', array( 'homenest-style', 'homenest-fonts' ), homenest_asset_ver( '/assets/css/style.css' ) );
    wp_enqueue_style( 'homenest-header-style', get_template_directory_uri() . '/assets/css/layout/header.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/layout/header.css' ) );
    wp_enqueue_style( 'homenest-footer-style', get_template_directory_uri() . '/assets/css/layout/footer.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/layout/footer.css' ) );

    // CSS Section dung chung
    wp_enqueue_style( 'homenest-brands-style', get_template_directory_uri() . '/assets/css/sections/brands.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/sections/brands.css' ) );
    wp_enqueue_style( 'homenest-procedure-style', get_template_directory_uri() . '/assets/css/sections/procedure.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/sections/procedure.css' ) );
    wp_enqueue_style( 'homenest-contact-form-style', get_template_directory_uri() . '/assets/css/sections/contact-form.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/sections/contact-form.css' ) );

    // CSS UI component dung chung
    wp_enqueue_style( 'homenest-ui-button-style', get_template_directory_uri() . '/assets/css/ui/button.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/button.css' ) );
    wp_enqueue_style( 'homenest-ui-button-detail-style', get_template_directory_uri() . '/assets/css/ui/button-detail.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/button-detail.css' ) );
    wp_enqueue_style( 'homenest-ui-new-card-item-style', get_template_directory_uri() . '/assets/css/ui/new-card-item.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/new-card-item.css' ) );
    wp_enqueue_style( 'homenest-ui-news-grid-style', get_template_directory_uri() . '/assets/css/ui/news-grid.css', array( 'homenest-assets-style', 'homenest-ui-new-card-item-style' ), homenest_asset_ver( '/assets/css/ui/news-grid.css' ) );
    wp_enqueue_style( 'homenest-ui-job-card-item-style', get_template_directory_uri() . '/assets/css/ui/job-card-item.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/job-card-item.css' ) );
    wp_enqueue_style( 'homenest-ui-pagination-style', get_template_directory_uri() . '/assets/css/ui/pagination.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/pagination.css' ) );
    wp_enqueue_style( 'homenest-ui-breadcrumb-style', get_template_directory_uri() . '/assets/css/ui/breadcrumb.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/breadcrumb.css' ) );

    // CSS theo template / trang (nam trong assets/css/pages/)
    $tpl = ! empty( $GLOBALS['template'] ) ? basename( $GLOBALS['template'] ) : '';
    $css_map = array(
        'single-project.php'        => array( 'homenest-project-detail-style', 'pages/project-detail.css' ),
        'archive-project.php'       => array( 'homenest-business-field-style', 'pages/business-field.css' ),
        'single.php'                => array( 'homenest-news-detail-style', 'pages/news-detail.css' ),
        'category.php'              => array( 'homenest-news-style', 'pages/news.css' ),
        'single-tuyen-dung.php'     => array( 'homenest-recruitment-detail-style', 'pages/recruitment-detail.css' ),
        'template-about-us.php'     => array( 'homenest-about-us-style', 'pages/about-us.css' ),
        'template-contact.php'      => array( 'homenest-contact-style', 'pages/contact.css' ),
        'template-homepage.php'     => array( 'homenest-homepage-style', 'pages/homepage.css' ),
        'template-news.php'         => array( 'homenest-news-style', 'pages/news.css' ),
        'template-project.php'      => array( 'homenest-business-field-style', 'pages/business-field.css' ),
        'template-recruitment.php'  => array( 'homenest-recruitment-style', 'pages/recruitment.css' ),
        'template-cong-ty-con.php'  => array( 'homenest-business-field-style', 'pages/business-field.css' ),
        'taxonomy-linh-vuc.php'     => array( 'homenest-linh-vuc-style', 'pages/linh-vuc.css' ),
    );

    if ( isset( $css_map[ $tpl ] ) ) {
        wp_enqueue_style(
            $css_map[ $tpl ][0],
            get_template_directory_uri() . '/assets/css/' . $css_map[ $tpl ][1],
            array( 'homenest-style', 'homenest-assets-style' ),
            homenest_asset_ver( '/assets/css/' . $css_map[ $tpl ][1] )
        );
    }

    // JS rieng cho tung trang (nam trong assets/js/pages/)
    if ( 'template-about-us.php' === $tpl || is_page_template( 'templates/template-about-us.php' ) ) {
        wp_enqueue_script( 'homenest-about-script', get_template_directory_uri() . '/assets/js/pages/about.js', array(), homenest_asset_ver( '/assets/js/pages/about.js' ), true );
    }

    if ( 'taxonomy-linh-vuc.php' === $tpl || is_tax( 'linh-vuc' ) ) {
        wp_enqueue_script( 'homenest-linh-vuc-script', get_template_directory_uri() . '/assets/js/pages/linh-vuc.js', array(), homenest_asset_ver( '/assets/js/pages/linh-vuc.js' ), true );
    }

    if ( 'template-homepage.php' === $tpl || is_page_template( 'templates/template-homepage.php' ) || is_front_page() ) {
        wp_enqueue_script( 'homenest-homepage-script', get_template_directory_uri() . '/assets/js/pages/homepage.js', array(), homenest_asset_ver( '/assets/js/pages/homepage.js' ), true );
    }

    // JS Chung & Section dung chung
    wp_enqueue_script( 'homenest-main-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), homenest_asset_ver( '/assets/js/main.js' ), true );
    wp_enqueue_script( 'homenest-procedure-script', get_template_directory_uri() . '/assets/js/sections/procedure.js', array(), homenest_asset_ver( '/assets/js/sections/procedure.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'homenest_enqueue_scripts' );
