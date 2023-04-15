<?php
    require("../view/top.php");
?> 


<?php 
  $arr = $ttdh->layThongTinDonHangById($id_don_hang);
?>

<div class="container mt-3">
  <h2>Thêm Thông tin đơn hàng</h2>


  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="XuLyThemTTDH">
  <input type="hidden" name="id" value="<?php echo $arr['id']; ?>">
  <!-- END -->
  	
  
  <div class="mb-3 mt-3">
      <label for="">ID đơn hàng:</label>
      <input type="text" class="form-control"  placeholder="" name="txtIddonhang" value="<?php echo $id_don_hang; ?>">
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
    <input type="datetime-local" class="form-control" id="dateNgayGiaoHang" name="dateNgayGiaoHang" ">
    <div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
    </div>
  </div>  

   

    <div class="mb-3 mt-3">
      <label for="">Phí Vận Chuyển</label>
      <input type="text" class="form-control"  placeholder="" name="txtPhiVanChuyen" >
    </div>

    <div class="mb-3 mt-3">
      <label for="">Ghi Chú:</label>
      <input type="text" class="form-control"  placeholder="" name="txtGhiChu">
    </div>
    
    
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
