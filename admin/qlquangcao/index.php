<?php 
//không cho khách thăm web và khách hàng vào xem quản lí loại sản phẩm
if(!isset($_SESSION['nguoiDung']) || $_SESSION['nguoiDung']['loai_nguoi_dung'] == 3){
	header("Location: ../../");//chuyển qua trang index
	exit;
}
require('../../model/database.php');
require('../../model/quangcao.php');
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}


$qc= new QUANGCAO();

switch($action){
    case "macdinh": 
        include("main.php");
        break;
	case "them":
		include("add.php");
		break;
	case "XuLyThem":
		$tieuDe = $_POST['txtTieuDe'];
		$trangThai = $_POST['txtTrangThai'];
		$url = $_POST['txtUrl'];
		$hinhAnh = $_FILES['filehinhanh'];
		$tenHinhAnh = $hinhAnh['name'];
		$tmpHinhAnh = $hinhAnh['tmp_name'];
		$duongDanHinhAnh = '../../images/' . $tenHinhAnh;
		move_uploaded_file($tmpHinhAnh, $duongDanHinhAnh);
		$qc->themQuangCao($tieuDe, $tenHinhAnh, $url, $trangThai);
		include("main.php");
		break;
	
	case "xoa":
		$id = $_GET['id'];
		$qc->xoaQuangCao($id);
		include("main.php");
		break;
	case "sua":
		$id = $_GET['id'];
		include("update.php");
		break;
	case "xuLySua":
		$id = $_POST['id'];
		$tieuDe = $_POST['txtTieuDe'];
		$url = $_POST['txtUrl'];
		$trangThai = $_POST['txtTrangThai'];
		$hinhAnh = $_FILES['filehinhanh']['name'];

		if($hinhAnh != ''){
			$hinhAnh_tmp = $_FILES['filehinhanh']['tmp_name'];
			$hinhAnh_path = "../../images/" . $hinhAnh;
			move_uploaded_file($hinhAnh_tmp, $hinhAnh_path);
			$qc->suaQuangCao($id, $tieuDe, $url, $trangThai, $hinhAnh);
		}
		else
			{
				$qc->suaQuangCao($id, $tieuDe, $url, $trangThai);
			}

		include("main.php");
		break;
	case "timKiemQuangCao":
		$tuKhoa = $_POST['txtTuKhoa'];
		$loaiTimKiem = $_POST['loaiTimKiem'];
		include('main.php');
		break;
	//----------------------------------------------------
    default:
        break;
}
?>