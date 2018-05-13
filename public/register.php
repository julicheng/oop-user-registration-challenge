<?php require_once('../private/initialize.php'); ?>

<?php $page_title = "Register"; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<?php 

if(is_post_request()) {
    $args = [];
    $args['first_name'] = $_POST['first_name'] ?? "";
    $args['last_name'] = $_POST['last_name'] ?? "";
    $args['email'] = $_POST['email'] ?? "";
    $args['password'] = $_POST['password'] ?? "";
    $args['confirm_password'] = $_POST['confirm_password'] ?? "";

    $user = new User($args);
    $result = $user->save();

    if($result === true) {
         $_SESSION['message'] = 'Your account was created successfully. Please Log in.';
        redirect_to(url_for('/login.php'));
    } else {
        $user->errors = $result;
    }

}

?>

<div class="content">

    <?php if (isset($user)) {echo display_errors($user->errors); }; ?>

    <form action="register.php" method="post">

        First Name<br />
        <input type="text" name="first_name" value="" /><br /><br />
        Last Name<br />
        <input type="text" name="last_name" value="" /><br /><br />
        Email<br />
        <input type="email" name="email" value="" /><br /><br />
        Password<br />
        <input type="password" name="password" value="" /><br /><br />
        Confirm Password<br />
        <input type="password" name="confirm_password" value="" /><br /><br />
        <input type="submit" name="submit" value="Register"  />

    </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>