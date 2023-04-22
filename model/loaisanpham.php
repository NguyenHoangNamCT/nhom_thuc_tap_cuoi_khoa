    <?php
    class LOAISP{
        // Lấy danh sách loại sp
        public function layLoaiSP(){
            $dbcon = DATABASE::connect();
            try{
                $sql = "SELECT * FROM loaisanpham";
                $cmd = $dbcon->prepare($sql);
                $cmd->execute();
                $result = $cmd->fetchAll();
                return $result;
            }
            catch(PDOException $e){
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn layLoaiSP: $error_message</p>";
                exit();
            }
        }
                //đếm tổng số lượng loại sản phẩm
            public function laySoLuongLoaiSP() {
            $db = DATABASE::connect();
            try {
                $sql = "SELECT COUNT(*) as so_luong FROM loaisanpham";
                $result = $db->query($sql);
                $row = $result->fetch(PDO::FETCH_ASSOC);
                return $row['so_luong'];
            } catch(PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn : $error_message</p>";
                exit();
            } finally {
                DATABASE::close();
            }
        }

        //loại sp phân trang
        public function layLoaiSanPhamPhanTrang($trang, $soluong) {
            $dbcon = DATABASE::connect();
            try {
                $batDau = ($trang - 1) * $soluong;
                if ($batDau < 0) {
                    $batDau = 0;
                }
                $sql = "SELECT * FROM loaisanpham ORDER BY id LIMIT :batDau, :soluong";
                $cmd = $dbcon->prepare($sql);
                $cmd->bindValue(':batDau', $batDau, PDO::PARAM_INT);
                $cmd->bindValue(':soluong', $soluong, PDO::PARAM_INT);
                $cmd->execute();
                $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch(PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn: $error_message</p>";
                exit();
            } finally {
                DATABASE::close();
            }
        }
        
        public function themLoaiSanPham($ten_loai_san_pham, $mo_ta, $trang_thai, $hinh_anh){
            $db = DATABASE::connect();
            try{
                $sql = "INSERT INTO loaisanpham (ten_loai_san_pham, mo_ta, trang_thai, hinh_anh) VALUES (:ten_loai_san_pham, :mo_ta, :trang_thai, :hinh_anh)";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(':ten_loai_san_pham', $ten_loai_san_pham);
                $cmd->bindValue(':mo_ta', $mo_ta);
                $cmd->bindValue(':trang_thai', $trang_thai, PDO::PARAM_INT);
                $cmd->bindValue(':hinh_anh', $hinh_anh);
                $cmd->execute();
                $lastInsertId = $db->lastInsertId();
                return $lastInsertId;
            }
            catch(PDOException $e){
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn ở themLoaiSanPham: $error_message</p>";
                exit();
            }
            finally {
                DATABASE::close();
            }
        }

        // Xoá 
        public function xoaLoaiSanPham($id){
            $db = DATABASE::connect();
            try{
                $sql = "DELETE FROM loaisanpham WHERE id = :id";
                $cmd = $db->prepare($sql);
                $cmd->bindValue(':id', $id, PDO::PARAM_INT);
                $cmd->execute();
                $rowCount = $cmd->rowCount();
                return $rowCount;
            }
            catch(PDOException $e){
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn ở xoaLoaiSanPham: $error_message</p>";
                exit();
            }
            finally {
                DATABASE::close();
            }
        }

        //sửa
        public function suaLoaiSanPham($id, $tenLoaiSanPham, $moTa, $hinhAnh=NULL) {
            $db = DATABASE::connect();
            try{
                if($hinhAnh != NULL)
                    $sql = "UPDATE loaisanpham SET ten_loai_san_pham = :tenLoaiSanPham, mo_ta = :moTa, hinh_anh = :hinhAnh WHERE id = :id";
                else
                    $sql = "UPDATE loaisanpham SET ten_loai_san_pham = :tenLoaiSanPham, mo_ta = :moTa WHERE id = :id";

                $cmd = $db->prepare($sql);
                $cmd->bindValue(':id', $id, PDO::PARAM_INT);
                $cmd->bindValue(':tenLoaiSanPham', $tenLoaiSanPham, PDO::PARAM_STR);
                $cmd->bindValue(':moTa', $moTa, PDO::PARAM_STR);
                if($hinhAnh != NULL)
                    $cmd->bindValue(':hinhAnh', $hinhAnh, PDO::PARAM_STR);
                $cmd->execute();
                $rowCount = $cmd->rowCount();
                return $rowCount;
            }
            catch(PDOException $e){
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn ở suaLoaiSanPham: $error_message</p>";
                exit();
            }
            finally {
                DATABASE::close();
            }
        }

        //lấy loại sản phẩm theo id
        function layLoaiSanPhamById($id) {
            $conn = DATABASE::connect();
            try {
                $sql = 'SELECT * FROM loaisanpham WHERE id = :id';
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $loaiSanPham = $stmt->fetch(PDO::FETCH_ASSOC);
                return $loaiSanPham;
            } catch(PDOException $e) {
                echo "Lỗi truy vấn ở layLoaiSanPhamById: " . $e->getMessage();
                return null;
            }
        }

        //tìm kiếm theo tên gần đúng
        public function timKiemLoaiSanPham($ten_loai_san_pham) {
            $db = DATABASE::connect();
            try {
                $sql = "SELECT * FROM loaisanpham WHERE ten_loai_san_pham LIKE :ten_loai_san_pham";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':ten_loai_san_pham', "%$ten_loai_san_pham%");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn ở timKiemLoaiSanPham: $error_message</p>";
                exit();
            } finally {
                DATABASE::close();
            }
        }
         //tìm kiếm theo tên gần đúng
         public function timKiemLoaiSanPhamPhanTrang($ten_loai_san_pham,  $trang, $soluong) {
            $db = DATABASE::connect();
            try {
                $batDau = ($trang - 1) * $soluong;
                if($batDau < 0)
                    $batDau = 0;
                $sql = "SELECT * FROM loaisanpham WHERE ten_loai_san_pham LIKE :ten_loai_san_pham ORDER BY id LIMIT :batDau, :soluong";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':ten_loai_san_pham', "%$ten_loai_san_pham%");
                $stmt->bindValue(':batDau', $batDau, PDO::PARAM_INT);
                $stmt->bindValue(':soluong', $soluong, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Lỗi truy vấn ở timKiemLoaiSanPham: $error_message</p>";
                exit();
            } finally {
                DATABASE::close();
            }
        }
        
    }
?>
