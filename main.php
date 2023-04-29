<?php include("view/top.php"); ?>
<?php include("quangcao.php"); ?>
<br><br>
<div class="container">  
  <div class="row"> <!-- Tất cả mặt hàng - Xử lý phân trang -->
     <a name="sptatca"></a>
     <div class="d-flex justify-content-center">
      <div class="card col-sm-6">
        <div class="card-header">
          Sắp sếp sản phẩm
        </div>
        <div class="card-body d-flex justify-content-center">
          <?php
            //Nếu có lọc ở trang 1 thì các trang sau sẽ được lọc
            if(isset($_GET['IDLoaiSP']) && !isset($tuKhoa))
              $l_id = $_GET['IDLoaiSP'];
            if(isset($_GET['IDThuongHieu']) && !isset($tuKhoa))
              $th_id = $_GET['IDThuongHieu'];
            if(isset($_GET['txtTuKhoa']))
              $tuKhoa = $_GET['txtTuKhoa'];
            //Nếu có sắp xếp ở trang 1 thì các trang sau cũng sẽ được sắp xếp
            if(isset($_REQUEST['orderBy']))
              $orderBy = $_REQUEST['orderBy'];
            if(isset($l_id))
              $guiIDLoaiSanPhamKieu_Get = "&IDLoaiSP=".$l_id;
            else
              $guiIDLoaiSanPhamKieu_Get = "";
            if(isset($orderBy))
              $guiOrderByKieu_Get = "&orderBy=".$orderBy;
            else
              $guiOrderByKieu_Get = "";
            if(isset($tuKhoa))
              $guiTuKhoaKieu_Get = "&txtTuKhoa=".$tuKhoa;
            else
              $guiTuKhoaKieu_Get = '';
            if(isset($th_id))
              $guiIDThuongHieuKieu_Get = "&IDThuongHieu=".$th_id;
            else
              $guiIDThuongHieuKieu_Get = "";
            $danhSachDuLieuGuiDI = $guiTuKhoaKieu_Get.$guiOrderByKieu_Get.$guiIDLoaiSanPhamKieu_Get.$guiIDThuongHieuKieu_Get."";
          ?>
          <a href="?sapXep=theoLuotMua<?php echo $danhSachDuLieuGuiDI; ?>" class="btn btn-success mx-1">Bán chạy</a>
          <a href="?sapXep=theoGia<?php echo $danhSachDuLieuGuiDI; ?>" class="btn btn-success mx-1">Giá</a>
          <a href="?sapXep=theoLuotXem<?php echo $danhSachDuLieuGuiDI; ?>" class="btn btn-success mx-1">Lượt xem</a>
        </div>
      </div>
     </div>
     <h2 align='center'>Tất cả sản phẩm</h2>
     <br>
     <br>
    <?php
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

    //đếm số lượng sản phẩm có trong database
    $tongsp = $sp->laySoLuongSanPham();
    //số lượng sản phẩm trong mộT trang
    $soLuongSPTrenMotTrang = 10;
    //làm tròn lên 
    $tongsotrang = ceil($tongsp / $soLuongSPTrenMotTrang);

    //Khi người dùng bấm tìm kiếm
    if(isset($tuKhoa)){
      $mangSP = $sp->timkiemSanPhamPhanTrang($tuKhoa, $trangHienTai, $soLuongSPTrenMotTrang, $orderBy);
      //đếm số lượng sản phẩm có trong database
      $tongsp = count($sp->timkiemSanPham($tuKhoa));
      //làm tròn lên 
      $tongsotrang = ceil($tongsp/$soLuongSPTrenMotTrang);
    }//Khi người dùng bấm lọc theo loại
    else if (isset($l_id)){
      $mangSP = $sp->locSanPhamTheoIdLoaiSanPhamPhanTrang($l_id, $trangHienTai, $soLuongSPTrenMotTrang, $orderBy);
      //đếm số lượng sản phẩm có trong database
      $tongsp = $sp->demSoSanPhamTheoIDLoaiSP($l_id);   
      //làm tròn lên 
      $tongsotrang = ceil($tongsp/$soLuongSPTrenMotTrang);
    }//khi người dùng bấm lọc theo thương hiệu
    else if(isset($th_id)){
      $mangSP = $sp->locSanPhamTheoIDThuongHieuPhanTrang($th_id, $trangHienTai, $soLuongSPTrenMotTrang, $orderBy);
      //đếm số lượng sản phẩm có trong database
      $tongsp = $sp->demSoSanPhamTheoIDThuongHieu($th_id);   
      //làm tròn lên 
      $tongsotrang = ceil($tongsp/$soLuongSPTrenMotTrang);
    }//người dùng không kêu làm gì thì sẽ vào đây lấy tất cả
    else
      $mangSP = $sp->laySanPhamPhanTrang($trangHienTai, $soLuongSPTrenMotTrang, $orderBy);
    $mangLoaiSP = $lsp->layLoaiSP();

      foreach($mangSP as $arr_j)
      {
        if(isset($l_id) && $arr_j['id_loai_san_pham'] != $l_id)
          continue;
        if(isset($th_id) && $arr_j['id_thuong_hieu'] != $th_id)
          continue;

  ?>
   <div class="col-sm-3 container" style="margin-bottom: 1.5rem;">
    <div class="card" style="width:300px">
      <a href="?action=xemChiTiet&id=<?php echo $arr_j['id']; ?>"><img style="object-fit: cover;" width="350dp" height="300dp" alt="<?php echo $arr_j['hinh_anh']; ?>" class="card-img" src="images/<?php echo $arr_j['hinh_anh']; ?>" alt="Card image" style="width:100%"></a>
      <div class="card-body">
        <!-- Test code -->
        <!-- <p><?php //echo $arr_j['id']; ?></p>
        <p>Lượt mua: <?php //echo $arr_j['luot_mua']; ?></p>
        <p>Lượt xem: <?php //echo $arr_j['luot_xem']; ?></p> -->
        <p>Mã loại: <?php echo $arr_j['id_loai_san_pham']; ?></p>
        <P>Mã thương hiệu: <?php echo $arr_j['id_thuong_hieu']; ?></P>
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
      }
  ?>
  </div>
<?php include("view/carousel.php"); ?>
<br></br>

<?php include('topview.php'); ?>
</div>
<br></br>
<?php include('view/footer.php'); ?>