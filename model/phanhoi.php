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

    //xoá phản hồi theo id_danh_gia
    public function xoaPhanHoiTheoIDDanhGia($id_danh_gia) {
        $db = DATABASE::connect();
        try {
            $sql = "DELETE FROM phanhoi WHERE id_danh_gia = :id_danh_gia";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_danh_gia', $id_danh_gia, PDO::PARAM_INT);
            $cmd->execute();
            return true;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở xoaPhanHoiTheoIDDanhGia: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //xoá phản hồi theo id
    public function xoaPhanHoi($id) {
        $db = DATABASE::connect();
        try {
            $sql = "DELETE FROM phanhoi WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            return true;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn trong xoaPhanHoi: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
    
    
    

}
?>
