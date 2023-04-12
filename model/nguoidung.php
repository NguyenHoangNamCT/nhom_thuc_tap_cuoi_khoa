<?php
class NGUOIDUNG{
	//nếu trả về 1 thì người dùng hợp lệ ngược lại thì không
	public function kiemTraNguoiDungHopLe($tendangnhap,$matkhau){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung WHERE ten_dang_nhap=:tendangnhap AND mat_khau=:matkhau AND trang_thai=1";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":tendangnhap", $tendangnhap);
			$cmd->bindValue(":matkhau", md5($matkhau));
			$cmd->execute();
			$valid = ($cmd->rowCount () == 1);
			//đóng con trỏ kết quả của truy vấn, giải phóng bộ nhớ và chuẩn bị đối tượng PDOStatement để thực thi truy vấn khác.
			$cmd->closeCursor ();
			return $valid;			
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn ở kiemtranguoidunghople: $error_message</p>";
			exit();
		}
	}



	//lấy thông tin tất cả người dùng
	public function layTatCaNguoiDung(){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung";
			$cmd = $db->prepare($sql);
			$cmd->execute();
			$result = $cmd->fetchAll(PDO::FETCH_ASSOC);
			$cmd->closeCursor ();
			return $result;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn ở laytatcanguoidung: $error_message</p>";
			exit();
		}
	}

	//lấy người dùng theo tên đăng nhập
	public function layNguoiDungTheoTenDangNhap($tenDangNhap) {
		$db = DATABASE::connect();
		try {
			$sql = "SELECT * FROM nguoidung WHERE ten_dang_nhap = :tenDangNhap";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':tenDangNhap', $tenDangNhap);
			$cmd->execute();
			$result = $cmd->fetch(PDO::FETCH_ASSOC);
			return $result;
		} catch(PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn ở layNguoiDungTheoTenDangNhap: $error_message</p>";
			exit();
		} finally {
			DATABASE::close();
		}
	}

	//lấy thông tin một người dùng theo id
	public function layThongTinNguoiDungTheoID($id) {
		$db = DATABASE::connect();
		try {
			$sql = "SELECT * FROM nguoidung WHERE id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", $id);
			$cmd->execute();
			$result = $cmd->fetch(PDO::FETCH_ASSOC);
			$cmd->closeCursor();
			return $result;
		} catch(PDOException $e) {
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn ở layThongTinNguoiDungTheoID: $error_message</p>";
			exit();
		}
	}

	//lấy thông tin người dùng theo email
	public function layThongTinNguoiDungTheoEmail($email){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM nguoidung WHERE email=:email";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->execute();
			$nguoidung = $cmd->fetch(PDO::FETCH_ASSOC);
			$cmd->closeCursor();
			return $nguoidung;    
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn ở layThongTinNguoiDungTheoEmail: $error_message</p>";
			exit();
		}
	}

	//thêm người dùng
	public function themNguoiDung($ten_dang_nhap, $mat_khau, $ho_ten, $dia_chi, $dien_thoai, $email, $loai_nguoi_dung, $hinh_anh){
		$db = DATABASE::connect();
		try{
			$ngay_dang_ky = date("Y-m-d H:i:s");
			$sql = "INSERT INTO nguoidung (ten_dang_nhap, mat_khau, ho_ten, dia_chi, dien_thoai, email, ngay_dang_ky, loai_nguoi_dung, hinh_anh, trang_thai) VALUES (:ten_dang_nhap, :mat_khau, :ho_ten, :dia_chi, :dien_thoai, :email, :ngay_dang_ky, :loai_nguoi_dung, :hinh_anh, 1)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":ten_dang_nhap", $ten_dang_nhap);
			$cmd->bindValue(":mat_khau", md5($mat_khau));
			$cmd->bindValue(":ho_ten", $ho_ten);
			$cmd->bindValue(":dia_chi", $dia_chi);
			$cmd->bindValue(":dien_thoai", $dien_thoai);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":ngay_dang_ky", $ngay_dang_ky);
			$cmd->bindValue(":loai_nguoi_dung", $loai_nguoi_dung);
			$cmd->bindValue(":hinh_anh", $hinh_anh);
			$cmd->execute();
			 // Lấy giá trị id vừa được sinh ra
			 $id = $db->lastInsertId();
			 $cmd->closeCursor();
			 return $id;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn ở themNguoiDung: $error_message</p>";
			exit();
		}
	}

	//xoá ngưỜi dùng
	public function xoaNguoiDung($id) {
		$db = DATABASE::connect();
		try {
			$sql = "DELETE FROM nguoidung WHERE id = :id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", $id);
			$cmd->execute();
			$cmd->closeCursor();
			return true;
		} catch(PDOException $e) {
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn ở xoaNguoiDung: $error_message</p>";
			exit();
		}
	}

	// sửa người dùng và sửa cả tên đăng nhập
	public function suaNguoiDung($id, $tenDangNhap, $matKhau, $hoTen, $diaChi, $dienThoai, $email, $loaiNguoiDung, $trangThai, $hinhAnh = NULL) {
		$db = DATABASE::connect();
		try {
			if($hinhAnh != NULL)
				$sql = "UPDATE nguoidung SET ten_dang_nhap=:tenDangNhap, mat_khau=:matKhau, ho_ten=:hoTen, dia_chi=:diaChi, dien_thoai=:dienThoai, email=:email, loai_nguoi_dung=:loaiNguoiDung, hinh_anh=:hinhAnh, trang_thai=$trangThai WHERE id=:id";
			else
				$sql = "UPDATE nguoidung SET ten_dang_nhap=:tenDangNhap, mat_khau=:matKhau, ho_ten=:hoTen, dia_chi=:diaChi, dien_thoai=:dienThoai, email=:email, loai_nguoi_dung=:loaiNguoiDung, trang_thai=$trangThai WHERE id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", $id);
			$cmd->bindValue(":tenDangNhap", $tenDangNhap);
			$cmd->bindValue(":matKhau", md5($matKhau));
			$cmd->bindValue(":hoTen", $hoTen);
			$cmd->bindValue(":diaChi", $diaChi);
			$cmd->bindValue(":dienThoai", $dienThoai);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":loaiNguoiDung", $loaiNguoiDung);
			if($hinhAnh != NULL)
				$cmd->bindValue(":hinhAnh", $hinhAnh);
			//$cmd->bindValue(":trangThai", $trangThai);
			$cmd->execute();
			$cmd->closeCursor();
			return true;
		} catch(PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn ở suaNguoiDung: $error_message</p>";
			exit();
		}
	}

	//sửa người dùng không sửa tên đăng nhậP
	public function suaNguoiDungKhongSuaTenDangNhap($id, $matkhau, $hoten, $diachi, $dienthoai, $email, $loainguoidung, $hinhanh) {
		$db = DATABASE::connect();
		try {
			$sql = "UPDATE nguoidung SET mat_khau=:matkhau, ho_ten=:hoten, dia_chi=:diachi, dien_thoai=:dienthoai, email=:email, loai_nguoi_dung=:loainguoidung, hinh_anh=:hinhanh WHERE id=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", $id);
			$cmd->bindValue(":matkhau", md5($matkhau));
			$cmd->bindValue(":hoten", $hoten);
			$cmd->bindValue(":diachi", $diachi);
			$cmd->bindValue(":dienthoai", $dienthoai);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":loainguoidung", $loainguoidung);
			$cmd->bindValue(":hinhanh", $hinhanh);
			$cmd->execute();
			$cmd->closeCursor();
			return true;
		} catch(PDOException $e) {
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn ở suaNguoiDungKhongSuaTenDangNhap: $error_message</p>";
			exit();
		}
	}

	//sửa người dùng dựa theo tên đăng nhập và không sửa tên đăng nhập
	public function suaNguoiDungTheoTenDangNhap($tenDangNhap, $matKhau, $hoTen, $diaChi, $dienThoai, $email, $loaiNguoiDung, $hinhAnh, $trangThai) {
		$db = DATABASE::connect();
		try {
			$sql = "UPDATE nguoidung SET mat_khau = :matKhau, ho_ten = :hoTen, dia_chi = :diaChi, dien_thoai = :dienThoai, email = :email, loai_nguoi_dung = :loaiNguoiDung, hinh_anh = :hinhAnh, trang_thai = :trangThai WHERE ten_dang_nhap = :tenDangNhap";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":tenDangNhap", $tenDangNhap);
			$cmd->bindValue(":matKhau", md5($matKhau));
			$cmd->bindValue(":hoTen", $hoTen);
			$cmd->bindValue(":diaChi", $diaChi);
			$cmd->bindValue(":dienThoai", $dienThoai);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":loaiNguoiDung", $loaiNguoiDung);
			$cmd->bindValue(":hinhAnh", $hinhAnh);
			$cmd->bindValue(":trangThai", $trangThai);
			$cmd->execute();
			$rows = $cmd->rowCount();
			$cmd->closeCursor();
			return $rows;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn ở suaNguoiDungTheoTenDangNhap: $error_message</p>";
			exit();
		}
	}

	public function doiMatKhau($id, $matKhauCu, $matKhauMoi) {
		$db = DATABASE::connect();
		try {
			// Kiểm tra mật khẩu cũ có đúng không
			$sql = "SELECT * FROM nguoidung WHERE id = :id AND mat_khau = :matKhauCu";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id', $id, PDO::PARAM_INT);
			$cmd->bindValue(':matKhauCu', md5($matKhauCu));
			$cmd->execute();
			$user = $cmd->fetch(PDO::FETCH_ASSOC);
	
			//nếu người dùng nhập sai thông tin (biến user không có giá trị hoặc là giá trị của nó là null, false hoặc empty. thì sẽ trả về false)
			if (!$user) {
				return false;
			}
	
			// Cập nhật mật khẩu mới vào cơ sở dữ liệu
			$sql = "UPDATE nguoidung SET mat_khau = :matKhauMoi WHERE id = :id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id', $id, PDO::PARAM_INT);
			$cmd->bindValue(':matKhauMoi', md5($matKhauMoi));
			$cmd->execute();
	
			return true;
		} catch(PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn ở doiMatKhau: $error_message</p>";
			exit();
		} finally {
			DATABASE::close();
		}
	}

	//cập nhật ngưỜi dùng
	public function capNhatNguoiDung($id, $ho_ten, $dia_chi, $dien_thoai, $email, $hinh_anh=NULL) {
		$db = DATABASE::connect();
		try {
			if($hinh_anh != NULL)
				$sql = "UPDATE nguoidung SET ho_ten = :ten, email = :email, dien_thoai = :soDienThoai, dia_chi = :diaChi, hinh_anh=:hinhAnh WHERE id = :id";
			else
				$sql = "UPDATE nguoidung SET ho_ten = :ten, email = :email, dien_thoai = :soDienThoai, dia_chi = :diaChi WHERE id = :id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':id', $id, PDO::PARAM_INT);
			$cmd->bindValue(':ten', $ho_ten);
			$cmd->bindValue(':email', $email);
			$cmd->bindValue(':soDienThoai', $dien_thoai);
			$cmd->bindValue(':diaChi', $dia_chi);
			if($hinh_anh!=NULL)
				$cmd->bindValue(':hinhAnh', $hinh_anh);
			$cmd->execute();
	
			return true;
		} catch(PDOException $e) {
			$error_message = $e->getMessage();
			echo "<p>Lỗi truy vấn ở capNhatNguoiDung: $error_message</p>";
			exit();
		} finally {
			DATABASE::close();
		}
	}
	//-----------------------------------------------------------------------------------------------------------

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
