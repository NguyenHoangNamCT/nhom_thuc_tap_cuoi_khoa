<?php 
require('../../model/database.php');
require('../../model/donhang.php');
require('../../model/nguoidung.php');
// require('../../model/sanpham.php');
// require('../../model/loaisanpham.php');
// require('../../model/thuonghieu.php');
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}

$nd = new NGUOIDUNG();
$dh = new DONHANG();
// $sp = new SANPHAM();
// $l = new LOAISP();
// $th = new THUONGHIEU();

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
		$ho_ten_nguoi_nhan = $_POST['txtHoTenNN'];
		$tong_tien = $_POST['txtTongTien'];
		$tinh_trang_don_hang = $_POST['txtTinhTrangDH'];
		$dh->themDonHang($id_nguoi_dung, $ngay_dat, $dia_chi_giao_hang, $dien_thoai_nguoi_nhan, $ho_ten_nguoi_nhan, $tong_tien, $tinh_trang_don_hang);
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
		var_dump('Hi I am here');
		var_dump('Hi I am here');
		var_dump('Hi I am here');
		var_dump('Hi I am here');
		var_dump('Hi I am here');
		$id = $_POST['id'];
		$id_nguoi_dung = $_POST['selectTenNguoiDung'];
		$ngay_dat = $_POST['dateNgayDat'];
		$dia_chi_giao_hang = $_POST['txtDiaChiGH'];
		$dien_thoai_nguoi_nhan = $_POST['txtDienThoai'];
		$ho_ten_nguoi_nhan = $_POST['txtHoTenNN'];
		$tong_tien = $_POST['txtTongTien'];
		$tinh_trang_don_hang = $_POST['txtTinhTrangDH'];
		$dh->suaDonHang($id, $id_nguoi_dung, $ngay_dat, $dia_chi_giao_hang, $dien_thoai_nguoi_nhan, $ho_ten_nguoi_nhan, $tong_tien, $tinh_trang_don_hang);
		include("main.php");
		break;
	//----------------------------------------------------
    default:
        break;
}
?>