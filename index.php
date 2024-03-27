<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THÔNG TIN NHÂN VIÊN</title>
    <style>
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #f5b642;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #8ca8db;
        }
        .pagination {
            display: inline-block;
        }
        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }
        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }
        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Mã Nhân Viên</th>
                <th>Tên Nhân Viên</th>
                <th>Giới Tính</th>
                <th>Nơi Sinh</th>
                <th>Mã Phòng</th>
                <th>Lương</th>
                <th>Action</th> <!-- Thêm cột action -->
            </tr>
        </thead>
        <tbody>
            <?php
            include "connect.php"; 
            // Thiết lập phân trang
            $limit = 5; 
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($page - 1) * $limit;
            // Truy vấn SQL để chọn bản ghi có phân trang
            $sql = "SELECT * FROM nhanvien LIMIT $start, $limit";
            $result = mysqli_query($conn, $sql);

          
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['Ma_NV'] . "</td>";
                echo "<td>" . $row['Ten_NV'] . "</td>";
                echo "<td>";
                            // Xác định hình ảnh dựa trên giới tính
                            $gender = $row['Phai'];
                            if ($gender === 'NU') {
                                $imagePath = 'img/woman.jpg';
                            } else {
                                $imagePath = 'img/man.jpg';
                            }
                            echo '<img class="gender-image" src="' . $imagePath . '" alt="Phái">';
                        
                echo "</td>";
                echo "<td>" . $row['Noi_Sinh'] . "</td>";
                echo "<td>" . $row['Ma_Phong'] . "</td>";
                echo "<td>" . $row['Luong'] . "</td>";
                echo "<td>";
                // Thêm các liên kết hoặc nút điều hướng đến các trang hoặc kích hoạt các chức năng tương ứng
                echo "<a href='add.php?id=" . $row['Ma_NV'] . "'>Thêm</a> | ";
                echo "<a href='delete.php?id=" . $row['Ma_NV'] . "'>Xóa</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    
    <!-- Liên kết phân trang -->
    <div class="pagination"> 
        <?php
    
        $sql_count = "SELECT COUNT(*) AS total FROM nhanvien";
        $result_count = mysqli_query($conn, $sql_count);
        $row_count = mysqli_fetch_assoc($result_count);
        $total_pages = ceil($row_count["total"] / $limit);

        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?page=" . $i . "'";
            if ($page == $i) {
                echo " class='active'";
            }
            echo ">" . $i . "</a>";
        }
        ?>
    </div>
</body>
</html>