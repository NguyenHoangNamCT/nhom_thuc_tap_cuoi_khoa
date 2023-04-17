<?php 
require('../../model/database.php');
require('../../model/khuyenmai.php');
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}


$km = new KHUYENMAI();

switch($action){
    case "macdinh": 
        include("main.php");
        break;
    case "them":
		include("add.php");
		break;
	case "XuLyThem":
		$ten_khuyen_mai = $_POST['txtTenKhuyenMai'];
		$mo_ta = $_POST['txtMoTa'];
		$ngay_bat_dau = $_POST['txtNgayBatDau'];
		$ngay_ket_thuc = $_POST['txtNgayKetThuc'];
		$trang_thai = $_POST['selectTrangThai'];
		$gia_tri = $_POST['txtGiaTri'];
		$km->themKhuyenMai($ten_khuyen_mai, $mo_ta, $ngay_bat_dau, $ngay_ket_thuc, $trang_thai, $gia_tri);
		include("main.php");
		break;
	case "xoa":
		$id = $_GET['id'];
		$km->xoaKhuyenMai($id);
		include("main.php");
		break;
	case "sua":
		$id = $_GET['id'];
		include("update.php");
		break;
	case "xuLySua":
		$id = $_POST['id'];
		$ten_khuyen_mai = $_POST['txtTenKhuyenMai'];
		$mo_ta = $_POST['txtMoTa'];
		$ngay_bat_dau = $_POST['txtNgayBatDau'];
		$ngay_ket_thuc = $_POST['txtNgayKetThuc'];
		$trang_thai = $_POST['selectTrangThai'];
		$gia_tri = $_POST['txtGiaTri'];
		// var_dump($id, $ten_khuyen_mai, $mo_ta, $ngay_bat_dau, $ngay_ket_thuc, $trang_thai, $gia_tri);
		$km->suaKhuyenMai($id, $ten_khuyen_mai, $mo_ta, $ngay_bat_dau, $ngay_ket_thuc, $trang_thai, $gia_tri);

		include("main.php");
		break;
	case "timKiemKhuyenMai":
		$tuKhoa = $_POST['txtTuKhoa'];
		$loaiTimKiem = $_POST['loaiTimKiem'];
		include('main.php');
		break;
	//----------------------------------------------------
    default:
        break;
}
?>