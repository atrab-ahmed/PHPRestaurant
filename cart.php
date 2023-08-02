<?php

require 'include/connect.php';

 session_start();

if(isset($_SESSION['user_info'])&&$_SESSION['user_info']['per_id']==2){
   $user_id = $_SESSION['user_info']['id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['delete'])){
   $cart_products_id = $_POST['cart_products_id'];
   $query="DELETE FROM cart_products WHERE id = ?";
   $delete_cart_item = $db->prepare($query);
   $delete_cart_item->execute(array($cart_products_id));
   if($delete_cart_item->rowCount()==1){
   $message[] = 'cart item deleted!'; }
}


if(isset($_POST['update_qty'])){
   $cart_products_id = $_POST['cart_products_id'];
   $qty = $_POST['qty'];
   $query="UPDATE cart_products SET quantity=? WHERE id=?";
   $update_qty = $db->prepare($query);
   $update_qty->execute(array($qty, $cart_products_id));
   if( $update_qty->rowCount()==1){
   $message[] = 'cart quantity updated';}
}

$grand_total = 0;

?>

<?php  include 'include/header.php';?>

<div class="heading">
   <h3>shopping cart</h3>
   <p><a href="index.php">home</a> <span> / cart</span></p>
</div>

<section class="products">

   <h1 class="title">your cart</h1>

   <div class="box-container">

      <?php
         $grand_total = 0;

         $query="SELECT * FROM cart WHERE user_id=?";
         $user_cart = $db->prepare($query);
         $user_cart->execute(array($user_id));
         if($user_cart->rowCount() ==1){
          $fetch_user_cart['cart']=$user_cart->fetch();
          $cart_id=$fetch_user_cart['cart']['id'];
           }

         $query="SELECT * FROM cart_products WHERE cart_id=?";
         $select_cart = $db->prepare($query);
         $select_cart->execute(array($cart_id));
         if($select_cart->rowCount() > 0){
           foreach($select_cart->fetchAll() as $fetch_cart) {
      ?>
      <form method="post" class="box">
         <input type="hidden" name="cart_products_id" value="<?php echo $fetch_cart['id']; ?>">
         <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('delete this item?');"></button>

       <?php
        $prod=$fetch_cart['pro_id'];
        $query="SELECT * FROM products WHERE id=?";
       $select_products = $db->prepare($query);
       $select_products->execute(array($prod));
       if($select_products->rowCount()>0){
         foreach($select_products->fetchAll() as $fetch_products) {
        ?>
         <img src="admin/upload/<?php echo $fetch_products['photo']; ?>" alt="">
         <div class="name"> <h4><?php echo $fetch_products['name']; ?></h4></div>
         <div class="description" ><?php echo $fetch_products['description']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?php echo $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="<?php echo $fetch_cart['quantity']; ?>" maxlength="2">
            <button type="submit" class="fas fa-edit" name="update_qty"></button>
         </div>
         <div class="sub-total"> sub total : <span>$<?php echo $sub_total = ($fetch_products['price'] * $fetch_cart['quantity']); ?></span> </div>
      </form>
      <?php
               $grand_total += $sub_total;
            }}}
         }else{
            echo '<p class="empty">your cart is empty</p>';
         }
      ?>

   </div>



   <div class="cart-total">
      <p>cart total : <span>$<?php echo $grand_total; ?></span></p>
      <a href="check.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>

   </div>
   <div class="more-btn">

      <a href="menu.php" class="btn">continue shopping</a>
   </div>

</section>


<?php include 'include/footer.php'; ?>

<script src="js/script.js"></script>
