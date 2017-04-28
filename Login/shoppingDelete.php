<?php 
    $pageTitle = "shopping-delete";
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
    
    //CHANGE TO CUSTOMER
    if(!isCustomer($user)) { ?>
        <div class="container-fluid lemongrass-container">
            <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
            <div class="col-md-8 content">
                <p>You must be an Customer to place orders!</p>
            </div>
            <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
        </div>
            
    <?php 
    }
    else {
        if (isset($_GET['id'])) {
        
            require_once '../lib/Database.php';
            $db = new Database();
            $db->deleteItem($_GET['id']); 
            $prevPage = $_SESSION['prevURL'];?>
            
           <div class="container-fluid lemongrass-container">
            <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
            <div class="col-md-8 content">
                <p>Order has been deleted</p>
                <p><a href= <?php echo "$prevPage"?> >Continue Shopping</a></p>
            </div>
            <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
        </div>
            
    <?php 
        
        }
    }
    
?>





<?php include '../Header and Footer/Footer.php'; ?>
