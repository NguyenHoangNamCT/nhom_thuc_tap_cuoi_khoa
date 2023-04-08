<?php
    require("../view/top.php");
?> 
<div class="container">
  <h2>Quản lý loại sản phẩm</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm loại sản phẩm</a>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
          <tr>
              <th>ID</th>
              <th>Tên loại sản phẩm</th>
              <th>Mô tả</th>
              <th>Trạng thái</th>
              <th>Hình ảnh</th>
              <th>Sửa</th>
              <th>Xóa</th>
          </tr>
      </thead>
      <tbody>
        
          <?php 
          $mangLoai = $l->layLoaiSP();
            foreach ($mangLoai as $arr) { 
          ?>
          <tr>
              <td><?php echo $arr['id']; ?></td>
              <td><?php echo $arr['ten_loai_san_pham']; ?></td>
              <td><?php echo $arr['mo_ta']; ?></td>
              <td><?php echo ($arr['trang_thai'] == 1) ? 'Kích hoạt' : 'Không kích hoạt'; ?></td>
              <td><img src="../../images/<?php echo $arr['hinh_anh']; ?>" alt="<?php echo $arr['ten_loai_san_pham']; ?>" width="100"></td>
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
