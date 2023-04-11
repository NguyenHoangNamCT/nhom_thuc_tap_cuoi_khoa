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
  $arr = $ttdh->layThongTinDonHangById($id);
?>

<div class="container mt-3">
  <h2>Update Form</h2>


  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="xuLySua">
  <input type="hidden" name="id" value="<?php echo $arr['id']; ?>">
  <!-- END -->
  	
    <div class="mb-3 mt-3">
      <label>ID Đơn Hàng</label>
      <select class="form-control" name="selectDonHang">
        <?php
          $mangDH = $dh->layDanhSachDonHang();
          foreach($mangDH as $arr_i):
        ?>
          <option <?php if($arr_i['id'] == $arr['id']) echo 'selected'; ?> value="<?php echo $arr_i["id"]; ?>"><?php echo $arr_i["id"]; ?></option>
        <?php
          endforeach;
        ?>
      </select>
    </div>

    <div class="mb-3 mt-3">
      <label for="">Tên Khách hàng:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTenKH" value="<?php echo $arr['ten_khach_hang'] ?>">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Địa chỉ người Nhận:</label>
      <input type="text" class="form-control"  placeholder="" name="txtDiaChiNN" value="<?php echo $arr['dia_chi_nguoi_nhan'] ?>">
    </div>


    <div class="mb-3 mt-3">
      <label for="">Số Điện Thoại Người Nhận:</label>
      <input type="text" class="form-control"  placeholder="" name="txtSoDienThoaiNN" value="<?php echo $arr['so_dien_thoai_nguoi_nhan'] ?>">
    </div>

    <label for="dateNgayGiaoHang">Ngày Giao Hàng:</label>
  <div class="input-group date" data-provide="datepicker">
    <input type="datetime-local" class="form-control" id="dateNgayGiaoHang" name="dateNgayGiaoHang" value="<?php echo $arr['ngay_giao_hang']; ?>">
    <div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
    </div>
  </div>  

    <div class="mb-3 mt-3">
      <label for="">Tiền Ship:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTienShip" value="<?php echo $arr['tien_ship'] ?>">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Phí Vận Chuyển</label>
      <input type="text" class="form-control"  placeholder="" name="txtPhiVanChuyen" value="<?php echo $arr['phi_van_chuyen'] ?>">
    </div>

    <div class="mb-3 mt-3">
      <label for="">Ghi Chú:</label>
      <input type="text" class="form-control"  placeholder="" name="txtGhiChu" value="<?php echo $arr['ghi_chu'] ?>">
    </div>
    
    
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
