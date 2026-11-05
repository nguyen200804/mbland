<?php
/*
Template Name: Tuyển Dụng
*/
get_header();
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
		<form method="get" class="mbland_recruitment_jobs_searchForm form-career" id="careerForm" onsubmit="return false;">
			<h3 class="mbland_recruitment_jobs_searchTitle">Tìm công việc</h3>
			<input type="text" name="s" class="mbland_recruitment_jobs_searchInput" placeholder="Nhập từ khóa tìm kiếm" autocomplete="off">
			<button type="button" class="mbland_recruitment_jobs_searchBtn" id="careerSearchBtn">Tìm kiếm</button>
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
							<label><input type="radio" name="vitri" value="all" checked> Tất cả</label>
							<?php
							$terms = get_terms( array( 'taxonomy' => 'vi-tri-ung-tuyen', 'hide_empty' => false ) );
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
								foreach ( $terms as $term ) :
							?>
								<label><input type="radio" name="vitri" value="<?php echo esc_attr( $term->slug ); ?>"> <?php echo esc_html( $term->name ); ?></label>
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
							<label><input type="radio" name="noilamviec" value="all" checked> Tất cả</label>
							<?php
							$terms = get_terms( array( 'taxonomy' => 'noi-lam-viec', 'hide_empty' => false ) );
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
								foreach ( $terms as $term ) :
							?>
								<label><input type="radio" name="noilamviec" value="<?php echo esc_attr( $term->slug ); ?>"> <?php echo esc_html( $term->name ); ?></label>
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
							<label><input type="radio" name="hinhthuc" value="all" checked> Tất cả</label>
							<?php
							$terms = get_terms( array( 'taxonomy' => 'hinh-thuc-lam-viec', 'hide_empty' => false ) );
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
								foreach ( $terms as $term ) :
							?>
								<label><input type="radio" name="hinhthuc" value="<?php echo esc_attr( $term->slug ); ?>"> <?php echo esc_html( $term->name ); ?></label>
							<?php
								endforeach;
							endif;
							?>
						</div>
					</div>
				</div>
			</aside>

			<!-- Cột phải: Danh sách job -->
			<div class="mbland_recruitment_jobs_content hn__career-right">
				<div class="mbland_recruitment_jobs_list hn__job-list">
					<!-- Danh sách job load động qua AJAX tại đây -->
				</div>
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
// Chặn Enter trong toàn bộ form tìm kiếm
document.getElementById('careerForm')?.addEventListener('keydown', function(e) {
  if (e.key === 'Enter' || e.keyCode === 13) {
    e.preventDefault();
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('.form-career');
  const inputs = document.querySelectorAll('.form-career input, .hn__filter input, .hn__filter .filter-text');
  const jobList = document.querySelector('.hn__job-list');

  // === Reset filter function ===
  function resetFilters() {
    const sInput = document.querySelector('.form-career input[name="s"]');
    if (sInput) sInput.value = '';

    const vitriInput = document.getElementById('vitriInput');
    const noilamviecInput = document.getElementById('noilamviecInput');
    if (vitriInput) vitriInput.value = '';
    if (noilamviecInput) noilamviecInput.value = '';

    ['vitri', 'noilamviec', 'hinhthuc'].forEach(name => {
      const allRadio = document.querySelector(`input[name="${name}"][value="all"]`);
      if (allRadio) {
        allRadio.checked = true;
        allRadio.dispatchEvent(new Event('change', { bubbles: true }));
      }
    });

    document.querySelectorAll('#filterDropdownBar select').forEach(select => {
      select.value = 'all';
      const name = select.name;
      const targetRadio = document.querySelector(`input[name="${name}"][value="all"]`);
      if (targetRadio) {
        targetRadio.checked = true;
        targetRadio.dispatchEvent(new Event('change', { bubbles: true }));
      }
    });

    document.querySelectorAll('.filter-options').forEach(optionsEl => {
      optionsEl.querySelectorAll('label').forEach(label => {
        label.style.display = '';
      });
    });

    fetchJobs();
  }

  document.getElementById('resetFilter')?.addEventListener('click', resetFilters);
  document.getElementById('careerSearchBtn')?.addEventListener('click', () => fetchJobs(1));

  // === Lọc AJAX ===
  async function fetchJobs(page = 1) {
    if (!form || !jobList) return;
    const data = new FormData(form);
    document.querySelectorAll('.hn__filter input[type="radio"]:checked').forEach(i => data.append(i.name, i.value));

    const vitriText = document.getElementById('vitriInput')?.value.trim() || '';
    const noilamText = document.getElementById('noilamviecInput')?.value.trim() || '';

    const res = await fetch('<?php echo admin_url( 'admin-ajax.php' ); ?>', {
      method: 'POST',
      body: new URLSearchParams({
        action: 'filter_jobs',
        s: data.get('s') || '',
        vitri: data.get('vitri') || 'all',
        noilamviec: data.get('noilamviec') || 'all',
        hinhthuc: data.get('hinhthuc') || 'all',
        vitri_text: vitriText,
        noilam_text: noilamText,
        page: page
      })
    });

    const html = await res.text();
    jobList.innerHTML = html;

    // Phân trang AJAX
    document.querySelectorAll('.pagination-ajax a.page-link').forEach(btn => {
      btn.addEventListener('click', e => {
        e.preventDefault();
        fetchJobs(btn.dataset.page);
        window.scrollTo({ top: document.querySelector('.mbland_recruitment_jobs')?.offsetTop || 300, behavior: 'smooth' });
      });
    });
  }

  // === Lọc radio options dựa trên input text ===
  function filterRadioOptions(inputEl, optionsEl, radioName) {
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
          radio.dispatchEvent(new Event('change', { bubbles: true }));
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
      filterRadioOptions(vitriInput, filterVitri, 'vitri');
      clearTimeout(window._delay);
      window._delay = setTimeout(fetchJobs, 400);
    });
  }

  if (noilamviecInput && filterNoilamviec) {
    noilamviecInput.addEventListener('input', () => {
      filterRadioOptions(noilamviecInput, filterNoilamviec, 'noilamviec');
      clearTimeout(window._delay);
      window._delay = setTimeout(fetchJobs, 400);
    });
  }

  // ======= Dropdown build (mobile) =======
  (function buildFilterDropdowns(){
    const filterWrap = document.querySelector('.hn__filter');
    const bar = document.getElementById('filterDropdownBar');
    if(!filterWrap || !bar) return;
    const groups = filterWrap.querySelectorAll('.filter-group');
    if(groups.length < 3) return;

    const headerMobile = document.createElement('div');
    headerMobile.className = 'filter-header';
    headerMobile.innerHTML = `
      <h3 class="title">Bộ lọc</h3>
      <button class="reset-filter" id="resetFilterMobile">Xóa bộ lọc</button>
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
        if(!r || r.value === 'all') return;
        if(seen.has(r.value)) return;
        seen.add(r.value);
        const op = document.createElement('option');
        op.value = r.value;
        op.textContent = lb.textContent.trim();
        if(r.checked) op.selected = true;
        select.appendChild(op);
      });
      const checked = groupEl.querySelector('input[type="radio"]:checked');
      if(checked && checked.value === 'all') select.value = 'all';
      select.addEventListener('change', () => {
        const allRadios = filterWrap.querySelectorAll(`input[name="${name}"]`);
        allRadios.forEach(r => r.checked = false);
        const target = filterWrap.querySelector(`input[name="${name}"][value="${CSS.escape(select.value)}"]`)
                       || filterWrap.querySelector(`input[name="${name}"][value="all"]`);
        if(target){
          target.checked = true;
          target.dispatchEvent(new Event('change', { bubbles:true }));
        }
      });
      wrap.appendChild(select);
      return wrap;
    };

    const getTitle = (idx) => groups[idx].querySelector('h4, h3')?.textContent?.trim() || '';
    bar.appendChild(createSelectFromGroup(groups[0], getTitle(0)));
    bar.appendChild(createSelectFromGroup(groups[1], getTitle(1)));
    bar.appendChild(createSelectFromGroup(groups[2], getTitle(2)));

    filterWrap.querySelectorAll('input[type="radio"]').forEach(radio => {
      radio.addEventListener('change', () => {
        const select = bar.querySelector(`select[name="${radio.name}"]`);
        if(select){ select.value = radio.value; }
      });
    });

    document.getElementById('resetFilterMobile')?.addEventListener('click', resetFilters);
  })();

  // === Load ban đầu ===
  fetchJobs();

  // === Filter change ===
  inputs.forEach(input => {
    input.addEventListener('input', () => {
      clearTimeout(window._delay);
      window._delay = setTimeout(fetchJobs, 400);
    });
    input.addEventListener('change', fetchJobs);
  });
});
</script>
<?php }, 99 ); ?>

<?php get_footer(); ?>
