<?php
class MusicModel extends DB{
    public function Music(){
        $qr="select * from storemusic";
        return mysqli_query($this->con,$qr);
       
    }

    public function Library(){
        $qr="select * from library";
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
                    "path" => "../music/MoMat-LilWuynDen-9760819.mp3",
                    "image" => $row["nameimage"],
                    "favorite" => $row["state"]
                );
                array_push($songs, $song);
            }
        }
        return $songs;
    }

    public function AddMusicToLibrary($IdList,$id){

        //quét trường hợp khi music đã thêm vào nhưng vẫn tiếp tục thêm
        //làm view show library
        $sql= "INSERT INTO listmusic (IdList,id) values('$IdList','$id')";
        return mysqli_query($this->con,$sql);
    }
}
?>