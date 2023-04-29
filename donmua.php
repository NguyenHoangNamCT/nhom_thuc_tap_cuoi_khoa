<?php include("view/top.php"); ?>

<?php 

  //Chỗ này lấy danh sách đơn hàng đã mua của người dùng nhưng join 3 bảng là sản phẩm, hoá đơn, chi tiếT hoá đơn
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
      //chỗ này lấy danh sách đơn hàng theo id của người dùng
      $mangDonHang = $dh->layDanhSachDonHangTheoIDNguoiDung($_SESSION['nguoiDung']['id']);
      foreach($mangDonHang as $arr_i){
        // $dh->xoaDonHangVipPro($arr_i['id']); //nếu muốn xoá hết đơn hàng của người dùng này thì mới mở dòng này ra
    ?>
    <div class="col-sm-12 py-2">
      <div class="card h-100">
      <?php 
        if($arr_i['da_huy'] == 0){ 
      ?>
      <div class="d-flex card-header bg-warning">
        <h5>Tình trạng đơn hàng: <?php if($arr_i['tinh_trang_don_hang'] == 0) echo "Chưa thanh toán"; else if($arr_i['tinh_trang_don_hang'] == 1) echo "Đã thanh toán"; else if($arr_i['tinh_trang_don_hang'] == 2) echo "Đang giao"; else echo "Đã giao"; ?> </h5>
        <!-- <p class="ms-auto"></p> -->
      </div>
      <?php 
        }
        else
        {
      ?>
      <div class="d-flex card-header bg-danger">
        <h5>Tình trạng đơn hàng: Đã huỷ </h5>
        <!-- <p class="ms-auto"></p> -->
      </div>
      <?php 
        }
      ?>
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
                    <a href="?action=xemChiTiet&id=<?php echo $arr['id_san_pham']; ?>"><img style="width: 135px; height: 135px; object-fit: cover;" src="images/<?php echo $arr['hinh_anh']; ?>" class="" alt=""></a>
                  </div>
                  <div class="container ps-3">
                    <p class="card-title"><b><?php echo $arr['ten_san_pham'] ?></b></p>
                    <div class="d-flex">
                      <p class="card-text">Đơn giá: <del><?php echo number_format($arr['gia_tien']).'đ'; ?></del><p class="px-1" style="color: red;"><?php echo number_format($arr['don_gia']).'đ'; ?></p></p>
                    </div>
                    <p class="card-text">Số lượng: <?php echo $arr['so_luong']; ?></p>
                    <div class="d-flex">
                      <p>Thành tiền: <?php echo number_format($arr['don_gia']*$arr['so_luong']).'đ'; ?></p>
                      <?php
                        $luotMua = $ctdh->demSoLuotMuaSanPham($_SESSION['nguoiDung']['id'], $arr['id_san_pham']);
                        $luotDanhGia = $dg->demSoDanhGiaCuaNguoiDungChoSanPham($_SESSION['nguoiDung']['id'], $arr['id_san_pham']);
                        $dieuKien = ($arr_i['da_huy'] != 1 && $arr_i['tinh_trang_don_hang'] == 3 && $luotMua > $luotDanhGia);
                        if($dieuKien)
                        { 
                      ?>
                      <a href="" class="btn btn-warning ms-auto" style=""  data-bs-toggle="modal" data-bs-target="#modalDanhGia" >Đánh giá sản phẩm</a>
                      <?php 
                        }
                      ?>
                      <?php 
                        if($luotDanhGia >= 1)
                        { 
                      ?>
                      <a href="?action=xemDanhGia&id=<?php echo $arr['id_san_pham']; ?>" class = "btn btn-success <?php if(!$dieuKien) echo "ms-auto"; else echo "ms-2"; ?>">Xem đánh giá trước đây của bạn</a>
                      <?php 
                        } 
                      ?>
                    </div>
                  </div>
                </div>
                          <!-- Modal này nằm trong vòng for -->
                          <!-- --------------------------------------------- Modal --------------------------------------------- -->
                          <!-- Modal đánh giá -->
                          <div class="modal fade" id="modalDanhGia" tabindex="-1" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">

                          <div class="container my-3">
                              <div class="col-md-12 mx-auto">
                                <div class="card shadow-lg border-0">
                                  <div class="card-header bg-primary text-white">
                                    <h3 class="mb-0">Đánh giá sản phẩm</h3>
                                  </div>
                                  <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                      <!-- Gửi dữ liệu ẩn -->
                                      <input type="hidden" name="action" value="themDanhGia">
                                      <input type="hidden" name="sp_id" value="<?php echo $arr['id_san_pham']; ?>">
                                      <!-- END -->
                                      <div class="form-group">
                                        <label for="rating">Đánh giá:</label>
                                        <select class="form-control" id="rating" name="txtRating">
                                          <option value="5">5 sao</option>
                                          <option value="4">4 sao</option>
                                          <option value="3">3 sao</option>
                                          <option value="2">2 sao</option>
                                          <option value="1">1 sao</option>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="comment">Nhận xét:</label>
                                        <textarea class="form-control" id="comment" name="txtNoiDung" rows="5"></textarea>
                                      </div>
                                      <div class="form-group">
                                        <label for="name">Tên:</label>
                                        <input type="text" class="form-control" id="name" name="ten" disabled value="<?php echo $_SESSION['nguoiDung']['ho_ten']; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" disabled value="<?php echo $_SESSION['nguoiDung']['email']; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="image">Hình ảnh:</label>
                                        <input type="file" class="form-control" name="fileHinhAnh[]" multiple>
                                      </div>
                                      <button type="submit" class="btn btn-primary my-2">Gửi đánh giá</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                          </div>
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              </div>
                              </div>
                            </div>
                          </div>
                          <!-- --------------------------------------------- End modal --------------------------------------------- -->
          <?php 
            }
          ?>
          <!-- <hr class="border-bottom">
          <div class="d-flex my-0">
            <p class="ms-auto">Phí vận chuyển: <?php echo number_format(25000).'đ'; ?></p>
          </div> -->
          <hr class="border-bottom">
          <div class="d-flex">
            <p class="card-text"><small class="text-muted">Đã mua lúc: <?php echo $arr['ngay_dat']; ?></small></p>
            <p class="ms-auto"><b>Tổng tiền: <?php echo number_format($arr_i['tong_tien']).'đ'; ?></b></p>
          </div>
          <div class="d-flex">
            <div class="ms-auto">
              <?php 
                if($arr_i['tinh_trang_don_hang'] == 2)
                { 
              ?>
              <a href="?action=nguoiDungDaNhanDuocHang&idDonHang=<?php echo $arr_i['id'] ?>" class = "btn btn-warning ms-2">Đã nhận hàng</a>
              <?php 
                } 
              ?>
              <?php 
                if($arr_i['tinh_trang_don_hang'] == 0 && $arr_i['da_huy'] != 1)
                { 
              ?>
              <a href="?action=huyDon&id_don_hang=<?php echo $arr_i['id']; ?>" class = "btn btn-danger ms-2">Huỷ đơn</a>
              <?php 
                } 
              ?>
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