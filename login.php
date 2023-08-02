
<?php
      require ("include/connect.php");
session_start();


if(isset($_POST['login']))
   {
   $email =trim($_POST['email']);
   $password=trim($_POST['password']);

   if (empty($email)){
   $errors['email_valid']="<div style='color:red'>You must enter email</div>" ;
   }
   if (empty($password)){
   $errors['password_valid']="<div style='color:red'>You must enter password</div>" ;
   }

   $query="SELECT * FROM user WHERE email=:email";
   $select_user=$db->prepare($query);
   $select_user->execute(array("email"=>$email));
   if($select_user->rowCount()==1){
     $data = $select_user->fetch(PDO::FETCH_ASSOC );
     $info['info']=$data;
     if(password_verify($password,$info['info']['password'])) {
      $_SESSION['user_info'] = $data;
        if($_SESSION['user_info']['status']== 1) {
           if($_SESSION['user_info']['per_id']==1) {
              header('location:admin/index.php');
             }
           else {
              header('location:menu.php');
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

<?php include 'include/header.php';?>

<section class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="text" name="email" placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                            <?php if (isset($errors['email_valid']))
                                  echo $errors['email_valid'] ?>
      <input type="password" name="password" placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                          <?php if (isset($errors['password_valid']))
                                 echo $errors['password_valid'] ?>
      <input type="submit" value="Login" name="login" class="btn">
      <p> <a href="acccount.php">Don't have an account?</a></p>
   </form>

</section>



 <?php include("include/footer.php")?>
<script src="js/script.js"></script>
