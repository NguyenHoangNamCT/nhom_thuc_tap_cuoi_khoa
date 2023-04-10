<?php
    require("../view/top.php");
?> 

<?php 
  $arr = $km->layKhuyenMaiTheoId($id);
?>

<div class="container mt-3">
  <h2>Thêm khuyến mãi</h2>
  <form method="post">
    <!-- Gửi dữ liệu ẩn -->
    <input type="hidden" name="action" value="xuLySua">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <!-- END -->
    <div class="mb-3 mt-3">
      <label for="">Tên khuyến mãi:</label>
      <input type="text" class="form-control" placeholder="" name="txtTenKhuyenMai" value="<?php echo $arr['ten_khuyen_mai']; ?>">
    </div>
    <div class="mb-3 mt-3">
      <label for="">Mô tả:</label>
      <input type="text" class="form-control" placeholder="" name="txtMoTa" value="<?php echo $arr['mo_ta']; ?>">
    </div>
    <div class="mb-3 mt-3">
      <label for="">Ngày bắt đầu:</label>
      <input type="datetime-local" class="form-control" placeholder="" name="txtNgayBatDau"  value="<?php echo $arr['ngay_bat_dau']; ?>">
    </div>
    <div class="mb-3 mt-3">
      <label for="">Ngày kết thúc:</label>
      <input type="datetime-local" class="form-control" placeholder="" name="txtNgayKetThuc" value="<?php echo $arr['ngay_ket_thuc']; ?>">
    </div>
    <div class="mb-3 mt-3">
      <label for="">Trạng thái:</label>
      <select class="form-control" name="selectTrangThai">
        <option <?php if($arr['trang_thai'] == 1) echo "selected"; ?> value="1">Hoạt động</option>
        <option <?php if($arr['trang_thai'] == 0) echo "selected"; ?> value="0">Ngưng hoạt động</option>
      </select>
    </div>
    <div class="mb-3 mt-3">
      <label for="">Giá trị:</label>
      <input type="text" class="form-control" placeholder="" name="txtGiaTri" value="<?php echo $arr['gia_tri'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
