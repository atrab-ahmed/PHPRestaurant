<?php
require 'include/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Awafi</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/stylee.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){?>
      <div class="message">
         <span><?php echo $message?></span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>

<?php }
         }
if(isset($_SESSION['user_info']['id'])&&$_SESSION['user_info']['per_id']==2){
  $user_id = $_SESSION['user_info']['id'];
}
else{

  $user_id = '';
}

$query="SELECT * FROM cart WHERE user_id=?";
$user_cart = $db->prepare($query);
$user_cart->execute(array($user_id));
if($user_cart->rowCount() ==1){
 $fetch_user_cart['cart']=$user_cart->fetch();
 $cart_id=$fetch_user_cart['cart']['id'];
  }
 ?>

<header class="header">

   <section class="flex">

      <a href="index.php" class="logo">Awafi</a>

      <nav class="navbar">
         <a href="index.php">Home</a>
         <a href="about.php">About</a>
         <a href="category.php">Catogries</a>
         <a href="menu.php">Menu</a>
         <a href="orders.php">Orders</a>
      </nav>

      <div class="icons">
         <!-- <?php
           $query="SELECT * FROM cart WHERE user_id=?";
           $user_cart = $db->prepare($query);
           $user_cart->execute(array($user_id));
           if($user_cart->rowCount() ==1){
            $fetch_user_cart['cart']=$user_cart->fetch();
            $cart_id=$fetch_user_cart['cart']['id'];
             }
            $count_cart_items = $db->prepare("SELECT * FROM cart_products WHERE cart_id = ?");
            $count_cart_items->execute(array($cart_id));
            $total_cart_items = $count_cart_items->rowCount();
         ?> -->

         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $db->prepare("SELECT * FROM user WHERE id = ?");
            $select_profile->execute(array($user_id));
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?php echo "Welcome ". $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn">profile</a>
            <a href="logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         </div>

         <?php
            }else{
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>
