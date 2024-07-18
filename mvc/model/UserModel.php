<?php
class UserModel extends DB
{
    public function InsertUser($username, $password, $email, $hoten, $diachi)
    {
        $sql = "insert into users values(null,'$username','$password','$email','$hoten','$diachi')";
        $result = false;
        if (mysqli_query($this->con, $sql)) {
            $result = true;
        }
        return json_decode($result);
    }

    public function checkUsername($username, $password)
    {
        $sql = "select IdAccount from account where username=? and password=?";
        $stmt = mysqli_prepare($this->con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $num_rows = mysqli_stmt_num_rows($stmt);

            mysqli_stmt_close($stmt);

            return $num_rows > 0;
        } else {
            false;
        }
        // return mysqli_query($this->con,$sql);
    }

    // đổi mật khẩu đã được nhưng những trường hợp báo lỗi thì chưa làm.
    //Đổi mật khẩu
    public function ChangePassword($UserName, $PassOld, $PassNew1, $PassNew2)
    {
        $sql = "SELECT Password from account WHERE UserName=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $UserName);
        $stmt->execute();
        $stmt->bind_result($Password);
        $stmt->fetch();
        if ($PassOld ==($Password??'')) {
            if ($PassNew1 == $PassNew2) {
                $sql = "UPDATE account
            SET Password=?
            WHERE Password=? and UserName=?";
                $stmt1 = $this->con->prepare($sql);
                $stmt1->bind_param("sss", $PassNew1, $PassOld, $UserName);
                if ($stmt1->execute())
                    echo "Đổi mật khẩu thành công";
                else
                    echo "Error: " . $stmt1->error;
            } else echo "Mật khẩu mới không giống nhau";
        }
        else echo "Mật khẩu cũ không trùng khớp";
    }
}
