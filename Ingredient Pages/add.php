        <?php 
            require_once '../lib/ingredient.php';
    require_once '../lib/Database.php';
    $db = new Database();
            if (isset($_SESSION['Ingname'])) {
                    $cart = new ingredient();
                    $cart->ingredient_name = $_SESSION['Ingname'];
                    $cart->image = $_SESSION['currentFile'];
                    $cart->description = $_SESSION['descript']; 
                    $db->insertIngedient($cart);
            }
        
        ?>
