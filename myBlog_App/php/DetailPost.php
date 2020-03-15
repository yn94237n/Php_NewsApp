<?php
    session_start();

	#include the connection string
	include('../include/connection.inc');
?>
<?php
$postId = $_GET['postId'];
#$postId = 1;
$sql = "SELECT * FROM T_Posts WHERE Post_ID = " . $postId . "";

#execute the query
$rs = mysqli_query($conn,$sql);
$count=mysqli_num_rows($rs);

?>
<!-- Start HTML  -->
<html>
<!-- Start Head  -->
<head>
    <title>.: My Blog App :.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../css/styles.css">
    
     <!-- Compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</head>
<!-- Start Body -->
<body>

<div class="">
        
        <div>
            <?php 
            include('navBar.php');
            ?>

            <div class="row">
                <div class="col s12 m8 l9">
                    <div class="container">
                        
                        <!--<div class="home">-->
                        <div class="postContainer">
                        <?php
                        
                        if($count != 0) {
                            while ($row = mysqli_fetch_array($rs) )
                            {
                                echo "<div class='post'>";
                                    echo "<h4>" . $row["Post_Title"] . "</h4>";
                                    echo "<div class='postInfo'>";
                                        echo "<span class='ByClass'>By</span><span class='Author'> Yerson E. Nieto</span>";
                                        echo "<br></br>";
                                        echo "<span class='postDate'>" . $row["Post_Date"] . "</span>";
                                    echo "</div>";
                                    echo "<div class='imagePost'>";
                                        echo "<img class='responsive-img' src='../images/". $row["Post_Img"]. "' alt='' />";
                                    echo "</div>";
                                    echo "<div class='postBody'>";
                                        echo "<p>" . $row["Post_Body"]. "</p>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }
                        ?>
                        <div style="text-align:center;">
                            <a class="waves-effect light-blue darken-4 btn-small" href="../index.php">Go Back</a>
                        </div>
                        </div>
                        <!--</div>-->
                    </div>
                </div>
                <div class="col s12 m4 l3 grey lighten-2">
                    <div>
                    <?php   
                        include('RightSectionNews.php');
                    ?>
                    </div>
                    <div class="publicSpot">
                        <div class="rightSide_Public">
                            <div class="publicBox card grey lighten-4">
                                <div class="card-content">
                                    <span class="card-title orange-text text-darken-4">Want to be here?</span>
                                    <p class="grey-text text-darken-3">
                                    Just click on the link below to contact me and I'll be reaching you out 
                                    with the requisites you need to be part of our great community.
                                    </p>
                                </div>
                                <div class="card-action">
                                    <a href="#"><span class="contactMeLink">Contact Me</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <footer class="page-footer orange">
                <div class="footer-copyright">
                    <div class="container">
                        Made by <a class="orange-text text-lighten-3">YENJ SOLUTIONS</a>
                    </div>
                </div>
            </footer>

        </div>
               
</div>

</body>
<!-- End Body -->
</html>
<!-- End Html -->
