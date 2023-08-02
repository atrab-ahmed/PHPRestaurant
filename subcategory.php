<?php
require 'include/connect.php';
session_start();

?>
  <?php include 'include/header.php'; ?>
  <div class="heading">
     <h3>our Catogries</h3>
     <p><a href="index.php">home</a> <span> / subCatogries</span></p>
  </div>
     <section class="category">
        <h1 class="title">food category</h1>

          <?php
          if(isset($_GET['cat_id'])){
             $cat_id = $_GET['cat_id'];
             $query="SELECT * FROM subcategories WHERE cat_id = ?";
             $select_categories= $db->prepare($query);
             $select_categories->execute(array($cat_id));
             if($select_categories->rowCount()> 0){
               foreach($select_categories->fetchAll() as $fetch_categories) {
          ?>
          <div class="box-container">
            <a href="category_menu.php?scat_id=<?php echo $fetch_categories['id'] ?>" class="box">
              <img src="admin/upload/<?php echo $fetch_categories['photo']?>" alt="not found">
              <h3><?php echo $fetch_categories['name']?></h3>
              <p><?php echo $fetch_categories['description']; ?></p>
           </a>

        </div>
      <?php
}}
    else{
       echo '<p class="empty">no categories added yet!</p>';
    }

}      ?>

</section>
<?php include 'include/footer.php'; ?>

<script src="https://unpkgs.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
