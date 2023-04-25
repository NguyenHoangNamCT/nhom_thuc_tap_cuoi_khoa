<?php 
//không cho khách thăm web và khách hàng vào xem quản lí chi tiết đơn hàng
if(!isset($_SESSION['nguoiDung']) || $_SESSION['nguoiDung']['loai_nguoi_dung'] == 3){
	header("Location: ../../");//chuyển qua trang index
	exit;
}
require('../../model/database.php');
require('../../model/sanpham.php');
require('../../model/chitietdonhang.php');
require('../../model/donhang.php');

if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}


$sp = new SANPHAM();
$dh = new DONHANG();
$ctdh = new CHITIETDONHANG();

switch($action){
    case "macdinh": 
        include("main.php");
        break;
    case "them":
		include("add.php");
		break;
	case "XuLyThem":
		$id_don_hang = $_POST['selectDonHang'];
		$id_san_pham = $_POST['selectSanPham'];
		$so_luong = $_POST['txtSoLuong'];
		$don_gia = $_POST['txtDonGia'];
		$ctdh->themChiTietDonHang($id_don_hang, $id_san_pham, $so_luong, $don_gia);
		include("main.php");
		break;
	case "xoa":
		$id = $_GET['id'];
		$ctdh->xoaChiTietDonHang($id);
		include("main.php");
		break;
	case "sua":
		$id = $_GET['id'];
		include("update.php");
		break;
	case "xuLySua":
		$id = $_POST['id'];
		$id_don_hang = $_POST['selectDonHang'];
		$id_san_pham = $_POST['selectSanPham'];
		$so_luong = $_POST['txtSoLuong'];
		$don_gia = $_POST['txtDonGia'];
		$suaChiTietDonHang = $ctdh->suaChiTietDonHang($id, $id_don_hang, $id_san_pham, $so_luong, $don_gia);
		include("main.php");
		break;
	//----------------------------------------------------
    default:
        break;
}
?>