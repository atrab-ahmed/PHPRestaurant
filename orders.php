<?php

require 'include/connect.php';

session_start();

if(isset($_SESSION['user_info'])&&$_SESSION['user_info']['per_id']==2){
   $user_id = $_SESSION['user_info']['id'];
}else{
   $user_id = '';
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/stylee.css">

</head>
<body>

<?php include 'include/header.php'; ?>

<div class="heading">
   <h3>orders</h3>
   <p><a href="index.php">home</a> <span> / orders</span></p>
</div>

<section class="orders">

   <h1 class="title">your orders</h1>

   <div class="box-container">

   <?php
     if ($user_id) {
       $query="SELECT * FROM cart WHERE user_id=?";
       $user_cart = $db->prepare($query);
       $user_cart->execute(array($user_id));
       if($user_cart->rowCount() ==1){
        $fetch_user_cart['cart']=$user_cart->fetch();
        $cart_id=$fetch_user_cart['cart']['id'];
         }

         $query="SELECT * FROM orders WHERE cart_id = ?";
         $select_orders = $db->prepare($query);
         $select_orders->execute(array($cart_id));
         if($select_orders->rowCount() > 0){
           foreach($select_orders->fetchAll() as $fetch_orders) {
   ?>
   <div class="box">
      <p>Date : <span><?php echo $fetch_orders['_date']; ?></span></p>
      <p>your orders : <span><?php echo $fetch_orders['total_products']; ?></span></p>
      <p>total price : <span>$<?php echo $fetch_orders['total_price']; ?></span></p>
      <p>status : <?php switch ( $fetch_orders['acceptance']) {
          case 1:
                  echo "accept";
              break;
              case 0:
                      echo "reject";
                  break;
          default:
              echo "pending";
              break;
      }?></p>

   </div>
   <?php
      }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      }
   ?>

   </div>

</section>



<?php include 'include/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
