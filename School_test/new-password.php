<?php
            session_start();
            require_once './authenti.php';

             $temp_user_update_pass  =   new authenti();
             $label_info=NULL;
             
             if (isset($_POST['update'])) {
                 
                    if(!empty($_SESSION['user_login'])){

                        $old_pass   = $temp_user_update_pass->cleanData(filter_var($_POST['old-password']), FILTER_SANITIZE_STRING);
                        $new_pass   = $temp_user_update_pass->cleanData(filter_var($_POST['new-password']), FILTER_SANITIZE_STRING);

                        $updated    = $temp_user_update_pass->update_NewPassword($old_pass, $new_pass,$_SESSION['user_login']);
                        
                        if ($updated) {
                            
                                    header('Location: institute.php');
                        }else{
                            
                                $label_info="An error occure. Please try again! ";
                        }
                        
                 
                 }else{
                       $label_info="You are not login !"; 
                 }
            }

?>


<html lang="en">


    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Institute</title>

        <!-- CSS -->

        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <link rel="stylesheet" href="css/check_upload.css">


        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/bootstrap-theme.css">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/bootstrap-theme.css.map">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css.map">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/bootstrap.css">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/bootstrap.css.map">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/bootstrap.min.css.map">

        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/js/bootstrap.js">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/js/bootstrap.min.js">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/js/npm.js">



        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/js/bootstrap.js">
        <link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css.map">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

       


        <link rel="stylesheet" href="Institute_Countdownstyle/css.css" >

        <link rel="android-chrome-192x192" sizes="192x192" href="assets/ico/android-chrome-192x192.png">
    </head>
    <body>

        <!-- Top menu -->

        <nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
            <div class="container">
                <div class="navbar-header" >

                    <a class="navbar-brand" href="LogForeign.php"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="top-navbar-1">

                    <ul class="nav navbar-nav  navbar-left"></ul>
                    <ul class="nav navbar-nav navbar-right">

                    </ul>
                </div>
            </div>
        </nav>


        <div class="top-content">
            <div class="container">

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1 style="color: #663366">Fontys Hogeshool ICT </h1>
                        <div class="description">
                       	    <p style="color: #663366">

                                <strong>FONTYS English Stream</strong>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">

                        <form role="form" action="new-password.php" method="POST" class="f1">

                            <h3 style= color:#663366>New Password </h3>
                            <!--<p>The new <strong>password</strong> will be send to your e-mail</p>-->

                            <div class="f1-steps">
                                <div class="f1-step active">

                                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                                    <p>PASSWORD</p>
                                </div>
                                <label style="color: red"> <?php echo $label_info;  ?></label>
                            </div>

                            <fieldset>
                                <h4>Enter the password sent to you via e-mail:</h4>

                                <div class="form-group ">
                                    <input  type="password" value =""  name="old-password" placeholder="Password received via e-mail..." class="f1-Security-key form-control">
                                    
                                     &nbsp;
                                     <h4>Enter the new password :</h4>
                                     <input  type="text" value =""  name="new-password" placeholder="Your new Password..." class="f1-User-E-mail form-control" id="f1-User-E-mail">
                              
                                </div>

                                &nbsp;
                                
                                <div class="f1-buttons">
                                    <button name="update" type="submit" class="btn  btn-submit">SUBMIT</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>

            </div>
        </div>



        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js" defer></script>
       
    </body>

</html>

