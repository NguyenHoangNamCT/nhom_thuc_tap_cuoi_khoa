<?php
class LIENHE{
    public function themLienHe($ho_ten, $email, $so_dien_thoai) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO lienhe (ho_ten, email, so_dien_thoai) VALUES (:ho_ten, :email, :so_dien_thoai)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':ho_ten', $ho_ten);
            $cmd->bindValue(':email', $email);
            $cmd->bindValue(':so_dien_thoai', $so_dien_thoai);
            $cmd->execute();
            $lastInsertedId = $db->lastInsertId();
            return $lastInsertedId;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở themLienHe: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    public function xoaLienHe($id){
        $db = DATABASE::connect();
        try{
            $sql = "DELETE FROM lienhe WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở xoaLienHe: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    public function suaLienHe($id, $hoTen, $email, $soDienThoai) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE lienhe SET ho_ten = :hoTen, email = :email, so_dien_thoai = :soDienThoai WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->bindValue(':hoTen', $hoTen);
            $cmd->bindValue(':email', $email);
            $cmd->bindValue(':soDienThoai', $soDienThoai);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở suaLienHe: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    //lấy ds liên hệ
    public function layDanhSachLienHe() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM lienhe";
            $result = $db->query($sql);
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở layDanhSachLienHe: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //lấy liên hệ theo id
    function layLienHeById($id) {
        $conn = DATABASE::connect();
        try {
            $sql = 'SELECT * FROM lienhe WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $loaiSanPham = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loaiSanPham;
        } catch(PDOException $e) {
            echo "Lỗi truy vấn ở layLienHeById: " . $e->getMessage();
            return null;
        }
    }
     //đếm tổng số lượng liên hệ
	  public function laySoLuongLienHe() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT COUNT(*) as so_luong FROM lienhe";
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
    //liên hệ phân trang
    public function layLienHePhanTrang($trang, $soluong) {
        $dbcon = DATABASE::connect();
        try {
            $batDau = ($trang - 1) * $soluong;
            if ($batDau < 0) {
                $batDau = 0;
            }
            $sql = "SELECT * FROM lienhe ORDER BY id LIMIT :batDau, :soluong";
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
    
    // hiển thị liên hệ
    public function hienThiLienHe() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM lienhe";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở hienThiLienHe: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
    
}
?>
