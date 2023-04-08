<?php include("view/top.php"); ?>

<br><br>
<div class="container">  
  <div class="row"> 
    <div class="container mt-3">
      
      <table class="table table-borderless" align="center">
        <h2>Giỏ Hàng</h2>
        <?php 
          $gioHang = laygiohang();
          if(count($gioHang) < 1)
            echo '<p>   Giỏ hàng trống</p>';
          else
          {
        ?>
        <thead>
          <tr>
            <th>Điện thoại</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Xoá</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              
              foreach($gioHang as $maDT => $dt)
              {
            ?>
                <tr>
                  <td><img class="img-thumbnail" width="30" src="images/<?php echo $dt["hinh"]; ?>"> <?php echo $dt["tendt"]; ?></td>
                  <td><?php echo number_format($dt["gia"]); ?>đ</td>
                  <td><input class="form-control" name="dt[<?php echo $maDT; ?>]" type="number" value="<?php echo $dt["soluong"]; ?>"></td>
                  <td><?php echo number_format($dt["thanhtien"]).'đ'; ?></td>
                  <td><a class="btn btn-danger" href="?action=xoaSPTrongGio&id=<?php echo $maDT; ?>"><span class="glyphicon glyphicon-trash"></span>Xoá</a></td>
                </tr>
            <?php
              } // end for
            ?>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3"></td>
            <td><b>Tổng tiền: <?php echo number_format(round(tinhtiengiohang(), 2)).'đ'; ?></b></td>
          </tr>
        </tfoot>
        <?php 
          }
        ?>
      </table>
    <td><a class="btn btn-danger" href="?action=thanhToan"><span class=""></span>Thanh toán</a></td>
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