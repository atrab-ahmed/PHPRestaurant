<?php

require ("include/connect.php");

session_start();

if(isset($_SESSION['user_info'])&&$_SESSION['user_info']['per_id']==2){
$user_id = $_SESSION['user_info']['id'];
}else{
$user_id = '';
   header('location:login.php');
};

if(isset($_POST['submit'])){
   $cart_id = $_POST['cart_id'];
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];
   if($total_price!=0){
         $query="INSERT INTO orders(total_price, total_products,cart_id,acceptance) VALUES(?,?,?,?)";
         $insert_order = $db->prepare($query);
         $insert_order->execute(array($total_price,$total_products, $cart_id,2));

         $delete_cart = $db->prepare("DELETE FROM cart_products WHERE cart_id = ?");
         $delete_cart->execute(array($cart_id));
          echo  "<script> alert('order placed successfully!');
                   window.open('orders.php','_self');
                               </script>";
        // $message[] = 'order placed successfully!';
      }
  else
   {
      $message[] = 'your cart is empty';
   }
}

?>

<?php include 'include/header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p><a href="index.php">home</a> <span> / checkout</span></p>
</div>

<section class="checkout">
   <h1 class="title">order summary</h1>
<form method="post">
   <div class="cart-items">

      <h3>cart items</h3>
      <?php
         $grand_total = 0;
         $cart_items[] = '';

         $query="SELECT * FROM cart WHERE user_id=?";
         $user_cart = $db->prepare($query);
         $user_cart->execute(array($user_id));
         if($user_cart->rowCount() ==1){
          $fetch_user_cart['cart']=$user_cart->fetch();
          $cart_id=$fetch_user_cart['cart']['id'];?>
          <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">

          <?php
           }

           $query="SELECT * FROM cart_products WHERE cart_id=?";
           $select_cart = $db->prepare($query);
           $select_cart->execute(array($cart_id));
           if($select_cart->rowCount() > 0){
             foreach($select_cart->fetchAll() as $fetch_cart) {

               $prod=$fetch_cart['pro_id'];
              $query="SELECT * FROM products WHERE id=?";
              $select_products = $db->prepare($query);
              $select_products->execute(array($prod));
              if($select_products->rowCount()>0){
                foreach($select_products->fetchAll() as $fetch_products) {

               $cart_items[] = $fetch_products['name']. ' (' .$fetch_products['price']. ' x ' . $fetch_cart['quantity'] .') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_products['price'] * $fetch_cart['quantity']);
      ?>
      <p><span class="name"><?php echo $fetch_products['name']; ?></span><span class="price">$<?php echo $fetch_products['price']; ?> x <?php echo $fetch_cart['quantity']; ?></span></p>
      <?php
    }}}
         }else{
            echo '<p class="empty">your cart is empty!</p>';
         }
      ?>

      <p class="grand-total"><span class="name">grand total :</span><span class="price">$<?php echo $grand_total; ?></span></p>
      <a href="cart.php" class="btn">veiw cart</a>
   </div>

   <input type="hidden" name="total_products" value="<?php echo $total_products; ?>">
   <input type="hidden" name="total_price" value="<?php echo $grand_total; ?>" value="">

    <input type="submit" value="place order" class="btn" name="submit" style="width:100%; background:var(--red); color:var(--white);">
   </div>

</form>

</section>


<?php include 'include/footer.php'; ?>

<script src="js/script.js"></script>
