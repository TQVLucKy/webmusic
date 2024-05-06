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

    public function checkUsername($username){
        $sql="select id from registration where username=?";
        $stmt= mysqli_prepare($this->con,$sql);
       if ($stmt){
        mysqli_stmt_bind_param($stmt,"s",$username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $num_rows=mysqli_stmt_num_rows($stmt);

        mysqli_stmt_close($stmt);

        return $num_rows>0;
       }
       else{
        false;
       }
        // return mysqli_query($this->con,$sql);
    }
}
?>