<style>
  .pagination .page-item.active .page-link {
    background-color: #ffc107;
    color: #fff;
  }
</style>
<?php 
  if(isset($tuKhoa))
    $guiTuKhoaKieu_Get = "&txtTuKhoa=".$tuKhoa;
  else
    $guiTuKhoaKieu_Get = '';
  if(isset($loaiTimKiem))
    $guiLoaiTimKiemKieu_Get = "&loaiTimKiem=".$loaiTimKiem;
  else
    $guiLoaiTimKiemKieu_Get = '';
  if(isset($orderBy))
    $guiOrderByKieu_Get = "&orderBy=".$orderBy;
  else
    $guiOrderByKieu_Get = "";
?>

<ul class="pagination justify-content-center">
  <li class="page-item">
    <a class="page-link" href="?trangHienTai=1".$guiTuKhoaKieu_Get.$guiLoaiTimKiemKieu_Get.$guiOrderByKieu_Get aria-label="Trang đầu">
      <span aria-hidden="true">&laquo;&laquo;</span>
    </a>
  </li>
  <li class="page-item">
    <a class="page-link" href="?trangHienTai=<?php echo max($trangHienTai - 1, 1); ?>".$guiTuKhoaKieu_Get.$guiLoaiTimKiemKieu_Get.$guiOrderByKieu_Get aria-label="Trước">
      <span aria-hidden="true">&laquo;</span>
      <span class="sr-only"></span>
    </a>
  </li>

  <?php
    // Hiển thị các nút phân trang
    for ($i = max(1, $trangHienTai - 2); $i <= min($trangHienTai + 2, $tongsotrang); $i++) {
      $active = ($i == $trangHienTai) ? ' active' : '';
      echo '<li class="page-item' . $active . '"><a class="page-link" href="?trangHienTai='.$i.$guiTuKhoaKieu_Get.$guiLoaiTimKiemKieu_Get.$guiOrderByKieu_Get.'">' . $i . '</a></li>';
    }
  ?>

  <li class="page-item">
    <a class="page-link" href="?trangHienTai=<?php echo min($tongsotrang, $trangHienTai + 1) ?>".$guiTuKhoaKieu_Get.$guiLoaiTimKiemKieu_Get.$guiOrderByKieu_Get aria-label="Tiếp">
      <span aria-hidden="true">&raquo;</span>
    </a>
  </li>
  <li class="page-item">
    <a class="page-link" href="?trangHienTai=<?php echo $tongsotrang; ?>".$guiTuKhoaKieu_Get.$guiLoaiTimKiemKieu_Get.$guiOrderByKieu_Get aria-label="Trang cuối">
      <span aria-hidden="true">&raquo;&raquo; </span>
    </a>
  </li>
</ul>