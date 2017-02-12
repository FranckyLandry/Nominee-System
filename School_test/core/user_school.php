<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Institute
 *
 * @author Francky Ngabo
 */
include '/phpmailer.php';
//require_once './Connector.php';
require_once '/Connector.php';

class user_school {

    private  $schoolName, $Sql_Insert, $conn, $filesize,$filetype,$filename,$filetemp, $Sql_selectEmail;


    
    public function __construct(){
        
            $connect_Obj = new connector();
            $connect = $connect_Obj->dbConnection();
            $this->conn = $connect;

    }
    
    

    
    /**
     * 
     * @param type name of the file to save it
     */
     public function set_filename($value) {
         $this->filename=$value;
     }
    /**
     * 
     * @return type the file name
     */
     public function get_filename() {
         return $this->filename;
     }
     
     
     
     
//    public function set_Label($value) {
//         $this->lbl_Value=$value;
//     }
     
//    public function get_LabelValue(){
//         
//         return $this->lbl_Value;
//     }
     
//    public function set_country($param) {
//        $this->country = $param;
//    }

//    public function set_userName($param) {
//        $this->username = $param;
//    }

//    public function set_pwd($param) {
//        $this->password = $param;
//    }

//    public function set_email($param) {
//        $this->email = $param;
//    }

//    public function set_schoolName($param) {
//        $this->schoolName = $param;
//    }

//    public function set_contactpersonName($param) {
//        $this->contactpersonName = $param;
//    }

//    public function get_country() {
//        return $this->country;
//    }

    public function get_schoolInfo($email_contatct_pers) {
        
                try{
                    
                    $stmt =  $this->conn->prepare("SELECT  school_name,country,contact_perso_name"
                                                 . " FROM institute WHERE email_contact_pers=:umail");
                       
                    $stmt->execute(array(':umail' => $email_contatct_pers));
                    $info_school = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    return $info_school;
                    
                } catch (Exception $ex) {

                }
        
        
        
        return $this->schoolName;
    }
    
//    public function set_security($security){
//        $security =  filter_var($security,FILTER_SANITIZE_STRING);
//    }

//    public function get_contactpersonName() {
//        return $this->contactpersonName;
//    }
//
//    public function get_contactEmail() {
//        return $this->email;
//    }

    
    public function get_Email_Tosend_To() {
        $this->Sql_selectEmail="SELECT `email_coordinator` FROM `coordinator`";
        
         $result = mysqli_query($this->con->getConnection(),$this->Sql_selectEmail);
         
          if (!$result) {
            die("Not be abble to querry");
        }
         $email = mysqli_fetch_array($result);
        foreach ($email as $value) {
            return $value;
        }
        $this->con->closeConnection();
        
    }
    
   
    public function select_Login($umail,$upass) {
        
        try
		{
			$stmt = $this->db->prepare("SELECT  username, password FROM user_type WHERE username=:umail");
                       
                        $stmt->execute(array(':umail' => $umail));
                        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($this->password_verify($upass, $userRow['password'])) {
                            
                                $_SESSION['user_login']=$umail;
                                return TRUE;
                        }     
		} catch(PDOException $e){
                    
			echo $e->getMessage();
		}
                    
                return  FALSE;
    }
    
//    public function SaveSchoolInfo($_school_name, $_country, $_contactpersonName, $_email) {
//
//
//        $this->Sql_Insert = "INSERT INTO `institute` (`schoolname`,`country`,`contactpersoName`,`email`) VALUES ('$_school_name','$_country','$_contactpersonName','$_email')";
//
//        $result = mysqli_query($this->con->getConnection(),$this->Sql_Insert);
//
//        if (!$result) {
//            die("Not be abble to querry" );
//        }
//        $this->con->closeConnection();
//    }

    public function saveStudentInfo($firstName, $lastName, $student_email,$school_name,$country,$contact_name,
                                    $contact_email,$proof_english,$proof_transcritp,$semester1,$semester2) {
       
        try{
            
            $stmt =  $this->conn->prepare("INSERT INTO student(firstname,lastname,student_email,schoolname,country,contactperson,contact_email,
                                              proof_Englsih_ref,transcript_ref,semester1,semester2)
                                              VALUES(:first, :last, :email,:schoolname,:country,:name_contact,:contact_email,:proof_englis,:transcript_ref,
                                              :semester1,:semester2)");
            
                        $stmt->bindparam(":first", $firstName);
			$stmt->bindparam(":last", $lastName);
                        $stmt->bindparam(":email", $student_email);
                        $stmt->bindparam(":schoolname", $school_name);
                        $stmt->bindparam(":country", $country);
                        $stmt->bindparam(":name_contact", $contact_name);
                        $stmt->bindparam(":contact_email", $contact_email);
                        $stmt->bindparam(":proof_englis", $proof_english);
                        $stmt->bindparam(":transcript_ref", $proof_transcritp);
                        $stmt->bindparam(":semester1", $semester1);
                        $stmt->bindparam(":semester2", $semester2);
			$executed = $stmt->execute();
                        
                        if ($executed) {
                            return TRUE;
                            
                        }else{
                            return FALSE;
                            
                        }
                        
            
        } catch (Exception $ex) {
            
                echo $ex->getMessage();
        }       
    }

    public function deadLine_date() { 
        
        try
		{       
                       $deadline=NULL;
			$stmt = $this->conn->prepare("SELECT `submition_deadline` FROM coordinator ");
			$stmt->execute();
                        
                        $row_deadline= $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if (count($row_deadline)==1) {
                                
                               $deadline = $row_deadline['submition_deadline'];
                                return $deadline;
                        }
                        
                        
		}   catch(PDOException $e){
                    
			echo $e->getMessage();
		}
                    
                    return  FALSE;
	
    }

    public function retrieveProgram_s1($end_date) {

            try{
                        $stmt   = $this->conn->prepare("SELECT programs FROM semester1 WHERE end_date =:deadline");
			$stmt->execute(array(':deadline'=>$end_date));
                        while($programs = $stmt->fetch(PDO::FETCH_ASSOC)){
                  
                                echo "<option name='semester1' value='". $programs['programs']. "'>".$programs['programs']. "<br/>";
                        }
     
            } catch (Exception $ex) {
                        
                            echo $ex->getMessage();
            }

    }

    public function retrieveProgram_s2($end_date) {

         try{
                        $stmt   = $this->conn->prepare("SELECT programs FROM semester2 WHERE end_date =:deadline");
			$stmt->execute(array(':deadline'=>$end_date));
                        
                        while($programs = $stmt->fetch(PDO::FETCH_ASSOC)){
                        
                            echo "<option name='semester2' value='". $programs['programs']. "'>".$programs['programs']. "<br/>";
                        }
     
            } catch (Exception $ex) {
                        
                            echo $ex->getMessage();
            }
    }
    

        /*
         * Cleaning the input fields to prevent sql-injection
         */
        public function cleanData($data){
            $data = trim($data);
            $data = strip_tags($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        /*
         * Only accepts pdf file
         */
        public function check_Uploads_extension($param) {
            
            try{
                
                $file_parts = pathinfo($param);

                switch($file_parts['extension'])
                {  
                    case "pdf":
                         return TRUE;

                     case "": // Handle file extension for files ending in '.'

                        return FALSE;
                    case NULL: // Handle no file extension
                       return FALSE;
                }
            } catch (Exception $ex) {
                return FALSE;
            }
                

        }
        
        /**
         * saving the files to a folder
         */
        public function moveToFolder($file1,$file2) {
            
            $this->getFileData($file1); 
            $this->getFileData($file2);
    
        }
        
        
        
        /*
         * Getting the file data and move them to the folder
         */
        public function getFileData($file) {
            
                $this->filename=$file['name'];
                 
                $this->filesize=$file['size'];
               
                $this->filetemp=$file['tmp_name'];
                
                $this->filetype=$file['type'];
                
                $folder="../Uploads/";
               
               $move = move_uploaded_file($this->filetemp,$folder.$this->filename);
               
               $this->set_filename($this->filename);
               
               if($move){
                   
                   return TRUE;
               } else{
                   echo 'Failed to move';
                   return FALSE;
               }
           
        }
 
}
    
    

