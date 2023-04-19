<?php include("view/top.php"); ?>
<br><br>
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
    <style>
      .contact {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 300px;
        padding: 10px;
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
        border-left: 1px solid #dee2e6;
        border-radius: 0 0 0.25rem 0;
      }
      hr {
            border-top: 3px solid #6c757d; /* Màu xám nhạt */
            border-width: 0;
            height: 3px;
            background-color: #6c757d; /* Màu xanh nhạt */
          }
              
    </style>
  </head>
  <body>
      <div class="container">
      <h2 style="color:#00FFFF;" class ="py-1">Giới thiệu trang web bán vật liệu xây dựng</h2>
      <p>Chào mừng đến với trang web bán vật liệu xây dựng của chúng tôi! Chúng tôi là một trong những đơn vị hàng đầu cung cấp các sản phẩm vật liệu xây dựng chất lượng cao cho các dự án xây dựng. Trang web của chúng tôi cung cấp cho khách hàng một cách tiện lợi và nhanh chóng để tìm kiếm, chọn mua và thanh toán các sản phẩm vật liệu xây dựng mà họ cần.</p>
      <p>Với đội ngũ nhân viên chuyên nghiệp, kinh nghiệm lâu năm trong lĩnh vực vật liệu xây dựng, chúng tôi cam kết sẽ mang lại cho khách hàng sự hài lòng và tin tưởng với các sản phẩm và dịch vụ của chúng tôi.</p>
      <p>Hãy ghé thăm trang web của chúng tôi để tìm hiểu thêm về các sản phẩm vật liệu xây dựng mà chúng tôi cung cấp và để đặt hàng ngay hôm nay!</p>

      <br></br>
      <br></br>
      <hr>
      <br></br>
      <br></br>

    <div class="row">
      <div class="col-md-6" >
        <h3 style="color:#00FF00;" class ="py-1">Về chúng tôi</h3>
        <p>Là Trang website xây dựng nhằm mục đích báo cao tiến độ thực tập.</p>
        <p>Số điện thoại: 0123456789</p>
        <p>Địa chỉ: Long Xuyên, An Giang</p>
        <p>Email: admin@gmail.com</p>
      </div>
      <div class="col-md-6">
        <h3 style="color:#00FF00;" class ="py-1">Đăng ký nhận tin tức mới nhất</h3>
        <form action="#" method="post">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Địa chỉ email của bạn</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" placeholder="Họ và tên">
            <label for="floatingName">Họ và tên của bạn</label>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Đồng ý nhận tin tức mới nhất từ chúng tôi
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
      </div>
    </div>
    </div>
  </body>
</html>
