<?php 
require('model/lienhe.php');

$lh = new LIENHE(); 
?>



<footer class="bg-dark text-light">
  <div class="container py-3">
    <div class="row">
      <div class="col-md-6">
        <h4>Về chúng tôi</h4>
        <p class ="message">Giới thiệu sơ lược: là một website làm ra nhầm báo cáo tiến độ học tập.</p>
        <?php
                // Lấy danh sách liên hệ
                $rows = $lh->layDanhSachLienHe();
                if (count($rows) > 0) {
                    $lienhe = $rows[0];
                    $email = $lienhe['email'];
                    $sdt = $lienhe['so_dien_thoai'];
                    $ho_ten = $lienhe['ho_ten'];
                    echo "<p>Email: $email</p>";
                    echo "<p>Số điện thoại: $sdt</p>";
                    echo "<p>Họ tên: $ho_ten</p>";
                }
            ?>
        <p>Địa chỉ: Long Xuyên, An Giang</p>
      </div>
      <div class="col-md-6">
        <h4>Đăng ký nhận tin tức</h4>
        <form>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email của bạn" aria-label="Email của bạn" aria-describedby="button-addon2">
            <button class="btn btn-outline-light" type="button" id="button-addon2">Đăng ký</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <hr class="bg-light">
  <div class="container py-2">
    <div class="row">
      <div class="col-md-6">
        <p>&copy; 2023 - Trang web bán vật liệu xây dựng</p>
      </div>
      <div class="col-md-6 text-end">
        <a href="?action=chinhsachbaomat" class="text-light mx-3">Chính sách bảo mật</a>
        <a href="?action=dieukhoansudung" class="text-light mx-3">Điều khoản sử dụng</a>
      </div>
    </div>
  </div>
</footer>

</body>
</html>
