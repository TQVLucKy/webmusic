<?php
    class Home extends controller{
        public $a;
        
        public function __construct()
        {
            //model
            $this->a=$this->model("MusicModel"); 
        }
        function Show(){
            // View
            $this->view("master1",[
            "page"=>"home",
            "MS" => $this->a->Music(),
            "Lib"=> $this->a->Library()
            ]);
        }
        function Play(){

            $this->view("master1",[
                "page"=>"playmusic",
                "MS" => $this->a->Music(),
                "Lib"=> $this->a->Library(),
                "g"=> $this->a->getall()
                ]);
        }
    }
?>