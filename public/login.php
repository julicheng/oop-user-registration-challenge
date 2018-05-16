<?php 

require_once('../private/initialize.php'); 

$page_title = "Login";
$errors = [];

include(SHARED_PATH . '/header.php');

if(is_post_request()) {

  $email = $_POST['email'] ?? "";
  $password = $_POST['password'] ?? '';

  if(Validation::is_blank($email)) {
    $errors[] = "Email cannot be blank.";
  }
  if(Validation::is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  $login_failure_msg = "Log in was unsuccessful.";

  // if there are no errors then run these if statements
  if(empty($errors)) {
    // see if email exists
    $user = User::find_by_email($email);
    if($user != false && $user->verify_password($password)) {
        $session->log_in($user);
        redirect_to(url_for('/index.php'));
      } else {
        // user found but pass does not match
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

    <!-- <?php
    
    $sql = "SELECT * FROM users";
    $result = mysqli_query(Database::$database, $sql);
    
?>
    <?php while($user = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $user['first_name']; ?></td>
                        <td><?php echo $user['last_name']; ?></td>
                  
                    </tr>
    
    
    <?php } ?> -->

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>