<?php
if(isset($_POST['add_to_cart'])){

   if($user_id == ''){
      header('location:login.php');
   }
    else
   {
      $pro_id = $_POST['pro_id'];
      $quantity = $_POST['quantity'];

        //fetch cart_id
      $query="SELECT * FROM cart WHERE user_id=?";
      $user_cart = $db->prepare($query);
      $user_cart->execute(array($user_id));
      if($user_cart->rowCount() ==1){
       $fetch_user_cart['cart']=$user_cart->fetch();
       $cart_id=$fetch_user_cart['cart']['id'];
        }
        //check if exists or not
      $query="SELECT * FROM cart_products WHERE pro_id=? AND cart_id=?";
      $check_cart_products= $db->prepare($query);
      $check_cart_products->execute(array($pro_id,$cart_id));
      if($check_cart_products->rowCount() > 0){
         $message[] = 'already added to cart!';
         }
      else
        {

         $query="INSERT INTO cart_products (pro_id, quantity,cart_id) VALUES (?,?,?)";
         $insert_cart = $db->prepare($query);
         $insert_cart->execute(array($pro_id,$quantity,$cart_id));
         $message[] = 'added to cart!';

      }
   }
}

?>
