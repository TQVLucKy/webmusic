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
            "Lib"=> $this->a->Library(),
            "Album"=> $this->a->Album()
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
                "getlist" => $this->a->getListMusic(),
                "Album"=> $this->a->Album(),
                "getalbum" => $this->a->getAlbumMusic(),
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

        //Hiển thị danh sách bài nhạc để xử lý
        public function DelList() {
            $this->view("master1",[
                "page"=>"DelList",
                "MS"=>$this->a->Music(),
                "Lib"=> $this->a->Library(),
                "g"=> $this->a->getall(),
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
            $musicModel->saveMusic($_POST['musicName'],$files['music'], $files['image'], $_POST['artist'],$_POST['category']);
        }
    }
?>