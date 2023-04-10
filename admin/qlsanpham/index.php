<?php 
require('../../model/database.php');
require('../../model/sanpham.php');
require('../../model/loaisanpham.php');
require('../../model/thuonghieu.php');


if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}


$sp = new SANPHAM();
$l = new LOAISP();
$th = new THUONGHIEU();

switch($action){
    case "macdinh": 
        include("main.php");
        break;
    case "them":
		include("add.php");
		break;
		case "XuLyThem":
		$tenSP = $_POST['txtTenSP'];
		$giaTien = $_POST['txtGiaTien'];
		$giamGia = $_POST['txtGiamGia'];
		$loaiSP = $_POST['selectLoaiSanPham'];
		$thuongHieu = $_POST['selectThuongHieu'];
		$soLuong = $_POST['txtSoLuong'];
		$moTa = $_POST['txtMoTa'];
		$hinh = $_FILES['filehinhanh']['name'];
		
		// var_dump($loaiSP, $thuongHieu, $tenSP, $moTa, $giaTien, $giamGia, $soLuong, $hinh);

		$sp->themSanPham($loaiSP, $thuongHieu, $tenSP, $moTa, $giaTien, $giamGia, $soLuong, $hinh);

		include("main.php");
		break;
	case "xoa":
		$id = $_GET['id'];
		$sp->xoaSanPham($id);
		include("main.php");
		break;
	case "sua":
		$id = $_GET['id'];
		include("update.php");
		break;
	case "xuLySua":
		$id = $_POST['id'];
		$tenSP = $_POST['txtTenSP'];
		$giaTien = $_POST['txtGiaTien'];
		$giamGia = $_POST['txtGiamGia'];
		$loaiSP = $_POST['selectLoaiSanPham'];
		$thuongHieu = $_POST['selectThuongHieu'];
		$soLuong = $_POST['txtSoLuong'];
		$moTa = $_POST['txtMoTa'];
		$hinh = $_FILES['filehinhanh']['name'];

		if($hinh == '')
			$sp->suaSanPham($id, $loaiSP, $thuongHieu, $tenSP, $moTa, $giaTien, $giamGia, $soLuong, $hinh);
		else
			$sp->suaSanPham($id, $loaiSP, $thuongHieu, $tenSP, $moTa, $giaTien, $giamGia, $soLuong);

		include("main.php");
		break;
	//----------------------------------------------------
    default:
        break;
}
?>