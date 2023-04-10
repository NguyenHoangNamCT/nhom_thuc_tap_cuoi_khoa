<?php
    require("../view/top.php");
?> 

<?php 
  $arr = $nd->layThongTinNguoiDungTheoID($id);
?>

<div class="container">
  <h2>Thêm người dùng</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <!-- Gửi dữ liệu ẩn -->
    <input type="hidden" name="action" value="xuLySua">
    <input type="hidden" name="id" value="<?php echo $arr['id']; ?>">
    <!-- End gửi dữ liệu ẩn -->
    <div class="form-group">
      <label for="ten-dang-nhap">Tên đăng nhập:</label>
      <input type="text" class="form-control" id="ten-dang-nhap" name="ten_dang_nhap" value="<?php echo $arr['ten_dang_nhap'] ?>" required>
    </div>
    <div class="form-group">
      <label for="mat-khau">Mật khẩu:</label>
      <input type="password" class="form-control" id="mat-khau" name="mat_khau" value="<?php echo $arr['mat_khau'] ?>"  required>
    </div>
    <div class="form-group">
      <label for="ho-ten">Họ và tên:</label>
      <input type="text" class="form-control" id="ho-ten" name="ho_ten" value="<?php echo $arr['ho_ten'] ?>"  required>
    </div>
    <div class="form-group">
      <label for="dia-chi">Địa chỉ:</label>
      <input type="text" class="form-control" id="dia-chi" name="dia_chi" value="<?php echo $arr['dia_chi'] ?>"  required>
    </div>
    <div class="form-group">
      <label for="dien-thoai">Điện thoại:</label>
      <input type="tel" class="form-control" id="dien-thoai" name="dien_thoai" pattern="[0-9]{10,11}"  value="<?php echo $arr['dien_thoai'] ?>" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $arr['email'] ?>"  required>
    </div>
    <div class="form-group">
      <label for="hinh-anh">Hình ảnh:</label>
      <input type="file" class="form-control" id="hinh-anh" name="hinh_anh">
    </div>
    <div class="form-group">
      <label for="loai-nguoi-dung">Loại người dùng:</label>
      <select class="form-control" id="loai-nguoi-dung" name="loai_nguoi_dung" required>
        <option value="">--Chọn loại người dùng--</option>
        <option value="admin">Admin</option>
        <option value="member">Member</option>
      </select>
    </div>
    <div class="form-group">
      <label for="trang-thai">Trạng thái:</label>
      <div class="radio">
        <label><input type="radio" name="trang_thai" value="1" checked>Kích hoạt</label>
      </div>
      <div class="radio">
        <label><input type="radio" name="trang_thai" value="0">Không kích hoạt</label>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Sửa ngưỜi dùng người dùng</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
