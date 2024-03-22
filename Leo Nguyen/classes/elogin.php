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
            
            if($password == $row['Password']){
                
                //create a session data
                //$_SESSION['museum_userid'] = $row['userid'];
                
            } else {
                $this->error .= "Invalid Password<br>";
            }
        } else {
            $this->error .= "Invalid Email<br>";
        }
            
        return $this->error;
    }
    
    public function check_login($id){
        $query = "SELECT employeeid FROM employee WHERE employeeid = '$id' limit 1";       
        
        $DB = new Database();
        $result = $DB->read($query);
        
        if($result){
            
            return true;
        }
        
        return false;
        
    }
}

?>