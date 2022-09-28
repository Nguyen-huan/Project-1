<?php
// Kiểm tra sự tồn tại của tham số id trước khi xử lý thêm
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include file connect.php
    require_once "../connect.php";
    
    // Chuẩn bị câu lệnh Select
    $sql = "SELECT * FROM employees WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Liên kết các biến với câu lệnh đã chuẩn bị
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Thiết lập tham số
        $param_id = trim($_GET["id"]);
        
        // Cố gắng thực thi câu lệnh đã chuẩn bị
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Lấy hàng kết quả dưới dạng một mảng kết hợp. Vì tập kết quả chỉ chứa một hàng, chúng tôi không cần sử dụng vòng lặp while */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Lấy giá trị trường riêng lẻ
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else{
                // URL không chứa tham số id hợp lệ. Chuyển hướng đến trang error
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oh, no. Có gì đó sai sai. Vui lòng thử lại.";
        }
    }
     
    // Đóng câu lệnh
    mysqli_stmt_close($stmt);
    
    // Đóng kết nối
    mysqli_close($conn);
} else{
    // URL không chứa tham số id. Chuyển hướng đến trang error
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p class="form-control-static"><?php echo $row["address"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <p class="form-control-static"><?php echo $row["salary"]; ?></p>
                    </div>
                    <p><a href="employeeList.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>