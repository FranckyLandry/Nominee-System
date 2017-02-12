<?php


//session_start();

/**
 * Description of User
 * User Class 
 * @author Francky Ngabo
 */

require_once './core/Connector.php';

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
                       
                    
			$stmt = $this->auth_conn->prepare("SELECT  username, password FROM user_type WHERE username=:umail");
                       
                        $stmt->execute(array(':umail' => $umail));
                        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if($userRow==FALSE){
                            $this->lbl_Value="An Error occure! Please try again";
                        }
                        if (password_verify($upass, $userRow['password'])) {
                            
                                        $_SESSION['user_login']=$umail;
                                        return TRUE;
                                }  
 
                                
                           
		} catch(PDOException $e){
                            $this->lbl_Value="An Error occure! Please try again";

		}
	}
    
}
