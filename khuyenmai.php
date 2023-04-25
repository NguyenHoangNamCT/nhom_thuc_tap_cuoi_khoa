<?php
   require('model/khuyenmai.php');

   $km = new KHUYENMAI();
   $khuyenMaiList = $km->hienThiKhuyenMai();
   
?>


  <div class="container my-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php 
          for ($i = 0; $i < count($khuyenMaiList); $i++) {
            echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'. $i . '"';
            if ($i === 0) {
              echo ' class="active" aria-current="true"';
            }
            echo ' aria-label="Slide ' . ($i + 1) . '"></button>';
          }
        ?>
   
        
      </div>
      <div class="carousel-inner">
        <?php 
         foreach ($khuyenMaiList as $index => $km) {
          echo '<div class="carousel-item' . ($index === 0 ? ' active' : '') . '">';
          echo '<img width="100%" height="300px" src="images/' . $km['hinh_anh'] . '" alt="' . $km['ten_khuyen_mai'] . '">';
          echo '<div class="carousel-caption d-none d-md-block">';
          echo '<h5>' . $km['ten_khuyen_mai'] . '</h5>';
          echo '<p>Giá Trị Khuyến Mãi:  ' . $km['gia_tri'] . '%</p>';
          echo '<p>Từ: ' . date('d/m/Y', strtotime($km['ngay_bat_dau'])) . ' và   Đến:' . date('d/m/Y', strtotime($km['ngay_ket_thuc'])) .'</p>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>

         <!-- Left and right controls/icons -->
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>


