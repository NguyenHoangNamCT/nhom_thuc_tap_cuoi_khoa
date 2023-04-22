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
            $sql = "SELECT sp.*, th.tenthuonghieu, l.ten_loai_san_pham FROM sanpham sp, loaisanpham l, thuonghieu th where sp.id_loai_san_pham = l.id and sp.id_thuong_hieu = th.id and ten_san_pham LIKE :tenSP";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':tenSP', '%' . $tenSP . '%');
            $cmd->execute();
            return $cmd->fetchAll(PDO::FETCH_ASSOC);
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
            $sql = "SELECT sp.*, th.tenthuonghieu, l.ten_loai_san_pham FROM sanpham sp, loaisanpham l, thuonghieu th where sp.id_loai_san_pham = l.id and sp.id_thuong_hieu = th.id and gia_tien LIKE :gia_tien";
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
    
    //tìm kiếm sp theo giá tiền
    public function timKiemSanPhamTheoGiaTienToiDa($gia_tien) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT sp.*, th.tenthuonghieu, l.ten_loai_san_pham FROM sanpham sp, loaisanpham l, thuonghieu th where sp.id_loai_san_pham = l.id and sp.id_thuong_hieu = th.id and gia_tien <= :gia_tien";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':gia_tien', $gia_tien);
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

    //tìm kiếm sp theo giá tiền
    public function timKiemSanPhamTheoGiaTienToiThieu($gia_tien) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT sp.*, th.tenthuonghieu, l.ten_loai_san_pham FROM sanpham sp, loaisanpham l, thuonghieu th where sp.id_loai_san_pham = l.id and sp.id_thuong_hieu = th.id and gia_tien >= :gia_tien";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':gia_tien', $gia_tien);
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

    //tăng lượt xem
    public function tangLuotXem($id){
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE sanpham SET luot_xem = luot_xem + 1 WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở tangLuotXem: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
    
    //mỗi lần mua không cần biết mua bao nhiêu chỉ tăng 1
    public function tangLuotMua($id){
        $db = DATABASE::connect();
        try{
            $sql = "UPDATE sanpham SET luot_mua = luot_mua + 1 WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở tangLuotMua: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }

    //mua bao nhiêu thì tăng bao nhiêu
    public function tangLuotMuaTheoSoLuongSanPhamBanDuoc($id, $soLuong) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE sanpham SET luot_mua = luot_mua + :soLuong WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->bindValue(':soLuong', $soLuong, PDO::PARAM_INT);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở tangLuotMua: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //Giảm số lượng
    public function giamSoLuongSanPham($id, $soLuong)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE sanpham SET so_luong = so_luong - :so_luong WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->bindValue(':so_luong', $soLuong, PDO::PARAM_INT);
            $cmd->execute();
            $rowCount = $cmd->rowCount();
            return $rowCount;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở giamSoLuongSanPham: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //lấy số lượng sản phẩm theo id
    public function laySoLuongSanPhamTheoID($id) {
        $db = DATABASE::connect();
        try{
            $sql = "SELECT so_luong FROM sanpham WHERE id = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetch(PDO::FETCH_ASSOC);
            return $result['so_luong'];
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở laySoLuongSanPham: $error_message</p>";
            exit();
        }
        finally {
            DATABASE::close();
        }
    }
    
    //lấy sản phẩm phân trang
    public function laySanPhamPhanTrang($trang, $soluong) {
        $dbcon = DATABASE::connect();
        try {
            $batDau = ($trang - 1) * $soluong;
            if($batDau < 0)
                $batDau = 0;
            $sql = "SELECT sp.*, th.tenthuonghieu, l.ten_loai_san_pham FROM sanpham sp, loaisanpham l, thuonghieu th where sp.id_loai_san_pham = l.id and sp.id_thuong_hieu = th.id LIMIT :batDau, :soluong";
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
    
    

    //lấy sản phẩm nổi bật
    public function laySanPhamNoiBat($soLuongSanPham = 4) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM sanpham ORDER BY luot_xem DESC LIMIT :so_luong_san_pham";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(':so_luong_san_pham', $soLuongSanPham, PDO::PARAM_INT);
            $cmd->execute();
            $ketqua = $cmd->fetchAll();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    //đếm tổng số lượng sản phẩm
    public function laySoLuongSanPham() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT COUNT(*) as so_luong_san_pham FROM sanpham";
            $result = $db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['so_luong_san_pham'];
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn ở laySoLuongSanPham: $error_message</p>";
            exit();
        } finally {
            DATABASE::close();
        }
    }

    //-------------------------- PHương thức tĩnh --------------------------
    public static function mangSanPhamKhongCoTrongLoaiSP($mangSanPham, $idLoai) {
        foreach ($mangSanPham as $arr) {
            if ($arr['id_loai_san_pham'] == $idLoai)
                return false;
        }
        return true;
    }

}
?>
