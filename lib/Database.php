<?php
require_once("Comment.php");

class Database extends PDO {
	public function __construct() {
		parent::__construct ( "sqlite:" . __DIR__ . "/../Index/ingredients.db" );
	}
	function getNumberOfIngredients() {
		$ing_num = $this->query ( "SELECT count(*)  FROM ingredient" );
		return $ing_num->fetchColumn ();
	}
	/** 
	 * Functions used by the select page to sort ingredients 
	 */
	function getIngredients() {
                $sql = "SELECT * FROM ingredient";
  		return $this->query($sql);
		
	}
	
        function getCart() {
                $sql = "SELECT * FROM shopingCart";
  		return $this->query($sql);
		
	}
	/**
	 * Functions needed for the search example *
	 */
	function getImage($ing_name) {
		
		$sql = "SELECT image FROM ingredient WHERE ingredient_name == '$name'";
		$result = $this->query ( $sql );
		return $result->fetchColumn ();
	}
	
	function retrieveIngredient($name) {
	
                $sql = "SELECT * FROM ingredient WHERE ingredient_name == '$name'";
                $result = $this->query( $sql );
                return $result->fetch();
	}
	
	function retrieveComments($ing_id) {
	
                $sql = "SELECT * FROM comments WHERE ingredient_id = '$ing_id'";
                $result = $this->query( $sql );
                
                $comments = array();
                foreach($result as $row) {
                    $comments[] = Comment::getCommentFromRow( $row );
                }
                
                return $comments;
	}
	
	function deleteComment($comment) {
            
            $sql = "DELETE FROM comments WHERE comment_id == '$comment'";
            if ($this->exec ( $sql ) === FALSE) {
			echo '<pre class="bg-danger">';
			print_r ( $this->errorInfo () );
			echo '</pre>';
			return FALSE;
		}
		return TRUE;
	
	}
	
        function deleteItem($comment) {
            
            $sql = "DELETE FROM shopingCart WHERE ingredient_id == '$comment'";
            if ($this->exec ( $sql ) === FALSE) {
			echo '<pre class="bg-danger">';
			print_r ( $this->errorInfo () );
			echo '</pre>';
			return FALSE;
		}
		return TRUE;
	
	}
	
	function getNextCommentID() {
                $sql = "SELECT count(*) FROM comments";
                $result = $this->query($sql);
                return $result->fetchColumn() + 1;
	}
	
	function insertComment($newComment) {
                $sql = "INSERT INTO comments (comment_text, user, timestamp, ip_addr, ingredient_id)
                        VALUES(:text, :user, :time, :ip, :ing_id)";
                $stm = $this->prepare( $sql );
                return $stm->execute( array (
                                        ":text" => $newComment->comment_text,
                                        ":user" => $newComment->user,
                                        ":time" => $newComment->timestamp,
                                        ":ip" => $newComment->ip_addr,
                                        ":ing_id" => $newComment->ingredient_id
                ) );
	
	
	}

	
        function insertCart($Item) {
                $sql = 	$sql_ingredient = "INSERT INTO shopingCart (ingredient_name, image, description)
									 VALUES (:ingredient_name, :image, :description)";
									 
                
                $stm = $this->prepare( $sql );
                return $stm->execute( array (
                            ":ingredient_name" => $Item->ingredient_name,
                            ":image" => $Item->image,
                            ":description" => $Item->description,
                ) )
                ;
	
	
	}
	
	function deleteCart() {
           
            $this->exec("DELETE FROM shopingCart");
            
	}
	
	function cartIsEmpty() {
            $sql = "SELECT count(*) FROM shopingCart";
            
            $result = $this->query($sql);
            $numItems = $result->fetchColumn();
            
            return ($numItems == 0);
	
	}
	
	function insertIngedient($Item) {
                $sql = 	$sql_ingredient = "INSERT INTO ingredient (ingredient_name, image, description)
									 VALUES (:ingredient_name, :image, :description)";     
                $stm = $this->prepare( $sql );
                return $stm->execute( array (
                            ":ingredient_name" => $Item->ingredient_name,
                            ":image" => $Item->image,
                            ":description" => $Item->description,
                ) )
                ;
	
	
	}
	
	function getCommentDetails($com_id) {
            
            $sql = "SELECT * FROM comments WHERE comment_id == '$com_id'";
            $result = $this->query($sql);
            
            return Comment::getCommentFromRow($result->fetch());
	
	}
	
	function modifyComment($newCom) {
            
            
            $sql = "UPDATE comments SET comment_text = :text, user = :user WHERE comment_id == :id";
            
            $stm = $this->prepare ( $sql );
            return $stm->execute( array (
                                    ":text" => $newCom->comment_text,
                                    ":user" => $newCom->user,
                                    ":id" => $newCom->comment_id
            ) );
	
	
	
	}
	
        public function saveImage($imgArray, $ext){
        
		$sql = "INSERT INTO images (name, type, size, ext) VALUES (?,?,?,?)";
		$stm = $this->prepare($sql);
		$values = array(
			$imgArray["name"],
			$imgArray["type"],
			$imgArray["size"],
			$ext		
		);
		if($stm->execute($values) === FALSE){
			return -1;
		}else{
			return $this->lastInsertId("id");
		}
	}
	
	
}
