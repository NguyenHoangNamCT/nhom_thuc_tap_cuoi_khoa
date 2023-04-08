<?php
class NGUOIDUNG{
	
	//-------------------------------------------------------	
	public function kiemtranguoidunghople($email,$matkhau){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung WHERE email=:email AND matkhau=:matkhau AND trangthai=1";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":matkhau", md5($matkhau));
			$cmd->execute();
			$valid = ($cmd->rowCount () == 1);
			$cmd->closeCursor ();
			return $valid;			
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	
	// lấy thông tin người dùng có $email
	public function laythongtinnguoidung($email){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung WHERE email=:email";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->execute();
			$ketqua = $cmd->fetch();
			$cmd->closeCursor();
			return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	
	// lấy tất cả ng dùng
	public function laydanhsachnguoidung(){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung";
			$cmd = $db->prepare($sql);			
			$cmd->execute();
			$ketqua = $cmd->fetchAll();			
			return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Thêm nd mới, trả về khóa của dòng mới thêm
	public function themnguoidung($email,$matkhau,$sodt,$hoten,$quyen, $trangThai, $diaChi){
		$db = DATABASE::connect();
		try{
			$sql = "INSERT INTO nguoidung(email,matkhau,sdt,hoten,quyen, trangthai, hinhanh, diachi) VALUES(:email,:matkhau,:sodt,:hoten,:quyen, $trangThai, :hinh, :dc)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':email',$email);
			$cmd->bindValue(':matkhau',md5($matkhau));
			$cmd->bindValue(':sodt',$sodt);
			$cmd->bindValue(':hoten',$hoten);
			$cmd->bindValue(':quyen',$quyen);
			$cmd->bindValue(':dc',$diaChi);
			$cmd->execute();
			$id = $db->lastInsertId();
			return $id;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	//Thêm kh mới
	public function themKhachHang($email, $hoTen, $SDT)
    {
        $db = DATABASE::connect();
        try{
            $sql = 'INSERT INTO nguoidung (email, sdt, matkhau, hoten, quyen, trangthai) values(:email, :sdt, :mk, :hoten, :loai, :trangthai)';
            $cmd = $db->prepare($sql);
            $cmd->bindvalue(':email', $email);
            $cmd->bindvalue(':sdt', $SDT);
            $cmd->bindvalue(':mk', md5($SDT));
            $cmd->bindvalue(':hoten', $hoTen);
            $cmd->bindvalue(':loai', 3);
            $cmd->bindvalue(':trangthai', 1);
            $cmd->execute();
            return $db->lastInsertId();
        }
        catch(PDOException $e)
        {
            echo '<p>Lỗi truy vấn: '.$e->getMessage().'</p>';
            exit();
        }
    }

	//xoá người dùng
	public function xoaNguoiDung($id){
		$db = DATABASE::connect();
		try{
			 $sql = "DELETE FROM nguoidung WHERE id = :id";
			 $cmd = $db->prepare($sql);
			 $cmd->bindValue(':id', $id);
			 return $cmd->execute();
		}
		catch(PDOException $e){
			 echo "<p>Lỗi truy vấn ".$e->getMessage()."</p>";
			 exit();
		}
   }

	// Cập nhật thông tin ng dùng: họ tên, số đt, email, ảnh đại diện 
	public function capnhatnguoidung($id,$email,$sodt,$hoten,$hinhanh, $diaChi){
		$db = DATABASE::connect();
		try{
			if($hinhanh != '')
				$sql = "UPDATE nguoidung set hoten=:hoten, email=:email, sdt=:sodt,diachi = :diachi, hinhanh=:hinhanh where id=:id";
			else
				$sql = "UPDATE nguoidung set hoten=:hoten, email=:email, sdt=:sodt,diachi = :diachi where id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id',$id);
			$cmd->bindValue(':email',$email);
			$cmd->bindValue(':sodt',$sodt);
			$cmd->bindValue(':hoten',$hoten);
			$cmd->bindValue(':diachi',$diaChi);
			if($hinhanh != '')
				$cmd->bindValue(':hinhanh',$hinhanh);
			$ketqua = $cmd->execute();            
            return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	public function thayDoiTrangThaiNguoiDung($id, $trangThai){
		$db = DATABASE::connect();
		try{
			 if($trangThai == 1)
				  $trangThai = 0;
			 else
				  $trangThai = 1;
			 $sql = "update nguoidung set trangthai = :trangThaiMoi where id = :id";
			 $cmd = $db->prepare($sql);
			 $cmd->bindValue(':trangThaiMoi', $trangThai);
			 $cmd->bindValue(':id', $id);
			 return $cmd->execute();
		}
		catch(PDOException $e){
			 echo "<p>Lỗi truy vấn ".$e->getMessage()."</p>";
			 exit();
		}
   }

	// Đổi mật khẩu
	public function doimatkhau($email,$matkhau){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE nguoidung set matkhau=:matkhau where email=:email";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':email',$email);
			$cmd->bindValue(':matkhau',md5($matkhau));
			$ketqua = $cmd->execute();            
            return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Đổi quyền (loại người dùng: 1 quản trị, 2 nhân viên. Không cần nâng cấp quyền đối với loại người dùng 3-khách hàng)
	public function doiloainguoidung($email,$quyen){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE nguoidung set quyen=:quyen where email=:email";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':email',$email);
			$cmd->bindValue(':quyen',$quyen);
			$ketqua = $cmd->execute();            
            return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Đổi trạng thái (0 khóa, 1 kích hoạt)
	public function doitrangthai($id,$trangthai){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE nguoidung set trangthai=:trangthai where id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id',$id);
			$cmd->bindValue(':trangthai',$trangthai);
			$ketqua = $cmd->execute();            
            return $ketqua;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
}
?>
