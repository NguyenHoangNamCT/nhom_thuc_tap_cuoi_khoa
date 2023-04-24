<?php
    require("../view/top.php");
?> 


<?php 
  $arr = $lh->layLienHeById($id);
?>

<div class="container mt-3">
  <h2>Update Form</h2>


  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="xuLySua">
  <input type="hidden" name="id" value="<?php echo $arr['id']; ?>">
  	<div class="mb-3 mt-3">
      <label for="">Họ Tên:</label>
      <input type="text" class="form-control"  placeholder="" name="txtHoTen" value="<?php echo $arr['ho_ten'] ?>">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Email:</label>
      <input type="text" class="form-control"  placeholder="" name="txtEmail" value="<?php echo $arr['email'] ?>">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Số Điện Thoại:</label>
      <input type="text" class="form-control"  placeholder="" name="txtSoDienThoai" value="<?php echo $arr['so_dien_thoai'] ?>">
    </div>
	

	
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
