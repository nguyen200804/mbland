<?php
/**
 * Template Name: Tuyển Dụng
 */

get_header();

// ==========================================================================
// LẤY DỮ LIỆU TỪ ACF FIELD GROUPS
// ==========================================================================
$recruitment_intro = get_field( 'recruitment_intro' ) ?: array();
$recruitment_jobs  = get_field( 'recruitment_jobs' ) ?: array();
$recruitment_news  = get_field( 'recruitment_news' ) ?: array();

// Jobs settings
$jobs_per_page = ! empty( $recruitment_jobs['posts_per_page'] ) ? max( 1, intval( $recruitment_jobs['posts_per_page'] ) ) : 6;

// ==========================================================================
// SSR: NHẬN THAM SỐ BỘ LỌC TỪ URL VÀ TRUY VẤN DỮ LIỆU
// ==========================================================================
$keyword  = sanitize_text_field( $_GET['keyword'] ?? $_GET['s'] ?? '' );
$vitri    = sanitize_text_field( $_GET['vi-tri-ung-tuyen'] ?? 'all' );
$noilam   = sanitize_text_field( $_GET['noi-lam-viec'] ?? 'all' );
$hinhthuc = sanitize_text_field( $_GET['hinh-thuc-lam-viec'] ?? 'all' );
// Phân trang sạch /page/N/ (rewrite rule tại inc/recruitment-pagination.php)
$paged    = max( 1, intval( get_query_var( 'paged' ) ) );
$page_url = get_permalink( get_queried_object_id() );

$jobs_args = array(
	'post_type'      => 'tuyen-dung',
	'posts_per_page' => $jobs_per_page,
	'paged'          => $paged,
	'post_status'    => 'publish',
	'tax_query'      => array( 'relation' => 'AND' ),
);

if ( ! empty( $vitri ) && 'all' !== $vitri ) {
	$jobs_args['tax_query'][] = array(
		'taxonomy' => 'vi-tri-ung-tuyen',
		'field'    => 'slug',
		'terms'    => $vitri,
	);
}

if ( ! empty( $noilam ) && 'all' !== $noilam ) {
	$jobs_args['tax_query'][] = array(
		'taxonomy' => 'noi-lam-viec',
		'field'    => 'slug',
		'terms'    => $noilam,
	);
}

if ( ! empty( $hinhthuc ) && 'all' !== $hinhthuc ) {
	$jobs_args['tax_query'][] = array(
		'taxonomy' => 'hinh-thuc-lam-viec',
		'field'    => 'slug',
		'terms'    => $hinhthuc,
	);
}

if ( ! empty( $keyword ) ) {
	$jobs_args['s'] = $keyword;
}

$jobs_query = new WP_Query( $jobs_args );
?>

<!-- ==========================================================================
     SECTION 1: BREADCRUMB, NỘI DUNG GIỚI THIỆU (TITLE & TEXT), BANNER
     ========================================================================== -->
<?php
$intro_title    = ! empty( $recruitment_intro['title'] ) ? $recruitment_intro['title'] : 'MBLand Asset Management';
$intro_content  = ! empty( $recruitment_intro['content'] ) ? $recruitment_intro['content'] : '';
$intro_banner   = ! empty( $recruitment_intro['banner']['url'] ) ? $recruitment_intro['banner']['url'] : '/wp-content/uploads/2025/10/Banner-Tuyen-dung-1.png';
$intro_banner_w = ! empty( $recruitment_intro['banner']['width'] ) ? $recruitment_intro['banner']['width'] : 1920;
$intro_banner_h = ! empty( $recruitment_intro['banner']['height'] ) ? $recruitment_intro['banner']['height'] : 700;
?>
<section class="mbland_recruitment_intro">
	<div class="container">
		<div class="mbland_recruitment_intro_breadcrumb">
			<?php echo do_shortcode( '[hn_breadcrumb]' ); ?>
		</div>

		<div class="mbland_recruitment_intro_content">
			<h1 class="mbland_recruitment_intro_title"><?php echo esc_html( $intro_title ); ?></h1>
			<div class="mbland_recruitment_intro_desc">
				<?php if ( ! empty( $intro_content ) ) : ?>
					<?php echo wp_kses_post( $intro_content ); ?>
				<?php else : ?>
					<p>
						Được thành lập vào năm 2015, MBLand Asset Management là tập đoàn đa ngành, đã
						và đang đầu tư một số dự án trong và ngoài nước thuộc lĩnh vực Tài chính
						- Bất động sản - Du lịch Dịch vụ dưới thương hiệu của một số Công ty con
						- Công ty liên kết như MBland Holdings, F&S Investment, Tonkin
						Properties, Golden Field,.. với các dự án trọng điểm tại Đà Nẵng, Hội
						An, Quảng Ngãi, Hà Nội, Quảng Ninh, Nha Trang, Tp Hồ Chí Minh,...
					</p>
					<p>
						MBLand Asset Management đã và đang hợp tác với nhiều đối tác tại thị trường
						Châu Âu và Châu Á để mở rộng đầu tư và phát triển tại Úc, Singapore,
						Hungary, Thái Lan, Hy Lạp,... dưới các thương hiệu Blooming Elite,
						Sentosa Holdings và Moni Galery,...
					</p>
				<?php endif; ?>
			</div>
		</div>

		<div class="mbland_recruitment_intro_banner">
			<img
				class="mbland_recruitment_intro_bannerImage"
				src="<?php echo esc_url( $intro_banner ); ?>"
				alt="<?php echo esc_attr( $intro_title ); ?>"
				title="<?php echo esc_attr( $intro_title ); ?>"
				loading="eager"
				decoding="async"
				fetchpriority="high"
				width="<?php echo esc_attr( $intro_banner_w ); ?>"
				height="<?php echo esc_attr( $intro_banner_h ); ?>"
			/>
		</div>
	</div>
</section>

<!-- ==========================================================================
     SECTION 2: HEADING (TITLE & TEXT), LIST TUYỂN DỤNG & BỘ LỌC
     ========================================================================== -->
<?php
$jobs_title        = ! empty( $recruitment_jobs['title'] ) ? $recruitment_jobs['title'] : 'Cơ hội việc làm';
$jobs_desc         = ! empty( $recruitment_jobs['desc'] ) ? $recruitment_jobs['desc'] : 'Cơ hội việc làm tại môi trường chuyên nghiệp trong và ngoài nước thuộc lĩnh vực Tài chính – Bất động sản – Du lịch Dịch vụ';
$jobs_search_title = function_exists( 'pll__' ) ? pll__( ! empty( $recruitment_jobs['search_title'] ) ? $recruitment_jobs['search_title'] : 'Tìm công việc' ) : ( ! empty( $recruitment_jobs['search_title'] ) ? $recruitment_jobs['search_title'] : 'Tìm công việc' );
$jobs_search_ph    = function_exists( 'pll__' ) ? pll__( ! empty( $recruitment_jobs['search_placeholder'] ) ? $recruitment_jobs['search_placeholder'] : 'Nhập từ khóa tìm kiếm' ) : ( ! empty( $recruitment_jobs['search_placeholder'] ) ? $recruitment_jobs['search_placeholder'] : 'Nhập từ khóa tìm kiếm' );
$jobs_search_btn   = function_exists( 'pll__' ) ? pll__( ! empty( $recruitment_jobs['search_btn_text'] ) ? $recruitment_jobs['search_btn_text'] : 'Tìm kiếm' ) : ( ! empty( $recruitment_jobs['search_btn_text'] ) ? $recruitment_jobs['search_btn_text'] : 'Tìm kiếm' );
$jobs_filter_title = function_exists( 'pll__' ) ? pll__( ! empty( $recruitment_jobs['filter_title'] ) ? $recruitment_jobs['filter_title'] : 'Bộ lọc' ) : ( ! empty( $recruitment_jobs['filter_title'] ) ? $recruitment_jobs['filter_title'] : 'Bộ lọc' );
$jobs_filter_reset = function_exists( 'pll__' ) ? pll__( ! empty( $recruitment_jobs['filter_reset_text'] ) ? $recruitment_jobs['filter_reset_text'] : 'Xóa bộ lọc' ) : ( ! empty( $recruitment_jobs['filter_reset_text'] ) ? $recruitment_jobs['filter_reset_text'] : 'Xóa bộ lọc' );
$jobs_empty_text   = function_exists( 'pll__' ) ? pll__( ! empty( $recruitment_jobs['empty_text'] ) ? $recruitment_jobs['empty_text'] : 'Không tìm thấy vị trí tuyển dụng phù hợp.' ) : ( ! empty( $recruitment_jobs['empty_text'] ) ? $recruitment_jobs['empty_text'] : 'Không tìm thấy vị trí tuyển dụng phù hợp.' );
?>
<section class="mbland_recruitment_jobs">
	<div class="container">
		<header class="mbland_recruitment_jobs_header">
			<h2 class="mbland_recruitment_jobs_title"><?php echo esc_html( $jobs_title ); ?></h2>
			<p class="mbland_recruitment_jobs_desc"><?php echo nl2br( esc_html( $jobs_desc ) ); ?></p>
		</header>

		<!-- Form tìm kiếm -->
		<form method="get" class="mbland_recruitment_jobs_searchForm" id="careerForm" action="<?php echo esc_url( $page_url ); ?>">
			<h3 class="mbland_recruitment_jobs_searchTitle"><?php echo esc_html( $jobs_search_title ); ?></h3>
			<input type="text" name="keyword" value="<?php echo esc_attr( $keyword ); ?>" class="mbland_recruitment_jobs_searchInput" placeholder="<?php echo esc_attr( $jobs_search_ph ); ?>" autocomplete="off">
			<button type="submit" class="mbland_recruitment_jobs_searchBtn" id="careerSearchBtn"><?php echo esc_html( $jobs_search_btn ); ?></button>
		</form>

		<!-- Dropdown bộ lọc cho mobile -->
		<div class="mbland_recruitment_jobs_filterDropdown" id="filterDropdownBar"></div>

		<!-- Layout tuyển dụng: Bộ lọc (trái) + Danh sách Job (phải) -->
		<div class="mbland_recruitment_jobs_layout">
			<!-- Cột trái: Bộ lọc -->
			<aside class="mbland_recruitment_jobs_sidebar">
				<div class="mbland_recruitment_jobs_filter">
					<div class="mbland_recruitment_jobs_filterHeader">
						<h3 class="mbland_recruitment_jobs_filterTitle"><?php echo esc_html( $jobs_filter_title ); ?></h3>
						<button type="button" class="mbland_recruitment_jobs_filterReset" id="resetFilter"><?php echo esc_html( $jobs_filter_reset ); ?></button>
					</div>

					<!-- Vị trí ứng tuyển -->
					<div class="mbland_recruitment_jobs_filterGroup" id="filter-vitri">
						<h4 class="mbland_recruitment_jobs_filterGroupTitle"><?php echo function_exists( 'pll__' ) ? pll__( 'Vị trí ứng tuyển' ) : 'Vị trí ứng tuyển'; ?></h4>
						<input type="text" class="mbland_recruitment_jobs_filterInput" id="vitriInput" placeholder="<?php echo esc_attr( function_exists( 'pll__' ) ? pll__( 'Nhập vị trí ứng tuyển...' ) : 'Nhập vị trí ứng tuyển...' ); ?>">
						<div class="mbland_recruitment_jobs_filterOptions">
							<label><input type="radio" form="careerForm" name="vi-tri-ung-tuyen" value="all" <?php checked( $vitri, 'all' ); ?>> <?php echo function_exists( 'pll__' ) ? pll__( 'Tất cả' ) : 'Tất cả'; ?></label>
							<?php
							$terms = get_terms( array( 'taxonomy' => 'vi-tri-ung-tuyen', 'hide_empty' => false ) );
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
								foreach ( $terms as $term ) :
							?>
								<label><input type="radio" form="careerForm" name="vi-tri-ung-tuyen" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $vitri, $term->slug ); ?>> <?php echo esc_html( $term->name ); ?></label>
							<?php
								endforeach;
							endif;
							?>
						</div>
					</div>

					<!-- Nơi làm việc -->
					<div class="mbland_recruitment_jobs_filterGroup" id="filter-noilamviec">
						<h4 class="mbland_recruitment_jobs_filterGroupTitle"><?php echo function_exists( 'pll__' ) ? pll__( 'Nơi làm việc' ) : 'Nơi làm việc'; ?></h4>
						<input type="text" class="mbland_recruitment_jobs_filterInput" id="noilamviecInput" placeholder="<?php echo esc_attr( function_exists( 'pll__' ) ? pll__( 'Nhập nơi làm việc...' ) : 'Nhập nơi làm việc...' ); ?>">
						<div class="mbland_recruitment_jobs_filterOptions">
							<label><input type="radio" form="careerForm" name="noi-lam-viec" value="all" <?php checked( $noilam, 'all' ); ?>> <?php echo function_exists( 'pll__' ) ? pll__( 'Tất cả' ) : 'Tất cả'; ?></label>
							<?php
							$terms = get_terms( array( 'taxonomy' => 'noi-lam-viec', 'hide_empty' => false ) );
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
								foreach ( $terms as $term ) :
							?>
								<label><input type="radio" form="careerForm" name="noi-lam-viec" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $noilam, $term->slug ); ?>> <?php echo esc_html( $term->name ); ?></label>
							<?php
								endforeach;
							endif;
							?>
						</div>
					</div>

					<!-- Hình thức làm việc -->
					<div class="mbland_recruitment_jobs_filterGroup">
						<h4 class="mbland_recruitment_jobs_filterGroupTitle"><?php echo function_exists( 'pll__' ) ? pll__( 'Hình thức làm việc' ) : 'Hình thức làm việc'; ?></h4>
						<div class="mbland_recruitment_jobs_filterOptions">
							<label><input type="radio" form="careerForm" name="hinh-thuc-lam-viec" value="all" <?php checked( $hinhthuc, 'all' ); ?>> <?php echo function_exists( 'pll__' ) ? pll__( 'Tất cả' ) : 'Tất cả'; ?></label>
							<?php
							$terms = get_terms( array( 'taxonomy' => 'hinh-thuc-lam-viec', 'hide_empty' => false ) );
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
								foreach ( $terms as $term ) :
							?>
								<label><input type="radio" form="careerForm" name="hinh-thuc-lam-viec" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $hinhthuc, $term->slug ); ?>> <?php echo esc_html( $term->name ); ?></label>
							<?php
								endforeach;
							endif;
							?>
						</div>
					</div>
				</div>
			</aside>

			<!-- Cột phải: Danh sách job & Phân trang (SSR) -->
			<div class="mbland_recruitment_jobs_content">
				<div class="mbland_recruitment_jobs_list">
					<?php
					if ( $jobs_query->have_posts() ) :
						while ( $jobs_query->have_posts() ) :
							$jobs_query->the_post();
							get_template_part( 'template-parts/ui/job-card-item' );
						endwhile;
					else :
					?>
						<p class="mbland_recruitment_jobs_noPosts">
							<?php echo esc_html( $jobs_empty_text ); ?>
						</p>
					<?php
					endif;
					?>
				</div>

				<!-- Phân trang SSR -->
				<?php
				$active_params = array();
				if ( ! empty( $keyword ) ) {
					$active_params['keyword'] = $keyword;
				}
				if ( ! empty( $vitri ) && 'all' !== $vitri ) {
					$active_params['vi-tri-ung-tuyen'] = $vitri;
				}
				if ( ! empty( $noilam ) && 'all' !== $noilam ) {
					$active_params['noi-lam-viec'] = $noilam;
				}
				if ( ! empty( $hinhthuc ) && 'all' !== $hinhthuc ) {
					$active_params['hinh-thuc-lam-viec'] = $hinhthuc;
				}

				get_template_part( 'template-parts/ui/pagination', null, array(
					'query'    => $jobs_query,
					'current'  => $paged,
					'base'     => trailingslashit( $page_url ) . '%_%',
					'format'   => 'page/%#%/',
					'add_args' => $active_params,
					'class'    => 'mbland_recruitment_jobs_pagination',
				) );
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</section>

<!-- ==========================================================================
     SECTION 3: TIN TỨC LIÊN QUAN
     ========================================================================== -->
<?php
$news_title    = ! empty( $recruitment_news['title'] ) ? $recruitment_news['title'] : ( function_exists( 'pll__' ) ? pll__( 'Tin tức liên quan' ) : 'Tin tức liên quan' );
$news_badge    = ! empty( $recruitment_news['badge'] ) ? $recruitment_news['badge'] : ( function_exists( 'pll__' ) ? pll__( 'TIN NỔI BẬT' ) : 'TIN NỔI BẬT' );
$news_per_page = ! empty( $recruitment_news['posts_per_page'] ) ? max( 1, intval( $recruitment_news['posts_per_page'] ) ) : 2;
?>
<section class="mbland_recruitment_news">
	<div class="container">
		<div class="mbland_recruitment_news_header">
			<h2 class="mbland_recruitment_news_heading">
				<?php echo esc_html( $news_title ); ?>
			</h2>
			<div class="mbland_recruitment_news_line"></div>
		</div>

		<?php
		get_template_part( 'template-parts/ui/news-grid', null, array(
			'posts_per_page' => $news_per_page,
			'badge'          => $news_badge,
			'card_class'     => 'mbland_recruitment_news_card',
		) );
		?>
	</div>
</section>

<?php add_action( 'wp_footer', function () { ?>
<script>
/* Bộ lọc tuyển dụng: dùng form GET + tải lại trang (page reload), không dùng AJAX */
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('careerForm');
  const filterWrap = document.querySelector('.mbland_recruitment_jobs_filter');
  if (!form) return;

  // Không gửi các giá trị mặc định 'all' lên URL cho gọn
  form.addEventListener('submit', function () {
    Array.from(form.elements).forEach(function (el) {
      if (el.type === 'radio' && el.value === 'all') el.disabled = true;
    });
    const keyword = form.querySelector('input[name="keyword"]');
    if (keyword && keyword.value.trim() === '') {
      keyword.disabled = true;
    }
  });

  // Khôi phục trạng thái khi quay lại trang bằng nút Back (bfcache)
  window.addEventListener('pageshow', function () {
    Array.from(form.elements).forEach(function (el) { el.disabled = false; });
  });

  // Chọn radio bộ lọc -> tải lại trang với tham số mới
  document.querySelectorAll('.mbland_recruitment_jobs_filter input[type="radio"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
      form.requestSubmit();
    });
  });

  // Xóa bộ lọc -> về URL gốc của trang
  function resetAllFilters() {
    window.location.href = form.getAttribute('action'); // URL gốc của trang (không có /page/N/)
  }
  document.getElementById('resetFilter')?.addEventListener('click', resetAllFilters);

  // Ô nhập lọc nhanh danh sách radio (chỉ ẩn/hiện nhãn, không reload)
  function filterRadioList(inputEl, optionsEl) {
    const val = inputEl.value.toLowerCase().trim();
    optionsEl.querySelectorAll('label').forEach(function (label) {
      const isAll = label.querySelector('input[value="all"]');
      label.style.display = (val === '' || isAll || label.textContent.toLowerCase().includes(val)) ? '' : 'none';
    });
  }

  [
    ['vitriInput', '#filter-vitri .mbland_recruitment_jobs_filterOptions'],
    ['noilamviecInput', '#filter-noilamviec .mbland_recruitment_jobs_filterOptions']
  ].forEach(function (pair) {
    const input = document.getElementById(pair[0]);
    const options = document.querySelector(pair[1]);
    if (input && options) {
      input.addEventListener('input', function () {
        filterRadioList(input, options);
      });
    }
  });

  // Dropdown bộ lọc cho mobile (đồng bộ với radio rồi reload trang)
  (function buildFilterDropdowns() {
    const bar = document.getElementById('filterDropdownBar');
    if (!filterWrap || !bar) return;
    const groups = filterWrap.querySelectorAll('.mbland_recruitment_jobs_filterGroup');
    if (groups.length < 3) return;

    const headerMobile = document.createElement('div');
    headerMobile.className = 'filter-header';
    headerMobile.innerHTML = `
      <h3 class="title">Bộ lọc</h3>
      <button type="button" class="reset-filter" id="resetFilterMobile">Xóa bộ lọc</button>
    `;
    bar.appendChild(headerMobile);

    const createSelectFromGroup = function (groupEl, titleText) {
      const name = groupEl.querySelector('input[type="radio"]')?.name || '';
      const wrap = document.createElement('div');
      wrap.className = 'select-wrap';
      const labelEl = document.createElement('label');
      labelEl.textContent = titleText || '';
      wrap.appendChild(labelEl);

      const select = document.createElement('select');
      select.name = name + '_mobile'; // tránh trùng tên với radio khi submit
      const optAll = document.createElement('option');
      optAll.value = 'all';
      optAll.textContent = 'Tất cả';
      select.appendChild(optAll);

      const seen = new Set();
      groupEl.querySelectorAll('label').forEach(function (lb) {
        const r = lb.querySelector('input[type="radio"]');
        if (!r || r.value === 'all' || seen.has(r.value)) return;
        seen.add(r.value);
        const op = document.createElement('option');
        op.value = r.value;
        op.textContent = lb.textContent.trim();
        select.appendChild(op);
      });

      const checked = groupEl.querySelector('input[type="radio"]:checked');
      if (checked) select.value = checked.value;

      select.addEventListener('change', function () {
        const target =
          filterWrap.querySelector('input[name="' + name + '"][value="' + CSS.escape(select.value) + '"]') ||
          filterWrap.querySelector('input[name="' + name + '"][value="all"]');
        if (target) {
          target.checked = true;
          form.requestSubmit();
        }
      });
      wrap.appendChild(select);
      return wrap;
    };

    const getTitle = function (idx) {
      return groups[idx].querySelector('h4, h3')?.textContent?.trim() || '';
    };
    [0, 1, 2].forEach(function (i) {
      bar.appendChild(createSelectFromGroup(groups[i], getTitle(i)));
    });

    document.getElementById('resetFilterMobile')?.addEventListener('click', resetAllFilters);
  })();
});
</script>
<?php }, 99 ); ?>

<?php get_footer(); ?>
