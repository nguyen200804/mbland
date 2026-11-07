<?php
/**
 * Các hàm hỗ trợ khác cho theme
 * @package HomeNest Theme
 */

// Hàm ví dụ:
function homenest_get_logo_url() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    if ( is_array( $logo ) ) {
        return esc_url( $logo[0] );
    }
    return esc_url( home_url( '/' ) );
}

/**
 * Lấy kích thước thật (width/height) của ảnh từ URL để in vào thẻ ảnh.
 * Thứ tự dò: file local trong thư mục uploads (kể cả SVG) -> attachment metadata -> giá trị fallback.
 *
 * Usage (trong thẻ ảnh): src="..." <?php echo mbland_img_size_attr( $url, 800, 600 ); ?>
 *
 * @param string $src        URL ảnh (tuyệt đối hoặc tương đối, vd '/wp-content/uploads/...').
 * @param int    $fallback_w Width mặc định khi không xác định được.
 * @param int    $fallback_h Height mặc định khi không xác định được.
 * @return string Chuỗi ' width="W" height="H"' đã escape.
 */
if ( ! function_exists( 'mbland_get_img_size' ) ) {
    function mbland_get_img_size( $src, $fallback_w = 0, $fallback_h = 0 ) {
        static $cache = array();

        $src = is_string( $src ) ? trim( $src ) : '';
        if ( '' === $src ) {
            return array( (int) $fallback_w, (int) $fallback_h );
        }
        if ( isset( $cache[ $src ] ) ) {
            return $cache[ $src ];
        }

        $w = 0;
        $h = 0;

        // 1. Đọc trực tiếp file local trong thư mục uploads
        $path    = (string) wp_parse_url( $src, PHP_URL_PATH );
        $uploads = wp_get_upload_dir();
        $up_path = (string) wp_parse_url( $uploads['baseurl'], PHP_URL_PATH );
        if ( $path && $up_path && 0 === strpos( $path, $up_path ) ) {
            $file = $uploads['basedir'] . substr( rawurldecode( $path ), strlen( $up_path ) );
            if ( is_readable( $file ) ) {
                if ( 'svg' === strtolower( pathinfo( $file, PATHINFO_EXTENSION ) ) ) {
                    $svg = (string) file_get_contents( $file, false, null, 0, 4096 );
                    if ( preg_match( '/<svg\b[^>]*>/i', $svg, $tag ) ) {
                        if ( preg_match( '/\swidth\s*=\s*["\']([\d.]+)(px)?["\']/i', $tag[0], $mw ) && preg_match( '/\sheight\s*=\s*["\']([\d.]+)(px)?["\']/i', $tag[0], $mh ) ) {
                            $w = (int) round( $mw[1] );
                            $h = (int) round( $mh[1] );
                        } elseif ( preg_match( '/viewBox\s*=\s*["\'][\d.\-]+[\s,]+[\d.\-]+[\s,]+([\d.]+)[\s,]+([\d.]+)["\']/i', $tag[0], $vb ) ) {
                            $w = (int) round( $vb[1] );
                            $h = (int) round( $vb[2] );
                        }
                    }
                } else {
                    $size = wp_getimagesize( $file );
                    if ( ! empty( $size[0] ) && ! empty( $size[1] ) ) {
                        $w = (int) $size[0];
                        $h = (int) $size[1];
                    }
                }
            }
        }

        // 2. Attachment metadata (trường hợp ảnh không nằm local, vd offload CDN)
        if ( ( ! $w || ! $h ) && $path ) {
            $abs_url = ( 0 === strpos( $src, '/' ) && 0 !== strpos( $src, '//' ) ) ? home_url( $src ) : $src;
            $att_id  = attachment_url_to_postid( $abs_url );
            if ( $att_id ) {
                $img = wp_get_attachment_image_src( $att_id, 'full' );
                if ( ! empty( $img[1] ) && ! empty( $img[2] ) ) {
                    $w = (int) $img[1];
                    $h = (int) $img[2];
                }
            }
        }

        // 3. Fallback
        if ( ! $w || ! $h ) {
            $w = (int) $fallback_w;
            $h = (int) $fallback_h;
        }

        $cache[ $src ] = array( $w, $h );
        return $cache[ $src ];
    }
}

if ( ! function_exists( 'mbland_img_size_attr' ) ) {
    function mbland_img_size_attr( $src, $fallback_w = 0, $fallback_h = 0 ) {
        list( $w, $h ) = mbland_get_img_size( $src, $fallback_w, $fallback_h );
        if ( ! $w || ! $h ) {
            return '';
        }
        return ' width="' . esc_attr( $w ) . '" height="' . esc_attr( $h ) . '"';
    }
}

/**
 * Làm sạch chuỗi plain text, loại bỏ cả thẻ HTML lẫn ký tự mã hóa HTML entity (&lt;p&gt;, &nbsp;, ...)
 */
if ( ! function_exists( 'mbland_clean_plain_text' ) ) {
    function mbland_clean_plain_text( $text ) {
        if ( empty( $text ) ) {
            return '';
        }
        // Giải mã HTML entities (gọi 2 lần đề phòng trường hợp bị double-encoded như &amp;lt;p&amp;gt;)
        $decoded = html_entity_decode( (string) $text, ENT_QUOTES, 'UTF-8' );
        $decoded = html_entity_decode( $decoded, ENT_QUOTES, 'UTF-8' );
        
        // Loại bỏ thẻ HTML chuẩn
        $clean = wp_strip_all_tags( $decoded, true );
        
        // Loại bỏ triệt để các thẻ còn sót lại dạng <...> hoặc các ký tự khoảng trắng đặc biệt
        $clean = preg_replace( '/<[^>]*>/', '', $clean );
        $clean = str_replace( array( '&nbsp;', '&#160;' ), ' ', $clean );
        
        return trim( $clean );
    }
}
