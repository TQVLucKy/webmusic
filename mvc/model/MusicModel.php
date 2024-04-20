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

    public function addList($name)
    {
        // Thêm danh sách mới vào database
        $sql = "insert into library(NameList) values ('$_POST[namelist]')";
        if (mysqli_query($this->con, $sql)) {
            echo "danh sách tạo thành công.";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $this->con->error;
        }
    }

    public function saveMusic($music, $image, $artist)
    {   
        // echo $music;
        // echo $image;
        // echo $artist;
        // $msName = addslashes($_FILES["music"]["name"]);
        // $msData = addslashes(file_get_contents($_FILES["music"]["tmp_name"]));
        $folder_m = 'music/';
        $file_extension = explode('.', $music['name'])[1];
        $file_name_m = time() . '.' . $file_extension;
        $path_file_m = $folder_m . $file_name_m;
        move_uploaded_file($music["tmp_name"], $path_file_m);
        // //đường dẫn tạm thời của tệp hình ảnh đã được gửi lên
        // $imageName = addslashes($image["name"]);
        // $imageData = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $folder_i = 'img/';
        $imagename=explode('.', $image['name'])[0];
        $file_extension = explode('.', $image['name'])[1];
        $file_name_i = time() . '.' . $file_extension;
        $path_file_i = $folder_i . $file_name_i;
        move_uploaded_file($image["tmp_name"], $path_file_i);


        $sql = "INSERT INTO storemusic ( name,nameimage,namemusic, artist) VALUES 
        ('$imagename', '$file_name_i','$file_name_m','$_POST[artist]')";
        if (mysqli_query($this->con, $sql) === TRUE) {
            echo "Hình ảnh đã được tải lên thành công.";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $this->con->error;
        }
    }

    //Add music 
    // public function addMusic($music, $image, $artist)
    // {
    //         // Lấy dữ liệu từ form
    //         $dataField = $_POST["data_field"];
    //         // Xử lý dữ liệu ở đây
    //         $msName = addslashes($_FILES["music"]["name"]);
    //         $msData = addslashes(file_get_contents($_FILES["music"]["tmp_name"]));
    //         $folder_m = 'music/';
    //         $music = $_FILES['music'];
    //         $file_extension = explode('.', $music['name'])[1];
    //         $file_name_m = time() . '.' . $file_extension;
    //         $path_file_m = $folder_m . $file_name_m;
    //         move_uploaded_file($music["tmp_name"], $path_file_m);
    //         //đường dẫn tạm thời của tệp hình ảnh đã được gửi lên
    //         $imageName = addslashes($_FILES["image"]["name"]);
    //         $imageData = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    //         $folder_i = 'img/';
    //         $photo = $_FILES['image'];
    //         $file_extension = explode('.', $photo['name'])[1];
    //         $file_name_i = time() . '.' . $file_extension;
    //         $path_file_i = $folder_i . $file_name_i;
    //         move_uploaded_file($photo["tmp_name"], $path_file_i);

    //         $sql = "INSERT INTO storemusic ( name,nameimage,namemusic, artist) VALUES
    //         ('$imageName', '$file_name_i','$file_name_m','$_POST[artist]')";
    //         if (mysqli_query($this->con, $sql) === TRUE) {
    //             echo "Hình ảnh đã được tải lên thành công.";
    //         } else {
    //             echo "Lỗi: " . $sql . "<br>" . $this->con->error;
    //         }
    // }
}
