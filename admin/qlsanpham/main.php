<?php
    require("../view/top.php");

?> 
<div class="container">
  <h2>Quản lý sản phẩm</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm sản phẩm</a>
  <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTimKiem">Tìm kiếm</a>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Tên sản phẩm</th>
          <th>Giá tiền</th>
          <th>Giảm giá</th>
          <th>Loại sản phẩm</th>
          <th>Thương hiệu</th>
          <th>So lượng</th>
          <th>Trạng thái</th>
          <th>Mô tả</th>
          <th>Hình ảnh</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!isset($tuKhoa))
            $mangSP = $sp->layDanhSachSanPham();
          else if($loaiTimKiem == "theoTen")
            $mangSP = $sp->timKiemSanPham($tuKhoa);
          else if($loaiTimKiem == "theoGiaToiDa")
            $mangSP = $sp->timKiemSanPhamTheoGiaTienToiDa($tuKhoa);
          else if($loaiTimKiem == "theoGiaToiThieu")
            $mangSP = $sp->timKiemSanPhamTheoGiaTienToiThieu($tuKhoa);
          foreach($mangSP as $arr){
        ?>
        <tr>
          <td><?php echo $arr["ten_san_pham"]; ?></td>
          <td><?php echo number_format($arr["gia_tien"]).'đ'; ?></td>
          <td><?php echo number_format($arr["giam_gia"]).'%'; ?></td>
          <td><?php echo $arr["ten_loai_san_pham"]; ?></td>
          <td><?php echo $arr["tenthuonghieu"]; ?></td>
          <td><?php echo $arr["so_luong"]; ?></td>
          <td><?php if($arr["so_luong"] > 0) echo "Còn hàng"; else echo "Hết hàng"; ?></td>
          <td><?php echo $arr["mo_ta"]; ?></td>
          <td><img src="../../images/<?php echo $arr["hinh_anh"]; ?>" width="80" class="img-thumbnail"></td>
          <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-edit"></span> Sửa</a></td>
          <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $arr["id"]; ?>"><span class="glyphicon glyphicon-trash"></span> Xoá</a></td>
        </tr>
        <?php
            }
        ?>
      </tbody>
    </table>
  </div>
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
                <input type="hidden" name="action" value="timKiemSanPham">
                <!-- END -->
                <label for="txtTuKhoa">Tìm kiếm theo:</label>
                <input type="text" class="form-control" name="txtTuKhoa" id="txtTuKhoa" placeholder="Tìm kiếm">
                
                <div class="form-group">
                  <label for="loai-tim-kiem">Tìm kiếm theo:</label>
                  <select class="form-control" id="loai-tim-kiem" name="loaiTimKiem" required>
                    <option value="">--Chọn loại tìm kiếm--</option>
                    <option value="theoTen">Theo tên</option>
                    <option value="theoGiaToiDa">Theo giá tối đa</option>
                    <option value="theoGiaToiThieu">Theo giá tối thiểu</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-success my-2">Tìm kiếm</button>
              </form>
            </div>
            </div>
        </div>
    </div>
</div>