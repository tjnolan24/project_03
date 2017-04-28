<?php
class Comment{

    public $comment_id;
    public $comment_text;
    public $user;
    public $timestamp;
    public $ip_addr;
    public $ingredient_id;
    
    
    public static function getCommentFromRow($row) {
        $comment = new Comment();
        $comment->comment_id = $row['comment_id'];
        $comment->comment_text = $row['comment_text'];
        $comment->user = $row['user'];
        $comment->timestamp = $row['timestamp'];
        $comment->ip_addr = $row['ip_addr'];
        $comment->ingredient_id = $row['ingredient_id'];
        
        return $comment;
    
    
    }
    
    function __toString() {
        return $this->comment_text;
    }
    
}
