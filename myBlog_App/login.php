<?php
    session_start();
?>

<!-- Start HTML  -->
<html>
<!-- Start Head  -->
<head>
    <title>.: My Blog App :.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/styles.css">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- BootStrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<!-- Start Body -->
<body style="background:#3b3b3b;" >

    <div class="container">
        <div style="padding-top:150px;">
            <h2>Login to your account</h2>
            <div class="panel panel-primary">
                <div class="panel-heading">The Iformative</div>
                <div class="panel-body">
                    Sign in to your account to add a new post or update an existing one
                    </br></br></br>
                    <?php
                    if(isset($_SESSION["firstname"])) 
                    {
                    ?>
                        <div align="center">
                            <h1>Welcome - <?php echo $_SESSION["firstname"]; ?> </h1> <br />
                            <a href="index.php" id="index">Go To Home</a>
                            <a href="#" id="logout">Logout</a>
                        </div>
                    <?php
                    }
                    else {  ?>
                        <div>
                            <button type="button" name="login" id="login" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login</button>   
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>
<!-- End Body -->
</html>
<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">  
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
                <label>Email</label>
                <input type="text" name="username" id="username" class="form-control" />
                <br />
                <label>Password&nbsp;</label>
                <input type="password" name="password" id="password" class="form-control" />
                <br />
                <button type="button" name="login-button" id="login-button" class="btn btn-warning">Login</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#login-button').click(function(){
        var username = $('#username').val();
        var password = $('#password').val();
        if(username != '' && password != '')
        {
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{username:username, password:password},
                success:function(data){
                    if(data == 'No')
                    {
                        alert("User Name or Password Invalid");
                    }
                    else
                    {
                        $('#loginModal').hide();
                        location.reload();
                    }
                }
            });
        }
        else {
            alert('Both fields are required');
        }
    });
    $('#logout').click(function(){
        var action = "logout";
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action},
            success:function(){
                location.reload();
            }
        });
    });
});
</script>
<!-- End Html -->