<?php 
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
		$hinhAnh = $_FILES['filehinhanh']['name'];
		$trangThai = $_POST['txtTrangThai'];
		$url = $_POST['txtUrl'];
		$qc->themQuangCao($tieuDe, $hinhAnh, $url, $trangThai);
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

		if($hinhAnh != '')
			$qc->suaQuangCao($id, $tieuDe, $url, $trangThai, $hinhAnh);
		else
			$qc->suaQuangCao($id, $tieuDe, $url, $trangThai);

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