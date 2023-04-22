<?php
    require("../view/top.php");

    if(isset($_REQUEST['trangHienTai']))
      $trangHienTai = $_REQUEST['trangHienTai'];
    else
      $trangHienTai = 1;

    //đếm số lượng sản phẩm có trong database
    $tongth = $th->laySoLuongThuongHieu();
    //số lượng sản phẩm trong mộT trang
    $soLuong = 10;
    //làm tròn lên 
    $tongsotrang = ceil($tongth / $soLuong);
?> 
<div class="container">
  <h2>Quản lý Thương hiệu</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm loại Thương hiệu</a>
  <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTimKiem">Tìm kiếm</a>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
          <tr>
              <th>ID</th>
              <th>Tên Thương hiệu</th>
              <th>Mô tả</th>
              <th>Trang Web</th>
              <th>Logo</th>
              <th>Sửa</th>
              <th>Xóa</th>
          </tr>
      </thead>
      <tbody>
        
          <?php 
            if(!isset($tuKhoa))
              $mangth = $th->layThuongHieuPhanTrang($trangHienTai, $soLuong);
            else
              $mangth = $th->timKiemThuongHieu($tuKhoa);
            foreach ($mangth as $arr) { 
          ?>
          <tr>
              <td><?php echo $arr['id']; ?></td>
              <td><?php echo $arr['TenThuongHieu']; ?></td>
              <td><?php echo $arr['MoTa']; ?></td>
              <td><?php echo $arr['TrangWeb']; ?></td>
              <td><img src="../../images/<?php echo $arr['Logo']; ?>" alt="<?php echo $arr['TenThuongHieu']; ?>" width="100"></td>
              <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-edit"></span> Sửa</a></td>
              <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-trash"></span> Xoá</a></td>
          </tr>
          <?php } ?>
      </tbody>
    </table>
  </div>
  <?php 
    require("../../view/carousel.php");
  ?>
</div>

</div>
<?php
    require("../view/footer.php");
?>



<!-- Các modal -->
<div class="modal fade" id="modalTimKiem" tabindex="-1" aria-labelledby="modalTimKiemLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
              <h4 class="modal-title" id="modalTimKiemLabel"><span class="glyphicon glyphicon-search"></span> Bạn cần tìm gì?</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
            <div class="my-3" >
              <form action="" class="" method="post">
                <!-- Gửi dữ liệu ẩn -->
                <input type="hidden" name="action" value="timKiemThuongHieu">
                <!-- END -->
                <label for="txtTuKhoa">Tìm kiếm:</label>
                <input type="text" class="form-control" name="txtTuKhoa" id="txtTuKhoa" placeholder="Tìm kiếm">
                
                <div class="form-group">
                  <label for="loai-tim-kiem">Tìm kiếm theo:</label>
                  <select class="form-control" id="loai-tim-kiem" name="loaiTimKiem" required>
                    <option value="">--Chọn loại tìm kiếm--</option>
                    <option value="theoTen">Theo Tên </option>
                  </select>
                </div>

                <button type="submit" class="btn btn-success my-2">Tìm kiếm</button>
              </form>
            </div>
            </div>
        </div>
    </div>
</div>
