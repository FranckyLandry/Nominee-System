<?php



//include './Logic/Institute.php';
include './Logic/Institute.php';



//$institute=new Institute("", "", "", "");
$institute=new Institute();


$date1 = $institute->deadLine_date();

$date_form = date("m,d,Y", strtotime($date1));


if (isset($_POST['submit'])) {
   
//    $security_key = $_POST['f1-Security-key'];
//   $institute->check_Security_Key($security_key);
    
    $school_name = trim($_POST['f1-School-name']);
    $school_name = strip_tags($school_name);
    $school_name = htmlspecialchars($school_name);
    
    
    $school_country = trim($_POST['f1-School-Country']);
    $school_country = strip_tags($school_country);
    $school_country = htmlspecialchars($school_country);
    
    
    $school_per_name = trim($_POST['f1-Contact-Person-name']);
    $school_per_name = strip_tags($school_per_name);
    $school_per_name = htmlspecialchars($school_per_name);

    $school_email = trim($_POST['f1-email']);
    $school_email = strip_tags($school_email);
    $school_email = htmlspecialchars($school_email);

    $student_first_name = trim($_POST['f1-First-name']);
    $student_first_name = strip_tags($student_first_name);
    $student_first_name = htmlspecialchars($student_first_name);

    $student_last_Name = trim($_POST['f1-last-name']);
    $student_last_Name = strip_tags($student_last_Name);
    $student_last_Name = htmlspecialchars($student_last_Name);

    $student_email = trim($_POST['f1-Student-email']);
    $student_email = strip_tags($student_email);
    $student_email = htmlspecialchars($student_email);
    
}

