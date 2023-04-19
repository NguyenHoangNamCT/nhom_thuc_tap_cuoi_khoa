<?php
    require("../view/top.php");
?> 

<div class="container mt-3">
  <h2>Thêm Quảng Cáo</h2>
  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="XuLyThem">
  	<div class="mb-3 mt-3">
      <label for="">Tiêu Đề:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTieuDe">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Url:</label>
      <input type="text" class="form-control"  placeholder="" name="txtUrl">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Trạng Thái:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTrangThai">
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
