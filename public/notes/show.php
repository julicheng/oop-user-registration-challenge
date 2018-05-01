<?php 

require_once('../../private/initialize.php'); 
require_login(); 
$page_title = "Show Note"; 

if(!isset($_GET['id'])) {
    redirect_to(url_for('/notes/list.php?id=' . $_SESSION['id']));
}

$id = $_GET['id'];

$note = find_note_by_id($id);

?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div class="content">

    <a class="back-link" href="<?php echo url_for('/notes/list.php?id=' . $_SESSION['id']); ?>">&laquo; Back to Notes List</a>

    <div>

        <h1><?php echo $note['title']; ?></h1>

        <div>
                <p><?php echo $note['content']; ?></p>
        </div>

    </div>
    
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>