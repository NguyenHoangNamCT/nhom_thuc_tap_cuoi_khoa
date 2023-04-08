<?php
    require('../../model/database.php');
    require('../../model/nguoidung.php');
    if(isset($_REQUEST['action']))
        $action = $_REQUEST['action'];
    else
        $action = 'macDinh';

    $nd = new NGUOIDUNG();

    switch($action){
        case 'macDinh':
            include('main.php');
            break;
        case 'themND':
            include('add.php');
            break;
        case 'themNguoiDung':
            $email = $_POST['txtEmail'];
            $ten = $_POST['txtHoTen'];
            $dienThoai = $_POST['txtDienThoai'];
            $matKhau = $_POST['txtMatKhau'];
            $quyen = $_POST['selectLoai'];
            $diaChi = $_POST['txtDC'];
            $hinh = $_FILES['filehinhanh']['name'];
            // var_dump($email, $ten, $dienThoai, $matKhau, $quyen);

            $nd->themnguoidung($email, $ten, $dienThoai, $matKhau, $quyen, 1, $hinh, $diaChi);

            include('main.php');
            break;
        case 'xoa':
            $id = $_GET['id'];

            if($_GET['quyen'] != 3 && isset($_GET['quyen'])){
                $idNguoiDungKhongDuocPhepXoa = $id;
                $idXoaNguoiDung = $id;
            }
            else
                $nd->xoaNguoiDung($id);
            include('main.php');
            break;
        case 'thayDoiTrangThai':
            $id = $_GET['id'];
            $trangThai = $_GET['trangThai'];
            $nd->thayDoiTrangThaiNguoiDung($id, $trangThai);
            include('main.php');
            break;
        case 'capNhatHoSo':
            $email = $_POST['txtemail'];
            $ten = $_POST['txthoten'];
            $dienThoai = $_POST['txtdienthoai'];
            $diaChi = $_POST['txtDC'];
            $hinh = $_FILES['fhinh']['name'];
            $nd->capnhatnguoidung($_SESSION['nguoiDung']['id'], $email, $dienThoai, $ten, $hinh, $diaChi);
            $_SESSION['nguoiDung'] = $nd->laythongtinnguoidung($email);
            include('main.php');
            break;
        case 'doiMK':
            $mk = $_POST['txtMatKhau'];
            $nd->doimatkhau($_SESSION['nguoiDung']['email'], $mk);
            $_SESSION['nguoiDung'] = $nd->laythongtinnguoidung($_SESSION['nguoiDung']['email']);
            include('main.php');
            break;
        default:
            break;
    }
?>