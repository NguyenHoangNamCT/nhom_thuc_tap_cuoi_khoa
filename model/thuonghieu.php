<?php
class THUONGHIEU{
    // Lấy danh sách loại thương hiệu
    public function layThuongHieu(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM thuonghieu";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn layThuongHieu: $error_message</p>";
            exit();
        }
    }

    //tìm kiếm thương hiệu theo tên gân đúng phân trang
    public function timKiemThuongHieuPhanTrang($tenth, $trang, $soluong) {
        $db = DATABASE::connect();
        try {
            $batDau = ($trang - 1) * $soluong;
            if($batDau < 0)
                $batDau = 0;
            $sql = "SELECT * FROM thuongHieu WHERE TenThuongHieu LIKE CONCAT('%', :tenth, '%') ORDER BY id LIMIT :batDau, :soluong" ;
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':tenth', $tenth);
            $cmd->bindValue(':batDau', $batDau, PDO::PARAM_INT);
            $cmd->bindValue(':soluong', $soluong, PDO::PARAM_INT);
            $cmd->execute();
            $thuongHieu = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $thuongHieu;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở timKiemThuongHieu: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
     //tìm kiếm thương hiệu theo tên gân đúng 
     public function timKiemThuongHieu($tenth) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM thuongHieu WHERE TenThuongHieu LIKE CONCAT('%', :tenth, '%') " ;
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':tenth', $tenth);
            $cmd->execute();
            $thuongHieu = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $thuongHieu;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở timKiemThuongHieu: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    // Thêm mới
    public function themThuongHieu($tenThuongHieu, $moTa, $trangWeb, $logo) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO thuongHieu (TenThuongHieu, MoTa, TrangWeb, Logo) VALUES (:tenThuongHieu, :moTa, :trangWeb, :logo)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":tenThuongHieu", $tenThuongHieu);
            $cmd->bindValue(":moTa", $moTa);
            $cmd->bindValue(":trangWeb", $trangWeb);
            $cmd->bindValue(":logo", $logo);
            $cmd->execute();
            $id = $db->lastInsertId();
            $cmd->closeCursor();
            return $id;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa 
    public function xoaThuongHieu($id){
        $db = DATABASE::connect();
        try{
            $sql = "DELETE FROM thuongHieu WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            //trả về số dòng bị ảnh hưởng (trong trường hợp này là số dòng bị xoá)
            $count = $cmd->rowCount();
            DATABASE::close();
            return $count;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở xoaThuongHieu: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    // Cập nhật 
    public function suaThuongHieu($id, $tenThuongHieu, $moTa, $trangWeb, $logo = NULL){
        $db = DATABASE::connect();
        try{
            if($logo != NULL)
                    $sql = "UPDATE thuongHieu SET TenThuongHieu = :tenThuongHieu, MoTa = :moTa, TrangWeb = :trangWeb, Logo = :logo WHERE id = :id";
                else
                    $sql = "UPDATE thuongHieu SET TenThuongHieu = :tenThuongHieu, MoTa = :moTa, TrangWeb = :trangWeb WHERE id = :id";
           
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->bindValue(':tenThuongHieu', $tenThuongHieu);
            $cmd->bindValue(':moTa', $moTa);
            $cmd->bindValue(':trangWeb', $trangWeb);
            if($logo != NULL)
            $cmd->bindValue(':logo', $logo, PDO::PARAM_STR);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở suaThuongHieu: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
    
    //lấy thương hiệu theo id
    function layThuongHieuById($id) {
        $conn = DATABASE::connect();
        try {
            $sql = 'SELECT * FROM thuonghieu WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $loaiThuongHieu = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loaiThuongHieu;
        } catch(PDOException $e) {
            echo "Lỗi truy vấn ở layThuongHieuById: " . $e->getMessage();
            return null;
        }
    }

    //đếm tổng số lượng thương hiệu
    public function laySoLuongThuongHieu() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT COUNT(*) as so_luong FROM thuonghieu";
            $result = $db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['so_luong'];
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở laySoLuongThuongHieu: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }
     //lấy thương hiệu phân trang
     public function laySanPhamPhanTrang($trang, $soluong) {
        $dbcon = DATABASE::connect();
        try {
            $batDau = ($trang - 1) * $soluong;
            if($batDau < 0)
                $batDau = 0;
            $sql = "SELECT sp.*, th.tenthuonghieu, l.ten_loai_san_pham FROM sanpham sp, loaisanpham l, thuonghieu th where sp.id_loai_san_pham = l.id and sp.id_thuong_hieu = th.id order by sp.id LIMIT :batDau, :soluong";
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

    //lấy thương hiệu phân trang
    public function layThuongHieuPhanTrang($trang, $soluong) {
        $dbcon = DATABASE::connect();
        try {
            $batDau = ($trang - 1) * $soluong;
            if($batDau < 0)
                $batDau = 0;
            $sql = "SELECT * FROM thuonghieu ORDER BY id LIMIT :batDau, :soluong";
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
