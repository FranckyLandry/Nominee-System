    <!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


 <?php
  session_start();
 /*
  * Displaying all error that can be triggered in the confing of the database
  */
 error_reporting(E_ALL);
 ini_set('dispaly_errors','1');

require_once './User.php';


$label = NULL;

                    /*
                     * Creating user object
                     */

                    $user=new User();

  if (isset($_POST['logout'])) {
      
    unset($_SESSION['user']);
   
}
/*
 * Getting the data entered by the user and preventting sql injections 
 */
        if (isset($_POST['login-button'])) {

                    $email=  filter_var($_POST["username"], FILTER_SANITIZE_STRING);
                    $email=  trim($email);
                    $email=  strip_tags($email);
                    $email=htmlspecialchars($email);

                    $pass=filter_var($_POST["password"], FILTER_SANITIZE_STRING);
                    $pass=  trim($pass); 
                    $pass=  strip_tags($pass);
                    $pass=htmlspecialchars($pass);
                    
                    /*
                     * calling the login function
                     */

                    $login = $user->doLogin($email, $pass);

                    if($login){

                            header('Location: Adminpage.php');
                    }else{

                            $label = "wrong password or user name  ";
                    }

                  }
                  
                  if (isset($_POST['reset_pass'])) {
                      $forgot_pass = $user->forgot_pass();
                      if ($forgot_pass) {
                          
                          $label = "An e-mail has been sent ";
                      }else{
                          $label = "An error occure please try again ";
                      }
    
                }
                  
                  if (isset($_POST['logout'])) {
                       
                      $_SESSION['user_login'] = session_destroy(); 
                      
                }
         
        ?>


<html>
    <head>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <title></title>
        
        <link rel="stylesheet" href="css/stylesheet.css">
    </head>
    <body>
       <div class="container">
<!--           <img src="images/logo-fontys.jpg">-->
           <h1><font color="purple">Welcome</font></h1>
           <div class="labelForm"
                
                 <label>
                        <?php
                        /*
                         *  it print a message in case of the wrong credation
                         */
                      if($label!=NULL ){
                          echo $label;
                        }
                        ?>
                        
                    </label>
              <!--</label>-->
       </div>
           <form action="index.php" method="POST">
                   
                   <div class="form-input">
                       <input type="text" name="username" required="" placeholder="User Name">
                    </div>
                    <div class="form-input">
                        <input type="password" name="password" required="" placeholder="password">
                    </div>
<!--<div class="form-input">-->
                   
               <!--</div>-->
               
                    <div>
                        <button type="submit" class="btn btn-default" name="login-button" >Login</button>
                    </div>   
               </form>
           <form action="index.php" method="POST">   
            <label style="color: purple">Forgot Password?</label>
            <button name="reset_pass" type="submit" class="btn btn-link">Click here to reset</button>
           </form>
           
           
           
           </div>
      <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    </body>
</html>



