<?php
    require("../view/top.php");
?> 

<?php 
  $mangLoai = $l->layLoaiSP();
  $mangThuongHieu = $th->layThuongHieu();
  $arr = $sp->laySanPhamTheoID($id);
?>

<div class="container mt-3">
  <h2>Update Form</h2>


  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="xuLySua">
  <input type="hidden" name="id" value="<?php echo $arr['id']; ?>">
  	<div class="mb-3 mt-3">
      <label for="">Tên sản phẩm:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTenSP" value="<?php echo $arr['ten_san_pham'] ?>">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Giá tiền:</label>
      <input type="text" class="form-control"  placeholder="" name="txtGiaTien" value="<?php echo $arr['gia_tien'] ?>">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Giảm giá:</label>
      <input type="text" class="form-control"  placeholder="" name="txtGiamGia" value="<?php echo $arr['giam_gia'] ?>">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Số lượng:</label>
      <input type="number" class="form-control"  placeholder="" name="txtSoLuong" value="<?php echo $arr['so_luong'] ?>">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Mô tả:</label>
      <input type="text" class="form-control"  placeholder="" name="txtMoTa" value="<?php echo $arr['mo_ta'] ?>">
    </div>

    <div class="mb-3 mt-3">
      <label>Loại sản phẩm</label>
      <select class="form-control" name="selectLoaiSanPham">
        <?php
          foreach($mangLoai as $arr_i):
        ?>
          <option <?php if($arr_i['id'] == $arr['id_loai_san_pham']) echo 'selected'; ?> value="<?php echo $arr_i["id"]; ?>"><?php echo $arr_i["ten_loai_san_pham"]; ?></option>
        <?php
          endforeach;
        ?>
      </select>
    </div>	

    <div class="mb-3 mt-3">
      <label>Thương hiệU</label>
      <select class="form-control" name="selectThuongHieu">
        <?php
          foreach($mangThuongHieu as $arr_i):
        ?>
          <option <?php if($arr_i['id'] == $arr['id_thuong_hieu']) echo 'selected'; ?> value="<?php echo $arr_i["id"]; ?>"><?php echo $arr_i["TenThuongHieu"]; ?></option>
        <?php
          endforeach;
        ?>
      </select>
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
