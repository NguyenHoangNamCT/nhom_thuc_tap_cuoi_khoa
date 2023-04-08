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
          <th>Tên sản phẩm</th>
          <th>Giá tiền</th>
          <th>Giảm giá</th>
          <th>Loại sản phẩm</th>
          <th>Thương hiệu</th>
          <th>So lượng</th>
          <th>Trạng thái</th>
          <th>Mô tả</th>
          <th>Hình ảnh</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $mangSP = $sp->layDanhSachSanPham();
          foreach($mangSP as $arr){
        ?>
        <tr>
          <td><?php echo $arr["ten_san_pham"]; ?></td>
          <td><?php echo number_format($arr["gia_tien"]).'đ'; ?></td>
          <td><?php echo number_format($arr["giam_gia"]).'%'; ?></td>
          <td><?php echo $arr["ten_loai_san_pham"]; ?></td>
          <td><?php echo $arr["tenthuonghieu"]; ?></td>
          <td><?php echo $arr["so_luong"]; ?></td>
          <td><?php if($arr["so_luong"] > 0) echo "Còn hàng"; else echo "Hết hàng"; ?></td>
          <td><?php echo $arr["mo_ta"]; ?></td>
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
