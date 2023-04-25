<?php 
//không cho khách thăm web và khách hàng vào xem quản lí thông tin đơn
if(!isset($_SESSION['nguoiDung']) || $_SESSION['nguoiDung']['loai_nguoi_dung'] == 3){
	header("Location: ../../");//chuyển qua trang index
	exit;
}
require('../../model/database.php');
require('../../model/thongtindonhang.php');
require('../../model/donhang.php');
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}


$dh = new DONHANG();
$ttdh = new THONGTINDONHANG();


switch($action){
    case "macdinh": 
        include("main.php");
        break;
    case "them":
		include("add.php");
		break;
	// case "XuLyThem":
	// 	$ten_khach_hang = $_POST['txtTenKH'];
	// 	$dia_chi_nguoi_nhan = $_POST['txtDiaChiNN'];
	// 	$so_dien_thoai_nguoi_nhan = $_POST['txtSoDienThoaiNN'];
	// 	$ngay_giao_hang = $_POST['dateNgayGiaoHang'];
	// 	$phi_van_chuyen = $_POST['txtPhiVanChuyen'];
	// 	$ghi_chu = $_POST['txtGhiChu'];
	// 	$ttdh->themThongTinDonHang($ten_khach_hang, $dia_chi_nguoi_nhan, $so_dien_thoai_nguoi_nhan, $ngay_giao_hang, $phi_van_chuyen, $ghi_chu);
	// 	include("main.php");
	// 	break;
	case "xoa":
		$id = $_GET['id'];
		$ttdh->xoaThongTinDonHang($id);
		include("main.php");
		break;
	case "sua":
		$id = $_GET['id'];
		include("update.php");
		break;
		case "sua":
			$id = $_GET['id'];
			include("update.php");
			break;
		case "xuLySua":
			$id = $_POST['id'];
			$ten_khach_hang = $_POST['txtTenKH'];
			$dia_chi_nguoi_nhan = $_POST['txtDiaChiNN'];
			$so_dien_thoai_nguoi_nhan = $_POST['txtSoDienThoaiNN'];
			$ngay_giao_hang = $_POST['dateNgayGiaoHang'];
			$phi_van_chuyen = $_POST['txtPhiVanChuyen'];
			$ghi_chu = $_POST['txtGhiChu'];
			$suaThongTinDonHang = $ttdh-> suaThongTinDonHang($id, $ten_khach_hang, $dia_chi_nguoi_nhan, $so_dien_thoai_nguoi_nhan, $ngay_giao_hang, $phi_van_chuyen, $ghi_chu);
			include("main.php");
			break;

		case "timKiemThongTin":
			$tuKhoa = $_POST['txtTuKhoa'];
			$loaiTimKiem = $_POST['loaiTimKiem'];
			include('main.php');
			break;
	//----------------------------------------------------
    default:
        break;
}
?>