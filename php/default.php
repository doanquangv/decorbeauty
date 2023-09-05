<?php
    require "config/connect.php";
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row" style="background:    #CCCCCC">
                <?php
                    $sql_select = "select * from category";
                    $result = mysqli_query($conn,$sql_select);
                    if (mysqli_num_rows($result) > 0) 
                    {
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                            echo "<a style='text-decoration:none;color:#fff; display:block;' href='list_product.php?id=".$row["Cate_ID"]."']'>";
                            echo $row["Cate_Name"];
                            echo "</a>";
                        }
                    } 
                    else {
                        echo "không có dữ liệu trả về";
                    }
                ?>
            </div>
        </div>
    </body>
</html>