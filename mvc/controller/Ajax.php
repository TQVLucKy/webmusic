<?php
class Ajax extends controller{
    public $UserModel;

    public function __construct()
    {
        $this->UserModel= $this->model("UserModel");
    }

    public function checkUsername(){
        // $un=$_POST["un"];
        
        // echo $this->UserModel->checkUsername($un);
        echo "Cuộc sống mà";
        //ajax ko cần gọi view vì nó chạy thẳng lên server
        //rồi in ra đúng sai thôi
    }
}
?>