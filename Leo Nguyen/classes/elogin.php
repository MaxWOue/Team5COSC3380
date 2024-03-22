<?php
class Elogin{
    private $error = "";
   
    public function evaluate($data){
        
        $username = addslashes($data['username']);
        $password = addslashes($data['password']);
        
        $sql = "SELECT * FROM employee WHERE username = '$username' limit 1";       
        
        $DB = new Database();
        $result = $DB->read($sql);
        
        if($result){
            $row = $result[0];
            
            if($Password == $row['password']){
                
                //create a session data
                //$_SESSION['Museum_EmployeeID'] = $row['EmployeeID'];
                
            } else {
                $this->error .= "Invalid Password<br>";
            }
        } else {
            $this->error .= "Invalid Email<br>";
        }
            
        return $this->error;
    }
    
    public function check_login($id){
        $query = "SELECT EmployeeID FROM employee WHERE EmployeeID = '$id' limit 1";       
        
        $DB = new Database();
        $result = $DB->read($query);
        
        if($result){
            
            return true;
        }
        
        return false;
        
    }
}

?>