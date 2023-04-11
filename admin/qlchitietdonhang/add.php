<?php
    require("../view/top.php");
?> 


<div class="container mt-3">
  <h2>Update Form</h2>


  <form method="post" enctype="multipart/form-data">
	<!-- Gửi dữ liệu ẩn -->
	<input type="hidden" name="action" value="XuLyThem">
  <!-- END -->
  <div class="mb-3 mt-3">
      <label>ID Đơn Hàng</label>
      <select class="form-control" name="selectDonHang">
        <?php
          $mangDH = $dh->layDanhSachDonHang();
          foreach($mangDH as $arr_j):
        ?>
          <option value="<?php echo $arr_j['id']; ?>"><?php echo $arr_j["id"]; ?></option>
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
          foreach($mangSP as $arr_i):
        ?>
          <option value="<?php echo $arr_i["id"]; ?>"><?php echo $arr_i["ten_san_pham"]; ?></option>
        <?php
          endforeach;
        ?>
      </select>
    </div>
    
    <div class="mb-3 mt-3">
      <label for="">Số lượng:</label>
      <input type="text" class="form-control"  placeholder="" name="txtSoLuong" >
    </div>

    <div class="mb-3 mt-3">
      <label for="">Đơn Giá:</label>
      <input type="text" class="form-control"  placeholder="" name="txtDonGia" >
    </div>
    
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</div>
<?php
    require("../view/footer.php");
?>
