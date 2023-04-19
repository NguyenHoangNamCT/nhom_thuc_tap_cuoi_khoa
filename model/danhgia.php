<?php
class DANHGIA{
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
    

}
?>
