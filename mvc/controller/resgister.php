<?php
class Resgister extends controller
{
    public $a;
    public $UserModel;

    public function __construct()
    {
        
        //model
        $this->a = $this->model("SinhVienmodel");
        $this->UserModel= $this->model("UserModel");
    }

    public function SayHi()
    {

        $this->view("Aodep", [
            "page" => "resgister",
            "resgister"=>"login"
        ]);
    }

    public function khachhangdangky(){

        //1. get data khach hang nhap
        if(isset($_POST["btnresgister"])){
            $username= $_POST["username"];
            $password= $_POST["password"];
            $password=password_hash($password, PASSWORD_DEFAULT);
            $email= $_POST["email"];
            $hoten= $_POST["hoten"];
            $diachi= $_POST["diachi"];
            //2.insert database bảng user
            $kq=$this->UserModel->InsertUser($username,$password,$email,$hoten,$diachi);
            echo $kq;
            //3. show chữ "ok/fail"
            $this->view("Aodep", [
                "page" => "resgister",
                "resgister"=>"login",
                "result"=>$kq
            ]);
        }
       
    }
}
