<?php 
class DIACHI{
    public function themDiaChi($diaChi, $nguoiDungID)
    {
        $db = DATABASE::connect();
        try{
            $sql = 'INSERT INTO diachi(nguoidung_id, diachi) VALUES (:nguoiDungID, :diaChi)';
            $cmd = $db->prepare($sql);
            $cmd->bindvalue(':nguoiDungID', $nguoiDungID);
            $cmd->bindvalue(':diaChi', $diaChi);
            return $cmd->execute();
        }
        catch(PDOException $e){
            echo '<p>Lỗi truy vấn: '.$e->getMessage().'</p>';
            exit(); 
        }
    }

    public function layDiaChiTheoNguoiDungId($nguoiDungId)
    {
        $db = DATABASE::connect();
        try{
            $sql = "SELECT dc.* FROM diachi dc WHERE dc.nguoidung_id = :ndId";
            $cmd = $db->prepare($sql);
            $cmd->bindvalue(':ndId', $nguoiDungId);
            $cmd->execute();
            return $cmd->fetch();
        }
        catch(PDOException $e){
            echo '<p>Lỗi truy vấn ở phương thức layDiaChiTheoNguoiDungId: '.$e->getMessage().'</p>';
            exit();
        }
    }

    public function layDiaChiTheoId($diaChiId)
    {
        $db = DATABASE::connect();
        try{
            $sql = "SELECT * FROM `diachi` WHERE id = :diaChiId";
            $cmd = $db->prepare($sql);
            $cmd->bindvalue(':diaChiId', $diaChiId);
            $cmd->execute();
            return $cmd->fetch();
        }
        catch(PDOException $e){
            echo '<p>Lỗi truy vấn ở phương thức layDiaChiTheoNguoiDungId: '.$e->getMessage().'</p>';
            exit();
        }
    }

    public function suaDiaChiTheoNguoiDungId($nguoiDungId, $diaChiMoi)
    {
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE `diachi` SET `diachi`= :diaChi WHERE nguoidung_id = :nguoiDungId";
            $cmd = $db->prepare($sql);
            $cmd->bindvalue(':nguoiDungId', $nguoiDungId);
            $cmd->bindvalue(':diaChi', $diaChiMoi);
            return $cmd->execute();
        }
        catch(PDOException $e){
            echo '<p>Lỗi truy vấn ở hàm suaDiaChiTheoNguoiDungId: '.$e->getMessage().'</p>';
            exit(); 
        }
    }
}
?>