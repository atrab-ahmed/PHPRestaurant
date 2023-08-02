<?php

  require 'include/connect.php';
  include 'include/validation.php';
session_start();

if(isset($_GET['action'],$_GET['id']) && $_GET['action']=='update_profile'){
   $id = $_GET['id'];
   $query="SELECT * FROM user WHERE id=:id ";
   $up_user = $db->prepare($query);
   $up_user->execute(array("id"=>$id));

   if($up_user->rowCount()==1){
     foreach ($up_user->fetchAll() as $row) {
       $name = $row['name'];
       $email = $row['email'];
       $phone = $row['phone'];
       $address = $row['address'];
       $birth_date = $row['birth_date'];
       $password = $row['password'];
       $gender = $row['gender'];
       $photos=$row['image'];


       if(isset($_POST['update_now'])){
          $name = $_POST['name'];
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $address = $_POST['address'];
          $birth_date = $_POST['birth_date'];
          $oldpassword = $_POST['oldpassword'];
          $newpassword = $_POST['newpassword'];
          $repassword = $_POST['repassword'];
          $gender = $_POST['gender'];
          $photo=$_FILES['file'];
          $photo_name=$photo['name'];
          $photo_tmp=$photo['tmp_name'];

          #validatio
           string_valid($name);
           phone_valid($phone);
           email_valid($email);
           address_valid($address);
           password_valid($password);
           repassword_valid($newpassword,$repassword);
           image_valid($photo,$photo_name);
           birth_valid($birth_date);

          $errors = array();

       if(!empty($oldpassword)){
           if(password_verify($newpassword,$oldpassword)){
         $message[] = 'old password not matched!';
      }else{
         if(empty($errors)){
           if ($photo_name==Null) {
            $photo_name=$photos;
           }
            move_uploaded_file($photo_tmp,"admin/upload/".$photo_name);
            $update_user= $db->prepare("UPDATE user SET name=?,phone=?,email=?,
                              address=?,birth_date=?,password=?,image=?,gender=? WHERE id=?");
            $update_user->execute(array($name, $phone, $email,$address,$birth_date,password_hash($newpassword,PASSWORD_DEFAULT),$photo_name,$gender,$id));
              echo "<script> alert('updated successfully!');
                        window.open('profile.php','_self');
                                    </script>";



}}}}
?>

<?php include 'include/header.php';?>

    <form class="foo" method="post" enctype="multipart/form-data" id="form">
<div class="upload">
       <img src="admin/upload/<?php echo $photos?>" alt="user" class="imagee">
<div class="round">
       <input type="file" id="image" name="file" value="" class="ca">
       <i class="fa fa-camera" style="color:#fff;"></i>
</div>
</div>
       <input class="loo" type="text" name="name" placeholder="Enter your Name" value="<?php echo $name ?>">
                             <?php if (isset($errors['string_valid'])) {
                               echo $errors['string_valid'];
                             }
                                ?>
       <input class="loo num" type="text" name="phone" placeholder="Enter your number" value="<?php echo $phone?>">
                             <?php if (isset($errors['phone_valid'])) {
                               echo $errors['phone_valid'];
                             }
                              ?>
       <input class="loo em" type="text" name="email" placeholder="Enter your email" value="<?php echo $email ?>">
                             <?php if (isset($errors['email_valid'])) {
                               echo $errors['email_valid'];
                             }
                              ?>
        <input class="loo ad" type="text" name="address" placeholder="Enter your address" value="<?php echo $address ?>">
                              <?php if (isset($errors['address_valid'])) {
                                echo $errors['address_valid'];
                              }
                               ?>
       <input class="loo brith" type="text" name="birth_date" placeholder="Enter your brithday" onfocus="this.type='date'" value="<?php echo $birth_date ?>">
                             <?php if (isset($errors['birth_valid'])) {
                               echo $errors['birth_valid'];
                             }
                              ?>
       <input class="loo pass" type="password" name="oldpassword" placeholder="Enter old password" >

       <input class="loo newpass" type="password" name="newpassword" placeholder="Enter new password" >
                       <?php if (isset($errors['password_valid'])) {
                         echo $errors['password_valid'];
                       }
                        ?>
       <input class="loo newrepass" type="password" name="repassword" placeholder="Confirm new password">
                       <?php if (isset($errors['repassword_valid'])) {
                         echo $errors['repassword_valid'];
                       }
                        ?>
        <div class="gender newgender">
       <label for="gender">Gender: </label>
       <input type="radio" name="gender" value="Male"
                           <?php if($gender=="Male") echo 'checked'   ?> >
       <span >Male</span>
       <input type="radio" name="gender" value="Famale" <?php if($gender=="Famale") echo 'checked'   ?>>
       <span >Famale</span>
        </div>
       <input class="logg uplogg" type="submit" name="update_now" value="Update Now">
    </form>
  <?php }}} ?>
    <?php //include 'include/footer.php'; ?>

  <script src="js/script.js">
   document.getElementById("image").onchange=function(){
    document.getElementById("form").submit();
}

  </script>

    </body>
    </html>
