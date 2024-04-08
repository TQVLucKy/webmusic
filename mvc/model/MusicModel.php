<?php
class MusicModel extends DB{
    public function Music(){
        $qr="select * from storemusic";
        return mysqli_query($this->con,$qr);
    }

    public function Library(){
        $qr="select * from listmusic";
        return mysqli_query($this->con,$qr);
    }
}
?>