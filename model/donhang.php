<?php 
class DONHANG{
    public function themDonHang($id_nguoi_dung, $dia_chi_giao_hang, $dien_thoai_nguoi_nhan, $tong_tien, $tinh_trang_don_hang){
        //chuyển $ngay_dat_mysql sang dạng date time
        //$ngay_dat_mysql = date('Y-m-d H:i:s', strtotime($ngay_dat));
        
        //làm tròn xuống cho tổng tiền vd 3.1 còn 3.0
        $tong_tien = floor($tong_tien);
        $db = DATABASE::connect();
        try{
            $sql = "INSERT INTO donhang (id_nguoi_dung, ngay_dat, dia_chi_giao_hang, dien_thoai_nguoi_nhan, tong_tien, tinh_trang_don_hang) VALUES (:id_nguoi_dung, NOW(), :dia_chi_giao_hang, :dien_thoai_nguoi_nhan, :tong_tien, :tinh_trang_don_hang)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung);
            $cmd->bindValue(':dia_chi_giao_hang', $dia_chi_giao_hang);
            $cmd->bindValue(':dien_thoai_nguoi_nhan', $dien_thoai_nguoi_nhan);
            $cmd->bindValue(':tong_tien', $tong_tien);
            $cmd->bindValue(':tinh_trang_don_hang', $tinh_trang_don_hang);
            $cmd->execute();
            $lastInsertId = $db->lastInsertId();
            return $lastInsertId;
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

    public function suaDonHang($id_don_hang, $ngay_dat, $dia_chi_giao_hang, $dien_thoai_nguoi_nhan, $tong_tien, $tinh_trang_don_hang) {
        //chuyển $ngay_dat_mysql sang dạng date time
        $ngay_dat_mysql = date('Y-m-d H:i:s', strtotime($ngay_dat));
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE donhang SET ngay_dat = :ngay_dat, dia_chi_giao_hang = :dia_chi_giao_hang, dien_thoai_nguoi_nhan = :dien_thoai_nguoi_nhan, tong_tien = :tong_tien, tinh_trang_don_hang = :tinh_trang_don_hang WHERE id = :id_don_hang";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':ngay_dat', $ngay_dat_mysql);
            $cmd->bindValue(':dia_chi_giao_hang', $dia_chi_giao_hang);
            $cmd->bindValue(':dien_thoai_nguoi_nhan', $dien_thoai_nguoi_nhan);
            $cmd->bindValue(':tong_tien', $tong_tien);
            $cmd->bindValue(':tinh_trang_don_hang', $tinh_trang_don_hang);
            $cmd->bindValue(':id_don_hang', $id_don_hang);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở suaDonHang: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    public function capNhatTrangThaiDonHang($id_don_hang, $tinh_trang_don_hang) {
        //chuyển $ngay_dat_mysql sang dạng date time
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE donhang SET tinh_trang_don_hang = :tinh_trang_don_hang WHERE id = :id_don_hang";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':tinh_trang_don_hang', $tinh_trang_don_hang);
            $cmd->bindValue(':id_don_hang', $id_don_hang);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở capNhatTrangThaiDonHang: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    //lấy danh sách đơn hàng
    public function layDanhSachDonHang() {
        $db = DATABASE::connect();
        try {
            $sql = 'SELECT * FROM donhang';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $loaiDonHang = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $loaiDonHang;
        }
        catch(PDOException $e){
            $error_message=$e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

      //lấy đơn hàng theo id
    function layDonHangById($id) {
        $conn = DATABASE::connect();
        try {
            $sql = 'SELECT * FROM donhang WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $loaiDonHang = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loaiDonHang;
        } catch(PDOException $e) {
            echo "Lỗi truy vấn ở layDonHangById: " . $e->getMessage();
            return null;
        }
    }


    //lấy danh sách thương hiệu và cả tên người dùng
    public function layDanhSachDonHangCoTenNguoiDung() {
        $db = DATABASE::connect();
        try{
            $sql = "SELECT donhang.*, nguoidung.ho_ten
                    FROM donhang
                    INNER JOIN nguoidung ON donhang.id_nguoi_dung = nguoidung.id";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $cmd->closeCursor();
            return $result;
        }
        catch(PDOException $e){
            $error_message=$e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    //lấy danh sách đơn hàng
    public function layDanhSachDonHangTheoIDNguoiDung($id_nguoi_dung) {
        $conn = DATABASE::connect();
        try {
            $sql = 'SELECT * FROM donhang where id_nguoi_dung = :id_nguoi_dung order by id DESC';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id_nguoi_dung', $id_nguoi_dung, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            $error_message=$e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
     //đếm tổng số lượng donhang
	  public function laySoLuongDonHang() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT COUNT(*) as so_luong FROM donhang";
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
    //lấy đơn hàng phân trang
    public function layDonHangPhanTrang($trang, $soluong) {
        $dbcon = DATABASE::connect();
        try {
            $batDau = ($trang - 1) * $soluong;
            if($batDau < 0)
                $batDau = 0;
            $sql = "SELECT donhang.*, nguoidung.ho_ten FROM donhang 
                INNER JOIN nguoidung ON donhang.id_nguoi_dung = nguoidung.id
                ORDER BY id DESC LIMIT :batDau, :soluong";
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

    public function layDanhSachDonHangDaMuaCuaNguoiDung($idNguoiDung) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT chitietdonhang.so_luong, chitietdonhang.don_gia, chitietdonhang.id_don_hang, chitietdonhang.id_san_pham, sanpham.id_loai_san_pham, sanpham.id_thuong_hieu, sanpham.ten_san_pham, sanpham.mo_ta, sanpham.gia_tien, sanpham.giam_gia, sanpham.hinh_anh, sanpham.luot_xem, sanpham.luot_mua, donhang.ngay_dat        
            FROM chitietdonhang, sanpham, donhang
            WHERE chitietdonhang.id_san_pham = sanpham.id
            AND chitietdonhang.id_don_hang = donhang.id 
            AND donhang.id_nguoi_dung = :idNguoiDung
            order by chitietdonhang.id_don_hang DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(':idNguoiDung', $idNguoiDung, PDO::PARAM_INT);
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

    public function huyDonHang($idDonHang) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE donhang SET da_huy = 1 WHERE id = :idDonHang";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(':idDonHang', $idDonHang, PDO::PARAM_INT);
            $result = $cmd->execute();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
    
    

    //dùng để xoá sạch đơn hàng đã mua của một ngườI dùng. cái này để test code thoi
    // public function xoaDonHangVipPro($id_don_hang){
    //     $db = DATABASE::connect();
    //     try{
    //         $sql1 = "DELETE FROM hoadon WHERE id_don_hang =". $id_don_hang;
    //         $sql2 = "DELETE FROM chitietdonhang  WHERE id_don_hang = $id_don_hang";
    //         $sql3 = "DELETE FROM thongtindonhang WHERE id = $id_don_hang";
    //         $sql = "DELETE FROM donhang WHERE id = $id_don_hang";

    //         $cmd1 = $db->prepare($sql1);
    //         $cmd1->execute();

    //         $cmd2 = $db->prepare($sql2);
    //         $cmd2->execute();

    //         $cmd3 = $db->prepare($sql3);
    //         $cmd3->execute();

    //         $cmd = $db->prepare($sql);
    //         $cmd->execute();

    //         return;
    //     }
    //     catch(PDOException $e){
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn ở xoaDonHang: $error_message</p>";
    //         exit();
    //     }
    //     finally {
    //         DATABASE::close();
    //     }
    // }
    

}
?>