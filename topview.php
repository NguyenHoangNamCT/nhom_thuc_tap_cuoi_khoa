<div class="row">
    <!-- Hàng nổi bật -->    
    <h3>Sản phẩm nổi bật</h3>
    <?php
    foreach ($sanpham_noibat as $sp):
    ?>
    <div class="col-lg-3 col-sm-4 col-6">
        <div class="panel panel-primary text-center">
            <div class="panel-heading">
                <a href="?action=detail&product_id=<?php echo $sp["id"]; ?>" style="color:Yellow;font-weight:bold;font-size:23px;"><?php echo $sp["ten_san_pham"]; ?></a>
            </div>
            <div class="panel-body">
                <a href="?action=detail&product_id=<?php echo $sp["id"]; ?>"><img src="images/<?php echo $sp["hinh_anh"]; ?>" class="img-responsive" style="width:90%" alt="<?php echo $sp["ten_san_pham"]; ?>"></a>
                <p><strong>Giá bán: <span class="text-danger"><?php echo number_format($sp["gia_tien"]); ?>đ</span></strong></p>
            </div>
            <div class="panel-footer">
                <a class="btn btn-success" href="?action=detail&product_id=<?php echo $sp["id"]; ?>">Chi tiết</a>
                <a class="btn btn-danger" href="">Chọn mua</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
