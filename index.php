<?php 
require('model/database.php');
require('model/sanpham.php');
require('model/loaisanpham.php');
require('model/thuonghieu.php');
require('model/nguoidung.php');
require('model/giohang.php');
require('model/donhang.php');
require('model/chitietdonhang.php');
require('model/thongtindonhang.php');
require('model/danhgia.php');
require('model/hoadon.php');
//------------------------------

if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}


$sp = new SANPHAM();
$lsp = new LOAISP();
$th = new THUONGHIEU();
$nd = new NGUOIDUNG();
$gh = new GIOHANG();
$dh = new DONHANG();
$ctdh = new CHITIETDONHANG();
$ttdh = new THONGTINDONHANG();
$dg = new DANHGIA();
$hd = new HOADON();

$mangLoaiSP = $lsp->layLoaiSP();
$mangThuongHieu = $th->layThuongHieu();

switch($action){
    case "macdinh": 
        include("main.php");
        break;
    case "xemChiTiet":
        $sp_id = $_GET['id'];
        $sp->tangLuotXem($sp_id);
        include('detail.php');
        break;
    case "locSanPhamTheoLoai":
        $l_id = $_GET['id'];
        //Nếu đã bấm vào lọc thì xoá biến từ khoá
        include("main.php");
        break;
    case "locSanPhamTheoThuongHieu":
        $th_id = $_GET['id'];
        //Nếu đã bấm vào lọc thì xoá biến từ khoá
        include("main.php");
        break;
    case "dangNhap":  
        if(isset($_SESSION['nguoiDung'])){
            include('main.php');
            return;
        }      
        include("login_form.php");
        break;
    case "xuLyDangNhap":
        //nếu ngườI dùng click vào nút đăng ký ở trang đăng nhập thì đi đến trang đăng ký ngược lại thì xử lý đăng nhập bình thường
        $tenDangNhap = $_POST['txtUserName'];
        $matKhau = $_POST['txtPassword'];
        if($nd->kiemTraNguoiDungHopLe($tenDangNhap, $matKhau))
        {
            $_SESSION['nguoiDung'] = $nd->layNguoiDungTheoTenDangNhap($tenDangNhap);
            include('main.php');
        }
        else    
            include('login_form.php');
        break;
    case "dangXuat":
        unset($_SESSION['nguoiDung']);
        include('main.php');
        break;
    case "xemGioHang":
		include('cart.php');
        break;
    case "choVaoGio":
        $id = $_REQUEST['id'];//id sản phẩm
        $soLuong = $_REQUEST['soLuong'];
        if($soLuong == '')
            $soLuong = 1;
        
        $soLuongTrongKho = $sp->laySoLuongSanPhamTheoID($id);
        $soLuongTrongGioHang = $gh->laySoLuongSanPhamTrongGioHang($_SESSION['nguoiDung']['id'], $id);
        if($soLuong > $soLuongTrongKho || ($soLuongTrongGioHang + $soLuong) > $soLuongTrongKho)
            $messageThem = "Không thể thêm nhiều hơn số lượng sản phẩm có trong kho. trong kho chỉ còn ".$soLuongTrongKho." sản phẩm.";
        else
            $gh->themSanPhamVaoGioHang($_SESSION['nguoiDung']['id'], $id, $soLuong);
        include('cart.php');
        break;
    case "xoaSPTrongGio":
        $idSP = $_REQUEST['idSanPham'];
        $gh->xoaGioHang($_SESSION['nguoiDung']['id'], $idSP);
        include('cart.php');
        break;
    case 'capNhatSoLuong':
        $mangGioHang = $gh->layGioHang($_SESSION['nguoiDung']['id']);
        // var_dump($mangGioHang);
        //Nhận dữ liệu từ form, bên form gửi txtSoLuong+id_san_pham
        $end = count($mangGioHang) - 1;
        $mangVuotSoLuong = array();
        $count = 0;
        foreach($mangGioHang as $key_i => $arr){
            
            if($sp->laySoLuongSanPhamTheoID($arr['id_san_pham']) < $_POST['txtSoLuong'.$arr['id_san_pham']]){
                if($count == 0)
                    $message = '';
                $mangVuotSoLuong[$arr['ten_san_pham'].'_'.$arr['id_san_pham']] = $sp->laySoLuongSanPhamTheoID($arr['id_san_pham']);
                $count++;
                $capNhatThatBai = true;
            }
            else{
                $soLuongMoi = $_POST['txtSoLuong'.$arr['id_san_pham']];
                $gh->capNhatSoLuongSanPhamTrongGioHang($_SESSION['nguoiDung']['id'], $arr['id_san_pham'], $soLuongMoi);
                if($key_i == $end)
                    $capNhatThanhCong = true;
            }
        }
        if(isset($message)){
            foreach($mangVuotSoLuong as $key => $str){
                $pos = strpos($key, "_"); // Tìm vị trí của ký tự "_"
                $keyTMP = substr($key, 0, $pos); // Cắt chuỗi từ vị trí đầu đến vị trí của ký tự "_"
                if($message == '')
                    $message .= $keyTMP.': Chỉ còn ' . $str . ' sản phẩm';
                else
                    $message .= ', ' . $keyTMP.': Chỉ còn ' . $str . ' sản phẩm';
            }
            if($count > 1)
                $messageTMP = 'Các sản phẩm '. $message .' Vui lòng nhập số lượng sản phẩm nhỏ hơn số lượng có trong kho';
            else
                $messageTMP = 'Sản phẩm'. $message . ' Vui lòng nhập số lượng sản phẩm nhỏ hơn số lượng có trong kho';
            $message = $messageTMP;
        }
        include('cart.php');
        break;
    case "datMua":
        $phiVanChuyen = 25000;
        include("checkOut.php");
        break;
    case "taoDonHang":
        //Thay đổi thông tin người dùng nếu có
        $email = $_POST['inputEmail'];
        $sdt = $_POST['inputSDT'];
        $diaChi = $_POST['inputDiaChi'];
        $nd->capNhatDiaChiDienThoaiEmailNguoiDung($_SESSION['nguoiDung']['id'], $diaChi, $sdt, $email);
        $_SESSION['nguoiDung'] = $nd->layThongTinNguoiDungTheoID($_SESSION['nguoiDung']['id']);

        //tính tổng tiền cho đơn hàng
        $tongTien = 0;
        $phiVanChuyen = 25000;
        $mangGioHang = $gh->layGioHang($_SESSION['nguoiDung']['id']);
        foreach($mangGioHang as $arr)
            $tongTien += $arr['so_luong'] * ($arr['gia_tien'] * (1 - $arr['giam_gia']/100));
        $tongTien+=$phiVanChuyen;

        //Tạo đơn hàng
        $idDH = $dh->themDonHang($_SESSION['nguoiDung']['id'], $diaChi, $sdt, $tongTien, 0);

        //Thêm các chi tiết đơn hàng, và tăng lượt mua, giảm số lượng trong kho
        foreach($mangGioHang as $arr){
            $ctdh->themChiTietDonHang($idDH, $arr['id_san_pham'], $arr['so_luong'], ($arr['gia_tien']*(1-$arr['giam_gia']/100)));
            $sp->tangLuotMuaTheoSoLuongSanPhamBanDuoc($arr['id_san_pham'], $arr['so_luong']);
            $sp->giamSoLuongSanPham($arr['id_san_pham'], $arr['so_luong']);
        }
            

        //Thêm thông tin đơn hàng
        $ttdh->themThongTinDonHang($idDH, $_SESSION['nguoiDung']['ho_ten'], $diaChi, $sdt, "0001-01-01 00:00:00", $phiVanChuyen, "kHÔNG CÓ GHI CHÚ");

        $hd->themHoaDon($idDH, $tongTien);

        //Xoá hết thông tin giỏ hàng
        $gh->xoaSachGioHang($_SESSION['nguoiDung']['id']);
        
        include("thanks.php");
        break;
    case 'updateUser':
        $id = $_POST["id"];
        $ho_ten = $_POST["txthoten"];
        $dia_chi = $_POST["txtDC"];
        $dien_thoai = $_POST["txtdienthoai"];
        $email = $_POST["txtemail"];
        $hinh_anh = uniqid() . '_' .$_FILES["fhinh"]["name"];
        $mangFile = $_FILES['fhinh'];
        
        if($hinh_anh != ''){
			$tmp_hinh_anh = $mangFile['tmp_name'];
			$hinh_anh_path = "images/" .$hinh_anh;
			move_uploaded_file($tmp_hinh_anh, $hinh_anh_path);
			$nd->capNhatNguoiDung($id, $ho_ten, $dia_chi, $dien_thoai, $email, $hinh_anh);
		}
		else{
			$nd->capNhatNguoiDung($id, $ho_ten, $dia_chi, $dien_thoai, $email);
		}
        $_SESSION['nguoiDung'] = $nd->layThongTinNguoiDungTheoID($id);
        // $message = "Cập nhật thành công !!!";
        include('main.php');
        break;
    case 'doiMatKhau':
        $matKhauCu = $_POST['txtmatKhauCu'];
        $matKhauMoi = $_POST['txtmatKhauMoi'];
        $nhapLaiMatKhau = $_POST['txtnhapLaiMatKhau'];
        $kq = $nd->doiMatKhau($_SESSION['nguoiDung']['id'], $matKhauCu, $matKhauMoi);
        if($kq && $matKhauMoi == $nhapLaiMatKhau)
            $thongBao = "Đổi mật khẩu thành công!";
        else if(!$kq){
            $thongBao = "Bạn nhập sai mật khẩu!";
            include('main.php');
            return;
        }
        else{
            $thongBao = "Mật khẩu mớI không trùng khớp!";
            include('main.php');
            return;
        }
        
        $_SESSION['nguoiDung'] = $nd->layNguoiDungTheoTenDangNhap($_SESSION['nguoiDung']['ten_dang_nhap']);
        include('main.php');
        break;
    case 'xuLyDangKy':
        $ten_dang_nhap = $_POST["ten_dang_nhap"];
        $mat_khau = $_POST["mat_khau"];
        $ho_ten = $_POST["ho_ten"];
        $dia_chi = $_POST["dia_chi"];
        $dien_thoai = $_POST["dien_thoai"];
        $email = $_POST["email"];
        $hinh_anh = $_FILES["hinh_anh"]["name"];
        $nd->themNguoiDung($ten_dang_nhap, $mat_khau, $ho_ten, $dia_chi, $dien_thoai, $email, "Member", $hinh_anh);
        include('main.php');
        break;
    case "themDanhGia":
        $rating = $_POST['txtRating'];
        $noiDung = $_POST['txtNoiDung'];
        $mangFileHinhAnh = $_FILES['fileHinhAnh'];
        $mangTMP = $mangFileHinhAnh['tmp_name'];
        $mangTen = $mangFileHinhAnh['name'];
        $sp_id = $_POST['sp_id'];
        $images = '';
        foreach($mangTMP as $key => $tmp_name){
            $tenDuyNhat = uniqid() . '_' . $mangTen[$key];
            if($images == '')
                $images .= $tenDuyNhat;
            else
                $images .= ', ' . $tenDuyNhat;
            move_uploaded_file($tmp_name,"images/".$tenDuyNhat);
        }
        $dg->themDanhGia($_SESSION['nguoiDung']['id'], $sp_id, $rating, $noiDung, $images);
        include('detail.php');
        break;
    case 'timKiem':
        if(isset($_REQUEST['txtTuKhoa']))
            $tuKhoa = $_REQUEST['txtTuKhoa'];
        include('main.php');
        break;
    case "gioithieu":
		include('gioithieu.php');
		break;
    case "chinhsachbaomat":
        include('chinhsachbaomat.php');
        break;
    case "dieukhoansudung":
        include('dieukhoansudung.php');
        break;
    case "xemDonMua":
        include('donmua.php');
        break;
    case "huyDon":
        $id = $_GET['id_don_hang'];
        $dh->huyDonHang($id);
        include('donmua.php');
        break;
    case "nguoiDungDaNhanDuocHang":
        $id = $_GET['idDonHang'];
        $da_nhan_hang = 3;
        $dh->capNhatTrangThaiDonHang($id, $da_nhan_hang);
        include("donmua.php");
        break;
    default:
        break;
}
?>