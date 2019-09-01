<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/style.css">
    <title>Adding into database</title>
</head>

<body>
    <div class="body">
        <h1>Adding Product Form</h1>
        <?php 
        require("connect.php");   
        if(isset($_POST["submit"]))
            {
                $name = $_POST["proname"];
                $price = $_POST["price"];
                $descrip = $_POST["descrip"];
                if ($name == ""||$price == ""|| $descrip == "") 
                    {
                        ?>
                        <script>
                            alert("Please input product information!!");
                        </script>
                        <?php
                    }
                else
                    {
                        $sql = "select * from product where proname='$name'";
                        $query = pg_query($conn, $sql);
                        if(pg_num_rows($query)>0)
                        {
                        ?> 
                            <script>
                                alert("The product is available!!");
                            </script>
                        <?php
                        }
                        else
                        {
                            $sql = "INSERT INTO product(proname, price, descrip) VALUES ('$name','$price','$descrip')";
                            pg_query($conn,$sql);
                            ?> 
                                <script>
                                    alert("Added into Database successful!!");
                                    window.location.href = "/managing.php";
                                </script>
                            <?php
                        }
                    }
            }
			?>
        <form action="add.php" method="POST">
            <input class="input-information" style="margin-left: 140px" type="text" name="proname" placeholder="Name"> <br>
            <input class="input-information" style="margin-left: 140px" type="text" name="price" placeholder="Price"> <br>
            <input class="input-information" style="margin-left: 140px" type="text" name="descrip" placeholder="Description"> <br>
            <button type="submit" value="Add" name="submit">Add</button>
        </form>
        
        <button><a href="/managing.php">Back</a></button>
    </div>
</body>

</html>