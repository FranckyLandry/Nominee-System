<?php
require 'core/init.php';
    $label_info = NULL;

        if (isset($_POST['savedata'])) {
            
           
            
                $new_user = new authenti();
                
                
//                die('sjfhjkosdhjhg');
                $schoolname = $new_user->cleanData(filter_var($_POST['f1-School-name'],FILTER_SANITIZE_STRING)) ;
                $address_to_send =$new_user->cleanData(filter_var($_POST['address'],FILTER_SANITIZE_STRING));
                
                $country = $new_user->cleanData(filter_var($_POST['f1-School-Country'],FILTER_SANITIZE_STRING)) ;
                
                $contact_pers = $new_user->cleanData(filter_var($_POST['f1-Contact-Person-name'],FILTER_SANITIZE_STRING)) ;
                
                $school_password = $new_user->cleanData(filter_var($_POST['f1-School-pasword'],FILTER_SANITIZE_STRING));
                
                $contact_email=$_POST['f1-email'];
                                       
                $register = $new_user->register($schoolname, $country, $contact_pers, $school_password,$contact_email,$address_to_send);
                
                if ($register) {
                    
                        header('Location: LogForeign.php');
                        
                }  else {
                        
                        $label_info = $new_user->labe_error;
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
        <!--<link rel="stylesheet" href="BootstrapDownload/bootstrap-3.3.7-dist/css/">-->


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
                        <li>
                            <span class="li-text" >
                                 <strong> 
                                     <a class="btn btn-link btn-info" style="color: #ffffff" href="LogForeign.php">HOME</a>
                                </strong>
                            </span> 

                        </li>
                        
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
                                WELCOME TO THE REGISTRATION PAGE 
                             
                            <div id="result">

                            </div>

                            <!--</p>-->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">

                        <form role="form" action="Registration.php" method="post" class="f1"  enctype="multipart/form-data">

                            <h3 style= color:#663366>University form. After registering an E-mail will be send to you. </h3>
                            <p>Fill in the form</p>

                            <p style="color: red"><?php echo $label_info ?></p>
                            <div class="f1-steps">


                                <div class="f1-step active">
                                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                                    <p>User Information</p>
                                </div>

                            </div>
                            

                            <fieldset>
                                <!--<h4>User Login:</h4>-->

                                <div class="form-group">
                                    <label class="sr-only" for="f1-School-name">School Name</label>
                                    <input type="text" name="f1-School-name" placeholder="School Name..." class="f1-School-name form-control" id="f1-School-name">
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="f1-School-country">School Country</label>
                                    <input type="text" name="f1-School-Country" placeholder="School Country..." class="f1-School-Country form-control" id="f1-School-Country">
                                </div>


                                <div class="form-group">
                                    <label class="sr-only" for="f1-Contact-name">Contact Person name</label>
                                    <input type="text" name="f1-Contact-Person-name" placeholder="Contact Person name..." class="f1-Contact-Person-name form-control" id="f1-Contact-Person-name">
                                </div>
                                
                                <div class="form-group">
                                    <textarea rows="4" name="address" cols="64" placeholder="Address Fontys will send the transcript after the student has finished ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="f1-email">Email</label>
                                    <input type="email" name="f1-email" placeholder="Email..." class="f1-email form-control" id="f1-email">
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="f1-password">School Country</label>
                                    <input type="text" name="f1-School-pasword" placeholder="password..." class="f1-School-password form-control" id="f1-School-password"> 
                                </div>



                                <div class="f1-buttons">
                                    <button name="savedata" type="submit" style="color: #663366" class="btn btn-default">SAVE</button>
                                 </div>
                                
                                

                            </fieldset>


                        </form>
                      </div>
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






    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>-->
</html>