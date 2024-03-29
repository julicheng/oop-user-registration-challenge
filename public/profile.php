<?php require_once('../private/initialize.php'); ?>
<?php $session->require_login(); ?>
<?php $page_title = "Profile"; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<?php 

$errors = [];
$file_errors = [];

if(!isset($_GET['id'])) {
    redirect_to(url_for('/index.php'));
}

$id = $_GET['id'];
$user = User::find_by_id($id);

if(is_post_request()) {
    $args = [];
    $args['id'] = $id;
    $args['first_name'] = $_POST['first_name'] ?? "";
    $args['last_name'] = $_POST['last_name'] ?? "";
    $args['email'] = $_POST['email'] ?? "";
    $args['password'] = $_POST['password'] ?? "";
    $args['confirm_password'] =$_POST['confirm_password'] ?? "";
    $args['profile_img'] = "";

    if($_FILES['profile_img']['size'] !== 0) {        
        $file = $_FILES['profile_img'];
        $file_result = Validation::validate_file($file);
        if (is_array($file_result) == true) {
            // $file_errors = $file_result;
            $user->errors = $file_result;
        } else {
            $args['profile_img'] = $file_result;
        }
    }

    $user->merge_attributes($args);
    $result = $user->save();

    if ($result === true) {
         $session->message('Your profile has updated successfully.');
        redirect_to(url_for('/profile.php?id=' . $_SESSION['id']));
    } else {
        $result = $user->errors;
        
    }

} elseif(is_get_request()) {
    // $user = User::find_by_id($id);
}

?>

<div class="content">
    <div class="profile-section">
        <div class="profile-image">
            <img src="<?php echo url_for('/images/' . $user->profile_img); ?>">
        </div>
        <div class="profile">
            <h1>Your Profile</h1>
            <h4>First Name: <span><?php echo ucfirst($user->first_name); ?></span></h4> 
            <h4>Last Name: <span><?php echo ucfirst($user->last_name); ?></span></h4>
            <h4>Email: <span><?php echo $user->email; ?></span></h4>
        </div>
    </div>

    <hr>

    <div class="profile-errors">
        <?php echo display_errors($user->errors); ?>
    </div>

    <form action="<?php echo 'profile.php?id=' . $user->id; ?>" method="post" class="form_update" enctype="multipart/form-data">

        First Name:
        <input type="text" name="first_name" value="<?php echo ucfirst($user->first_name); ?>" /><br /><br />
        Last Name:
        <input type="text" name="last_name" value="<?php echo ucfirst($user->last_name); ?>" /><br /><br />
        Email:
        <input type="email" name="email" value="<?php echo $user->email; ?>" /><br /><br />
        Password:
        <input type="password" name="password" value="" /><br /><br />
        Confirm Password:
        <input type="password" name="confirm_password" value="" /><br /><br />
        Profile Picture Upload:
        <input type="file" name="profile_img"/><br /><br />
        <input type="submit" name="submit" value="Update"  />

    </form>
    
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>