<?php
class SANPHAM{
    // Lấy danh sách sản phẩm
    public function layDanhSachSanPham(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT sp.*, th.tenthuonghieu, l.ten_loai_san_pham FROM sanpham sp, loaisanpham l, thuonghieu th where sp.id_loai_san_pham = l.id and sp.id_thuong_hieu = th.id";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            rsort($result); // sắp xếp giảm thay cho order by desc
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở layDanhSachSanPham: $error_message</p>";
            exit();
        }
    }
    //Lấy điện thoại theo id
    public function laySanPhamTheoID($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT sp.*, th.tenthuonghieu, l.ten_loai_san_pham FROM sanpham sp, loaisanpham l, thuonghieu th where sp.id_loai_san_pham = l.id and sp.id_thuong_hieu = th.id and sp.id = :id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetch();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn laySanPhamTheoID: $error_message</p>";
            exit();
        }
    }

    public function laySanPhanTheoLoai($ten_loai_can_lay){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT sp.*, th.tenthuonghieu, l.ten_loai_san_pham FROM sanpham sp, loaisanpham l, thuonghieu th where sp.id_loai_san_pham = l.id and sp.id_thuong_hieu = th.id and sp.ten_loai_san_pham = :loaiSPCanTim";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":loaiSPCanTim", $ten_loai_can_lay);
            $cmd->execute();
            $result = $cmd->fetchAll();
            rsort($result); // sắp xếp giảm thay cho order by desc
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở laySanPhanTheoLoai: $error_message</p>";
            exit();
        }
    }

    public function themSanPham($idLoai, $idThuongHieu, $tenSP, $moTa, $giaTien, $giamGia, $soLuong, $hinhAnh)
    {
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO `sanpham`(`id_loai_san_pham`, `id_thuong_hieu`, `ten_san_pham`, `mo_ta`, `gia_tien`, `giam_gia`, `so_luong`, `hinh_anh`) 
            VALUES ($idLoai,$idThuongHieu,:tenSP,:moTa,$giaTien,$giamGia,$soLuong,:hinhAnh)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenSP", $tenSP);
            $cmd->bindValue(":moTa", $moTa);
            $cmd->bindValue(":hinhAnh", $hinhAnh);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn themSanPham: $error_message</p>";
            exit();
        }
    }

    // Xóa 
    public function xoaSanPham($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM `sanpham` WHERE id = :id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn xoaSanPham: $error_message</p>";
            exit();
        }
    }

    //sửa
    public function suaSanPham($id ,$idLoai, $idThuongHieu, $tenSP, $moTa, $giaTien, $giamGia, $soLuong, $hinhAnh=NULL)
    {
        $dbcon = DATABASE::connect();
        try{

            if($hinhAnh != NULL)
                $sql = "UPDATE `sanpham` 
                SET `id_loai_san_pham`=$idLoai,`id_thuong_hieu`=$idThuongHieu,`ten_san_pham`=:tenSP,`mo_ta`=:moTa,`gia_tien`=$giaTien,`giam_gia`=$giamGia,`so_luong`=$soLuong,`hinh_anh`=:hinhAnh WHERE id = $id";
            else
                $sql = "UPDATE `sanpham` 
                SET `id_loai_san_pham`=$idLoai,`id_thuong_hieu`=$idThuongHieu,`ten_san_pham`=:tenSP,`mo_ta`=:moTa,`gia_tien`=$giaTien,`giam_gia`=$giamGia,`so_luong`=$soLuong WHERE id = $id";
            $cmd = $dbcon->prepare($sql);
            if($hinhAnh != NULL)
                $cmd->bindValue(":hinhAnh", $hinhAnh);
            $cmd->bindValue(":tenSP", $tenSP);
            $cmd->bindValue(":moTa", $moTa);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn suaSanPham: $error_message</p>";
            exit();
        }
    }

    //tìm kiếm sp theo tên gần đúng
    public function timkiemSanPham($tenSP) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM sanpham WHERE ten_san_pham LIKE :tenSP";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':tenSP', '%' . $tenSP . '%');
            $cmd->execute();
            $products = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $tenSP;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở timkiemSanPham: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    //tìm kiếm sp theo giá tiền
    public function timKiemSanPhamTheoGiaTien($gia_tien) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM sanpham WHERE gia_tien LIKE :gia_tien";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':gia_tien', '%' . $gia_tien . '%');
            $cmd->execute();
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở timKiemSanPhamTheoGiaTien: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
    
    

}
?>
