<?php 
class KHACHHANG{
    public function themKhachHang($email, $hoTen, $SDT)
    {
        $db = DATABASE::connect();
        try{
            $sql = 'INSERT INTO nguoidung (email, sodienthoai, matkhau, hoten, loai, trangthai) values(:email, :sdt, :mk, :hoten, :loai, :trangthai)';
            $cmd = $db->prepare($sql);
            $cmd->bindvalue(':email', $email);
            $cmd->bindvalue(':sdt', $SDT);
            $cmd->bindvalue(':mk', md5($SDT));
            $cmd->bindvalue(':hoten', $hoTen);
            $cmd->bindvalue(':loai', 3);
            $cmd->bindvalue(':trangthai', 1);
            $cmd->execute();
            return $db->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo '<p>Lỗi truy vấn ở themKhachHang: '.$e->getMessage().'</p>';
            exit();
        }
    }
}
?>