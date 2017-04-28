<?php 
    $pageTitle = "delete";
    include './Control.php';
    include './Support.php';
    include '../Header and Footer/Header.php';
    include '../Header and Footer/Nav.php';
    
    $users = readUsers();
    $user = null;
    foreach($users as $u) {
        
        //get current user
        if (isset($_SESSION['userName']) && ($u->username == $_SESSION['userName'])) {
            $user = $u;
        }
    
    }
    
    //check to make sure user is admin
    if(!isAdmin($user)) { ?>
        <div class="container-fluid lemongrass-container">
            <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
            <div class="col-md-8 content">
                <p>You must be an admin to delete comments!</p>
            </div>
            <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
        </div>
            
    <?php 
    }
    else {
        if (isset($_GET['id'])) {
        
            require_once '../lib/Database.php';
            $db = new Database();
            $db->deleteComment($_GET['id']); 
            $prevPage = $_SESSION['ingURL'];?>
            
           <div class="container-fluid lemongrass-container">
            <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
            <div class="col-md-8 content">
                <p>Comment has been deleted</p>
                <p><a href= <?php echo "$prevPage"?> >Go Back</a></p>
            </div>
            <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
        </div>
            
    <?php 
        
        }
    }
    
?>





<?php include '../Header and Footer/Footer.php'; ?>
