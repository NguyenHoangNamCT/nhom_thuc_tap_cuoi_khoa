<?php 
require('../../model/database.php');
require('../../model/sanpham.php');
// require('../../model/loaisanpham.php');
// require('../../model/thuonghieu.php');
require('../../model/chitietdonhang.php');
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}


$sp = new SANPHAM();
// $l = new LOAISP();
// $th = new THUONGHIEU();
$ctdh = new CHITIETDONHANG();

switch($action){
    case "macdinh": 
        include("main.php");
        break;
    case "them":
		include("add.php");
		break;
		case "XuLyThem":
		$id_don_hang = $_POST['txtIdDonHang'];
		$id_san_pham = $_POST['txtIdSanPham'];
		$so_luong = $_POST['txtSoLuong'];
		$don_gia = $_POST['txtDongia'];
		$ctdh->themChiTietDonHang($id_don_hang, $id_san_pham, $so_luong, $don_gia);
		include("main.php");
		break;
	case "xoa":
		$id = $_GET['id'];
		$sp->xoaChiTietDonHang($id);
		include("main.php");
		break;
	case "sua":
		$id = $_GET['id'];
		include("update.php");
		break;
	case "xuLySua":
		$id = $_POST['id'];
		$id_don_hang = $_POST['txtIdDonHang'];
		$id_san_pham = $_POST['txtIdSanPham'];
		$so_luong = $_POST['txtSoLuong'];
		$don_gia = $_POST['txtDongia'];
		$suaChiTietDonHang = $ctdh->suaChiTietDonHang($id, $id_don_hang, $id_san_pham, $so_luong, $don_gia);
		include("main.php");
		break;
	//----------------------------------------------------
    default:
        break;
}
?>