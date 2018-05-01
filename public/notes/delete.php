<?php 

require_once('../../private/initialize.php'); 
require_login(); 
$page_title = "Delete Note"; 

if(!isset($_GET['id'])) {
    redirect_to(url_for('/profile.php?id=' . $_SESSION['id']));
}

$id = $_GET['id'];

if(is_post_request()) {
   $result = delete_note($id);
   $_SESSION['message'] = 'The note was deleted successfully.';
   redirect_to(url_for('/notes/list.php?id=' . $_SESSION['id']));
} else {
    $note = find_note_by_id($id);
}

?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div class="content">

    <a href="<?php echo url_for('/notes/list.php?id=' . $_SESSION['id']); ?>">&laquo; Back to Notes List</a>

    <div>
        <h1>Delete Note</h1>
        <p>Are you sure you want to delete this note?</p>
        <p><?php echo $note['title']; ?></p>

        <form action="<?php echo url_for('/notes/delete.php?id=' . $note['id']); ?>" method="post">
            <div>
                <input type="submit" name="commit" value="Delete Note">
            </div>
        </form>
    </div>
    
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>