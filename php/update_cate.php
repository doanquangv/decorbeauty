<?php
		require "../config/connect.php";

	if(isset($_POST["update"]))
	{
		$cate_id = $_POST['cate_id'];
		$cate_name = $_POST["cate_name"];
		$status = $_POST["status"];
		$sql = "UPDATE category SET Cate_Name=N'$cate_name', Status=$status WHERE Cate_ID=$cate_id";

		if (mysqli_query($conn, $sql)) {
			echo "Record updated successfully";
			header("location:index.php");
		} 
		else {
			echo "Error updating record: " . mysqli_error($conn);
		}
	}
?>
<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<h1 style="text-align:center;font-size:28px;margin:30px 0px;">TRANG CẬP NHẬT DANH MỤC SẢN PHẨM</h1>
			<div class="row">
				<div class="col-6">
					<form action="update_cate.php" method="post">
						<?php
							if(isset($_GET["id"]))
							{
								$cate_id = $_GET["id"];
								$sql_select = "select * from category where Cate_ID=$cate_id";
								$result = mysqli_query($conn,$sql_select);
								if (mysqli_num_rows($result) > 0) 
								{
									// output data of each row
									while($row = mysqli_fetch_assoc($result)) 
									{
										echo "<input name='cate_id' type='hidden' value='".$row["Cate_ID"]."'>";
										echo "Tên danh mục";
										echo "<input value='".$row['Cate_Name']."' class='form-control' type='text' name='cate_name'/>";
										echo "Trạng thái danh mục";
										echo "<input value='".$row["Status"]."' class='form-control' type='text' name='status'/>";
									
									}
								} 
								else {
									echo "0 results";
								}
							}
						?>
						
						<input class="btn btn-primary" type="submit" name="update" value="Chỉnh sửa">
					</form>
				</div>
			</div>
			
		</div>
	</body>
</html>

