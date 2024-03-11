<?php    
    error_reporting(0);
    include("Class/DB.php");
    include("Class/Post.php");
    include("Class/User.php");
    include("Class/Image.php");
    include("Class/Reply.php");

    session_start();

    $conn = mysqli_connect("127.0.0.1", "root", "", "xpeay");

    $view_num = $_GET['number'];
    $sql = "SELECT * FROM msg_board WHERE number = '$view_num'";
    $result = mysqli_query($conn, $sql);

    if($_SESSION['capt'] != $_POST['captcha'])
		{
        } else {
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $reply = new Reply();
                $results = $reply->create_post($_POST, $_FILES);

                if($results == "") {
                } else {
                }
            }
		}


    $user = new User();

    $reply = new Reply();
    $replies = $reply->get_posts();
    
    $image_class = new Image();
?>
<!DOCTYPE html>
<html lang="en">
<?php include("../head.php"); ?>
    <title>/s/ - sucks - xpeay</title>
<body>
    <a href="index.php" style="text-decoration: none; color: black;"><h1 style="text-align:center; text-decoration: none;">/s/ - Sucks</h1></a>
    <h3 style="text-align: center; ">[Post a Reply]</h2>
    <a href="/xpeay/s" style="text-align: center; text-decoration: none; color: grey;"><p style="text-align:center; font-size: 16px">[home]</p></a>
    <?php
        if($row = mysqli_fetch_array($result)) {
    ?>
    <div> 
        <form style="text-align: center;" method="post" enctype="multipart/form-data">
            <div class="ui input"> 
                <label for="name">Name:</label>
                <input type="text" id="name" value="unco" name="name">
            </div>
            <div class="ui input">
                <label for="message">Comment </label>
                <input type="text" placeholder="Share your thought" name="message" id="message"></input>
            </div>
            <p>
                <input type="file" name="file" id="">
            </p>
            <div>
                <img src="captcha.php" alt="captcha" title="captcha" id="capt_img" />
                <input type="text" name="captcha">
                <button onClick="refresh_captcha();">Refresh</button>
            </div>
            <button type="submit" value="submit" name="Submit" class="ui button">Post</button>
        </form>
    </div>
    <div> <!-- Post Section -->
        <hr>
            <div>
                <h3><?= $row['name'] ?></h3>
                <p><?= $row['date'] ?></p>
            </div>
            <div>
                <?= $row['message'] ?>
                <br>
            </div>
            <br>
            <div>
                <?php
                    if (file_exists($row['image'])) {
                        $post_image = $image_class->get_thumb_post($row['image']);
                        echo "<img src='$post_image' style='width: 255px' />";
                    }
                ?>
            </div>
            <?php } ?>
        <hr>
    </div>       
    <?php
        if ($replies) {
            foreach($replies as $ROW) {
                $user = new User();
                $ROW_USER = $user->get_user($ROW['name']);
                include("reply.php");
            }
        }
    ?> 
</body>
</html>