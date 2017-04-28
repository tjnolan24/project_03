<?php 
    $loginPage = TRUE;
    $pageTitle = 'Sign In';
    include './Control.php';
    include './Support.php';
    include '../Header and Footer/Header.php';
?>


<?php
    include "../Header and Footer/Nav.php";
?>
<div class="container-fluid wasabi-container">
<div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
<div class="col-md-8 content">

<?php
$valid = false;
    $uname = '';
    $email = '';
    if (isset($_POST['name'])){
        $uname = $_POST['name'];
        $handle = fopen("users.csv", "r");
        
            while(($data = fgetcsv($handle)) !== FALSE){
                if($data[0] == $uname){
                    $valid = true;
                    $email = $data[3];
                    $key = "abcdefghijklmnopqrstuvwxyz1234567890";
                    $_SESSION['Key1'] = str_shuffle($key);
                    $_SESSION['user'] = $uname;
                    $keyS =  "https://$host$uri/passwordreset.php?key=" . $_SESSION['Key1'];
                    mail($email,"Password Reset", $keyS);
                    echo "An email has been sent to " ;
                    echo $email;
                    echo " to reset your password!";
                }
            }
        //if they enter a username that is not registered    
        if ($valid == false){
            echo "UserName not Found!";
        }
    }


?>

<form action="FMP.php" method="post">
    <p>
        UserName: 
                <input type="text" name="name" placeholder="Username"><br/>
                <br/>
                <input type="submit" name="login" value="Generate Email">
            </select>
    </p>
</form>
</div>

<div class="col md-2 hidden-sm hidden-xs sidebar"></div>
</div>
<?php
        include "../Header and Footer/Footer.php";
?>
