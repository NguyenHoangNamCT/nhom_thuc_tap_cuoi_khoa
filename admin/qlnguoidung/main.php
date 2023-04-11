<?php 
    include("../view/top.php");
?>
  <div class="container">
  <div>
      <?php if(isset($thongBao)){ ?>
        <div class="alert alert-info">
          <strong><?php echo $thongBao; ?></strong>.
        </div>
      <?php } ?>
    </div>
  <h2>Quản lý người dùng</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm người dùng</a>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
          <tr>
              <th>ID</th>
              <th>Tên đăng nhập</th>
              <th>Họ tên</th>
              <th>Địa chỉ</th>
              <th>Điện thoại</th>
              <th>Email</th>
              <th>Ngày đăng ký</th>
              <th>Loại người dùng</th>
			        <th>Hình ảnh</th>
              <th>Trạng thái</th>
              <th>Sửa</th>
              <th>Xóa</th>
          </tr>
      </thead>
      <tbody>
        
          <?php 
          $mangND = $nd->layTatCaNguoiDung();
            foreach ($mangND as $arr) { 
          ?>
          <tr>
              <td><?php echo $arr['id']; ?></td>
              <td><?php echo $arr['ten_dang_nhap']; ?></td>
              <td><?php echo $arr['ho_ten']; ?></td>
              <td><?php echo $arr['dia_chi']; ?></td>
              <td><?php echo $arr['dien_thoai']; ?></td>
              <td><?php echo $arr['email']; ?></td>
              <td><?php echo $arr['ngay_dang_ky']; ?></td>
              <td><?php echo $arr['loai_nguoi_dung']; ?></td>
			  <td><img src="../../images/<?php echo $arr['hinh_anh']; ?>" alt="<?php echo $arr['ho_ten']; ?>" width="100"></td>
              <td><?php echo ($arr['trang_thai'] == 1) ? 'Kích hoạt' : 'Không kích hoạt'; ?></td>
              <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-edit"></span> Sửa</a></td>
              <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-trash"></span> Xoá</a></td>
          </tr>
          <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php 
    include("../view/footer.php");
?>