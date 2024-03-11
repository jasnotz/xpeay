<?php
    error_reporting(0);
    include("Class/DB.php");
    include("Class/Post.php");
    include("Class/User.php");
    include("Class/Image.php");

    session_start();

	if($_SESSION['capt'] != $_POST['captcha'])
		{
        } else {
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $post = new Post();
                $result = $post->create_post($_POST, $_FILES);

                if($result == "") {
                    header("Location: index.php");
                    die;
                } else {
                }
            }
		}
    $user = new User();


    // Collect Posts
    $post = new Post();
    $posts = $post->get_posts();

    $image_class = new Image();
?>

<!DOCTYPE html>
<html lang="en">
<?php include("../head.php"); ?>
    <title>/s/ - sucks - xpeay</title>
    <script type="text/javascript">
        /* 문자 새로고침 */
        function refresh_captcha(){
            document.getElementById("capt_img").src="captcha.php?waste="+Math.random(); 
    //capt_img id를 불러와 문구들을 랜덤으로 돌린다
        }
    </script>
<body>
    <a href="index.php" style="text-decoration: none; color: black;"><h1 style="text-align:center; text-decoration: none;">/s/ - Sucks</h1></a>
    <a href="/xpeay/" style="text-align: center; text-decoration: none; color: grey;"><p style="text-align:center; font-size: 16px">[home]</p></a>
    <hr>
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
                <input type="file" name="file" id="" required>
            </p>
            <div>
                <img src="captcha.php" alt="captcha" title="captcha" id="capt_img" />
                <input type="text" name="captcha">
                <button onClick="refresh_captcha();">Refresh</button>
            </div>
            <button type="submit" value="submit" name="Submit" class="ui button">Post</button>
        </form>
    <hr>
       <?php
            if ($posts) {
                foreach($posts as $ROW) {
                    $user = new User();
                    $ROW_USER = $user->get_user($ROW['name']);
                    include("post.php");
                }
            }
        ?> 
    <hr>
</body>
</html>