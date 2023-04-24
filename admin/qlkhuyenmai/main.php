<?php
    require("../view/top.php");

    if(isset($_REQUEST['trangHienTai']))
      $trangHienTai = $_REQUEST['trangHienTai'];
    else
      $trangHienTai = 1;

      if(isset($_REQUEST['txtTuKhoa']))
      $tuKhoa = $_REQUEST['txtTuKhoa'];
    if(isset($_REQUEST['loaiTimKiem']))
      $loaiTimKiem = $_REQUEST['loaiTimKiem'];

    //đếm số lượng km có trong database
    $tongkm = $km-> laySoLuongKhuyenMai();
    //số lượng km trong mộT trang
    $soLuong = 10;
    //làm tròn lên 
    $tongsotrang = ceil($tongkm / $soLuong);
?> 
<div class="container">
  <h2>Quản lý khuyến mãi</h2>
  <a href="?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm khuyến mãi</a>
  <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTimKiem">Tìm kiếm</a>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Tên khuyến mãi</th>
          <th>Mô tả</th>
          <th>Ngày bắt đầu</th>
          <th>Ngày kết thúc</th>
          <th>Trạng thái</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!isset($tuKhoa))
            $mangKM = $km->layDanhSachKhuyenMaiPhanTrang($trangHienTai, $soLuong);
          else
          {
            $mangKM = $km->timKiemKhuyenMaiTheoTenPhanTrang($tuKhoa, $trangHienTai, $soLuong);
            $tongkm = count($km->timKiemKhuyenMaiTheoTen($tuKhoa));
            $tongsotrang = ceil($tongkm / $soLuong);
          }
            
          foreach($mangKM as $arr){
        ?>
        <tr>
          <td><?php echo $arr["ten_khuyen_mai"]; ?></td>
          <td><?php echo $arr["mo_ta"]; ?></td>
          <td><?php echo date("d/m/Y", strtotime($arr["ngay_bat_dau"])); ?></td>
          <td><?php echo date("d/m/Y", strtotime($arr["ngay_ket_thuc"])); ?></td>
          <td><?php if($arr["trang_thai"] == 1) echo "Đang áp dụng"; else echo "Ngừng áp dụng"; ?></td>
          <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-edit"></span> Sửa</a></td>
          <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-trash"></span> Xoá</a></td>
        </tr>
        <?php
            }
        ?>
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
                <input type="hidden" name="action" value="timKiemKhuyenMai">
                <input type="hidden" name="trangHienTai" value="1">
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
