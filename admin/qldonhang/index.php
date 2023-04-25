<?php 

//không cho khách thăm web và khách hàng vào xem quản lí đơn hàng
if(!isset($_SESSION['nguoiDung']) || $_SESSION['nguoiDung']['loai_nguoi_dung'] == 3){
	header("Location: ../../");//chuyển qua trang index
	exit;
}
require('../../model/database.php');
require('../../model/donhang.php');
require('../../model/nguoidung.php');
require('../../model/thongtindonhang.php');
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}

$ttdh = new THONGTINDONHANG();
$nd = new NGUOIDUNG();
$dh = new DONHANG();


switch($action){
    case "macdinh": 
        include("main.php");
        break;
    case "them":
		include("add.php");
		break;
	case "XuLyThem":
		$id_nguoi_dung = $_POST['selectTenNguoiDung'];
		$ngay_dat = $_POST['dateNgayDat'];
		$dia_chi_giao_hang = $_POST['txtDiaChiGH'];
		$dien_thoai_nguoi_nhan = $_POST['txtDienThoai'];
		$tong_tien = $_POST['txtTongTien'];
		$tinh_trang_don_hang = $_POST['txtTinhTrangDH'];
		$dh->themDonHang($id_nguoi_dung, $ngay_dat, $dia_chi_giao_hang, $dien_thoai_nguoi_nhan, $tong_tien, $tinh_trang_don_hang);
		include("main.php");
		break;
	case "xoa":
		$id = $_GET['id'];
		$dh->xoaDonHang($id);
		include("main.php");
		break;
	case "sua":
		$id = $_GET['id'];
		include("update.php");
		break;
	case "xuLySua":
		$id = $_POST['id'];
		$ngay_dat = $_POST['dateNgayDat'];
		$dia_chi_giao_hang = $_POST['txtDiaChiGH'];
		$dien_thoai_nguoi_nhan = $_POST['txtDienThoai'];
		$tong_tien = $_POST['txtTongTien'];
		$tinh_trang_don_hang = $_POST['txtTinhTrangDH'];
		$dh->suaDonHang($id, $ngay_dat, $dia_chi_giao_hang, $dien_thoai_nguoi_nhan, $tong_tien, $tinh_trang_don_hang);
		include("main.php");
		break;

		case "ThemTTDH":
			$id_don_hang = $_GET['id'];
			include("addthongtindonhang.php");
			break;
		case "XuLyThemTTDH":
			$id = $_POST['id'];
			$ten_khach_hang = $_POST['txtTenKH'];
			$dia_chi_nguoi_nhan = $_POST['txtDiaChiNN'];
			$so_dien_thoai_nguoi_nhan = $_POST['txtSoDienThoaiNN'];
			$ngay_giao_hang = $_POST['dateNgayGiaoHang'];
			$phi_van_chuyen = $_POST['txtPhiVanChuyen'];
			$ghi_chu = $_POST['txtGhiChu'];
			$themThongTinDonHang = $ttdh-> themThongTinDonHang($id, $ten_khach_hang, $dia_chi_nguoi_nhan, $so_dien_thoai_nguoi_nhan, $ngay_giao_hang, $phi_van_chuyen, $ghi_chu);
			include("main.php");
			break;
	//----------------------------------------------------
    default:
        break;
}
?>