<?php
    require("../view/top.php");

    if(isset($_REQUEST['trangHienTai']))
      $trangHienTai = $_REQUEST['trangHienTai'];
    else
      $trangHienTai = 1;

    //đếm số lượng hd có trong database
    $tonghd = $hd-> laySoLuongHoaDon();
    //số lượng hd trong mộT trang
    $soLuong = 10;
    //làm tròn lên 
    $tongsotrang = ceil($tonghd / $soLuong);
?> 
<div class="container">
  <h2>Quản lý hoá đơn</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm hoá đơn</a>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID Đơn Hàng</th>
          <th>Ngày tạo</th>
          <th>Tổng Tiền</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $mangHD = $hd->layHoaDonPhanTrang($trangHienTai, $soLuong);
          foreach($mangHD as $arr){
        ?>
        <tr>
          <td><?php echo $arr["id_don_hang"]; ?></td>
          <td><?php echo $arr["ngay_tao"]; ?></td>
          <td><?php echo number_format($arr["tong_tien"]).'đ'; ?></td>

         
          <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-edit"></span> Sửa</a></td>
          <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-trash"></span> Xoá</a></td>
        </tr>
        <?php
            }
        ?>
      </tbody>
    </table>
  </div>
  <?php 
    require("../../view/carousel.php");
  ?>
</div>

</div>
<?php
    require("../view/footer.php");
?>
