<?php
    require("../view/top.php");
?> 
<div class="container">
  <h2>Quản lý Thông Tin Đơn Hàng</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm Thông Tin Đơn Hàng</a>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Tên Khách Hàng</th>
          <th>Địa Chỉ Người Nhận</th>
          <th>Số Điện Thoại người Nhận</th>
          <th>Tiền Ship</th>
          <th>Phí Vận Chuyển</th>
          <th>Ghi Chú</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $mangTTDH = $ttdh->layDanhSachThongTinDonHang();
          foreach($mangTTDH as $arr){
        ?>
        <tr>
          <td><?php echo $arr["ten_khach_hang"]; ?></td>
          <td><?php echo $arr["dia_chi_nguoi_nhan"]; ?></td>
          <td><?php echo $arr["so_dien_thoai_nguoi_nhan"]; ?></td>
          <td><?php echo $arr["ngay_giao_hang"]; ?></td>
          <td><?php echo number_format($arr["tien_ship"]).'đ'; ?></td>
          <td><?php echo number_format($arr["phi_van_chuyen"]).'đ'; ?></td>
          <td><?php echo $arr["ghi_chu"]; ?></td>
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
