<div class="col-md-8">
   <h1 class="my-4">Page Heading
      <small>Secondary Text</small>
   </h1>
   <?php
      $db= new Database();
      $connection = $db->getConnection();
      $post = new Posts($connection);

        if(isset($_GET['category_id'])){
            $category_id =  $_GET['category_id'];
            $result = $post->readAllPostsOfCategory($category_id);


        }else if(isset($_GET['author_id'])){
            $post_author_id = $_GET['author_id'];

            $result = $post->readAllPostsOfAuthor($post_author_id);
        }else if(isset($_POST['search'])){
            $keywords = $_POST['keywords'];
            $result = $post->readAllPostsBySearch($keywords);
        }else if(isset($_GET['tags'])){
            $tags = $_GET['tags'];
//            echo $tags;
            $result = $post->readPostsByTags($tags);
        }else{
            $result = $post->readAllPosts();
        }

   for($i=0;$i<count($result);$i++){
   ?>

   <!-- Blog Post -->
   <div class="card mb-4">
      <img class="card-img-top" src="<?php echo BASEURL."images/{$result[$i]['post_image']}";?>" alt="<?php echo $result[$i]['post_title'];?>">
      <div class="card-body">
         <h2 class="card-title"><?php echo $result[$i]['post_title']; ?></h2>
         <p class="card-text"><?php 
            $post_body = $result[$i]['post_body'];
            echo substr($post_body,0,strrpos(substr($post_body,0,300)," "))."...";
            ?></p>
         <a href="<?php echo  BASEURL."post/".$result[$i]['post_id']; ?>" class="btn btn-primary">Read More &rarr;</a>
         <?php
         $tags = $result[$i]['post_tags'];
         $tag = explode(",",$tags);
         for($j=0;$j<count($tag);$j++){
            $tag[$j] = trim($tag[$j]);
              
            echo<<<TAG
<a href="http://localhost/blog-oop/tags/{$tag[$j]}" class="btn btn-primary float-right mr-sm-1">{$tag[$j]}</a>
TAG;
         }
         ?>
      </div>
      <div class="card-footer text-muted">
         Posted on <?php echo $result[$i]['post_date']; ?> by
         <a href="<?php echo BASEURL."author/{$result[$i]['post_author_id']}"?>"><?php echo $post->getAuthorName($result[$i]['post_author_id']); ?></a>
      </div>
   </div>
<?php
   }
   ?>
   <!-- Pagination -->
   <ul class="pagination justify-content-center mb-4">
      <li class="page-item">
         <a class="page-link" href="#">&larr; Older</a>
      </li>
      <li class="page-item disabled">
         <a class="page-link" href="#">Newer &rarr;</a>
      </li>
   </ul>

</div>
