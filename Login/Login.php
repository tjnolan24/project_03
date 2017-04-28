<?php
    $loginPage = TRUE;
    $pageTitle = 'Sign In';
    include './Control.php';
    include './Support.php';
    
    
    $users = readUsers();
    $loginSuccess = false; /*variable for creating comments array*/

    if (isset ( $_POST ['user'] )) {
	$new = strip_tags($_POST ['user']);
	$epw = strip_tags($_POST ['pwd']);
	$old = $_SESSION ['userName'];
	if ($new != $old) {
		if (password_verify($epw, userHashByName($users, $new))) {
			$_SESSION ['startTime'] = time ();
			$_SESSION ['userName'] = $new;
			$loginSuccess = true;
			header ( "Location: https://$host$uri/index.php" );
		}
	}
    }
    include '../Header and Footer/Header.php';
?>

<?php
    include "../Header and Footer/Nav.php";
?>



<?php if ($loginSuccess) {
    
    header("Location: ./Login.php");
}
?>
<!-- End authentication section -->


<div class="container-fluid wasabi-container">
<div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
<div class="col-md-8 content">
        
    <!--If not signed in -->
    <?php if (isset($_SESSION['userName']) && ($_SESSION['userName'] == "Guest")) : ?>
        <h2>Sign in</h2>
        <form action="Login.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" aria-describedby="username" name="user">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" aria-describedby="pass" name="pwd">
            </div>
            <button class="btn btn-default" role="button" type="submit">Sign in</button>
            </br>
            <p> Forgot My  <a href="./FMP.php">Password</a> </p>
        </form>
    
    <!--Direct them to log out if they are signed in -->
    <?php else : ?>
        <?php 
            echo '<p>' . "You are currently signed in as '" . $_SESSION['userName'] . "'" . '</p>';
        ?>
        <div class="logout"><p><a href="Logout.php">Logout</a></p></div>
    <?php endif; ?>
</div>

<div class="col md-2 hidden-sm hidden-xs sidebar"></div>
</div>
<?php
        include "../Header and Footer/Footer.php";
?>
