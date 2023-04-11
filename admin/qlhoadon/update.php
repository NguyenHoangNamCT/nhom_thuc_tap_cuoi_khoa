<?php
    require("../view/top.php");
    $mangDH = $dh->layDanhSachDonHang();
?> 

<?php 
  $arr = $hd->layHoaDonByID($id);
?>


<div class="container mt-3">
  <h2>Update For</h2>


  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="xuLySua">
  <input type="hidden" name="id" value="<?php echo $arr['id']; ?>">

  <div class="mb-3 mt-3">
      <label>ID Đơn Hàng</label>
      <select class="form-control" name="selectDonHang">
        <?php
          foreach($mangDH as $arr_j):
        ?>
          <option <?php if($arr_j['id'] == $arr['id_don_hang']) echo "selected";?> value="<?php echo $arr_j['id']; ?>"><?php echo $arr_j["id"]; ?></option>
        <?php
          endforeach;
        ?>
      </select>
    </div>
	
    <label for="dateNgayTao">Ngày Tạo:</label>
  <div class="input-group date" data-provide="datepicker">
    <input type="datetime-local" class="form-control" id="dateNgayTao" name="dateNgayTao" value="<?php echo $arr['ngay_tao']; ?>">
    <div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
    </div>
  </div>  


    <div class="mb-3 mt-3">
      <label for="">Tổng Tiền:</label>
      <input type="text" class="form-control"  placeholder="" name="txtTongTien" value="<?php echo $arr['tong_tien'] ?>">
    </div>
	
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
