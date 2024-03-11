
<div style="text-align: left;">
    <div>
       <p><?php echo $ROW_USER['name'] ?></p>
       <p><?php echo $ROW_USER['date'] ?></p> 
    </div>
    <div>
        <p><?php echo $ROW['message'] ?></p>
    </div>    
    <div>
        <?php
            if (file_exists($ROW['image'])) {
                $post_image = $image_class->get_thumb_post($ROW['image']);
                echo "<img src='$post_image' style='width: 255px' />";
            }
        ?>
    </div>
    <div>
        <form action="" method="POST">

        <a href="com.php?number=<?php echo $ROW['number'] ?>">Reply</a><p><!--Reply: /*</--></p>
        </form>
    </div>
    <hr>
</div>
