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

function homenest_is_homepage() {
    $tpl = ! empty( $GLOBALS['template'] ) ? basename( $GLOBALS['template'] ) : '';
    return 'template-homepage.php' === $tpl || is_page_template( 'templates/template-homepage.php' ) || is_front_page();
}

function homenest_enqueue_scripts() {
    $is_home = homenest_is_homepage();
    // CSS Chung
    wp_enqueue_style( 'homenest-style', get_stylesheet_uri(), array(), homenest_asset_ver( '/style.css' ) );
    wp_enqueue_style( 'homenest-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), homenest_asset_ver( '/assets/css/fonts.css' ) );
    wp_enqueue_style( 'homenest-assets-style', get_template_directory_uri() . '/assets/css/style.css', array( 'homenest-style', 'homenest-fonts' ), homenest_asset_ver( '/assets/css/style.css' ) );
    wp_enqueue_style( 'homenest-header-style', get_template_directory_uri() . '/assets/css/layout/header.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/layout/header.css' ) );
    wp_enqueue_style( 'homenest-footer-style', get_template_directory_uri() . '/assets/css/layout/footer.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/layout/footer.css' ) );

    // CSS Section dung chung
    wp_enqueue_style( 'homenest-brands-style', get_template_directory_uri() . '/assets/css/sections/brands.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/sections/brands.css' ) );
    if ( ! $is_home ) wp_enqueue_style( 'homenest-procedure-style', get_template_directory_uri() . '/assets/css/sections/procedure.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/sections/procedure.css' ) );
    wp_enqueue_style( 'homenest-contact-form-style', get_template_directory_uri() . '/assets/css/sections/contact-form.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/sections/contact-form.css' ) );

    // CSS UI component dung chung
    wp_enqueue_style( 'homenest-ui-button-style', get_template_directory_uri() . '/assets/css/ui/button.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/button.css' ) );
    wp_enqueue_style( 'homenest-ui-button-detail-style', get_template_directory_uri() . '/assets/css/ui/button-detail.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/button-detail.css' ) );
    if ( ! $is_home ) wp_enqueue_style( 'homenest-ui-new-card-item-style', get_template_directory_uri() . '/assets/css/ui/new-card-item.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/new-card-item.css' ) );
    if ( ! $is_home ) wp_enqueue_style( 'homenest-ui-news-grid-style', get_template_directory_uri() . '/assets/css/ui/news-grid.css', array( 'homenest-assets-style', 'homenest-ui-new-card-item-style' ), homenest_asset_ver( '/assets/css/ui/news-grid.css' ) );
    if ( ! $is_home ) wp_enqueue_style( 'homenest-ui-job-card-item-style', get_template_directory_uri() . '/assets/css/ui/job-card-item.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/job-card-item.css' ) );
    if ( ! $is_home ) wp_enqueue_style( 'homenest-ui-pagination-style', get_template_directory_uri() . '/assets/css/ui/pagination.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/pagination.css' ) );
    if ( ! $is_home ) wp_enqueue_style( 'homenest-ui-breadcrumb-style', get_template_directory_uri() . '/assets/css/ui/breadcrumb.css', array( 'homenest-assets-style' ), homenest_asset_ver( '/assets/css/ui/breadcrumb.css' ) );

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
    wp_enqueue_script( 'homenest-main-script', get_template_directory_uri() . '/assets/js/main.js', array(), homenest_asset_ver( '/assets/js/main.js' ), true );
    wp_enqueue_script( 'homenest-procedure-script', get_template_directory_uri() . '/assets/js/sections/procedure.js', array(), homenest_asset_ver( '/assets/js/sections/procedure.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'homenest_enqueue_scripts' );


/**
 * Lay du lieu anh hero trang chu (ACF home_hero.banner) kem fallback.
 * Dung chung cho template va preload trong <head>.
 *
 * @return array{id:int,url:string,w:int,h:int}
 */
function homenest_get_hero_banner() {
    static $cache = null;
    if ( null !== $cache ) {
        return $cache;
    }
    $hero   = function_exists( 'get_field' ) ? ( get_field( 'home_hero' ) ?: array() ) : array();
    $banner = ! empty( $hero['banner'] ) && is_array( $hero['banner'] ) ? $hero['banner'] : array();
    $url    = ! empty( $banner['url'] ) ? $banner['url'] : '/wp-content/uploads/2026/11/hero_mbland.jpg';
    $id     = ! empty( $banner['ID'] ) ? (int) $banner['ID'] : (int) attachment_url_to_postid( $url );
    $cache  = array(
        'id'  => $id,
        'url' => $url,
        'w'   => ! empty( $banner['width'] ) ? (int) $banner['width'] : 2559,
        'h'   => ! empty( $banner['height'] ) ? (int) $banner['height'] : 1007,
    );
    return $cache;
}

/**
 * Preload ban hero (srcset responsive) + preconnect CDN Swiper => giam LCP tren mobile.
 */
function homenest_head_hints() {
    // Trang chi tiet du an: preload anh hero (LCP) voi srcset responsive
    if ( is_singular( 'du-an' ) ) {
        echo '<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>' . "\n";
        $thumb_id = get_post_thumbnail_id();
        $url      = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : '';
        if ( $url ) {
            $srcset = wp_get_attachment_image_srcset( $thumb_id, 'full' );
            printf(
                '<link rel="preload" as="image" href="%s"%s fetchpriority="high">' . "\n",
                esc_url( $url ),
                $srcset ? ' imagesrcset="' . esc_attr( $srcset ) . '" imagesizes="100vw"' : ''
            );
        }
        return;
    }
    if ( ! homenest_is_homepage() ) {
        return;
    }
    echo '<link rel="dns-prefetch" href="//cdn.jsdelivr.net">' . "\n";

    $hero   = homenest_get_hero_banner();
    $srcset = $hero['id'] ? wp_get_attachment_image_srcset( $hero['id'], 'full' ) : '';
    if ( $srcset ) {
        printf(
            '<link rel="preload" as="image" href="%s" imagesrcset="%s" imagesizes="100vw" fetchpriority="high">' . "\n",
            esc_url( $hero['url'] ),
            esc_attr( $srcset )
        );
    } else {
        printf( '<link rel="preload" as="image" href="%s" fetchpriority="high">' . "\n", esc_url( $hero['url'] ) );
    }
}
add_action( 'wp_head', 'homenest_head_hints', 1 );

/**
 * Swiper CSS khong chan render tren trang chu (slider nam cuoi trang).
 */
function homenest_async_swiper_css( $tag, $handle ) {
    if ( 'swiper-css' === $handle && ( homenest_is_homepage() || is_singular( 'du-an' ) ) ) {
        $async = str_replace( "media='all'", "media='print' onload=\"this.media='all'\"", $tag );
        return $async . '<noscript>' . $tag . '</noscript>';
    }
    return $tag;
}
add_filter( 'style_loader_tag', 'homenest_async_swiper_css', 10, 2 );

/**
 * Tra ve thuoc tinh srcset + sizes (chuoi HTML) cho 1 attachment ID, rong neu khong co.
 */
function homenest_srcset_attr( $id, $sizes = '(max-width: 768px) 100vw, 800px' ) {
    $id = (int) $id;
    if ( ! $id ) {
        return '';
    }
    $srcset = wp_get_attachment_image_srcset( $id, 'full' );
    return $srcset ? sprintf( ' srcset="%s" sizes="%s"', esc_attr( $srcset ), esc_attr( $sizes ) ) : '';
}


/**
 * Preload font above-the-fold (tieu de hero) tren trang chu.
 */
function homenest_preload_fonts() {
    if ( ! homenest_is_homepage() ) {
        return;
    }
    $base = get_template_directory_uri() . '/assets/font/';
    printf( '<link rel="preload" as="font" type="font/woff2" href="%s" crossorigin>' . "\n", esc_url( $base . 'fz-poppins/FZ%20Poppins-SemiBold.woff2' ) );
    printf( '<link rel="preload" as="font" type="font/otf" href="%s" crossorigin>' . "\n", esc_url( $base . 'ganh-type/Ganh%20Type%20-%20Regular.otf' ) );
}
add_action( 'wp_head', 'homenest_preload_fonts', 2 );

/**
 * Bo jquery-migrate o frontend (khong can, giam 1 request chan render).
 */
function homenest_remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, array( 'jquery-migrate' ) );
    }
}
add_action( 'wp_default_scripts', 'homenest_remove_jquery_migrate' );


/**
 * Google Analytics (gtag) tai tre: chi nap gtag.js khi nguoi dung tuong tac
 * (cuon, cham, click, phim) hoac sau 8s ke tu khi trang load xong.
 * => gtag.js (~177 KiB) khong con nam trong qua trinh tai trang ban dau.
 *
 * KICH HOAT: tat chen GA trong plugin hien tai (tranh dem trung), sau do
 * them dong sau vao wp-config.php hoac dau functions.php:
 *     define( 'HOMENEST_GA_ID', 'G-03RBP91ZEZ' );
 */
function homenest_delayed_gtag() {
    if ( ! defined( 'HOMENEST_GA_ID' ) || ! HOMENEST_GA_ID || is_admin() ) {
        return;
    }
    $id = esc_js( HOMENEST_GA_ID );
    ?>
<script>
window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}
gtag('js',new Date());gtag('config','<?php echo $id; ?>');
(function(){var done=false,ev=['scroll','pointerdown','touchstart','keydown','mousemove'];
function load(){if(done)return;done=true;ev.forEach(function(e){removeEventListener(e,load,{passive:true});});
var s=document.createElement('script');s.async=true;s.src='https://www.googletagmanager.com/gtag/js?id=<?php echo $id; ?>';document.head.appendChild(s);}
ev.forEach(function(e){addEventListener(e,load,{passive:true,once:true});});
addEventListener('load',function(){setTimeout(load,8000);});})();
</script>
    <?php
}
add_action( 'wp_head', 'homenest_delayed_gtag', 20 );
