<?php

    require 'include/connect.php';
    include 'include/validation.php';

session_start();


if(isset($_POST['sgin_in'])){
   $name = trim($_POST['name']);
   $email =trim($_POST['email']);
   $phone = trim($_POST['phone']);
   $address = trim($_POST['address']);
   $birth_date =$_POST['birth_date'];
   $password = trim($_POST['password']);
   $repassword = trim($_POST['repassword']);
   $gender = $_POST['gender'];
   $photo=$_FILES['file'];
   $photo_name=$photo['name'];
   $photo_tmp=$photo['tmp_name'];
   $photo_size= $photo['size'];
   $photo_error= $photo['error'];

  #validatio
   string_valid($name);
   phone_valid($phone);
   email_valid($email);
   address_valid($address);
   password_valid($password);
   repassword_valid($password,$repassword);
   image_valid($photo_name);
   birth_valid($birth_date);



   $query="SELECT * FROM user WHERE email=:email OR phone=:phone";
   $select_user = $db->prepare($query);
   $select_user->execute(array("email"=>$email,"phone"=>$phone));
   $select_user->fetchAll();

   if($select_user->rowCount() > 0){
      $message[] = 'email or number already exists!';
       }

      else if(empty($errors))
      {
        if ($photo_name==Null) {
         $photo_name='4.jpg';
        }
         move_uploaded_file($photo_tmp,"admin/upload/".$photo_name);
         $query="INSERT INTO user(name, phone, email, address, birth_date, password,image,gender) VALUES (?,?,?,?,?,?,?,?)";
         $insert_user = $db->prepare($query);
         $insert_user->execute(array($name, $phone, $email,$address,$birth_date, password_hash($password ,PASSWORD_DEFAULT),$photo_name,$gender));

         $query="SELECT * FROM user WHERE email=:email";
         $select_user=$db->prepare($query);
         $select_user->execute(array("email"=>$email));
         if($select_user->rowCount()==1){
           $_SESSION['user_info'] = $select_user->fetch();
           $query="INSERT INTO cart (user_id) VALUES (?)";
           $new_cart = $db->prepare($query);
           $new_cart->execute(array($_SESSION['user_info']['id']));
            header('location:index.php');
             }
            }


}
?>


<?php include 'include/header.php';?>

  <form class="foo" method="post" enctype="multipart/form-data" id="form">
     <div class="upload">
       <img src="admin/upload/4.jpg" alt="user" class="imagee">
     <div class="round">
       <input type="file" id="inpUpload" name="file" value="" class="ca">
       <i class="fa fa-camera" style=" font-size:16px; color:#fff;"></i>
                     <?php if (isset($errors['image_valid'])) {
                       echo $errors['image_valid'];
                     }
                        ?>
    </div>
    </div>

       <input class="loo" type="text" name="name" placeholder="Enter your Name" >
                       <?php if (isset($errors['string_valid'])) {
                         echo $errors['string_valid'];
                       }
                          ?>
       <input class="loo num" type="text" name="phone" placeholder="Enter your number" >
                       <?php if (isset($errors['phone_valid'])) {
                         echo $errors['phone_valid'];
                       }
                        ?>
       <input class="loo em" type="text" name="email" placeholder="Enter your email" >
                       <?php if (isset($errors['email_valid'])) {
                         echo $errors['email_valid'];
                       }
                        ?>
        <input class="loo ad" type="text" name="address" placeholder="Enter your address">
                      <?php if (isset($errors['address_valid'])) {
                        echo $errors['address_valid'];
                      }
                       ?>
       <input class="loo brith" type="text" name="birth_date" placeholder="Enter your brithday" onfocus="this.type='date'">
                     <?php if (isset($errors['birth_valid'])) {
                       echo $errors['birth_valid'];
                     }
                      ?>
       <input class="loo pass" type="password" name="password" placeholder="Enter the password" >
                     <?php if (isset($errors['password_valid'])) {
                       echo $errors['password_valid'];
                     }
                      ?>
       <input class="loo repass" type="password" name="repassword" placeholder="Confirm the password">
                     <?php if (isset($errors['repassword_valid'])) {
                       echo $errors['repassword_valid'];
                     }
                      ?>

        <div class="gender">
       <label for="gender">Gender: </label>
       <input type="radio" name="gender"  value="Male" checked>
        <span >Male</span>
       <input type="radio" name="gender" value="Famale">
       <span >Famale</span>
        </div>
       <input class="logg" type="submit" name="sgin_in" value="sgin in">
       <a href="login.php"><p class="accoun">Already have an account?</p></a>
    </form>

    <?php //include 'include/footer.php'; ?>







  <script src="js/script.js">


  </script>

    </body>
    </html>
