<?php
    require("../view/top.php");
?> 
<div class="container mt-3">
  <h2>Thêm sản phẩm</h2>
  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="XuLyThem">
  	<div class="mb-3 mt-3">
      <label for="">Tên sản phẩm:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTenSP">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Giá tiền:</label>
      <input type="text" class="form-control"  placeholder="" name="txtGiaTien">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Giảm giá:</label>
      <input type="text" class="form-control"  placeholder="" name="txtGiamGia">
    </div>
	
    <div class="mb-3 mt-3">
      <label>Loại sản phẩm</label>
      <select class="form-control" name="selectLoaiSanPham">
        <?php
          $mangLoai = $l->layLoaiSP();
          foreach($mangLoai as $arr):
        ?>
          <option value="<?php echo $arr["id"]; ?>"><?php echo $arr["ten_loai_san_pham"]; ?></option>
        <?php
          endforeach;
        ?>
      </select>
    </div>	

    <div class="mb-3 mt-3">
      <label>Thương hiệU</label>
      <select class="form-control" name="selectThuongHieu">
        <?php
          $mangThuongHieu = $th->layThuongHieu();
          foreach($mangThuongHieu as $arr):
        ?>
          <option value="<?php echo $arr["id"]; ?>"><?php echo $arr["TenThuongHieu"]; ?></option>
        <?php
          endforeach;
        ?>
      </select>
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Số lượng:</label>
      <input type="number" class="form-control"  placeholder="" name="txtSoLuong">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Mô tả:</label>
      <input type="text" class="form-control"  placeholder="" name="txtMoTa">
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
