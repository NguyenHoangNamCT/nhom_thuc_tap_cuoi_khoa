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


<div class="container mt-3">
  <h2>Thêm Thương hiệu</h2>
  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="XuLyThem">
  	<div class="mb-3 mt-3">
      <label for="">Tên Thương Hiệu:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTenTH">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Mô tả:</label>
      <input type="text" class="form-control" placeholder="" name="txtMoTa">
    </div>
    <div class="mb-3 mt-3">
      <label for="">Trang Web:</label>
      <input type="text" class="form-control" placeholder="" name="txtTrangweb">
    </div>

    <div class="mb-3 mt-3">
        <label>Logo</label>
        <input class="form-control" type="file" name="filehinhanh">
    </div>
    
    <button type="submit" class="btn btn-primary">Thêm Thương Hiệu</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>