<?php
    require("../view/top.php");
?> 
<div class="container">
  <h2>Quản lý Quảng cáo</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm Quảng cáo</a>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Tiêu đề</th>
          <th>Url</th>
          <th>Trạng thái</th>
          <th>Hình ảnh</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $mangQC = $qc->layDanhSachQuangCao();
          foreach($mangQC as $arr){
        ?>
        <tr>
          <td><?php echo $arr["tieu_de"]; ?></td>
          <td><?php echo $arr["url"]; ?></td>
          <td><?php if($arr["trang_thai"] == 0) echo "Trong Thời Gian"; else echo "Ngoài Thời Gian"; ?></td>
          <td><img src="../../images/<?php echo $arr["hinh_anh"]; ?>" width="80" class="img-thumbnail"></td>
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
