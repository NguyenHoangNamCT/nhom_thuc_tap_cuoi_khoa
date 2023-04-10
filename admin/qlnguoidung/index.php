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
        case 'them':
            include('add.php');
            break;
        case 'xuLyThem':
            $ten_dang_nhap = $_POST["ten_dang_nhap"];
            $mat_khau = $_POST["mat_khau"];
            $ho_ten = $_POST["ho_ten"];
            $dia_chi = $_POST["dia_chi"];
            $dien_thoai = $_POST["dien_thoai"];
            $email = $_POST["email"];
            $loai_nguoi_dung = $_POST["loai_nguoi_dung"];
            $hinh_anh = $_FILES["hinh_anh"]["name"];
            $trang_thai = $_POST["trang_thai"];
            $nd->themNguoiDung($ten_dang_nhap, $mat_khau, $ho_ten, $dia_chi, $dien_thoai, $email, $loai_nguoi_dung, $hinh_anh);
            include('main.php');
            break;
        case 'xoa':
            $id = $_GET['id'];
            $nd->xoaNguoiDung($id);
            include('main.php');
            break;
        case 'sua':
            $id = $_GET['id'];
            include('update.php');
            break;
        case 'xuLySua':
            $id = $_POST["id"];
            $ten_dang_nhap = $_POST["ten_dang_nhap"];
            $mat_khau = $_POST["mat_khau"];
            $ho_ten = $_POST["ho_ten"];
            $dia_chi = $_POST["dia_chi"];
            $dien_thoai = $_POST["dien_thoai"];
            $email = $_POST["email"];
            $loai_nguoi_dung = $_POST["loai_nguoi_dung"];
            $hinh_anh = $_FILES["hinh_anh"]["name"];
            $trang_thai = $_POST["trang_thai"];
            var_dump($trang_thai);

            if($hinh_anh != '')
                $nd->suaNguoiDung($id, $ten_dang_nhap, $mat_khau, $ho_ten, $dia_chi, $dien_thoai, $email, $loai_nguoi_dung, $trang_thai, $hinh_anh);
            else
                $nd->suaNguoiDung($id, $ten_dang_nhap, $mat_khau, $ho_ten, $dia_chi, $dien_thoai, $email, $loai_nguoi_dung, $trang_thai);
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