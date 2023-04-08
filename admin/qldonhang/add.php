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
  <h2>Thêm Đơn Hàng</h2>
  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="XuLyThem">

  <div class="mb-3 mt-3">
      <label>Tên người dùng</label>
      <select class="form-control" name="selectTenNguoiDung">
        <?php
          $mangNguoiDung = $nd->laytatcanguoidung();
          foreach($mangNguoiDung as $arr):
        ?>
          <option value="<?php echo $arr["id"]; ?>"><?php echo $arr["ho_ten"]; ?></option>
        <?php
          endforeach;
        ?>
      </select>
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Ngày Đặt:</label>
      <input type="text" class="form-control"  placeholder="" name="txtNgayDat">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Địa Chỉ Giao Hàng:</label>
      <input type="text" class="form-control"  placeholder="" name="txtDiaChiGH">
    </div>

	
    <div class="mb-3 mt-3">
      <label for="">Điện Thoại Người Nhận:</label>
      <input type="text" class="form-control"  placeholder="" name="txtDienThoai">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Họ Tên Người Nhận:</label>
      <input type="text" class="form-control"  placeholder="" name="txtHoTenNN">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Tổng Tiền:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTongTien">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Tình Trạng Đơn Hàng:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTinhTrangDH">
    </div>

    
    
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
