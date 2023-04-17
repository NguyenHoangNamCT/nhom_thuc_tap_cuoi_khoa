<?php
    require("../view/top.php");
?> 
<div class="container">
  <h2>Quản lý Quảng cáo</h2>
  <a href="index.php?action=them" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm Quảng cáo</a>
  <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTimKiem">Tìm kiếm</a>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Tiêu đề</th>
          <th>Url</th>
          <th>Trạng thái</th>
          <th>Hình ảnh</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!isset($tuKhoa))
            $mangQC = $qc->layDanhSachQuangCao();
          else 
            $mangQC = $qc->timKiemQuangCao($tuKhoa);
            foreach($mangQC as $arr){
        ?>
        <tr>
          <td><?php echo $arr["tieu_de"]; ?></td>
          <td><?php echo $arr["url"]; ?></td>
          <td><?php if($arr["trang_thai"] == 0) echo "Trong Thời Gian"; else echo "Ngoài Thời Gian"; ?></td>
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
                <input type="hidden" name="action" value="timKiemQuangCao">
                <!-- END -->
                <label for="txtTuKhoa">Tìm kiếm:</label>
                <input type="text" class="form-control" name="txtTuKhoa" id="txtTuKhoa" placeholder="Tìm kiếm">
                
                <div class="form-group">
                  <label for="loai-tim-kiem">Tìm kiếm theo:</label>
                  <select class="form-control" id="loai-tim-kiem" name="loaiTimKiem" required>
                    <option value="">--Chọn loại tìm kiếm--</option>
                    <option value="theoTieuDe">Theo tiêu đề</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-success my-2">Tìm kiếm</button>
              </form>
            </div>
            </div>
        </div>
    </div>
</div>