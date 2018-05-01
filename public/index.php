<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>
<?php $page_title = "Home"; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div class="content">

    <h2>Welcome Back  <?php echo ucfirst($_SESSION['first_name']) . " " . ucfirst($_SESSION['last_name']); ?>!</h2>

    
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>