<?php 
    $pageTitle = "modify";
    include './Control.php';
    include './Support.php';
    include '../Header and Footer/Header.php';
    include '../Header and Footer/Nav.php';
    
    $users = readUsers();
    $user = null;
    require_once '../lib/Database.php';
    $db = new Database();
    foreach($users as $u) {
        
        //get current user
        if (isset($_SESSION['userName']) && ($u->username == $_SESSION['userName'])) {
            $user = $u;
        }
    
    }
    
    //check if information from form has been sent throug post
    if (isset($_POST['ing_id'])) {
    
            $modifiedComment = new Comment();
            $modifiedComment->comment_id = intval($_POST['comment_id']);
            $modifiedComment->comment_text = strip_tags($_POST['message']);
            $modifiedComment->user = strip_tags($_POST['user']);
            $modifiedComment->timestamp = $_POST['timestamp'];
            $modifiedComment->ip_addr = $_POST['ip_addr'];
            $modifiedComment->ingredient_id = intval( $_POST['ing_id']);
        
            $db->modifyComment($modifiedComment); 
            $prevPage = $_SESSION['ingURL'];
    }
    else {
        $comment = $db->getCommentDetails($_GET['id']);
    }
    
?>

<?php if (!isset($_POST['ing_id']) && (isAdmin($user))) : ?>
<div class="container-fluid wasabi-container">
    <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
    <div class="col-md-8 content">
        <!-- Show admin form to modify the comment -->
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="user">Username</label>
                <div class="col-sm-2">
                
                    <input type="text" class="form-control" name="user" id="user"
                            value="<?php echo $comment->user ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="message">Message</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="message" id="message"
                            value="<?php echo $comment->comment_text ?>" /> <input type="hidden"
                            name="comment_id" value="<?php echo $comment->comment_id ?>" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <input type="hidden" name="ip_addr" id="ip_addr"
                            value="<?php echo $comment->ip_addr ?>" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <input type="hidden" name="timestamp" id="timestamp"
                            value="<?php echo $comment->timestamp ?>" />
                </div>
            </div>
            <input type="hidden" name="ing_id" value="<?php echo $comment->ingredient_id; ?>" />
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
</div>



<!-- USER IS NOT ADMIN -->
<?php elseif (!isAdmin($user)) : ?>
    <div class="container-fluid wasabi-container">
        <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
        <div class="col-md-8 content">
            <p>You must be an admin to modify comments!</p>
        </div>
        <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
    </div>

<?php else : ?>
   <div class="container-fluid wasabi-container">
        <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
        <div class="col-md-8 content">
            <p>Comment has been modified</p>
            <p><a href= <?php echo "$prevPage"?> >Go Back</a></p>
        </div>
        <div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
    </div>

<?php endif; ?>


<?php include '../Header and Footer/Footer.php'; ?>
