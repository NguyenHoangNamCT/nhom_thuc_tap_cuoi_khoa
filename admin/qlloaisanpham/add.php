<?php
    require("../view/top.php");
?> 


<div class="container mt-3">
  <h2>Thêm loại sản phẩm</h2>
  <form method="post" enctype="multipart/form-data">
    <!-- Gửi dữ liệu ẩn -->
    <input type="hidden" name="action" value="XuLyThem">
    <div class="mb-3 mt-3">
      <label for="">Tên loại sản phẩm:</label>
      <input type="text" class="form-control" placeholder="" name="txtTenLoaiSP">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Mô tả:</label>
      <input type="text" class="form-control" placeholder="" name="txtMoTa">
    </div>

    <div class="mb-3 mt-3">
        <label>Hình ảnh</label>
        <input class="form-control" type="file" name="filehinhanh">
    </div>
    
    <button type="submit" class="btn btn-primary">Thêm loại sản phẩm</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
