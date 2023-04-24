<?php include("view/top.php"); ?>

<br><br>
<div class="container">  
  <div class="row"> <!-- Tất cả mặt hàng - Xử lý phân trang -->
     <a name="sptatca"></a>
     <div class="d-flex justify-content-center">
      <div class="card col-sm-6">
        <div class="card-header">
          Lọc sản phẩm
        </div>
        <div class="card-body d-flex justify-content-center">
          <a href="?sapXep=theoLuotMua" class="btn btn-success mx-1">Bán chạy</a>
          <a href="?sapXep=theoGia" class="btn btn-success mx-1">Giá</a>
          <a href="?sapXep=theoLuotXem" class="btn btn-success mx-1">Lượt xem</a>
        </div>
      </div>
     </div>
     <h2 align='center'>Tất cả sản phẩm</h2>
     <br>
     <br>
    <?php
    if(isset($_REQUEST['orderBy']))
      $orderBy = $_REQUEST['orderBy'];

    //nếu có sắp xếp thì sắp xếp
    if(isset($_REQUEST['sapXep'])){
      $loaiSapXep = $_REQUEST['sapXep'];
      
      if($loaiSapXep == "theoGia"){
        if(isset($_SESSION['giamDanTheoGia'])){
          $orderBy = "order by (sp.gia_tien * (1 - sp.giam_gia/100)) DESC";
          unset($_SESSION['giamDanTheoGia']);
        }
        else{
          $orderBy = "order by (sp.gia_tien * (1 - sp.giam_gia/100))";
          $_SESSION['giamDanTheoGia'] = true;
        }
        
      }
    
      if($loaiSapXep == "theoLuotMua"){
        if(!isset($_SESSION['giamDanTheoLuotMua'])){
          $orderBy = "order by sp.luot_mua DESC";
          $_SESSION['giamDanTheoLuotMua'] = true;
        }
        else{
          $orderBy = "order by  sp.luot_mua";
          unset($_SESSION['giamDanTheoLuotMua']);
        }
      }

      if($loaiSapXep == "theoLuotXem"){
        if(!isset($_SESSION['giamDanTheoLuotXem'])){
          $orderBy = "order by sp.luot_xem DESC";
          $_SESSION['giamDanTheoLuotXem'] = true;
          
        }
        else{
          $orderBy = "order by  sp.luot_xem";
          unset($_SESSION['giamDanTheoLuotXem']);
        }
      }
    }
    else{
      if(!isset($orderBy))
        $orderBy = NULL;
    }
      

    if(isset($_REQUEST['trangHienTai']))
      $trangHienTai = $_REQUEST['trangHienTai'];
    else
      $trangHienTai = 1;

    if(isset($_REQUEST['txtTuKhoa']))
      $tuKhoa = $_REQUEST['txtTuKhoa'];

    //đếm số lượng sản phẩm có trong database
    $tongsp = $sp->laySoLuongSanPham();
    //số lượng sản phẩm trong mộT trang
    $soLuongSPTrenMotTrang = 10;
    //làm tròn lên 
    $tongsotrang = ceil($tongsp / $soLuongSPTrenMotTrang);

    if(isset($tuKhoa)){
      $mangSP = $sp->timkiemSanPhamPhanTrang($tuKhoa, $trangHienTai, $soLuongSPTrenMotTrang, $orderBy);
      //đếm số lượng sản phẩm có trong database
      $tongsp = count($sp->timkiemSanPham($tuKhoa));   
      //làm tròn lên 
      $tongsotrang = ceil($tongsp/$soLuongSPTrenMotTrang);
    }
    else
      $mangSP = $sp->laySanPhamPhanTrang($trangHienTai, $soLuongSPTrenMotTrang, $orderBy);
    $mangLoaiSP = $lsp->layLoaiSP();

    

    //nếu có lọc theo thương hiệu thì k cần hiển thị danh sách sản phẩm
    // if(!isset($th_id))
    //Hiển thị các sản phẩm theo từng loại sản phẩm riêng biệt
    // foreach($mangLoaiSP as $arr_i)
    // {
      //nếu có yêu cầu lọc theo loại sản phẩm thì chỉ hiển thị các sản phẩm của loại đó. không thì k hiện luôn
      // if(isset($l_id) && $arr_j['id_loai_san_pham'] == $l_id)
      //   continue;
      //nếu 10 sản phẩm trong trang có tồn tại trong loại sản phẩm đó thì mới in tên của loại sản phẩm đó ra
      // if(SANPHAM::mangSanPhamKhongCoTrongLoaiSP($mangSP, $arr_i['id']) == false)
      //   echo '<h3>'.$arr_i['ten_loai_san_pham'].'</h3>';
      // else
      //   continue;
      foreach($mangSP as $arr_j)
      {
        if(isset($l_id) && $arr_j['id_loai_san_pham'] != $l_id)
          continue;
        if(isset($th_id) && $arr_j['id_thuong_hieu'] != $th_id)
          continue;
        // if($arr_j['id_loai_san_pham'] == $arr_i['id'])
        // {
  ?>
   <div class="col-sm-3 container" style="margin-bottom: 1.5rem;">
    <div class="card" style="width:300px">
      <a href="?action=xemChiTiet&id=<?php echo $arr_j['id']; ?>"><img style="object-fit: cover;" width="350dp" height="300dp" alt="<?php echo $arr_j['hinh_anh']; ?>" class="card-img" src="images/<?php echo $arr_j['hinh_anh']; ?>" alt="Card image" style="width:100%"></a>
      <div class="card-body">
        <!-- Test code -->
        <!-- <p><?php //echo $arr_j['id']; ?></p>
        <p>Lượt mua: <?php //echo $arr_j['luot_mua']; ?></p>
        <p>Lượt xem: <?php //echo $arr_j['luot_xem']; ?></p> -->
        <!-- End test code -->
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
        // }//đóng ngoặc của if
      }
  ?>

<!-- Fix lại hiển thị trang chủ -->

    <?php
      // //nếu có yêu cầu lọc sản phẩm theo thương hiệu thì hiển thị các sản phẩm thuộc thương hiệu đó
      // if(isset($th_id))
      //   foreach($mangThuongHieu as $arr_i)
      //   {
      //     if($arr_i['id'] != $th_id)
      //       continue;
      //     echo '<h3>'.$arr_i['TenThuongHieu'].'</h3>';
      //     foreach($mangSP as $arr_j)
      //       if($arr_j['id_thuong_hieu'] == $arr_i['id'])
      //       {
    ?>
    <!-- <div class="col-sm-3 container" style="margin-bottom: 1.5rem;">
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
    </div>    -->
    <?php
        //     }
        // }
    ?>
  </div>
</div>
<?php include("view/carousel.php"); ?>
<br></br>
<?php include('topview.php'); ?>
<br></br>
<?php include('view/footer.php'); ?>