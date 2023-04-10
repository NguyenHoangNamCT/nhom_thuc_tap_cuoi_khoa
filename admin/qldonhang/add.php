<?php
    require("../view/top.php");
?> 

<div class="container mt-3">
  <h2>Thêm Đơn Hàng</h2>
  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="XuLyThem">

  <div class="mb-3 mt-3">
    <label for="selectTenNguoiDung">Tên người dùng:</label>
    <select class="form-control" name="selectTenNguoiDung" id="selectTenNguoiDung">
      <?php
        $mangNguoiDung = $nd->laytatcanguoidung();
        foreach($mangNguoiDung as $arr):
      ?>
        <option value="<?php echo $arr["id"]; ?>"><?php echo $arr["ho_ten"]; ?></option>
      <?php
        endforeach;
      ?>
    </select>
  </div> 

  <label for="dateNgayDat">Ngày Đặt:</label>
  <div class="input-group date" data-provide="datepicker">
    <input type="datetime-local" class="form-control" id="dateNgayDat" name="dateNgayDat">
    <div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
    </div>
  </div>   

  <div class="mb-3 mt-3">
    <label for="txtDiaChiGH">Địa Chỉ Giao Hàng:</label>
    <input type="text" class="form-control"  placeholder="" name="txtDiaChiGH" id="txtDiaChiGH">
  </div>

  <div class="mb-3 mt-3">
    <label for="txtDienThoai">Điện Thoại Người Nhận:</label>
    <input type="text" class="form-control"  placeholder="" name="txtDienThoai" id="txtDienThoai">
  </div>

  <div class="mb-3 mt-3">
    <label for="txtHoTenNN">Họ Tên Người Nhận:</label>
    <input type="text" class="form-control"  placeholder="" name="txtHoTenNN" id="txtHoTenNN">
  </div>

  <div class="mb-3 mt-3">
    <label for="txtTongTien">Tổng Tiền:</label>
    <input type="text" class="form-control"  placeholder="" name="txtTongTien" id="txtTongTien">
  </div>

  <div class="mb-3 mt-3">
    <label for="txtTinhTrangDH">Tình Trạng Đơn Hàng:</label>
    <input type="text" class="form-control"  placeholder="" name="txtTinhTrangDH" id="txtTinhTrangDH">
  </div>

    
    
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
