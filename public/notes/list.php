<?php 

require_once('../../private/initialize.php');
require_login(); 
$page_title = "Notes"; 

if(!isset($_GET['id'])) {
    redirect_to(url_for('/profile.php?id=' . $_SESSION['id']));
}

$user_id = $_GET['id'];

$notes_set = find_notes_by_user_id($user_id);

?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div class="content">

    <h1>Notes</h1>

            <a href="<?php echo url_for('/notes/new.php'); ?>">New Note</a><br><br>
            
            <table>
                <tr>
                    <th>Title</th>
                    <th colspan="3">&nbsp;</th>
                </tr>

                <?php while($note = mysqli_fetch_assoc($notes_set)) { ?>
                    <tr>
                        <td><?php echo $note['title']; ?></td>
                        <td><a href="<?php echo url_for('/notes/show.php?id=' . $note['id']); ?>">View</a></td>
                        <td><a href="<?php echo url_for('/notes/edit.php?id=' . $note['id']); ?>">Edit</a></td>
                        <td><a href="<?php echo url_for('/notes/delete.php?id=' . $note['id']); ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>
            
            <?php 
                mysqli_free_result($notes_set);
            ?>
    
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>