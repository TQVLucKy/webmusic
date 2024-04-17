<?php
class MusicModel extends DB
{
    public function Music()
    {
        $qr = "select * from storemusic";
        return mysqli_query($this->con, $qr);
    }

    public function Library()
    {
        $qr = "select * from library";
        return mysqli_query($this->con, $qr);
    }


    public function getall()
    {
        $sql = "SELECT * FROM storemusic";
        $result = mysqli_query($this->con, $sql);

        // Kiểm tra và xử lý kết quả trả về

        //sử dụng cái này và rồi get id rồi trả về như cái song.js
        $songs = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
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

    public function AddMusicToLibrary($IdList, $id)
    {

        //Sau này sẽ thay đổi lại: khi đã lưu ở trong library nào đó
        //thì khi nhấn vào lại sẽ chuyển sang hủy thêm nào library đó
        //or đã tồn tại trong 1 library thì chuyển nút thêm thành hủy (1 trong 2 cách)
        
        //chỉnh sửa khi thêm music và xem lại add music



        //làm view show library
        // Kiểm tra xem IdList và id đã tồn tại chưa
        $query = "SELECT COUNT(*) AS count FROM listmusic WHERE IdList = '$IdList' AND id = '$id'";
        $result = mysqli_query($this->con, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
            mysqli_free_result($result);

            // Nếu đã tồn tại, xử lý lỗi hoặc thông báo cho người dùng
            if ($count > 0) {
                echo "da ton tai";
            } else {
                // Thực hiện lệnh INSERT vào cơ sở dữ liệu
                $sql = "INSERT INTO listmusic (IdList, id) VALUES ('$IdList', '$id')";
                mysqli_query($this->con, $sql);
            }
        } else {
            echo "da ton tai id";
        }
        
    }
}
