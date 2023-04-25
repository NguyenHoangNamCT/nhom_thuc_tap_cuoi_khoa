<?php
   require('model/quangcao.php');
   require('model/khuyenmai.php');


   $quangCao = new QUANGCAO();
   $km = new KHUYENMAI();

   $quangCaoList = $quangCao->hienThiQuangCao();
   
?>


  <div class="container my-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <?php 
         
          for ($i = 0; $i < count($quangCaoList); $i++) {
            echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $i . '"';
            if ($i === 0) {
              echo ' class="active" aria-current="true"';
            }
            echo ' aria-label="Slide ' . ($i + 1) . '"></button>';
          }
        ?>
      </div>
      <div class="carousel-inner">
        <?php 
          foreach ($quangCaoList as $index => $quangCao) 
            if($quangCao['trang_thai'] == 1)
            {
            
              echo '<div class="carousel-item' . ($index === 0 ? ' active' : '') . '">';
              echo '<a href="' . $quangCao['url'] . '"><img width="100%" height="500px" src="images/' . $quangCao['hinh_anh'] . '" alt="' . $quangCao['tieu_de'] . '"></a>';
              echo '<div class="carousel-caption d-none d-md-block">';
              echo '<h5>' . $quangCao['tieu_de'] . '</h5>';
              echo '</div>';
              echo '</div>';
            }
        ?>

      </div>

 


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


