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

    // lấy ds chi tiết đơn hàng
    public function layDanhSachChiTietDonHang() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT chitietdonhang.*, donhang.id AS id_don_hang, sanpham.ten_san_pham
                    FROM chitietdonhang, sanpham, donhang
                    WHERE chitietdonhang.id_san_pham = sanpham.id
                    AND chitietdonhang.id_don_hang = donhang.id ";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn trong layDanhSachChiTietDonHang: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //lấy chi tiết đơn hàng theo id
    function layChiTietDonHangById($id) {
        $conn = DATABASE::connect();
        try {
            $sql = 'SELECT * FROM chitietdonhang WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $loaiSanPham = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loaiSanPham;
        } catch(PDOException $e) {
            echo "Lỗi truy vấn ở layChiTietDonHangById: " . $e->getMessage();
            return null;
        }
    }

    public function layDanhSachChiTietDonHangTheoIDDonHang($id_don_hang){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT * FROM chitietdonhang WHERE id_don_hang = :id_don_hang";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_don_hang', $id_don_hang);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở layDanhSachChiTietDonHangTheoIDDonHang: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    public function layChiTietDonHang($id_donhang) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT chitietdonhang.*, sanpham.ten_san_pham, sanpham.gia_tien, sanpham.hinh_anh , sanpham.giam_gia
                    FROM chitietdonhang, sanpham 
                    WHERE chitietdonhang.id_san_pham = sanpham.id AND chitietdonhang.id_don_hang = :id_donhang";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_donhang', $id_donhang, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn trong layChiTietDonHang: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
     //đếm tổng số lượng chi tiết đơn hàng
	  public function laySoLuongChiTietDH() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT COUNT(*) as so_luong FROM chitietdonhang";
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
    //ctdh phân trang
    public function layChiTietDonHangPhanTrang( $trang, $soLuong) {
        $dbcon = DATABASE::connect();
        try {
            $batDau = ($trang - 1) * $soLuong;
            if($batDau < 0)
                $batDau = 0;
            $sql = "SELECT chitietdonhang.*, donhang.id AS id_don_hang, sanpham.ten_san_pham
            FROM chitietdonhang, sanpham, donhang
            WHERE chitietdonhang.id_san_pham = sanpham.id
            AND chitietdonhang.id_don_hang = donhang.id 
            order by chitietdonhang.id LIMIT :batDau, :soLuong";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(':batDau', $batDau, PDO::PARAM_INT);
            $cmd->bindValue(':soLuong', $soLuong, PDO::PARAM_INT);
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
    
}
?>