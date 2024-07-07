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
   <title>Cafe's</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   <style>
      /* Cafe  */


#cafes{

}
*{
   font-family:arial;
}

.head{
   text-align: center;
   font-size: 65px;
   margin-top: 30px;
}

.cafe{
    margin-left: 30px;
    margin-top: 40px;
}

.cafe-about{
   display: flex;
   justify-content:;
   font-size: 35px;
   margin-bottom: 6px;
   margin-left: 30px;
   margin-top: 50px;
}

.cafe-about p{
   margin-top: 10px;
   font-size: 3rem;
}
.cafe-img{
   margin-top: 15px;
   width: 35vw;
   height: 45vh;
   border: 3px Solid black;
   border-radius:14px;
   display: flex;
   margin-bottom: 20px;
}
.cafe-about div{
   margin-left: 25px;
}
.cafe-books{
   margin-left: 30px;
   font-size: 25px;
}
.main{
   background-color:	#cad1f3;
}
   </style>
<?php include 'header.php'; ?>
<div class="main">
<h1 class="head">Cafes</h1>

<ul id="cafes">
<?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `cafe_admin`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
               $name=$fetch_products['name'];
      ?>
     <li class="cafe" >
      <div class="cafe-about">
      <img class="cafe-img" src="uploaded_img/<?php echo ($fetch_products['image']);?>" alt="">
         <div>
            <h2><?php echo $fetch_products['name'] ;?></h2>
            <!-- <p>Email :  <?php echo $fetch_products['email']  ;?></p> -->
            <p>
            <?php echo $fetch_products['about']  ;?>
            </p>
         </div>   
      </div>
      
      <div class="cafe-books">
         
      <h3>Books Available</h3>
      <style>
         .book-img{
            height: 150px;
            width: 100px;
            margin-top: 15px;
         }
         .ul-display{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            flex-direction:row;
            margin-bottom: 15px;
         }
         .h3{
            margin-left:50px;
         }
         .ul{
            margin-left:100px;
         }
         .button{
            width: 50px;
            height: 18px;
            margin: 0 18px;
            cursor: pointer;
         }
      </style>
         <ul class="ul-display">
         <?php  
         $select_books = mysqli_query($conn, "SELECT * FROM `products` WHERE cafe='$name'") or die('query failed');
         if(mysqli_num_rows($select_books) > 0){
            while($fetch_books = mysqli_fetch_assoc($select_books)  ){
            if( $fetch_books['price'] > 0)       
      ?><!-- Example split danger button -->
     <div class="dropdown">
  <a class="btn btn-secondary  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Books
  </a>

  <ul class="dropdown-menu">
  <li>
               <div>
               <img class="book-img" src="uploaded_img/<?php echo $fetch_books['image']; ?>" alt=""><br>
               <?php echo $fetch_books['name']; ?><br>
               <button class="btn">Add to Cart</button>
               </div>
            </li>
            </ul>
            </div>
            <?php
  

            
         }
      }else{
         echo '<p class="empty">No Books available!</p>';
      }
      ?>    
         </ul>
      </div>
   </li>
      <?php
         }
      }else{
         echo '<p class="empty">No Cafes available!</p>';
      }
      ?>
</ul>

   </div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
