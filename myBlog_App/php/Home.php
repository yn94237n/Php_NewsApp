<?php
#include the connection string
include('../include/connection.inc');

session_start();

	
?>
<?php

$sql = "SELECT * FROM T_Posts WHERE Post_Status = 1 ORDER BY Post_Date desc LIMIT 5";

#execute the query
$rs = mysqli_query($conn,$sql);

?>
<!-- Start HTML  -->
<html>
<!-- Start Head  -->
<head>
    <title>Local News</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../css/styles.css">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
        $(document).ready(function(){
            $(".sidenav").sideNav();
        });
    </script>

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
                        <div class="section no-pad-bot">
                            <h3 class="header indigo-text text-darken-4">
                                NEWS
                            </h3>
                            <div class="row">
                                <h6 class="header col s12 light">
                                    The most updated news about entertainment, science, health, sports, and more.                      
                                </h6>
                            </div>
                        </div>
                        <div class="home">
                            <div class="">
                            <?php
                                #little loop to list out all of the records in the result set
                                while ($row = mysqli_fetch_array($rs) )
                                {
                                    echo("<div class='post card'>");
                                        echo("<div class='card-content'>");
                                        echo("<a href=DetailPost.php?postId=" . $row["Post_ID"] . ">");
                                            echo("<img src='../images/" . $row["Post_Img"] . "' alt='Not Found.' />");
                                            echo("<span class='card-title'>" . $row["Post_Title"] . "</span>");
                                        echo("</a>");
                                        echo(" <span class='postDate'>" . $row["Post_Date"] . "</span>");
                                        echo(" <p>" . $row["Post_Preview"] . "</p>");
                                        echo("</div>");
                                    echo("</div>");
                                }
                            ?>    
                            </div>
                        </div>
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