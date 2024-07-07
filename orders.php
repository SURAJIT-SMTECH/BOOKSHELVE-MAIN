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

<h1 id="first"><center>Bookshelves - Subscription </center></h1>

<div id="pricing-table">
    <div class="plan plan1">
        <div class="header"><b>Weekly</b></div>
        <div class="price">100₹</div>  
        <div class="monthly">7 Days + 1 Days Free </div>    
        <ul><br>
            <li><b>Per Day</b> 1 Books</li>
            <!-- <li><b>7+1=8</b> 1 Days Free</li> -->
            <li><b>Per Day Late Fine 20RS</b></li>
          
        </ul>
        <a onClick="setPrice(100)" id="week" class="signup" href="subscription.php">Purchase Now !</a>         
    </div >
    
    <div class="plan plan3">
        <div class="header"><b>Monthly</b></div>
        <div class="price">199₹</div>
        <div class="monthly">30 Days + 5 Days Free </div>
        <ul>
            <li><b>Per Day</b>3 Books</li>
            <li><b>Per Day Late Fine 10RS</b></li>      
        </ul>
        <a onClick="setPrice(199)" id="month" class="signup" href="subscription.php">Purchase Now !</a>        
    </div>
    <div class="plan plan4">
        <div class="header"><b>Yearly</b></div>
        <div class="price">999₹</div>
        <div class="monthly">365 Days + 30 Days Free</div>
        <ul>
            <li><b>Per Day</b>5 Books</li>
            <li><b>Per Day Late Fine 5 Rs</b></li>     
        </ul>
        <a onClick="setPrice(999)" id="year" class="signup" href="subscription.php">Purchase Now !</a>        
    </div>  
</div>
















<?php include 'footer.php'; ?>
<script>
    const setPrice=(p)=>{
        localStorage.setItem("price",p)
    }

</script>
</body>
</html>