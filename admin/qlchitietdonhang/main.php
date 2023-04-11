<?php
    require("../view/top.php");
?> 
<div class="container">
  <h2>Quản lý Chi Tiết Đơn Hàng</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm Chi tiết Đơn hàng</a>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID Đơn Hàng</th>
          <th>ID Sản Phẩm</th>
          <th>Số lượng</th>
          <th>Đơn Giá</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $mangCTDH = $ctdh->layDanhSachChiTietDonHang();
          foreach($mangCTDH as $arr){
        ?>
        <tr>
          <td><?php echo $arr["id_don_hang"]; ?></td>
          <td><?php echo $arr["ten_san_pham"]; ?></td>
          <td><?php echo $arr["so_luong"]; ?></td>
          <td><?php echo number_format($arr["don_gia"]).'đ'; ?></td>
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