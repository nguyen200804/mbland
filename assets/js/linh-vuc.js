/* Trang taxonomy linh-vuc (taxonomy-linh-vuc.php) */
document.addEventListener('DOMContentLoaded', function () {
	// Script của section Procedure đã được tách và đồng bộ vào assets/js/sections/procedure.js

	const filterLinks = document.querySelectorAll('.mbland_linhvuc_listProject_filterLink');
	const content = document.querySelector('.mbland_linhvuc_listProject_content');
	if (!content) return;

	const items = Array.from(content.querySelectorAll('.mbland_linhvuc_listProject_item'));
	const loadMoreBtn = content.querySelector('.mbland_linhvuc_listProject_loadMore');
	const emptyMsg = content.querySelector('.mbland_linhvuc_projects_empty');

	const PER_PAGE = 3; // Số dự án hiển thị mỗi lần
	let currentFilter = 'all';
	let visibleCount = PER_PAGE;

	// Cập nhật zigzag layout (ảnh trái / ảnh phải) cho các item đang hiển thị
	function updateZebraOrder(visibleItems) {
		visibleItems.forEach(function (item, index) {
			if (index % 2 === 1) {
				item.classList.add('is-even');
				item.classList.remove('is-odd');
			} else {
				item.classList.add('is-odd');
				item.classList.remove('is-even');
			}
		});
	}

	function applyFilter(filter, resetCount) {
		currentFilter = filter;
		if (resetCount) {
			visibleCount = PER_PAGE;
		}

		// Lọc các item thỏa điều kiện term
		const matchedItems = items.filter(function (item) {
			if (filter === 'all') return true;
			const termsAttr = item.getAttribute('data-terms') || '';
			const terms = termsAttr.split(/\s+/).filter(Boolean);
			return terms.includes(filter);
		});

		// Ẩn tất cả items trước
		items.forEach(function (item) {
			item.style.display = 'none';
			item.classList.add('is-hidden');
		});

		// Hiển thị các item thỏa điều kiện trong giới hạn visibleCount
		const toShow = matchedItems.slice(0, visibleCount);
		toShow.forEach(function (item) {
			item.style.display = 'flex';
			item.classList.remove('is-hidden');
		});

		// Cập nhật zigzag layout
		updateZebraOrder(toShow);

		// Nút Xem thêm
		if (loadMoreBtn) {
			if (matchedItems.length > visibleCount) {
				loadMoreBtn.style.display = 'flex';
			} else {
				loadMoreBtn.style.display = 'none';
			}
		}

		// Thông báo rỗng
		if (emptyMsg) {
			if (matchedItems.length === 0) {
				emptyMsg.style.display = 'block';
			} else {
				emptyMsg.style.display = 'none';
			}
		}
	}

	// Bắt sự kiện click tab filter
	if (filterLinks.length > 0) {
		filterLinks.forEach(function (link) {
			link.addEventListener('click', function (e) {
				e.preventDefault();
				const targetFilter = this.getAttribute('data-filter') || 'all';

				// Toggle active class
				filterLinks.forEach(function (l) { l.classList.remove('active'); });
				this.classList.add('active');

				// Cập nhật URL trình duyệt (không reload trang)
				const targetHref = this.getAttribute('href');
				if (targetHref && window.history && window.history.pushState) {
					window.history.pushState({ filter: targetFilter }, '', targetHref);
				}

				applyFilter(targetFilter, true);
			});
		});

		// Khởi tạo theo tab đang active ban đầu
		const activeTab = document.querySelector('.mbland_linhvuc_listProject_filterLink.active');
		const initialFilter = activeTab ? (activeTab.getAttribute('data-filter') || 'all') : 'all';
		applyFilter(initialFilter, true);

		// Hỗ trợ nút Back / Forward của trình duyệt
		window.addEventListener('popstate', function (e) {
			const stateFilter = (e.state && e.state.filter) ? e.state.filter : null;
			let matchingLink = null;
			if (stateFilter) {
				matchingLink = document.querySelector('.mbland_linhvuc_listProject_filterLink[data-filter="' + stateFilter + '"]');
			}
			if (!matchingLink) {
				const path = window.location.pathname;
				filterLinks.forEach(function (l) {
					const href = l.getAttribute('href') || '';
					if (href.includes(path)) {
						matchingLink = l;
					}
				});
			}
			if (matchingLink) {
				filterLinks.forEach(function (l) { l.classList.remove('active'); });
				matchingLink.classList.add('active');
				applyFilter(matchingLink.getAttribute('data-filter') || 'all', true);
			} else {
				applyFilter('all', true);
			}
		});
	} else {
		// Không có tab filter -> hiển thị tất cả
		applyFilter('all', true);
	}

	// Xử lý nút Xem thêm
	if (loadMoreBtn) {
		loadMoreBtn.addEventListener('click', function (e) {
			e.preventDefault();
			visibleCount += PER_PAGE;
			applyFilter(currentFilter, false);
		});
	}
});
