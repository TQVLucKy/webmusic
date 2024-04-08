<?php
    class Playmusic extends controller{
        public $a;
        
        public function __construct()
        {
            //model
            $this->a=$this->model("MusicModel"); 
        }
    
        function Play(){

            $this->view("master1",[
                "page"=>"playmusic",
                "MS" => $this->a->Music(),
                "Lib"=> $this->a->Library()
                ]);
        }
    }
?>