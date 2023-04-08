<?php
    require("../view/top.php");
?> 
<div class="container">
  <h2>Quản lý sản phẩm</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm sản phẩm</a>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Tên Người DÙng</th>
          <th>Ngày Đặt</th>
          <th>Địa Chỉ Giao Hàng</th>
          <th>Điện Thoại Người Nhận</th>
          <th>Họ Tên Người Nhận</th>
          <th>Tổng Tiền</th>
          <th>Tình Trang Đơn Hàng</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $mangDH = $dh->layDanhSachDonHangCoTenNguoiDung();
          foreach($mangDH as $arr){
        ?>
        <tr>
          <td><?php echo $arr["ho_ten"]; ?></td>
          <td><?php echo $arr["ngay_dat"]; ?></td>
          <td><?php echo $arr["dia_chi_giao_hang"]; ?></td>
          <td><?php echo $arr["dien_thoai_nguoi_nhan"]; ?></td>
          <td><?php echo $arr["ho_ten_nguoi_nhan"]; ?></td>
          <td><?php echo number_format($arr["tong_tien"]).'đ'; ?></td>
          <td><?php if($arr["tinh_trang_don_hang"] == 1 ) echo "Chưa Giao"; else echo "Đã Giao"; ?></td>
          <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-edit"></span> Sửa</a></td>
          <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-trash"></span> Xoá</a></td>
        </tr>
        <?php
            }
        ?>
      </tbody>
    </table>
  </div>
</div>

</div>
<?php
    require("../view/footer.php");
?>