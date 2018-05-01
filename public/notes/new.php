<?php 

require_once('../../private/initialize.php'); 
require_login(); 
$page_title = "New Note"; 

$errors = "";

if(is_post_request()) {

    $note = [];
    $note['user_id'] = $_SESSION['id'];
    $note['title'] = isset($_POST['title']) ? $_POST['title'] : "";
    $note['content'] = isset($_POST['content']) ? $_POST['content'] : "";

    $result = insert_note($note); 
    if($result === true) {
        $new_id = mysqli_insert_id($db); 
        $_SESSION['message'] = 'The note was created successfully.';
        redirect_to(url_for('/notes/show.php?id=' . $new_id)); 
    } else {
        $errors = $result;
    }

} else {
    $note = [];
    $note['user_id'] = "";
    $note['title'] = "";
    $note['content'] = "";
}


?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div class="content">

    <a href="<?php echo url_for('/notes/list.php'); ?>">&laquo; Back to Notes List</a>

    <div>
        <h1>Create Note</h1>

        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('/notes/new.php'); ?>" method="post">

            <h3>Title</h3>
            <input type="text" name="title" value="<?php echo $note['title']; ?>">

            <h3>Content</h3>
            <textarea name="content" rows="10" value="<?php echo $note['content']; ?>"><?php echo $note['content']; ?></textarea>

            <div>
                <br>
                <input type="submit" value="Create Note">
            </div>

        </form>

    </div>

    
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>