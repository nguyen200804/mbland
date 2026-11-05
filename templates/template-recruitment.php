<?php
/*
Template Name: Tuyển Dụng
*/
get_header();

// ==========================================================================
// SSR: NHẬN THAM SỐ BỘ LỌC TỪ URL VÀ TRUY VẤN DỮ LIỆU
// ==========================================================================
$keyword  = sanitize_text_field( $_GET['keyword'] ?? $_GET['s'] ?? '' );
$vitri    = sanitize_text_field( $_GET['vitri'] ?? 'all' );
$noilam   = sanitize_text_field( $_GET['noilamviec'] ?? 'all' );
$hinhthuc = sanitize_text_field( $_GET['hinhthuc'] ?? 'all' );
$paged    = ( get_query_var( 'paged' ) ) ? intval( get_query_var( 'paged' ) ) : ( ( get_query_var( 'page' ) ) ? intval( get_query_var( 'page' ) ) : 1 );

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
		<form method="get" class="mbland_recruitment_jobs_searchForm form-career" id="careerForm" action="<?php echo esc_url( get_permalink() ); ?>">
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
							<label><input type="radio" name="vitri" value="all" <?php checked( $vitri, 'all' ); ?>> Tất cả</label>
							<?php
							$terms = get_terms( array( 'taxonomy' => 'vi-tri-ung-tuyen', 'hide_empty' => false ) );
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
								foreach ( $terms as $term ) :
							?>
								<label><input type="radio" name="vitri" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $vitri, $term->slug ); ?>> <?php echo esc_html( $term->name ); ?></label>
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
							<label><input type="radio" name="noilamviec" value="all" <?php checked( $noilam, 'all' ); ?>> Tất cả</label>
							<?php
							$terms = get_terms( array( 'taxonomy' => 'noi-lam-viec', 'hide_empty' => false ) );
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
								foreach ( $terms as $term ) :
							?>
								<label><input type="radio" name="noilamviec" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $noilam, $term->slug ); ?>> <?php echo esc_html( $term->name ); ?></label>
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
							<label><input type="radio" name="hinhthuc" value="all" <?php checked( $hinhthuc, 'all' ); ?>> Tất cả</label>
							<?php
							$terms = get_terms( array( 'taxonomy' => 'hinh-thuc-lam-viec', 'hide_empty' => false ) );
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
								foreach ( $terms as $term ) :
							?>
								<label><input type="radio" name="hinhthuc" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $hinhthuc, $term->slug ); ?>> <?php echo esc_html( $term->name ); ?></label>
							<?php
								endforeach;
							endif;
							?>
						</div>
					</div>
				</div>
			</aside>

			<!-- Cột phải: Danh sách job & Phân trang (SSR) -->
			<div class="mbland_recruitment_jobs_content hn__career-right" id="jobsContentWrapper">
				<div class="mbland_recruitment_jobs_list hn__job-list" id="jobsList">
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
				<div class="mbland_recruitment_jobs_pagination" id="jobsPagination">
					<?php
					$paginate_args = array(
						'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
						'format'    => '?paged=%#%',
						'current'   => max( 1, $paged ),
						'total'     => $jobs_query->max_num_pages,
						'prev_text' => function_exists( 'pll__' ) ? pll__( 'Trước' ) : 'Trước',
						'next_text' => function_exists( 'pll__' ) ? pll__( 'Sau' ) : 'Sau',
						'type'      => 'list',
					);

					$active_params = array();
					if ( ! empty( $keyword ) ) {
						$active_params['keyword'] = $keyword;
					}
					if ( ! empty( $vitri ) && 'all' !== $vitri ) {
						$active_params['vitri'] = $vitri;
					}
					if ( ! empty( $noilam ) && 'all' !== $noilam ) {
						$active_params['noilamviec'] = $noilam;
					}
					if ( ! empty( $hinhthuc ) && 'all' !== $hinhthuc ) {
						$active_params['hinhthuc'] = $hinhthuc;
					}
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
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('careerForm');
  const filterWrap = document.querySelector('.hn__filter');
  const container = document.getElementById('jobsContentWrapper');
  let filterDelayTimer = null;

  // === TẠO TARGET URL DỰA VÀO FORM VÀ BỘ LỌC HIỆN TẠI ===
  function buildTargetUrl(page = 1) {
    const url = new URL(window.location.origin + window.location.pathname);
    const params = url.searchParams;

    const keyword = form?.querySelector('input[name="keyword"]')?.value.trim();
    if (keyword) {
      params.set('keyword', keyword);
    }

    ['vitri', 'noilamviec', 'hinhthuc'].forEach(name => {
      const checked = document.querySelector(`input[name="${name}"]:checked`);
      if (checked && checked.value && checked.value !== 'all') {
        params.set(name, checked.value);
      }
    });

    if (page > 1) {
      params.set('paged', page);
    }

    return url.toString();
  }

  // === CẬP NHẬT GIAO DIỆN BẰNG FETCH SSR (HOÀN TOÀN KHÔNG DÙNG AJAX ENDPOINT) ===
  function navigateJobs(targetUrl, pushState = true) {
    if (!container) return;

    container.classList.add('is-loading');

    fetch(targetUrl)
      .then(res => {
        if (!res.ok) throw new Error('HTTP error ' + res.status);
        return res.text();
      })
      .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newContent = doc.getElementById('jobsContentWrapper');

        if (newContent) {
          container.innerHTML = newContent.innerHTML;
          if (pushState) {
            window.history.pushState({ url: targetUrl }, '', targetUrl);
          }
          bindPaginationEvents();
        }
        container.classList.remove('is-loading');
      })
      .catch(err => {
        console.error('Fetch error:', err);
        container.classList.remove('is-loading');
        // Fallback tải trang tự nhiên nếu có lỗi
        window.location.href = targetUrl;
      });
  }

  // === XỬ LÝ SỰ KIỆN CLICK PHÂN TRANG ===
  function bindPaginationEvents() {
    const paginationLinks = container?.querySelectorAll('#jobsPagination a.page-numbers');
    if (!paginationLinks) return;

    paginationLinks.forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        const targetUrl = this.getAttribute('href');
        if (targetUrl) {
          navigateJobs(targetUrl, true);
          const scrollTarget = document.querySelector('.mbland_recruitment_jobs');
          if (scrollTarget) {
            window.scrollTo({
              top: scrollTarget.offsetTop - 50,
              behavior: 'smooth'
            });
          }
        }
      });
    });
  }

  // Khởi tạo sự kiện phân trang ban đầu
  bindPaginationEvents();

  // === BROWSER BACK / FORWARD (POPSTATE) ===
  window.addEventListener('popstate', function () {
    navigateJobs(window.location.href, false);
    syncControlsFromUrl();
  });

  // Đồng bộ lại controls khi back/forward
  function syncControlsFromUrl() {
    const currentParams = new URLSearchParams(window.location.search);
    const keywordInput = form?.querySelector('input[name="keyword"]');
    if (keywordInput) {
      keywordInput.value = currentParams.get('keyword') || currentParams.get('s') || '';
    }

    ['vitri', 'noilamviec', 'hinhthuc'].forEach(name => {
      const val = currentParams.get(name) || 'all';
      const targetRadio = document.querySelector(`input[name="${name}"][value="${CSS.escape(val)}"]`)
        || document.querySelector(`input[name="${name}"][value="all"]`);
      if (targetRadio) {
        targetRadio.checked = true;
      }

      const select = document.querySelector(`#filterDropdownBar select[name="${name}"]`);
      if (select) {
        select.value = val;
      }
    });
  }

  // === SUBMIT TÌM KIẾM ===
  form?.addEventListener('submit', function (e) {
    e.preventDefault();
    navigateJobs(buildTargetUrl(1), true);
  });

  document.getElementById('careerSearchBtn')?.addEventListener('click', function (e) {
    e.preventDefault();
    navigateJobs(buildTargetUrl(1), true);
  });

  // === THAY ĐỔI RADIO FILTER ===
  const radioInputs = document.querySelectorAll('.hn__filter input[type="radio"]');
  radioInputs.forEach(radio => {
    radio.addEventListener('change', function () {
      clearTimeout(filterDelayTimer);
      filterDelayTimer = setTimeout(() => {
        navigateJobs(buildTargetUrl(1), true);
      }, 100);
    });
  });

  // === TÌM KIẾM TRONG DANH SÁCH RADIO (FILTER TEXT) ===
  function filterRadioList(inputEl, optionsEl, radioName) {
    const val = inputEl.value.toLowerCase().trim();
    const labels = optionsEl.querySelectorAll('label');
    let visibleCount = 0;

    labels.forEach(label => {
      const text = label.textContent.toLowerCase();
      const radio = label.querySelector('input[type="radio"]');
      if (val === '' || text.includes(val)) {
        label.style.display = '';
        visibleCount++;
      } else {
        label.style.display = 'none';
        if (radio && radio.checked) {
          radio.checked = false;
        }
      }
    });

    if (visibleCount === 0 && val !== '') {
      const allLabel = optionsEl.querySelector('label input[value="all"]');
      if (allLabel) allLabel.closest('label').style.display = '';
    }

    const checkedRadio = optionsEl.querySelector('input[type="radio"]:checked');
    if (!checkedRadio) {
      const allRadio = optionsEl.querySelector(`input[name="${radioName}"][value="all"]`);
      if (allRadio) {
        allRadio.checked = true;
        allRadio.dispatchEvent(new Event('change', { bubbles: true }));
      }
    }
  }

  const vitriInput = document.getElementById('vitriInput');
  const noilamviecInput = document.getElementById('noilamviecInput');
  const filterVitri = document.querySelector('#filter-vitri .filter-options');
  const filterNoilamviec = document.querySelector('#filter-noilamviec .filter-options');

  if (vitriInput && filterVitri) {
    vitriInput.addEventListener('input', () => {
      filterRadioList(vitriInput, filterVitri, 'vitri');
    });
  }

  if (noilamviecInput && filterNoilamviec) {
    noilamviecInput.addEventListener('input', () => {
      filterRadioList(noilamviecInput, filterNoilamviec, 'noilamviec');
    });
  }

  // === RESET BỘ LỌC ===
  function resetAllFilters() {
    const keywordInput = form?.querySelector('input[name="keyword"]');
    if (keywordInput) keywordInput.value = '';

    if (vitriInput) vitriInput.value = '';
    if (noilamviecInput) noilamviecInput.value = '';

    ['vitri', 'noilamviec', 'hinhthuc'].forEach(name => {
      const allRadio = document.querySelector(`input[name="${name}"][value="all"]`);
      if (allRadio) {
        allRadio.checked = true;
      }
    });

    document.querySelectorAll('#filterDropdownBar select').forEach(select => {
      select.value = 'all';
    });

    document.querySelectorAll('.filter-options label').forEach(label => {
      label.style.display = '';
    });

    const cleanUrl = window.location.origin + window.location.pathname;
    navigateJobs(cleanUrl, true);
  }

  document.getElementById('resetFilter')?.addEventListener('click', resetAllFilters);

  // === DROPDOWN CHO MOBILE ===
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

    const createSelectFromGroup = (groupEl, titleText) => {
      const name = groupEl.querySelector('input[type="radio"]')?.name || '';
      const labels = groupEl.querySelectorAll('label');
      const wrap = document.createElement('div');
      wrap.className = 'select-wrap';
      const labelEl = document.createElement('label');
      labelEl.textContent = titleText || '';
      wrap.appendChild(labelEl);

      const select = document.createElement('select');
      select.name = name;
      const optAll = document.createElement('option');
      optAll.value = 'all';
      optAll.textContent = 'Tất cả';
      select.appendChild(optAll);

      const seen = new Set();
      labels.forEach(lb => {
        const r = lb.querySelector('input[type="radio"]');
        if (!r || r.value === 'all') return;
        if (seen.has(r.value)) return;
        seen.add(r.value);
        const op = document.createElement('option');
        op.value = r.value;
        op.textContent = lb.textContent.trim();
        if (r.checked) op.selected = true;
        select.appendChild(op);
      });

      const checked = groupEl.querySelector('input[type="radio"]:checked');
      if (checked) select.value = checked.value;

      select.addEventListener('change', () => {
        const allRadios = filterWrap.querySelectorAll(`input[name="${name}"]`);
        allRadios.forEach(r => (r.checked = false));
        const target =
          filterWrap.querySelector(`input[name="${name}"][value="${CSS.escape(select.value)}"]`) ||
          filterWrap.querySelector(`input[name="${name}"][value="all"]`);
        if (target) {
          target.checked = true;
          target.dispatchEvent(new Event('change', { bubbles: true }));
        }
      });
      wrap.appendChild(select);
      return wrap;
    };

    const getTitle = idx => groups[idx].querySelector('h4, h3')?.textContent?.trim() || '';
    bar.appendChild(createSelectFromGroup(groups[0], getTitle(0)));
    bar.appendChild(createSelectFromGroup(groups[1], getTitle(1)));
    bar.appendChild(createSelectFromGroup(groups[2], getTitle(2)));

    filterWrap.querySelectorAll('input[type="radio"]').forEach(radio => {
      radio.addEventListener('change', () => {
        const select = bar.querySelector(`select[name="${radio.name}"]`);
        if (select) {
          select.value = radio.value;
        }
      });
    });

    document.getElementById('resetFilterMobile')?.addEventListener('click', resetAllFilters);
  })();
});
</script>
<?php }, 99 ); ?>

<?php get_footer(); ?>
