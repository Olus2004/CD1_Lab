## Giao diện
- Thêm sinh viên
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/a8d1e32a-39c6-441c-bf3c-454cdecf15d1" />

- Trang chủ 
<img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/30e512a1-0071-40a8-a9db-6722baa5e08b" />


## 🚀 Các tính năng chính
- **Quản lý Sinh viên (CRUD)**: Thêm mới, Chỉnh sửa, Xóa và Hiển thị danh sách sinh viên.
- **Lưu trữ Cơ sở dữ liệu**: Kết nối MySQL qua PDO giúp bảo mật và ổn định.
- **Tìm kiếm thông minh**: Tìm kiếm sinh viên theo họ tên hoặc ngành học ngay lập tức.
- **Phân trang**: Hiển thị 5 sinh viên mỗi trang, tối ưu hóa trải nghiệm người dùng.
- **Giao diện hiện đại**: Thiết kế theo phong cách Glassmorphism, tương thích tốt trên cả điện thoại và máy tính.
- **Tự động khởi tạo**: Hệ thống tự động tạo bảng và dữ liệu mẫu ngay trong lần chạy đầu tiên.

## 🛠️ Công nghệ sử dụng
- **Ngôn ngữ**: PHP thuần (Pure PHP)
- **Cơ sở dữ liệu**: MySQL (Sử dụng PDO)
- **Giao diện**: HTML5, CSS3 (Thiết kế tinh tế, hiện đại)
- **Kiến trúc**: Mô hình MVC

## 📥 Hướng dẫn cài đặt

1. **Tải mã nguồn về máy**:
   Sử dụng lệnh `git clone` hoặc tải file nén và giải nén vào thư mục XAMPP.

2. **Cấu hình trên XAMPP**:
   - Mở XAMPP Control Panel và khởi động **Apache** cùng **MySQL**.
   - Copy thư mục dự án vào đường dẫn: `C:\xampp\htdocs\mvc_sinhvien`.

3. **Thiết lập Database**:
   - Truy cập PHPMyAdmin và tạo một cơ sở dữ liệu mới tên là `mvc_sinhvien`.
   - Nếu cần thay đổi thông tin kết nối, hãy sửa trong file `config/Database.php`.

4. **Chạy ứng dụng**:
   - Mở trình duyệt và truy cập: `http://localhost/mvc_sinhvien/index.php`
   - Ứng dụng sẽ tự động khởi tạo dữ liệu cần thiết để bạn bắt đầu sử dụng.

## 📂 Cấu trúc thư mục
- `config/`: Cấu hình kết nối cơ sở dữ liệu.
- `controller/`: Xử lý các yêu cầu và điều hướng ứng dụng.
- `model/`: Thao tác với dữ liệu và truy vấn SQL.
- `view/`: Chứa các tệp giao diện hiển thị.
- `index.php`: Điểm khởi đầu và điều hướng chính của trang web.
