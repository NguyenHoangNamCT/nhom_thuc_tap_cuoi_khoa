<?php include("view/top.php"); ?>
<br><br>
<div class="container">
<?php 
  $thongTinSanPham = $sp->laySanPhamTheoID($sp_id);
?>
  
  <div class="row">
    <div class="col-sm-6">
      <img class="justify-content-center" src="images/<?php echo $thongTinSanPham['hinh_anh']; ?>" alt="Không tìm thấy hình sản phẩm" style="width: 30rem;">
    </div>
    
    <div class="col-sm-6">
      <h2 style="color:#FF00FF;" class=""><?php echo $thongTinSanPham['ten_san_pham']; ?></h2>
      <form class="form-inline" method="post" enctype="multipart/form-data">
        <!-- Gửi dữ liệu ẩn -->
        <input type="hidden" name="action" value="choVaoGio">
        <input type="hidden" name="id" value="<?php echo $thongTinSanPham["id"]; ?>">
        <!-- END -->
        <label for="">Số lượng</label>
        <input style="margin-bottom: 0.1rem;" type="number" class="form-control" name="soLuong" value="1">
        <input type="submit" class="btn btn-warning" value="Cho vào giỏ">
        <?php 
          $luotMua = $ctdh->demSoLuotMuaSanPham($_SESSION['nguoiDung']['id'], $sp_id);
          $luotDanhGia = $dg->demSoDanhGiaCuaNguoiDungChoSanPham($_SESSION['nguoiDung']['id'], $sp_id);
          if($luotMua > $luotDanhGia){
        ?>
        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDanhGia" href="">Đánh giá</a>
        <?php 
          } 
        ?>
      </form>
    </div>

    <div class="col-sm-12">
      <h3 style="color: #FF4500;" class="py-1 success">Chi tiết</h3>
      <table class="table">
        <tbody>
        <tr class="table-secondary">
            <td>Giá bán</td>
            <td><p style="float: left; margin-right: 1.5rem;;" class=""><del><?php echo number_format($thongTinSanPham['gia_tien']); ?></del></p>
            <h5 class="" style="color: red;"><?php echo number_format($thongTinSanPham['gia_tien']*(1-$thongTinSanPham['giam_gia']/100)).' đ '.($thongTinSanPham['giam_gia']*-1).'%'; ?></h5></td>
          </tr>
          <tr class="table-light">
            <td>Thương hiệu</td>
            <td><?php echo $thongTinSanPham['tenthuonghieu']; ?></td>
          </tr> 
          <tr class="table-secondary">
            <td>Loại</td>
            <td><?php echo $thongTinSanPham['ten_loai_san_pham']; ?></td>
          </tr>
          <tr class="table-light">
            <td>Số lượng trong kho</td>
            <td><?php echo $thongTinSanPham['so_luong']; ?></td>
          </tr>
        </tbody>
      </table>
      <div>
        <h3 style="color: #FF4500;" class="">Mô tả</h3>
        <ul class="list-group" >
          <li class="list-group-item"><?php echo $thongTinSanPham['mo_ta']; ?></li>
        </ul>
      </div>
    </div>
    <div class="container">
  <h2 class="mt-3" style="color: #FF4500;">Danh sách đánh giá sản phẩm</h2>
  <div class="row">
    <?php 
      $mangDanhGia = $dg->layDanhSachDanhGiaTheoIDSanPham($sp_id); 
      //sắp xếp lại ưu tiên đánh giá của người dùng đang đăng nhập lên trên
      $count = 0;
      foreach($mangDanhGia as $key => $arr){
        if($arr['id_nguoi_dung'] == $_SESSION['nguoiDung']['id']){
          $temp = $mangDanhGia[$key];
          $mangDanhGia[$key] = $mangDanhGia[$count];
          $mangDanhGia[$count++] = $temp;
        }
      }
      foreach($mangDanhGia as $arr){
        $nguoiDungThamGiaDanhGia = $nd->layThongTinNguoiDungTheoID($arr['id_nguoi_dung']);
    ?>
        <div class="">
        <div class="card mb-4">
          <div class="card-body">
          <div class="d-flex">
            <div class="flex-shrink-0">
              <img  style="width: 60px; height: 60px; object-fit: cover;" src="images/<?php echo $nguoiDungThamGiaDanhGia['hinh_anh']; ?>" class="rounded-circle" alt="Ảnh đại diện của khách hàng">
            </div>
            <div class="flex-grow-1 ps-3">
              <h5 class="card-title pt-3">Nguyễn Văn A</h5>
            </div>
          </div>
            <p class="card-text" style="clear: both;"> <?php echo $arr['noi_dung']; ?> </p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="rating-stars text-warning ">
                <?php 
                  for($i=1; $i <= 5; $i++)
                    if($i <= $arr['diem_danh_gia'])
                      echo '<span class="bi-star-fill"></span>';
                    else
                      echo '<span class="bi-star"></span>';
                ?>
              </div>
              <div class="">
                <?php 
                  $mangHinh = explode(", ", $arr['hinh_anh']);
                  foreach($mangHinh as $hinhArr){
                ?>
                    <img src="images/<?php echo $hinhArr; ?>" class="" alt="Hình ảnh đánh giá" style="width: 150px; height: 150px; object-fit: cover;">
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
</div>  



</div>

<?php include('view/footer.php'); ?>


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
            <input type="hidden" name="sp_id" value="<?php echo $sp_id; ?>">
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



<?php //include("view/carousel.php"); ?>
<?php //include("view/bottom.php"); ?>