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
                        <i class="fa fa-plus-circle"></i> Edit New User
                    </div>

                    <div class="panel-body">
                        <div class="row">
                        <?php
                        if (isset($_GET['action'], $_GET['id'])&&$_GET['action']=='edit' ) {
                            $id = $_GET['id'];
                                      $stm = $db->prepare("select * from user where id=:userid ");
                                          $stm->execute(array("userid"=>$id));
                                          if($stm->rowCount())
                                          {
                                              foreach ($stm->fetchAll() as $row) {
                                                $id=$row['id'];
                                                $name=$row['name'];
                                                 $phone=$row['phone'];
                                                $email=$row['email'];
                                                $address=$row['address'];
                                                $image_name=$row['name'];
                                                $Birthdate=$row['birth_date'];
                                                $password=$row['password'];
                                                //$conpassword=$row['conpassword'];
                                                $per_id=$row['per_id'];


                            if(isset($_POST['editUser']))
                        {  $id=$_POST['id'];
                           $per_id=$_POST['per_id'];

                                    $sql="UPDATE user set per_id=? where id=?" ;
                                    $stm = $db->prepare($sql);
                                    $stm->execute(array($per_id,$id));
                                    if ($stm->rowCount()) {
                                        echo "<script>
                                        alert('One Row Updated');
                                        window.open('user.php','_self');
                                         </script>
                                        ";
                                    } else {
                                        echo "<div class='alert alert-danger'>Row Not Updated</div>" ;
                                    }
                                }


                        }
                                                  ?>
                             <div class="col-md-12">
                                <form role="form" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $id ?>" >

                                <p>Name: <?php echo $name ?></p>
                                <p>Phone: <?php echo $phone ?></p>
                                <p>Email: <?php echo $email ?></p>

                                    <div class="form-group">
                                        <label>User Type</label>
                                        <select class="form-control" name="per_id">
                                          <?php
                                      $sql="select * from permission" ;
                                      $stm = $db->prepare($sql);
                                      $stm->execute();
                                      foreach ($stm->fetchAll() as $row) {
                                        if($row['id']==$per_id){
                                          ?>
                                          <option value="<?php echo $row['id']?>" selected><?php echo  $row['name'] ?></option>
                                          <?php
                                      }else { ?>
                                        <option value="<?php echo $row['id']?>" ><?php echo  $row['name'] ?></option>
                                      <?php } }?>
                                      </select>
                                    </div>
                                    <div style="float:right;">
                                        <button type="submit" class="btn btn-primary" name="editUser">Edit User</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                            </div>
                            </form>
<?php }}?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <hr />


        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
</div>

<?php
include('footer.php');
?>
