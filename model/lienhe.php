<?php
class LIENHE{
    public function themLienHe($ho_ten, $email, $so_dien_thoai, $noi_dung) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO lienhe (ho_ten, email, so_dien_thoai, noi_dung) VALUES (:ho_ten, :email, :so_dien_thoai, :noi_dung)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':ho_ten', $ho_ten);
            $cmd->bindValue(':email', $email);
            $cmd->bindValue(':so_dien_thoai', $so_dien_thoai);
            $cmd->bindValue(':noi_dung', $noi_dung);
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

    public function suaLienHe($id, $hoTen, $email, $soDienThoai, $noiDung) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE lienhe SET ho_ten = :hoTen, email = :email, so_dien_thoai = :soDienThoai, noi_dung = :noiDung WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->bindValue(':hoTen', $hoTen);
            $cmd->bindValue(':email', $email);
            $cmd->bindValue(':soDienThoai', $soDienThoai);
            $cmd->bindValue(':noiDung', $noiDung);
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
}
?>
