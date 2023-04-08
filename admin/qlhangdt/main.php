<?php
    require("../view/top.php");
?> 
<div class="container-fluid">
<h2>Quản lý hãng điện thoại</h2>
<a href="index.php?action=them" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Thêm hãng điện thoại</a>
<table class="table table-hover">
	<tr>
		<th>Tên hãng điện thoại</th>
		<th>Sửa</th>
		<th>Xóa</th>
	</tr>
	<?php
    $mangHangDT = $h->layHangDT();
	foreach($mangHangDT as $arr)
			if($idSua == $arr['id'])
			{
		?>
			<tr>
				<form method="post">
					<input class="form-control" type="hidden" name="id" value="<?php echo $arr['id']; ?>">
					<input class="form-control" type="hidden" name="action" value="xuLySua">
					<td><input class="form-control" type="text" value="<?php echo $arr["tenhang"]; ?>" name="txtTenHang"></td>
					<td><button type="submit" class="btn btn-success"><span class="bi-check"> </span>Lưu</button></td>
					<td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-trash"></span>Xoá</a></td>
				</form>
			</tr>
		<?php 
			}
			else
			{
		?>
			<tr>
				<td><?php echo $arr["tenhang"]; ?></td>
				<td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-edit"> </span>Sửa</a></td>
				<td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-trash"></span>Xoá</a></td>
			</tr>
		<?php
			}
		?>
</table>
<div class="container">
<form method="post">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="them">
	<!-- -------------- -->
  	<div class="mb-3 mt-3">
      <label for="">Tên hãng:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTenHang">
    </div>
    <button type="submit" class="btn btn-primary">Thêm hãng điện thoại</button>
</form>
</div>
</div>


</div>
<?php
    require("../view/footer.php");
?>
