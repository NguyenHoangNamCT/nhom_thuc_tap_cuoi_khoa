<?php include("view/top.php"); ?>

<?php 
  $mangDonHangDaMua = $dh->layDanhSachDonHangDaMuaCuaNguoiDung($_SESSION['nguoiDung']['id']);
  // var_dump($mangSanPhamDaMua);
?>

<br><br>

<div class="container mt-5">
  <h1>Danh sách sản phẩm đã mua</h1>
  <br>
  <div class="row ">
    <!-- sản phẩm 1 -->
    <?php 
      $mangDonHang = $dh->layDanhSachDonHangTheoIDNguoiDung($_SESSION['nguoiDung']['id']);
      foreach($mangDonHang as $arr_i){
        // $dh->xoaDonHangVipPro($arr_i['id']); //nếu muốn xoá hết đơn hàng của người dùng này thì mới mở dòng này ra
    ?>
    <div class="col-sm-12 py-2">
      <div class="card h-100">
        <div class="card-body">
          <?php 
            $count = 0;
            foreach($mangDonHangDaMua as  $arr)
              if($arr_i['id'] == $arr['id_don_hang']){ 
                if($count++ != 0)
                  echo '<hr class="border-bottom">';
          ?>
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
          <?php 
            }
          ?>
          <hr class="border-bottom">
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