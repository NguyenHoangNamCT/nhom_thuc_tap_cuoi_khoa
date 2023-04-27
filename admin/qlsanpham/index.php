<?php 
//không cho khách thăm web và khách hàng vào xem quản lí sản phẩm
if(!isset($_SESSION['nguoiDung']) || $_SESSION['nguoiDung']['loai_nguoi_dung'] == 3){
	header("Location: ../../");//chuyển qua trang index
	exit;
}
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
		$hinh = $_FILES['filehinhanh'];
		$tenHinhAnh =$hinh['name'];
		$tmpHinhAnh =$hinh['tmp_name'];
		$duongDanHinhAnh = '../../images/' . $tenHinhAnh;
		move_uploaded_file($tmpHinhAnh, $duongDanHinhAnh);
		$sp->themSanPham($loaiSP, $thuongHieu, $tenSP, $moTa, $giaTien, $giamGia, $soLuong, $tenHinhAnh);
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

		if($hinh != '')
		{
			$hinhAnh_tmp = $_FILES['filehinhanh']['tmp_name'];
			$hinhAnh_path = "../../images/" .$hinh;
			move_uploaded_file($hinhAnh_tmp, $hinhAnh_path);
			$sp->suaSanPham($id, $loaiSP, $thuongHieu, $tenSP, $moTa, $giaTien, $giamGia, $soLuong, $hinh);
		}
		else{
			$sp->suaSanPham($id, $loaiSP, $thuongHieu, $tenSP, $moTa, $giaTien, $giamGia, $soLuong);
		}
		include("main.php");
		break;
	case "timKiemSanPham":
		$tuKhoa = $_REQUEST['txtTuKhoa'];
		$loaiTimKiem = $_REQUEST['loaiTimKiem'];
		include('main.php');
		break;
	//----------------------------------------------------
    default:
        break;
}
?>