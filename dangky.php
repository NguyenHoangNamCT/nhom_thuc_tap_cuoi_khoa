<?php include("view/top.php"); ?>
<br>
<div class="container-fluid d-flex justify-content-center flex-column align-items-center">
<h1 style="color: #CDAD00;">TRANG THANH TOÁN</h1>

<div class="col-sm-6 px-5">
  <h4 class="pt-4">Đây là thông tin nhận hàng của bạn, hãy thay đổi nếu chưa đúng</h4>
  <form method="post" action="">
    <!-- Gữi dữ liệu ẩn -->
    <input type="hidden" name="action" value="taoDonHang">
    <!-- END -->
    <div class="form-group">
      <label>Họ tên:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your name" name="inputHoTen" value="<?php echo $_SESSION['nguoiDung']['ho_ten']; ?>" disabled>
    </div>
    <div class="form-group">
      <label>Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your email" name="inputEmail" value="<?php echo $_SESSION['nguoiDung']['email']; ?>">
    </div>
    <div class="form-group">
      <label>Số điện thoại:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your phone number" name="inputSDT" value="<?php echo $_SESSION['nguoiDung']['dien_thoai']; ?>">
    </div>
    <div class="form-group">
      <label>Địa chỉ:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your address" name="inputDiaChi" value="<?php echo $_SESSION['nguoiDung']['dia_chi']; ?>">
    </div>
    <div class="d-flex justify-content-center py-3">
      <button type="submit" class="btn btn-info">Hoàn tất đơn hàng</button>
    </div>
  </form>
  <br>
</div>



<div class="col-sm-6 row px-5">
  <h2>Sản phẩm</h2>
  <p>Các sản phẩm bạn đã chọn mua</p>
  <table class="table">
    <thead>
      <tr class="success">
        <th>Tên sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Đơn giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $mangMHTrongGio = $gh->layGioHang($_SESSION['nguoiDung']['id']);
        $phiVanChuyen = 25000;
        $tongTien = $phiVanChuyen;
        foreach($mangMHTrongGio as $arr){
            $thanhTien = $arr['gia_tien'] *(1-$arr['giam_gia']/100) * $arr['so_luong'];
            $tongTien+= $thanhTien;
      ?>
        <tr>
            <td><?php echo $arr['ten_san_pham']; ?></td>
            <td><img width="75" src="images/<?php echo $arr['hinh_anh']; ?>" alt=""></td>
            <td><?php echo number_format($thanhTien/$arr['so_luong']).'đ'; ?></td>
            <td><?php echo number_format($arr['so_luong']);?></td>
            <td><?php echo number_format($thanhTien); ?></td>
        </tr>
      <?php 
        }
      ?>
      <tr>
        <td colspan="5" align="right">Phí vận chuyển: <?php echo number_format($phiVanChuyen); ?></td>
      </tr>
      <tr>
        <td colspan="5" align="right"><b>Tổng tiền: <?php echo number_format($tongTien); ?></b></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
<?php include("view/footer.php"); ?>