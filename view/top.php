<!DOCTYPE html>
<html lang="en">
<head>
  <title>Shop bán vật liệu xây dựng D&N</title>
  <meta charset="utf-8">
  <!-- Bootstrap -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> 
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container">
    <a class="navbar-brand btn btn-warning " href="index.php" style="color: #0000FF;">D&N SHOP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
	  <span class="navbar-toggler-icon"></span>
    </button>

	
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: yellow;">
            Loại sản phẩm
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php 
              foreach($mangLoaiSP as $arr)
              {
                echo '<li><a class="dropdown-item" href="?action=locSanPhamTheoLoai&id='.$arr['id'].'">'.$arr['ten_loai_san_pham'].'</a></li>';
              }
            ?>
            <!-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li> -->
          </ul>
        </li>
      
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: yellow;">
            Thương hiệu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php 
              foreach($mangThuongHieu as $arr)
              {
                echo '<li><a class="dropdown-item" href="?action=locSanPhamTheoThuongHieu&id='.$arr['id'].'">'.$arr['TenThuongHieu'].'</a></li>';
              }
            ?>
            <!-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li> -->
          </ul>
        </li>

        <a class="nav-link active" aria-current="page" href="?action=gioithieu" style="color: yellow;">Giới Thiệu</a>
        <?php if(isset($_SESSION['nguoiDung']) && $_SESSION['nguoiDung']['loai_nguoi_dung'] != 3) {?>
        <a class="nav-link active" aria-current="page" href="admin/qlsanpham/" style="color: yellow;">Trang quản lý</a>
        <?php } ?>
        
      </ul>

      

      <form method="post" class="d-flex" style="margin-left: 0.55rem;">
        <!-- Gửi dữ liệu ẩn -->
        <input type="hidden" name="action" value="timKiem">
          <!-- Mỗi lần tìm kiếm thì reset trang hiện tại về 1 -->
        <input type="hidden" name="trangHienTai" value="1">
        <!-- End -->
        <div style="margin-right: 0.55rem;"><input name="txtTuKhoa" class="form-control" type="search" placeholder="Search" aria-label="Search"></div>
        <button type="submit" class="btn btn-outline-warning me-2 bi-search">Tìm kiếm</button>
        <?php if(isset($_SESSION['nguoiDung'])){ ?>
        <a class="btn btn-outline-warning me-2 bi-cart3" href="?action=xemGioHang">Giỏ hàng</a>
        <?php } ?>
        <?php 
            if(!isset($_SESSION['nguoiDung']))
              echo '<a class="btn btn-warning me-2" href="?action=dangNhap">Login</a>';
        ?>       
      </form>
      

      <!-- Biểu tượng người dùng trong trang chủ -->
      <?php if(isset($_SESSION['nguoiDung'])){ ?>
        <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle ms-2" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="images/<?php echo $_SESSION['nguoiDung']['hinh_anh']; ?>" alt="" style="width: 50px; height: 50px; object-fit: cover;" class="rounded-circle me-2">
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#hoSoCaNhan">Hồ sơ cá nhân</a></li>
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#doiMK">Đổi mật khẩu</a></li>
          <li><a class="dropdown-item" href="?action=xemDonMua">Đơn mua</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="?action=dangXuat">Sign out</a></li>
        </ul>
      </div>
      <?php } ?>
      <!-- END -->
</nav>

      <!-- ----------------------------------Danh sách modal---------------------------------- -->
      <!-- The Modal -->
  <div class="modal fade" id="hoSoCaNhan" tabindex="-1" aria-labelledby="hoSoCaNhanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hoSoCaNhanLabel">Thông tin của bạn</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" action="">
          <!-- Gửi dữ liệu ẩn -->
          <input type="hidden" name="id" value="<?php echo $_SESSION["nguoiDung"]["id"]; ?>" >
          <input type="hidden" name="action" value="updateUser">
          <!-- END -->
          <div class="text-center mb-3">
            <img class="rounded-circle" src="images/<?php echo $_SESSION['nguoiDung']['hinh_anh'] ?>" alt="<?php echo $_SESSION['nguoiDung']['ho_ten']; ?>" width="100px">
          </div>
          <div class="mb-3">
            <label for="txtTenDangNhap" class="form-label">Tên Đăng Nhập</label>
            <input class="form-control" type="text" name="txtTenDangNhap" placeholder="Tên Đăng Nhập" value="<?php echo $_SESSION["nguoiDung"]["ten_dang_nhap"]; ?>" required disabled>
          </div>
          <div class="mb-3">
            <label for="txthoten" class="form-label">Họ tên</label>
            <input class="form-control"  type="text" name="txthoten" placeholder="Họ tên" value="<?php echo $_SESSION["nguoiDung"]["ho_ten"]; ?>" required>
          </div>
          <div class="mb-3">
            <label for="txtDC" class="form-label">Địa chỉ</label>
            <input class="form-control"  type="text" name="txtDC" placeholder="Địa chỉ" value="<?php echo $_SESSION["nguoiDung"]["dia_chi"]; ?>" required>
          </div>
          <div class="mb-3">
            <label for="txtdienthoai" class="form-label">Số điện thoại</label>
            <input class="form-control" type="number" name="txtdienthoai" placeholder="Số điện thoại" value="<?php echo $_SESSION["nguoiDung"]["dien_thoai"]; ?>" required>
          </div>
          <div class="mb-3">
            <label for="txtemail" class="form-label">Email</label>
            <input class="form-control" type="email" name="txtemail" placeholder="Email" value="<?php echo $_SESSION["nguoiDung"]["email"]; ?>" required>
          </div>
          <div class="mb-3">
            <label for="txtNgayDangKy" class="form-label">Ngày Đăng Ký</label>
            <input class="form-control"  type="text" name="txtNgayDangKy" placeholder="Ngày Đăng Ký" value="<?php echo $_SESSION["nguoiDung"]["ngay_dang_ky"]; ?>" required disabled>
          </div>
          <div class="mb-3">
            <label for="txtLoaiNguoiDung" class="form-label">Ngày Đăng Ký</label>
            <input class="form-control"  type="text" name="txtLoaiNguoiDung" placeholder="Loại người dùng" value="<?php echo $_SESSION["nguoiDung"]["loai_nguoi_dung"]; ?>" required disabled>
          </div>
          <div class="mb-3">
            <label for="txtTrangThai" class="form-label">Trạng Thái</label>
            <input class="form-control"  type="text" name="txtTrangThai" placeholder="Trạng Thái" value="<?php echo $_SESSION["nguoiDung"]["trang_thai"]; ?>" required disabled>
          </div>
          <div class="mb-3">
            <label for="fhinh" class="form-label">Đổi hình đại diện</label>
            <input type="file" class="form-control" id="fhinh" name="fhinh">
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <button type="reset" class="btn btn-warning">Hủy Thay Đổi</button>
          </div>
        </form>

    </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
  </div>
  </div>
  </div>
  
  <!-- modal đổi mk -->
      <div class="modal fade" id="doiMK" tabindex="-1" aria-labelledby="doiMKLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="doiMKLabel">Form đổi mật khẩu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" name="action" value="doiMatKhau">
              <div class="text-center">
                <img class="rounded-circle" src="images/<?php echo $_SESSION['nguoiDung']['hinh_anh'] ?>" alt="<?php echo $_SESSION['nguoiDung']['ho_ten']; ?>" width="100px">
              </div>
              <div class="mb-3">
                <label class="form-label">Tài khoản</label>
                <input class="form-control" type="hidden" name="txtid" value="<?php echo $_SESSION["nguoiDung"]["id"]; ?>">
                <input class="form-control" type="text" name="txtTenDangNhap" value="<?php echo $_SESSION["nguoiDung"]["ten_dang_nhap"]; ?>" disabled>
              </div>
              <div class="mb-3">
                <label class="form-label">Mật khẩu cũ</label>
                <input class="form-control" type="password" name="txtmatKhauCu" placeholder="Mật khẩu cũ">
              </div>
              <div class="mb-3">
                <label class="form-label">Mật khẩu mới</label>
                <input class="form-control" type="password" name="txtmatKhauMoi" placeholder="Mật khẩu mới">
              </div>
              <div class="mb-3">
                <label class="form-label">Nhập lại mật khẩu mới</label>
                <input class="form-control" type="password" name="txtnhapLaiMatKhau" placeholder="Nhập lại mật khẩu mới">
              </div>
              <div class="form-group text-center">
                <input class="btn btn-primary" type="submit" value="Lưu">
                <input class="btn btn-warning" type="reset" value="Hủy Thay Đổi">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
