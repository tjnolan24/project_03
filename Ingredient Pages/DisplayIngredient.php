<?php  
    include '../Login/Control.php';
    require_once '../lib/Comment.php';
    $pageTitle = 'display';
    include '../Header and Footer/Header.php';
    include '../Header and Footer/Nav.php';
?>

<?php
    
    //grab name of ingredient from GET
    $ing_name = $_GET['ing'];
    function isAdmin($user) {
    if (isset($_SESSION['userName']) && $_SESSION['userName'] == "Guest") {
        return false;
    }
    else if($user->type == "admin") {
        return true;
    }
    else
        return false;

}
    //connect to database
    require_once '../lib/Database.php';
    $db = new Database();
    $ingredient = $db->retrieveIngredient($ing_name);
    $_SESSION['lastestPage'] = $ing_name;
    
?>
    <!-- display ingredient information --> 
    <div class="container-fluid capers-container">
        <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
        <div class="col-md-8 content">
            <div class = "ingredient_title"><h1><?php echo $ingredient["ingredient_name"];?></h1></div>
            <?php $img = "./".$ingredient["image"];
            $_SESSION['lastImg'] = $img;
            ?>
            
            <div class = "ingredient-image"><img src= "<?php echo $img?>" ></div>
            <div class="ingredient-text">
                <p><?php echo $ingredient["description"];
                $_SESSION['lastDesc']=$ingredient["description"];
                ?></p><br>
            </div>
                <form action="#" method="post">
                <?php $_SESSION['control'] = 1; ?>
                    <a href="../Login/shoppingCart.php">Add to Cart</a>   
                </form>     
            <?php include "../Login/Message.php"; ?>
        </div>
        <div class="col md-2 hidden-sm hidden-xs sidebar"></div>
    </div>

    
<?php
    function get_ing(){
        return $ing_name;
    }


?>

<?php
include '../Header and Footer/Footer.php';
