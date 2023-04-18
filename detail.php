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
      <form class="form-inline" method="post">
        <!-- Gửi dữ liệu ẩn -->
        <input type="hidden" name="action" value="choVaoGio">
        <input type="hidden" name="id" value="<?php echo $thongTinSanPham["id"]; ?>">
        <!-- END -->
        <label for="">Số lượng</label>
        <input style="margin-bottom: 0.1rem;" type="number" class="form-control" name="soLuong" value="1">
        <input type="submit" class="btn btn-warning" value="Cho vào giỏ">
        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDanhGia" href="">Đánh giá</a>
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

    <!-- Giao diện đánh giá cá nhân -->
    

      <!-- Giao diện dnah sách đánh giá -->
      <div class="container my-5">  
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h5 style="color: #FF4500;" class="card-title">Đánh giá sản phẩm từ khách hàng</h5>
                <hr>
                <div class="list-group">
                  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Đánh giá 1</h5>
                      <small>3 days ago</small>
                    </div>
                    <p class="mb-1">"Sản phẩm rất tốt, tôi rất hài lòng về chất lượng."</p>
                    <small>Người dùng: John Doe</small>
                  </a>
                  <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Đánh giá 2</h5>
                      <small>5 days ago</small>
                    </div>
                    <p class="mb-1">"Sản phẩm không được như mong đợi, tôi không hài lòng về chất lượng."</p>
                    <small>Người dùng: Jane Smith</small>
                  </a>
                  <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Đánh giá 3</h5>
                      <small>7 days ago</small>
                    </div>
                    <p class="mb-1">"Sản phẩm khá tốt, nhưng có chút khó sử dụng."</p>
                    <small>Người dùng: David Brown</small>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

  <?php //include("topview.php"); ?>
  

</div>


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
          <form>
            <div class="form-group">
              <label for="rating">Đánh giá:</label>
              <select class="form-control" id="rating" name="rating">
                <option>5 sao</option>
                <option>4 sao</option>
                <option>3 sao</option>
                <option>2 sao</option>
                <option>1 sao</option>
              </select>
            </div>
            <div class="form-group">
              <label for="comment">Nhận xét:</label>
              <textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
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