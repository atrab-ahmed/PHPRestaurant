<?php
  require ("include/connect.php");

session_start();
if(isset($_SESSION['user_info'])&&$_SESSION['user_info']['per_id']==2){
   $user_id = $_SESSION['user_info']['id'];
}else{
   $user_id ='';
   header('location:login.php');
};
?>


<?php include 'include/header.php'; ?>

<section class="user-details">
   <div class="user">
     <?php
             $query="SELECT * FROM user WHERE id=:id";
             $select_user=$db->prepare($query);
             $select_user->execute(array("id"=>$user_id));
             if($select_user->rowCount()==1){
               foreach($select_user->fetchAll() as $fetch_user) {
      ?>
      <img src="admin/upload/<?php echo $fetch_user['image'];?>" alt="no">
      <p><i class="fas fa-user"></i><span><span> <?php echo $fetch_user['name']; ?></span></span></p>
      <p><i class="fas fa-phone"></i><span><?php echo $fetch_user['phone']; ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?php echo $fetch_user['email']; ?></span></p>
      <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php echo $fetch_user['address'];?></span></p>
      <p><i class="fas fa-calendar-alt "></i><span><?php echo $fetch_user['birth_date']; ?></span></p>
      <p><i class="fa-solid fa-venus-mars "></i><span><?php echo $fetch_user['gender']; ?></span></p>
      <a href="update_profile.php?action=update_profile&id=<?php echo $fetch_user['id']?>" class="btn">update info</a>
   </div>
 <?php }} ?>
</section>

<?php include 'include/footer.php'; ?>
<script src="js/script.js"></script>
