<nav class="nav-wrapper indigo darken-4">
    <!--<div class="container">-->
    <a class="brand-logo hide-on-med-and-down">
        &nbsp;&nbsp;
        <img class="responsive-img" src="../images/MyLogo.png" alt="" height="90%" />
    </a>
        <ul id="nav-mobile" class="right">  
            <li><a href="../index.php">Home</a></li>
            <?php 
            if (isset($_SESSION["firstname"])) { 
            ?>
                <li><a href="NewPost.php">New Post</a></li>
                <li><a href="SearchPosts.php">Update Post</a></li>
                <li><a href="../Logout.php" id="logout">Logout</a></li>
            <?php 
            } 
            else { ?>
                <li><a href="../login.php" id="login">Login</a></li>
            <?php 
            } 
            ?>
        </ul>
    <!--</div>-->
</nav>