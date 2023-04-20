<?php include("view/top.php"); ?>

<br><br>
<div class="container">  
  <div class="row"> <!-- Tất cả mặt hàng - Xử lý phân trang -->
     <a name="sptatca"></a>
     <h2 align='center'>Tất cả sản phẩm </h2>
     <br>
     <br>
    <?php
    $mangSP = $sp->layDanhSachSanPham();
    $mangLoaiSP = $lsp->layLoaiSP();

    //nếu có lọc theo thương hiệu thì k cần hiển thị danh sách sản phẩm
    if(!isset($th_id))
    //Hiển thị các sản phẩm theo từng loại sản phẩm riêng biệt
      foreach($mangLoaiSP as $arr_i)
      {
        //nếu có lọc theo loại sản phẩm thì chỉ hiển thị sản phẩm của loại đó
        if(isset($l_id))
          if($arr_i['id'] != $l_id)
              continue;
        echo '<h3>'.$arr_i['ten_loai_san_pham'].'</h3>';
        foreach($mangSP as $arr_j)
          if($arr_j['ten_loai_san_pham'] == $arr_i['ten_loai_san_pham'])
          {
    ?>
     <div class="col-sm-3 container" style="margin-bottom: 1.5rem;">
      <div class="card" style="width:300px">
        <a href="?action=xemChiTiet&id=<?php echo $arr_j['id']; ?>"><img style="object-fit: cover;" width="350dp" height="300dp" alt="<?php echo $arr_j['hinh_anh']; ?>" class="card-img" src="images/<?php echo $arr_j['hinh_anh']; ?>" alt="Card image" style="width:100%"></a>

        <div class="card-body">
          <a href="?action=xemChiTiet&id=<?php echo $arr_j['id']; ?>"><h4 class="card-title"><?php echo $arr_j['ten_san_pham']; ?></h4></a>
          <p class="card-text"><del><?php echo number_format($arr_j['gia_tien']); ?></del> <?php echo $arr_j['giam_gia'].'%'; ?></p>
          <h5 class="card-text" style="color: red;"><?php echo number_format($arr_j['gia_tien']*(1-$arr_j['giam_gia']/100)).' đ'; ?></h5>
          <p>Trạng thái: <?php if($arr_j['so_luong'] > 0) echo "Còn hàng"; else echo "HếT hàng"; ?></p>

          <a href="?action=xemChiTiet&id=<?php echo $arr_j['id']; ?>" class="btn btn-primary">Chi tiết</a>
          <a href="?action=choVaoGio&id=<?php echo $arr_j['id']; ?>&soLuong=1" class="btn btn-primary">Đặt mua</a>
        </div>
      </div>
    </div>   
    <?php 
        }//đóng ngoặc của if
    }
    ?>

    <?php
      //nếu có yêu cầu lọc sản phẩm theo thương hiệu thì hiển thị các sản phẩm thuộc thương hiệu đó
      if(isset($th_id))
        foreach($mangThuongHieu as $arr_i)
        {
          if($arr_i['id'] != $th_id)
            continue;
          echo '<h3>'.$arr_i['TenThuongHieu'].'</h3>';
          foreach($mangSP as $arr_j)
            if($arr_j['tenthuonghieu'] == $arr_i['TenThuongHieu'])
            {
    ?>
    <div class="col-sm-3 container" style="margin-bottom: 1.5rem;">
      <div class="card" style="width:300px">
        <a href="?action=xemChiTiet&id=<?php echo $arr_j['id']; ?>"><img alt="<?php echo $arr_j['hinh_anh']; ?>" class="card-img" src="images/<?php echo $arr_j['hinh_anh']; ?>" alt="Card image" style="width:100%"></a>

        <div class="card-body">
          <a href="?action=xemChiTiet&id=<?php echo $arr_j['id']; ?>"><h4 class="card-title"><?php echo $arr_j['ten_san_pham']; ?></h4></a>
          <p class="card-text"><del><?php echo number_format($arr_j['gia_tien']); ?></del> <?php echo $arr_j['giam_gia'].'%'; ?></p>
          <h5 class="card-text" style="color: red;"><?php echo number_format($arr_j['gia_tien']*(1-$arr_j['giam_gia']/100)).' đ'; ?></h5>
          <p>loại sản phẩm: <?php echo $arr_j['ten_loai_san_pham']; ?></p>
          <p>Thương hiệu: <?php echo $arr_j['tenthuonghieu']; ?></p>
          <p>Trạng thái: <?php if($arr_j['so_luong'] > 0) echo "Còn hàng"; else echo "HếT hàng"; ?></p>

          <a href="?action=xemChiTiet&id=<?php echo $arr_j['id']; ?>" class="btn btn-primary">Chi tiết</a>
          <a href="?action=choVaoGio&id=<?php echo $arr_j['id']; ?>&soLuong=1" class="btn btn-primary">Đặt mua</a>
        </div>
      </div>
    </div>   
    <?php
            }
        }
    ?>
  </div>
</div>
<br></br>
<?php include('topview.php'); ?>
<br></br>
<?php include('view/footer.php'); ?>

