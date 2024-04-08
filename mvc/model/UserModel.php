<?php
class UserModel extends DB{
    public function InsertUser($username,$password,$email,$hoten,$diachi){
        $sql="insert into users values(null,'$username','$password','$email','$hoten','$diachi')";
       $result=false;
        if(mysqli_query($this->con,$sql)){
            $result=true;
        }
        return json_decode($result);
    }

    public function checkUsername($un){
        $sql="select id from users where username='.$un'";
        $rows= mysqli_query($this->con,$sql);
        $kq=false;
        if(mysqli_num_rows($rows)>0){
            $kq=true;
        }
        return json_decode($kq);
    }
}
?>