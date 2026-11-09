/* Trang taxonomy linh-vuc (taxonomy-linh-vuc.php) */
document.addEventListener('DOMContentLoaded', function () {
	// Script của section Procedure đã được tách và đồng bộ vào assets/js/sections/procedure.js

	// ===== Tab Lĩnh vực (danh sách dự án): đổi panel, không chuyển trang =====
	var tabList = document.querySelector('.mbland_linhvuc_listProject_filterList');
	var tabs = tabList ? Array.prototype.slice.call(tabList.querySelectorAll('.mbland_linhvuc_listProject_filterLink')) : [];
	var panels = Array.prototype.slice.call(document.querySelectorAll('.mbland_linhvuc_listProject_panel'));

	// Phân trang "Xem thêm" trong từng panel (client-side)
	function initLoadMore(panel) {
		var perPage = parseInt(panel.getAttribute('data-per-page'), 10) || 12;
		var items = Array.prototype.slice.call(panel.querySelectorAll('.mbland_linhvuc_listProject_item'));
		var button = panel.querySelector('.mbland_linhvuc_listProject_loadMore');
		var shown = 0;

		function showMore() {
			var next = Math.min(shown + perPage, items.length);
			for (var i = shown; i < next; i++) {
				items[i].hidden = false;
			}
			shown = next;
			if (button && shown >= items.length) {
				button.hidden = true;
			}
		}

		items.forEach(function (item) { item.hidden = true; });
		showMore();
		if (button) {
			button.addEventListener('click', showMore);
		}
	}
	panels.forEach(initLoadMore);

	if (!tabs.length || !panels.length) {
		return;
	}

	function activate(tab, focus) {
		var id = tab.getAttribute('data-tab');
		tabs.forEach(function (t) {
			var on = t === tab;
			t.classList.toggle('active', on);
			t.setAttribute('aria-selected', on ? 'true' : 'false');
			t.setAttribute('tabindex', on ? '0' : '-1');
		});
		panels.forEach(function (p) {
			p.hidden = p.id !== 'lv-panel-' + id;
		});
		if (focus) {
			tab.focus();
		}
	}

	tabs.forEach(function (tab, index) {
		tab.addEventListener('click', function (e) {
			e.preventDefault();
			activate(tab, false);
		});
		tab.addEventListener('keydown', function (e) {
			var target = null;
			if (e.key === 'ArrowRight') { target = tabs[(index + 1) % tabs.length]; }
			if (e.key === 'ArrowLeft') { target = tabs[(index - 1 + tabs.length) % tabs.length]; }
			if (target) {
				e.preventDefault();
				activate(target, true);
			}
		});
	});

	// Mở tab theo hash (#slug-term) khi vào trang (nếu có)
	var hash = decodeURIComponent((window.location.hash || '').replace('#', ''));
	if (hash) {
		var matched = tabs.filter(function (t) { return t.getAttribute('data-slug') === hash; })[0];
		if (matched) {
			activate(matched, false);
		}
	}
});
