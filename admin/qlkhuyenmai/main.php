<?php
    require("../view/top.php");
?> 
<div class="container">
  <h2>Quản lý khuyến mãi</h2>
  <a href="?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm khuyến mãi</a>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Tên khuyến mãi</th>
          <th>Mô tả</th>
          <th>Ngày bắt đầu</th>
          <th>Ngày kết thúc</th>
          <th>Trạng thái</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $mangKM = $km->layDanhSachKhuyenMai();
          foreach($mangKM as $arr){
        ?>
        <tr>
          <td><?php echo $arr["ten_khuyen_mai"]; ?></td>
          <td><?php echo $arr["mo_ta"]; ?></td>
          <td><?php echo date("d/m/Y", strtotime($arr["ngay_bat_dau"])); ?></td>
          <td><?php echo date("d/m/Y", strtotime($arr["ngay_ket_thuc"])); ?></td>
          <td><?php if($arr["trang_thai"] == 1) echo "Đang áp dụng"; else echo "Ngừng áp dụng"; ?></td>
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
