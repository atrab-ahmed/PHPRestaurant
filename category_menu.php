<?php

require 'include/connect.php';

 session_start();

if(isset($_SESSION['user_info'])&&$_SESSION['user_info']['per_id']==2){
   $user_id = $_SESSION['user_info']['id'];
}else{
   $user_id = '';
};

include 'include/add_cart.php';

?>

<?php include 'include/header.php'; ?>
<div class="heading">
   <h3>Our Menu</h3>
   <p><a href="index.php">home</a> <span> <span> / menu</span></p>
</div>
<section class="products">
   <h1 class="title">food menu</h1>
   <div class="box-container">

      <?php
      if(isset($_GET['scat_id'])){
         $scat_id = $_GET['scat_id'];
         $query="SELECT * FROM products WHERE scat_id = ?";
         $select_products = $db->prepare($query);
         $select_products->execute(array($scat_id));
         if($select_products->rowCount() > 0){
           foreach($select_products->fetchAll() as $fetch_products) {
      ?>
      <form method="post" class="box" enctype="multipart/form-data">
         <input type="hidden" name="pro_id" value="<?php echo $fetch_products['id']; ?>">
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>

         <img src="admin/upload/<?php echo $fetch_products['photo']; ?>" alt="">
         <div class="name"> <h4><?php echo $fetch_products['name']; ?></h4></div>
         <div class="description" ><?php echo $fetch_products['description']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?php echo $fetch_products['price']; ?></div>
            <input type="number" name="quantity" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }}
      ?>

   </div>

</section>


<?php include 'include/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
