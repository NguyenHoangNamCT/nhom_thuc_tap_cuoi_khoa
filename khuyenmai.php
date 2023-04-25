<?php
   require('model/khuyenmai.php');

   $km = new KHUYENMAI();
   $khuyenMaiList = $km->hienThiKhuyenMai();
   var_dump($khuyenMaiList);
   
?>



<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <?php 
      for($i = 0; $i < count($khuyenMaiList); $i++){ 
    ?>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="<?php echo $i; ?>" <?php if($i == 0) echo  'class="active"'; ?>></button>
    <?php 
      } 
    ?>
  </div>

  <!-- The slideshow/carousel -->
  <div class="carousel-inner">
    <?php foreach($khuyenMaiList as $key => $arr){ ?>
    <div class="carousel-item <?php if($key == 0) echo 'active'; ?>">
      <img src="images/<?php echo $arr['hinh_anh']; ?>" alt="Los Angeles" class="d-block w-100" style="height: 500px;">
    </div>
    <?php } ?>
  </div>

  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
  </button>
