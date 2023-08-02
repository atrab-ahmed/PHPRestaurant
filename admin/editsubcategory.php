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
                <h2><i class="fa fa-tasks"></i> subcategories</h2>

            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> Edit Category
                    </div>
                    <div class="panel-body">
                        <div class="row">
                             <?php
                             if (isset($_GET['action'], $_GET['id'])&&$_GET['action']=='edit' ) {
                                $id = $_GET['id'];
                                    $stm = $db->prepare("select * from subcategories where id=:catid");
                                    $stm->execute(array("catid"=>$id));
                                    if ($stm->rowCount()) {

                                        foreach ($stm->fetchAll() as $row) {
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            $description = $row['description'];
                                            $image_name_db= $row['photo'];
                                            $cat_id =$row['cat_id'];


                                            if (isset($_POST['submit'])) {
                                                $name = trim($_POST['name']);
                                                $description = trim(($_POST['description']));
                                                $image= $_FILES['file'];
                                                $cat_id =$_POST['cat_id'];
                                                $image_name= $image['name'];
                                                $image_type= $image['type'];
                                                $image_tmp= $image['tmp_name'];
                                           $errors=array();
                                           $extensions=array('jpg','gif','png');
                                           $file_explode=explode('.',$image_name);
                                           $file_extension=strtolower(end($file_explode));
                                        //    echo "<pre>";
                                        //    print_r($image);
                                        //    echo "</pre>";
                                            if(!in_array($file_extension,$extensions))
                                            {
                                              $errors['image_error'] = "<div style='color:red'>file extensions is Not Vaild</div>";
                                            }
                                            if(is_numeric($name)){
                                                $errors['name'] = "Name Must Be String" ;
                                            }


                                                if (empty($name)) {
                                                    $errors['cname'] = "<div style='color:red'>Enter Name of Category</div>";
                                                } elseif (is_numeric($name)) {
                                                    $errors['cnameNumber'] = "<div style='color:red'>Enter String Name of Category</div>";
                                                }
                                                elseif(is_numeric($description)){
                                                    $errors['dnameNumber'] = "<div style='color:red'>Enter String description of Category</div>";
                                                }
                                                else {
                                                    if($image['error'] == 0){

                                                        move_uploaded_file($image_type,"admin/upload/".$image_name);
                                                    }
                                                    else {

                                                        $image_name = $image_name_db;
                                                    }

                                                    $sql="UPDATE subcategories set name=?,description=?,photo=?,cat_id=? where id=?" ;
                                    $stm = $db->prepare($sql);
                                    $stm->execute(array($name, $description,$image_name,$cat_id,$id));
                                    if ($stm->rowCount()) {
                                        echo "<script>
                                        alert('One Row Updated');
                                        window.open('subcategories.php','_self');
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
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" placeholder="Please Enter your Name "
                                        class="form-control"
                                        value="<?php echo $name ?>" name="name" />
                                        <?php if (isset($errors['cname'])) echo $errors['cname'] ?>
                                        <?php if (isset($errors['cnameNumber'])) echo $errors['cnameNumber'] ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea placeholder="Please Enter Description"
                                        class="form-control" cols="30" rows="3" name='description'> <?php echo $description?> </textarea>
                                        <?php if (isset($errors['dnameNumber'])) echo $errors['dnameNumber'] ?>
                                    </div>

                                    <div class="form-group">
                                        <label>images</label><br>
                                        <img src="upload/<?php echo $image_name_db ?>" width=30%>

                                        <input type="file" class="form-control"
                                         name="file" >
                                    </div>
                                    <div class="form-group">
                                        <label>product Type</label>
                                        <select class="form-control" name="cat_id">
                                            <?php
                                        $sql="select * from categories " ;
                                        $stm = $db->prepare($sql);
                                        $stm->execute();
                                        foreach ($stm->fetchAll() as $row) {
                                            if($row['id']==$cat_id){
                                              ?>
                                              <option value="<?php echo $row['id']?>" selected><?php echo  $row['name'] ?></option>
                                              <?php
                                          }else { ?>
                                            <option value="<?php echo $row['id']?>" ><?php echo  $row['name'] ?></option>
                                          <?php } }?>

                                        </select>

                                    <div style="float:right;">
                                        <button type="submit" name="submit" class="btn btn-primary">Edit Category</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                            </div>
                            </form>
       <?php }}}?>
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
