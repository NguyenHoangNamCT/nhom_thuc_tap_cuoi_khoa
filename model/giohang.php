<?php
    Class GIOHANG{
        public function layGioHang($id_nguoi_dung) {
            $db = DATABASE::connect();
            try {
                $sql = "SELECT giohang.id_nguoi_dung, giohang.id_san_pham, giohang.so_luong, sanpham.ten, sanpham.gia
                        FROM giohang
                        JOIN sanpham ON giohang.id_san_pham = sanpham.id
                        WHERE giohang.id_nguoi_dung = :id_nguoi_dung";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung);
                $cmd->execute();
                $list = array();
                foreach ($cmd->fetchAll() as $item) {
                    $gio_hang = array(
                        'id_nguoi_dung' => $item['id_nguoi_dung'],
                        'id_san_pham' => $item['id_san_pham'],
                        'ten_san_pham' => $item['ten'],
                        'so_luong' => $item['so_luong'],
                        'gia' => $item['gia']
                    );
                    $list[] = $gio_hang;
                }
                return $list;
            } catch(PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn: $error_message</p>";
                exit();
            } finally {
                DATABASE::close();
            }
        }
    }
// // Tạo mảng SESSION giohang rỗng nếu nó không tồn tại
// if (!isset($_SESSION['giohang']) ) {
//     $_SESSION['giohang'] = array();
// }

// // Hàm thêm sản phẩm vào giỏ
// function themhangvaogio($mahang, $soluong) {
    
//     //Cập nhập Số lượng vào SESSION - Làm tròn
//     $_SESSION['giohang'][$mahang] = round($soluong, 0);
// }

// // Kiểm tra 1 mặt hàng đã có trong giỏ
// function kiemtramathang($mahang){
//     return isset($_SESSION['giohang'][$mahang]);
// }

// // Tăng số lượng của 1 mặt hàng trong giỏ
// function tangsoluong($mahang, $soluongtang) {       
//     $_SESSION['giohang'][$mahang] = $_SESSION['giohang'][$mahang] + round($soluongtang, 0);
    
// }

// // Cập nhật số lượng của giỏ hàng
// function capnhatsoluong($mahang, $soluong) {
//     if (isset($_SESSION['giohang'][$mahang])) {
//         $_SESSION['giohang'][$mahang] = round($soluong, 0);
//     }
// }

// // Xóa một sản phẩm trong giỏ hàng
// function xoamotmathang($mahang) {
//     if (isset($_SESSION['giohang'][$mahang])) {
//         unset($_SESSION['giohang'][$mahang]);
//     }
// }

// // Hàm lấy mảng các sản phẩm trong giohang
// function laygiohang() {
	
//     //Tạo mảng rỗng để lưu danh sách sản phẩm trong giỏ
//     $mangGioHang = array();
//     $dt = new DIENTHOAI();
    
//     //Duyệt mảng SESSION giohang và lấy từng id sản phẩm cùng số lượng
//     foreach ($_SESSION['giohang'] as $mahang => $soluong ) {
//         // Gọi hàm lấy thông tin của sản phẩm theo mã sản phẩm
//         $sp = $dt->layDienThoaiTheoID($mahang);
//         $dongia = $sp['gia']*$sp['giamgia'];
//         $solg = intval($soluong);        
//         // Tính tiền
//         $thanhTien = round($dongia * $soluong, 2);

//         // Lưu thông tin trong mảng items để hiển thị lên giỏ hàng
//         $mangGioHang[$mahang]['tendt'] = $sp['tendt'];
// 		$mangGioHang[$mahang]['hinh'] = $sp['hinh'];
//         $mangGioHang[$mahang]['gia'] = $dongia;
//         $mangGioHang[$mahang]['soluong'] = $solg;
//         $mangGioHang[$mahang]['thanhtien'] = $thanhTien;
//     }
//     return $mangGioHang;
// }

// // Đếm số sản phẩm trong giỏ hàng
// function demhangtronggio() {
//     return count($_SESSION['giohang']);
// }

// // Đếm tổng số lượng các sản phẩm trong giỏ
// function demsoluongtronggio() {
//     $tongsl = 0;
// 	//Lấy mảng các sản phẩm từ trong SESSION
//     $giohang = laygiohang();
//     foreach ($giohang as $item) {
//         $tongsl += $item['soluong'];
//     }
//     return $tongsl;
// }

// // Tính tổng thành tiền trong giỏ hàng
// function tinhtiengiohang () {
//     $tong = 0;
//     $giohang = laygiohang();
//     foreach ($giohang as $mh) {
//         $tong += $mh['gia'] * $mh['soluong'];
//     }
//     return $tong;
// }

// // Xóa tất cả giỏ hàng
// function xoagiohang() {
//     $_SESSION['giohang'] = array();
// }

?>