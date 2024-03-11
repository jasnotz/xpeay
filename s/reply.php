<div style="text-align: left; margin-left: 5%;">
    <div>
       <p><?php echo $ROW['name'] ?></p>
       <p><?php echo $ROW['date'] ?></p> 
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
    <hr>
</div>

