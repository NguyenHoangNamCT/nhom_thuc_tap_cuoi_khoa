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

    //tìm kiếm quảng cáo theo tiêu đề
    public function timKiemQuangCaoPhanTrang($tieu_de, $trang, $soluong) 
    {
        $db = DATABASE::connect();
        try {
            $batDau = ($trang - 1) * $soluong;
            if($batDau < 0)
                $batDau = 0;
            $tieu_de = "%{$tieu_de}%"; //Thêm % ở đầu và cuối chuỗi để tìm kiếm gần đúng
            $sql = "SELECT * FROM quangcao WHERE tieu_de LIKE :tieu_de ORDER BY id LIMIT :batDau, :soluong";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':tieu_de', $tieu_de, PDO::PARAM_STR);
            $cmd->bindValue(':batDau', $batDau, PDO::PARAM_INT);
            $cmd->bindValue(':soluong', $soluong, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở timKiemQuangCao: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
     //tìm kiếm quảng cáo theo tiêu đề
     public function timKiemQuangCao($tieu_de) 
     {
         $db = DATABASE::connect();
         try {
             $tieu_de = "%{$tieu_de}%"; //Thêm % ở đầu và cuối chuỗi để tìm kiếm gần đúng
             $sql = "SELECT * FROM quangcao WHERE tieu_de LIKE :tieu_de ";
             $cmd = $db->prepare($sql);
             $cmd->bindValue(':tieu_de', $tieu_de, PDO::PARAM_STR);
             $cmd->execute();
             $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
             return $result;
         }
         catch(PDOException $e) {
             $error_message = $e->getMessage();
             echo "<p>Lỗi truy vấn ở timKiemQuangCao: $error_message</p>";
             exit();
         }
         finally {
             DATABASE::close();
         }
     }
 

    //
    public function TimKiemQuangCaoByUrl($url) {
        $db = DATABASE::connect();
        $sql = "SELECT * FROM quangcao WHERE url = ?";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $url);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
     //đếm tổng số lượng thông tin quảng cáo
     public function laySoLuongQuangCao() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT COUNT(*) as so_luong FROM quangcao";
            $result = $db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['so_luong'];
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở laySoLuongQuangCao: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
    //quảng cáo phân trang
    public function layQuangCaoPhanTrang($trang, $soluong) {
        $dbcon = DATABASE::connect();
        try {
            $batDau = ($trang - 1) * $soluong;
            if($batDau < 0)
                $batDau = 0;
            $sql = "SELECT * FROM quangcao ORDER BY id DESC LIMIT :batDau, :soluong";
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
    
    
}
?>
