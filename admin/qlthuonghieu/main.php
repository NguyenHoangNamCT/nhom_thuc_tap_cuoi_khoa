<?php
    require("../view/top.php");
?> 
<div class="container">
  <h2>Quản lý Thương hiệu</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm loại Thương hiệu</a>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
          <tr>
              <th>ID</th>
              <th>Tên Thương hiệu</th>
              <th>Mô tả</th>
              <th>Trang Web</th>
              <th>Logo</th>
              <th>Sửa</th>
              <th>Xóa</th>
          </tr>
      </thead>
      <tbody>
        
          <?php 
          $mangth = $th->layThuongHieu();
            foreach ($mangth as $arr) { 
          ?>
          <tr>
              <td><?php echo $arr['id']; ?></td>
              <td><?php echo $arr['TenThuongHieu']; ?></td>
              <td><?php echo $arr['MoTa']; ?></td>
              <td><?php echo $arr['TrangWeb']; ?></td>
              <td><img src="../../images/<?php echo $arr['Logo']; ?>" alt="<?php echo $arr['TenThuongHieu']; ?>" width="100"></td>
              <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-edit"></span> Sửa</a></td>
              <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-trash"></span> Xoá</a></td>
          </tr>
          <?php } ?>
      </tbody>
    </table>
  </div>
</div>

</div>
<?php
    require("../view/footer.php");
?>
