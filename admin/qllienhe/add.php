<?php
    require("../view/top.php");
?> 



<div class="container mt-3">
  <h2>Thêm Liên Hệ</h2>
  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="XuLyThem">
  	<div class="mb-3 mt-3">
      <label for="">Họ tên:</label>
      <input type="text" class="form-control"  placeholder="" name="txtHoTen">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Email:</label>
      <input type="text" class="form-control"  placeholder="" name="txtEmail">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Số Điên Thoại:</label>
      <input type="text" class="form-control"  placeholder="" name="txtSoDienThoai">
    </div>
	
    
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
