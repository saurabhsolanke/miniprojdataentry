<?php
        session_start();
        if (isset($_SESSION['email'])) {
            $sessionMail = $_SESSION['email'];
            include "conn.php";
            $fetchIdquery = "select id from users where email = '$sessionMail'";
            $fetchIdRaw = mysqli_query($conn,$fetchIdquery);
            $row = mysqli_fetch_assoc($fetchIdRaw);
            $rowId = $row['id'];
            $_SESSION['userId'] = $rowId;
?>

<!doctype html>
<html lang="en">
    <head>
        <title>!Amazon</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <?php
            if (isset($_POST['submit'])) {
                $product_name = $_POST['product_name'];
                $product_desc = $_POST['product_desc'];
                $product_price = $_POST['product_price'];
                $product_quantity = $_POST['product_quantity'];
                $payment_mode = $_POST['payment_mode'];

                if ($product_name == "") {
                    header("location:dashboard.php");
                    
                } else {
                    if ($product_desc == "") {
                        header("location:dashboard.php");
                        
                    } else {
                        if ($product_price == "") {
                            header("location:dashboard.php");
                            
                        } else {
                            if ($product_quantity == "") {
                                header("location:dashboard.php");
                                
                            } else {
                                if ($payment_mode == "") {
                                    header("location:dashboard.php");
                                    
                                } else {
                                    include "conn.php";
                                    
                                    $orderQuery = "Insert into orders(customer_id, product_name, product_desc, product_price, product_quantity, payment_mode) values('$rowId','$product_name','$product_desc','$product_price','$product_quantity','$payment_mode')";
                                    mysqli_query($conn,$orderQuery);
                                    echo "Order Placed";
                                }
                            }
                        }
                    }
                }
                

            }
        
        ?>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <li class="nav-item navbar-brand">
                <a class="navbar-brand" href="#">!Amazon</a>
            </li>
            <ul class="navbar-nav">
                
                <li class="nav-item">
                    <a class="nav-link" href="orderList.php">My Orders</a>
                </li>
            </ul>
            <li class="navbar-nav ml-auto">
                
                <a class="nav-link" href="logout.php">
                    <span class="material-icons">login</span>    
                    
                </a>
            </li>
                
        </nav>

        <div class="container">
            <form action="dashboard.php" method="POST" >
                <div class="form-group">
                    <label for="Product name">Product name: </label>
                    <input type="text" name="product_name" class="form-control" value="<?php if( isset( $_GET['product_name'] ) ){ echo $_GET['product_name']; } ?>" id="" placeholder="Eg: Laptop">
                </div>
                <div class="form-group">
                    <label for="Product name">Product description: </label>
                    <input type="text" name="product_desc" class="form-control" id="" value="<?php if( isset( $_GET['product_desc'] ) ){ echo $_GET['product_desc']; } ?>" placeholder="Eg: 27inch Monitor">
                </div>
                <div class="form-group">
                    <label for="Product name">Product Price: </label>
                    <input type="number" name="product_price" class="form-control" id="" value="<?php if( isset( $_GET['product_price'] ) ){ echo $_GET['product_price']; } ?>" placeholder="Eg: 30,000">
                </div>
                <div class="form-group">
                    <label for="Product name">Product Quantity: </label>
                    <input type="number" name="product_quantity" class="form-control" id="" value="<?php if( isset( $_GET['product_quantity'] ) ){ echo $_GET['product_quantity']; } ?>" placeholder="Eg: 2">
                </div>
                <div class="form-group">
                        <label for="sel1">Select list:</label>
                        <select class="form-control" name="payment_mode">
                            <option value="">---Select Payment Method---</option>
                            <option value="UPI">UPI</option>
                            <option value="Debit Card">Debit Card</option>
                            <option value="Credit Card">Credit Card</option>
        
                        </select>
                </div>
                <input type="submit" name="submit" value="Place Order" class="btn btn-success">
                
            </form>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>

<?php
        }else {
            header("location:index.php");
        }

?>