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
    public function getall(){
        $sql = "SELECT * FROM storemusic";
        $result = mysqli_query($this->con,$sql);

        // Kiểm tra và xử lý kết quả trả về

        //sử dụng cái này và rồi get id rồi trả về như cái song.js
        $songs = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $song = array(
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "artist" => $row["artist"],
                    "path" => "../MoMat-LilWuynDen-9760819.mp3",
                    "image" => $row["nameimage"]
                );
                array_push($songs, $song);
            }
        }
        return $song;
    }

}
?>