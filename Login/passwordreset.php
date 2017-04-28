 <?php
    $loginPage = TRUE;
    $pageTitle = 'Sign In';
    include './Control.php';
    include './Support.php';
?>
 
<?php
                 
    
    require_once ('passwordLib.php');
    $uname = $_SESSION['user'];
    $pword = '';
    $email = '';
    $line_of_text = '';
    
    
        if (isset($_POST['rest'])){
            if ((isset($_POST['Pass'])) && (isset($_POST['Pass2']))){
                if($_POST['Pass'] == $_POST['Pass2']){
                $pword = $_POST['Pass'];
                $handle = fopen("users.csv", "r");
             
                while(($data = fgetcsv($handle)) !== FALSE){
                    if($data[0] == $uname){
                    
                        $email = $data[2];
                        $phash = password_hash($pword);
                        $delete = $uname . "," . $data[1] . "," . $email;
                        $line_of_text = $uname . "," . $phash . "," . $email; 
                        
                       
                       $replace = str_replace($delete,$line_of_text,file_get_contents("users.csv"));
                       
                      
                            file_put_contents("users.csv", $replace);
                            $_POST['Pass'] = "";
                           
                                            
                    }  
                }            
            }
        }
    }
include "../Header and Footer/Header.php";

?>
<?php
    include "../Header and Footer/Nav.php";
?>
<div class="container-fluid wasabi-container">
<div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
<div class="col-md-8 content">
 
 
<form action="passwordreset.php" method="post">
    <p>

    <?php

        if ($_GET['key'] != $_SESSION['Key1']){
        header ( "Location: Login.php" );
        }
    ?>
    
        Information:     <br/>   
                <input type="password" name="Pass" placeholder="Password"><br/>
                <input type="password" name="Pass2" placeholder="Confirm Password"><br/>
                <input type="submit" name="rest" value="Reset Password">
            </select>
    </p>
</form>
</div>
</div>
<?php
        include "../Header and Footer/Footer.php";
?>
