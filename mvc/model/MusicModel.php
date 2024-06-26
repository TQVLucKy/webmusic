<?php
class MusicModel extends DB
{
    public function Music()
    {
        $sql = "SELECT storemusic.id,storemusic.name,storemusic.nameimage,artist.ArtistName,category.CategoryName,storemusic.state
                FROM song_artist join artist on song_artist.ArtistId= artist.ArtistId
		                    join category on song_artist.CategoryId=category.CategoryId
                            join storemusic on song_artist.id=storemusic.id";
        return mysqli_query($this->con, $sql);
    }

    public function Library()
    {
        $qr = "select * from library";
        return mysqli_query($this->con, $qr);
    }


    public function getall()
    {
        $sql = "SELECT storemusic.id,storemusic.name,storemusic.nameimage,artist.ArtistName,category.CategoryName,storemusic.state
FROM song_artist join artist on song_artist.ArtistId= artist.ArtistId
		join category on song_artist.CategoryId=category.CategoryId
        join storemusic on song_artist.id=storemusic.id";
        $result = mysqli_query($this->con, $sql);

        // Kiểm tra và xử lý kết quả trả về

        //sử dụng cái này và rồi get id rồi trả về như cái song.js
        $songs = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $song = array(
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "artist" => $row["ArtistName"],
                    "path" => "../music/{$row['name']}-{$row['ArtistName']}.mp3",
                    "image" => $row["nameimage"],
                    "favorite" => $row["state"]
                );
                array_push($songs, $song);
            }
        }
        return $songs;
    }
    // get list from library
    public function getListMusic()
    {
        $sql = "select library.NameList, storemusic.name,storemusic.id,library.IdList,storemusic.artist
        from listmusic join library on listmusic.IdList = library.IdList
        join storemusic on listmusic.id = storemusic.id";
        return mysqli_query($this->con, $sql);
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


    public function SearchText($val)
    {
        $sql = "select * from storemusic where name like '%" . $val . "%'";
        $result = mysqli_query($this->con, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return ($data);
    }


    public function addList($name)
    {
        // Thêm danh sách mới vào database
        $sql = "insert into library(NameList) values ('$_GET[namelist]')";
        if (mysqli_query($this->con, $sql)) {
            echo "danh sách tạo thành công.";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $this->con->error;
        }
    }

    public function saveMusic($musicname, $music, $image, $artists)
    {
        // Theo đó thay đổi lại nơi lấy các bài nhạc các thứ: home,library(addmusic)
        // idea sẽ là khi thêm nhạc nếu là 2 tk trở lên thì trong bảng song_artist sẽ
        // có cùng số id với nhau và khi xuất ra thì dựa vào đó để gọi

        // echo $music;
        // echo $image;
        // echo $artist;
        

        // Chuyển ảnh thành dạng số lưu trữ để tránh trùng lặp
        $folder_i = 'img/';
        $imagename = explode('.', $image['name'])[0];
        $file_extension = explode('.', $image['name'])[1];
        $file_name_i = time() . '.' . $file_extension;
        $path_file_i = $folder_i . $file_name_i;
        move_uploaded_file($image["tmp_name"], $path_file_i);
        // lưu bài hát vào storemusic
        $addstoremusic = "INSERT INTO storemusic ( name,nameimage) VALUES 
        ('$musicname', '$file_name_i')";
        //lưu ca sĩ vào artist khi trong đấy chưa có tên ca sĩ đấy
        $artist = implode(", ", $artists);
        // $addartist="IF NOT EXISTS (SELECT 1 from artist where ArtistName = '$artist' )
        //     insert into artist(ArtistName) values ('$artist');";
        $addartist = " INSERT INTO artist (ArtistName)
            SELECT ?
            WHERE NOT EXISTS (
            SELECT 1 FROM artist WHERE ArtistName = ?
        ) LIMIT 1;";

        // c bị câu truy vấn
        $stmt= $this->con->prepare($addartist);

        // gán giá trị vào dấu ?
        $stmt->bind_param("ss",$artist,$artist);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "New artist inserted successfully";
            } else {
                echo "Artist already exists";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        // tên nhạc thì mình sẽ lưu dưới dạng là [tên nhạc]-[tên ca sĩ].[mp3,...]
        // $msName = addslashes($_FILES["music"]["name"]);
        // $msData = addslashes(file_get_contents($_FILES["music"]["tmp_name"]));
        // $folder_m = 'music/';
        // $file_extension = explode('.', $music['name'])[1];
        // $file_name_m = time() . '.' . $file_extension;
        // $path_file_m = $folder_m . $file_name_m;
        // move_uploaded_file($music["tmp_name"], $path_file_m);
        //đường dẫn tạm thời của tệp hình ảnh đã được gửi lên
        $folder_m = 'music/';
        $file_extension = explode('.', $music['name'])[1];
        $file_name_m = $musicname .'-'. $artist .'.'. $file_extension;
        $path_file_m = $folder_m . $file_name_m;
        move_uploaded_file($music["tmp_name"], $path_file_m);

        
        if (mysqli_query($this->con, $addstoremusic) === TRUE) {
            echo "Hình ảnh đã được tải lên thành công.";
        } else {
            echo "Lỗi: " . $addstoremusic . "<br>" . $this->con->error;
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
