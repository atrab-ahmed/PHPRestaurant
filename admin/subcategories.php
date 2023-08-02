﻿<?php

require('include/connect.php');
session_start();

if(isset($_SESSION['user_info'])&&$_SESSION['user_info']['per_id']==1){
   $admin_id = $_SESSION['user_info']['id'];
}else{
   header('location:login.php');
};
include('header.php');
?>

<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-tasks"></i> Subcategories</h2>

            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> Add New Subcategory
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <?php
                            if (isset($_POST['submit'])) {
                                $name = trim($_POST['name']);
                                $description = trim(($_POST['description']));
                                $image= $_FILES['file'];
                                $cat_id=$_POST['cat_id'];
                                $image_name= $image['name'];
                                $image_type= $image['type'];
                                $image_tmp= $image['tmp_name'];
                           $errors=array();
                           $extensions=array('jpg','gif','png');
                           $file_explode=explode('.',$image_name);
                           $file_extension=strtolower(end($file_explode));
                            if(!in_array($file_extension,$extensions))
                            {
                              $errors['image_error'] = "<div style='color:red'>file extensions is Not Vaild</div>";
                            }
                            if(is_numeric($name)){
                                $errors['name'] = "Name Must Be String" ;
                            }

                                if (empty($name)) {
                                    $errors['cname'] = "<div style='color:red'>Enter Name of subcategory</div>";
                                } elseif (is_numeric($name)) {
                                    $errors['cnameNumber'] = "<div style='color:red'>Enter String Name of subcategory</div>";
                                }
                                elseif (is_numeric($description)) {
                                    $errors['dnameNumber'] = "<div style='color:red'>Enter String description of subcategory</div>";
                                }
                                else {
                                    move_uploaded_file($image_type,"admin/upload/".$image_name);
                                    $sql = "insert into subcategories (name,description,photo,cat_id) values (?,?,?,?) ";
                                    $stm = $db->prepare($sql);
                                    $stm->execute(array($name, $description,$image_name,$cat_id));
                                    if ($stm->rowCount()) {
                                        echo "<div class='alert alert-success'>One Row Inserted </div>";
                                    } else {
                                        echo "<div class='alert alert-danger'>One Row  not Inserted </div>";
                                    }
                                }
                            }

                            ?>
                            <div class="col-md-12">
                              <!-- ////////////////////////////////////////////// -->
                                <form role="form" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" placeholder="Please Enter your Name " class="form-control"
                                            name="name" />
                                        <?php if (isset($errors['cname'])) echo $errors['cname'] ?>
                                        <?php if (isset($errors['cnameNumber'])) echo $errors['cnameNumber'] ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>

                                        <textarea placeholder="Please Enter Description" class="form-control" cols="30"
                                            rows="3" name='description'></textarea>
                                            <?php if (isset($errors['dnameNumber'])) echo $errors['dnameNumber'] ?>
                                    </div>
                                    <div class="form-group">
                                        <label>images</label>
                                        <input type="file" class="form-control" name="file" required>
                                    </div>
                                    <div class="form-group">
                                        <label>category Type</label>
                                        <select class="form-control" name="cat_id">
                                            <?php
                                        $sql="select * from categories " ;
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

                                    <div style="float:right;">
                                        <button type="submit" name="submit" class="btn btn-primary">Add
                                            Subategory</button>
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
                        <i class="fa fa-tasks"></i> Subcategories
                    </div>
                    <?php
                    if (isset($_GET['action'], $_GET['id'])) {

                        $id = $_GET['id'];
                        switch ($_GET['action']) {
                            case "delete":
                                $stm = $db->prepare("delete from subcategories where id=:catid");
                                $stm->execute(array("catid"=>$id));
                                if($stm->rowCount()==1)
                                {
                                    echo "<div class='alert alert-success'> One Row Deleted</div>";
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
                            <table class="table table-striped table-bordered table-hover " id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Type</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stm = $db->prepare("select * from subcategories");
                                    $stm->execute();
                                    if ($stm->rowCount()) {
                                        foreach ($stm->fetchAll() as $row) {
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            $description = $row['description'];

                                            $image_name= $row['photo'];



                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $id  ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $description ?></td>
                                        <td><img src="upload/<?php echo  $image_name ?>
                                        " alt="not found" width="60px"></td>
                                        <td><?php
                                            $sql="select * from categories where id=:cat_id" ;
                                            $stm = $db->prepare($sql);
                                            $stm->execute(array("cat_id"=>$row['cat_id']));
                                            if ($stm->rowCount()>0)
                                            foreach ($stm->fetchAll() as $catRow)
                                               echo $catRow['name'];

                                            ?>
                                        </td>

                                        <td>
                                            <a href="editsubcategory.php?action=edit&id=<?php echo $id ?>" class='btn btn-success'>Edit</a>
                                            <a href="?action=delete&id=<?php echo $id ?>" class='btn btn-danger'
                                            onclick= "return confirm('Are You Sure !!')">Delete</a>

                                        </td>
                                    </tr>
                                    <?php  }
                                    } else { ?>

                                    <div class='alert alert-danger'>Not Row </div>
                                    <?php } ?>
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
<script>
    $('#delete').click(function () {
        return confirm('Are You Sure !!');
    });
</script>
