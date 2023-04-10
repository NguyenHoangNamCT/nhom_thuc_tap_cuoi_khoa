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
          <th>Họ Tên</th>
          <th>Email</th>
          <th>Số Điện Thoại</th>
          <th>Nội Dung</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $mangLH = $lh->layDanhSachLienHe();
          foreach($mangLH as $arr){
        ?>
        <tr>
          <td><?php echo $arr["ho_ten"]; ?></td>
          <td><?php echo $arr["email"]; ?></td>
          <td><?php echo $arr["so_dien_thoai"]; ?></td>
          <td><?php echo $arr["noi_dung"]; ?></td>
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
