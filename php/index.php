<?php
	require "../config/connect.php";
	
	
	session_start();
	//logout 
	if(isset($_GET["task"]) && $_GET["task"]=='logout')
	{
		session_destroy();
		header("location:index.php");
	}
	if(!$_SESSION["ten_dn"])
	{
		echo "xin chào " . $_SESSION["ten_dn"];
	}
	echo "<a style='margin-left: 1435px;' href='login.php?task=logout' class='btn btn-danger'> Đăng xuất </a>";
	//kiểm tra xem người dùng đã nhấn nút thêm mới chưa
	if(isset($_POST["insert"]))
	{
		$cate_name = $_POST["cate_name"];
		$status = $_POST["status"];
		//thêm mới danh mục
		$sql_insert = "insert into category(Cate_Name,Status) values(N'$cate_name',$status)";
		if (mysqli_query($conn, $sql_insert)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
		}
		header("location:index.php");
	}
	//xóa danh mục sản phâm
	if(isset($_GET["task"])&& $_GET["task"]=="delete")
	{
		$cate_id = $_GET["id"];
		$sql = "delete from category where Cate_ID = $cate_id";
		if (mysqli_query($conn, $sql)) {
			echo "Delete record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
?>
<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<h1 style="text-align:center;font-size:28px;margin:30px 0px;">TRANG QUẢN TRỊ DANH MỤC SẢN PHẨM</h1>
			<div class="row">
				<div class="col-6">
					<form action="index.php" method="post">
						Tên danh mục:
						<input class="form-control" type="text" name="cate_name"/>
						Trạng thái danh mục:
						<input class="form-control" type="text" name="status"/>
						<input class="btn btn-primary" type="submit" name="insert" value="Thêm mới">
					</form>
				</div>
        <div class="col-6">
        <h5 style="text-align:center;color:red; font-size:18px;">Tìm kiếm theo tên</h5>
        <form action="index.php" method="post">

          <input class="form-control" type="text" name="search" placeholder="nhập vào tên danh mục ..." />
          <input style="margin-top:10px;" class="btn btn-danger" type="submit" name="sb_search" value="Search">
        </form>
        </div>

			</div>
			<table class="table table-striped">
				<tr>
					<th>Mã danh mục</th>
					<th>Tên danh mục</th>
					<th>Trạng thái danh mục</th>
					<th>Chức năng</th>
				</tr>
				<?php
					//timf kieems 
					if (isset($_POST["sb_search"])) 
					{
						$cate_name = $_POST["search"];
						$sql = "select * from category where Cate_Name like '%$cate_name%'";
						$result = mysqli_query($conn, $sql);
				
						if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							echo "<td>" . $row["Cate_ID"] . "</td><td>" . $row["Cate_Name"] . "</td><td>" . $row["Status"] . "</td>";
							echo "<td><a href='index.php?task=delete&id=" . $row['Cate_ID'] . "' class='btn btn-danger'>Xóa</a>";
							echo "<a target='_blank' href='update_cate.php?task=update&id=".$row["Cate_ID"]."' style='margin-left:10px;' class='btn btn-warning'>Sửa</a></td>";
							// echo "<a href='index.php?task=update&id=" . $row["Cate_ID"] . "' style='margin-left:10px;' class='btn btn-warning'>Sửa</a></td>";
							echo "</tr>";
						}
						} else {
						echo "0 results";
						}
					}
    
          //   include "config/connect.php";
          else {
            $sql = "select * from category";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              // output data of each row
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["Cate_ID"] . "</td><td>" . $row["Cate_Name"] . "</td><td>" . $row["Status"] . "</td>";
                echo "<td><a href='index.php?task=delete&id=" . $row['Cate_ID'] . "' class='btn btn-danger'>Xóa</a>";
                echo "<a target='_blank' href='update_cate.php?task=update&id=".$row["Cate_ID"]."' style='margin-left:10px;' class='btn btn-warning'>Sửa</a></td>";
                // echo "<a href='index.php?task=update&id=" . $row["Cate_ID"] . "' style='margin-left:10px;' class='btn btn-warning'>Sửa</a></td>";
                echo "</tr>";
              }
            } else {
              echo "0 results";
            }
          }
    
				?>
			</table>
		</div>
	</body>
</html>

