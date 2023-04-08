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
                SET `id_loai_san_pham`=$idLoai,`id_thuong_hieu`=$idThuongHieu,`ten_san_pham`=:tenSP,`mo_ta`=:moTa,`gia_tien`=$giaTien,`giam_gia`=$giamGia,`so_luong`=$soLuong,`hinh_anh`=$hinhAnh WHERE id = $id";
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
//--------------------------------------------------------------------------------------------

//lấy danh sách điện thoại
public function layDanhSachDienThoai(){
    $dbcon = DATABASE::connect();
    try{
        $sql = "SELECT dt.*, h.tenhang FROM dienthoai dt, hangdt h where dt.hangdt_id = h.id";
        $cmd = $dbcon->prepare($sql);
        $cmd->execute();
        $result = $cmd->fetchAll();
        rsort($result); // sắp xếp giảm thay cho order by desc
        return $result;
    }
    catch(PDOException $e){
        $error_message = $e->getMessage();
        echo "<p>Lỗi truy vấn layDanhSachDienThoai: $error_message</p>";
        exit();
    }
}
	// Đếm tổng số mặt hàng
    public function demTongSoDienThoai(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT COUNT(*) FROM dienthoai";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchColumn();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn demTongSoDienThoai: $error_message</p>";
            exit();
        }
    }
	
	// Lấy mặt hàng phân trang (các sản phẩm trong khoảng chỉ định: bắt đầu từ $m, lấy $n mẫu tin)
    // public function laymathangphantrang($m, $n){
    //     $dbcon = DATABASE::connect();
    //     try{
    //         $sql = "SELECT m.*, d.tendanhmuc 
	// 			FROM mathang m, danhmuc d 
	// 			WHERE d.id=m.danhmuc_id 
	// 			ORDER BY id DESC 
	// 			LIMIT $m, $n";
    //         $cmd = $dbcon->prepare($sql);
    //         $cmd->execute();
    //         $ketqua = $cmd->fetchAll();
    //         return $ketqua;
    //     }
    //     catch(PDOException $e){
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }
	
	// Lấy mặt hàng nổi bật top 4 có lượt xem cao nhất
    // public function laymathangnoibat(){
    //     $dbcon = DATABASE::connect();
    //     try{
    //         $sql = "SELECT m.*, d.tendanhmuc FROM mathang m, danhmuc d WHERE d.id=m.danhmuc_id ORDER BY luotxem DESC LIMIT 0, 4";
    //         $cmd = $dbcon->prepare($sql);
    //         $cmd->execute();
    //         $ketqua = $cmd->fetchAll();
    //         return $ketqua;
    //     }
    //     catch(PDOException $e){
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }

	    // Lấy danh sách mặt hàng thuộc 1 danh mục
    // public function laymathangtheodanhmuc($danhmuc_id){
    //     $dbcon = DATABASE::connect();
    //     try{
    //         $sql = "SELECT * FROM mathang WHERE danhmuc_id=:madm" ;
    //         $cmd = $dbcon->prepare($sql);
	// 		$cmd->bindValue(":madm",$danhmuc_id);
    //         $cmd->execute();
    //         $result = $cmd->fetchAll();
    //         return $result;
    //     }
    //     catch(PDOException $e){
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }



    //Lấy điện thoại theo ten
    public function layDienThoaiTheoTen($tendt){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT dt.*, hdt.tenhang FROM dienthoai dt, hangdt hdt WHERE dt.hangdt_id = hdt.id AND tendt=:ten";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":ten", $tendt);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn laymathangtheoid: $error_message</p>";
            exit();
        }
    }

    // Cập nhật lượt xem
    // public function tangluotxem($id){
    //     $dbcon = DATABASE::connect();
    //     try{
    //         $sql = "UPDATE mathang SET luotxem=luotxem+1 WHERE id=:id";
    //         $cmd = $dbcon->prepare($sql);
    //         $cmd->bindValue(":id", $id);
    //         $result = $cmd->execute();            
    //         return $result;
    //     }
    //     catch(PDOException $e){
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }
	
	// Thêm mới
    public function themDienThoai($tenDT, $manHinh, $camSau, $camTruoc, $dungLuong, $CPU, $ram, $trongLuong, $ngayNhap, $tinhTrang, $hangDT_ID, $hinh, $gia, $giamGia)
    {
        $giamGia = 1 - $giamGia/100;
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO `dienthoai`(`tendt`, `manhinh`, `camerasau`, `cameratruoc`, `dungluong`, `cpu`, `ram`, `trongluong`, `ngaynhap`, `tinhtrang`, `hangdt_id`, `hinh`, `gia`, `giamgia`, `luotxem`, `luotmua`)
            VALUES (:tenDT,:manHinh,:camSau,:camTruoc,:dungLuong,:cpu,:ram,:trongLuong,:ngayNhap,$tinhTrang,$hangDT_ID,:hinh,$gia,$giamGia,0,0)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenDT", $tenDT);
            $cmd->bindValue(":manHinh", $manHinh);
            $cmd->bindValue(":camSau", $camSau);
            $cmd->bindValue(":camTruoc", $camTruoc);
            $cmd->bindValue(":dungLuong", $dungLuong);
            $cmd->bindValue(":cpu", $CPU);
            $cmd->bindValue(":ram", $ram);
            $cmd->bindValue(":trongLuong", $trongLuong);
            $cmd->bindValue(":ngayNhap", $ngayNhap);
            $cmd->bindValue(":hinh", $hinh);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn themDienThoai: $error_message</p>";
            exit();
        }
    }

    // Cập nhật 
    public function suaDienThoai($id, $tenDT, $manHinh, $camSau, $camTruoc, $dungLuong, $cpu, $ram, $trongLuong, $ngayNhap, $tinhTrang, $hangDT, $gia, $giamGia, $luotXem, $luotMua, $hinh){
        $giamGia = 1 - $giamGia/100;
        $dbcon = DATABASE::connect();
        // try{
            // if($hinh != '')
            //     $sql = "UPDATE `dienthoai` SET `tendt`=:tenDT,`manhinh`=:manHinh,`camerasau`=camSau,`cameratruoc`=:camTruoc,`dungluong`=:dungLuong,`cpu`=:CPU,`ram`=:Ram,`trongluong`=:trongLuong,`ngaynhap`=:ngayNhap,`tinhtrang`=$tinhTrang,`hangdt_id`=$hangDT,`hinh`=:hinh,`gia`=$gia,`giamgia`=$giamGia,`luotxem`=$luotXem,`luotmua`=$luotMua WHERE id=:id";
            // else 
            //     $sql = "UPDATE `dienthoai` SET `tendt`=:tenDT,`manhinh`=:manHinh,`camerasau`=camSau,`cameratruoc`=:camTruoc,`dungluong`=:dungLuong,`cpu`=:CPU,`ram`=:Ram,`trongluong`=:trongLuong,`ngaynhap`=:ngayNhap,`tinhtrang`=$tinhTrang,`hangdt_id`=$hangDT,`gia`=$gia,`giamgia`=$giamGia,`luotxem`=$luotXem,`luotmua`=$luotMua WHERE id=:id";
            
            if($hinh != '')
                $sql = "UPDATE `dienthoai` SET `tendt`=:tenDT,`manhinh`=:manHinh,`camerasau`=:camSau,`cameratruoc`=:camTruoc,`dungluong`=:dungLuong,`cpu`=:CPU,`ram`=:Ram,`trongluong`=:trongLuong,`ngaynhap`=:ngayNhap,`tinhtrang`=$tinhTrang,`hangdt_id`=$hangDT,`hinh`=:hinh,`gia`=$gia,`giamgia`=$giamGia,`luotxem`=$luotXem,`luotmua`=$luotMua WHERE id=$id";
            else
                $sql = "UPDATE `dienthoai` SET `tendt`=:tenDT,`manhinh`=:manHinh,`camerasau`=:camSau,`cameratruoc`=:camTruoc,`dungluong`=:dungLuong,`cpu`=:CPU,`ram`=:Ram,`trongluong`=:trongLuong,`ngaynhap`=:ngayNhap,`tinhtrang`=$tinhTrang,`hangdt_id`=$hangDT,`gia`=$gia,`giamgia`=$giamGia,`luotxem`=$luotXem,`luotmua`=$luotMua WHERE id=$id";
            
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenDT", $tenDT);
            $cmd->bindValue(":manHinh", $manHinh);
            $cmd->bindValue(":camSau", $camSau);
            $cmd->bindValue(":camTruoc", $camTruoc);
            $cmd->bindValue(":dungLuong", $dungLuong);
            $cmd->bindValue(":CPU", $cpu);
            $cmd->bindValue(":Ram", $ram);
            $cmd->bindValue(":trongLuong", $trongLuong);
            $cmd->bindValue(":ngayNhap", $ngayNhap);
            if($hinh != '')    
                $cmd->bindValue(":hinh", $hinh);
            $result = $cmd->execute();            
            return $result;
        // }
        // catch(PDOException $e){
        //     $error_message = $e->getMessage();
        //     echo "<p>Lỗi truy vấn suaDienThoai: $error_message</p>";
        //     exit();
        // }
    }

}
?>
