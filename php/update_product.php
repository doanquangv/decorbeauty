<?php
		require "../config/connect.php";

	if(isset($_POST["update"]))
	{
		$P_id = $_POST["P_id"];
		$cate_id = $_POST["cate_id"];
		$p_name = $_POST["p_name"];
		$p_price = $_POST["p_price"];
		$p_image = $_POST["p_image"];
		$status = $_POST["status"];
		$sql = "UPDATE product SET Category_ID='$cate_id',Product_Name=N'$p_name',Price=N'$p_price',Image=N'$target_file',Status='$status' WHERE Product_ID=$P_id"; 

		if (mysqli_query($conn, $sql)) {
			echo "Record updated successfully";
			header("location:product.php");
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
			<h1 style="text-align:center;font-size:28px;margin:30px 0px;">TRANG CẬP NHẬT SẢN PHẨM</h1>
			<div class="row">
				<div class="col-6">
					<form action="update_product.php" method="post">
						<?php
							if(isset($_GET["id"]))
							{
								$P_id = $_GET["id"];
								$sql_select = "select * from product where Product_ID=$P_id";
								$result = mysqli_query($conn,$sql_select);
								if (mysqli_num_rows($result) > 0) 
								{
									// output data of each row
									while($row = mysqli_fetch_assoc($result)) 
									{
										echo "<input name='P_id' type='hidden' value='".$row["Product_ID"]."'>";
										
										echo " Danh mục";
										echo "<input value='".$row["Category_ID"]."' class='form-control' type='text' name='cate_id'/>";
										
										echo "Tên sản phẩm";
										echo "<input value='".$row['Product_Name']."' class='form-control' type='text' name='p_name'/>";
										
										echo "Giá sản phẩm:";
                                        echo "<input value='".$row['Price']."' class='form-control' type='text' name='p_price'/>";
										
										echo "Hình ảnh sản phẩm:";
                                        echo "<input value='".$row['Image']."' class='form-control' type='file' name='p_image'/>";
                                       
										echo "Trạng thái sản phẩm:";
                                        echo "<input value='".$row['Status']."' class='form-control' type='text' name='status'/>";
									
                                        
										
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
