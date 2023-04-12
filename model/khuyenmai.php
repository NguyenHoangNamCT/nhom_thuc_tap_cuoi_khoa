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

    //lấy danh sách khuyến mãi
    public function layDanhSachKhuyenMai() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM khuyenmai";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở layDanhSachKhuyenMai: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //lấy khuyến mãi theo id
    public function layKhuyenMaiTheoId($id) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM khuyenmai WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở layKhuyenMaiTheoId: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
    
    //tìm kiếm theo tên gần đúng
    public function timKiemKhuyenMaiTheoTen($ten_khuyen_mai) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM khuyenmai WHERE ten_khuyen_mai LIKE :ten_khuyen_mai";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':ten_khuyen_mai', "%$ten_khuyen_mai%");
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở timKiemKhuyenMaiTheoTen: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
    

}
?>
