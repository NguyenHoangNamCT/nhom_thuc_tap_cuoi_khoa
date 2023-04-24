<?php
    require("../view/top.php");

    if(isset($_REQUEST['trangHienTai']))
      $trangHienTai = $_REQUEST['trangHienTai'];
    else
      $trangHienTai = 1;

    //đếm số lượng lh có trong database
    $tonglh = $lh-> laySoLuongLienHe();
    //số lượng lh trong mộT trang
    $soLuong = 10;
    //làm tròn lên 
    $tongsotrang = ceil($tonglh / $soLuong);
?> 
<div class="container">
  <h2>Quản lý Liên Hệ</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm Liên Hệ</a>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Họ Tên</th>
          <th>Email</th>
          <th>Số Điện Thoại</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $mangLH = $lh->layLienHePhanTrang($trangHienTai, $soLuong);
          foreach($mangLH as $arr){
        ?>
        <tr>
          <td><?php echo $arr["ho_ten"]; ?></td>
          <td><?php echo $arr["email"]; ?></td>
          <td><?php echo $arr["so_dien_thoai"]; ?></td>
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
