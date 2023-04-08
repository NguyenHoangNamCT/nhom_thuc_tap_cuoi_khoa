<?php 
require('../../model/database.php');
require('../../model/dienthoai.php');
require('../../model/hangdt.php');

if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="macdinh"; 
}


$dt = new DIENTHOAI();
$h = new HANGDT();
$idSua = 0;


switch($action){
    case "macdinh": 
        include("main.php");
        break;
    case "them":
		$tenHang = $_POST['txtTenHang'];
		$h->themHangDT($tenHang);
		include("main.php");
		break;
	case "sua":
		$idSua = $_GET['id'];
		include("main.php");
		break;
	case "xuLySua":
		$id = $_POST['id'];
		$tenHang = $_POST['txtTenHang'];
		$h->suaHangDT($id, $tenHang);
		$idSua = 0;
		include("main.php");
		break;
	case "xoa":
		$id = $_GET['id'];
		$h->xoaHangDT($id);
		include("main.php");
		break;
    default:
        break;
}
?>