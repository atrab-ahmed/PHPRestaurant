<?php
include('header.php');
include 'include/validation.php';
require('../include/connect.php');
session_start();

if(isset($_SESSION['user_info'])&&$_SESSION['user_info']['per_id']==1){
   $admin_id = $_SESSION['user_info']['id'];
}else{
   header('location:login.php');
};
?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-users"></i> Users</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> Add New User
                    </div>
                    <?php if(isset($_POST['addUser']))
                        {
                           $name =trim($_POST['name']);
                           $phone =trim($_POST['phone']);
                           $email =trim($_POST['email']);
                           $gender =trim($_POST['gender']);
                           $birth_date =$_POST['birth_date'];
                           $address =trim($_POST['address']);
                           $password =trim($_POST['password']);
                           $conpassword=trim($_POST['conpassword']);
                           $status =trim($_POST['status']);
                          $image= $_FILES['file'];
                           $per_id =$_POST['per_id'];
                           $image_name= $image['name'];
                           $image_type= $image['type'];
                           $image_tmp= $image['tmp_name'];
                           $errors=array();
                           $extensions=array('jpg','gif','png');
                           $file_explode=explode('.',$image_name);
                           $file_extension=strtolower(end($file_explode));
                           image_valid($image_name);
                            string_valid($name);
                            phone_valid($phone);
                            email_valid($email);
                            address_valid($address);
                            password_valid($password);
                            repassword_valid($password,$conpassword);
                            birth_valid($birth_date);

                            if(empty($errors)){
                              if ($image_name==Null) {
                               $image_name='4.jpg';
                              }
                                move_uploaded_file($image_tmp, "upload/".$image_name);
                                    $sql="INSERT INTO user (name,phone,email,address,birth_date,password,image,per_id,gender,status) VALUES (?,?,?,?,?,?,?,?,?,?)";
                                    $stm = $db->prepare($sql);
                                    $stm->execute(array($name,$phone,$email,$address, $birth_date,password_hash($password ,PASSWORD_DEFAULT),$image_name,$per_id ,$gender, $status));
                                    if ($stm->rowCount()>0) {
                                      $query="SELECT * FROM user WHERE email=:email";
                                      $select_user=$db->prepare($query);
                                      $select_user->execute(array("email"=>$email));
                                      if($select_user->rowCount()==1){
                                        $data = $select_user->fetch(PDO::FETCH_ASSOC );
                                        $info['info']=$data;
                                        $query="INSERT INTO cart (user_id) VALUES (?)";
                                        $new_cart = $db->prepare($query);
                                        $new_cart->execute(array($info['info']['id']));}
                                        echo "<div class='alert alert-success'>Row Inserted</div>" ;
                                    } else {
                                        echo "<div class='alert alert-danger'>Row Not Inserted</div>" ;
                                    }

                                
                            }
                        }
                        ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" placeholder="Please Enter your Name "
                                         name="name" class="form-control" />
                                         <?php if (isset($errors['string_valid'])) echo $errors['string_valid'] ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" placeholder="Please Enter your phone number "
                                         name="phone" class="form-control" />
                                         <?php if (isset($errors['phone_valid'])) echo $errors['phone_valid'] ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control"
                                        name="email" placeholder="PLease Enter your Eamil" />
                                        <?php if (isset($errors['email_valid'])) echo $errors['email_valid'] ?>
                                    </div>

                                    <div class="gender">
                                    <label for="gender">Gender: </label>
                                    <input type="radio" name="gender" value="Famale" >
                                    <span >Famale</span>
                                    <input type="radio" name="gender" value="Male" checked>
                                    <span >Male</span>
                                     </div>

                                    <div class="form-group">
                                        <label>address</label>
                                        <input type="text" class="form-control"
                                        name="address" placeholder="PLease Enter your address" />
                                        <?php if (isset($errors['address_valid'])) echo $errors['address_valid'] ?>
                                    </div>

                                    <div class="form-group">
                                        <label>images</label>
                                        <input type="file" class="form-control" name="file">
                                        <?php if (isset($errors['image_valid'])) echo $errors['image_valid'] ?>

                                    </div>

                                    <div class="form-group">
                                        <label>Birthdate</label>
                                        <input type="date" class="form-control"
                                        name="birth_date" placeholder="PLease Enter your Birthdate" />
                                        <?php if (isset($errors['birth_valid'])) echo $errors['birth_valid'] ?>

                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control"
                                         name="password" placeholder="Please Enter password">
                                         <?php if (isset($errors['password_valid'])) echo $errors['password_valid'] ?>

                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password"  name="conpassword" class="form-control"
                                            placeholder="Please Enter confirm password">
                                            <?php if (isset($errors['repassword_valid'])) echo $errors['repassword_valid'] ?>

                                    </div>

                                    <div class="form-group">
                                        <label>User Type</label>
                                        <select class="form-control" name="per_id">
                                          <?php
                                      $sql="select * from permission" ;
                                      $stm = $db->prepare($sql);
                                      $stm->execute();
                                      foreach ($stm->fetchAll() as $row) {
                                          ?>
                                          <option value=<?php echo $row['id'] ?>>
                                            <?php echo  $row['name'] ?></option>
                                          <?php
                                      } ?>
                                      </select>
                                    </div>

                                    <div class="status">
                                    <label for="status">Status: </label>
                                    <input type="radio" name="status" value="1" >
                                    <span >Active</span>
                                    <input type="radio" name="status" value="0" checked>
                                    <span >Inactive</span>
                                     </div>
                                    <div style="float:right;">
                                        <button type="submit" class="btn btn-primary" name="addUser">Add User</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                            </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
        <hr />

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> Users
                    </div>

                    <?php
                    if (isset($_GET['action'], $_GET['id'])) {

                        $id = $_GET['id'];
                        switch ($_GET['action']) {
                            case "delete":
                                $stm = $db->prepare("delete from user where id=:userid");
                                $stm->execute(array("userid"=>$id));
                                if($stm->rowCount()==1)
                                {
                                    echo "<div class='alert alert-success'> One Row Deleted</div>";
                                }
                                break;
                                case "active":
                                    $stm = $db->prepare("UPDATE user set status=? where id=?");
                                    $stm->execute(array(1,$id));
                                    if($stm->rowCount()==1)
                                    {
                                        echo "<div class='alert alert-success'> One Row updated</div>";
                                    }
                                    break;
                                    case "unactive":
                                        $stm = $db->prepare("UPDATE user set status=? where id=?");
                                        $stm->execute(array(0,$id));
                                        if($stm->rowCount()==1)
                                        {
                                            echo "<div class='alert alert-success'> One Row updated</div>";
                                        }
                                        break;

                            default:
                                echo "ERROR";
                                break;
                        }
                    }
                    ?>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                       <th>Id</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>gender</th>
                                        <th>Address</th>
                                        <th>Image</th>
                                        <th>Birthdate</th>
                                        <!-- <th>Password</th> -->
                                        <th>Role</th>
                                        <th>action</th>

                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                    <!-- $id= $row['id']; -->
                                      <?php
                                      $stm = $db->prepare("select * from user");
                                          $stm->execute();
                                          if($stm->rowCount())
                                          {
                                              foreach ($stm->fetchAll() as $row) {
                                                $id=$row['id'];
                                                $name=$row['name'];
                                                // $gender=$row['gender'];
                                                // $phone=$row['phone'];
                                                // $email=$row['email'];
                                                // $address=$row['address'];
                                                // $image=$row['file'];
                                                // $Birthdate=$row['Birthdate'];
                                                //  $password=$row['password'];
                                                // $confirmpassword=$row['conpasswrd'];
                                                // $pre_id=$row['pre_id'];

                                                  ?>
                                      <tr class="odd gradeX">
                                        <td><?php echo $row['id'];  ?></td>
                                          <td><?php echo $row['name'];  ?></td>
                                            <td><?php echo $row['phone'];  ?></td>
                                          <td><?php echo   $row['email']; ?></td>
                                          <td><?php echo $row['gender'];  ?></td>
                                          <td><?php echo   $row['address']; ?></td>
                                          <td><img src="upload/<?php echo $row['image'] ?> " alt="not found" width="60px"></td>
                                          <td><?php echo  $row['birth_date']; ?></td>
                                          <!-- <td><?php echo   $row['password']; ?></td> -->
                                          <td><?php
                                              $sql="select * from permission where id=:per_id" ;
                                              $stm = $db->prepare($sql);
                                              $stm->execute(array("per_id"=>$row['per_id']));
                                              if ($stm->rowCount()>0)
                                              foreach ($stm->fetchAll() as $perRow)
                                                 echo $perRow['name'];

                                              ?>
                                          </td>
                                          <td>
                                              <a href="edituser.php?action=edit&id=<?php echo $id ?>"
                                                  class='btn btn-success'>Edit</a>
                                              <a href="?action=delete&id=<?php echo $id ?>" class='btn btn-danger'
                                              onclick= "return confirm('Are You Sure !!')">Delete</a>


                                          </td>

                                          <td><?php if($row['status'] == 0) { ?>
                                          <a href="?action=active&id=<?php echo $id ?>"
                                                  class='btn btn-success'>Active</a>
                                            <?php } else { ?>
                                                <a href="?action=unactive&id=<?php echo $id ?>"
                                                  class='btn btn-danger'>unActive</a>
                                                <?php } ?>
                                        </td>

                                      </tr>
                                      <?php
                                            }}    ?>


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->

            </div>
            <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
</div>

<?php
include('footer.php');
?>
