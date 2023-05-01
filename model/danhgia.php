<?php
class DANHGIA{
    //lấy danh sách đánh giá theo id sản phẩm
    public function layDanhSachDanhGiaTheoIDSanPham($id_san_pham) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT danhgia.*, nguoidung.ho_ten FROM danhgia, nguoidung WHERE danhgia.id_nguoi_dung = nguoidung.id and id_san_pham = :id_san_pham";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_san_pham', $id_san_pham, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở layDanhSachDanhGiaTheoIDSanPham: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //lây đánh giá theo id ngườI dùng và id sản phẩm
    public function layDanhSachDanhGiaTheoIDNguoiDungVaIDSanPham($id_nguoi_dung, $id_san_pham) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM danhgia WHERE id_nguoi_dung = :id_nguoi_dung AND id_san_pham = :id_san_pham";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung, PDO::PARAM_INT);
            $cmd->bindValue(':id_san_pham', $id_san_pham, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở layDanhSachDanhGia: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
    //thêm đánh giá
    public function themDanhGia($id_nguoi_dung, $id_san_pham, $diem_danh_gia, $noi_dung, $hinh_anh) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO danhgia (id_nguoi_dung, id_san_pham, diem_danh_gia, noi_dung, hinh_anh) VALUES (:id_nguoi_dung, :id_san_pham, :diem_danh_gia, :noi_dung, :hinh_anh)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung, PDO::PARAM_INT);
            $cmd->bindValue(':id_san_pham', $id_san_pham, PDO::PARAM_INT);
            $cmd->bindValue(':diem_danh_gia', $diem_danh_gia, PDO::PARAM_INT);
            $cmd->bindValue(':noi_dung', $noi_dung, PDO::PARAM_STR);
            $cmd->bindValue(':hinh_anh', $hinh_anh, PDO::PARAM_STR);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở themDanhGia: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
    
    

    //Xoá
    public function xoaDanhGia($id){
        $db = DATABASE::connect();
        try{
            $sql = "DELETE FROM danhgia WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở xoaDanhGia: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    //sửa đánh giá
    public function suaDanhGia($id, $diem_danh_gia, $noi_dung, $hinh_anh) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE danhgia SET diem_danh_gia = :diem_danh_gia, noi_dung = :noi_dung, hinh_anh = :hinh_anh WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->bindValue(':diem_danh_gia', $diem_danh_gia, PDO::PARAM_STR);
            $cmd->bindValue(':noi_dung', $noi_dung, PDO::PARAM_STR);
            $cmd->bindValue(':hinh_anh', $hinh_anh, PDO::PARAM_STR);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở suaDanhGia: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //đếm số lượt đánh giá của sản phẩm này từ ngưỜi dùng này
    public function demSoDanhGiaCuaNguoiDungChoSanPham($idNguoiDung, $idSanPham) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT COUNT(*) FROM danhgia WHERE id_nguoi_dung = :idNguoiDung AND id_san_pham = :idSanPham";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(':idNguoiDung', $idNguoiDung, PDO::PARAM_INT);
            $cmd->bindValue(':idSanPham', $idSanPham, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchColumn();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
    
    //đếm số lượt đánh giá của sản phẩm
    public function demSoLuongDanhGiaSanPham($id_san_pham) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT COUNT(*) FROM danhgia WHERE id_san_pham = :id_san_pham";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(':id_san_pham', $id_san_pham, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchColumn();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở demSoLuongDanhGiaSanPham: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //Tổng điểm đánh giá của sản phẩm
    public function tongDiemDanhGiaSanPham($id_san_pham) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT SUM(diem_danh_gia) FROM danhgia WHERE id_san_pham = :id_san_pham";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(':id_san_pham', $id_san_pham, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchColumn();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

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


}
?>
