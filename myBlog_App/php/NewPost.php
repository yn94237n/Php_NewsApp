<?php
session_start();
    
#include the connection string
include('../include/SessionActive.php');
include('../include/connection.inc');
include('../include/MyLibrary.php');
    
$postDate = todaysDate();
$title = '';
$status = '';
$preview = '';
$body = '';
    
?>
<?php

//Check if the form has been submitted
if(isset($_POST['submit'])){

    #echo("Form Submitted...!<br>");
    #print_r($file);
    
    
   //initialize an error array
   $errors=array();

   $date = trim($_POST['post_date']);

   //Check for post title
   if(empty(trim($_POST['post_title']))) {
      $errors[]= 'You forgot to enter the post title.';
      $error_title = 'You forgot to enter the post title red.';
      $title = trim($_POST['post_title']);
   }else {
      $title = str_replace("'", "", trim($_POST['post_title']));
      $error_title = '';
   }

   if(isset($_POST['post_status']) && $_POST['post_status'] == 'on') {
        $status = 1;
    } else {
        $status = 0; 
    }

   //Check for post preview
   if(empty(trim($_POST['post_preview']))) {
      $errors[]= 'You forgot to enter the post preview.';
      $error_preview = 'You forgot to enter the post preview.';
      $preview = trim($_POST['post_preview']);
   }else {
        $preview = str_replace("'", "", trim($_POST['post_preview']));
        $error_preview = '';
   }

   //Check for post preview
    if(empty(trim($_POST['post_body']))){
        $errors[] = 'You forgot to enter the post body.';
        $error_body = 'You forgot to enter the post body.';
        $body = trim($_POST['post_body']);
    }else {
        $body = str_replace("'", "", trim($_POST['post_body']));
        $error_body = '';
    }

    if(empty($_FILES['post_img']['name'])) {
        $errors[] = 'You forgot to select the post image.';
        $error_img = 'You forgot to select the post image.';
    } else {
        $error_img = ""; 
    }

    // If everything' s OK  register the user in the database
    if (empty($errors)) {

        if(!empty($_FILES['post_img']['name'])) {
            $file_name = $_FILES['post_img']['name'];
            $file_tem_loc = $_FILES['post_img']['tmp_name'];
            $file_store = "../images/".$file_name;
            move_uploaded_file($file_tem_loc, $file_store);
        }

        //set up the SQL statement
        $sql = "INSERT INTO `T_Posts` (Post_Title, Post_Date, Post_Preview, Post_Body, Post_Status, Post_Img, User_ID) VALUES ('" .$title. "','" .$postDate. "','" .$preview. "','" .$body. "'," .$status. ", '" .$file_name. "'," .$_SESSION["userid"].")";
        #echo($sql);
        #exit();
        #die();
            
        //this will run the SQL statement against your database
		$rs = mysqli_query($conn,$sql);

		//the database will return a true or false. If it's true, then you know the SQL ran okay.
		if($rs){
            header("Location: NewPost.php?success=1");
			echo("Record has been Recorded. <br/>");
		}else{     //if it did not run OK.Public message:
			echo'<h1>System Error</h1>
			<p> An error has occurred. We apologize for any inconvenience.</p>';
			echo '<p>  ' . mysqli_error($conn) . '
			<br/> <br/>Query: '.$sql. '
			</p>';
        }
        
    } else {
        $insertResult = '';
    }
}
else {
    if(isset($_GET["success"])) {
        $success = $_GET["success"];
    } else {
        $success = 0;
    }
    
    $error_title = '';
    $error_preview = '';
    $error_body = '';
    $error_img = '';

    if($success == 1) {
        $insertResult = ' A new record has been added successfully';
    } else {
        $insertResult = '';
    }

    
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
                                Post Content Manager
                            </h3>
                            <div class="row">
                                <h6 class="header col s12 light">
                                    Add a new post and publish it in our timeline.
                                </h6>
                            </div>
                        </div>
                        <div class="home">
                        
                            <div class="row">
                                <div class="col s12">
                                    <h5>
                                        <i class="small material-icons">mode_edit</i>
                                        &nbsp;New Post <span class="successMsg"><?php echo($insertResult); ?></span>
                                    </h5> 
                                </div>
                                
                                <form class="col s12" action="NewPost.php" method="post" enctype="multipart/form-data">
                                    <div class="row">                                        
                                        <div class="input-field col s12">
                                            <label for="post_title">Title</label>
                                            <input id="post_title" name="post_title" type="text" class="validate flow-text" value="<?php echo($title); ?>">
                                            <span class="error"><?php echo($error_title); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s2">
                                            <input id="post_date" name="post_date" type="text" class="validate flow-text" readonly value="<?php echo($postDate); ?>">
                                            <label for="post_date">Post Date</label>
                                        </div>
                                    <!--</div>
                                    <div class="row">-->
                                        <div class="input-field col s10">
                                            <label for="post_preview">Preview</label>
                                            <input id="post_preview" name="post_preview" type="text" class="validate flow-text" value="<?php echo($preview); ?>">
                                            <span class="error"><?php echo($error_preview); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <label for="post_body">Body</label>
                                            <textarea id="post_body" name="post_body" class="materialize-textarea flow-text"> <?php echo($body); ?> </textarea>
                                            <span class="error"><?php echo($error_body); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <div class="file-field input-field">
                                                <div class="btn">
                                                    <span>Image File</span>
                                                    <input type="file" name="post_img" id="post_img" />
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" />
                                                    <span class="error"><?php echo($error_img); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                        <label>
                                            <input name="post_status" type="checkbox" class="filled-in" <?php if($status == 1) { echo("checked='checked'"); } ?> />
                                            <span>Post Active</span>
                                        </label>
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="input-field col s12" style="text-align:center;">
                                            <a class="waves-effect light-blue darken-4 btn-small" href="SearchPosts.php">Go Back</a>
                                            &nbsp;&nbsp;
                                            <input type="submit" name="submit" text="Submit">
                                        </div>
                                    </div>
                                </form>
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
