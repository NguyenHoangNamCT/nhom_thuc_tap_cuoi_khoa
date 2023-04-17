<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- Bootstrap -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> 

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    
    <!-- Custom styles for this template -->
    <!-- <link href="sign-in.css" rel="stylesheet"> -->
  </head>
  <body class="">
    <div class="container">
    <h2>Đăng ký</h2>
    <form action="" method="POST" enctype="multipart/form-data">
      <!-- Gửi dữ liệu ẩn -->
      <input type="hidden" name="action" value="xuLyDangKy">
      <!-- End gửi dữ liệu ẩn -->
      <div class="form-group">
        <label for="ten-dang-nhap">Tên đăng nhập:</label>
        <input type="text" class="form-control" id="ten-dang-nhap" name="ten_dang_nhap" required>
      </div>
      <div class="form-group">
        <label for="mat-khau">Mật khẩu:</label>
        <input type="password" class="form-control" id="mat-khau" name="mat_khau" required>
      </div>
      <div class="form-group">
        <label for="ho-ten">Họ và tên:</label>
        <input type="text" class="form-control" id="ho-ten" name="ho_ten" required>
      </div>
      <div class="form-group">
        <label for="dia-chi">Địa chỉ:</label>
        <input type="text" class="form-control" id="dia-chi" name="dia_chi" required>
      </div>
      <div class="form-group">
        <label for="dien-thoai">Điện thoại:</label>
        <input type="tel" class="form-control" id="dien-thoai" name="dien_thoai" pattern="[0-9]{10,11}" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="hinh-anh">Hình ảnh:</label>
        <input type="file" class="form-control" id="hinh-anh" name="hinh_anh">
      </div>
      <div class="form-group">
        <label for="loai-nguoi-dung">Loại người dùng:</label>
        <select class="form-control" id="loai-nguoi-dung" name="loai_nguoi_dung" required>
          <option value="">--Chọn loại người dùng--</option>
          <option value="admin">Admin</option>
          <option value="member">Member</option>
        </select>
      </div>
      <div class="form-group">
        <label for="trang-thai">Trạng thái:</label>
        <div class="radio">
          <label><input type="radio" name="trang_thai" value="1" checked>Kích hoạt</label>
        </div>
        <div class="radio">
          <label><input type="radio" name="trang_thai" value="0">Không kích hoạt</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Thêm người dùng</button>
    </form>
  </div>
  </body>
</html>
