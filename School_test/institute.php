
<?php
session_start();
require_once './authenti.php';


        $label_error= NULL;

        if (!isset($_SESSION['user_login'])) {
                        header('Location: LogForeign.php');
        } else {
            
                        $institute = new authenti();


                        $date1 = $institute->getuser_class()->deadLine_date();

                        $date_form = date("m,d,Y", strtotime($date1));
                        $semester1 = '';
                        $semester2 = '';


            if (isset($_POST['submit'])) {
                
                        $student_first_name = $institute->cleanData(filter_var($_POST['f1-first-name']), FILTER_SANITIZE_STRING);
                        $student_last_Name  = $institute->cleanData(filter_var($_POST['f1-last-name']), FILTER_SANITIZE_STRING);
                        $student_email      = $institute->cleanData(filter_var($_POST['f1-email']), FILTER_SANITIZE_STRING);

                        
                if (isset($_POST['semester2'])) {
                        $semester2 = $_POST['semester2'];
                } else {
                        $semester2 = "No Selections is made";
                }
                if (isset($_POST['semester1'])) {
                        $semester1 = $_POST['semester1'];
                }

                $prof_english_file          = $_FILES['proof_English'];
                $prof_transcript_file       = $_FILES['score_transcript'];
                $file_Proof_english_name    = $prof_english_file['name'];
                $file_transcript_score_name = $prof_transcript_file['name'];

                /*
                 * Checking of the extensions before keeping going
                 */
                $file_Proof_english_extension      = $institute->getuser_class()->check_Uploads_extension($file_Proof_english_name);
                $file_transcript_score_extension   = $institute->getuser_class()->check_Uploads_extension($file_transcript_score_name);

                if (!$file_Proof_english_extension || !$file_transcript_score_extension) {

                            $label_error = "AN EROOR APPEARED,PLEASE SELECT A PDF FILE";
                } else {
                    
                            $institute->getuser_class()->moveToFolder($prof_english_file, $prof_transcript_file);
                    
                            
                            $contatct_email         = $_SESSION['user_login'];
                            $array_info_school      = $institute->getuser_class()->get_schoolInfo($_SESSION['user_login']);
                            
                                    $school_name    = $array_info_school['school_name'];
                                    $country        = $array_info_school['country'];
                                    $contact_name   = $array_info_school ['contact_perso_name'];
                            
                            
                            

                            $institute->getuser_class()->saveStudentInfo($student_first_name, $student_last_Name, $student_email, 
                                                                         $school_name,$country,$contact_name, $contatct_email, 
                                                                         $file_Proof_english_name, $file_transcript_score_name, $semester1, $semester2);
                            
//                                $email = new PHPMailer();
//                                $email->From = 'testNominee@ya.com';
//                                $email->FromName = 'Nominee System';
//                                $email->Subject = 'New Nominee';
//
//                                $email->Body = "Dear Coordinator,\n\n";
//                                $email->Body.="Here is information about a Potential student:\n\n";
//                                $email->Body.="School Information:\n";
//                                $email->Body.="School Name:      " . $school_name . "\n";
//                                $email->Body.= "School Country:  " . $country . "\n";
//                                $email->Body.= "School Contact : " . $contact_name . "\n\n";
//
//                                $email->Body.="Student Information:\n";
//                                $email->Body.="Student Name:        " . $student_first_name . "\n";
//                                $email->Body.= "Student Last Name:  " . $student_last_Name . "\n";
//                                $email->Body.= "Student E-mail :    " . $student_email . "\n\n";
//
//
//                                $email->Body.= "\n\nPrograms Semester 1: " . "\n";
//                                $email->Body.= " " . $semester1 . "\n";
//
//                                $email->Body.= "\n\nPrograms Semester 2: " . "\n";
//                                $email->Body.= " " . $semester2 . "\n";
//
//
//
//                                $email->Body.="\n\n Kind Regards \nNominee Team";
//
//                            $email->AddAddress($institute->get_Email_Tosend_To());
//
//                            $folder1    = '../Uploads/' . $file_Proof_english_name;
//                            $folder2    = '../Uploads/' . $file_transcript_score_name;
//
//
//                            $email->AddAttachment($folder1, "" . $file_Proof_english_name);
//                            $email->addAttachment($folder2, "" . $file_transcript_score_name);
//                            $tryi = $email->Send();
//                            if (!$tryi) {
//                                echo $email->ErrorInfo;
//                            }else{

                             $label_error="The Student is successfully Nominated";
//                            $session_unset = session_unset();
//                            $answer = session_destroy();
//
//                            header('Location: LogForeign.php');

//                    }

                }
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

                    <a class="navbar-brand" href=""></a>
                            <span class="li-text" style="color: #ffffff">
                                <strong> &nbsp;Beware the Submission deadline is in
                                    <div id="countdown"> here </div>
                                </strong>
                            </span>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="top-navbar-1">

                    <ul class="nav navbar-nav  navbar-left"></ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <span class="li-text" style="color: #ffffff">
                                <label>
                                    <form action="LogForeign.php" method="POST">
                                        <button class="btn btn-link" name="logout"  style="color: #ffffff" href="LogForeign.php">LOGOUT&nbsp;&nbsp;</button>
                                    </form> 
                                </label>
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
                                This page is for University that wish to nominate students to come to study at 
                                <strong>FONTYS English Stream</strong>
                                 
                                <label style="color: red"><?php echo $label_error;   ?></label>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">

                        <form role="form" action="institute.php" method="post" class="f1"  enctype="multipart/form-data">

                            <h3 style= color:#663366>University form </h3>
                            <p>Fill in the form</p>

                            <div class="f1-steps">
                                <div class="f1-progress">
                                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                                </div>
                                <div class="f1-step ">

                                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                                    <p>Security Key</p>
                                </div>
                                <!--                                <div class="f1-step active">
                                                                    <div class="f1-step-icon"><i class="fa fa-bank"></i></div>
                                                                    <p>School information</p>
                                                                </div>-->

                                <div class="f1-step active ">
                                    <div class="f1-step-icon"><i class="fa fa-bank"></i></div>
                                    <p>Student Information</p>
                                </div>



                                <div class="f1-step">

                                    <div class="f1-step-icon"><i class="fa fa-cloud-upload"></i></div>
                                    <p>Files Needed</p>

                                </div>
                            </div>



                            <fieldset>
                                <h4>Student Information</h4>

                                <div class="form-group">
                                    <label class="sr-only" for="f1-first-name">First name</label>
                                    <input type="text" name="f1-first-name" placeholder="First name..." class="f1-first-name form-control" id="f1-first-name">
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="f1-last-name">Last name</label>
                                    <input type="text" name="f1-last-name" placeholder="Last name..." class="f1-last-name form-control" id="f1-last-name">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-email">Email</label>
                                    <input type="text" name="f1-email" placeholder="Email..." class="f1-email form-control" id="f1-email">
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>


                            </fieldset>

                            <fieldset>
                                <h4>Documents and Programs needed.</h4>
                                <h6 style="color: red">Beware that semester <strong>one </strong> is <strong>mandatory</strong></h6><br/>



                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>SEMESTER 1  .....</h4> 
                                        <div class="form-group">
                                            <select class="btn" name="semester1"  > 

                                                <?php
                                        $institute->getuser_class()->retrieveProgram_s1($date1);
                                                ?>
                                            </select>

                                        </div>
                                    </div>



                                    <div class="col-sm-4">
                                        <h4>SEMESTER 2  .....</h4> 
                                        <div class="form-group">
                                            <select class="btn" name="semester2">  
                                                <option name='semester2' value=''>NO SELECTION</option>;
                                                <?php
                                        $institute->getuser_class()->retrieveProgram_s2($date1);
                                                ?>
                                            </select>       

                                        </div>
                                    </div>
                                </div>
                                <p> <br/> <br/></p>
                                <label style="color: #663366" >&nbsp;&nbsp;&nbsp;PLEASE SELECT A PDF FILE </label>
                                <div class="row">       
                                    <div class="col-sm-6">
                                        <h4>Proof of English.</h4> 
                                        <input type="file" name="proof_English">
                                    </div>


                                    <div class="col-sm-5">
                                        <h4>Transcript of score.</h4> 

                                        <input  type="file" name="score_transcript" style="visibility: ">
                                    </div>

                                </div>   

                                <br/><br/> <br/>

                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="submit" name="submit" class="btn btn-submit">Submit</button>
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
                window.location = "LogForeign.php";
                
            }
        }, 1000);




//uploads message

        function myFunction() {
            var popup = document.getElementById('myPopup');
            popup.classList.toggle('show');
        }




    </script>

</html>