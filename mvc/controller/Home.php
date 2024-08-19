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
            "Album"=> $this->a->Album(),
            "Category"=> $this->a->Category()
            ]);
        }
        function Play(){
            $this->view("master1",[
                "page"=>"playmusic",
                "MS" => $this->a->Music(),
                "Lib"=> $this->a->Library(),
                "g"=> $this->a->getall(),
                "Category"=> $this->a->Category()
                ]);
        }
        function Category(){
            // View
            $this->view("master1",[
            "page"=>"Category",
            "MS" => $this->a->Music(),
            "Lib"=> $this->a->Library(),
            "Album"=> $this->a->Album(),
            "Category"=> $this->a->Category(),
            "getCategory" => $this->a->getCategory()
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
                "Category"=> $this->a->Category()
                ]);
        }

        function Artist(){
            $this->view("master1",[
                "page"=>"Artist",
                "Lib"=> $this->a->Library(),
                "Category"=> $this->a->Category()
            ]);
        }
        function ShowSearch(){
            $this->view("master1",[
                "page"=>"ShowSearch",
                "MS" => $this->a->Music(),
                "Lib"=> $this->a->Library(),
                "g"=> $this->a->getall(),
                "getlist" => $this->a->getListMusic(),
                "Category"=> $this->a->Category()
                ]);
        }

        //Hiển thị danh sách bài nhạc để xử lý
        public function DelMusic() {
            $this->view("master1",[
                "page"=>"DelMusic",
                "MS"=>$this->a->Music(),
                "Lib"=> $this->a->Library(),
                "g"=> $this->a->getall(),
                "Category"=> $this->a->Category()
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