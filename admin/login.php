<?php
      require ("include/connect.php");
      include 'include/validation.php';


session_start();

if(isset($_SESSION['user_info'])&&$_SESSION['user_info']['per_id']==1){
   $admin_id = $_SESSION['user_info']['id'];
}else{
   $admin_id = '';

};

if(isset($_POST['login']))
   {
   $email =trim($_POST['email']);
   $password =trim($_POST['password']);
   email_valid($email);
   password_valid($password);


   $query="SELECT * FROM user WHERE email=:email";
   $select_user=$db->prepare($query);
   $select_user->execute(array("email"=>$email));
   if($select_user->rowCount()==1){
     $data = $select_user->fetch(PDO::FETCH_ASSOC );
     $info['info']=$data;
     if(password_verify($password,$info['info']['password'])) {
       echo "string";
      $_SESSION['user_info'] = $data;
      if($_SESSION['user_info']['status']== 1) {
         if($_SESSION['user_info']['per_id']==1) {
            header('location:index.php');
           }
         else {
            header('location:../index.php');
           }
      }
      else{
     $message[]='inactive account!';
      }
    }
else{
   $message[]='incorrect email or password!';
 }}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>


      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

      <link rel="stylesheet" href="../css/stylee.css">
</head>
<body>

<!-- <?php include 'include/header.php';?> -->

    <div class="bo">
    <form class="fo" method="post" style="margin-top: 120px;">
    <h3 class="tit">Login now</h3><hr>
       <input class="lo text" type="text" name="email" placeholder="Enter your email" required>
       <!-- <?php if (isset($errors['email_valid'])) echo $errors['email_valid'] ?> -->

       <input class="lo" type="password" name="password" placeholder="Enter your password" required >
       <!-- <?php if (isset($errors['password_valid'])) echo $errors['password_valid'] ?> -->

       <input class="log" type="submit" name="login" value="login">
       <!-- <a href="acccount.php"><p class="account">Don't have an account?</p></a> -->
    </form>
</div>
 <?php //include("include/footer.php")?>
<script src="js/script.js"></script>
