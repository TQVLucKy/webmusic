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

        function List(){
            $this->view("master1",[
                "page"=>"List",
                "MS" => $this->a->Music(),
                "Lib"=> $this->a->Library(),
                "g"=> $this->a->getall(),
                "getlist" => $this->a->getListMusic()
                ]);
        }
        function ShowSearch(){
            $this->view("master1",[
                "page"=>"ShowSearch",
                "MS" => $this->a->Music(),
                "Lib"=> $this->a->Library(),
                "g"=> $this->a->getall(),
                "getlist" => $this->a->getListMusic()
                ]);
        }

        public function createList($name) {
            // Gọi model để xử lý dữ liệu
            $listModel = new MusicModel();
            $listModel->addList($name);
        }

        public function uploadMusic($files) {
            // Gọi model để xử lý tải lên
            $musicModel = new MusicModel();
            $musicModel->saveMusic($_POST['musicname'],$files['music'], $files['image'], $_POST['artist']);
        }
    }
?>