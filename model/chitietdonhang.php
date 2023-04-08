<?php
class CHITIETDONHANG{
    public function themChiTietDonHang($id_don_hang, $id_san_pham, $so_luong, $don_gia) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO chitietdonhang (id_don_hang, id_san_pham, so_luong, don_gia) VALUES (:id_don_hang, :id_san_pham, :so_luong, :don_gia)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_don_hang', $id_don_hang);
            $cmd->bindValue(':id_san_pham', $id_san_pham);
            $cmd->bindValue(':so_luong', $so_luong);
            $cmd->bindValue(':don_gia', $don_gia);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở themChiTietDonHang: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    public function xoaChiTietDonHang($id) {
        $db = DATABASE::connect();
        try {
            $sql = "DELETE FROM chitietdonhang WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở xoaChiTietDonHang: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    public function suaChiTietDonHang($id, $id_don_hang, $id_san_pham, $so_luong, $don_gia) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE chitietdonhang SET id_don_hang = :id_don_hang, id_san_pham = :id_san_pham, so_luong = :so_luong, don_gia = :don_gia WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_don_hang', $id_don_hang);
            $cmd->bindValue(':id_san_pham', $id_san_pham);
            $cmd->bindValue(':so_luong', $so_luong);
            $cmd->bindValue(':don_gia', $don_gia);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở suaChiTietDonHang: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
}
?>