<?php
class HOADON{
    public function themHoaDon($id_don_hang, $ngay_tao, $tong_tien) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO hoadon (id_don_hang, ngay_tao, tong_tien) VALUES (:id_don_hang, :ngay_tao, :tong_tien)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_don_hang', $id_don_hang);
            $cmd->bindValue(':ngay_tao', $ngay_tao);
            $cmd->bindValue(':tong_tien', $tong_tien);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở themHoaDon: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }


    public function xoaHoaDon($id) {
        $db = DATABASE::connect();
        try {
            $sql = "DELETE FROM hoadon WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở xoaHoaDon: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }


    public function suaHoaDon($id, $id_don_hang, $ngay_tao, $tong_tien) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE hoadon SET id_don_hang = :id_don_hang, ngay_tao = :ngay_tao, tong_tien = :tong_tien WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_don_hang', $id_don_hang);
            $cmd->bindValue(':ngay_tao', $ngay_tao);
            $cmd->bindValue(':tong_tien', $tong_tien);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở suaHoaDon: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
    function layHoaDonById($id) {
        $conn = DATABASE::connect();
        try {
            $sql = 'SELECT * FROM hoadon WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $loaiThuongHieu = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loaiThuongHieu;
        } catch(PDOException $e) {
            echo "Lỗi truy vấn ở layHoaDonById: " . $e->getMessage();
            return null;
        }
    }

    //lấy ds chi tiết hoa đơn
    public function layDanhSachChiTietHoaDon() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT hoadon.*, donhang.id AS id_don_hang
                    FROM hoadon, donhang
                    WHERE hoadon.id_don_hang = donhang.id";
                 
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn trong layDanhSachChiTietHoaDon: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
}
?>
