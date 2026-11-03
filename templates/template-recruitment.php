<?php
/*
Template Name: Tuyển Dụng
*/
get_header();
?>
<section class="hn-tasmania-career">
  <div class="container">
	  <?php echo do_shortcode('[hn_breadcrumb]'); ?>
	  <div class="banner-heading">
      <p class="title">Tasmania & partners</p>
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
      <div class="banner-text">
        <img
			 src="/wp-content/uploads/2025/10/Banner-Tuyen-dung-1.png"
			 alt="Banner tuyển dụng"
			 title="Banner tuyển dụng"
			 />
      </div>
      <div class="heading">
        <h1>Cơ hội việc làm</h1>
        <p class="hn__career-desc">
          Cơ hội việc làm tại môi trường chuyên nghiệp trong và ngoài nước thuộc
          lĩnh vực Tài chính – Bất động sản – Du lịch Dịch vụ
        </p>
      </div>
    </div>
	  
	  
  	<form method="get" style="margin-bottom:20px;" class="form-career" id="careerForm" onsubmit="return false;">
  		<h2>Tìm công việc </h2>
  		<input type="text" name="s" placeholder="Nhập từ khóa tìm kiếm" autocomplete="off">
  		<button type="button" id="careerSearchBtn">Tìm kiếm</button>
	</form>
<?php add_action('wp_footer', function () { ?>
	<script>
  	// Chặn Enter trong toàn bộ form
  	document.getElementById('careerForm').addEventListener('keydown', function(e) {
  	  if (e.key === 'Enter' || e.keyCode === 13) {
  	    e.preventDefault(); // không submit khi Enter
  	  }
  	});
	</script>
<?php }, 99); ?>
	<!-- Thêm một container ngay dưới form (trong HTML) -->
	<div class="hn__filter-dropdown" id="filterDropdownBar"></div>

    <div class="hn__career">
	<div class="hn__career-left">
    <div class="hn__filter">
      <div class="filter-header">
        <h3 class="title">Bộ lọc</h3>
        <button class="reset-filter" id="resetFilter">Xóa bộ lọc</button>
      </div>

  <!-- Vị trí ứng tuyển -->
  <div class="filter-group" id="filter-vitri">
    <h3>Vị trí ứng tuyển</h3>

    <!-- Ô text -->
    <input type="text" class="filter-text" id="vitriInput" placeholder="Nhập vị trí ứng tuyển...">

    <div class="filter-options">
      <label><input type="radio" name="vitri" value="all" checked> Tất cả</label>
      <?php
      $terms = get_terms(['taxonomy' => 'vi-tri-ung-tuyen', 'hide_empty' => false]);
      foreach ($terms as $term): ?>
        <label><input type="radio" name="vitri" value="<?php echo esc_attr($term->slug); ?>"> <?php echo esc_html($term->name); ?></label>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Nơi làm việc -->
  <div class="filter-group" id="filter-noilamviec">
    <h3>Nơi làm việc</h3>

    <!-- Ô text -->
    <input type="text" class="filter-text" id="noilamviecInput" placeholder="Nhập nơi làm việc...">

    <div class="filter-options">
      <label><input type="radio" name="noilamviec" value="all" checked> Tất cả</label>
      <?php
      $terms = get_terms(['taxonomy' => 'noi-lam-viec', 'hide_empty' => false]);
      foreach ($terms as $term): ?>
        <label><input type="radio" name="noilamviec" value="<?php echo esc_attr($term->slug); ?>"> <?php echo esc_html($term->name); ?></label>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Hình thức -->
  <div class="filter-group">
    <h3>Hình thức làm việc</h3>
    <label><input type="radio" name="hinhthuc" value="all" checked> Tất cả</label>
    <?php
    $terms = get_terms(['taxonomy' => 'hinh-thuc-lam-viec', 'hide_empty' => false]);
    foreach ($terms as $term): ?>
      <label><input type="radio" name="hinhthuc" value="<?php echo esc_attr($term->slug); ?>"> <?php echo esc_html($term->name); ?></label>
    <?php endforeach; ?>
  </div>

</div>


      </div>

  <div class="hn__career-right">
        <div class="hn__job-list">
          <!-- Danh sách job load tại đây -->
        </div>
      </div>
    </div>
  </div>
</section>
<?php add_action('wp_footer', function () { ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('.form-career');
  const inputs = document.querySelectorAll('.form-career input, .hn__filter input, .hn__filter .filter-text');
  const jobList = document.querySelector('.hn__job-list');

  // === Reset filter function ===
  function resetFilters() {
    // Reset search input
    document.querySelector('.form-career input[name="s"]').value = '';
    
    // Reset text inputs
    const vitriInput = document.getElementById('vitriInput');
    const noilamviecInput = document.getElementById('noilamviecInput');
    if (vitriInput) vitriInput.value = '';
    if (noilamviecInput) noilamviecInput.value = '';
    
    // Reset radios to 'all'
    ['vitri', 'noilamviec', 'hinhthuc'].forEach(name => {
      const allRadio = document.querySelector(`input[name="${name}"][value="all"]`);
      if (allRadio) {
        allRadio.checked = true;
        allRadio.dispatchEvent(new Event('change', { bubbles: true }));
      }
    });
    
    // Reset mobile selects to 'all'
    document.querySelectorAll('#filterDropdownBar select').forEach(select => {
      select.value = 'all';
      const name = select.name;
      const targetRadio = document.querySelector(`input[name="${name}"][value="all"]`);
      if (targetRadio) {
        targetRadio.checked = true;
        targetRadio.dispatchEvent(new Event('change', { bubbles: true }));
      }
    });
    
    // Show all options
    document.querySelectorAll('.filter-options').forEach(optionsEl => {
      optionsEl.querySelectorAll('label').forEach(label => {
        label.style.display = '';
      });
    });
    
    fetchJobs();
  }

  // === Reset filter buttons ===
  document.getElementById('resetFilter').addEventListener('click', resetFilters);

  // === Lọc AJAX ===
  async function fetchJobs(page = 1) {
    const data = new FormData(form);
    document.querySelectorAll('.hn__filter input[type="radio"]:checked').forEach(i => data.append(i.name, i.value));

    // Lấy giá trị text riêng
    const vitriText = document.getElementById('vitriInput')?.value.trim() || '';
    const noilamText = document.getElementById('noilamviecInput')?.value.trim() || '';

    const res = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
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

    // Pagination
    document.querySelectorAll('.pagination-ajax a.page-link').forEach(btn => {
      btn.addEventListener('click', e => {
        e.preventDefault();
        fetchJobs(btn.dataset.page);
        window.scrollTo({ top: 300, behavior: 'smooth' });
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
        if (radio && radio.checked) {
          // Giữ checked nếu visible
        }
        visibleCount++;
      } else {
        label.style.display = 'none';
        if (radio && radio.checked) {
          radio.checked = false; // Uncheck nếu không visible
          // Trigger change để update select nếu có
          radio.dispatchEvent(new Event('change', { bubbles: true }));
        }
      }
    });

    // Nếu không có match nào (ngoại trừ 'all'), có thể show 'all' hoặc handle
    if (visibleCount === 0 && val !== '') {
      // Tùy chọn: show 'all' label nếu cần
      const allLabel = optionsEl.querySelector('label input[value="all"]');
      if (allLabel) allLabel.closest('label').style.display = '';
    }

    // Update checked to 'all' nếu không có checked visible
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

    // Add mobile header with reset
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

    const getTitle = (idx) => groups[idx].querySelector('h3')?.textContent?.trim() || '';
    bar.appendChild(createSelectFromGroup(groups[0], getTitle(0)));
    bar.appendChild(createSelectFromGroup(groups[1], getTitle(1)));
    bar.appendChild(createSelectFromGroup(groups[2], getTitle(2)));

    filterWrap.querySelectorAll('input[type="radio"]').forEach(radio => {
      radio.addEventListener('change', () => {
        const select = bar.querySelector(`select[name="${radio.name}"]`);
        if(select){ select.value = radio.value; }
      });
    });

    // Attach reset to mobile button
    document.getElementById('resetFilterMobile').addEventListener('click', resetFilters);
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
<?php }, 99); ?>


<?php get_footer(); ?>