<?php
$errors=array();

function string_valid($name)
  {
     $allow="/^[A-Za-z]{2,}$/";
     $test=preg_match($allow,$name);

     if ($test==0){
      global $errors;
     $errors['string_valid']="<div style='color:red; class='str_valid foo' '>You must enter string name<div>" ;
     }
  }

  function phone_valid($phone)
    {
       $allow="/^[7]{1}+[\d]{8}$/";
       $test=preg_match($allow,$phone);

       if ($test==0){
        global $errors;
       $errors['phone_valid']="<div style='color:red'>You must enter nine numbers start with 7</div>" ;
       }
    }

    function email_valid($email)
      {
         $allow="/^[a-zA-Z\d._]+@[a-zA-Z\d._]+\.[a-zA-Z]{2,}$/";
         $test=preg_match($allow,$email);

         if ($test==0){
          global $errors;
         $errors['email_valid']="<div style='color:red'>Enter correct email </div>" ;
         }
      }

      function address_valid($address)
        {
         if (empty($address)){
          global $errors;
         $errors['address_valid']="<div style='color:red'>You must enter address</div>" ;
         }
        }

      function password_valid($password)
        {
           $allow_char="@[a-zA-Z]@";
           $allow_num="@[\d]@";
           $test_ch=preg_match($allow_char,$password);
           $test_nu=preg_match($allow_num,$password);

           if ($test_ch==0 || $test_nu==0 || strlen($password)<8){
            global $errors;
           $errors['password_valid']="<div style='color:red'>You must enter password more then 8 and it must be number and string</div>" ;
           }
        }

        function repassword_valid($password,$repassword)
          {
             if ($repassword!=$password){
              global $errors;
             $errors['repassword_valid']="<div style='color:red'>You must enter confirm password=your password</div>" ;
             }
          }
          // function gender_valid($gender)
          //   {
          //    if (empty($gender)){
          //     global $errors;
          //    $errors['gender_valid']="<div style='color:red'>You must enter gender</div>" ;
          //    }
          //   }




          function image_valid($image_name)
            {
             // $extensions=array('jpg','gif','png');
             // $imgs=explode('.',$image_name);
             // $imgs_extension=strtolower(end($imgs));
             // if(!in_array($imgs_extension,$extensions)){
             //  global $errors;
             // $errors['image_valid']="<div style='color:red'>You must enter image</div>" ;
             //   }
             $extensions=array('jpg','gif','png');
             $imgs=explode('.',$image_name);
             $imgs_extension=strtolower(end($imgs));
             if(!(file_exists($image_name)))
             {
               $image_name="4.jpg";
             }
             elseif(!in_array($imgs_extension,$extensions)){
             global $errors;
             $errors['image_valid']="<div style='color:red'>You must enter image</div>" ;
              }
            }

            function birth_valid($birth_date){
               $birth=explode('-',$birth_date);
               $bd=$birth[0];
               if(empty($birth_date)){
                  global $errors;
                  $errors['birth_valid']="<div style='color:red'>You must enter birthdate</div>" ;
               }
               elseif($bd>2015 || $bd<1950){
                  global $errors;
                  $errors['birth_valid']="<div style='color:red'>Invalid birthdate</div>" ;
               }

            }




?>
