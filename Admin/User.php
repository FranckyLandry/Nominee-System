<?php


//session_start();

/**
 * Description of User
 * User Class 
 * @author Francky Ngabo
 */

require_once './core/Connector.php';
require_once './core/phpmailer.php';

//session_start();
class User {
    
    
    /*
     * $auth_conn->as connection  
     */
    private  $auth_conn;
    
    /*
     * lbl_value->as the value of the label  
     */
    public $lbl_Value='';
    
   

    


    /*
     * The constructor will initialize the database and 
     * the connection
     */
     public  function __construct() {


         $connection = new connector();
		$user_conn = $connection->dbConnection();
		$this->auth_conn = $user_conn;
        
      
     }

     
     
    
   
     /*
     * Login function 
     */
    public function doLogin($umail,$upass){
        
		try
		{       
                    
			$stmt = $this->auth_conn->prepare("SELECT  username, password,temp_pass FROM user_type WHERE username=:umail");
                       
                        $stmt->execute(array(':umail' => $umail));
                        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if($userRow==FALSE){
                            $this->lbl_Value="An Error occure! Please try again";
                            return FALSE;
                        }
                        $temp_pass = $userRow['temp_pass'];
                        
                        if (is_string($temp_pass) == is_string($upass)) {
                            
                            $temp = NULL;
                            $_SESSION['user_login']=$umail;
                            
                            $stmt = $this->auth_conn->prepare("UPDATE user_type SET temp_pass=:temp WHERE username = :currentmail");
                                         $stmt->bindparam(":currentmail", $umail);
                                         $stmt->bindparam(":temp", $temp);
                                         $stmt->execute();
                            ;
                            
                            return TRUE;
                            
                        }
                        
                        if (password_verify($upass, $userRow['password'])) {
                            
                                        $_SESSION['user_login']=$umail;
                                        
                       
                                        return TRUE;
                      
                      }  
 
                                
                           
		} catch(PDOException $e){
                            $this->lbl_Value="An Error occure! Please try again";

		}
	}
        
    public function forgot_pass() {

            try {

                $stmt = $this->auth_conn->prepare("SELECT email_coordinator FROM coordinator");

                $stmt->execute();
                $check_mail = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($check_mail) {
                    $mail = $check_mail['email_coordinator'];
                    $new_pass = $this->random_Password_Generator();

                    if (!empty($new_pass)) {

                        $email_object = new PHPMailer();
                        
                        $email_object->From = 'Nominee@noreply.com';
                        $email_object->FromName = 'Nominee System';
                        $email_object->Subject = 'Password Request';

                        $email_object->Body = "Dear coordinator,\n\n";
                        $email_object->Body.="You requested a new password:\n\n";
                        $email_object->Body.="Password request:\n";
                        $email_object->Body.="New Password:      " . $new_pass . "\n\n\n";
                        $email_object->Body.=" Be aware that after Login in, the password will no longer be usufull.\nThank you!\n\n";

                        $email_object->Body.="If for any reason it is not your request just ignore this email and your password will not be updated:\n";
                        $email_object->Body.="\n\n Kind Regards \nNominee Team";

                        $email_object->AddAddress($mail);
                        
                        $send = $email_object->Send();

                        /* @var $send to check if the e-mail was send */
                        if ($send) {
                            
                             $stmt = $this->auth_conn->prepare("UPDATE user_type SET temp_pass = :pass WHERE username = :currentmail");
                                        $stmt->bindparam(":pass", $new_pass);
                                        $stmt->bindparam(":currentmail", $mail);
                                        $stmt->execute();
                            
                            return TRUE;
                            
                        } else {
//                            $this->labe_error="An Error occure! Please try again";
                            return FALSE;
                        }
                    }
                } else {
                    $this->labe_error="An Error occure with the provided e-mail! Please try again";
                    return FALSE;
                }
            } catch (Exception $ex) {

                echo $ex->getMessage();
            }
    }
    
    function random_Password_Generator() {
         
                        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                        $pass = array(); 
                        $alphaLength = strlen($alphabet) - 1; 
                        for ($i = 0; $i < 8; $i++) {
                            $n = rand(0, $alphaLength);
                            $pass[] = $alphabet[$n];
                        }
                        return implode($pass); //turn the array into a string
    }
    
}
