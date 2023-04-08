<?php 
    include("../view/top.php");
    $mangNguoiDung = $nd->laydanhsachnguoidung();
?>
    <div class="container-fluid">
    <h2>Quản lý người dùng</h2>
    <a href="?action=themND" class="btn btn-info">Thêm người dùng</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Email</th>
                <th>Tên</th>
                <th>Phân quyền</th>
                <th>Trạng thái</th>
                <th>Khoá</th>
                <th>Xoá</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($mangNguoiDung as $arr)
                {      
            ?>
                    
                    <tr>
                        <td><?php echo $arr['email']; ?></td>
                        <td><?php echo $arr['hoten']; ?></td>
                        <td>
                            <?php
                                $loaiND = $arr['quyen'];
                                if($loaiND == 1)
                                    echo "Quản trị";
                                else if($loaiND == 2)
                                    echo "Nhân viên";
                                else if($loaiND == 3)
                                    echo "Người dùng";
                            ?>
                        </td>
                        <td>
                            <?php 
                                $trangThai = $arr['trangthai'];
                                if($trangThai == 1)
                                    echo "Kích hoạt";
                                else 
                                    echo "Khoá";
                            ?>
                        </td>
                        <td>
                          <?php 
                            if($arr['trangthai'] == 1)
                            {
                          ?>
                              <?php 
                                if($arr['id'] == $_SESSION['nguoiDung']['id'])
                                  echo 'You';
                                else
                                {
                              ?>
                              <a href="?action=thayDoiTrangThai&id=<?php echo $arr['id']; ?>&trangThai=<?php echo $arr['trangthai']; ?>" class="btn btn-danger">Khoá</a>
                              <?php 
                                }
                              ?>
                          <?php 
                            }
                            else
                            {
                          ?>
                              <a href="?action=thayDoiTrangThai&id=<?php echo $arr['id']; ?>&trangThai=<?php echo $arr['trangthai']; ?>" class="btn btn-success">Mở khoá</a>
                          <?php 
                            }
                          ?>
                        </td>
                        <td><a href="?action=xoa&id=<?php echo $arr['id']; ?>&quyen=<?php echo $arr['quyen']; ?>" class="btn btn-danger">Xoá</a></td>
                    </tr>
            <?php
                  if(isset($idNguoiDungKhongDuocPhepXoa) && $arr['id'] == $idXoaNguoiDung)
                  {
                    echo '<tr>';
                      echo '<td>';
                        echo 
                        '<div class="alert alert-warning">
                          <strong>Không thể xoá người dùng bên trên!</strong> Chỉ có thể xoá người dùng với quyền của người đó là người dùng.
                        </div>';
                      echo '</td>';
                    echo '</tr>';
                  }                  
                }
            ?>
        </tbody>
    </table>
    </div>
<?php 
    include("../view/footer.php");
?>