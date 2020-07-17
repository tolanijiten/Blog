<?php
require_once ("admin-bootstrap.php");

Session::start_session();

$conn = (new Database())->getConnection();

$posts = new Posts($conn);

$page_no = $_GET['page_no'];

$categories = new Categories($conn);

$start = ($page_no - 1 )* MAX_NUMBER;

//echo $_SESSION['user_id'];

$results = $posts->readAllPostsOfAuthor($_SESSION['user_id'],$start,MAX_NUMBER);

//var_dump($results);

$count = count($posts->readAllPostsOfAuthor($_SESSION['user_id']));

?>

<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th>Post Title</th>
            <th>Post Body</th>
            <th>Post Tags</th>
            <th>Post Author</th>
            <th>Post Date</th>
            <th>Post Image</th>
            <th>Post Status</th>
            <th>View Post</th>
            <th>Delete Post</th>
            <th>Toggle Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php for($i = 0 ; $i < count($posts->readAllPostsOfAuthor($_SESSION['user_id'])) ;$i++ ){?>


            <td><?php echo $results[$i]['post_title'];?></td>
            <td><?php echo $results[$i]['post_body'];?></td>

            <td><? echo $results[$i]['post_tags']; ?></td>
            <td><?echo $posts->getAuthorName($results[$i]['post_author_id']); ?></td>
            <td><? echo $results[$i]['post_date']; ?></td>
             <td><img src="../../../images/<?php echo $results[$i]['post_image'];?>" alt=""></td>
              <td><?php echo $results[$i]['post_status']; ?></td>
             <td>
                 <form action="">
                     <input type="text" hidden value="<?php echo $results[$i]['post_id'];?>">
                     <input type="submit" name="view_post" value="VIEW">
                 </form> </td>
              <td>
                  <form action="delete" method="post">
                      <input type="text" hidden value="<?php echo $results[$i]['post_id'];?>" name="post_id">
                      <input type="submit" name="view_post" value="Delete">
                  </form> </td>
                <td>

                    <form action="toggle" method="post">
                        <input type="text" hidden value="<?php echo $results[$i]['post_id'];?>" name="post_id">
                        <input type="submit" name="view_post" value="Toggle">
                    </form>

                </td>
            <?php }?>

        </tr>
        </tbody>
    </table>
</div>

<form action="http://localhost/blog-oop/admin/posts/all/<?echo ($page_no-1)?>">
    <input type="submit" value = "previous" <?  if($start == 0){ echo "disabled";} ?>>
</form>


<form action="http://localhost/blog-oop/admin/posts/all/<?echo ($page_no-1)?>">

    <input type="submit" value = "next" <?if(($start + MAX_NUMBER)>$count){echo "disabled";} ?>>

</form>