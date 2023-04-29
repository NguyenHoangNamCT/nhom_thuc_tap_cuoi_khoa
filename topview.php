<div class="row">
    <!-- Hàng nổi bật -->    
    <h3>Sản phẩm nổi bật</h3>
    <?php
    $sanpham_noibat = $sp -> laySanPhamNoiBat();
    foreach ($sanpham_noibat as $arr):
    ?>
    <div class="col-lg-3 col-sm-4 col-6">
        <div class="panel panel-primary text-center">
            <div class="panel-heading">
                <a class="text-warning" href="?action=detail&product_id=<?php echo $arr["id"]; ?>" style="font-weight:bold;font-size:23px;"><?php echo $arr["ten_san_pham"]; ?></a>
            </div>
            <div class="panel-body">
                <a href="?action=detail&product_id=<?php echo $arr["id"]; ?>"><img src="images/<?php echo $arr["hinh_anh"]; ?>" class="img-responsive"  style="width: 300px; height: 300px; object-fit: cover;" alt="<?php echo $arr["ten_san_pham"]; ?>"></a>
                <p><strong>Giá bán: <span class="text-danger"><?php echo number_format($arr["gia_tien"]); ?>đ</span></strong></p>
            </div>
            <div class="panel-footer">
                <a class="btn btn-success" href="?action=detail&product_id=<?php echo $arr["id"]; ?>">Chi tiết</a>
                <a class="btn btn-danger" href="">Chọn mua</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
