<?php 
require('../../model/database.php');
// require('../../model/sanpham.php');
// require('../../model/loaisanpham.php');
// require('../../model/thuonghieu.php');
require('../../model/donhang.php');
require('../../model/hoadon.php');



if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}

$hd = new HOADON();
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
		$id_don_hang = $_POST['selectDonHang'];
		$ngay_tao = $_POST['dateNgayTao'];
		$tong_tien = $_POST['txtTongTien'];
		$hd->themHoaDon($id_don_hang, $ngay_tao, $tong_tien);
		include("main.php");
		break;
	case "xoa":
		$id = $_GET['id'];
		$sp->xoaHoaDon($id);
		include("main.php");
		break;
	case "sua":
		$id = $_GET['id'];
		include("update.php");
		break;
	case "xuLySua":
		$id = $_POST['id'];
		$id_don_hang = $_POST['selectDonHang'];
		$ngay_tao = $_POST['dateNgayTao'];
		$to = $_POST['txtTongTien'];
		$suaHoaDon = $hd->suaHoaDon($id, $id_don_hang, $ngay_tao, $tong_tien);
		include("main.php");
		break;
	//----------------------------------------------------
    default:
        break;
}
?>