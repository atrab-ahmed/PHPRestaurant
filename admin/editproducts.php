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
                <h2><i class="fa fa-items"></i>Products</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> Edit Porduct
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <?php

                            if (isset($_GET['action'], $_GET['id'])&&$_GET['action']=='edit' ) {
                                $id = $_GET['id'];
                            $stm = $db->prepare("select * from products where id=:proid");

                                $stm->execute(array("proid"=>$id));

                                if($stm->rowCount())
                                {
                                    foreach ($stm->fetchAll() as $row) {
                                        $id=$row['id'];
                                        $name=$row['name'];
                                        $price=$row['price'];
                                        $description=$row['description'];
                                        $image_name_db= $row['photo'];
                                        // $image_name=['name'];
                                        $scat_id =$row['scat_id'];

                             if(isset($_POST['submitProduct']))
                        {
                        $id=$_POST['id'];
                           $name =trim($_POST['name']);
                           $price =trim($_POST['price']);
                           $description =trim($_POST['description']);
                           $image = $_FILES['file'];
                           $scat_id =$_POST['scat_id'];
                           $image_name= $image['name'];
                           $image_type= $image['type'];
                           $image_tmp= $image['tmp_name'];
                           $errors=array();
                           $extensions=array('jpg','gif','png');
                           $file_explode=explode('.',$image_name);
                           $file_extension=strtolower(end($file_explode));
                        //    echo "<pre>";
                        //                    print_r($image);
                        //   echo "</pre>";
                            if(!in_array($file_extension,$extensions))
                            {
                              $errors['image_error'] = "<div style='color:red'>file extensions is Not Vaild</div>";
                            }
                            if(is_numeric($name)){
                                $errors['name'] = "Name Must Be String" ;
                            }
                            if(!(is_numeric($price))){
                                $errors['price'] = "price Must Be number" ;
                            }
                            if (empty($name)) {
                                $errors['pname'] = "<div style='color:red'>Enter Name of Products</div>";
                            } elseif (is_numeric($name)) {
                                $errors['name'] = "<div style='color:red'>Enter String Name of products</div>";
                            }else {
                                if($image['error'] == 0){
                                    move_uploaded_file($image_type,"admin/upload/".$image_name);
                                }
                                else {
                                    $image_name = $image_name_db;
                                }
                                    $sql="UPDATE products set price=?,photo=?,description=?,name=?,scat_id=?
                                   where id=?  ";
                                    $stm = $db->prepare($sql);
                                    $stm->execute(array($price,$image_name,$description,$name,$scat_id,$id));
                                    if ($stm->rowCount()) {
                                        echo "<script>
                                        alert('One Row Updated');
                                        window.open('products.php','_self');
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
                                        <input type="text" name="name" placeholder="Please Enter the Name "
                                           value="<?php echo $name?>" class="form-control" />
                                        <i style="color: red;">
                                            <?php if(isset( $errors['name'] )) echo  $errors['name']  ?>
                                            <?php if(isset( $errors['pname'] )) echo  $errors['pname']  ?>
                                        </i>

                                    </div>
                                    <div class="form-group">
                                        <label>price</label>
                                        <input type="text" name="price" placeholder="Please Enter the price "
                                        value="<?php echo $price ?>"  class="form-control" />
                                        <i style="color: red;">
                                            <?php if(isset( $errors['price'] )) echo  $errors['price']  ?>
                                        </i>
                                    </div>

                                    <div class="form-group">
                                        <label>description</label>
                                        <textarea placeholder="Please Enter Description" name="description"
                                            class="form-control" cols="30" rows="3"><?php echo $description?> </textarea>
                                    </div>
                                    <div class="form-group">

                                        <label>images</label><br>
                                        <img src="upload/<?php echo $image_name_db ?>" width=30%>

                                        <input type="file" class="form-control" name="file">
                                        <i style="color: red;">
                                            <?php if(isset( $errors['image_error'] )) echo  $errors['image_error']  ?>
                                        </i>
                                    </div>

                                    <div class="form-group">
                                        <label>product Type</label>
                                        <select class="form-control" name="scat_id">
                                            <?php
                                        $sql="select * from subcategories " ;
                                        $stm = $db->prepare($sql);
                                        $stm->execute();
                                        foreach ($stm->fetchAll() as $row) {
                                            if($row['id']==$scat_id){
                                              ?>
                                              <option value="<?php echo $row['id']?>" selected><?php echo  $row['name'] ?></option>
                                              <?php
                                          }else { ?>
                                            <option value="<?php echo $row['id']?>" ><?php echo  $row['name'] ?></option>
                                          <?php } }?>

                                        </select>
                                    </div>
                                    <div style="float:right;">
                                        <button type="submit" name="submitProduct" class="btn btn-primary">Edit
                                            Product</button>
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
