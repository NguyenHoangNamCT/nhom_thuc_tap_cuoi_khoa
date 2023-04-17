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

    <style>
      html,
      body {
        height: 100%;
      }

      body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 330px;
        padding: 15px;
      }

      .form-signin .form-floating:focus-within {
        z-index: 2;
      }

      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }

      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }

    </style>
    
    <!-- Custom styles for this template -->
    <!-- <link href="sign-in.css" rel="stylesheet"> -->
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">
  <form method="post">
    <h1 class="h3 mb-3 fw-normal">Vui lòng đăng nhập</h1>
    <div class="form-floating">
      <input name="txtUserName" type="text" class="form-control" id="floatingInput" placeholder="User name">
      <label for="floatingInput">User name</label>
    </div>
    <div class="form-floating">
      <input name="txtPassword" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Đăng nhập</button>
    <!-- Gui them thong tin -->
    <input type="hidden" name="action" value="xuLyDangNhap">
    <!-- ------------------ -->
    <hr>
    <a href="" data-bs-toggle="modal" data-bs-target="#modalDK" class="w-50 btn btn-lg btn" type="submit" style="background-color: #00CC00;" >Đăng ký</a>
    <!-- Gữi dữ liệu ẩn -->
    <!-- END -->
    <p class="mt-5 mb-3 text-muted">&copy; 2023 D&Nshop</p>
  </form>
</main>

    <!-- Modal đăng ký -->
    <div class="modal" id="modalDk">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Form Đăng Ký</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

        

          <!-- Modal body -->
          <div class="modal-body">
            <form  method="post" enctype="multipart/form-data" action="">
            <!-- Gửi dữ liệu ẩn -->
            <input type="hidden" name="action" value="xuLyDangKy">
            <!-- End -->
            <div class="form-group text-left">
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
                <input class="btn btn-primary"  type="submit" value="Lưu">
                <input class="btn btn-warning"  type="reset" value="Hủy Thay Đổi">
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
    
  </body>
</html>
