<?php include("view/top.php"); ?>

<br><br>
<div class="container"  style="min-height: 68vh;">  
  <div class="row"> 
    <div class="container mt-3 col">
      <?php
        //nếu cập nhật số lương thành công thì thông báo. isset $capNhatThanh cong để khi load ban đầu không thông báo cập nhật thành công
        if(!isset($capNhatThatBai) && isset($capNhatThanhCong))
          echo '
          <div class="alert alert-success">
            Cập nhật giỏ hàng <strong>Thành công.</strong>
          </div>
          ';
        else if(isset($message)){
      ?>
          <div class="alert alert-danger">
            Cập nhật giỏ hàng <strong>Thất bại!</strong> <?php echo '<br>'; echo $message; ?>
          </div>
      <?php 
        }
        else if(isset($messageThem)){
      ?>
          <div class="alert alert-danger">
            Thêm sản phẩm <strong>Thất bại!</strong> <?php echo '<br>'; echo $messageThem; ?>
          </div>
      <?php 
        }
      ?>
      <table class="table table-borderless" align="center">
        <h2>Giỏ Hàng</h2>
        <?php 
          if(isset($_SESSION['nguoiDung']))
            $mangGioHang = $gh->layGioHang($_SESSION['nguoiDung']['id']);
          else
            $mangGioHang = array();
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
                    <td><?php $giaBan = $arr["gia_tien"] * (1-$arr['giam_gia']/100); echo number_format($giaBan).'đ'; ?></td>
                    <td><?php echo number_format($giaBan*$arr["so_luong"]); ?></td>
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
    <?php if(count($mangGioHang) > 0){ ?>
    <td><a class="btn btn-warning" href="?action=datMua"><span class=""></span>Đặt mua</a></td>
    <?php } ?>
                </form>
    </div>

  </div>
</div>

<?php include('view/footer.php'); ?>

