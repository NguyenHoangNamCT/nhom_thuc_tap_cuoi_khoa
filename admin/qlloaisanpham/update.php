<?php
    require("../view/top.php");
?> 
<div>
<!-- <table>
	<tr>
		<td><h3>Quản lý điện thoại</h3></td>
	</tr>
	<tr>
		<td><a href="index.php?action=them" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Thêm mặt hàng</a></td>
	</tr>
</table> -->
<br>
</div>

<?php 
  $arr = $l->layLoaiSanPhamById($id);
?>

<div class="container mt-3">
  <h2>Sửa loại sản phẩm</h2>
  <form method="post" enctype="multipart/form-data">
    <!-- Gửi dữ liệu ẩn -->
    <input type="hidden" name="action" value="xuLySua">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="mb-3 mt-3">
      <label for="">Tên loại sản phẩm:</label>
      <input type="text" class="form-control" placeholder="" name="txtTenLoaiSP" value='<?php echo $arr['ten_loai_san_pham']; ?>'>
    </div>

    <div class="mb-3 mt-3">
      <label for="">Mô tả:</label>
      <input type="text" class="form-control" placeholder="" name="txtMoTa" value="<?php echo $arr['mo_ta']; ?>">
    </div>

    <div class="mb-3 mt-3">
        <label>Hình ảnh</label>
        <input class="form-control" type="file" name="filehinhanh">
    </div>
    
    <button type="submit" class="btn btn-primary">Sửa loại sản phẩm</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
