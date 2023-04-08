<?php
class KHUYENMAI{

    //PHƯƠNG THỨC THÊM
    public function themKhuyenMai($tenKhuyenMai, $moTa, $ngayBatDau, $ngayKetThuc, $trangThai, $giaTri) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO khuyenmai (ten_khuyen_mai, mo_ta, ngay_bat_dau, ngay_ket_thuc, trang_thai, gia_tri) VALUES (:tenKhuyenMai, :moTa, :ngayBatDau, :ngayKetThuc, :trangThai, :giaTri)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':tenKhuyenMai', $tenKhuyenMai);
            $cmd->bindValue(':moTa', $moTa);
            $cmd->bindValue(':ngayBatDau', $ngayBatDau);
            $cmd->bindValue(':ngayKetThuc', $ngayKetThuc);
            $cmd->bindValue(':trangThai', $trangThai);
            $cmd->bindValue(':giaTri', $giaTri);
            $cmd->execute();
            $lastId = $db->lastInsertId();
            return $lastId;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở themKhuyenMai: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //PHƯƠNG THỨC XOÁ
    public function xoaKhuyenMai($id) {
        $db = DATABASE::connect();
        try {
            $sql = "DELETE FROM khuyenmai WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở xoaKhuyenMai: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //SỬA
    public function suaKhuyenMai($id, $tenKhuyenMai, $moTa, $ngayBatDau, $ngayKetThuc, $trangThai, $giaTri) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE khuyenmai SET ten_khuyen_mai = :tenKhuyenMai, mo_ta = :moTa, ngay_bat_dau = :ngayBatDau, ngay_ket_thuc = :ngayKetThuc, trang_thai = :trangThai, gia_tri = :giaTri WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->bindValue(':tenKhuyenMai', $tenKhuyenMai);
            $cmd->bindValue(':moTa', $moTa);
            $cmd->bindValue(':ngayBatDau', $ngayBatDau);
            $cmd->bindValue(':ngayKetThuc', $ngayKetThuc);
            $cmd->bindValue(':trangThai', $trangThai, PDO::PARAM_BOOL);
            $cmd->bindValue(':giaTri', $giaTri, PDO::PARAM_INT);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở suaKhuyenMai: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
}
?>
