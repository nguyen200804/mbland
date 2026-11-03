<?php
/*
Template Name: Career
*/
get_header();
?>
<section class="hn-tasmania-career">
  <div class="container">
	  <?php echo do_shortcode('[hn_breadcrumb]'); ?>
	  
	  <div class="banner-heading">
      <p class="title">Tasmania & partners</p>
      <p>
        Founded in 2015, Tasmania & Partners is a multi-industry corporation
        that has invested in several domestic and international projects
        in the fields of Finance – Real Estate – Tourism and Services,
        under subsidiaries and affiliates such as MBland Holdings, F&S Investment,
        Tonkin Properties, and Golden Field. The group has developed key
        projects across Da Nang, Hoi An, Quang Ngai, Hanoi, Quang Ninh,
        Nha Trang, and Ho Chi Minh City.
      </p>
      <p>
        Tasmania & Partners is also collaborating with multiple partners
        in Europe and Asia to expand investment and development in
        Australia, Singapore, Hungary, Thailand, and Greece,
        under the brands Blooming Elite, Sentosa Holdings, and Moni Gallery.
      </p>

      <div class="banner-text">
        <img
			 src="/wp-content/uploads/2025/10/Banner-Tuyen-dung-1.png"
			 alt="Career banner"
			 title="Career banner"
			 />
      </div>

      <div class="heading">
        <h1>Career Opportunities</h1>
        <p class="hn__career-desc">
          Explore exciting job opportunities in a professional environment across
          Finance – Real Estate – Tourism and Services sectors.
        </p>
      </div>
    </div>
	  
  	<form method="get" style="margin-bottom:20px;" class="form-career" id="careerForm" onsubmit="return false;">
  		<h2>Search jobs</h2>
  		<input type="text" name="s" placeholder="Enter keyword..." autocomplete="off">
  		<button type="button" id="careerSearchBtn">Search</button>
	</form>
<?php add_action('wp_footer', function () { ?>
	<script>
  	document.getElementById('careerForm').addEventListener('keydown', function(e) {
  	  if (e.key === 'Enter' || e.keyCode === 13) {
  	    e.preventDefault();
  	  }
  	});
	</script>
<?php }, 99); ?>

	<div class="hn__filter-dropdown" id="filterDropdownBar"></div>

    <div class="hn__career">
	<div class="hn__career-left">
    <div class="hn__filter">
      <div class="filter-header">
        <h3 class="title">Filters</h3>
        <button class="reset-filter" id="resetFilter">Reset</button>
      </div>

  <!-- Job position -->
  <div class="filter-group" id="filter-vitri">
    <h3>Job Position</h3>

    <input type="text" class="filter-text" id="vitriInput" placeholder="Enter job position...">

    <div class="filter-options">
      <label><input type="radio" name="vitri" value="all" checked> All</label>
      <?php
      $terms = get_terms(['taxonomy' => 'vi-tri-ung-tuyen', 'hide_empty' => false]);
      foreach ($terms as $term): ?>
        <label><input type="radio" name="vitri" value="<?php echo esc_attr($term->slug); ?>"> <?php echo esc_html($term->name); ?></label>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Workplace -->
  <div class="filter-group" id="filter-noilamviec">
    <h3>Workplace</h3>

    <input type="text" class="filter-text" id="noilamviecInput" placeholder="Enter workplace...">

    <div class="filter-options">
      <label><input type="radio" name="noilamviec" value="all" checked> All</label>
      <?php
      $terms = get_terms(['taxonomy' => 'noi-lam-viec', 'hide_empty' => false]);
      foreach ($terms as $term): ?>
        <label><input type="radio" name="noilamviec" value="<?php echo esc_attr($term->slug); ?>"> <?php echo esc_html($term->name); ?></label>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Work type -->
  <div class="filter-group">
    <h3>Employment Type</h3>
    <label><input type="radio" name="hinhthuc" value="all" checked> All</label>
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
          <!-- Job list will load here -->
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
      <h3 class="title">Filter</h3>
      <button class="reset-filter" id="resetFilterMobile">Reset filter</button>
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
      optAll.textContent = 'All';
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
