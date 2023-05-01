<?php
    require("../view/top.php");

    if(isset($_REQUEST['trangHienTai']))
      $trangHienTai = $_REQUEST['trangHienTai'];
    else
      $trangHienTai = 1;

    //đếm số lượng dh có trong database
    $tongdh = $dh-> laySoLuongDonHang();
    //số lượng dh trong mộT trang
    $soLuong = 10;
    //làm tròn lên 
    $tongsotrang = ceil($tongdh / $soLuong);
?> 
<div class="container">
  <h2>Quản lý đơn hàng</h2>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Tên Người DÙng</th>
          <th>Ngày Đặt</th>
          <th>Địa Chỉ Giao Hàng</th>
          <th>Điện Thoại Người Nhận</th>
          <th>Tổng Tiền</th>
          <th>Tình Trang Đơn Hàng</th>
          <th>Sửa</th>
          <th>Xóa</th>
          <!-- <th>Thêm Thông Tin Đơn Hàng</th> -->
        </tr>
      </thead>
      <tbody>
        <?php
          $mangDH = $dh->layDonHangPhanTrang($trangHienTai, $soLuong);
          foreach($mangDH as $arr){
        ?>
        <tr>
          <td><?php echo $arr["ho_ten"]; ?></td>
          <td><?php echo $arr["ngay_dat"]; ?></td>
          <td><?php echo $arr["dia_chi_giao_hang"]; ?></td>
          <td><?php echo $arr["dien_thoai_nguoi_nhan"]; ?></td>
          <td><?php echo number_format($arr["tong_tien"]).'đ'; ?></td>
          <td><?php if($arr["tinh_trang_don_hang"] == 0 ) echo "Chưa thanh toán"; 
                    else if($arr["tinh_trang_don_hang"] == 1 )echo "Đã thanh toán"; 
                    else if($arr["tinh_trang_don_hang"] == 2 )echo "Đang vận chuyển"; 
                    else echo "Đã giao"?></td>       
          <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-edit"></span> Sửa</a></td>
          <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-trash"></span> Xoá</a></td>
          <!-- <td><a class="btn btn-danger" href="index.php?action=ThemTTDH&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-trash"></span> Thêm Thông Tin Đơn Hàng</a></td> -->
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
