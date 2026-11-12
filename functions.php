<?php
/**
 * Theme functions and definitions
 *
 * @package HomeNest Theme
 * @since 1.0
 */
add_filter('use_block_editor_for_post', '__return_false');

// Đường dẫn cơ bản đến thư mục inc
define( 'HOMENEST_INC_DIR', get_template_directory() . '/inc/' );

// 1. Theme Setup (Hỗ trợ menu, thumbnail, title-tag...)
require_once HOMENEST_INC_DIR . 'theme-setup.php';

// 2. Enqueue Assets (Gọi CSS/JS)
require_once HOMENEST_INC_DIR . 'enqueue.php';

// 3. Custom Post Types & Taxonomies
require_once HOMENEST_INC_DIR . 'custom-post-types.php';

// 4. Các hàm hỗ trợ khác (nếu cần)
require_once HOMENEST_INC_DIR . 'helper-functions.php';

// 5. Phan trang sach /page/N/ cho trang Tuyen dung
require_once HOMENEST_INC_DIR . 'recruitment-pagination.php';

// 6. ACF Fields cho Trang chủ (Post ID 7, 359)
require_once HOMENEST_INC_DIR . 'homepage-fields.php';

// 7. ACF Fields cho Trang Giới thiệu (Post ID 73, 377)
require_once HOMENEST_INC_DIR . 'about-fields.php';

// 8. ACF Fields cho Cài đặt chung Theme (Options Page: Brands & Contact Form)
require_once HOMENEST_INC_DIR . 'theme-options-fields.php';

// 9. ACF Fields cho Trang Tuyển Dụng (Post ID 64, 405)
require_once HOMENEST_INC_DIR . 'recruitment-fields.php';

// 10. Sắp xếp (kéo thả) thứ tự term cho taxonomy linh-vuc
require_once HOMENEST_INC_DIR . 'taxonomy-order.php';

// 11. ACF Fields cho Taxonomy Lĩnh vực (linh-vuc)
require_once HOMENEST_INC_DIR . 'linh-vuc-fields.php';

// Tắt tính năng tự động đăng ký dịch nhãn (Label, Title, Default value, Instructions) của ACF trong Polylang
add_filter( 'pll_enable_acf_labels_translation', '__return_false' );

// Giá trị ACF (Options page, Trang chủ, Giới thiệu...) lưu RIÊNG cho từng ngôn ngữ, không đồng bộ/copy giữa các ngôn ngữ.
// Các field khai báo bằng PHP không có thiết lập 'translations' nên Polylang dùng mặc định (có thể là sync/ignore).
add_filter( 'pll_acf_default_translation_setting', function ( $setting, $field = array() ) {
    $structural = array( 'tab', 'message', 'accordion', 'clone' );
    if ( isset( $field['type'] ) && in_array( $field['type'], $structural, true ) ) {
        return $setting;
    }
    return 'translate';
}, 10, 2 );

// KHÔNG CÓ THẺ ĐÓNG PHP ?>

<?php

add_action('init', function() {
// 	Footer
   pll_register_string('LIÊN HỆ', 'lien-he', 'Footer');
   pll_register_string('113 Nguyễn Văn Hưởng, phường An Khánh, Tp Hcm', 'dia-chi', 'Footer');
   pll_register_string('Họ và tên', 'ho-va-ten', 'Footer');
   pll_register_string('Email', 'email', 'Footer');
   pll_register_string('Nội dung', 'noi-dung', 'Footer');
   pll_register_string('Theo dõi chúng tôi', 'theo-doi', 'Footer');	
	
	
//   Tuyển dụng (Dịch chuỗi trong /wp-admin/admin.php?page=mlang_strings - Group: Tuyển dụng)
  pll_register_string('job_search_title', 'Tìm công việc', 'Tuyển dụng');
  pll_register_string('job_search_placeholder', 'Nhập từ khóa tìm kiếm', 'Tuyển dụng');
  pll_register_string('job_search_btn', 'Tìm kiếm', 'Tuyển dụng');
  pll_register_string('job_filter_title', 'Bộ lọc', 'Tuyển dụng');
  pll_register_string('job_filter_reset', 'Xóa bộ lọc', 'Tuyển dụng');
  pll_register_string('job_filter_position', 'Vị trí ứng tuyển', 'Tuyển dụng');
  pll_register_string('job_filter_position_placeholder', 'Nhập vị trí ứng tuyển...', 'Tuyển dụng');
  pll_register_string('job_filter_location', 'Nơi làm việc', 'Tuyển dụng');
  pll_register_string('job_filter_location_placeholder', 'Nhập nơi làm việc...', 'Tuyển dụng');
  pll_register_string('job_filter_type', 'Hình thức làm việc', 'Tuyển dụng');
  pll_register_string('job_filter_all', 'Tất cả', 'Tuyển dụng');
  pll_register_string('job_deadline', 'Hạn nộp hồ sơ', 'Tuyển dụng');
  pll_register_string('job_apply_now', 'Ứng tuyển ngay', 'Tuyển dụng');
  pll_register_string('job_salary', 'Mức lương', 'Tuyển dụng');
  pll_register_string('job_workplace', 'Địa điểm làm việc', 'Tuyển dụng');
  pll_register_string('job_address', 'Địa chỉ', 'Tuyển dụng');
  pll_register_string('job_level', 'Cấp bậc', 'Tuyển dụng');
  pll_register_string('job_experience', 'Kinh nghiệm', 'Tuyển dụng');
  pll_register_string('job_update', 'Đang cập nhật', 'Tuyển dụng');
  pll_register_string('job_negotiable', 'Thỏa thuận', 'Tuyển dụng');
  pll_register_string('job_related', 'Tin tuyển dụng khác', 'Tuyển dụng');
  pll_register_string('job_back_to_list', 'Về trang tuyển dụng', 'Tuyển dụng');
  pll_register_string('job_empty_text', 'Không tìm thấy vị trí tuyển dụng phù hợp.', 'Tuyển dụng');
  pll_register_string('job_no_other_posts', 'Hiện chưa có tin tuyển dụng khác.', 'Tuyển dụng');
  pll_register_string('job_link', 'tuyen dung', 'Tuyển dụng');

  // Pagination (Dịch chuỗi trong /wp-admin/admin.php?page=mlang_strings - Group: Pagination)
  pll_register_string('pagination_prev', 'Trước', 'Pagination');
  pll_register_string('pagination_next', 'Sau', 'Pagination');
	//News 
  pll_register_string('noi bat', 'TIN NỔI BẬT', 'News');
  pll_register_string('xem chi tiet', 'XEM CHI TIẾT', 'News');
  pll_register_string('tin tuc moi', 'TIN MỚI', 'News');
  pll_register_string('tin tuc moi', 'Tin tức mới', 'News');
  pll_register_string('tin tuc moi', 'TIN TỨC MỚI', 'News');
  pll_register_string('tat ca tin tuc', 'Tất cả tin tức', 'News');
  pll_register_string('xem them', 'Xem thêm', 'News');
  pll_register_string('dang tai', 'Đang tải...', 'News');
	
  pll_register_string('vi_tri', 'VỊ TRÍ', 'Chi tiet du an');
  pll_register_string('quy_mo', 'QUY MÔ', 'Chi tiet du an');
  pll_register_string('du an khac', 'Dự án khác', 'Chi tiet du an');
  pll_register_string('tim_hieu_them_du_an', 'Tìm hiểu thêm về dự án', 'Chi tiet du an');
  pll_register_string('mo ta du an khac', 'Tasmania & Partner là tập đoàn đa ngành với những dự án nổi bật trong suốt quá trình phát triển', 'Chi tiet du an');

  // Contact Form (Dịch chuỗi trong /wp-admin/admin.php?page=mlang_strings - Group: Contact Form)
  pll_register_string('contact_form_title', 'Liên hệ gửi yêu cầu tư vấn', 'Contact Form');
  pll_register_string('contact_form_desc', 'Kết nối cùng MBLand Asset Management để khám phá những cơ hội hợp tác và giải pháp đầu tư phù hợp với mục tiêu của bạn.', 'Contact Form', true);
  pll_register_string('contact_form_fullname_label', 'Họ và tên', 'Contact Form');
  pll_register_string('contact_form_fullname_ph', 'Nhập họ & tên của bạn tại đây', 'Contact Form');
  pll_register_string('contact_form_email_label', 'Email', 'Contact Form');
  pll_register_string('contact_form_email_ph', 'mbland@gmail.com', 'Contact Form');
  pll_register_string('contact_form_phone_label', 'Số điện thoại', 'Contact Form');
  pll_register_string('contact_form_phone_ph', 'Nhập số điện thoại của bạn', 'Contact Form');
  pll_register_string('contact_form_message_label', 'Nhập nội dung bạn muốn tư vấn', 'Contact Form');
  pll_register_string('contact_form_message_ph', 'Nhập nội dung bạn muốn tư vấn...', 'Contact Form');
  pll_register_string('contact_form_submit_btn', 'Gửi yêu cầu', 'Contact Form');
});


// Override template cho single post của CPT 'du-an' / 'project'
add_filter('template_include', 'load_custom_single_du_an_template');
function load_custom_single_du_an_template($template) {
    if (is_single() && (get_post_type() === 'du-an' || get_post_type() === 'project')) {
        $custom_template = locate_template('single-project.php');
        if (!empty($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}

// Override template cho trang bài viết chính (Blog / Tin tức) khi được set trong Settings > Reading (is_home)
add_filter( 'template_include', 'load_custom_blog_home_template', 99 );
function load_custom_blog_home_template( $template ) {
    if ( is_home() ) {
        $news_template = locate_template( 'category.php' );
        if ( ! empty( $news_template ) ) {
            return $news_template;
        }
    }
    return $template;
}

// Override template cho single post của post type 'post'
add_filter('template_include', 'load_custom_single_tin_tuc_template');
function load_custom_single_tin_tuc_template($template) {
    if (is_single() && get_post_type() === 'post') {
        $custom_template = locate_template('single.php');
        if (!empty($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}



function register_my_menus() {
    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'homenest-theme'),
        )
    );
}
add_action('init', 'register_my_menus');


// Custom Walker để tùy chỉnh class cho menu (đặt code này vào functions.php của theme)
if ( ! class_exists( 'Custom_Walker_Nav_Menu' ) ) {
    class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
        public function start_lvl( &$output, $depth = 0, $args = null ) {
            $indent = str_repeat( "\t", $depth );
            if ( $depth === 0 ) {
                $output .= "\n$indent<ul class=\"mbland-header__nav-sub-list\">\n"; // Sub-list cho cấp 1
            } else {
                $output .= "\n$indent<ul class=\"mbland-header__nav-sub-list\">\n"; // Nếu có cấp sâu hơn
            }
        }

        public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'mbland-header__nav-item'; // Class mặc định cho mọi li

            // Thêm class riêng cho sub-item (depth > 0)
            if ( $depth > 0 ) {
                $classes[] = 'mbland-header__nav-sub-item';
            }

            if ( in_array( 'menu-item-has-children', $classes ) ) {
                $classes[] = 'mbland-header__nav-item-has-children'; // Class cho li có con
            }

            // Lọc classes để tránh duplicates
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names . '>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

        public function end_el( &$output, $item, $depth = 0, $args = null ) {
            $output .= "</li>\n";
        }
    }
}

if (!class_exists('Popup_Walker_Nav_Menu')) {
    class Popup_Walker_Nav_Menu extends Walker_Nav_Menu {
        // Bắt đầu level (ul sub-menu) - Nằm riêng sau div
        function start_lvl(&$output, $depth = 0, $args = null) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"mbland-header__menu-sub-list sub-menu-mobile\">\n";  // <ul> riêng, không wrap vào div
        }
        
        // Bắt đầu element (li) - Chỉ wrap a + span vào div cho top-level (depth == 0), sub-items không wrap div
        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'mbland-header__nav-item menu-item-' . $item->ID;
            if ($this->has_children) {
                $classes[] = 'mbland-header__nav-item-has-children';
            }
            
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
            
            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';
            
            $output .= $indent . '<li' . $id . $class_names . '>';
            
            $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
            
            $item_output = $args->before;
            
            // Nếu là sub-item (depth > 0), không wrap div, chỉ output a đơn giản
            if ($depth > 0) {
                $item_output .= '<a' . $attributes . '>';
                $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;
            } else {
                // Top-level: Gộp a parent và span SVG vào 1 div (KHÔNG chứa ul)
                $item_output .= '<div class="menu-item-block">';
                $item_output .= '<a' . $attributes . '>';
                $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;
                
                // Span SVG chỉ nếu có children (cùng div với a, chỉ top-level)
                if ($this->has_children) {
                    $item_output .= '<span class="sub-menu-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 640 640"><path fill="var(--primary-color)" d="M297.4 470.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L320 402.7 150.6 233.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg></span>';
                }
                
                $item_output .= '</div>';  // Đóng div - ul sẽ nằm sau div này trong li
            }
            
            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
        
        // Kết thúc element (li)
        function end_el(&$output, $item, $depth = 0, $args = null) {
            $output .= "</li>\n";
        }
        
        // Kết thúc level (ul sub-menu) - Đóng ul riêng
        function end_lvl(&$output, $depth = 0, $args = null) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }
    }
}

// Taxonomy linh-vuc: dung taxonomy-linh-vuc.php (WordPress tu nap theo template hierarchy)

// Function để gán template tùy chỉnh cho các trang archive của terms trong taxonomy 'category'
// (Áp dụng cho URL như /tin-tuc/term-slug/ sau khi rewrite)
function custom_tin_tuc_category_template($template) {
    // Kiểm tra nếu đang ở trang category archive (sẽ khớp với rewrite rule /tin-tuc/term-slug/)
    if (is_category()) {
        $custom_template = locate_template('category.php');
        
        if (!empty($custom_template)) {
            return $custom_template; 
        }
    }
    
    return $template;
}
add_filter('template_include', 'custom_tin_tuc_category_template', 99);

// =====================================
// Ham lay chi tiet tuyen dung
// ================================
function custom_single_template_for_tuyen_dung($template) {
    global $post;

    if ($post && $post->post_type === 'tuyen-dung') {
        $custom_template = get_stylesheet_directory() . '/single-tuyen-dung.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }

    return $template;
}
add_filter('single_template', 'custom_single_template_for_tuyen_dung');


// ================================
// 🏢 Custom template cho single post type "cong-ty-con"
// ================================
function custom_single_template_for_cong_ty_con($template) {
    global $post;

    // Kiểm tra đúng post type "cong-ty-con"
    if ($post && $post->post_type === 'cong-ty-con') {
        $custom_template = get_stylesheet_directory() . '/templates/template-cong-ty-con.php';
        
        // Nếu file tồn tại thì load template tùy chỉnh
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }

    // Fallback về template mặc định
    return $template;
}
add_filter('single_template', 'custom_single_template_for_cong_ty_con');




// ================================
// === AJAX lọc tuyển dụng (có phân trang) ===
// ================================
// [DEPRECATED] AJAX filter_jobs đã được chuyển sang SSR tại template-recruitment.php
// add_action('wp_ajax_filter_jobs', 'filter_jobs');
// add_action('wp_ajax_nopriv_filter_jobs', 'filter_jobs');

function filter_jobs() {
  // --- Nhận dữ liệu từ AJAX ---
  $keyword  = sanitize_text_field($_POST['s'] ?? '');
  $vitri    = sanitize_text_field($_POST['vitri'] ?? '');
  $noilam   = sanitize_text_field($_POST['noilamviec'] ?? '');
  $hinhthuc = sanitize_text_field($_POST['hinhthuc'] ?? '');
  $paged    = isset($_POST['page']) ? intval($_POST['page']) : 1;

  // --- Cấu hình truy vấn ---
  // --- Cấu hình truy vấn ---
  $args = [
    'post_type'      => 'tuyen-dung',
    'posts_per_page' => 6, // mỗi trang 6 job
    'paged'          => $paged,
    'post_status'    => 'publish',
    'tax_query'      => ['relation' => 'AND']
  ];

  // --- Bộ lọc taxonomy ---
  if ($vitri && $vitri !== 'all') {
    $args['tax_query'][] = [
      'taxonomy' => 'vi-tri-ung-tuyen',
      'field'    => 'slug',
      'terms'    => $vitri
    ];
  }
  if ($noilam && $noilam !== 'all') {
    $args['tax_query'][] = [
      'taxonomy' => 'noi-lam-viec',
      'field'    => 'slug',
      'terms'    => $noilam
    ];
  }
  if ($hinhthuc && $hinhthuc !== 'all') {
    $args['tax_query'][] = [
      'taxonomy' => 'hinh-thuc-lam-viec',
      'field'    => 'slug',
      'terms'    => $hinhthuc
    ];
  }

  // --- Truy vấn tất cả bài viết phù hợp ---
  $jobs = new WP_Query($args);

  // --- Nếu có từ khóa: lọc thủ công theo tiêu đề + ACF ---
  if (!empty($keyword) && $jobs->have_posts()) {
    $filtered = [];

    while ($jobs->have_posts()) : $jobs->the_post();
      $title  = get_the_title();
      $fields = [
        get_field('vi_tri_ung_tuyen'),
        get_field('dia_diem_lam_viec'),
        get_field('muc_luong'),
        get_field('han_nop_ho_so'),
      ];

      // Ghép tất cả nội dung để tìm
      $content = mb_strtolower($title . ' ' . implode(' ', $fields));
      $search  = mb_strtolower($keyword);

      // So sánh không phân biệt hoa/thường
      if (strpos($content, $search) !== false) {
        $filtered[] = get_post();
      }
    endwhile;

    // Gán lại danh sách kết quả
    $jobs->posts = $filtered;
    $jobs->post_count = count($filtered);
    $jobs->found_posts = count($filtered);
    $jobs->max_num_pages = 1;
    wp_reset_postdata();
  }


  // --- Bắt đầu render ---
  if ($jobs->have_posts()) :
    ob_start();

    while ($jobs->have_posts()) : $jobs->the_post();
      $vitri   = get_field('vi_tri_ung_tuyen');
	  $terms_noilam = get_the_terms(get_the_ID(), 'noi-lam-viec');
	  $noilam = ($terms_noilam && !is_wp_error($terms_noilam))
		      ? join(', ', wp_list_pluck($terms_noilam, 'name'))
		      : 'Đang cập nhật';
      $luong   = get_field('muc_luong');
      $hannop  = get_field('han_nop_ho_so');
      ?>
      <div class="hn__job-item">
		  <div class="job-item-left">
		    <div class="deadline">
		      <span class="deadline-title"><?php echo pll__('Hạn nộp hồ sơ'); ?>:</span> 
		      <?php echo $hannop ?: pll__('Đang cập nhật'); ?>
		    </div>
			  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		    <p class="info"><b><?php echo pll__('Mức lương'); ?>:</b> <?php echo $luong ?: pll__('Thỏa thuận'); ?></p>
		    <p class="info"><b><?php echo pll__('Địa điểm làm việc'); ?>:</b> <?php echo $noilam ?: pll__('Đang cập nhật'); ?></p>
		  </div>
		  <a href="<?php the_permalink(); ?>" class="apply-btn" title="<?php the_title(); ?>" aria-label="<?php echo esc_attr( pll__('Ứng tuyển ngay') . ': ' . get_the_title() ); ?>"><?php echo pll__('Ứng tuyển ngay'); ?></a>
	  </div>

      <?php
    endwhile;

// --- Hiển thị phân trang ---
$total_pages = $jobs->max_num_pages;
if ($total_pages > 1) {
  echo '<div class="pagination-ajax">';

  // Nút "Trước" (luôn hiện)
  $prev_disabled = ($paged <= 1) ? ' is-disabled' : '';
  echo '<a href="#" class="page-link page-prev' . $prev_disabled . '" aria-label="Trang trước" data-page="' . max(1, $paged - 1) . '">Trước</a>';

  // Số trang
  for ($i = 1; $i <= $total_pages; $i++) {
    $class = 'page-link' . ($i == $paged ? ' is-active' : '');
    echo '<a href="#" class="' . $class . '" aria-label="Trang ' . $i . '"' . ($i == $paged ? ' aria-current="page"' : '') . ' data-page="' . $i . '">' . $i . '</a>';
  }

  // Nút "Sau" (luôn hiện)
  $next_disabled = ($paged >= $total_pages) ? ' is-disabled' : '';
  echo '<a href="#" class="page-link page-next' . $next_disabled . '" aria-label="Trang sau" data-page="' . min($total_pages, $paged + 1) . '">Sau</a>';

  echo '</div>';
}


    wp_reset_postdata();
    echo ob_get_clean();

//   else :
//     echo '<p>Không tìm thấy vị trí tuyển dụng phù hợp.</p>';
  endif;

  wp_die(); // Kết thúc AJAX
}


// ================================
// === AJAX Tin tức ===
// ================================
add_action('wp_ajax_load_news', 'load_news');
add_action('wp_ajax_nopriv_load_news', 'load_news');

function load_news() {
  $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
  $category = sanitize_text_field($_POST['cat'] ?? '');

  $args = [
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'paged'          => $paged,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
  ];

  if ($category && $category !== 'all') {
    $args['category_name'] = $category;
  }

  $query = new WP_Query($args);

  ob_start(); // Bắt đầu buffer HTML

  if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
      $featured_img = get_the_post_thumbnail_url(get_the_ID());
      if (!$featured_img) {
        $featured_img = get_template_directory_uri() . '/images/default.jpg';
      }
      $desc = get_field('mo_ta_ngan_tin_tuc', get_the_ID());
      $has_tin_noi_bat = has_term('', 'tin-noi-bat');
      ?>
      <div class="hn-tasmania-tt-grid-item">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hn-tasmania-tt-grid-item-image" aria-label="<?php the_title_attribute(); ?>">
          <img src="<?php echo esc_url($featured_img); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( $featured_img, 768, 512 ) ); ?> />
        </a>
        <div class="hn-tasmania-tt-grid-item-content">
          <div class="hn-tasmania-tintuc-date">
            <div class="hn-tasmania-tintuc-date-image">
              <img src="/wp-content/uploads/2025/10/clock.svg" alt="Ngày đăng" title="Ngày đăng" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/clock.svg', 20, 20 ) ); ?> />
            </div>
            <p class="hn-tasmania-date"><?php echo get_the_date('d/m/Y'); ?></p>
            <?php if ($has_tin_noi_bat) : ?>
              <div class="hn-tasmania-tintuc-date-line"></div>
              <p><?php echo pll__('TIN NỔI BẬT'); ?></p>
            <?php endif; ?>
          </div>
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" aria-label="<?php the_title_attribute(); ?>">
            <h3 class="small-h3"><?php the_title(); ?></h3>
          </a>
          <p class="desc-text"><?php echo wp_kses_post($desc ?: get_the_excerpt()); ?></p>
          <a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="Xem chi tiết" aria-label="<?php echo esc_attr( pll__('XEM CHI TIẾT') . ': ' . get_the_title() ); ?>">
            <div class="hn-tasmania-tintuc-cta-icon">
              <img src="/wp-content/uploads/2025/10/arrow-right-red.svg" alt="Xem chi tiết" title="Xem chi tiết" loading="lazy" decoding="async" fetchpriority="low" <?php echo trim( mbland_img_size_attr( '/wp-content/uploads/2025/10/arrow-right-red.svg', 15, 15 ) ); ?> />
            </div>
            <?php echo pll__('XEM CHI TIẾT'); ?>
          </a>
        </div>
      </div>
      <?php
    endwhile;
    wp_reset_postdata();
  endif;

  $html = ob_get_clean();
  $has_more = $paged < $query->max_num_pages;

  wp_send_json([
    'html' => $html,
    'has_more' => $has_more,
  ]);
}



// ========================
// SHORTCODE: Logo thương hiệu (marquee auto chạy trái, lặp vô hạn)
// ========================
function hn_logo_brand_section() {
    $logos = array();
    $acf_brands = function_exists( 'get_field' ) ? get_field( 'brands_list', 'option' ) : array();

    if ( ! empty( $acf_brands ) && is_array( $acf_brands ) ) {
        foreach ( $acf_brands as $item ) {
            if ( ! empty( $item['logo'] ) ) {
                $img_url    = is_array( $item['logo'] ) ? $item['logo']['url'] : $item['logo'];
                $img_alt    = ! empty( $item['name'] ) ? $item['name'] : ( is_array( $item['logo'] ) && ! empty( $item['logo']['alt'] ) ? $item['logo']['alt'] : 'Brand' );
                $img_width  = is_array( $item['logo'] ) && ! empty( $item['logo']['width'] ) ? $item['logo']['width'] : 500;
                $img_height = is_array( $item['logo'] ) && ! empty( $item['logo']['height'] ) ? $item['logo']['height'] : 200;
                $link       = ! empty( $item['link'] ) ? $item['link'] : '';
                $logos[]    = array( $img_url, $img_alt, $img_width, $img_height, $link );
            }
        }
    }

    // Danh sách logo mặc định nếu chưa cấu hình ACF
    if ( empty( $logos ) ) {
        $logos = [
            ['/wp-content/uploads/2025/10/logo-kw.png', 'KW', 1200, 551, ''],
            ['/wp-content/uploads/2025/10/logo-JLL.png', 'JLL', 1280, 572, ''],
            ['/wp-content/uploads/2025/10/vng.png', 'VNG', 328, 121, ''],
            ['/wp-content/uploads/2025/10/aia.png', 'AIA', 740, 740, ''],
            ['/wp-content/uploads/2025/10/bithumb.png', 'Bithumb', 236, 60, ''],
            ['/wp-content/uploads/2025/10/tonkin.png', 'Tonkin', 224, 50, ''],
            ['/wp-content/uploads/2025/10/Hilton_logo.svg', 'Hilton', 1137, 422, ''],
            ['/wp-content/uploads/2025/10/Vilaf-logo.jpg', 'Vilaf', 819, 229, ''],
            ['/wp-content/uploads/2025/10/Savills_logo.png', 'Savills', 2048, 2049, ''],
            ['/wp-content/uploads/2025/10/Vietcombank_Logo.png', 'Vietcombank', 370, 100, ''],
            ['/wp-content/uploads/2025/10/Logo_MB.png', 'MB Bank', 1200, 539, ''],
            ['/wp-content/uploads/2025/10/Lotte.png', 'Lotte', 1280, 400, ''],
            ['/wp-content/uploads/2025/10/logo-dg-group.png', 'DGGroup', 2048, 1647, ''],
            ['/wp-content/uploads/2025/10/logo-HAS-architecture.jpg', 'HAS Architecture', 2560, 2560, ''],
        ];
    }

    ob_start(); ?>
    <div class="logo-brand-marquee">
      <div class="logo-brand-track">
        <?php for ($repeat = 0; $repeat < 10; $repeat++): ?>
          <?php foreach ($logos as $lg): ?>
            <div class="logo-item">
              <?php if ( ! empty( $lg[4] ) ) : ?>
                <a href="<?php echo esc_url( $lg[4] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $lg[1] ); ?>">
              <?php endif; ?>
              <img src="<?php echo esc_url($lg[0]); ?>" loading="lazy" decoding="async" fetchpriority="low" alt="<?php echo esc_attr($lg[1]); ?>" title="<?php echo esc_attr($lg[1]); ?>" width="<?php echo esc_attr($lg[2]); ?>" height="<?php echo esc_attr($lg[3]); ?>">
              <?php if ( ! empty( $lg[4] ) ) : ?>
                </a>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>
    </div>

    <style>
      /* Vùng hiển thị */
      .logo-brand-marquee{
        width: 100%;
        overflow: hidden;
        padding: 00px 0;
        /* background: #fff; */
        /* bo mềm 2 mép bằng mask (ẩn dần) */
        -webkit-mask-image: linear-gradient(to right, transparent 0, #000 40px, #000 calc(100% - 40px), transparent 100%);
                mask-image: linear-gradient(to right, transparent 0, #000 40px, #000 calc(100% - 40px), transparent 100%);
      }

      /* Dải chạy */
      .logo-brand-track{
        display: flex;
        align-items: center;
        width: max-content;  
        animation: logo-scroll 73s linear infinite;
		gap: 100px;
      }

      /* Item luôn một hàng */
      .logo-item{
        flex: 0 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .logo-item img{
        max-height: 56px;
        width: auto;
        object-fit: contain;
        transition: transform .25s ease;
        user-select: none;
        pointer-events: auto;
        filter: none;
      }
     .logo-item img[alt="Savills"],
	 .logo-item img[alt="DGGroup"],
	 .logo-item img[alt="HAS Architecture"] {
  		height: 100px;
	  }
      .logo-item img:hover{ transform: scale(1.1); }

      /* Pause khi hover */
      .logo-brand-marquee:hover .logo-brand-track{
        animation-play-state: paused;
      }

      /* Tablet */
      @media (max-width: 996px){
        .logo-brand-track{ gap: 50px;}
        .logo-item img{ height: 50px; }
      }
      /* Mobile */
      @media (max-width: 576px){
        .logo-brand-track{ gap: 40px;}
        .logo-item img{ height: 44px; }
      }

      /* Tôn trọng người dùng hạn chế chuyển động */
      @media (prefers-reduced-motion: reduce){
        .logo-brand-track{ animation: none; }
      }

      /* Keyframes: dịch nửa dải (vì đã nhân đôi) */
      @keyframes logo-scroll{
        from { transform: translateX(0); }
        to   { transform: translateX(-50%); }
      }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('logo_brand', 'hn_logo_brand_section');



// ========================
// SHORTCODE: Breadcrumb (đường dẫn trang)
// ========================
function hn_breadcrumb_shortcode() {
    if (is_front_page()) return '';

    global $post;
    ob_start();
    ?>
    <nav class="hn-breadcrumb" aria-label="Breadcrumb">
        <ul class="breadcrumb-list">
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(pll__('Trang chủ')); ?>" aria-label="<?php echo esc_attr(pll__('Trang chủ')); ?>">
                    <?php echo esc_html(pll__('Trang chủ')); ?>
                </a>
            </li>

            <?php
            // 📍 Trang bài viết (Posts page) - trang "Tin tức" / "News"
            if (is_home() && !is_front_page()) {
                $posts_page_id = (int) get_option('page_for_posts');
                if ($posts_page_id && function_exists('pll_get_post')) {
                    $translated = pll_get_post($posts_page_id);
                    if ($translated) {
                        $posts_page_id = (int) $translated;
                    }
                }
                $posts_page_title = $posts_page_id ? get_the_title($posts_page_id) : pll__('Tin tức');
                echo '<li>' . esc_html($posts_page_title) . '</li>';

            // 📍 Taxonomy / Category
            } elseif (is_category() || is_tax()) {
                $term = get_queried_object();
                $taxonomy = $term->taxonomy;
                $ancestors = array_reverse(get_ancestors($term->term_id, $taxonomy));
                foreach ($ancestors as $ancestor_id) {
                    $ancestor = get_term($ancestor_id, $taxonomy);
                    echo '<li><a href="' . esc_url(get_term_link($ancestor)) . '" title="' . esc_attr($ancestor->name) . '">' . esc_html($ancestor->name) . '</a></li>';
                }
                echo '<li>' . esc_html($term->name) . '</li>';

            // 📍 Single post (bài viết Tin tức)
            } elseif (is_single() && get_post_type() === 'post') {
                $news_url   = '';
                $news_title = pll__('Tin tức');

                // Ưu tiên trang Posts page (đúng ngôn ngữ) thay vì hard-code
                $posts_page_id = (int) get_option('page_for_posts');
                if ($posts_page_id && function_exists('pll_get_post')) {
                    $translated = pll_get_post($posts_page_id);
                    if ($translated) {
                        $posts_page_id = (int) $translated;
                    }
                }
                if ($posts_page_id) {
                    $news_url   = get_permalink($posts_page_id);
                    $news_title = get_the_title($posts_page_id);
                } else {
                    $tin_tuc_cat = get_category_by_slug('tin-tuc');
                    $news_url = $tin_tuc_cat ? get_category_link($tin_tuc_cat->term_id) : home_url('/tin-tuc');
                }

                echo '<li><a href="' . esc_url($news_url) . '" title="' . esc_attr($news_title) . '">' . esc_html($news_title) . '</a></li>';
                echo '<li>' . esc_html(get_the_title()) . '</li>';

            // 📍 Custom Post Type
            } elseif (is_single()) {
                $post_type = get_post_type_object(get_post_type());
                if ($post_type && $post_type->has_archive) {
                    echo '<li><a href="' . esc_url(get_post_type_archive_link($post_type->name)) . '" title="' . esc_attr($post_type->labels->singular_name) . '">' . esc_html($post_type->labels->singular_name) . '</a></li>';
                }
                echo '<li>' . esc_html(get_the_title()) . '</li>';

            // 📍 Page
            } elseif (is_page()) {
                if ($post->post_parent) {
                    $ancestors = array_reverse(get_post_ancestors($post->ID));
                    foreach ($ancestors as $ancestor_id) {
                        echo '<li><a href="' . esc_url(get_permalink($ancestor_id)) . '" title="' . esc_attr(get_the_title($ancestor_id)) . '">' . esc_html(get_the_title($ancestor_id)) . '</a></li>';
                    }
                }
                echo '<li>' . esc_html(get_the_title()) . '</li>';

            // 📍 Search
            } elseif (is_search()) {
                echo '<li>' . sprintf(__('Kết quả tìm kiếm cho: "%s"', 'textdomain'), esc_html(get_search_query())) . '</li>';

            // 📍 404
            } elseif (is_404()) {
                echo '<li>' . __('Không tìm thấy trang', 'textdomain') . '</li>';
            }
            ?>
        </ul>
    </nav>
    <?php
    return ob_get_clean();
}
add_shortcode('hn_breadcrumb', 'hn_breadcrumb_shortcode');

add_action('init', function() {
    if (function_exists('pll_register_string')) {
        pll_register_string('breadcrumb_home', 'Trang chủ');
        pll_register_string('breadcrumb_news', 'Tin tức');
    }
});



/*====================================================
 * Remove "category" from post category URLs
======================================================= */
add_filter('term_link', 'homenest_remove_category_base', 10, 3);
function homenest_remove_category_base($url, $term, $taxonomy) {
    if ($taxonomy !== 'category') return $url;

    $taxonomy_slug = 'category'; // Mặc định slug gốc
    if (strpos($url, '/' . $taxonomy_slug) === false) return $url;

    // Loại bỏ /category/ khỏi URL
    $url = str_replace('/' . $taxonomy_slug, '', $url);
    return $url;
}

/**
 * Add custom rewrite rules for categories (bài post)
 */
function homenest_category_rewrite_rules($flush = false) {
    $terms = get_terms(array(
        'taxonomy'   => 'category',
        'hide_empty' => false,
    ));

    if ($terms && !is_wp_error($terms)) {
        $siteurl = esc_url(home_url('/'));
        foreach ($terms as $term) {
            $term_slug = $term->slug;
            $baseterm  = str_replace($siteurl, '', get_term_link($term->term_id, 'category'));

            add_rewrite_rule($baseterm . '?$', 'index.php?category_name=' . $term_slug, 'top');
            add_rewrite_rule($baseterm . 'page/([0-9]{1,})/?$', 'index.php?category_name=' . $term_slug . '&paged=$matches[1]', 'top');
            add_rewrite_rule($baseterm . '(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?category_name=' . $term_slug . '&feed=$matches[1]', 'top');
        }
    }

    if ($flush) flush_rewrite_rules(false);
}
add_action('init', 'homenest_category_rewrite_rules');

/* ✅ Tự động cập nhật rewrite khi tạo category mới */
add_action('create_term', 'homenest_new_category_flush_rules', 10, 2);
function homenest_new_category_flush_rules($term_id, $taxonomy) {
    if ($taxonomy === 'category') {
        homenest_category_rewrite_rules(true);
    }
}


// ===========================
// 🔄 Thêm SwiperJS toàn site
// ===========================
function hn_enqueue_swiper_assets() {
    // Chi tai Swiper o trang thuc su dung (trang chu, gioi thieu, chi tiet du an)
    $tpl = ! empty( $GLOBALS['template'] ) ? basename( $GLOBALS['template'] ) : '';
    if ( ! ( homenest_is_homepage() || 'template-about-us.php' === $tpl || is_page_template( 'templates/template-about-us.php' ) || is_singular( 'du-an' ) || 'single-project.php' === $tpl ) ) {
        return;
    }
    // ✅ Thêm CSS
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.0.0'
    );

    // ✅ Thêm JS (đặt ở footer để load sau DOM)
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'hn_enqueue_swiper_assets');
function custom_og_image() {
    if (is_singular()) {
        global $post;

        if (has_post_thumbnail($post->ID)) {
            $image = wp_get_attachment_image_src(
                get_post_thumbnail_id($post->ID),
                'full'
            );

            if ($image) {
                echo '<meta property="og:image" content="' . esc_url($image[0]) . '">' . "\n";
                echo '<meta property="og:image:secure_url" content="' . esc_url($image[0]) . '">' . "\n";
                echo '<meta property="og:image:width" content="1200">' . "\n";
                echo '<meta property="og:image:height" content="630">' . "\n";
            }
        }
    }
}
add_action('wp_head', 'custom_og_image', 5);







/**
 * ============================================================================
 * CÔNG CỤ ÉP NOINDEX & NOFOLLOW TOÀN DIỆN (Dùng cho môi trường Dev / Staging)
 * ============================================================================
 * Áp dụng triệt để cho:
 * - Tất cả Post Types (post, page, custom post types: du-an, linh-vuc...)
 * - Tất cả Taxonomies & Terms (category, post_tag, taxonomy custom...)
 * - Tất cả Archives (date, author, post type archive, taxonomy archive...)
 * - Tìm kiếm, 404, Trang chủ, Feeds, REST API và tệp tin qua HTTP Header.
 * - Tương thích và ghi đè tất cả plugin SEO: Rank Math, Yoast SEO, AIOSEO, SEOPress...
 * 
 * Khi đưa lên Production/Live: Đổi HN_FORCE_NOINDEX thành false.
 */
define( 'HN_FORCE_NOINDEX', true );

if ( defined( 'HN_FORCE_NOINDEX' ) && HN_FORCE_NOINDEX ) {

    // 1. Cấu hình WordPress Core: Ngăn bot tìm kiếm
    add_filter( 'pre_option_blog_public', '__return_zero', 9999 );

    // 2. Chuẩn wp_robots của WordPress (áp dụng cho mọi post-type, taxonomy, archive...)
    add_filter( 'wp_robots', function ( array $robots ) {
        return array(
            'noindex'   => true,
            'nofollow'  => true,
            'noarchive' => true,
        );
    }, 9999 );

    // 3. Fallback thẻ Meta trực tiếp trong <head> (ưu tiên 1, phòng theme/plugin không qua wp_robots)
    remove_action( 'wp_head', 'noindex', 1 ); // Gỡ hàm mặc định của WP (vốn sinh noindex, follow)
    add_action( 'wp_head', function () {
        echo '<meta name="robots" content="noindex, nofollow, noarchive" />' . "\n";
        echo '<meta name="googlebot" content="noindex, nofollow, noarchive" />' . "\n";
        echo '<meta name="bingbot" content="noindex, nofollow, noarchive" />' . "\n";
    }, 1 );

    // 4. HTTP Headers X-Robots-Tag (Chặn bot cấp server cho HTML, REST API, JSON, PDF, Media...)
    add_filter( 'wp_headers', function ( array $headers ) {
        $headers['X-Robots-Tag'] = 'noindex, nofollow, noarchive';
        return $headers;
    }, 9999 );

    add_action( 'send_headers', function () {
        if ( ! headers_sent() ) {
            header( 'X-Robots-Tag: noindex, nofollow, noarchive', true );
        }
    }, 9999 );

    // 5. Ghi đè Rank Math SEO
    add_filter( 'rank_math/frontend/robots', function ( $robots ) {
        if ( ! is_array( $robots ) ) {
            $robots = array();
        }
        $robots['index']     = 'noindex';
        $robots['follow']    = 'nofollow';
        $robots['noarchive'] = 'noarchive';
        return $robots;
    }, 9999 );
    add_filter( 'rank_math/sitemap/enable', '__return_false', 9999 );

    // 6. Ghi đè Yoast SEO
    add_filter( 'wpseo_robots', function () {
        return 'noindex, nofollow, noarchive';
    }, 9999 );
    add_filter( 'wpseo_robots_array', function () {
        return array(
            'index'   => 'noindex',
            'follow'  => 'nofollow',
            'archive' => 'noarchive',
        );
    }, 9999 );
    add_filter( 'wpseo_googlebot', function () {
        return 'noindex, nofollow';
    }, 9999 );
    add_filter( 'wpseo_bingbot', function () {
        return 'noindex, nofollow';
    }, 9999 );
    add_filter( 'wpseo_enable_xml_sitemap', '__return_false', 9999 );

    // 7. Ghi đè All in One SEO (AIOSEO)
    add_filter( 'aioseo_robots_meta', function ( $robots ) {
        if ( ! is_array( $robots ) ) {
            $robots = array();
        }
        $robots['noindex']   = true;
        $robots['nofollow']  = true;
        $robots['noarchive'] = true;
        return $robots;
    }, 9999 );

    // 8. Ghi đè SEOPress & The SEO Framework (nếu có dùng)
    add_filter( 'seopress_titles_robots', function () {
        return 'noindex, nofollow, noarchive';
    }, 9999 );
    add_filter( 'the_seo_framework_robots_meta_array', function () {
        return array(
            'noindex'   => 'noindex',
            'nofollow'  => 'nofollow',
            'noarchive' => 'noarchive',
        );
    }, 9999 );

    // 9. Tắt XML Sitemaps mặc định của WordPress (ngăn bot quét danh mục post types/taxonomies)
    add_filter( 'wp_sitemaps_enabled', '__return_false', 9999 );

    // 10. robots.txt ảo của WordPress chặn toàn bộ bot
    add_filter( 'robots_txt', function () {
        return "User-agent: *\nDisallow: /\n";
    }, 9999 );
}

/**
 * ============================================================================
 * TOOL: TỰ ĐỘNG ĐIỀN DỮ LIỆU FOOTER CHO ACF OPTIONS (TIẾNG VIỆT & TIẾNG ANH - POLYLANG)
 * ============================================================================
 */
function mbland_seed_footer_data() {
    if ( ! function_exists( 'update_field' ) ) {
        return false;
    }

    // 1. DỮ LIỆU TIẾNG VIỆT (VI)
    $data_vi = array(
        'footer_logo'        => '/wp-content/uploads/2026/11/Logo_MBLandAM_horonzial-white.png',
        'footer_address'     => '113 Nguyễn Văn Hưởng, Phường Thảo Điền, Quận 2, TP.Hồ Chí Minh.',
        'footer_phone_fax'   => '028 38 258 816',
        'footer_phone_call'  => '02838258816',
        'footer_email'       => 'info@tasmaniapartners.vn',
        'footer_social_title'=> 'Kết nối với chúng tôi',
        'social_facebook'    => '#',
        'social_instagram'   => '#',
        'social_linkedin'    => '#',
        'social_youtube'     => '#',
        'social_zalo'        => '#',
        'footer_copyright'   => '© 2025. MBLand Asset Management. Design by <a class="mbland-footer__copyright-link" href="https://homenest.com.vn/" target="_blank" rel="noopener">HomeNest Software</a>',
        'footer_menu_columns'=> array(
            array(
                'column_title' => 'Menu',
                'column_links' => array(
                    array( 'link_label' => 'Trang chủ', 'link_url' => '/', 'is_blank' => 0 ),
                    array( 'link_label' => 'Giới thiệu chúng tôi', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Lĩnh vực hoạt động', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Các đối tác', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Dự án nổi bật', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Hoạt động & Sự kiện', 'link_url' => '#', 'is_blank' => 0 ),
                ),
            ),
            array(
                'column_title' => 'Giới thiệu',
                'column_links' => array(
                    array( 'link_label' => 'Giá trị cốt lõi', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Sứ mệnh & tầm nhìn', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Hệ thống công ty con', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Đội ngũ lãnh đạo', 'link_url' => '#', 'is_blank' => 0 ),
                ),
            ),
            array(
                'column_title' => 'Lĩnh vực hoạt động',
                'column_links' => array(
                    array( 'link_label' => 'Bất động sản', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Dịch vụ & du lịch', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Đầu tư tài chính', 'link_url' => '#', 'is_blank' => 0 ),
                ),
            ),
            array(
                'column_title' => 'Tin tức',
                'column_links' => array(
                    array( 'link_label' => 'Tin nổi bật', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Tin tức mới', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Văn hoá công ty', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Hoạt động xã hội', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Tin dự án', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Tin hoạt động', 'link_url' => '#', 'is_blank' => 0 ),
                ),
            ),
            array(
                'column_title' => 'Tuyển dụng',
                'column_links' => array(
                    array( 'link_label' => 'Tuyển dụng Thành phố Hồ Chí Minh', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Tuyển dụng Hà Nội', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Tuyển dụng Đà Nẵng', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Tuyển dụng Quảng Nam', 'link_url' => '#', 'is_blank' => 0 ),
                ),
            ),
        ),
    );

    // 2. DỮ LIỆU TIẾNG ANH (EN)
    $data_en = array(
        'footer_logo'        => '/wp-content/uploads/2026/11/Logo_MBLandAM_horonzial-white.png',
        'footer_address'     => '113 Nguyen Van Huong, Thao Dien Ward, District 2, Ho Chi Minh City.',
        'footer_phone_fax'   => '028 38 258 816',
        'footer_phone_call'  => '02838258816',
        'footer_email'       => 'info@tasmaniapartners.vn',
        'footer_social_title'=> 'Connect with us',
        'social_facebook'    => '#',
        'social_instagram'   => '#',
        'social_linkedin'    => '#',
        'social_youtube'     => '#',
        'social_zalo'        => '#',
        'footer_copyright'   => '© 2025. MBLand Asset Management. Design by <a class="mbland-footer__copyright-link" href="https://homenest.com.vn/" target="_blank" rel="noopener">HomeNest Software</a>',
        'footer_menu_columns'=> array(
            array(
                'column_title' => 'Menu',
                'column_links' => array(
                    array( 'link_label' => 'Home', 'link_url' => '/en/', 'is_blank' => 0 ),
                    array( 'link_label' => 'About Us', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Fields of Operation', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Partners', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Featured Projects', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'News & Events', 'link_url' => '#', 'is_blank' => 0 ),
                ),
            ),
            array(
                'column_title' => 'About Us',
                'column_links' => array(
                    array( 'link_label' => 'Core Values', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Mission & Vision', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Subsidiaries', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Leadership', 'link_url' => '#', 'is_blank' => 0 ),
                ),
            ),
            array(
                'column_title' => 'Fields of Operation',
                'column_links' => array(
                    array( 'link_label' => 'Real Estate', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Services & Tourism', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Financial Investment', 'link_url' => '#', 'is_blank' => 0 ),
                ),
            ),
            array(
                'column_title' => 'News',
                'column_links' => array(
                    array( 'link_label' => 'Featured News', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Latest News', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Corporate Culture', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Social Activities', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Project News', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Corporate News', 'link_url' => '#', 'is_blank' => 0 ),
                ),
            ),
            array(
                'column_title' => 'Careers',
                'column_links' => array(
                    array( 'link_label' => 'Careers in Ho Chi Minh City', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Careers in Hanoi', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Careers in Da Nang', 'link_url' => '#', 'is_blank' => 0 ),
                    array( 'link_label' => 'Careers in Quang Nam', 'link_url' => '#', 'is_blank' => 0 ),
                ),
            ),
        ),
    );

    // Cập nhật cho Tiếng Việt (gán cho option, layout, option_vi, layout_vi)
    $vi_post_ids = array( 'option', 'layout', 'option_vi', 'layout_vi' );
    foreach ( $vi_post_ids as $pid ) {
        foreach ( $data_vi as $field_key => $field_val ) {
            update_field( $field_key, $field_val, $pid );
        }
    }

    // Cập nhật cho Tiếng Anh (gán cho option_en, layout_en)
    $en_post_ids = array( 'option_en', 'layout_en' );
    foreach ( $en_post_ids as $pid ) {
        foreach ( $data_en as $field_key => $field_val ) {
            update_field( $field_key, $field_val, $pid );
        }
    }

    return true;
}

// Xử lý kích hoạt tool từ Admin hoặc URL
add_action( 'admin_init', function () {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Kích hoạt qua query URL: ?seed_footer=1
    if ( isset( $_GET['seed_footer'] ) && $_GET['seed_footer'] == '1' ) {
        check_admin_referer( 'mbland_seed_footer_nonce' );
        mbland_seed_footer_data();
        $redirect_url = remove_query_arg( array( 'seed_footer', '_wpnonce' ) );
        $redirect_url = add_query_arg( 'footer_seeded', '1', $redirect_url );
        wp_safe_redirect( $redirect_url );
        exit;
    }
} );

// Hiển thị Banner nút bấm và thông báo trong trang Admin Options
add_action( 'admin_notices', function () {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Thông báo thành công
    if ( isset( $_GET['footer_seeded'] ) && $_GET['footer_seeded'] == '1' ) {
        echo '<div class="notice notice-success is-dismissible" style="padding: 12px 15px; border-left-color: #46b450;">';
        echo '<p style="margin: 0; font-size: 14px; font-weight: 600;">✅ Đã điền thành công toàn bộ dữ liệu mẫu Footer cho Tiếng Việt và Tiếng Anh (Polylang)!</p>';
        echo '</div>';
    }

    // Nút bấm tiện ích trong trang options layout
    if ( isset( $_GET['page'] ) && $_GET['page'] === 'layout' && ! isset( $_GET['footer_seeded'] ) ) {
        $seed_url = wp_nonce_url( admin_url( 'admin.php?page=layout&seed_footer=1' ), 'mbland_seed_footer_nonce' );
        echo '<div class="notice notice-info" style="padding: 14px 18px; border-left: 4px solid #8A0218; background: #fff;">';
        echo '<h3 style="margin: 0 0 6px 0; color: #8A0218;">🛠️ Tool tự động điền dữ liệu Footer (MBLand Asset Management)</h3>';
        echo '<p style="margin: 0 0 12px 0; color: #444;">Nhấn nút bên dưới để tự động nạp sẵn toàn bộ thông tin (Logo, Liên hệ, 5 cột menu chuẩn thiết kế, Bản quyền) cho cả <strong>Tiếng Việt</strong> và <strong>Tiếng Anh (Polylang)</strong>:</p>';
        echo '<a href="' . esc_url( $seed_url ) . '" class="button button-primary" style="background: #8A0218; border-color: #8A0218; font-weight: 600;" onclick="return confirm(\'Xác nhận nạp dữ liệu mẫu Footer cho cả Tiếng Việt và Tiếng Anh?\');">👉 Nạp nhanh dữ liệu Footer (VI & EN)</a>';
        echo '</div>';
    }
} );











/* =========================================================================
 * TOOL: Điền 6 thống kê dự án (ACF Repeater 'thong_ke_du_an') cho post_type = du-an
 * Sub fields: tieu_de (Văn bản), mo_ta (Vùng chứa văn bản), con_so (Văn bản)
 * Cách dùng: Dự án (du-an) -> bấm nút "Điền 6 thống kê dự án".
 * Mặc định chỉ điền cho dự án CHƯA có thống kê; dự án đã có dữ liệu được giữ nguyên.
 * ========================================================================= */

/**
 * Dữ liệu 6 thống kê mẫu (sửa tại đây nếu cần).
 */
function mbland_du_an_default_stats() {
    return array(
        array(
            'con_so' => '3.209,2 m2',
            'tieu_de' => 'Tổng diện tích thửa đất',
            'mo_ta'  => 'Tổng hợp diện tích đất theo hồ sơ pháp lý và thông tin được ghi nhận trên hệ thống.',
        ),
        array(
            'con_so' => '24.282m2',
            'tieu_de' => 'Tổng diện tích sàn dự án',
            'mo_ta'  => 'Tổng diện tích sàn xây dựng của toàn bộ công trình thuộc dự án, được quy hoạch và thiết kế.',
        ),
        array(
            'con_so' => '60%',
            'tieu_de' => 'Mật độ xây dựng dự án',
            'mo_ta'  => 'Tỷ lệ diện tích chiếm đất của các công trình xây dựng trên tổng diện tích khu đất dự án.',
        ),
        array(
            'con_so' => 'Cơ sở hạ tầng',
            'tieu_de' => 'Hạ tầng kỹ thuật dự án',
            'mo_ta'  => 'Hệ thống giao thông, điện, nước và các tiện ích kỹ thuật được đầu tư đồng bộ, hiện đại.',
        ),
        array(
            'con_so' => 'Mức độ an ninh',
            'tieu_de' => 'An ninh và an toàn',
            'mo_ta'  => 'Hệ thống an ninh, giám sát và phòng cháy chữa cháy vận hành liên tục 24/7.',
        ),
        array(
            'con_so' => 'Mức độ cư dân',
            'tieu_de' => 'Cộng đồng cư dân',
            'mo_ta'  => 'Tỷ lệ cư dân và khách hàng đang sinh sống, khai thác tại dự án.',
        ),
    );
}

/**
 * Điền thống kê cho các post du-an.
 *
 * @param bool $overwrite true = ghi đè cả dự án đã có thống kê.
 * @return array{updated:int, skipped:int, log:string[]}|WP_Error
 */
function mbland_seed_du_an_stats( $overwrite = false ) {
    if ( ! function_exists( 'update_field' ) || ! function_exists( 'get_field' ) ) {
        return new WP_Error( 'no_acf', 'Cần kích hoạt plugin ACF (Advanced Custom Fields).' );
    }

    $post_ids = get_posts( array(
        'post_type'      => 'du-an',
        'post_status'    => 'any',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'no_found_rows'  => true,
        'lang'           => '', // Polylang: lấy tất cả ngôn ngữ
    ) );

    $stats  = mbland_du_an_default_stats();
    $result = array( 'updated' => 0, 'skipped' => 0, 'log' => array() );

    foreach ( $post_ids as $post_id ) {
        $title    = get_the_title( $post_id );
        $existing = get_field( 'thong_ke_du_an', $post_id, false );

        if ( ! $overwrite && ! empty( $existing ) ) {
            $result['skipped']++;
            $result['log'][] = "⏭️ Bỏ qua (đã có thống kê): {$title} (ID {$post_id})";
            continue;
        }

        if ( update_field( 'thong_ke_du_an', $stats, $post_id ) ) {
            $result['updated']++;
            $result['log'][] = "✅ Đã điền " . count( $stats ) . " thống kê: {$title} (ID {$post_id})";
        } else {
            $result['log'][] = "❌ Không cập nhật được: {$title} (ID {$post_id}). Kiểm tra field 'thong_ke_du_an' đã gán cho post type du-an chưa.";
        }
    }

    return $result;
}

// Xử lý kích hoạt tool
add_action( 'admin_init', function () {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    if ( isset( $_GET['seed_du_an_stats'] ) ) {
        check_admin_referer( 'mbland_seed_du_an_stats_nonce' );
        @set_time_limit( 300 );
        $res = mbland_seed_du_an_stats( $_GET['seed_du_an_stats'] === 'overwrite' );
        set_transient( 'mbland_seed_du_an_stats_result_' . get_current_user_id(), $res, 5 * MINUTE_IN_SECONDS );
        wp_safe_redirect( add_query_arg( 'du_an_stats_seeded', '1', remove_query_arg( array( 'seed_du_an_stats', '_wpnonce' ) ) ) );
        exit;
    }
} );

// Nút bấm + thông báo kết quả trong màn hình danh sách Dự án
add_action( 'admin_notices', function () {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    $screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
    if ( ! $screen || $screen->id !== 'edit-du-an' ) {
        return;
    }

    if ( isset( $_GET['du_an_stats_seeded'] ) ) {
        $key = 'mbland_seed_du_an_stats_result_' . get_current_user_id();
        $res = get_transient( $key );
        delete_transient( $key );
        if ( is_wp_error( $res ) ) {
            echo '<div class="notice notice-error"><p>❌ ' . esc_html( $res->get_error_message() ) . '</p></div>';
        } elseif ( is_array( $res ) ) {
            echo '<div class="notice notice-success is-dismissible"><p><strong>Hoàn tất: cập nhật ' . (int) $res['updated'] . ', bỏ qua ' . (int) $res['skipped'] . ' dự án.</strong></p>';
            if ( $res['log'] ) {
                echo '<ul style="list-style:disc;margin-left:20px;">';
                foreach ( $res['log'] as $line ) {
                    echo '<li>' . esc_html( $line ) . '</li>';
                }
                echo '</ul>';
            }
            echo '</div>';
        }
        return;
    }

    $url_fill = wp_nonce_url( admin_url( 'edit.php?post_type=du-an&seed_du_an_stats=1' ), 'mbland_seed_du_an_stats_nonce' );
    $url_over = wp_nonce_url( admin_url( 'edit.php?post_type=du-an&seed_du_an_stats=overwrite' ), 'mbland_seed_du_an_stats_nonce' );
    echo '<div class="notice notice-info" style="padding:14px 18px;border-left:4px solid #8A0218;">';
    echo '<h3 style="margin:0 0 6px;color:#8A0218;">🛠️ Tool điền 6 thống kê dự án</h3>';
    echo '<p style="margin:0 0 12px;">Điền 6 thống kê mẫu vào field <code>thong_ke_du_an</code> cho các dự án.</p>';
    echo '<a href="' . esc_url( $url_fill ) . '" class="button button-primary" style="background:#8A0218;border-color:#8A0218;margin-right:8px;" onclick="return confirm(\'Điền 6 thống kê cho các dự án chưa có dữ liệu?\');">👉 Điền 6 thống kê dự án</a>';
    echo '<a href="' . esc_url( $url_over ) . '" class="button" onclick="return confirm(\'Ghi đè thống kê của TẤT CẢ dự án (kể cả đã có dữ liệu)?\');">Ghi đè tất cả</a>';
    echo '</div>';
} );


/**
 * Import du-an + ACF từ tasmaniapartners.vn
 * Trigger: /wp-admin/?run_import_du_an=1&key=YOUR_SECRET_KEY
 */

add_action('admin_init', 'h2_import_du_an_from_tasmania');

function h2_import_du_an_from_tasmania() {
    if ( ! isset($_GET['run_import_du_an']) || $_GET['run_import_du_an'] != '1' ) {
        return;
    }

    $secret_key = 'YOUR_SECRET_KEY'; // ← Đổi key của bạn

    if ( ! isset($_GET['key']) || $_GET['key'] !== $secret_key ) {
        wp_die('Sai key bảo mật.');
    }

    if ( ! current_user_can('manage_options') ) {
        wp_die('Bạn không có quyền.');
    }

    set_time_limit(0);
    ignore_user_abort(true);
    ini_set('memory_limit', '512M');

    // Chay theo lo: dung sau ~35s de tranh 504, trang tu tai lai de chay tiep (da co danh dau tien do)
    $start_time = microtime(true);
    $time_budget = 35;
    $stopped = false;
    $repaired = 0;

    $source_url = 'https://tasmaniapartners.vn/wp-json/wp/v2/du-an';
    $per_page   = 30;
    $page       = 1;
    $imported   = 0;
    $skipped    = 0;
    $errors     = [];

    // Mapping: source_id => new_post_id
    $id_map = [];

    // Lưu thông tin translations để xử lý sau
    $translations_data = [];

    $taxonomies = ['danh-muc-du-an', 'du-an-noi-bat', 'linh-vuc'];

    // Dong bo cay term (cha/con + ngon ngu) truoc khi gan term cho bai
    foreach ( $taxonomies as $sync_tax ) {
        h2_sync_term_hierarchy( $sync_tax, $errors );
    }

    do {
        $response = wp_remote_get( add_query_arg([
            'per_page' => $per_page,
            'page'     => $page,
            '_embed'   => 1,
        ], $source_url ), [
            'timeout'   => 90,
            'sslverify' => false,
        ]);

        if ( is_wp_error($response) ) {
            $errors[] = 'Lỗi kết nối page ' . $page . ': ' . $response->get_error_message();
            break;
        }

        if ( wp_remote_retrieve_response_code($response) !== 200 ) {
            $errors[] = 'HTTP lỗi ở page ' . $page;
            break;
        }

        $posts = json_decode( wp_remote_retrieve_body($response), true );

        if ( empty($posts) || ! is_array($posts) ) {
            break;
        }

        foreach ( $posts as $remote_post ) {
            if ( microtime(true) - $start_time > $time_budget ) {
                $stopped = true;
                break 2;
            }

            // Kiểm tra đã import chưa
            $existing = get_posts([
                'post_type'      => 'du-an',
                'meta_key'       => '_source_post_id',
                'meta_value'     => $remote_post['id'],
                'posts_per_page' => 1,
                'fields'         => 'ids',
                'post_status'    => 'any',
            ]);

            if ( ! empty($existing) ) {
                $skipped++;
                $ex_id = (int) $existing[0];
                $id_map[ $remote_post['id'] ] = $ex_id;
                if ( ! empty($remote_post['translations']) ) {
                    $translations_data[ $remote_post['id'] ] = $remote_post['translations'];
                }

                // Bai tao do (bi timeout/504 giua chung) -> lam not cac buoc con thieu
                $needs_finish = ! get_post_meta( $ex_id, '_h2_import_done', true );
                // Them &sync_acf=1 de dong bo lai ACF cho bai da import day du
                $needs_acf    = ! empty($_GET['sync_acf']) && ! get_post_meta( $ex_id, '_h2_acf_synced', true );

                if ( $needs_finish ) {
                    h2_import_post_details( $ex_id, $remote_post, $taxonomies, $errors );
                    update_post_meta( $ex_id, '_h2_import_done', 1 );
                    $repaired++;
                } elseif ( $needs_acf && ! empty($remote_post['acf']) && is_array($remote_post['acf']) ) {
                    h2_import_acf_fields( $ex_id, $remote_post['acf'], $errors );
                    update_post_meta( $ex_id, '_h2_acf_synced', 1 );
                    $repaired++;
                }
                continue;
            }
            // 1. Tạo post
            $post_data = [
                'post_title'    => wp_strip_all_tags( $remote_post['title']['rendered'] ),
                'post_content'  => $remote_post['content']['rendered'],
                'post_status'   => $remote_post['status'],
                'post_type'     => 'du-an',
                'post_name'     => $remote_post['slug'],
                'post_date'     => $remote_post['date'],
                'post_date_gmt' => $remote_post['date_gmt'],
            ];

            $new_post_id = wp_insert_post( $post_data, true );

            if ( is_wp_error($new_post_id) ) {
                $errors[] = 'Không tạo được: ' . $remote_post['slug'];
                continue;
            }

            // Lưu ID gốc
            update_post_meta( $new_post_id, '_source_post_id', $remote_post['id'] );
            $id_map[ $remote_post['id'] ] = $new_post_id;

            // Lưu thông tin translations để xử lý sau
            if ( ! empty($remote_post['translations']) ) {
                $translations_data[ $remote_post['id'] ] = $remote_post['translations'];
            }

            h2_import_post_details( $new_post_id, $remote_post, $taxonomies, $errors );
            update_post_meta( $new_post_id, '_h2_import_done', 1 );

            $imported++;
        }

        $page++;
        usleep(400000);

    } while ( count($posts) === $per_page );

    // =====================================================
    // 6. Đồng bộ Polylang translations
    // =====================================================
    if ( ! $stopped && function_exists('pll_save_post_translations') && ! empty($translations_data) ) {

        $processed = []; // tránh xử lý trùng

        foreach ( $translations_data as $source_id => $trans ) {

            // Bỏ qua nếu đã xử lý
            if ( isset($processed[$source_id]) ) continue;

            $lang_map = []; // ['en' => new_id, 'vi' => new_id]

            foreach ( $trans as $lang => $sid ) {
                if ( isset($id_map[$sid]) ) {
                    $lang_map[$lang] = $id_map[$sid];
                    $processed[$sid] = true;
                }
            }

            // Chỉ nối khi có ít nhất 2 ngôn ngữ
            if ( count($lang_map) >= 2 ) {
                pll_save_post_translations( $lang_map );
            }
        }
    }

    // Kết quả
    echo '<div style="padding:40px;font-family:sans-serif;max-width:800px">';
    echo '<h2>' . ( $stopped ? 'Đang import theo lô...' : 'Import hoàn tất' ) . '</h2>';
    echo '<p><strong>Đã import:</strong> ' . $imported . '</p>';
    echo '<p><strong>Bỏ qua (đã có):</strong> ' . $skipped . '</p>';
    echo '<p><strong>Đã sửa/đồng bộ thêm:</strong> ' . $repaired . '</p>';
    if ( $stopped ) {
        $next = esc_url( add_query_arg( null, null ) );
        echo '<p style="color:#b36b00"><strong>Chưa xong - trang sẽ tự chạy tiếp sau 2 giây.</strong> Đừng đóng tab.</p>';
        echo '<meta http-equiv="refresh" content="2;url=' . $next . '">';
    }
    echo '<p><strong>Đã đồng bộ Polylang:</strong> ' . count($translations_data) . ' nhóm</p>';

    if ( $errors ) {
        echo '<h3 style="color:#c00">Lỗi:</h3><ul>';
        foreach ( $errors as $e ) echo '<li>' . esc_html($e) . '</li>';
        echo '</ul>';
    }

    echo '<p style="color:red;font-weight:bold">→ Sau khi xong hãy xóa code này ngay!</p>';
    echo '</div>';
    exit;
}

/**
 * Dong bo cay term tu site nguon: tao term con thieu, gan dung term cha (hierarchical), gan ngon ngu Polylang.
 * Can thiet de truy van `include_children` (vd /linh-vuc/bat-dong-san/ gom ca danh muc con) hoat dong dung.
 */
function h2_sync_term_hierarchy( $tax, array &$errors ) {
    if ( ! taxonomy_exists( $tax ) ) {
        $errors[] = "Taxonomy '{$tax}' chưa được đăng ký trên site này.";
        return;
    }
    $res = wp_remote_get( "https://tasmaniapartners.vn/wp-json/wp/v2/{$tax}?per_page=100&_fields=id,slug,name,parent,lang", [ 'timeout' => 60, 'sslverify' => false ] );
    if ( is_wp_error( $res ) || wp_remote_retrieve_response_code( $res ) !== 200 ) {
        return;
    }
    $remote = json_decode( wp_remote_retrieve_body( $res ), true );
    if ( ! is_array( $remote ) ) {
        return;
    }

    $by_id = [];
    foreach ( $remote as $r ) {
        $by_id[ $r['id'] ] = $r;
    }

    // 1. Dam bao term ton tai (cha truoc con khong can thiet: parent gan o buoc 2)
    $local = []; // remote_id => local term_id
    foreach ( $remote as $r ) {
        $slug = $r['slug'];
        $term = get_term_by( 'slug', $slug, $tax );
        if ( ! $term ) {
            $ins = wp_insert_term( html_entity_decode( $r['name'], ENT_QUOTES, 'UTF-8' ), $tax, [ 'slug' => $slug ] );
            if ( is_wp_error( $ins ) ) {
                $errors[] = "Không tạo được term {$tax}/{$slug}: " . $ins->get_error_message();
                continue;
            }
            $local[ $r['id'] ] = (int) $ins['term_id'];
        } else {
            $local[ $r['id'] ] = (int) $term->term_id;
        }
    }

    // 2. Gan cha + ngon ngu
    foreach ( $remote as $r ) {
        if ( empty( $local[ $r['id'] ] ) ) {
            continue;
        }
        $tid = $local[ $r['id'] ];

        if ( ! empty( $r['parent'] ) && ! empty( $local[ $r['parent'] ] ) ) {
            $term = get_term( $tid, $tax );
            if ( $term && ! is_wp_error( $term ) && (int) $term->parent !== (int) $local[ $r['parent'] ] ) {
                wp_update_term( $tid, $tax, [ 'parent' => (int) $local[ $r['parent'] ] ] );
            }
        }

        if ( function_exists( 'pll_set_term_language' ) && ! empty( $r['lang'] ) && function_exists( 'pll_get_term_language' ) && ! pll_get_term_language( $tid ) ) {
            pll_set_term_language( $tid, $r['lang'] );
        }
    }
}

/**
 * Cac buoc con cua 1 bai du-an: taxonomy, anh dai dien, ACF, ngon ngu.
 * Co the chay lai an toan (bo qua anh dai dien neu da co).
 */
function h2_import_post_details( $new_post_id, $remote_post, $taxonomies, array &$errors ) {
            // 2. Taxonomy
            foreach ( $taxonomies as $tax ) {
                if ( empty($remote_post[$tax]) ) continue;

                $term_ids = [];
                foreach ( $remote_post[$tax] as $term_id_remote ) {
                    $term_res = wp_remote_get( "https://tasmaniapartners.vn/wp-json/wp/v2/{$tax}/{$term_id_remote}" );
                    if ( is_wp_error($term_res) ) continue;

                    $term_data = json_decode( wp_remote_retrieve_body($term_res), true );
                    if ( empty($term_data['name']) ) continue;

                    $term = term_exists( $term_data['slug'], $tax );
                    if ( ! $term ) {
                        $term = wp_insert_term( $term_data['name'], $tax, [
                            'slug' => $term_data['slug'],
                        ]);
                    }

                    if ( ! is_wp_error($term) ) {
                        $term_ids[] = (int) $term['term_id'];
                    }
                }

                if ( $term_ids ) {
                    wp_set_object_terms( $new_post_id, $term_ids, $tax );
                }
            }

            // 3. Featured Image
            if ( ! has_post_thumbnail( $new_post_id ) && ! empty($remote_post['featured_media']) ) {
                $media_res = wp_remote_get( "https://tasmaniapartners.vn/wp-json/wp/v2/media/{$remote_post['featured_media']}" );
                if ( ! is_wp_error($media_res) ) {
                    $media = json_decode( wp_remote_retrieve_body($media_res), true );
                    if ( ! empty($media['source_url']) ) {
                        $image_id = h2_sideload_image( $media['source_url'], $new_post_id );
                        if ( $image_id && ! is_wp_error($image_id) ) {
                            set_post_thumbnail( $new_post_id, $image_id );
                        }
                    }
                }
            }

            // 4. ACF
            if ( ! empty($remote_post['acf']) && is_array($remote_post['acf']) ) {
                h2_import_acf_fields( $new_post_id, $remote_post['acf'], $errors );
            }
            // 5. Set ngôn ngữ
            if ( function_exists('pll_set_post_language') && ! empty($remote_post['lang']) ) {
                pll_set_post_language( $new_post_id, $remote_post['lang'] );
            }

}

/**
 * Dong bo truong ACF tu REST cua site nguon.
 * REST nguon tra moi field kem 1 khoa phu "<ten>_source" (label/type/formatted_value) -> bo qua khoa phu,
 * chi dung "type" de biet field la image/file/gallery.
 * Field image/file/gallery tren REST chi tra ID anh CUA SITE NGUON -> goi REST media de lay URL, tai ve media site dich, doi sang ID moi.
 * Field khong ton tai tren site dich duoc ghi vao $errors.
 */
function h2_import_acf_fields( $post_id, array $acf, array &$errors ) {
    if ( ! function_exists('update_field') ) {
        return;
    }
    foreach ( $acf as $field_name => $field_value ) {
        if ( substr( $field_name, -7 ) === '_source' ) {
            continue;
        }
        if ( function_exists('acf_get_field') && ! acf_get_field( $field_name ) ) {
            $errors[] = "Bài #{$post_id}: field ACF '{$field_name}' không tồn tại trên site này (cần tạo field group trùng tên).";
            continue;
        }
        if ( $field_value === null || $field_value === false ) {
            continue;
        }
        $type = isset( $acf[ $field_name . '_source' ]['type'] ) ? $acf[ $field_name . '_source' ]['type'] : '';

        if ( in_array( $type, [ 'image', 'file' ], true ) ) {
            $new_id = h2_import_remote_attachment( $field_value, $post_id );
            if ( $new_id ) {
                update_field( $field_name, $new_id, $post_id );
            } elseif ( $field_value !== '' ) {
                $errors[] = "Bài #{$post_id}: không tải được ảnh/file cho field '{$field_name}'.";
            }
            continue;
        }

        if ( $type === 'gallery' && is_array( $field_value ) ) {
            $ids = [];
            foreach ( $field_value as $item ) {
                $new_id = h2_import_remote_attachment( $item, $post_id );
                if ( $new_id ) {
                    $ids[] = $new_id;
                }
            }
            update_field( $field_name, $ids, $post_id );
            continue;
        }

        update_field( $field_name, h2_acf_convert_value( $field_value, $post_id ), $post_id );
    }
}

/**
 * Nhan 1 gia tri anh tu REST nguon (ID so, URL, hoac mang co url) -> tra ve ID attachment tren site dich (hoac 0).
 */
function h2_import_remote_attachment( $value, $post_id ) {
    $url = '';
    if ( is_array( $value ) && ! empty( $value['url'] ) ) {
        $url = $value['url'];
    } elseif ( is_numeric( $value ) && (int) $value > 0 ) {
        $res = wp_remote_get( 'https://tasmaniapartners.vn/wp-json/wp/v2/media/' . (int) $value . '?_fields=source_url', [ 'timeout' => 60, 'sslverify' => false ] );
        if ( ! is_wp_error( $res ) && wp_remote_retrieve_response_code( $res ) === 200 ) {
            $data = json_decode( wp_remote_retrieve_body( $res ), true );
            $url  = isset( $data['source_url'] ) ? $data['source_url'] : '';
        }
    } elseif ( is_string( $value ) && filter_var( $value, FILTER_VALIDATE_URL ) ) {
        $url = $value;
    }
    if ( ! $url ) {
        return 0;
    }
    $id = h2_sideload_image_cached( $url, $post_id );
    return ( $id && ! is_wp_error( $id ) ) ? (int) $id : 0;
}
/**
 * Nhan dien mang la anh/file ACF (co url + dau hieu attachment), khac voi truong Link (url/title/target).
 */
function h2_acf_is_attachment( $v ) {
    return is_array($v) && ! empty($v['url']) && ( isset($v['mime_type']) || isset($v['sizes']) || isset($v['filename']) || ( isset($v['ID']) && isset($v['type']) ) );
}

function h2_acf_convert_value( $value, $post_id ) {
    if ( ! is_array($value) ) {
        return $value;
    }
    if ( h2_acf_is_attachment($value) ) {
        $id = h2_sideload_image_cached( $value['url'], $post_id );
        return ( $id && ! is_wp_error($id) ) ? $id : '';
    }
    $out = [];
    foreach ( $value as $k => $v ) {
        $out[$k] = h2_acf_convert_value( $v, $post_id );
    }
    return $out;
}

/**
 * Sideload co cache theo URL goc de khong tai trung anh khi chay lai.
 */
function h2_sideload_image_cached( $url, $post_id = 0 ) {
    $existing = get_posts([
        'post_type'      => 'attachment',
        'post_status'    => 'inherit',
        'meta_key'       => '_h2_source_url',
        'meta_value'     => $url,
        'posts_per_page' => 1,
        'fields'         => 'ids',
    ]);
    if ( ! empty($existing) ) {
        return $existing[0];
    }
    $id = h2_sideload_image( $url, $post_id );
    if ( $id && ! is_wp_error($id) ) {
        update_post_meta( $id, '_h2_source_url', $url );
    }
    return $id;
}
function h2_sideload_image( $image_url, $post_id = 0 ) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $tmp = download_url( $image_url );
    if ( is_wp_error($tmp) ) return $tmp;

    $file_array = [
        'name'     => basename( parse_url($image_url, PHP_URL_PATH) ),
        'tmp_name' => $tmp,
    ];

    $id = media_handle_sideload( $file_array, $post_id );

    if ( is_wp_error($id) ) {
        @unlink($tmp);
    }

    return $id;
}