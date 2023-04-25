<?php 
//không cho khách thăm web và khách hàng vào xem quản lí loại sản phẩm
if(!isset($_SESSION['nguoiDung']) || $_SESSION['nguoiDung']['loai_nguoi_dung'] == 3){
	header("Location: ../../");//chuyển qua trang index
	exit;
}
require('../../model/database.php');
require('../../model/loaisanpham.php');
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}

$l = new LOAISP();


switch($action){
    case "macdinh": 
        include("main.php");
        break;
    case "them":
		include("add.php");
		break;
	case "XuLyThem":
		$tenLoaiSP = $_POST['txtTenLoaiSP'];
		$moTa = $_POST['txtMoTa'];
		$hinhAnh = $_FILES['filehinhanh']['name'];
		$l->themLoaiSanPham($tenLoaiSP, $moTa, 0, $hinhAnh);
		include("main.php");
		break;
	case "xoa":
		$id = $_GET['id'];
		$l->xoaLoaiSanPham($id);
		include("main.php");
		break;
	case "sua":
		$id = $_GET['id'];
		
		include("update.php");
		break;
	case "xuLySua":
		$id = $_POST['id'];
		$tenLoaiSP = $_POST['txtTenLoaiSP'];
		$moTa = $_POST['txtMoTa'];
		$hinhAnh = $_FILES['filehinhanh']['name'];
		if($hinhAnh != '')
			$l->suaLoaiSanPham($id, $tenLoaiSP, $moTa, $hinhAnh);
		else
			$l->suaLoaiSanPham($id, $tenLoaiSP, $moTa);
		//------------------------------
		include("main.php");
		break;
	case "timKiemLoaiSanPham":
		$tuKhoa = $_POST['txtTuKhoa'];
		$loaiTimKiem = $_POST['loaiTimKiem'];
		include('main.php');
		break;
    default:
        break;
}
?>