<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <form action="posts/insert" enctype="multipart/form-data" method="post">


        <select name="post_category_id" id="post_category_id">
            <option value="Select a category ... " selected disabled>Select a Category</option>

            <?php
            $db = new Database();
            $conn = $db->getConnection();
            $category = new Categories($conn);

            $result = $category->readAllActiveCategories();

            $res = "";
            foreach($result as $res){
                echo "<option value={$res['category_id']}>{$res['category_name']}</option>";
            }

            ?>
        </select>

        <label for="post_title">Post Title</label>
        <input id="post_title" type="text" name="post_title">

        <label for="post_tags">Post Tags</label>
        <input id="post_tags" type="text" name="post_tags">

        <label for="post_image">Post Image</label>
        <input id="post_image" type="file" name="post_image">


        <select name="post_status" id="">
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>

        <label for="post_body">Post Body</label>
        <textarea name="post_body" id="post_body" cols="30" rows="10"></textarea>

        <input type="submit" name="post_submit">

    </form>


</div>