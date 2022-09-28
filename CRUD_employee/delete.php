<?php
// Quy trình xóa bản ghi sau khi đã xác nhận
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include file config.php
    require_once "../connect.php";
    
    // Chuẩn bị câu lệnh delete
    $sql = "DELETE FROM employees WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Liên kết các biến với câu lệnh đã chuẩn bị
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Thiết lập tham số
        $param_id = trim($_POST["id"]);
        
        // Cố gắng thực thi câu lệnh đã chuẩn bị
        if(mysqli_stmt_execute($stmt)){
            // Xóa bản ghi thành công. Chuyển hướng đến trang đích
            header("location: employeeList.php");
            exit();
        } else{
            echo "Oh, no. Có gì đó sai sai. Vui lòng thử lại.";
        }
    }
     
    // Đóng câu lệnh
    mysqli_stmt_close($stmt);
    
    // Đóng kết nối
    mysqli_close($conn);
} else{
    // Kiểm tra sự tồn tại của tham số id
    if(empty(trim($_GET["id"]))){
        // URL không chứa tham số id. Chuyển hướng đén trang error
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <conn rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="employeeList.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>