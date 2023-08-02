<?php

require ("include/connect.php");

session_start();

// if(isset($_SESSION['user_info'])&&['user_info']['per_id']==2){
// $user_id = $_SESSION['user_info']['id'];
// }else{
// $user_id = '';
// }

include 'include/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/stylee.css">

</head>
<body>

<?php include 'include/header.php';?>



<section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content" >
               <span>order online</span>
               <h3>delicious food</h3>
               <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
                <img src="images/163571661.jpg" alt="">
            </div>
         </div>


      <div class="swiper-pagination"></div>

   </div>

</section>


<?php include 'include/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>


<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>
