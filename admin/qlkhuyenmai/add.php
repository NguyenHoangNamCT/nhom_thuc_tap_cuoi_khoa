<?php
    require("../view/top.php");
?> 

<div class="container mt-3">
  <h2>Thêm khuyến mãi</h2>
  <form method="post">
    <!-- Gửi dữ liệu ẩn -->
    <input type="hidden" name="action" value="XuLyThem">
    <div class="mb-3 mt-3">
      <label for="">Tên khuyến mãi:</label>
      <input type="text" class="form-control" placeholder="" name="txtTenKhuyenMai">
    </div>
    <div class="mb-3 mt-3">
      <label for="">Mô tả:</label>
      <input type="text" class="form-control" placeholder="" name="txtMoTa">
    </div>
    <div class="mb-3 mt-3">
      <label for="">Ngày bắt đầu:</label>
      <input type="datetime-local" class="form-control" placeholder="" name="txtNgayBatDau">
    </div>
    <div class="mb-3 mt-3">
      <label for="">Ngày kết thúc:</label>
      <input type="datetime-local" class="form-control" placeholder="" name="txtNgayKetThuc">
    </div>
    <div class="mb-3 mt-3">
      <label for="">Trạng thái:</label>
      <select class="form-control" name="selectTrangThai">
        <option value="1">Hoạt động</option>
        <option value="0">Ngưng hoạt động</option>
      </select>
    </div>
    <div class="mb-3 mt-3">
      <label for="">Giá trị:</label>
      <input type="text" class="form-control" placeholder="" name="txtGiaTri">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>


</div>
<?php
    require("../view/footer.php");
?>
