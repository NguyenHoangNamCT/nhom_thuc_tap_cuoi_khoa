<?php include("view/top.php"); ?>

<br><br>
<div class="container">
<?php 
  $thongTinSanPham = $sp->laySanPhamTheoID($sp_id);
?>
  
  <div class="row">
    <div class="col-sm-6">
      <img class="justify-content-center" src="images/<?php echo $thongTinSanPham['hinh_anh']; ?>" alt="Không tìm thấy hình sản phẩm" style="width: 30rem;">
      <h2 class="text-success"><?php echo $thongTinSanPham['ten_san_pham']; ?></h2>
    </div>
    
    <div class="col-sm-6">
      <form class="form-inline" method="post">
        <!-- Gửi dữ liệu ẩn -->
        <input type="hidden" name="action" value="choVaoGio">
        <input type="hidden" name="id" value="<?php echo $thongTinSanPham["id"]; ?>">
        <!-- END -->
        <label for="">Số lượng</label>
        <input style="margin-bottom: 0.1rem;" type="number" class="form-control" name="soLuong" value="1">
        <input type="submit" class="btn btn-warning" value="Cho vào giỏ">
      </form>
    </div>

    <div class="col-sm-12">
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
        <h3 class="text-warning">Mô tả</h3>
        <ul class="list-group" >
          <li class="list-group-item"><?php echo $thongTinSanPham['mo_ta']; ?></li>
        </ul>
      </div>
    </div>
  </div>

  <?php //include("topview.php"); ?>
  

</div>






<?php //include("view/carousel.php"); ?>
<?php //include("view/bottom.php"); ?>