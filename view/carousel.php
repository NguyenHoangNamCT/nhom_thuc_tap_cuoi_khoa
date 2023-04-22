<style>
  .pagination .page-item.active .page-link {
    background-color: #ffc107;
    color: #fff;
  }
</style>

<ul class="pagination justify-content-center">
  <li class="page-item">
    <a class="page-link" href="#" aria-label="Trang đầu">
      <span aria-hidden="true">&laquo;&laquo;</span>
      <span class="sr-only"></span>
    </a>
  </li>
  <li class="page-item">
    <a class="page-link" href="#" aria-label="Trước">
      <span aria-hidden="true">&laquo;</span>
      <span class="sr-only"></span>
    </a>
  </li>

  <?php
    // Số trang tối đa
    $soTrang = 100;

    // Số trang hiện tại
    $trangHienTai = 1;

    // Hiển thị các nút phân trang
    for ($i = max(1, $trangHienTai - 2); $i <= min($trangHienTai + 2, $soTrang); $i++) {
      $active = ($i == $trangHienTai) ? ' active' : '';
      echo '<li class="page-item' . $active . '"><a class="page-link" href="#">' . $i . '</a></li>';
    }
  ?>

  <li class="page-item">
    <a class="page-link" href="#" aria-label="Tiếp">
      <span aria-hidden="true">&raquo;</span>
      <span class="sr-only"></span>
    </a>
  </li>
  <li class="page-item">
    <a class="page-link" href="#" aria-label="Trang cuối">
      <span aria-hidden="true">&raquo;&raquo;</span>
      <span class="sr-only"></span>
    </a>
  </li>
</ul>