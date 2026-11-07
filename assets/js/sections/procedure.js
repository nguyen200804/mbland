/**
 * Component: Procedure Section
 * Toggle class .active cho item khi cuộn vào viewport (nửa trên màn hình: 0 - 50vh)
 */
document.addEventListener('DOMContentLoaded', function () {
	var items = document.querySelectorAll('.mbland_linhvuc_procedure_item');
	if (!items.length) return;

	var ticking = false;

	function update() {
		var half = window.innerHeight / 2;
		items.forEach(function (item) {
			// top <= 50vh -> active; top > 50vh (51 - 100vh) -> bỏ active
			item.classList.toggle('active', item.getBoundingClientRect().top <= half);
		});
		ticking = false;
	}

	function onScroll() {
		if (!ticking) {
			ticking = true;
			window.requestAnimationFrame(update);
		}
	}

	window.addEventListener('scroll', onScroll, { passive: true });
	window.addEventListener('resize', onScroll);
	update();
});

