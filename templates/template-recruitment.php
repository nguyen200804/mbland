<?php
/*
Template Name: Tuyển Dụng
*/
get_header();

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
	'posts_per_page' => 6,
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
<section class="mbland_recruitment_intro">
	<div class="container">
		<div class="mbland_recruitment_intro_breadcrumb">
			<?php echo do_shortcode( '[hn_breadcrumb]' ); ?>
		</div>

		<div class="mbland_recruitment_intro_content">
			<h1 class="mbland_recruitment_intro_title">Tasmania & partners</h1>
			<div class="mbland_recruitment_intro_desc">
				<p>
					Được thành lập vào năm 2015, Tasmania & Partners là tập đoàn đa ngành, đã
					và đang đầu tư một số dự án trong và ngoài nước thuộc lĩnh vực Tài chính
					- Bất động sản - Du lịch Dịch vụ dưới thương hiệu của một số Công ty con
					- Công ty liên kết như MBland Holdings, F&S Investment, Tonkin
					Properties, Golden Field,.. với các dự án trọng điểm tại Đà Nẵng, Hội
					An, Quảng Ngãi, Hà Nội, Quảng Ninh, Nha Trang, Tp Hồ Chí Minh,...
				</p>
				<p>
					Tasmania & Partners đã và đang hợp tác với nhiều đối tác tại thị trường
					Châu Âu và Châu Á để mở rộng đầu tư và phát triển tại Úc, Singapore,
					Hungary, Thái Lan, Hy Lạp,... dưới các thương hiệu Blooming Elite,
					Sentosa Holdings và Moni Galery,...
				</p>
			</div>
		</div>

		<div class="mbland_recruitment_intro_banner">
			<img
				class="mbland_recruitment_intro_bannerImage"
				src="/wp-content/uploads/2025/10/Banner-Tuyen-dung-1.png"
				alt="Banner tuyển dụng"
				title="Banner tuyển dụng"
				loading="eager"
				decoding="async"
			/>
		</div>
	</div>
</section>

<!-- ==========================================================================
     SECTION 2: HEADING (TITLE & TEXT), LIST TUYỂN DỤNG & BỘ LỌC
     ========================================================================== -->
<section class="mbland_recruitment_jobs">
	<div class="container">
		<header class="mbland_recruitment_jobs_header">
			<h2 class="mbland_recruitment_jobs_title">Cơ hội việc làm</h2>
			<p class="mbland_recruitment_jobs_desc">
				Cơ hội việc làm tại môi trường chuyên nghiệp trong và ngoài nước thuộc
				lĩnh vực Tài chính – Bất động sản – Du lịch Dịch vụ
			</p>
		</header>

		<!-- Form tìm kiếm -->
		<form method="get" class="mbland_recruitment_jobs_searchForm form-career" id="careerForm" action="<?php echo esc_url( $page_url ); ?>">
			<h3 class="mbland_recruitment_jobs_searchTitle">Tìm công việc</h3>
			<input type="text" name="keyword" value="<?php echo esc_attr( $keyword ); ?>" class="mbland_recruitment_jobs_searchInput" placeholder="Nhập từ khóa tìm kiếm" autocomplete="off">
			<button type="submit" class="mbland_recruitment_jobs_searchBtn" id="careerSearchBtn">Tìm kiếm</button>
		</form>

		<!-- Dropdown bộ lọc cho mobile -->
		<div class="mbland_recruitment_jobs_filterDropdown hn__filter-dropdown" id="filterDropdownBar"></div>

		<!-- Layout tuyển dụng: Bộ lọc (trái) + Danh sách Job (phải) -->
		<div class="mbland_recruitment_jobs_layout hn__career">
			<!-- Cột trái: Bộ lọc -->
			<aside class="mbland_recruitment_jobs_sidebar hn__career-left">
				<div class="mbland_recruitment_jobs_filter hn__filter">
					<div class="mbland_recruitment_jobs_filterHeader filter-header">
						<h3 class="mbland_recruitment_jobs_filterTitle title">Bộ lọc</h3>
						<button type="button" class="mbland_recruitment_jobs_filterReset reset-filter" id="resetFilter">Xóa bộ lọc</button>
					</div>

					<!-- Vị trí ứng tuyển -->
					<div class="mbland_recruitment_jobs_filterGroup filter-group" id="filter-vitri">
						<h4 class="mbland_recruitment_jobs_filterGroupTitle">Vị trí ứng tuyển</h4>
						<input type="text" class="mbland_recruitment_jobs_filterInput filter-text" id="vitriInput" placeholder="Nhập vị trí ứng tuyển...">
						<div class="mbland_recruitment_jobs_filterOptions filter-options">
							<label><input type="radio" form="careerForm" name="vi-tri-ung-tuyen" value="all" <?php checked( $vitri, 'all' ); ?>> Tất cả</label>
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
					<div class="mbland_recruitment_jobs_filterGroup filter-group" id="filter-noilamviec">
						<h4 class="mbland_recruitment_jobs_filterGroupTitle">Nơi làm việc</h4>
						<input type="text" class="mbland_recruitment_jobs_filterInput filter-text" id="noilamviecInput" placeholder="Nhập nơi làm việc...">
						<div class="mbland_recruitment_jobs_filterOptions filter-options">
							<label><input type="radio" form="careerForm" name="noi-lam-viec" value="all" <?php checked( $noilam, 'all' ); ?>> Tất cả</label>
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
					<div class="mbland_recruitment_jobs_filterGroup filter-group">
						<h4 class="mbland_recruitment_jobs_filterGroupTitle">Hình thức làm việc</h4>
						<div class="mbland_recruitment_jobs_filterOptions filter-options">
							<label><input type="radio" form="careerForm" name="hinh-thuc-lam-viec" value="all" <?php checked( $hinhthuc, 'all' ); ?>> Tất cả</label>
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
			<div class="mbland_recruitment_jobs_content hn__career-right">
				<div class="mbland_recruitment_jobs_list hn__job-list">
					<?php
					if ( $jobs_query->have_posts() ) :
						while ( $jobs_query->have_posts() ) : $jobs_query->the_post();
							get_template_part( 'template-parts/ui/jobCardItem' );
						endwhile;
					else :
					?>
						<p class="mbland_recruitment_jobs_noPosts">
							<?php echo function_exists( 'pll__' ) ? pll__( 'Không tìm thấy vị trí tuyển dụng phù hợp.' ) : 'Không tìm thấy vị trí tuyển dụng phù hợp.'; ?>
						</p>
					<?php
					endif;
					?>
				</div>

				<!-- Phân trang SSR -->
				<?php if ( $jobs_query->max_num_pages > 1 ) : ?>
				<div class="mbland_recruitment_jobs_pagination">
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

					$paginate_args = array(
						'base'      => trailingslashit( $page_url ) . '%_%',
						'format'    => 'page/%#%/',
						'current'   => $paged,
						'total'     => $jobs_query->max_num_pages,
						'prev_text' => function_exists( 'pll__' ) ? pll__( 'Trước' ) : 'Trước',
						'next_text' => function_exists( 'pll__' ) ? pll__( 'Sau' ) : 'Sau',
						'type'      => 'list',
					);
					if ( ! empty( $active_params ) ) {
						$paginate_args['add_args'] = $active_params;
					}

					echo paginate_links( $paginate_args );
					?>
				</div>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>

<!-- ==========================================================================
     SECTION 3: TIN TỨC LIÊN QUAN
     ========================================================================== -->
<section class="mbland_recruitment_news">
	<div class="container">
		<div class="mbland_recruitment_news_header">
			<h2 class="mbland_recruitment_news_heading">
				<?php echo function_exists( 'pll__' ) ? pll__( 'TIN TỨC LIÊN QUAN' ) : 'TIN TỨC LIÊN QUAN'; ?>
			</h2>
			<div class="mbland_recruitment_news_line"></div>
		</div>

		<div class="mbland_recruitment_news_grid">
			<?php
			$related_news_args = array(
				'post_type'      => 'post',
				'posts_per_page' => 2,
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'DESC',
			);

			$related_news_query = new WP_Query( $related_news_args );

			if ( $related_news_query->have_posts() ) :
				while ( $related_news_query->have_posts() ) : $related_news_query->the_post();
					get_template_part( 'template-parts/ui/newCardItem', null, array(
						'post_id' => get_the_ID(),
						'class'   => 'mbland_recruitment_news_card',
						'badge'   => function_exists( 'pll__' ) ? pll__( 'TIN NỔI BẬT' ) : 'TIN NỔI BẬT',
					) );
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
</section>

<?php add_action( 'wp_footer', function () { ?>
<script>
/* Bộ lọc tuyển dụng: dùng form GET + tải lại trang (page reload), không dùng AJAX */
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('careerForm');
  const filterWrap = document.querySelector('.hn__filter');
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
  document.querySelectorAll('.hn__filter input[type="radio"]').forEach(function (radio) {
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
    ['vitriInput', '#filter-vitri .filter-options'],
    ['noilamviecInput', '#filter-noilamviec .filter-options']
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
    const groups = filterWrap.querySelectorAll('.filter-group');
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
