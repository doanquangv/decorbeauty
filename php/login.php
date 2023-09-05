<?php
   	require "../config/connect.php";

    session_start();
    if(isset($_POST["login"]))
    {
        $us = $_POST["us"];
        $pa = $_POST["pa"];


	    $sql_select = "select * from tbl_user where UserName = '$us' and PassWord = '$pa'";
        $result = mysqli_query($conn, $sql_select);
						
	    if (mysqli_num_rows($result) > 0) 
	    {
	        echo "Đăng nhập thành công";
            $_SESSION["ten_dn"] = $us;
            header("location:index.php");
	    } else {
		    echo "Sai tên đăng nhập hoặc mật khẩu";
	    }
    }
?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h5 style="text-align: center;">Đăng nhập trang quản trị</h5>
            <div class="row">
                <div class="col-5">
                    <form action="login.php" method="post">
                        Nhập tên đăng nhập :
                        <input class="form-control" type="text" name ="us">
                        Nhập mật khẩu :
                        <input class="form-control" type="password" name="pa">
                        <br/><br/>
                        <input class="btn btn-danger" type="submit" name="login" value="Đăng nhập">
                    </form>
                </div>
            </div>
        </div>
    </body>    
</html>