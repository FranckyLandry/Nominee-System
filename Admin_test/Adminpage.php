<?php
session_start();

require_once './Admin.php';

//session_start();
//if session is not set this will redirect to login page
//


$admin = new Admin();

$current_mail = $admin->current_Email();
//
$deadline = $admin->submission_Deadline();

$lable_info = '';

        if (!isset($_SESSION['user_login'])) {
            
                header('Location: index.php');
             
        } else {


        if (isset($_POST['save'])) {

                $semester1 = $_POST['SEMESTER1'];


                $semester2 = $_POST['SEMESTER2'];


                $resetEmail = $_POST['reset_email'];


                $admin_passowrd = $_POST['admin_password'];


                $start_Date = $_POST['daterangepicker_start'];

                $start_Date_format = date("Y-m-d", strtotime($start_Date));

                $end_date = $_POST['daterangepicker_end'];

                $end_date_format = date("Y-m-d", strtotime($end_date));
                
                if($end_date_format > $deadline){

                    foreach ($semester1 as $value) {

                        if (!empty($value)) {

                                $admin->setting_Semester_1($value, $start_Date_format, $end_date_format);
                        }
                    }

                    foreach ($semester2 as $value) {

                        if (!empty($value)) {

                                $admin->setting_Semester_2($value, $start_Date_format, $end_date_format);
                        }
                    }

                    $update_Endate = $admin->update_Endate($end_date_format);




                $lable_info = "PERIODE, PROGRAMS AND SECURITY KEY WAS SAVED!";

        }
        if (!empty($admin_passowrd)) {

                $pass_update = $admin->update_Admin_Password($admin_passowrd);
            
                if($pass_update){
                    
                        $lable_info .= "\nTHE  ADMIN PASSWORD WAS UPDATED AND AN EMAIL WAS SEND! ";
                        
                }else{
                    
                        $lable_info .= "\nAN ERROR OCCURE, THE  ADMIN PASSWORD WAS NOT UPDATED! ";
                }
        }
        
        if (!empty($resetEmail)) {

           $mail_update =  $admin->updat_Coordinator_Email($resetEmail);
           
                if($mail_update){
                    
                        $lable_info .= "\nTHE ADMIN EMAIL WAS UPDATED  ";
                }else{
                    
                        $lable_info .= "\nAN ERROR OCCURE, THE  ADMIN EMAIL WAS NOT UPDATED! ";
                }
        }

    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Admine Page</title>

        <!-- Bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
   
        <link rel="stylesheet" type="text/css" href="adminstylecalendar/bootstrap/daterangepicker.css" />
        <link href="" rel="institutestyle/style.css">

    </head>
    <body>

        <p><br/><br/></p>
        <div class="container">
            <div class="collapse navbar-collapse" id="top-navbar-1">
                <ul class="nav navbar-nav navbar-right">
                    <p style="color: red">  <?php echo $lable_info; ?></p>
                </ul>
            </div>

            <div id="rootwizard">
                <div class="navbar">
                    <div class="navbar-inner">
                        <div class="container">
                            <ul>
                                <li><a href="#tab1" data-toggle="tab"><strong>FIRST SEMESTER</strong></a></li>
                                <li><a href="#tab2" data-toggle="tab"><strong>SECOND SEMESTER</strong></a></li>
                                <li><a href="#tab3" data-toggle="tab"><strong>SETTINGS</strong></a></li>
                                <li><a href="#tab4"  data-toggle="tab"><strong>LAST CHECK</strong></a></li>
                                <form action="index.php" method="POST">
                                    <li><button class="btn btn-submit" name="logout"><strong>Logout</strong></a></button></li>
                                </form>

                            </ul>
                        </div>
                    </div>
                </div>
                <div id="bar" class="progress ">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
                        <h3 style="color: #009999">FILL IN THE FIRST SEMESTER PROGRAMS</h3>
                        <div class="container">
                            <div class="row">
                                <div class="control-group" id="fields">
                                    <label class="control-label" for="field1">PROGRAM</label>
                                    <div class="controls"> 
                                        <form id="form1"  role="form" autocomplete="on" method="POST">

                                            <div class="entry input-group col-xs-3">
                                                <input class="form-control" required="" id="FIRSTSEMESTER" name="SEMESTER1[]" type="text" placeholder="Program"/>

                                                <span class="input-group-btn">
                                                    <button  class="btn btn-success btn-add btform1 semesterFormButton" type="button">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </span>
                                                <br/>
                                            </div>
                                        </form>
                                        <br>
                                        <small>Press <span class="glyphicon glyphicon-plus gs"></span> to add another PROGRAM field :)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <h3 style="color: #009999">FILL IN THE Second SEMESTER PROGRAMS</h3>
                        <p><br/><br/></p>
                        <div class="container">
                            <div class="row">
                                <div class="control-group" id="fields">
                                    <label class="control-label" for="field1">PROGRAM</label>
                                    <div class="controls"> 
                                        <form id="form2"  role="form" autocomplete="on" method="POST">

                                            <div class="entry input-group col-xs-3">
                                                <input class="form-control" id="SECONDSEMESTER" name="SEMESTER2[]" type="text" placeholder="Program" />
                                                <span class="input-group-btn">
                                                    <button  class="btn btn-success btn-add btform2 semesterFormButton" type="button">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </span>
                                                <br/>
                                            </div>
                                        </form>

                                        <small>Press <span class="glyphicon glyphicon-plus gs"></span> to add another PROGRAM field :)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <h3 style="color: #009999">INFORMATION </h3><br/>
                        
                       <div class="row">
                            <div class="col-sm-6">
                                <h4>CURRENT E-MAIL USED :</h4> 
                                <div class="form-group">
                                    <ul class="list-unstyled love">
                                   
                                        <p class="form-control-static"><?php echo $current_mail; ?></p>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <h4>CURRENT DEADLINE SUBMISSION :</h4> 
                                <ul class="list-unstyled love">
                                   <p class="form-control-static"><?php echo $deadline; ?></p>
                               </ul>
                            </div>
                        </div>
                        
                        
                        
                        <h3 style="color: #009999">SETTINGS  </h3><br/>
                        
                        <div class="entry input-group col-xs-3">
                           
                            <label class=" control-label">RESET ADMIN PASSWORD : </label>
                            <input class="form-control" type="text"id="ADMIN PASSWORD" name="admin_password" type="text" placeholder="Rest Password" /><br/>
                        </div>
                        
                        
                        
                        
                        <div class="entry input-group col-xs-3">
                            <p><br/></p>
                            <label class=" control-label">RESET E-MAIL : </label>
                            <input class="form-control" type="text"id="RESET EMAIL" name="reset_email" type="text" placeholder="Reset Email" /><br/>
                        </div>
                        
<!--                         <p><br/></p>
                            <label class=" control-label">NEW SECURITY KEY: </label>
                            <div class="entry input-group col-xs-3">

                                <input class="form-control" type="text"id="SECURITY KEY" name="SECURITYKEY" type="text" placeholder="Password" /><br/>
                            </div>-->
                        <p><br/></p>
                            <label class="control-label">PERIOD </label>
                            <div class="entry input-group col-xs-3">

                                <input class="form-control" type="text" id="PERIODE" name="DATE RANGE"/>
                            </div>
                        
                    </div>
                    <div class="tab-pane" id="tab4">
                        <form id="showForm"  action="Adminpage.php">

                        </form>
                    </div>
                    <div class="tab-pane" id="tab5">
                      <form action="index.php" method="POST">
                           <!--<li> <button class="btn btn-submit" name="logout"><strong>Logout</strong></a></button> </li>-->
                        </form>
                    </div>
                    <div class="tab-pane" id="tab6">
                        6
                    </div>
                    <div class="tab-pane" id="tab7">
                        7
                    </div>
                    <ul class="pager wizard">
                        <li class="previous first" style="display:none;"><a href="#">First</a></li>
                        <li class="previous"><a href="#">Previous</a></li>
                        <li class="next last" style="display:none;"><a href="#">Last</a></li>
                        <li class="next"><a href="#">Next</a></li>
                        
                        <li class="finish">
                            <a href="#">
                                <form  id="hiddenForm" action="Adminpage.php"  method="POST">

                                </form> 
                            </a></li>
                        
                    </ul>
                </div>
            </div>
        </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" ></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="institutestyle/bootstrap/jquery.bootstrap.wizard.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <script type="text/javascript" src="adminstylecalendar/bootstrap/moment.js"></script>      


        <script type="text/javascript" src="adminstylecalendar/bootstrap/daterangepicker.js" ></script>

        <script type="text/javascript" src="adminstylecalendar/bootstrap/moment.min.js"></script>


        <script>
            $(document).ready(function () {
                $('#rootwizard').bootstrapWizard({onTabShow: function (tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;
                        var $percent = ($current / $total) * 100;
                        $('#rootwizard .progress-bar').css({width: $percent + '%'});

                        if (index == 3) {
                            //calling the forms each time that the step 3 is reached

                            setupshowForm();
                            setupHiddenForm();
                        }


                    }});

            });

            $(function ()
            {
                $(document).on('click', '.semesterFormButton', function (e)
                {
                    e.preventDefault();

                    var fromId;
                    var btClassNameAdd;
                    var btClassNameRemove;

                    if ($(this).attr('class').includes('btform1')) {
                        fromId = '#form1';
                        btClassNameAdd = 'btform1';
                        btClassNameRemove = 'btform1remove';
                    } else
                    {
                        fromId = '#form2';
                        btClassNameAdd = 'btform2';
                        btClassNameRemove = 'btform2remove';
                    }

                    var controlForm = $(fromId);
                    var currentEntry = $(this).parents('.entry:first');
                    var newEntry = $(currentEntry.clone()).appendTo(controlForm);

                    newEntry.find('input').val('');



                    controlForm.find('.entry:not(:last) .' + btClassNameAdd)
                            .removeClass(btClassNameAdd).addClass(btClassNameRemove).removeClass('semesterFormButton')
                            .removeClass('btn-success').addClass('btn-danger').addClass('semesterFormButtonRemove')
                            .html('<span class="glyphicon glyphicon-minus"></span>');

                }).on('click', '.semesterFormButtonRemove', function (e)
                {
                    $(this).parents('.entry:first').remove();

                    e.preventDefault();
                    return false;
                });


            });

//calendar section
            $('input[name="DATE RANGE"]').daterangepicker();
            $(function () {

                $('input[name="datefilter"]').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });

                $('input[name="datefilter"]').on('apply.daterangepicker', function (ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));


                });

                $('input[name="datefilter"]').on('cancel.daterangepicker', function (ev, picker) {
                    $(this).val('');
                });

            });




            //the function of the hidden form 
            function setupHiddenForm() {
                var x = document.getElementsByClassName("form-control");
                var i;
                var hiddenFormContent = "";
                for (i = 0; i < x.length; i++) {
                    hiddenFormContent = hiddenFormContent + '<input type="text"  name="' + x[i].name + '" id="id' + i + '" value="' + x[i].value + '" hidden>';


                }
                hiddenFormContent += '<button  class="finish btn btn-link" type="submit" name="save"  value="submit">submit</button>';



                document.getElementById("hiddenForm").innerHTML = hiddenFormContent;

            }
            //the function of the hidden form 
            function setupshowForm() {
                var x = document.getElementsByClassName("form-control");
                var i;
                var hiddenFormContent = "";
                for (i = 0; i < x.length; i++) {
                    if (hiddenFormContent.includes(x[i].name) == false) {
                        hiddenFormContent = hiddenFormContent + '<br/><br/><b>' + x[i].id + '<b/>';

                    }
                    hiddenFormContent = hiddenFormContent + '<br/>' + x[i].value + '';
                }
                document.getElementById("showForm").innerHTML = hiddenFormContent;
//            }
//function myfunction(){
//    
//   var program=$('#semester1').val();
//   
//    aler(program);
                //  $.post('Adminpage.php',{postprog:program},
//    alert(program);
                // $('#result').html(program));
//    function(data){
//        $('#result').html(data);
//    });

            }


//
//$(document).ready(function(){
//    
//    var program = $('#semester1').val().text;
//    
//    $('#tab4').html('Hello, ' + program);
//    
//});




//
//$(document).ready(function() {
//  	$('#rootwizard').bootstrapWizard({onNext: function(tab, navigation, index) {
//			if(index==1) {
//				
//				if(!$('#semester1').val()) {
//					alert('You must enter your name');
//					$('#semester1').focus();
//					return false;
//				}
//			}
// 
//			// Set the name for the next tab
//			$('#tab4').html('Hello, ' + $('#name').val());
// 
//		}//, onTabShow: function(tab, navigation, index) {
////			var $total = navigation.find('li').length;
////			var $current = index+1;
////			var $percent = ($current/$total) * 100;
////			$('#rootwizard .progress-bar').css({width:$percent+'%'});
//		//}});
//            });
//});



            //
            //$(function()
            //{
            //    $(document).on('click', '.btn-add', function(e)
            //    {
            //        e.preventDefault();
            //
            //        var controlForm = $('.controls form:first'),
            //            currentEntry = $(this).parents('.entry:first'),
            //            newEntry = $(currentEntry.clone()).appendTo(controlForm);
            //
            //        newEntry.find('input').val('');
            //        controlForm.find('.entry:not(:last) .btn-add')
            //            .removeClass('btn-add').addClass('btn-remove')
            //            .removeClass('btn-success').addClass('btn-danger')
            //            .html('<span class="glyphicon glyphicon-minus"></span>');
            //    }).on('click', '.btn-remove', function(e)
            //    {
            //		$(this).parents('.entry:first').remove();
            //
            //		e.preventDefault();
            //		return false;
            //	});
            //});




        </script>



    </body>
</html>