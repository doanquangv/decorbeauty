<?php
		require "../config/connect.php";

	if(isset($_POST["update"]))
	{       $P_ID = $_POST["P_ID"];
		    $P_Name = $_POST["P_Name"];
			$P_Price = $_POST["P_Price"];
			$P_Size = $_POST["P_Size"];
			$P_Material = $_POST["P_Material"];
			$P_Code = $_POST["P_Code"];
			$P_Image = $_POST["P_Image"];
			$P_Status = $_POST["P_Status"];
		$sql1 = "UPDATE product_detail SET Product_Name=N'$P_Name',Product_Price=N'$P_Price',Product_Size='$P_Size',Product_Material='$P_Material',Product_Code='$P_Code',Product_Image='$target_file',Product_Status=N'$P_Status' WHERE Product_ID=$P_ID";

		if (mysqli_query($conn, $sql1)) {
			echo "Record updated successfully";
			header("location:product_detail.php");
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
			<h1 style="text-align:center;font-size:28px;margin:30px 0px;">TRANG CẬP NHẬT CHI TIẾT SẢN PHẨM</h1>
			<div class="row">
				<div class="col-6">
					<form action="update_product_detail.php" method="post">
						<?php
							if(isset($_GET["id"]))
							{
								$P_ID = $_GET["id"];
								$sql_select = "select * from product_detail where Product_ID=$P_ID";
								$result = mysqli_query($conn,$sql_select);
								if (mysqli_num_rows($result) > 0) 
								{
									// output data of each row
									while($row = mysqli_fetch_assoc($result)) 
									{
										echo "<input name='P_ID' type='hidden' value='".$row["Product_ID"]."'>";
                                        echo "Tên sản phẩm:";
                                        echo "<input value='".$row['Product_Name']."' class='form-control' type='text' name='P_Name'/>";
                                        echo "Giá:";
                                        echo "<<input value='".$row['Product_Price']."' class='form-control' type='text' name='P_Price'/>";
                                        echo "Kích Thước:";
                                        echo "<<input value='".$row['Product_Size']."' class='form-control' type='text' name='P_Size'/>";
                                        echo "Vật liệu:";
                                        echo "<input value='".$row['Product_Material']."' class='form-control' type='text' name='P_Material'/>";
                                        echo "Mã danh mục :";
                                        echo "<input value='".$row['Product_Code']."' class='form-control' type='text' name='P_Code'/>";
                                        echo "Hình ảnh:";
                                        echo "<input value='".$row['Product_Image']."' class='form-control' type='file' name='P_Image'/>";
                                        echo "Trạng thái:";
                                        echo "<input value='".$row['Product_Status']."' class='form-control' type='text' name='P_Status'/>";
										
									
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
