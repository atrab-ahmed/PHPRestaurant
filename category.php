<?php
require 'include/connect.php';
session_start();

?>
  <?php include 'include/header.php'; ?>
  <div class="heading">
     <h3>our Catogries</h3>
     <p><a href="index.php">home</a> <span> /Catogries</span></p>
  </div>
     <section class="category">
        <h1 class="title">food category</h1>

          <?php
            $query="SELECT * FROM categories";
             $select_categories= $db->prepare($query);
             $select_categories->execute();
             if($select_categories->rowCount()> 0){
               foreach($select_categories->fetchAll() as $fetch_categories) {
          ?>
          <div class="box-container">
            <a href="subcategory.php?cat_id=<?php echo $fetch_categories['id'] ?>" class="box">
              <img src="admin/upload/<?php echo $fetch_categories['photo']?>" alt="not found">
              <h3><?php echo $fetch_categories['name']?></h3>
           </a>

        </div>
      <?php
}}
    else{
       echo '<p class="empty">no categories added yet!</p>';
    }

      ?>

</section>
<?php include 'include/footer.php'; ?>

<script src="https://unpkgs.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
