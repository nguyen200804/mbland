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
	
	
//   Recruit
  pll_register_string('job_link', 'tuyen dung', 'Recruit');
  pll_register_string('job_deadline', 'Hạn nộp hồ sơ', 'Recruit');
  pll_register_string('job_salary', 'Mức lương', 'Recruit');
  pll_register_string('job_address', 'Địa chỉ', 'Recruit');
  pll_register_string('job_workplace', 'Địa điểm làm việc', 'Recruit');
  pll_register_string('job_level', 'Cấp bậc', 'Recruit');
  pll_register_string('job_experience', 'Kinh nghiệm', 'Recruit');
  pll_register_string('job_update', 'Đang cập nhật', 'Recruit');
  pll_register_string('job_negotiable', 'Thỏa thuận', 'Recruit');
  pll_register_string('job_apply_now', 'Ứng tuyển ngay', 'Recruit');
  pll_register_string('job_related', 'Tin tuyển dụng khác', 'Recruit');
  pll_register_string('job_back_to_list', 'Về trang tuyển dụng', 'Recruit');
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
	  pll_register_string('mo ta du an khac', 'Tasmania & Partner là tập đoàn đa ngành với những dự án nổi bật trong suốt quá trình phát triển', 'Chi tiet du an');
});


// Override template cho single post của CPT 'du-an' - sử dụng file từ subfolder
add_filter('template_include', 'load_custom_single_du_an_template');
function load_custom_single_du_an_template($template) {
    // Kiểm tra điều kiện: Là single post và post type là 'du-an'
    if (is_single() && get_post_type() === 'du-an') {
        // Đường dẫn đến file template tùy chỉnh
        $custom_template = locate_template('template-du-an/single-project.php');
        
        // Nếu tìm thấy file, trả về đường dẫn đó; nếu không, fallback về template mặc định
        if (!empty($custom_template)) {
            return $custom_template;
        }
    }
    // Trả về template gốc nếu không khớp
    return $template;
}

// Override template cho trang bài viết chính (Blog / Tin tức) khi được set trong Settings > Reading (is_home)
add_filter( 'template_include', 'load_custom_blog_home_template', 99 );
function load_custom_blog_home_template( $template ) {
    if ( is_home() ) {
        $news_template = locate_template( 'template-tin-tuc/template-tin-tuc-category.php' );
        if ( ! empty( $news_template ) ) {
            return $news_template;
        }
    }
    return $template;
}

// Override template cho single post của post type 'post' - sử dụng file từ subfolder
add_filter('template_include', 'load_custom_single_tin_tuc_template');
function load_custom_single_tin_tuc_template($template) {
    // Kiểm tra điều kiện: Là single post và post type là 'post'
    if (is_single() && get_post_type() === 'post') {
        // Đường dẫn đến file template tùy chỉnh
        $custom_template = locate_template('template-tin-tuc/template-single-tin-tuc.php');
        
        // Nếu tìm thấy file, trả về đường dẫn đó; nếu không, fallback về template mặc định
        if (!empty($custom_template)) {
            return $custom_template;
        }
    }
    // Trả về template gốc nếu không khớp
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
        // Tìm file template tùy chỉnh trong theme (ví dụ: file có Template Name: Tin tức category)
        $custom_template = locate_template('/template-tin-tuc/template-tin-tuc-category.php');
        
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

    if ($post->post_type === 'tuyen-dung') {
        $custom_template = get_stylesheet_directory() . '/template-tuyen-dung/template-single-tuyen-dung.php';
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
    if ($post->post_type === 'cong-ty-con') {
        $custom_template = get_stylesheet_directory() . '/template-cong-ty-con/template-cong-ty-con.php';
        
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
		  <a href="<?php the_permalink(); ?>" class="apply-btn" title="<?php the_title(); ?>"><?php echo pll__('Ứng tuyển ngay'); ?></a>
	  </div>

      <?php
    endwhile;

// --- Hiển thị phân trang ---
$total_pages = $jobs->max_num_pages;
if ($total_pages > 1) {
  echo '<div class="pagination-ajax">';

  // Nút "Trước" (luôn hiện)
  $prev_disabled = ($paged <= 1) ? ' is-disabled' : '';
  echo '<a href="#" class="page-link page-prev' . $prev_disabled . '" data-page="' . max(1, $paged - 1) . '">Trước</a>';

  // Số trang
  for ($i = 1; $i <= $total_pages; $i++) {
    $class = 'page-link' . ($i == $paged ? ' is-active' : '');
    echo '<a href="#" class="' . $class . '" data-page="' . $i . '">' . $i . '</a>';
  }

  // Nút "Sau" (luôn hiện)
  $next_disabled = ($paged >= $total_pages) ? ' is-disabled' : '';
  echo '<a href="#" class="page-link page-next' . $next_disabled . '" data-page="' . min($total_pages, $paged + 1) . '">Sau</a>';

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
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hn-tasmania-tt-grid-item-image">
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
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <h3 class="small-h3"><?php the_title(); ?></h3>
          </a>
          <p class="desc-text"><?php echo wp_kses_post($desc ?: get_the_excerpt()); ?></p>
          <a class="hn-tasmania-tintuc-cta" href="<?php the_permalink(); ?>" title="Xem chi tiết">
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
                <a href="<?php echo esc_url( $lg[4] ); ?>" target="_blank" rel="noopener noreferrer">
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
                <a href="<?php echo home_url(); ?>" title="<?php echo esc_attr(pll__('Trang chủ')); ?>">
                    <?php echo pll__('Trang chủ'); ?>
                </a>
            </li>

            <?php
            // 📍 Taxonomy / Category
            if (is_category() || is_tax()) {
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
                $tin_tuc_cat = get_category_by_slug('tin-tuc');
                if ($tin_tuc_cat) {
                    echo '<li><a href="' . esc_url(get_category_link($tin_tuc_cat->term_id)) . '" title="' . esc_attr__('Tin tức', 'textdomain') . '">Tin tức</a></li>';
                } else {
                    echo '<li><a href="' . esc_url(home_url('/tin-tuc')) . '" title="' . esc_attr__('Tin tức', 'textdomain') . '">Tin tức</a></li>';
                }
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
  pll_register_string('breadcrumb_home', 'Trang chủ');
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









