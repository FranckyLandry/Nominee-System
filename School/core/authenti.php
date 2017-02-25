<?php 

/**
 * Description of user this will handle to connect the user with the database
 * and the login and logout
 *
 * @author Francky Ngabo
 */

require_once 'Connector.php';

require_once 'user_school.php';

require_once 'phpmailer.php';
 
class authenti {
    
    /*
     * the connection field
     */
    private $auth_conn;
    public $send_to_newpass;
    public $labe_error;



    public function __construct() {

       
                $connection = new connector();
		$user_conn = $connection->dbConnection();
		$this->auth_conn = $user_conn;
    }

      public function getuser_class() {
     
                $db_class=new user_school();
                return $db_class;
    }

    /*
     * Cleans all the input for special charachters 
     */
    public function cleanData($data){
            $data = trim($data);
            $data = strip_tags($data);
            $data = htmlspecialchars($data);
            return $data;
     }
    /*
     * This method will register the new foreign university
     * ($schoolname, $country, $contact_pers, $school_password,$contact_email);
     */
    
    public function register($s_Name, $s_Country, $s_contact_persName, $s_Pass, $s_email,$address_to_send) {

        try {
            
            $stmt = $this->auth_conn->prepare("SELECT username FROM user_type WHERE username=:uname");
			$stmt->execute(array(':uname'=>$s_email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
                       
                        if (!empty($userRow)) {
                            
                            $this->labe_error="E-Mail already exist";
                            return FALSE;
                        }  
                        
            
            $new_password = password_hash($s_Pass, PASSWORD_DEFAULT);

            $tempp = NULL;
            $stmt = $this->auth_conn->prepare("INSERT INTO user_type(username,password,category,temp_pass)
                                            VALUES(:uname, :upass, 'exchange',:temp)");
			$stmt->bindparam(":uname", $s_email);
			$stmt->bindparam(":upass", $new_password);
                        $stmt->bindparam(":temp", $tempp);
                        
			$executed1 = $stmt->execute();
                        
                        if (!$executed1) {
                             $this->labe_error="An Error occure please try again.";
                            return FALSE;
                        }
                        
            
            
            $stmt = $this->auth_conn->prepare("INSERT INTO institute(school_name,country,contact_perso_name,password_university,email_contact_pers,address_to_send)"
                                         . " VALUES(:s_Names, :s_Country, :s_contact_persName,:s_Pass,:s_email,:address)");
                         
                        $stmt->bindparam(":s_Names", $s_Name);
                        $stmt->bindparam(":s_Country", $s_Country);
                        $stmt->bindparam(":s_contact_persName",$s_contact_persName);
                        $stmt->bindparam(":s_Pass",$new_password);
                        $stmt->bindparam(":s_email",$s_email);
                        $stmt->bindparam(":address",$address_to_send);
                        
                       $executed =  $stmt->execute();
                       
                        if ($executed) {
                            
                        $email_object = new PHPMailer();
                        
                        $email_object->From = 'Nominee@noreply.com';
                        $email_object->FromName = 'Nominee System';
                        $email_object->Subject = 'Register';

                        $email_object->Body = "Dear $s_contact_persName,\n\n";
                        $email_object->Body.="You are successefully register, you can now start Nominating students:\n\n";
                        
                        $email_object->Body.="UserName info :\n";
                        $email_object->Body.="User name:      " . $s_email . "\n\n\n";
                        
                        $email_object->Body.="Password info :\n";
                        $email_object->Body.="Password:      " . $s_Pass . "\n\n\n";


                       
                        $email_object->Body.="\n\n Kind Regards \nNominee Team";

                        $email_object->AddAddress($s_email);
                        $send = $email_object->Send();
                        
                        if(!$send){
                        
                            return FALSE;
                        }
                    }  
                        
                        
                        return $stmt;
 
            
        } catch (Exception $ex) {
            var_dump($ex);
                           /*  Better not to print for security issues      */
//                                echo $ex->getMessage();

        }
    }
    
    
    /*
     * Login function 
     */
    public function doLogin($umail,$upass){
        
		try
		{
                         $this->send_to_newpass= FALSE;
                    
			$stmt = $this->auth_conn->prepare("SELECT  username, password,temp_pass FROM user_type WHERE username=:umail");
                       
                        $stmt->execute(array(':umail' => $umail));
                        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if(!($userRow['temp_pass']==$upass)){
                            
                                if (password_verify($upass, $userRow['password'])) {
                                    
                                    if (!empty($userRow['temp_pass'])) {
                                        $userRow['temp_pass'] = NULL;
                                    }

                                        $_SESSION['user_name']=$umail;
                                        
                                         return TRUE;
                                }  
                                
                            }else{

                                $_SESSION['user_name']=$userRow['username'];
                                $this->send_to_newpass= TRUE;
                        }
		} catch(PDOException $ex){
                               /*  Better not to print for security issues      */
//                                echo $ex->getMessage();

		}
	}
        
     /*
      * Logout 
      */
    public function doLogout(){
        
//		session_destroy();
		unset($_SESSION['user_name']);
                header('Location: LogForeign.php');
		
    }
    
    public function update_NewPassword($old_pass,$new_pass,$email) {
        
            try{
                
                    //check first if the email is the one
                   $stmt = $this->auth_conn->prepare("SELECT username,temp_pass FROM user_type WHERE username=:current");
                       
                        $stmt->execute(array(':current' => $email));
                        $check_mail = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($check_mail && $check_mail['temp_pass']== $old_pass) {
                          
                            $tem_pass = NULL;
                                $mail = $check_mail['username'];
                                $new_password = password_hash($new_pass, PASSWORD_DEFAULT);

                                $stmt = $this->auth_conn->prepare("UPDATE institute SET password_university = :pass WHERE email_contact_pers = :currentmail");
                                        $stmt->bindparam(":pass", $new_password);
                                        $stmt->bindparam(":currentmail", $mail);
                                        $stmt->execute();
                                        
                                $stmt = $this->auth_conn->prepare("UPDATE user_type SET password = :pass, temp_pass=:temp WHERE username = :currentmail");
                                         $stmt->bindparam(":pass", $new_password);
                                         $stmt->bindparam(":currentmail", $mail);
                                         $stmt->bindparam(":temp", $tem_pass);
                                         $stmt->execute();
                                
                                return TRUE;
                        }else{
                                $this->labe_error="An Error occure with the provided e-mail! Please try again";
                                return FALSE;
                        }
                } catch (Exception $ex) {
                                /*  Better not to print for security issues      */
//                                echo $ex->getMessage();

                }
                   
        
    }
    
    public function forgot_pass($current_email) {

            try {

                $stmt = $this->auth_conn->prepare("SELECT username FROM user_type WHERE username=:current");

                $stmt->execute(array(':current' => $current_email));
                $check_mail = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($check_mail) {
                    $mail = $check_mail['username'];
                    $new_pass = $this->random_Password_Generator();

                    if (!empty($new_pass)) {

                        $email_object = new PHPMailer();
                        $email_object->From = 'Nominee@noreply.com';
                        $email_object->FromName = 'Nominee System';
                        $email_object->Subject = 'Password Request';

                        $email_object->Body = "Dear $mail,\n\n";
                        $email_object->Body.="You requested a new password:\n\n";
                        $email_object->Body.="Password request:\n";
                        $email_object->Body.="New Password:      " . $new_pass . "\n\n\n";


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
                            $this->labe_error="An Error occure! Please try again";
                            return FALSE;
                        }
                    }
                } else {
                    $this->labe_error="An Error occure with the provided e-mail! Please try again";
                    return FALSE;
                }
            } catch (Exception $ex) {
                /*  Better not to print for security issues      */
//                echo $ex->getMessage();
            }
    }
    
    /*
     * Generator of random Password
     */
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
