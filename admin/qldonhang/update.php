<?php
    require("../view/top.php");
?> 
<div>
<br>
</div>

<?php 
  $arr = $dh->layDonHangById($id);
?>

<div class="container mt-3">
  <h2>Sửa Đơn Hàng</h2>
  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="xuLySua">
  <input type="hidden" name="id" value="<?php echo $arr['id']; ?>">
  <!-- End -->
  <div class="mb-3 mt-3">
    <label for="selectTenNguoiDung">Tên người dùng:</label>
    <select class="form-control" name="selectTenNguoiDung" id="selectTenNguoiDung" disabled>
      <?php
        $mangNguoiDung = $nd->layTatCaNguoiDung();
        foreach($mangNguoiDung as $arr_i){
          if($arr_i['id'] == $arr['id_nguoi_dung']){
      ?>
        <option selected value="<?php echo $arr_i["id"]; ?>"><?php echo $arr_i["ho_ten"]; ?></option>
      <?php
          }
          else{
      ?>
        <option value="<?php echo $arr_i["id"]; ?>"><?php echo $arr_i["ho_ten"]; ?></option>
      <?php
          }    
        }
      ?>
    </select>
  </div> 

  <label for="dateNgayDat">Ngày Đặt:</label>
  <div class="input-group date" data-provide="datepicker">
    <input type="datetime-local" class="form-control" id="dateNgayDat" name="dateNgayDat" value="<?php echo $arr['ngay_dat']; ?>">
    <div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
    </div>
  </div>   

  <div class="mb-3 mt-3">
    <label for="txtDiaChiGH">Địa Chỉ Giao Hàng:</label>
    <input type="text" class="form-control"  placeholder="" name="txtDiaChiGH" id="txtDiaChiGH" value="<?php echo $arr['dia_chi_giao_hang']; ?>">
  </div>

  <div class="mb-3 mt-3">
    <label for="txtDienThoai">Điện Thoại Người Nhận:</label>
    <input type="text" class="form-control"  placeholder="" name="txtDienThoai" id="txtDienThoai"  value="<?php echo $arr['dien_thoai_nguoi_nhan']; ?>">
  </div>

  <div class="mb-3 mt-3">
    <label for="txtTongTien">Tổng Tiền:</label>
    <input type="text" class="form-control"  placeholder="" name="txtTongTien" id="txtTongTien" value="<?php echo $arr['tong_tien']; ?>">
  </div>

  <div  class="mb-3 mt-3">
    <label for="txtTinhTrangDH">Tình Trạng Đơn Hàng:</label>
    <select class="form-select" aria-label="Default select example" name="txtTinhTrangDH"  id="txtTinhTrangDH">
      <option value="">--Chọn trạng thái đơn hàng hiện tại--</option>
      <option <?php if($arr['tinh_trang_don_hang'] == 0) echo "selected"; ?> value="0">Chưa thanh toán</option>
      <option <?php if($arr['tinh_trang_don_hang'] == 1) echo "selected"; ?>value="1">Đã thanh toán</option>
      <option <?php if($arr['tinh_trang_don_hang'] == 2) echo "selected"; ?>value="3">Đang vận chuyển</option>
      <option <?php if($arr['tinh_trang_don_hang'] == 3) echo "selected"; ?>value="4">Đã giao</option>
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
