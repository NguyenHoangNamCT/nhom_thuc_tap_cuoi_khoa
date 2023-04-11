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
  <h2>Thêm chi tiết đơn hàng</h2>
  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="XuLyThem">
  <div class="mb-3 mt-3">
      <label>ID Đơn Hàng</label>
      <select class="form-control" name="selectDonHang">
        <?php
          $mangDH = $dh->layDanhSachDonHang();
          foreach($mangDH as $arr):
        ?>
         <option value="<?php echo $arr["id"]; ?>"><?php echo $arr["id_don_hang"]; ?></option>
        <?php
          endforeach;
        ?>
      </select>
    </div>

    <div class="mb-3 mt-3">
      <label>ID Sản phẩm</label>
      <select class="form-control" name="selectSanPham">
        <?php
          $mangSP = $sp->layDanhSachSanPham();
          foreach($mangSP as $arr):
        ?>
         <option value="<?php echo $arr["id"]; ?>"><?php echo $arr["ten_san_pham"]; ?></option>
        <?php
          endforeach;
        ?>
      </select>
    </div>

    <div class="mb-3 mt-3">
      <label for="">Số lượng:</label>
      <input type="text" class="form-control"  placeholder="" name="txtSoLuong" id="txtSoLuong">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Đơn Giá:</label>
      <input type="text" class="form-control"  placeholder="" name="txtDonGia" id="txtDonGia">
    </div>


	
    
    
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
