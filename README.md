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

## 📐 Quy chuẩn tạo Component mới trong Theme

Khi tạo một component dùng chung mới, các thành viên cần tuân thủ quy tắc sau:

1. **File PHP Component**: Đặt trong thư mục `template-parts/ui/` (ví dụ: `template-parts/ui/ten-component.php`).
2. **File CSS riêng của Component**: Đặt trong thư mục `assets/css/ui/` đồng bộ theo tên (ví dụ: `assets/css/ui/ten-component.css`).
3. **Nạp CSS vào Theme**: Khai báo trong `inc/enqueue.php` dưới mục `// CSS component dung chung` để đảm bảo component hiển thị đầy đủ phong cách ở tất cả template.
4. **Quy tắc gọi Component**:
   - Sử dụng `get_template_part( 'template-parts/ui/ten-component', null, $args )`.
   - **Tuyệt đối không** truyền tên class CSS vào vị trí đường dẫn file của `get_template_part`.

