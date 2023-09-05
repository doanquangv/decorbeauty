<?php
	require "../config/connect.php";

	//thêm mới sản phẩm
	if(isset($_POST["insert"]))
	{
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["p_image"]["name"]);
		$uploadOk = 1;
		
		// Check if file already exists
		if (file_exists($target_file)) {
		  echo "Sorry, file already exists.";
		  $uploadOk = 0;
		}

		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) 
		{
			echo "error file";
		} 
		else {
		  if (move_uploaded_file($_FILES["p_image"]["tmp_name"], $target_file)) 
		  {
			
			$cate_id = $_POST["cate_id"];
			$p_name = $_POST["p_name"];
			$p_price = $_POST["p_price"];
			$p_image = $_POST["p_image"];
			
			$status = $_POST["status"];
			$sql_1 = "insert into product(Category_ID,Product_Name,Price,Image,Status) values($cate_id,N'$p_name',N'$p_price','$target_file',N'$status')";
			if(mysqli_query($conn, $sql_1)) 
			{
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql_1 . "<br>" . mysqli_error($conn);
			}
			header("location:product.php");
			echo "The file ". htmlspecialchars( basename( $_FILES["p_image"]["name"])). " has been uploaded.";
		  } else {
			echo "Sorry, there was an error uploading your file.";
		  }
		}
	}
	if(isset($_GET["task"])&& $_GET["task"]=="delete")
	{
		$P_ID = $_GET["id"];
		$sql = "delete from product where Product_ID = $P_ID";
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
		<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
	</head>
	<body>
		<div class="container">
			<h1 style="text-align:center;font-size:28px;margin-top:30px;">TRANG QUẢN TRỊ SẢN PHẨM</h1>
			<div class="row">
				<div class="col-8">
					<form action="product.php" method="post" enctype="multipart/form-data">
						Chọn danh mục:
						<select name="cate_id" class="form-control">
							<?php
								$sql = "select * from category";
								$result = mysqli_query($conn, $sql);
								
								if (mysqli_num_rows($result) > 0) 
								{
									// output data of each row
									while($row = mysqli_fetch_assoc($result)) 
									{
										echo "<option value='".$row["Cate_ID"]."'>";
										echo $row["Cate_Name"];
										echo "</option>";
									}
								} 
								else {
									echo "0 results";
								}
								
							?>
							
						</select>
						Tên sản phẩm:
						<input class="form-control" type="text" name="p_name">
						Giá:
						<input class="form-control" type="text" name="p_price">
						
						Hình ảnh:
						<input class="form-control" type="file" name="p_image">
						Trạng thái:
						<input class="form-control" type="text" name="status">
						<input type="submit" name="insert" value="Thêm mới sản phẩm" class="btn btn-primary">
					</form>
				</div>
			</div>
			<div class="row">
				<table class="table table-striped">
					<tr>
						<th>Mã sản phẩm</th>
						<th>Danh mục</th>
						<th>Tên sản phẩm</th>
						<th>Giá</th>
						<th>Hình ảnh</th>
						
						<th>Trạng thái</th>
						<th>Thao tác</th>
					</tr>
					<?php
						$sql = "select * from product";
						$result = mysqli_query($conn, $sql);
						
						if (mysqli_num_rows($result) > 0) 
						{
							// output data of each row
							while($row = mysqli_fetch_assoc($result)) 
							{
								echo "<tr>";
								echo "<td>" . $row["Product_ID"] . "</td><td>". $row["Category_ID"]."</td><td>".$row["Product_Name"]."</td><td>".$row["Price"]."</td><td><img style='width: 100px;' src='".$row["Image"]."'></td><td>".$row["Status"]."</td>";
								echo "<td><a  href='product.php?task=delete&id=".$row['Product_ID']."' class='btn btn-danger'>Xóa</a>";
								//echo "<a target='_blank' href='update_cate.php?task=update&id=".$row["Catetegory_ID"]."' style='margin-left:10px;' class='btn btn-warning'>Sửa</a></td>";
								echo "<a target='_blank' href='update_product.php?task=update&id=".$row["Product_ID"]."' style='margin-left:10px;' class='btn btn-warning'>Sửa</a></td>";
								echo "</tr>";
							}
						} 
						else {
							echo "0 results";
						}
					?>
				</table>
				
			</div>
		</div>
	</body>
</html>