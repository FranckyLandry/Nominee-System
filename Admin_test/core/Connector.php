<?php
/**
 * Description of connector
 * This class will make the connection to the database and 
 * the connection on the server
 * @author Francky Ngabo
 */



class connector {
    
     /*
     * Fields
     * servername->as the Name of the server
     */
    private $servername = "localhost";
    
    /*
     * Fields
     * root->as the root to the server
     */
    private $root = "root";
    
    /*
     * Fields
     * password->as the password to the database
     */
    private $password = "";
    
    /*
     * Fields
     * dbname->as the name of the database
     */
    private $dbname = "mydb";
    /*
     * Fields
     * conn->as the connection  to the server
     */
    public $conn;
    
    
    
    
    /*
     * Establishing the connection with the server
     */
    public function dbConnection()
    {
        $this->conn=NULL;
       
        try{
            
            $this->conn=new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname,  $this->root, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
        } catch (Exception $ex) {
            
            echo "Connection error: " . $ex->getMessage();

        }
        return $this->conn;

    }
}
