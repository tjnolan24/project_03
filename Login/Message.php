<div class="commenting">

        <!-- Add comment to database -->
        <?php 
        
            if (isset($_POST['message'])) {
                $id = $db->getNextCommentID();
                $ing_id = $ingredient["ingredient_id"];
                $comment = new Comment();
                $comment->comment_text = strip_tags($_POST['message']);
                $comment->user = $_SESSION['userName'];
                $comment->timestamp = $_SERVER['REQUEST_TIME'];
                $comment->ip_addr = $_SERVER['REMOTE_ADDR'];
                $comment->ingredient_id = intval($ing_id);
                
                $db->insertComment($comment);
                
            }
        
        ?>
        
            
        <!--Display comments-->
	<hr>
	<h3>Comments</h3>
	<ul class="list-group">
		<?php 
                        $_SESSION['ingURL'] = $_SERVER['REQUEST_URI'];
			$page_comments = $db->retrieveComments($ingredient["ingredient_id"]);
			if (count($page_comments) == 0) {
                            echo "No comments to show";
                        }
                        else {
                            foreach($page_comments as $comment) { ?>
                            <li class="list-group-item comment">
                                <?php $id = $comment->comment_id; ?>
                                <a class="btn default-btn" href="<?php echo "../Login/modify.php?id=$id"?>"> <span class="glyphicon glyphicon-pencil" aria-label="Edit"></span> </a>
                                <a class="btn default-btn" href="<?php echo "../Login/delete.php?id=$id"?>"> <span class="glyphicon glyphicon-remove" aria-label="Delete"></span> </a>
                                <?php echo '<span class="username">' . $comment->user . '</span>';?>  
                                <?php echo '<span class="message"><br><hr>' . $comment->comment_text . '</span></li>';
                            }
                        }
		?>
	</ul>
	
<?php if (!isset($_SESSION['userName']) || ($_SESSION['userName'] == "Guest")) : ?>
	<p><a href="../Login/Login.php">Sign in</a> to comment</p>
<?php else: ?>
	<form action="#" method="post">

		<textarea class="form-control" rows="3" placeholder="Write your comment..." name="message"></textarea>
		<?php echo '<button class="btn btn-default" role="button" type="submit" name="submit">Submit</button><span class="signed-in">Signed in as: ' . $_SESSION['userName'] . '</span>' ?>
	</form>
<?php endif; ?>
</div>
