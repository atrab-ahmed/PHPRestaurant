<?php
include('header.php');
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
                <h2><i class="fa fa-users"></i>Orders</h2>


            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->
                <!-- <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> Add New User
                    </div>
                    <?php if(isset($_POST['addUser']))
                        {
                           $name =trim($_POST['name']);
                           $date =trim($_POST['_date']);
                           $phone =trim($_POST['phone']);
                           $email =trim($_POST['email']);
                        //    $Birthdate =$_POST['Birthdate'];
                           $address =trim($_POST['address']);
                        //    $password =trim($_POST['password']);
                        //    $conpassword=trim($_POST['conpassword']);
                           $status =trim($_POST['status']);
                        //   $image= $_FILES['file'];
                        $totalprice =$_POST['total_price'];
                        $totalprice =$_POST['total_products'];
                           $usr_id =$_POST['user_id'];
                           $cart_id=$_POST['cart_id'];
                        //    $image_name= $image['name'];
                        //    $image_type= $image['type'];
                        //    $image_tmp= $image['tmp_name'];
                        //    $errors=array();
                        //    $extensions=array('jpg','gif','png');
                        //    $file_explode=explode('.',$image_name);
                        //    $file_extension=strtolower(end($file_explode));
                        //     if(!in_array($file_extension,$extensions))
                        //     {
                        //       $errors['image_error'] = "<div style='color:red'>file extensions is Not Vaild</div>";
                        //     }
                            if(is_numeric($name)){
                                $errors['name'] = "Name Must Be String" ;
                            }
                            if(!(is_numeric($phone))){
                                $errors['phone'] = "phone Must Be number" ;
                            }
                            if(empty($errors)){
                                if (move_uploaded_file($image_tmp, "upload/".$image_name)) {
                                    $sql="INSERT INTO order (name,phone,email,address,birth_date,password,image,per_id,status) VALUES (?,?,?,?,?,?,?,?,?)";
                                    $stm = $db->prepare($sql);
                                    $stm->execute(array($name,$phone,$email,$address, $Birthdate,$password,$image_name,$per_id ,$status));
                                    if ($stm->rowCount()) {
                                        echo "<div class='alert alert-success'>Row Inserted</div>" ;
                                    } else {
                                        echo "<div class='alert alert-danger'>Row Not Inserted</div>" ;
                                    }
                                }
                                else
                                {
                                    echo "<div class='alert alert-danger'>Not upload file</div>";
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
                                        <input type="text" placeholder="Please Enter your Name " name="name" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" placeholder="Please Enter your phone number " name="phone" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="PLease Enter your Eamil" />
                                    </div>

                                    <div class="form-group">
                                        <label>address</label>
                                        <input type="text" class="form-control" name="address" placeholder="PLease Enter your address" />
                                    </div>

                                    <div class="form-group">
                                        <label>images</label>
                                        <input type="file" class="form-control" name="file">
                                    </div>

                                    <div class="form-group">
                                        <label>Birthdate</label>
                                        <input type="date" class="form-control" name="Birthdate" placeholder="PLease Enter your Birthdate" />
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Please Enter password">
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password"  name="conpassword" class="form-control"
                                            placeholder="Please Enter confirm password">
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
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" placeholder="Please Enter user status " name="status" class="form-control" />
                                    </div>
                                    <div style="float:right;">
                                        <button type="submit" class="btn btn-primary" name="addUser">Add User</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                            </div>
                            </form>

                        </div>

                    </div>
                </div> -->
            </div>

        </div>
        <hr />

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i>Orders
                    </div>

                    <?php
                    if (isset($_GET['action'], $_GET['id'])) {

                        $id = $_GET['id'];
                        switch ($_GET['action']) {
                            case "accept":
                                $stm = $db->prepare("UPDATE orders set acceptance=? where id=?");
                                $stm->execute(array(1,$id));
                                if($stm->rowCount()==1)
                                {
                                    echo "<div class='alert alert-success'> One Row updated</div>";
                                }
                                break;
                                case "reject":
                                    $stm = $db->prepare("UPDATE orders set acceptance=? where id=?");
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

                                       <th>Date</th>

                                       <th>Total Price</th>
                                       <th>Total Product</th>
                                       <th>Cart_id</th>
                                        <th>Acceptance</th>
                                        <th>User Id</th>
                                       <th>User Name</th>
                                       <th>User Email</th>
                                       <th>User Number</th>
                                       <th>User Address</th>

                                    </tr>
                                </thead>
                                <tbody>

                                      <?php
                                      $stm = $db->prepare("select * from orders");
                                          $stm->execute();
                                          if($stm->rowCount())
                                          {
                                              foreach ($stm->fetchAll() as $row) {
                                                $id=$row['id'];
                                                // $totalprice =$_POST['totalproduct'];
                                                // $totalprice =$_POST['totalprice'];
                                                // $user_id=$row['user_id'];
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

                                          <td><?php echo $row['_date'];  ?></td>




                                          <td><?php echo $row['total_price'];  ?></td>
                                          <td><?php echo $row['total_products'];  ?></td>
                                          <td><?php
                                              $sql="select * from cart where id=:cart_id" ;
                                              $stm = $db->prepare($sql);
                                              $stm->execute(array("cart_id"=>$row['cart_id']));
                                              if ($stm->rowCount()>0)
                                              foreach ($stm->fetchAll() as $userRow){
                                                 $cart=$userRow['id'];
                                                 $user=$userRow['user_id'];
                                                 echo $cart;}

                                              ?>
                                          </td>

                                          <td><?php if($row['acceptance'] == 0) { ?>
                                          <a href="?action=accept&id=<?php echo $id ?>"
                                                  class='btn btn-success'>Accept</a>
                                            <?php } else { ?>
                                                <a href="?action=reject&id=<?php echo $id ?>"
                                                  class='btn btn-danger'>Reject</a>
                                                <?php } ?>
                                        </td>
                                        <?php
                                              $sql="select * from user where id=?" ;
                                              $stm = $db->prepare($sql);
                                              $stm->execute(array($user));
                                              if ($stm->rowCount()>0)
                                              foreach ($stm->fetchAll() as $userRow){?>
                                                <td><?php echo $userRow['id']; ?></td>
                                                <td><?php echo $userRow['name']; ?></td>
                                                <td><?php echo $userRow['email']; ?></td>
                                                <td><?php echo $userRow['phone']; ?></td>
                                                <td><?php echo $userRow['address']; }?></td>
                                                 <!-- $user=$userRow['user_id'];
                                                 echo $cart;} -->




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
