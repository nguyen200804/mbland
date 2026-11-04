/* Trang taxonomy linh-vuc (taxonomy-linh-vuc.php) */
document.addEventListener('DOMContentLoaded', function () {
	/* ===== PROCEDURE: thêm .active khi item cuộn đến giữa màn hình ===== */
	var items = document.querySelectorAll('.mbland_linhvuc_procedure_item');
	if (!items.length) return;

	// Trình duyệt cũ không hỗ trợ IntersectionObserver -> kích hoạt tất cả
	if (!('IntersectionObserver' in window)) {
		items.forEach(function (item) { item.classList.add('active'); });
		return;
	}

	// rootMargin thu vùng quan sát thành 1 đường ngang ở giữa viewport
	var observer = new IntersectionObserver(function (entries) {
		entries.forEach(function (entry) {
			entry.target.classList.toggle('active', entry.isIntersecting);
		});
	}, {
		root: null,
		rootMargin: '-50% 0px -50% 0px',
		threshold: 0
	});

	items.forEach(function (item) { observer.observe(item); });
});

