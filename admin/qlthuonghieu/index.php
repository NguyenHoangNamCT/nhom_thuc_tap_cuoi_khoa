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
		$logo = $_FILES['filehinhanh'];
		$tenLogo = $logo['name'];
		$tmpLogo = $logo['tmp_name'];
		$duongDanHinhAnh = '../../images/' . $tenLogo;
		move_uploaded_file($tmpLogo, $duongDanHinhAnh);
		$th->themThuongHieu($tenTH, $moTa, $trangweb, $tenLogo);

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
		
		if($logo == ''){
			$Logo_tmp = $_FILES['filehinhanh']['tmp_name'];
			$Logo_path = "../../images/" .$logo;
			move_uploaded_file($Logo_tmp, $Logo_path);
			$th->suaThuongHieu($id, $tenTH, $moTa, $trangweb, $logo);
		}
		else{
			$th->suaThuongHieu($id, $tenTH, $moTa, $trangweb);
		}

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