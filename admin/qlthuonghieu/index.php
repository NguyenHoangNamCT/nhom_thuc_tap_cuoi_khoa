<?php 
//không cho khách thăm web và khách hàng vào xem quản lí thương hiệu
if(!isset($_SESSION['nguoiDung']) || $_SESSION['nguoiDung']['loai_nguoi_dung'] == 3){
	header("Location: ../../");//chuyển qua trang index
	exit;
}
require('../../model/database.php');
require('../../model/thuonghieu.php');
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}


$th = new THUONGHIEU();

switch($action){
    case "macdinh": 
        include("main.php");
        break;
    case "them":
		include("add.php");
		break;
	case "XuLyThem":
		$tenTH = $_POST['txtTenTH'];
		$moTa = $_POST['txtMoTa'];
		$trangweb= $_POST['txtTrangweb'];
		$logo = $_FILES['filehinhanh']['name'];
		 $th->themThuongHieu($tenTH, $moTa, $trangweb, $logo);

		include("main.php");
		break;
	case "xoa":
		$id = $_GET['id'];
		$th->xoaThuongHieu($id);
		include("main.php");
		break;
	case "sua":
		$id = $_GET['id'];
		include("update.php");
		break;
	case "xuLySua":
	
		$id = $_POST['id'];
		$tenTH = $_POST['txtTenTH'];
		$moTa = $_POST['txtMoTa'];
		$trangweb = $_POST['txtTrangWeb'];
		$logo = $_FILES['filehinhanh']['name'];
		
		if($logo == '')
			$th->suaThuongHieu($id, $tenTH, $moTa, $trangweb);
		else
			$th->suaThuongHieu($id, $tenTH, $moTa, $trangweb, $logo);

		include("main.php");
		break;
	case "timKiemThuongHieu":
		$tuKhoa = $_POST['txtTuKhoa'];
		$loaiTimKiem = $_POST['loaiTimKiem'];
		include('main.php');
		break;
	//----------------------------------------------------
    default:
        break;
}
?>