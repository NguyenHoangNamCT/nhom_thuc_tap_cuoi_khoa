<?php 
    include("../view/top.php");
    $mangNguoiDung = $nd->laydanhsachnguoidung();
?>
    <div class="container-fluid">
        <form method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="text" name="txtEmail"
            placeholder="Email"
            require>
          </div>
          
          <div class="form-group">
            <label>Họ tên</label>
            <input class="form-control" type="text" name="txtHoTen"
            placeholder="Họ tên"
            required>
          </div>

          <div class="form-group">
            <label>Số điện thoại</label>
            <input class="form-control" type="number" name="txtDienThoai"
            placeholder="Số điện thoại"
            require>
          </div>

          <div class="form-group">
            <label>Mật khẩu</label>
            <input class="form-control" type="password" name="txtMatKhau"
            placeholder="Mật khẩu">
          </div>

          <div class="form-group">
            <label>Địa chỉ</label>
            <input class="form-control" type="text" name="txtDC"
            placeholder="Địa chỉ"
            require>
          </div>

          <div class="mb-3 mt-3">
            <label>Hình ảnh</label>
            <input class="form-control" type="file" name="filehinhanh">
          </div>

          <div class="form-group">
              <label>Quyền</label>
              <select class="form-control" name="selectLoai">
                  <option value="">--Chọn quyền--</option>
                  <option value="1">Quản trị</option>
                  <option value="2">Nhân viên</option>
                  <option value="3">Người dùng</option>
              </select>
          </div>

          <div class="form-group">
            <!-- Gửi action qua cho index trong kiểm tra người dùng (trong trường hợp này file top này đang nằm trong index của ktnguoidung) -->
            <input type="hidden" name="action" value="themNguoiDung" >
            <input class="btn btn-primary" type="submit" value="Lưu">
            <input class="btn btn-warning" type="reset" value="Điền lại">
          </div>
        </form>
  </div>
<?php 
    include("../view/footer.php");
?>