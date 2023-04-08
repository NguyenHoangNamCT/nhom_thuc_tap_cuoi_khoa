<?php
class DANHGIA{
    //Thêm
    public function themDanhGia($id_nguoi_dung, $id_san_pham, $danh_gia){
        $db = DATABASE::connect();
        try{
            $sql = "INSERT INTO danhgia (id_nguoi_dung, id_san_pham, danh_gia) VALUES (:id_nguoi_dung, :id_san_pham, :danh_gia)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung);
            $cmd->bindValue(':id_san_pham', $id_san_pham);
            $cmd->bindValue(':danh_gia', $danh_gia);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở themDanhGia: $error_message</p>";
            exit();
        }
        finally {
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

    //Sửa
    public function suaDanhGia($id, $danhGia){
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE danhgia SET danh_gia = :danhGia WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->bindValue(':danhGia', $danhGia, PDO::PARAM_STR);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở suaDanhGia: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
}
?>
