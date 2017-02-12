
<?php
session_start();

require_once './authenti.php';




$auht_user = new authenti();

$deadline = $auht_user->getuser_class()->deadLine_date();
//
$date_form = date("m,d,Y", strtotime($deadline));


$label_error = NULL;

        if (isset($_POST['logout'])) {
            $auht_user->doLogout();
        }



        if (isset($_POST['securityKey'])) {

            $emai = $_POST['f1-user-e-mail'];

            $password = $auht_user->cleanData(filter_var($_POST["f1-Security-key"], FILTER_SANITIZE_STRING));

            $doLogin = $auht_user->doLogin($emai, $password);
            
            if ($doLogin) {
                
                    header('Location: institute.php');
            }elseif ($auht_user->send_to_newpass) {
                        header('Location: new-password.php');
            } else {

//                    header('Location: LogForeign.php');
                    $label_error = 'ERROR CREDITIALS INCORRECT';
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


        <!-- CSS -->
        <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">-->

        <!-- replacement for localhost purposes-->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"-->
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
                            <span class="li-text" style="color: #ffffff">
                                <strong> Beware the Submission deadline is in
                                    <div id="countdown"> here </div>
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

                                <strong>FONTYS English Stream</strong>
                            <div id="result">

                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">

                        <form role="form" action="LogForeign.php" method="post" class="f1"  enctype="multipart/form-data">

                            <h3 style= color:#663366>University form </h3>
                            <p>Fill in the form</p>
                            <p style="color: red"><?php echo $label_error ?></p>
                            <div class="f1-steps">
                                <div class="f1-progress">
                                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="4" style="width: 16.66%;"></div>
                                </div>
                                <div class="f1-step active">

                                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                                    <p>Security Key</p>
                                </div>

                                <div class="f1-step">
                                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                                    <p>Student Information</p>
                                </div>



                                <div class="f1-step">
<!--                                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>-->
                                    <div class="f1-step-icon"><i class="fa fa-cloud-upload"></i></div>
                                    <p>Files Needed</p>

                                </div>
                            </div>

                            <fieldset>
                                <h4>User Login:</h4>

                                <div class="form-group ">

                                    <input  type="email" value ="" id="securitykey" name="f1-user-e-mail" placeholder="User E-mail..." class="f1-User-E-mail form-control" id="f1-User-E-mail">

                                </div>

                                <div class="form-group ">


                                    <input  type="password" value ="" id="securitykey" name="f1-Security-key" placeholder="Security key..." class="f1-Security-key form-control" id="f1-Security-key">

                                </div>

                                <div class="f1-buttons">
                                    <button name="securityKey" type="submit" class="btn  btn-submit">Submit</button>
                                </div>

                                <div id="browse_app">
                                    <a class="btn btn-link btn-info" style="color: #663366" href="forgot-password.php">Forgot Password ?</a>
                                </div>
                                <div id="browse_app">
                                    <a class="btn btn-link btn-info" style="color: #663366" href="Registration.php">Register</a>
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






    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>-->


    <script>
        var target_date = new Date('<?php echo $date_form ?>').getTime();

// variables for time units
        var days, hours, minutes, seconds;

// get tag element
        var countdown = document.getElementById('countdown');

// update the tag with id "countdown" every 1 second
        setInterval(function () {

            // find the amount of "seconds" between now and target
            var current_date = new Date().getTime();
            var seconds_left = (target_date - current_date) / 1000;

            // do some time calculations
            days = parseInt(seconds_left / 86400);
            seconds_left = seconds_left % 86400;

            hours = parseInt(seconds_left / 3600);
            seconds_left = seconds_left % 3600;

            minutes = parseInt(seconds_left / 60);
            seconds = parseInt(seconds_left % 60);

//            // format countdown string + set tag value
//            countdown.innerHTML = '<span class="days">' + days + ' <b>Days</b></span> <span class="hours">' + hours + ' <b>Hours</b></span> <span class="minutes">'
//                    + minutes + ' <b>Minutes</b></span> <span class="seconds">' + seconds + ' <b>Seconds</b></span>';
            // format countdown string + set tag value
//                countdown.innerHTML = '<span class="days">' + days + ' <b>Days</b></span> ';
            if (target_date > current_date) {


                if (days === 0) {
                    countdown.innerHTML = '<span class="hours">' + hours + ' <b>Hours</b></span> ';
                } else if (hours === 0) {
                    countdown.innerHTML = '<span class="minutes">' + minutes + ' <b>Minutes</b></span> ';
                } else if (minutes === 0) {
                    countdown.innerHTML = '<span class="seconds">' + seconds + ' <b>Seconds</b></span> ';
                } else {

                    countdown.innerHTML = '<span class="days">' + days + ' <b>Days</b></span> ';
                }

            } else {

                countdown.innerHTML = '<span class="days"> <b>Submission deadline passed</b></span> ';

            }
        }, 1000);




//uploads message




    </script>

</html>