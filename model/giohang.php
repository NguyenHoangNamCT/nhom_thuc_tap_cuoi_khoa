<?php
    Class GIOHANG{
        public static function tinhThanhTien($mangGioHang) {
            $tongTien = 0;
            foreach($mangGioHang as $arr)
                $tongTien += $arr['gia_tien']*$arr['so_luong'];
            return $tongTien;
        }


        public function layGioHang($id_nguoi_dung) {
            $db = DATABASE::connect();
            try {
                $sql = "SELECT giohang.id_nguoi_dung, giohang.id_san_pham, giohang.so_luong, sanpham.ten_san_pham, sanpham.gia_tien, sanpham.hinh_anh, sanpham.giam_gia
                        FROM giohang
                        JOIN sanpham ON giohang.id_san_pham = sanpham.id
                        WHERE giohang.id_nguoi_dung = :id_nguoi_dung";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung);
                $cmd->execute();
                return $cmd->fetchAll();
                // $list = array();
                // foreach ($cmd->fetchAll() as $item) {
                //     $gio_hang = array(
                //         'id_nguoi_dung' => $item['id_nguoi_dung'],
                //         'id_san_pham' => $item['id_san_pham'],
                //         'ten_san_pham' => $item['ten_san_pham'],
                //         'so_luong' => $item['so_luong'],
                //         'gia' => $item['gia_tien']
                //     );
                //     $list[] = $gio_hang;
                // }
                // return $list;
            } catch(PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn ở layGioHang: $error_message</p>";
                exit();
            } finally {
                DATABASE::close();
            }
        }


        public function themSanPhamVaoGioHang($id_nguoi_dung, $id_san_pham, $so_luong) {
            $db = DATABASE::connect();
            try {
                //nếu sản phẩm đã có trong giỏ hàng rồi thì tiến hành cập nhật số lượng cho sản phẩm
                $sql = "INSERT INTO giohang(id_nguoi_dung, id_san_pham, so_luong) VALUES (:id_nguoi_dung, :id_san_pham, :so_luong) ON DUPLICATE KEY UPDATE so_luong = so_luong + :so_luong";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung);
                $cmd->bindValue(':id_san_pham', $id_san_pham);
                $cmd->bindValue(':so_luong', $so_luong);
                $cmd->execute();
                $rowCount = $cmd->rowCount();
                return $rowCount;
            }
            catch(PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn ở themSanPhamVaoGioHang: $error_message</p>";
                exit();
            }
            finally {
                DATABASE::close();
            }
        }

        //cập nhật số lượng cho một sản phẩm
        public function capNhatSoLuongSanPhamTrongGioHang($id_nguoi_dung, $id_san_pham, $so_luong) {
            //nếu số lượng nhỏ hơn 1 thì xoá sản phẩm khỏi giỏ hàng luôn k cần cập nhật số lượng
            if($so_luong < 1){
                $this->xoaGioHang($id_nguoi_dung, $id_san_pham);
                return;
            }
            $db = DATABASE::connect();
            try {
                $sql = "UPDATE giohang SET so_luong = :so_luong WHERE id_nguoi_dung = :id_nguoi_dung AND id_san_pham = :id_san_pham";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung);
                $cmd->bindValue(':id_san_pham', $id_san_pham);
                $cmd->bindValue(':so_luong', $so_luong);
                $cmd->execute();
                $rowCount = $cmd->rowCount();
                return $rowCount;
            }
            catch(PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn ở capNhatSoLuongSanPhamTrongGioHang: $error_message</p>";
                exit();
            }
            finally {
                DATABASE::close();
            }
        }

        //xoá giỏ hàng
        public function xoaGioHang($id_nguoi_dung, $id_san_pham) {
            $db = DATABASE::connect();
            try {
                $sql = "DELETE FROM giohang WHERE id_nguoi_dung = :id_nguoi_dung AND id_san_pham = :id_san_pham";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung);
                $cmd->bindValue(':id_san_pham', $id_san_pham);
                $cmd->execute();
                $rowCount = $cmd->rowCount();
                return $rowCount;
            }
            catch(PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn ở xoaGioHang: $error_message</p>";
                exit();
            }
            finally {
                DATABASE::close();
            }
        }

        //Xoá hết sản phẩm trong giỏ hàng của người dùng
        public function xoaSachGioHang($id_nguoi_dung) {
            $db = DATABASE::connect();
            try {
                $sql = "DELETE FROM giohang WHERE id_nguoi_dung = :id_nguoi_dung";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung);
                $cmd->execute();
                $rowCount = $cmd->rowCount();
                return $rowCount;
            }
            catch(PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn ở xoaSachGioHang: $error_message</p>";
                exit();
            }
            finally {
                DATABASE::close();
            }
        }

        //Lấy số lượng tất cả sản phẩm trong giỏ hàng
        public function laySoLuongGioHang($id_nguoi_dung) {
            $db = DATABASE::connect();
            try {
                $sql = "SELECT COUNT(*) AS so_luong FROM giohang WHERE id_nguoi_dung = :id_nguoi_dung";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung);
                $cmd->execute();
                $result = $cmd->fetch(PDO::FETCH_ASSOC);
                return $result['so_luong'];
            }
            catch(PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn ở laySoLuongGioHang: $error_message</p>";
                exit();
            }
            finally {
                DATABASE::close();
            }
        }

        //lấy số lương 1 sản phẩm trong giỏ hàng
        public function laySoLuongSanPhamTrongGioHang($id_nguoi_dung, $id_san_pham) {
            $db = DATABASE::connect();
            try {
                $sql = "SELECT so_luong FROM giohang WHERE id_nguoi_dung = :id_nguoi_dung AND id_san_pham = :id_san_pham";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(':id_nguoi_dung', $id_nguoi_dung);
                $cmd->bindValue(':id_san_pham', $id_san_pham);
                $cmd->execute();
                //fetchColumn dùng khi lấy 1 giá trị duy nhất
                $so_luong = $cmd->fetchColumn();
                $cmd->closeCursor();
                return $so_luong;
            } catch (PDOException $e) {
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