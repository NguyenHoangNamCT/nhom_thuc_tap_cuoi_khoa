<?php include("view/top.php"); ?>
<br>
<div class="container-fluid row">
<h1 align="center">Trang thanh toán</h1>
<!-- <div class="container col-sm-5" style="margin: 20px;">
  <h2>Form điền thông tin</h2>
  <form method="post">
    <div class="form-group">
      <label>Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your email" name="inputEmail">
    </div>
    <div class="form-group">
      <label>Họ tên:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your name" name="inputHoTen">
    </div>
    <div class="form-group">
      <label>Số điện thoại:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your phone number" name="inputSDT">
    </div>
    <div class="form-group">
      <label>Địa chỉ:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter your address" name="inputDiaChi">
    </div>
    <input type="hidden" name="action" value="xuLyThanhToan">
    <button type="submit" class="btn btn-info">Hoàn tất đơn hàng</button>
  </form>
  <br>

</div> -->



<div class="container col-sm-8">
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
        $tongTien = 0;
        foreach($mangMHTrongGio as $arr){
            $thanhTien = $arr['gia_tien'] * $arr['so_luong'];
            $tongTien += $thanhTien;
      ?>
        <tr>
            <td><?php echo $arr['ten_san_pham']; ?></td>
            <td><img width="75" src="images/<?php echo $arr['hinh_anh']; ?>" alt=""></td>
            <td><?php echo number_format($arr['gia_tien']).'đ'; ?></td>
            <td><?php echo number_format($arr['so_luong']);?></td>
            <td><?php echo number_format($thanhTien);?></td>
        </tr>
      <?php 
        }
      ?>
      <tr>
        <td colspan="4" align="right"><b>Tổng tiền: <?php echo number_format($tongTien); ?></b></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
<?php include("view/footer.php"); ?>