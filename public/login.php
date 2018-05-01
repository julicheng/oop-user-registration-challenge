<?php 

require_once('../private/initialize.php'); 

$page_title = "Login";
$errors = [];

include(SHARED_PATH . '/header.php');

if(is_post_request()) {

  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  //validations
  if(is_blank($email)) {
    $errors[] = "Email cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

// if there are no errors then run these if statements
if(empty($errors)) {
  $login_failure_msg = "Log in was unsuccessful.";
  // see if username exists
  $user = find_user_by_email($email);
  if($user) {
    if(password_verify($password, $user['hashed_password'])) {
      // pass matches
      log_in($user);
      redirect_to(url_for('/index.php'));
    } else {
      // user found but pass does not match
      $errors[] = $login_failure_msg;
    }
  } else {
    // no username found
    $errors[] = $login_failure_msg;
  }
}

}

?>

<div class="content">

    <?php echo display_errors($errors); ?>

    <form action="login.php" method="post">

        Email<br />
        <input type="email" name="email" value="" /><br /><br />
        Password<br />
        <input type="password" name="password" value="" /><br /><br />
        <br>
        <input type="submit" name="submit" value="Login"  />

    </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>