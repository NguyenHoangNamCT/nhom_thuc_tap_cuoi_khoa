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

    //tìm kiếm thương hiệu theo tên gân đúng
    public function timKiemThuongHieu($tenth) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM thuongHieu WHERE TenThuongHieu LIKE CONCAT('%', :tenth, '%')";
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
