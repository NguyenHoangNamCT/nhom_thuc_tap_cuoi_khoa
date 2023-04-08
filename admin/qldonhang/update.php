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

<?php 
  $arr = $dh->layDonHangById($id);
?>

<div class="container mt-3">
  <h2>Update Form</h2>


  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="xuLySua">
  <input type="hidden" name="id" value="<?php echo $arr['id']; ?>">

  
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Ngày Đặt:</label>
      <input type="text" class="form-control"  placeholder="" name="txtNgayDat" value="<?php echo $arr['ngay_dat'] ?>">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Địa chỉ Giao Hàng:</label>
      <input type="text" class="form-control"  placeholder="" name="txtDiaChiGH" value="<?php echo $arr['dia_chi_giao_hang'] ?>">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Số Điện Thoại Người Nhận:</label>
      <input type="text" class="form-control"  placeholder="" name="txtDienThoaiNN" value="<?php echo $arr['dien_thoai_nguoi_nhan'] ?>">
    </div>
	
    <div class="mb-3 mt-3">
      <label for="">Họ Tên Người Nhận:</label>
      <input type="text" class="form-control"  placeholder="" name="txtHotenNN" value="<?php echo $arr['ho_ten_nguoi_nhan'] ?>">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Tổng Tiền:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTongTien" value="<?php echo $arr['tong_tien'] ?>">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Tình Trang Đơn Hàng:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTìnhTrangDH" value="<?php echo $arr['tinh_trang_don_hang'] ?>">
    </div>

    
	
   
    
    
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
