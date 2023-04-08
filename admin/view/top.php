<!doctype html>
<html lang="en">
  <head>
    <title>Shop điện thoại</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="sidebars.css" rel="stylesheet">
  </head>
  <body>
  

<main class="d-flex flex-nowrap">
  <h1 class="visually-hidden">Sidebars examples</h1>

  <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
    <a href="../../index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <span class="fs-4 bi-phone-fill">D&N Shop</span>
    </a> 
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="" class="nav-link active" aria-current="page">
          <span class="bi-house-fill"></span>
          Sản phẩm
        </a>
      </li>

      <li>
        <a href="../qlsanpham/" class="nav-link text-white">
          <span class="bi-phone"></span>
          Quản lý sản phẩm
        </a>
      </li>
      <li>
        <a href="../qlloaisanpham/" class="nav-link text-white">
          <span class="bi-kanban"></span>
          Quản lý loại sản phẩm
        </a>
      </li>

       <li>
        <a href="../qlthuonghieu/" class="nav-link text-white">
          <span class="bi-kanban"></span>
          Quản lý thương hiệu
        </a>
      </li>

      <li>
        <a href="../qldonhang/" class="nav-link text-white">
          <span class="bi-kanban"></span>
          Quản lý đơn hàng
        </a>
      </li>

      <li>
        <a href="../qlnguoidung/" class="nav-link text-white">
          <span class="bi-kanban"></span>
          Quản lý người dùng
        </a>
      </li>

      <!-- <?php if(isset($_SESSION['nguoiDung']) && $_SESSION['nguoiDung']['quyen'] == 1){ ?>

      <li class="nav-item">
        <a href="" class="nav-link active" aria-current="page">
          <span class="bi-alexa"></span>
          Người dùng
        </a>
      </li>

      <li>
        <a href="../qlnguoidung/" class="nav-link text-white">
          <span class="bi-people"></span>
          Quản lý người dùng
        </a>
      </li>
    <?php } ?>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong><?php echo $_SESSION['nguoiDung']['hoten'] ?></strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#hoSoCaNhan">Hồ sơ cá nhân</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#doiMK">Đổi mật khẩu</a></li>
        <!-- <li><a class="dropdown-item" href="#">Profile</a></li> -->
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="../../index.php?action=dangXuat">Sign out</a></li>
      </ul>
    </div>

    
  </div>
  <div class="b-example-vr"></div>
   
   <div></div> -->

   <!-- The Modal -->
   <div class="modal" id="hoSoCaNhan">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Thông tin của bạn</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form method="post" enctype="multipart/form-data" action="">
              <div class="text-center">
                <img class="img-circle" src="../../images/<?php echo $_SESSION['nguoiDung']['hinhanh'] ?>" alt="<?php echo $_SESSION['nguoiDung']['hoten']; ?>" width="100px">
              </div>
              <input type="hidden" name="txtid" value="<?php echo $_SESSION["nguoiDung"]["id"]; ?>">
              <div class="form-group">    
              <label>Email</label>    
              <input class="form-control" type="email" name="txtemail" placeholder="Email" value="<?php echo $_SESSION["nguoiDung"]["email"]; ?>" required>
              </div>
              <div class="form-group">    
              <label>Số điện thoại</label>    
              <input class="form-control" type="number" name="txtdienthoai" placeholder="Số điện thoại" value="<?php echo $_SESSION["nguoiDung"]["sdt"]; ?>" required>
              </div>            
              <div class="form-group">
              <label>Họ tên</label>
              <input class="form-control"  type="text" name="txthoten" placeholder="Họ tên" value="<?php echo $_SESSION["nguoiDung"]["hoten"]; ?>" required>
              </div>
              <div class="form-group">
              <label>Địa chỉ</label>
              <input class="form-control"  type="text" name="txtDC" placeholder="Địa chỉ" value="<?php echo $_SESSION["nguoiDung"]["diachi"]; ?>" required>
              </div>
              <div class="form-group">
                <label>Đổi hình đại diện</label>
                <input type="file" name="fhinh">
              </div>
              <div class="form-group">
              <input type="hidden" name="txtid" value="<?php echo $_SESSION["nguoiDung"]["id"]; ?>" >
              <input type="hidden" name="action" value="capNhatHoSo" >
              <input class="btn btn-primary"  type="submit" value="Lưu">
              <input class="btn btn-warning"  type="reset" value="Hủy"></div>
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>


       <!-- The Modal Đổi MK-->
   <div class="modal" id="doiMK">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Form đổi mật khẩu</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form method="post" enctype="multipart/form-data" action="">
            <label>Mật khẩu</label>
            <input class="form-control" type="password" name="txtMatKhau"
            placeholder="Mật khẩu">
              <div class="form-group">
              <input type="hidden" name="txtid" value="<?php echo $_SESSION["nguoiDung"]["id"]; ?>" >
              <input type="hidden" name="action" value="doiMK" >
              <input class="btn btn-primary"  type="submit" value="Lưu">
              <input class="btn btn-warning"  type="reset" value="Hủy"></div>
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>