<?php 

require_once('../../private/initialize.php');
require_login(); 
$page_title = "Edit Note";

$errors = "";

if(!isset($_GET['id'])) {
    redirect_to(url_for('/notes/list.php?id=' . $_SESSION['id']));
}

$id = $_GET['id'];

if(is_post_request()) {

    $note = [];
    $note['id'] = $id;
    $note['title'] = isset($_POST['title']) ? $_POST['title'] : "";
    $note['content'] = isset($_POST['content']) ? $_POST['content'] : "";

    $result = update_note($note); 
    if($result === true) {
        $_SESSION['message'] = 'The note was edited successfully.';
        redirect_to(url_for('/notes/show.php?id=' . $id)); 
    } else {
        $errors = $result;
    }

} elseif (is_get_request()){
    $note = find_note_by_id($id);
}

?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div class="content">

    <a href="<?php echo url_for('/notes/list.php?id=' . $_SESSION['id']); ?>">&laquo; Back to Notes List</a>

    <div>
        <h1>Edit Note</h1>

        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('/notes/edit.php?id=' . $id); ?>" method="post">

            <h3>Title</h3>
            <input type="text" name="title" value="<?php echo $note['title']; ?>">

            <h3>Content</h3>
            <textarea name="content" rows="10" value="<?php echo $note['content']; ?>"><?php echo $note['content']; ?></textarea>

            <div>
                <br>
                <input type="submit" value="Edit Note">
            </div>

        </form>

    </div>

    
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>