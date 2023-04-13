<?php include("view/top.php"); ?>

<br><br>
<div class="container">  
  <div class="row"> 
    <div class="container mt-3">
      <?php 
        //nếu cập nhật số lương thành công thì thông báo
        if(isset($capNhatThanhCong))
          echo '
          <div class="alert alert-success">
            Cập nhật giỏ hàng <strong>Thành công.</strong>
          </div>
          ';
      ?>
      <table class="table table-borderless" align="center">
        <h2>Giỏ Hàng</h2>
        <?php 
          $mangGioHang = $gh->layGioHang($_SESSION['nguoiDung']['id']);
          if(count($mangGioHang) < 1)
            echo '<p>   Giỏ hàng trống</p>';
          else
          {
        ?>
        <thead>
          <tr>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá tiền</th>
            <th>Thành tiền</th>
            <th>Xoá</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              
              foreach($mangGioHang as $arr)
              {
            ?>
                <form method="post">
                  <!-- Gửi dữ liệu ẩn -->
                  <input type="hidden" name="action" value="capNhatSoLuong">
                  <!-- END -->
                  <tr>
                    <td><?php echo $arr["ten_san_pham"]; ?></td>
                    <td><img class="img-thumbnail" width="75" src="images/<?php echo $arr["hinh_anh"]; ?>"></td>
                    <!-- Gửi số lượng của từng sản phẩm giỏ hàng theo cách txtSoLuong+id_san_pham -->
                    <td><input type="number" class="form-control"  placeholder="" name="<?php echo "txtSoLuong".$arr['id_san_pham']; ?>" value="<?php echo $arr["so_luong"]; ?>"></td>
                    <td><?php echo number_format($arr["gia_tien"]).'đ'; ?></td>
                    <td><?php echo $arr["gia_tien"]*$arr["so_luong"]; ?></td>
                    <td><a class="btn btn-danger" href="?action=xoaSPTrongGio&idSanPham=<?php echo $arr["id_san_pham"]; ?>"><span class="glyphicon glyphicon-trash"></span>Xoá</a></td>
                  </tr>
            <?php
              } // end for
            ?>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3"></td>
            <td><b>Tổng tiền: <?php echo number_format(round(GIOHANG::tinhThanhTien($mangGioHang), 2)).'đ'; ?></b></td>
          </tr>
        </tfoot>
        <?php 
          }
        ?>
      </table>
    <td><button type="submit" class="btn btn-success">Cập nhật số lượng</button></td>
    <td><a class="btn btn-warning" href="?action=thanhToan"><span class=""></span>Thanh toán</a></td>
                </form>
    </div>

  </div>

  
    <!-- <div class = "row" align="center">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </div> -->


<!-- <div class="row">
	<ul class="pagination">
		<li><a href="index.php?trang=1"><span class="glyphicon glyphicon-step-backward"></span></a></li>
	<?php
	//for($i=1; $i<=$tongsotrang; $i++){
	?>	
		<li <?php //if($tranghh == $i) echo " class=\"active\"" ?>>
		<a href="index.php?trang=<?php //echo $i; ?>"><?php //echo $i; ?></a></li>
	<?php	
	//}
	?>
		<li><a href="index.php?trang=<?php //echo $tongsotrang; ?>"><span class="glyphicon glyphicon-step-forward"></span></a></li>
	</ul>
</div> -->
  
  <?php //include("topview.php"); ?>
  

</div>

<?php //include("view/carousel.php"); ?>
<?php //include("view/bottom.php"); ?>