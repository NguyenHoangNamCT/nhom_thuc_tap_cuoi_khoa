<?php
class THONGTINDONHANG{
    
    public function layDanhSachThongTinDonHang(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM thongtindonhang";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            rsort($result); // sắp xếp giảm thay cho order by desc
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở layDanhSachThongTinDonHang: $error_message</p>";
            exit();
        }
    }

    public function themThongTinDonHang($ten_khach_hang, $dia_chi_nguoi_nhan, $so_dien_thoai_nguoi_nhan, $ngay_giao_hang, $tien_ship, $phi_van_chuyen, $ghi_chu) {
        $db = DATABASE::connect();
        try{
            $sql = "INSERT INTO thongtindonhang (ten_khach_hang, dia_chi_nguoi_nhan, so_dien_thoai_nguoi_nhan, ngay_giao_hang, tien_ship, phi_van_chuyen, ghi_chu) VALUES (:ten_khach_hang, :dia_chi_nguoi_nhan, :so_dien_thoai_nguoi_nhan, :ngay_giao_hang, :tien_ship, :phi_van_chuyen, :ghi_chu)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':ten_khach_hang', $ten_khach_hang);
            $cmd->bindValue(':dia_chi_nguoi_nhan', $dia_chi_nguoi_nhan);
            $cmd->bindValue(':so_dien_thoai_nguoi_nhan', $so_dien_thoai_nguoi_nhan);
            $cmd->bindValue(':ngay_giao_hang', $ngay_giao_hang);
            $cmd->bindValue(':tien_ship', $tien_ship);
            $cmd->bindValue(':phi_van_chuyen', $phi_van_chuyen);
            $cmd->bindValue(':ghi_chu', $ghi_chu);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở themThongTinDonHang: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    public function xoaThongTinDonHang($id) {
        $db = DATABASE::connect();
        try{
            $sql = "DELETE FROM thongtindonhang WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở xoaThongTinDonHang: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    public function suaThongTinDonHang($id, $ten_khach_hang, $dia_chi_nguoi_nhan, $so_dien_thoai_nguoi_nhan, $ngay_giao_hang, $tien_ship, $phi_van_chuyen, $ghi_chu) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE thongtindonhang SET ten_khach_hang=:ten_khach_hang, dia_chi_nguoi_nhan=:dia_chi_nguoi_nhan, so_dien_thoai_nguoi_nhan=:so_dien_thoai_nguoi_nhan, ngay_giao_hang=:ngay_giao_hang, tien_ship=:tien_ship, phi_van_chuyen=:phi_van_chuyen, ghi_chu=:ghi_chu WHERE id=:id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->bindValue(':ten_khach_hang', $ten_khach_hang);
            $cmd->bindValue(':dia_chi_nguoi_nhan', $dia_chi_nguoi_nhan);
            $cmd->bindValue(':so_dien_thoai_nguoi_nhan', $so_dien_thoai_nguoi_nhan);
            $cmd->bindValue(':ngay_giao_hang', $ngay_giao_hang);
            $cmd->bindValue(':tien_ship', $tien_ship);
            $cmd->bindValue(':phi_van_chuyen', $phi_van_chuyen);
            $cmd->bindValue(':ghi_chu', $ghi_chu);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở suaThongTinDonHang: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

     //lấy thông tin đơn hàng theo id
     function layThongTinDonHangById($id) {
        $conn = DATABASE::connect();
        try {
            $sql = 'SELECT * FROM thongtindonhang WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $loaiThuongHieu = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loaiThuongHieu;
        } catch(PDOException $e) {
            echo "Lỗi truy vấn ở layThongTinDonHangById: " . $e->getMessage();
            return null;
        }
    }

    // tìm kiếm bằng tên khách hàng
    public function timKiemDonHangTheoTenKhachHang($ten_khach_hang) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM thongtindonhang WHERE ten_khach_hang = :ten_khach_hang";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':ten_khach_hang', $ten_khach_hang);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở timKiemDonHangTheoTenKhachHang: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
    
}
?>
