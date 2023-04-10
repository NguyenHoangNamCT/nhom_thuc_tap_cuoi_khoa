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
  $arr = $qc->layQuangCaoById($id);
?>

<div class="container mt-3">
  <h2>Update Form</h2>


  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="xuLySua">
  <input type="hidden" name="id" value="<?php echo $arr['id']; ?>">
  	<div class="mb-3 mt-3">
      <label for="">Tiêu Đề:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTieuDe" value="<?php echo $arr['tieu_de'] ?>">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Url:</label>
      <input type="text" class="form-control"  placeholder="" name="txtUrl" value="<?php echo $arr['url'] ?>">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Trạng Thái:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTrangThai" value="<?php echo $arr['trang_thai'] ?>">
    </div>
	
    <div class="mb-3 mt-3">
      <label>Hình ảnh</label>
      <input class="form-control" type="file" name="filehinhanh">
  </div>
    
    
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
