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
        
        <a class="nav-link active" aria-current="page" href="admin/qlsanpham/" style="color: yellow;">Trang quản lý</a>
        
      </ul>

      

      <form method="post" class="d-flex" style="margin-left: 0.55rem;">
        <div style="margin-right: 0.55rem;"><input name="txtTuKhoa" class="form-control" type="search" placeholder="Search" aria-label="Search"></div>
        <input type="hidden" name="action" value="timKiem">
        <button type="submit" class="btn btn-outline-warning me-2 bi-search">Tìm kiếm</button>
        <a class="btn btn-outline-warning me-2 bi-cart3" href="?action=xemGioHang">Giỏ hàng</a>
        
        <?php 
            if(isset($_SESSION['nguoiDung']))
              echo '<a class="btn btn-warning" href="?action=dangXuat">Đăng xuất</a>'; 
            else
              echo '<a class="btn btn-warning me-2" href="?action=dangNhap">Login</a>';
        ?>       
      </form>
      

      <!-- Biểu tượng người dùng trong trang chủ -->
      <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle ms-2" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="images/<?php echo $_SESSION['nguoiDung']['hinh_anh']; ?>" alt="" width="50" height="50" class="rounded-circle me-2">
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#hoSoCaNhan">Hồ sơ cá nhân</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#doiMK">Đổi mật khẩu</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="../../index.php?action=dangXuat">Sign out</a></li>
      </ul>
    </div>
      <!-- END -->

    </div>
  </div>
</nav>

<?php 
  include('footer.php');
?>
