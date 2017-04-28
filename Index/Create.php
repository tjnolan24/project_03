<?php
/***************
 * create.php
 * Creates the database we will be using for this example.
 * 
 * Jaime Ruiz 		  initial	 March 2, 2015
 * Ross Beveridge     updated     March 21, 2017
 */
$title = "Ingredients For You Database";
$pageTitle = "Create";
?>
<main>

    <?php if (!$dbh = setupIngredientConnection()) { die; } ?>
				
    <?php //dropTableByName ( "ingredient" );
    //dropTableByName ( "comments" ); ?>
            
    <?php
    //will create tables if they don't exist
    createTableIngredient ();
    createImageTable();
    createTableComments (); 
    createTableCart();?>
    
					
    <?php 
    //load default ingredients into table if emtpy
    $sql_empty = "SELECT count(*) FROM ingredient";
    $result = $dbh->query($sql_empty);
    if($result->fetchColumn() == 0) {
        loadIngredientsIntoEmptyDatabase (); 
    } ?>
				

</main>
<?php
/* Here are functions encapsulating patterns utilized above */
function setupIngredientConnection() {
	try {
		$dbh = new PDO ( "sqlite:./ingredients.db" );
		return $dbh;
	} catch ( PDOException $e ) {
		echo '<pre class="bg-danger">';
		echo 'Connection failed (Help!): ' . $e->getMessage ();
		echo '</pre>';
		return FALSE;
	}
}
function dropTableByName($tname) {
	global $dbh;
	$sql = "DROP TABLE IF EXISTS $tname";
	$status = $dbh->exec ( $sql );
	if ($status === FALSE) {
		echo '<pre class="bg-danger">';
		print_r ( $dbh->errorInfo () );
		echo '</pre>';
	} 
}
function createTableComments() {
	$sql = "CREATE TABLE IF NOT EXISTS comments (
            comment_id INTEGER PRIMARY KEY ASC,
            comment_text varchar(255),
            user varchar(50),
            timestamp varchar(50),
            ip_addr varchar(50),
            ingredient_id int(5),
            FOREIGN KEY (ingredient_id) REFERENCES ingredient(ingredient_id))";
	createTableGeneric ( $sql );
}

function createTableIngredient() {
	$sql = "CREATE TABLE IF NOT EXISTS ingredient (
			   ingredient_id INTEGER PRIMARY KEY ASC, 
			   ingredient_name varchar(50), 
			   image varchar(50), 
			   description varchar(500))";
	createTableGeneric ( $sql );
}

function createImageTable() {
	$sql = "CREATE TABLE IF NOT EXISTS images (id INTEGER PRIMARY KEY ASC, 
			 name varchar(255), type varchar(50), size int(10), ext varchar(5))";
	createTableGeneric ( $sql );
}

function createTableCart() {
	$sql = "CREATE TABLE IF NOT EXISTS shopingCart (
			   ingredient_id INTEGER PRIMARY KEY ASC, 
			   ingredient_name varchar(50), 
			   image varchar(50), 
			   description varchar(500))";
	createTableGeneric ( $sql );
}

function createTableGeneric($sql) {
	global $dbh;
	$status = $dbh->exec ( $sql );
	if ($status === FALSE) {
		echo '<pre class="bg-danger">';
		print_r ( $dbh->errorInfo () );
		echo '</pre>';
	}
}
function loadIngredientsIntoEmptyDatabase() {
	global $dbh;
	include "../source_file/list.php";
	$ingredients = getIngredientsFromFile ();
	$comments = array (); // Stores artists and SQL index
	$sql_ingredient = "INSERT INTO ingredient (ingredient_name, image, description)
									 VALUES (:ingredient_name, :image, :description)";
	// This allows caching of statements and optimized queries
	$ingredient_stm = $dbh->prepare ( $sql_ingredient );
	foreach ( $ingredients as $ing ) {
		testedInsertIngredient( $ing, $ingredient_stm );
	}
}

function testedInsertIngredient($ing, $ing_stm) {
	global $dbh;
	if (! $ing_stm->execute ( array (
			':ingredient_name' => $ing['Name'],
			':image' => $ing ['Image'],
			':description' => $ing ['Description'],
	) )) {
		echo '<pre class="bg-danger">';
		print_r ( $dbh->errorInfo () );
		echo '</pre>';
	}
}
?>
