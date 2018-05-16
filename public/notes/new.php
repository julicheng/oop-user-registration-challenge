<?php 

require_once('../../private/initialize.php'); 
$session->require_login(); 
$page_title = "New Note"; 

if(is_post_request()) {

    $args = [];
    $args['user_id'] = $_SESSION['id'];
    $args['title'] = $_POST['title'] ?? "";
    $args['content'] = $_POST['content'] ?? "";

    $note = new Note($args); 
    $result = $note->save();

    if($result === true) {
        $new_id = $note->id; 
        $session->message('The note was created successfully.');
        redirect_to(url_for('/notes/show.php?id=' . $new_id)); 
    } else {
        $result = $note->errors;
    }

} else {
    
}


?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div class="content">

    <a href="<?php echo url_for('/notes/list.php?id=' . $_SESSION['id']); ?>">&laquo; Back to Notes List</a>

    <div>
        <h1>Create Note</h1>

        <?php if(isset($note)) {echo display_errors($note->errors);} ?>

        <form action="<?php echo url_for('/notes/new.php'); ?>" method="post">

            <h3>Title</h3>
            <input type="text" name="title" value="<?php if(isset($note)) {echo $note->title;} ?>">

            <h3>Content</h3>
            <textarea name="content" rows="10" value="<?php if(isset($note)) {echo $note->content;} ?>"><?php if(isset($note)) {echo $note->content;} ?></textarea>

            <div>
                <br>
                <input type="submit" value="Create Note">
            </div>

        </form>

    </div>

    
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>