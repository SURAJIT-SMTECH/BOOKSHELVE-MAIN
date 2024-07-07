<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <p> Hello,<span id="name"><?php echo $_SESSION['user_name']; ?></span> |  <a href="index.php">logout</a> </p>
      </div>
   </div>
<style>
   .p1{
      height: 100px;
      width: 150px;
   }
   </style>
   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo"><img class="p1" src="images/logo(white).png" alt="The Book Shelves"></a>

         <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">AboutUs</a>
            <a href="contact.php">ContactUs</a>
            <a href="orders.php">Subscription</a>
            <a href="cafe's.php">Cafe</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
      </div>
   </div>
   <script>
      /* const name=document.cookie.split('=')[2]
      var n=name.split('%20')
      console.log(n)
      var w=""
      for (let i = 0; i < n.length; i++) {
         w=w+n[i]+" "
      }
      console.log(document.cookie.split('=')[1])
      document.getElementById('name').innerText=w */
   </script>

</header>