<?php 

require_once('../../private/initialize.php');
$session->require_login(); 
$page_title = "Edit Note";


if(!isset($_GET['id'])) {
    redirect_to(url_for('/notes/list.php?id=' . $_SESSION['id']));
}

$id = $_GET['id'];
$note = Note::find_by_id($id);

if(is_post_request()) {

    $args = [];
    $args['id'] = $id;
    $args['title'] = $_POST['title'] ?? "";
    $args['content'] =$_POST['content'] ?? "";

    $note->merge_attributes($args);
    $result = $note->save(); // returns errors if doesn't pass validation checks

    if($result === true) {
        $session->message('The note was edited successfully.');
        redirect_to(url_for('/notes/show.php?id=' . $id)); 
    } else {
        $result = $note->errors;
    }

} elseif (is_get_request()){
    // $note = Note::find_by_id($id);
}

?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div class="content">

    <a href="<?php echo url_for('/notes/list.php?id=' . $_SESSION['id']); ?>">&laquo; Back to Notes List</a>

    <div>
        <h1>Edit Note</h1>

        <?php echo display_errors($note->errors); ?>
        <form action="<?php echo url_for('/notes/edit.php?id=' . $id); ?>" method="post">

            <h3>Title</h3>
            <input type="text" name="title" value="<?php echo $note->title; ?>">

            <h3>Content</h3>
            <textarea name="content" rows="10" value="<?php echo $note->content; ?>"><?php echo $note->content; ?></textarea>

            <div>
                <br>
                <input type="submit" value="Edit Note">
            </div>

        </form>

    </div>

    
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>