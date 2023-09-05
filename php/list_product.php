<?php
    	require "../config/connect.php";

    
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <?php
                    if(isset($_GET["id"]))
                    {
                        $P_id = $_GET["id"];
                        $sql_select = "select * from product where Product_ID = ". $P_id;
                        $result = mysqli_query($conn,$sql_select);
                        if (mysqli_num_rows($result) > 0) 
                        {
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                                echo "<div class='col-3'>";
                                echo "<a style='text-decoration:none;' href='product.php?product_id=".$row["Product_ID"]."'>";
                                echo "<img style='width:100%' src='".$row["Image"]."'>";
                                echo "<p style=' color:#000000; text-align: center;' >".$row["Product_Name"]."</p>";
                                echo "<p style='text-align:center;color:#000000; margin-left:200px;'>".$row["Price"]."</p>";
                                echo "</a>";
                                echo "</div>";
                            }
                        } 
                        else {
                            echo "không có dữ liệu trả về";
                        }
                    }

                ?>
            </div>
        </div>
    </body>
</html>
