<?php
class PHANHOI{
    public function themPhanHoi($idNguoiDung, $idDanhGia, $noiDung) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO phanhoi (id_nguoi_dung, id_danh_gia, noi_dung) VALUES (:idNguoiDung, :idDanhGia, :noiDung)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':idNguoiDung', $idNguoiDung);
            $cmd->bindValue(':idDanhGia', $idDanhGia);
            $cmd->bindValue(':noiDung', $noiDung);
            $cmd->execute();
            return true;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở themPhanHoi: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    public function layDanhSachPhanHoiTheoIDDanhGia($idDanhGia) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT ph.*, nd.hinh_anh, nd.ho_ten from phanhoi ph, nguoidung nd where ph.id_nguoi_dung = nd.id and id_danh_gia = :idDanhGia";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':idDanhGia', $idDanhGia);
            $cmd->execute();
            return $cmd->fetchAll();
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở layDanhSachPhanHoiTheoIDDanhGia: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
    

}
?>
