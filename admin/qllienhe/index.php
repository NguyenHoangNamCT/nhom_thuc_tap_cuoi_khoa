<?php 
require('../../model/database.php');
// require('../../model/sanpham.php');
// require('../../model/loaisanpham.php');
// require('../../model/thuonghieu.php');
require('../../model/lienhe.php');
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}

$lh = new LIENHE(); 
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
		$ho_ten = $_POST['txtHoTen'];
		$email = $_POST['txtEmail'];
		$so_dien_thoai = $_POST['txtSoDienThoai'];
		$lh->themLienHe($ho_ten, $email, $so_dien_thoai);
		include("main.php");
		break;
	case "xoa":
		$id = $_GET['id'];
		$lh->xoaLienHe($id);
		include("main.php");
		break;
	case "sua":
		$id = $_GET['id'];
		include("update.php");
		break;
	case "xuLySua":
		$id = $_POST['id'];
		$ho_ten = $_POST['txtHoTen'];
		$email = $_POST['txtEmail'];
		$so_dien_thoai = $_POST['txtSoDienThoai'];
		$lh->suaLienHe($id, $ho_ten, $email, $so_dien_thoai);
		include("main.php");
		break;
	//----------------------------------------------------
    default:
        break;
}
?>