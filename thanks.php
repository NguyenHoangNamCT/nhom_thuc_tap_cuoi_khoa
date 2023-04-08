<?php include("view/top.php"); ?>
<div class="container" style="margin-top: 20px;">
    <h1>Cảm ơn bạn đã mua hàng</h1>
    <p>Hãy chuẩn bị <?php echo number_format($tongTien). 'đ'; ?> để nhận đơn hàng có mã: <?php echo $hoaDonId; ?></p>
    <a href="?action=macdinh" class="btn btn-danger">Quay về trang chủ</a>
</div>
<?php include("view/footer.php"); ?>