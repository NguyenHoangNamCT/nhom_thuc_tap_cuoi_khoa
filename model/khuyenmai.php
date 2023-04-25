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
    public function timKiemKhuyenMaiTheoTen($ten_khuyen_mai)
     {
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
    //tìm kiếm theo tên gần đúng phân trang
    public function timKiemKhuyenMaiTheoTenPhanTrang($ten_khuyen_mai,   $trang, $soluong)
     {
        $db = DATABASE::connect();
        try {
            $batDau = ($trang - 1) * $soluong;
            if($batDau < 0)
                $batDau = 0;
            $sql = "SELECT * FROM khuyenmai WHERE ten_khuyen_mai LIKE :ten_khuyen_mai  ORDER BY id LIMIT :batDau, :soluong";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':ten_khuyen_mai', "%$ten_khuyen_mai%");
            $cmd->bindValue(':batDau', $batDau, PDO::PARAM_INT);
            $cmd->bindValue(':soluong', $soluong, PDO::PARAM_INT);
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
     //đếm tổng số lượng khuyến mãi
	  public function laySoLuongKhuyenMai() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT COUNT(*) as so_luong FROM khuyenmai";
            $result = $db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['so_luong'];
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn : $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
    //khuyến mãi phân trang
    public function layDanhSachKhuyenMaiPhanTrang($trang, $soluong) {
        $dbcon = DATABASE::connect();
        try {
            $batDau = ($trang - 1) * $soluong;
            if($batDau < 0)
                $batDau = 0;
            $sql = "SELECT * FROM khuyenmai ORDER BY id DESC LIMIT :batDau, :soluong";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(':batDau', $batDau, PDO::PARAM_INT);
            $cmd->bindValue(':soluong', $soluong, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
     // Hiển thị danh sách KHUYẾN MÃI
     public function hienThiKhuyenMai() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM khuyenmai WHERE trang_thai = 1";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở hienThiKhuyenMai: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    //khuyến mãi tất cả
    function apDungKhuyenMaiTrenTatCaSanPham()
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE sanpham SET gia_ban = gia_ban * (1 - (SELECT gia_tri FROM khuyenmai WHERE trang_thai = 1) / 100) WHERE trang_thai = 1";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            return true;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở apDungKhuyenMaiTrenTatCaSanPham: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
}
?>
