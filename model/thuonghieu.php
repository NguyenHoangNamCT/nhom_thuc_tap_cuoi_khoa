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

    // Thêm mới
    public function themThuongHieu($ten, $mota, $trangweb, $logo){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO thuongHieu (TenThuongHieu, MoTa, TrangWeb, Logo)
            VALUES (:tenThuongHieu, :moTa, :trangWeb, :logo)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(':ten', $ten);
            $cmd->bindValue(':mota', $mota);
            $cmd->bindValue(':trangweb', $trangweb);
            $cmd->bindValue(':logo', $logo);
            $cmd->execute();
            //trả về id của đối tượng vừa mớI thêm vào csdl           
            $id = $dbcon->lastInsertId();
            return $id;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở themThuongHieu: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
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
    public function suaThuongHieu($id, $tenThuongHieu, $moTa, $trangWeb, $logo){
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE thuongHieu SET TenThuongHieu = :tenThuongHieu, MoTa = :moTa, TrangWeb = :trangWeb, Logo = :logo WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->bindValue(':tenThuongHieu', $tenThuongHieu);
            $cmd->bindValue(':moTa', $moTa);
            $cmd->bindValue(':trangWeb', $trangWeb);
            $cmd->bindValue(':logo', $logo);
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

    //-------------------------------------------------------------
    // Lấy danh sách
    public function layHangDT(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM hangdt";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn layHangDT: $error_message</p>";
            exit();
        }
    }

    // Cập nhật 
    public function suaHangDT($id, $tenHang){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE hangdt SET tenhang=:tenhang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenhang", $tenHang);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function layHangDTTheoID($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM danhmuc WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetch();             
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

}
?>
