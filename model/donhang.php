<?php 
class DONHANG{
    public function themDonHang($id_nguoi_dung, $ngay_dat, $dia_chi_giao_hang, $dien_thoai_nguoi_nhan, $ho_ten_nguoi_nhan, $tong_tien, $tinh_trang_don_hang){
        $db = DATABASE::connect();
        try{
            $sql = "INSERT INTO donhang (id_nguoi_dung, ngay_dat, dia_chi_giao_hang, dien_thoai_nguoi_nhan, ho_ten_nguoi_nhan, tong_tien, tinh_trang_don_hang) VALUES (:id_nguoi_dung, :ngay_dat, :dia_chi_giao_hang, :dien_thoai_nguoi_nhan, :ho_ten_nguoi_nhan, :tong_tien, :tinh_trang_don_hang)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung);
            $cmd->bindValue(':ngay_dat', $ngay_dat);
            $cmd->bindValue(':dia_chi_giao_hang', $dia_chi_giao_hang);
            $cmd->bindValue(':dien_thoai_nguoi_nhan', $dien_thoai_nguoi_nhan);
            $cmd->bindValue(':ho_ten_nguoi_nhan', $ho_ten_nguoi_nhan);
            $cmd->bindValue(':tong_tien', $tong_tien);
            $cmd->bindValue(':tinh_trang_don_hang', $tinh_trang_don_hang);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở themDonHang: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    public function xoaDonHang($id_don_hang){
        $db = DATABASE::connect();
        try{
            $sql = "DELETE FROM donhang WHERE id = :id_don_hang";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_don_hang', $id_don_hang);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở xoaDonHang: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    public function suaDanhGia($id_danh_gia, $danh_gia){
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE danhgia SET danh_gia = :danh_gia WHERE id = :id_danh_gia";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_danh_gia', $id_danh_gia);
            $cmd->bindValue(':danh_gia', $danh_gia);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở suaDanhGia: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
}
?>