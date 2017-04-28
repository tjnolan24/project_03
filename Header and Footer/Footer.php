<div class="footer">
<p><?php 
    if (isset($_SESSION["userName"])){
        echo 'Signed in as <a href="../Login/Login.php">' . $_SESSION["userName"] . '</a> | ';
    }
    else {
        echo '<a href="../Login/Login.php">Sign in</a> | ';
    }
?> 

This site is part of a CSU <a href="http://cs.colostate.edu/~ct310">CT 310</a> Course Project. </p>
</div>

</body>
</html>
