<?php 
    $pageTitle = "Submit-Order";
    include './Control.php';
    include './Support.php';
    include '../Header and Footer/Header.php';
    include '../Header and Footer/Nav.php';
    
    
    include_once '../lib/Database.php';
    $db = new Database();
    
    
    $users = readUsers();
    if(isset($_SESSION['userName'])) {
        $customer = $_SESSION['userName'];
    }
    else
        $customer = "Customer";
        
    $user = null;
    
    $msg = "Customer '$customer' submitted the following order:\n";
    
    //get items of cart in array
    $cartItems = $db->getCartItems();
    
    foreach($cartItems as $item) {
        $msg .= "-$item \n";
    }
    
    $msg .= "\nSincerely,\nThe Ingredients For You Team";
    
    foreach($users as $u) {
        
        //get current user
        if (isset($_SESSION['userName']) && ($u->username == $_SESSION['userName'])) {
            mail($u->email, "Ingredients For You Order", $msg);
        }
        if (isset($_SESSION['userName']) && (isAdmin($u))) {
            mail($u->email, "Ingredients For You Order", $msg);
        }
    
    }
    
     //drop table once order has been submitted
    //$db->deleteCart();
   
    
?>
<div class="container-fluid lemongrass-container">
 <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
    <div class="col-md-8 content">
        <p><?php echo "Order Submitted! Your receipt has been sent via email."; ?></p>
    </div>
<div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
</div>

<?php include '../Header and Footer/Footer.php'; ?>
