<?php
class App{
    //http://localhost/GitHub/webmusic/Play/1
    protected $controller="Home";
    protected $action="Show";
    protected $params=[];


    function __construct()
    {
        //Array ( [0] => Home [1] => Hasagi [2] => 1 [3] => 2 [4] => 3 )
        $arr = $this->UrlProcess();
        // print_r($arr);
        //Xử lý controller
        if(file_exists("./mvc/controller/".$arr[0].".php")){
            $this->controller=$arr[0];
            unset($arr[0]);
        };
        require_once "./mvc/controller/".$this->controller.".php";
        $this->controller = new $this->controller;

        //Xử lý Action
        if(isset($arr[1])){
            if(method_exists($this->controller, $arr[1])){
                $this->action=$arr[1];
            }
            unset($arr[1]);
        }


        //Xử lý Params
        $this->params = $arr?array_values($arr):[];


        // echo $this->controller."<br/>";
        // echo $this->action."<br/>";
        // print_r($this->params);
        $controllerInstance = new $this->controller();
        call_user_func_array([$controllerInstance, $this->action], $this->params);
    }

    function UrlProcess(){
        if(isset($_GET["url"])){
            return explode("/",filter_var(trim($_GET["url"])));
        }
    }
}
?>