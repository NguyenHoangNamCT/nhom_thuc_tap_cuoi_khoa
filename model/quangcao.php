<?php
class QUANGCAO{
    public function themQuangCao($tieuDe, $hinhAnh, $url, $trangThai){
        $db = DATABASE::connect();
        try{
            $sql = "INSERT INTO quangcao (tieu_de, hinh_anh, url, trang_thai) VALUES (:tieuDe, :hinhAnh, :url, :trangThai)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':tieuDe', $tieuDe);
            $cmd->bindValue(':hinhAnh', $hinhAnh);
            $cmd->bindValue(':url', $url);
            $cmd->bindValue(':trangThai', $trangThai, PDO::PARAM_INT);
            $cmd->execute();
            $lastId = $db->lastInsertId();
            return $lastId;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở themQuangCao: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    // Xoá quảng cáo
    public function xoaQuangCao($id){
        $db = DATABASE::connect();
        try{
            $sql = "DELETE FROM quangcao WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở xoaQuangCao: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    //sửa quảng cáo
    public function suaQuangCao($id, $tieuDe,  $url, $trangThai, $hinhAnh = NULL) {
        $db = DATABASE::connect();
        try {
            if($hinhAnh != NULL)
                    $sql = "UPDATE quangcao SET tieu_de = :tieuDe, hinh_anh = :hinhAnh, url = :url, trang_thai = :trangThai WHERE id = :id";
                else
                    $sql = "UPDATE quangcao SET tieu_de = :tieuDe, url = :url, trang_thai = :trangThai WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->bindValue(':tieuDe', $tieuDe, PDO::PARAM_STR);
            if($hinhAnh != NULL )
                $cmd->bindValue(':hinhAnh', $hinhAnh, PDO::PARAM_STR);
            $cmd->bindValue(':url', $url, PDO::PARAM_STR);
            $cmd->bindValue(':trangThai', $trangThai, PDO::PARAM_BOOL);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở suaQuangCao: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    // lấy ds quảng cáo
    public function layDanhSachQuangCao() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM quangcao";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở layDanhSachQuangCao: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //lấy quảng cáo theo id
    function layQuangCaoById($id) {
        $conn = DATABASE::connect();
        try {
            $sql = 'SELECT * FROM quangcao WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $loaiSanPham = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loaiSanPham;
        } catch(PDOException $e) {
            echo "Lỗi truy vấn ở layQuangCaoById: " . $e->getMessage();
            return null;
        }
    }
}
?>
