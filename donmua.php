<?php include("view/top.php"); ?>

<?php 
  $mangSanPhamDaMua = $ctdh->layDanhSachSanPhamDaMuaCuaNguoiDung($_SESSION['nguoiDung']['id']);
  // var_dump($mangSanPhamDaMua);
?>

<br><br>

<div class="container mt-5">
  <h1>Danh sách sản phẩm đã mua</h1>
  <br>
  <div class="row ">
    <!-- sản phẩm 1 -->
    <?php 
      foreach($mangSanPhamDaMua as $arr){
    ?>
    <div class="col-sm-12 py-2">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex">
            <div class="">
              <img width="150" src="images/<?php echo $arr['hinh_anh']; ?>" class="" alt="">
            </div>
            <div class="ps-3">
              <h5 class="card-title"><?php echo $arr['ten_san_pham'] ?></h5>
              <div class="d-flex">
                <p class="card-text"><del><?php echo number_format($arr['gia_tien']).'đ'; ?></del><p class="px-1" style="color: red;"><?php echo $arr['don_gia'].'đ'; ?></p></p>
              </div>
              <p class="card-text">Số lượng: <?php echo $arr['so_luong']; ?></p>
              <p class="card-text"><small class="text-muted">Đã mua lúc: <?php echo $arr['ngay_dat']; ?></small></p>
            </div>
          </div>
          <div class="d-flex">
            <div class="ms-auto">
              <a href="" class = "btn btn-success ms-2">Xem đánh giá</a>
              <a href="" class = "btn btn-warning ms-2">Đã nhận hàng</a>
              <a href="" class = "btn btn-danger ms-2">Huỷ đơn</a>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <?php 
      }
    ?>
  </div>
</div>


<?php include('view/footer.php'); ?>