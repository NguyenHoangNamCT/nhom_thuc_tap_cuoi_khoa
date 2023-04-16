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

$mangLoaiSP = $lsp->layLoaiSP();
$mangThuongHieu = $th->layThuongHieu();

switch($action){
    case "macdinh": 
        $tk = false;
        include("main.php");
        break;
    case "xemChiTiet":
        $sp_id = $_GET['id'];
        include('detail.php');
        break;
    case "locSanPhamTheoLoai":
        $l_id = $_GET['id'];
        include("main.php");
        break;
    case "locSanPhamTheoThuongHieu":
        $th_id = $_GET['id'];
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
        $id = $_REQUEST['id'];
        $soLuong = $_REQUEST['soLuong'];
        if($soLuong == '')
            $soLuong = 1;
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
        foreach($mangGioHang as $key => $arr){
            $gh->capNhatSoLuongSanPhamTrongGioHang($_SESSION['nguoiDung']['id'], $arr['id_san_pham'], $_POST['txtSoLuong'.$arr['id_san_pham']]);
            if($key == $end)
                $capNhatThanhCong = true;
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

        //Thêm các chi tiết đơn hàng
        foreach($mangGioHang as $arr)
            $ctdh->themChiTietDonHang($idDH, $arr['id_san_pham'], $arr['so_luong'], ($arr['gia_tien']*(1-$arr['giam_gia']/100)));

        //Thêm thông tin đơn hàng
        $ttdh->themThongTinDonHang($idDH, $_SESSION['nguoiDung']['ho_ten'], $diaChi, $sdt, "0001-01-01 00:00:00", $phiVanChuyen, "kHÔNG CÓ GHI CHÚ");

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
        $hinh_anh = $_FILES["fhinh"]["name"];
        
        if($hinh_anh != '')
            $nd->capNhatNguoiDung($id, $ho_ten, $dia_chi, $dien_thoai, $email, $hinh_anh);
        else
            $nd->capNhatNguoiDung($id, $ho_ten, $dia_chi, $dien_thoai, $email);
        $_SESSION['nguoiDung'] = $nd->layThongTinNguoiDungTheoID($id);
        // $message = "Cập nhật thành công !!!";
        include('main.php');
        break;
    // case 'timKiem':
    //     $tk = true;
    //     $tenDT = $_REQUEST['txtTuKhoa'];
    //     include('main.php');
    //     break;
    default:
        break;
}
?>