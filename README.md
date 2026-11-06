# MBLand Asset Management Theme - Tài liệu Hướng dẫn Phát triển

Tài liệu này ghi lại các quy chuẩn, hướng dẫn sử dụng và tái sử dụng các Component giao diện (UI Components) trong theme, giúp các thành viên trong nhóm phát triển đồng bộ và đúng cấu trúc.

---

## 📦 Danh sách UI Components

### 1. Component: Nút Xem chi tiết (`button-detail`)

Component nút bấm dạng viên thuốc (pill) với hiệu ứng animation thu gọn icon tròn và mở rộng nền màu đỏ khi hover.

- **File PHP Component**: [`template-parts/ui/button-detail.php`](template-parts/ui/button-detail.php)
- **File CSS**: [`assets/css/ui/button-detail.css`](assets/css/ui/button-detail.css) *(được nạp tự động toàn trang qua `inc/enqueue.php`)*

#### Cách sử dụng chuẩn:

```php
<?php
get_template_part( 'template-parts/ui/button-detail', null, array(
    'url'   => get_permalink(),
    'class' => 'mbland_tintucTemplate_postCard_button', // Thêm class riêng của block nếu cần tùy biến layout
    'title' => the_title_attribute( array( 'echo' => false ) ),
) );
?>
```

#### Bảng tham số (Parameters):

| Tham số | Kiểu dữ liệu | Mặc định | Mô tả |
| :--- | :--- | :--- | :--- |
| `url` | `string` | `'#'` | Đường dẫn khi click vào nút (thường là `get_permalink()`). |
| `label` | `string` | `'XEM CHI TIẾT'` | Chữ hiển thị trên nút. Tự động hỗ trợ đa ngôn ngữ qua hàm `pll__()` của Polylang. |
| `class` | `string` | `''` | Class CSS tùy biến bổ sung (ví dụ căn chỉnh margin, flex positioning theo từng vị trí). |
| `title` | `string` | `'Xem chi tiết'` | Thuộc tính `title=""` của thẻ `<a>`. |
| `target` | `string` | `''` | Truyền `'_blank'` nếu muốn mở liên kết trong tab mới (tự động kèm `rel="noopener noreferrer"`). |
| `aria` | `string` | `''` | Thuộc tính `aria-label=""` hỗ trợ accessibility. |

#### Ví dụ các trường hợp sử dụng:

**1. Nút mặc định theo bài viết:**
```php
<?php
get_template_part( 'template-parts/ui/button-detail', null, array(
    'url'   => get_permalink(),
    'title' => get_the_title(),
) );
?>
```

**2. Nút đổi chữ và mở liên kết ngoài sang tab mới:**
```php
<?php
get_template_part( 'template-parts/ui/button-detail', null, array(
    'url'    => 'https://example.com',
    'label'  => 'KHÁM PHÁ NGAY',
    'title'  => 'Khám phá ngay',
    'target' => '_blank',
) );
?>
```

---

### 2. Component: Card Tin Mới (`newCardItem`)

Component thẻ bài viết dạng ngang (ngang 50% / flex row) gồm: ảnh đại diện hover zoom, ngày đăng, badge 'TIN MỚI', tiêu đề hover đổi màu, mô tả ngắn, avatar + tác giả, và nút Xem chi tiết.

- **File PHP Component**: [`template-parts/ui/newCardItem.php`](template-parts/ui/newCardItem.php)
- **File CSS**: [`assets/css/ui/newCardItem.css`](assets/css/ui/newCardItem.css) *(được nạp tự động toàn trang qua `inc/enqueue.php`)*

#### Cách sử dụng chuẩn trong Loop:

```php
<?php
if ( $ttm_query->have_posts() ) :
    while ( $ttm_query->have_posts() ) : $ttm_query->the_post();
        get_template_part( 'template-parts/ui/newCardItem' );
    endwhile;
    wp_reset_postdata();
endif;
?>
```

#### Cách gọi ngoài Loop hoặc truyền tham số tùy biến:

```php
<?php
get_template_part( 'template-parts/ui/newCardItem', null, array(
    'post_id' => $post->ID,         // optional: ID bài viết (mặc định lấy post hiện tại)
    'class'   => 'my-custom-class', // optional: class CSS bổ sung
    'badge'   => 'TIN NỔI BẬT',     // optional: thay đổi nhãn badge (mặc định 'TIN MỚI')
) );
?>
```

#### Bảng tham số (Parameters):

| Tham số | Kiểu dữ liệu | Mặc định | Mô tả |
| :--- | :--- | :--- | :--- |
| `post_id` | `int` | `get_the_ID()` | ID bài viết cần hiển thị. |
| `class` | `string` | `''` | Class CSS tùy biến bổ sung vào thẻ `<article>`. |
| `badge` | `string` | `'TIN MỚI'` | Chữ hiển thị trên badge meta (hỗ trợ Polylang). |

---

### 3. Component: Card Tuyển Dụng (`jobCardItem`)

Component thẻ bài tuyển dụng dạng ngang gồm: Hạn nộp hồ sơ, Tiêu đề vị trí tuyển dụng, Mức lương, Địa điểm làm việc, và Nút Ứng tuyển ngay.

- **File PHP Component**: [`template-parts/ui/jobCardItem.php`](template-parts/ui/jobCardItem.php)
- **File CSS**: [`assets/css/ui/jobCardItem.css`](assets/css/ui/jobCardItem.css) *(được nạp tự động toàn trang qua `inc/enqueue.php`)*

#### Cách sử dụng chuẩn trong Loop:

```php
<?php
if ( $jobs_query->have_posts() ) :
    while ( $jobs_query->have_posts() ) : $jobs_query->the_post();
        get_template_part( 'template-parts/ui/jobCardItem' );
    endwhile;
    wp_reset_postdata();
endif;
?>
```

#### Cách gọi ngoài Loop hoặc truyền tham số tùy biến:

```php
<?php
get_template_part( 'template-parts/ui/jobCardItem', null, array(
    'post_id' => $post->ID,         // optional: ID bài viết (mặc định lấy post hiện tại)
    'class'   => 'my-custom-class', // optional: class CSS bổ sung
) );
?>
```

#### Bảng tham số (Parameters):

| Tham số | Kiểu dữ liệu | Mặc định | Mô tả |
| :--- | :--- | :--- | :--- |
| `post_id` | `int` | `get_the_ID()` | ID bài viết tuyển dụng cần hiển thị. |
| `class` | `string` | `''` | Class CSS tùy biến bổ sung vào thẻ `<article>`. |

---

### 4. Component: Phân trang danh sách (`pagination`)

Component phân trang dùng chung chuẩn giao diện MBLand: nút số trang bo góc màu `#F9F4EA`, trang hiện tại màu đỏ `var(--primary-color)`, tự động ẩn khi chỉ có 1 trang và hỗ trợ giữ nguyên query parameters.

- **File PHP Component**: [`template-parts/ui/pagination.php`](template-parts/ui/pagination.php)
- **File CSS**: [`assets/css/ui/pagination.css`](assets/css/ui/pagination.css) *(được nạp tự động toàn trang qua `inc/enqueue.php`)*

#### Cách sử dụng chuẩn với WP_Query:

```php
<?php
get_template_part( 'template-parts/ui/pagination', null, array(
    'query'   => $grid_query, // WP_Query object
    'current' => $paged,      // Trang hiện tại
    'class'   => 'mbland_tintucTemplate_post_listPostPagination', // optional class bổ sung
) );
?>
```

#### Cách sử dụng với rewrite rule `/page/N/` và bộ lọc query args:

```php
<?php
get_template_part( 'template-parts/ui/pagination', null, array(
    'query'    => $jobs_query,
    'current'  => $paged,
    'base'     => trailingslashit( $page_url ) . '%_%',
    'format'   => 'page/%#%/',
    'add_args' => $active_params, // mảng các tham số lọc cần duy trì trên URL
    'class'    => 'mbland_recruitment_jobs_pagination',
) );
?>
```

#### Bảng tham số (Parameters):

| Tham số | Kiểu dữ liệu | Mặc định | Mô tả |
| :--- | :--- | :--- | :--- |
| `query` | `WP_Query` | `$GLOBALS['wp_query']` | Đối tượng query phân trang. |
| `total` | `int` | `$query->max_num_pages` | Tổng số trang (nếu muốn truyền thủ công). |
| `current` | `int` | `get_query_var('paged')` | Số trang hiện tại. |
| `base` | `string` | URL pagenum chuẩn | Mẫu link cơ sở. |
| `format` | `string` | `'?paged=%#%'` | Định dạng trang. |
| `add_args` | `array` | `array()` | Mảng tham số query parameters cần giữ lại qua các trang. |
| `prev_text` | `string` | `'Trước'` | Nhãn nút Trước (tự động hỗ trợ Polylang). |
| `next_text` | `string` | `'Sau'` | Nhãn nút Sau (tự động hỗ trợ Polylang). |
| `class` | `string` | `''` | Class CSS tùy biến bổ sung vào wrapper. |

---

## 📐 Quy chuẩn tạo Component mới trong Theme

Khi tạo một component dùng chung mới, các thành viên cần tuân thủ quy tắc sau:

1. **File PHP Component**: Đặt trong thư mục `template-parts/ui/` (ví dụ: `template-parts/ui/ten-component.php`).
2. **File CSS riêng của Component**: Đặt trong thư mục `assets/css/ui/` đồng bộ theo tên (ví dụ: `assets/css/ui/ten-component.css`).
3. **Nạp CSS vào Theme**: Khai báo trong `inc/enqueue.php` dưới mục `// CSS component dung chung` để đảm bảo component hiển thị đầy đủ phong cách ở tất cả template.
4. **Quy tắc gọi Component**:
   - Sử dụng `get_template_part( 'template-parts/ui/ten-component', null, $args )`.
   - **Tuyệt đối không** truyền tên class CSS vào vị trí đường dẫn file của `get_template_part`.

---

## 📱 Quy chuẩn Responsive (Breakpoints CSS)

Để đảm bảo giao diện hiển thị đồng nhất và chuẩn xác trên mọi thiết bị, toàn bộ các file CSS (bao gồm page template, component, layout) **bắt buộc tuân thủ hệ thống Breakpoints cố định** sau:

### 1. Danh sách Breakpoints chuẩn

| Media Query | Loại thiết bị tương ứng | Mô tả / Mục đích sử dụng |
| :--- | :--- | :--- |
| `@media (max-width: 1600px)` | Màn hình lớn (Large Desktop / Full HD+) | Tinh chỉnh padding container, font size tiêu đề lớn. |
| `@media (max-width: 1400px)` | Desktop tiêu chuẩn (Standard Desktop) | Điều chỉnh khoảng cách gap, thu nhỏ nhẹ layout. |
| `@media (max-width: 1200px)` | Laptop / Desktop nhỏ (Small Desktop) | Giảm cột lưới (grid 4 -> 3 cột), thu nhỏ container. |
| `@media (max-width: 996px)` | Tablet ngang (Tablet Landscape) | Chuyển layout cột lớn, menu mobile (nếu có), giảm padding section. |
| `@media (max-width: 768px)` | Tablet dọc / Mobile lớn (Tablet Portrait) | Chuyển flex row sang column, giảm mạnh font size heading. |
| `@media (max-width: 576px)` | Mobile tiêu chuẩn (Standard Mobile) | Grid chuyển về 1 cột, full width button, tối ưu khoảng chạm (touch). |
| `@media (max-width: 425px)` | Mobile nhỏ (Small Mobile) | Tối ưu font size, thu hẹp padding mép màn hình tránh tràn viền. |

### 2. Nguyên tắc viết CSS Responsive

1. **Desktop-First (Thứ tự từ lớn đến nhỏ)**:
   - Viết CSS mặc định cho Desktop ở đầu file hoặc đầu từng block component.
   - Các block `@media (max-width: ...)` phải sắp xếp theo **thứ tự giảm dần**: `1600px` ➔ `1400px` ➔ `1200px` ➔ `996px` ➔ `768px` ➔ `576px` ➔ `425px`.
   - Việc tuân thủ thứ tự này đảm bảo CSS kế thừa (cascade) chính xác, breakpoint nhỏ hơn sẽ ghi đè thuộc tính của breakpoint lớn hơn một cách tự nhiên.

2. **Không tự ý thêm breakpoint lẻ**:
   - Không sử dụng các breakpoint tùy hứng (như `1024px`, `850px`, `600px`, `480px`,...) trừ khi có yêu cầu đặc thù và phải có chú thích rõ ràng.

3. **Cấu trúc khung mẫu (Boilerplate) khi viết CSS**:

```css
/* ==========================================================================
   1. BASE / DESKTOP STYLES
   ========================================================================== */
.mbland_example {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}

/* ==========================================================================
   2. RESPONSIVE BREAKPOINTS (BẮT BUỘC THEO THỨ TỰ GIẢM DẦN)
   ========================================================================== */

/* <= 1600px: Large Desktop */
@media (max-width: 1600px) {
  .mbland_example {
    gap: 20px;
  }
}

/* <= 1400px: Standard Desktop */
@media (max-width: 1400px) {
  .mbland_example {
    gap: 16px;
  }
}

/* <= 1200px: Small Desktop / Laptop */
@media (max-width: 1200px) {
  .mbland_example {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* <= 996px: Tablet Landscape */
@media (max-width: 996px) {
  .mbland_example {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* <= 768px: Tablet Portrait / Large Mobile */
@media (max-width: 768px) {
  .mbland_example {
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
  }
}

/* <= 576px: Standard Mobile */
@media (max-width: 576px) {
  .mbland_example {
    grid-template-columns: 1fr;
  }
}

/* <= 425px: Small Mobile */
@media (max-width: 425px) {
  .mbland_example {
    gap: 8px;
  }
}
```
