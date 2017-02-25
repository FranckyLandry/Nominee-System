<?php
session_start();

/**
 * Description of Admin
 *
 * @author Beheerders
 */
//include './Connector.php';
//require_once './Connector.php';
require_once './core/Connector.php';
//include_once './core/phpmailer.php';

class Admin {
    
//    private $auth_conn;
    
    private $semester1;
   
    private $periode;
   
    
    
    
    private $conn;
    

    public function get_start_date() {
        return $this->periode;
    }

    public function set_start_date($start) {
        $this->periode = $start;
    }

    public function get_NewSemester1() {
        return $this->semester1;
    }

    public function __construct() {
        
         $connect_Obj = new connector();
            $connect = $connect_Obj->dbConnection();
            $this->conn = $connect;
        
        
        

    }

    public function setting_Semester_1($s1, $start, $end) {
        
        
        try{
            
              $stmt = $this->conn->prepare("INSERT INTO semester1(programs,start_date,end_date)"
                      . " VALUES(:us1, :ustart_date, :uend_date )");
			$stmt->bindparam(":us1", $s1);
			
                        $stmt->bindparam(":ustart_date", $start);
                        $stmt->bindparam(":uend_date", $end);
                        
			$executed = $stmt->execute();
                        
                         if($executed){
                            
                            return TRUE;
                        }else{
                            return FALSE;
                        }
            
            
            
        } catch (Exception $ex) {
                    return FALSE;
        }   
     
    }

    public function setting_Semester_2($s2, $start, $end) {

        
            try{
            
              $stmt = $this->conn->prepare("INSERT INTO semester2 (programs,start_date,end_date)
                                            VALUES(:us2, :ustart_date, :uend_date )");
			$stmt->bindparam(":us2", $s2);
			
                        $stmt->bindparam(":ustart_date", $start);
                        $stmt->bindparam(":uend_date", $end);
                        
			$executed = $stmt->execute();
                        if($executed){
                            
                            return TRUE;
                        }else{
                            return FALSE;
                        }
            
            
            
        } catch (Exception $ex) {
                    return FALSE;
        }     
    
    }

    public function update_Endate($end_date) {
        
            try{
                
                 $stmt = $this->conn->prepare("UPDATE coordinator SET submition_deadline = :deadline ");
                                                $stmt->bindparam(":deadline", $end_date);
                                               
                                                $executed = $stmt->execute();
                                                
                                                if($executed){
                                                    
                                                        return TRUE;
                                                }else{
                                                    
                                                        return FALSE;
                                                    
                                                }

                
            } catch (Exception $ex) {
                return FALSE;
            }
      
    }

    public function updat_Coordinator_Email($email) {
        
        try{
                $stmt = $this->conn->prepare("UPDATE coordinator SET email_coordinator = :mail ");
                                                $stmt->bindparam(":mail", $email);
                                               
                                               $executed1 = $stmt->execute();
                                               
                $stmt = $this->conn->prepare("UPDATE user_type SET username = :username WHERE category = 'admin'");
                                                $stmt->bindparam(":username", $email);
                                                $stmt->execute();
                                                
                                                $executed2=$stmt->execute();
                                               
                                               if($executed1==TRUE && $executed2==TRUE){
                                                   
                                                        return TRUE;
                                                        
                                               }else{
                                                   
                                                        return FALSE;
                                               }
         } catch (Exception $ex) {
                return FALSE;
         }
  
    }
    
     public function update_Admin_Password($pass) {
        
         try{
             
                $new_password = password_hash($pass, PASSWORD_DEFAULT);
                $current_mail = $this->current_Email();
                
                                if($current_mail){

                                        $stmt = $this->conn->prepare("UPDATE coordinator SET password_Admin = :pass WHERE email_coordinator = :currentmail");
                                                $stmt->bindparam(":pass", $new_password);
                                                $stmt->bindparam(":currentmail", $current_mail);
                                                $stmt->execute();
                                        
                                        $stmt = $this->conn->prepare("UPDATE user_type SET password = :pass WHERE username = :currentmail");
                                                $stmt->bindparam(":pass", $new_password);
                                                $stmt->bindparam(":currentmail", $current_mail);
                                                $stmt->execute();
                                                
                                    
                       

                        
                       
                            
                                   return TRUE;
                        
                    }else{
                                   return FALSE;
                                }
         } catch (Exception $ex) {
                return FALSE;
         }
       
  
    }

    public function current_Email() {
        
            try{
                
                $stmt = $this->conn->prepare("SELECT email_coordinator FROM coordinator ");
			$stmt->execute();
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if (empty($userRow)) {
                           
                                return FALSE;
                        }else{
                            
                            $email_coordinator = $userRow['email_coordinator'];
                            return $email_coordinator;
                            
                        }  
                        
               
                
            } catch (Exception $ex) {
                    
            }
            
    }
    
     public function submission_Deadline() {

         try{
            
                
                $stmt = $this->conn->prepare("SELECT * FROM coordinator");
			$stmt->execute();
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if (empty($userRow)) {
                           
                                return FALSE;
                        }else{
                            
                            $current_deadline = $userRow['submition_deadline'];
                            return $current_deadline;
                            
                        }  
                        
               
                
            } catch (Exception $ex) {
                    
            }
    }

}
