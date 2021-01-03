<?php include "include/config.php"; ?>


<html>
    <head>
        <title>News7</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    
    <body>
    <?php include("include/header.php");?>
        
        <div class="container mt-5">
          <div class="row">
              
            <div class="col-lg-3">
                <div class="list-group">
                    <a href="" class="list-group-item list-group-item-action">Category</a>
                    
                    <?php
                    
                    $callingCat = mysqli_query($connection,"select * from category");
                    while($row = mysqli_fetch_array($callingCat)):
                    ?>
                    
                    <a href="index.php?cat=<?= $row['cat_id'];?>" class="list-group-item list-group-item-action"><?php echo $row['cat_title'];?></a>
                    
                    <?php endwhile; ?>
                    
                </div>
            </div>
            
            <div class="col-lg-9">
                
                <?php
                
                if(isset($_GET['cat'])){
                    $cat_id = $_GET['cat'];
                
                $callingPost = mysqli_query($connection,"select * from post join category on post.post_category = category.cat_id where category.cat_id = '$cat_id'");
                }
                
                elseif(isset($_GET['find'])){
                    $search = $_GET['search'];
                    
                     $callingPost = mysqli_query($connection,"select * from post join category on post.post_category = category.cat_id where post.post_title like '%$search%'");
                }
                else{
                     $callingPost = mysqli_query($connection,"select * from post join category on post.post_category = category.cat_id");
                }
                 while($post = mysqli_fetch_array($callingPost)):
                ?>
                
                
                <div class="card mt-2">
                    <div class="row">
                        <?php
                        if($post['post_image']!=""):?>
                     <div class="col-lg-3">
                         <img src="<?= "images/".$post['post_image'];?>" alt="" height="100%" class="card-img-top">
                     </div>
                      <?php endif; ?> 
                        
                    <div class="col">
                        
                      <div class="card-body">
                          <h2><?= $post['post_title'];?></h2>
                          <p class="small float-left"><?= $post['post_author'];?></p>
                          <p class="lead float-right badge bg-danger text-white"><?= $post['cat_title'];?></p>
                          <div class="clearfix"></div>
                          <p class="lead"><?= substr($post['post_content'],0,300);?></p>
                          <a href="post.php?id=<?= $post['post_id'];?>" class="btn btn-success float-right">Read More</a>
                      </div>
                    </div>
                    </div>        
            </div>
               <?php endwhile; ?>
          </div>      
        </div>
       </div>
        
    <?php include("include/footer.php");?>
        
    </body>
</html>