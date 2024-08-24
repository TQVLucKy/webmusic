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
        $sql = "select IdAccount, Password from account where username=?";
        $stmt = mysqli_prepare($this->con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $idAccount, $hashedPassword);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            if (password_verify($password, $hashedPassword)) {
                return $idAccount;
            } else
                return false;
        } else {
            false;
        }
    }

    public function signUp($UserName, $Password)
    {
        //Mã hóa mật khẩu
        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO account (UserName, Password) VALUES ('$UserName', '$hashedPassword')";
        if (mysqli_query($this->con, $sql)) {
            echo "Đăng ký thành công!";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $this->con->error;
        }
    }

    // đổi mật khẩu đã được nhưng những trường hợp báo lỗi thì chưa làm.
    //Đổi mật khẩu
    public function ChangePassword($UserName, $PassOld, $PassNew1, $PassNew2)
    {
        // Lấy mật khẩu hash từ cơ sở dữ liệu
        $sql = "SELECT Password FROM account WHERE UserName=?";
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }
        $stmt->bind_param("s", $UserName);
        $stmt->execute();
        $stmt->bind_result($PasswordHash);
        $stmt->fetch();
        $stmt->close();
        // Kiểm tra mật khẩu cũ
        if (password_verify($PassOld, $PasswordHash)) {
            if ($PassNew1 === $PassNew2) {
                $NewPasswordHash = password_hash($PassNew1, PASSWORD_DEFAULT);

                $sql = "UPDATE account SET Password=? WHERE UserName=?";
                $stmt = $this->con->prepare($sql);
                if (!$stmt) {
                    die("Prepare lỗi: " . $this->con->error);
                }
                $stmt->bind_param("ss", $NewPasswordHash, $UserName);

                if ($stmt->execute()) {
                    echo "Đổi mật khẩu thành công";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Mật khẩu mới không giống nhau";
            }
        } else {
            echo "Mật khẩu cũ không trùng khớp";
        }
    }
}
