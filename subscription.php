<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


</head>
<body>
   
<?php include 'header.php'; ?>
    <div class="d-flex flex-column align-items-center justify-content-evenly">
        <h1>Subscription</h1>
        <h3>Pay <span id="price"></span></h3>
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div class="m-4">
                <h1>Pay Using Scanner</h1>
                <img src="images/scanner.jpeg" alt="" style="width:350px;height:500px;">
            </div>
            <p class="fs-2 m-4">or</p>
            <div class="m-4 h-10">
                <h1>Pay by UPI Details</h1>
                <ul class="fs-3">
                    <li>Name: Kavya Gupta</li>
                    <li>UPI Id: kavyag4808@okaxis</li>
                </ul>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
<script>
    var plan=""
    var p=localStorage.getItem("price")
    if(p==100)
        plan="weekly"
    else if(p==199)
        plan="monthly"
    else
        plan="yearly"
    console.log(plan,p)
    document.getElementById("price").innerText=`(${plan}) : $${p}`
</script>
</body>
</html>
