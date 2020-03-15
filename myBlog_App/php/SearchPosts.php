<?php
session_start();
#include the connection string
include('../include/connection.inc');
include('../include/SessionActive.php');

?>
<?php

$count = 0;
if(isset($_POST['submit'])) {
    if(trim($_POST['postTitle']) !== "") 
    {

        $Post_Title = $_POST["postTitle"];
        //echo("Post Title = " . $Post_Title . "<br>");
        $sql = "SELECT * FROM T_Posts WHERE Post_Title LIKE '%" . $Post_Title . "%' AND USER_ID = " .$_SESSION["userid"]. " ORDER BY Post_Date desc";
        #execute the query
        //echo $sql . "<br>";
        $rs = mysqli_query($conn,$sql);
        $count=mysqli_num_rows($rs);
    }
} else {
    $sql = "SELECT * FROM T_Posts WHERE USER_ID = " . $_SESSION["userid"] . " ORDER BY Post_Date desc";
    #execute the query
    //echo $sql . "<br>";
    $rs = mysqli_query($conn,$sql);
    $count=mysqli_num_rows($rs);
}

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

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
                                News Search Engine
                            </h3>
                            <div class="row">
                                <h6 class="header col s12 light">
                                    Search for your news and posts and modify them.                     
                                </h6>
                            </div>
                        </div>
                        <div class="home">
                            <div class="">
                             
                                <div class="row" sytle="padding-top:20px;">
                                    <div class="col s12">
                                        <h5>
                                            <i class="small material-icons">chevron_right</i>
                                            &nbsp;Post Content Manager
                                        </h5>
                                    </div>
                                    <form method="post" action="SearchPosts.php" class="col s12">
                                        <div class="" style="display: inline;">
                                            <div class="input-field">
                                                <input placeholder="Enter the article title" id="postTitle" name="postTitle" type="text" class="validate">
                                                <!--<label for="postTitle">Post Title</label>-->
                                            </div>
                                            <div style="text-align:right;">
                                                <input type="submit" name="submit" text="Submit">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                
                                <?php
                                    
                                    if($count != 0) {
                                        echo "<table class='highlight responsive-table'>";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>ID</th>";
                                                echo "<th>Post Title</th>";
                                                echo "<th>Post Date</th>";
                                                echo "<th>Post Status</th>";
                                                echo "<th>Action</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while ($row = mysqli_fetch_array($rs) )
                                        {
                                            if($row["Post_Status"] == 1) {
                                                $status = "Active";
                                            } else {
                                                $status = "InActive";
                                            }

                                            echo "<tr>";
                                                echo "<td>" .$row["Post_ID"]. "</td>";
                                                echo "<td> <a style='color: black;' title='".$row["Post_Title"]. "'>" .substr($row["Post_Title"],0,20). "... </a></td>";
                                                echo "<td>" .$row["Post_Date"]. "</td>";
                                                echo "<td>" .$status. "</td>";
                                                echo "<td> <a href=UpdatePost.php?postId=" .$row["Post_ID"]. ">Update</a></td>";
                                            echo "</tr>";   
                                        }
                                        echo "</tbody>";
                                    echo "</table>";
                                    }
                                    else If (isset($_POST['submit'])) {
                                        echo("No records found");
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