<?php

require 'include/connect.php';
session_start();

?>

<?php include 'include/header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p><a href="index.php">home</a> <span> / about</span></p>
</div>

<section class="about">

   <div class="row">

      <div class="image">

         <img src="images/about-img.svg" alt="aaa">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>The Awafi restaurant offers high quality food & beverage compliant food standards for our customers and we have easy and safe delivery service in simple and fast payment</p>

        </div>

   </div>

</section>

<?php include 'include/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>
