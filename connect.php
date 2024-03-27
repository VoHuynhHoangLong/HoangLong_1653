<?php
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'ql_nhansu';

    $conn = new mysqli($server, $user, $pass, $database);

    if ($conn) {
        mysqli_query($conn, "SET NAMES 'utf8'");
        echo '<div style="text-align: center;">THÔNG TIN DANH SÁCH SINH VIÊN</div>';
    } else {
        echo 'Kết nối với Database không thành công!';
    }
?>