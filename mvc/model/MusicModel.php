<?php
class MusicModel extends DB
{
    public function Music()
    {
        $sql = "SELECT *
                FROM song_artist_category join artist on song_artist_category.IdArtist= artist.IdArtist
		                    join category on song_artist_category.IdCategory=category.IdCategory
                            join storemusic on song_artist_category.IdMusic=storemusic.IdMusic";
        return mysqli_query($this->con, $sql);
    }

    public function Library()
    {
        $qr = "select * from library";
        return mysqli_query($this->con, $qr);
    }


    public function getall()
    {
        $sql = "SELECT storemusic.IdMusic,storemusic.NameMusic,storemusic.NameImageMusic,artist.NameArtist,category.NameCategory,storemusic.state
FROM song_artist_category join artist on song_artist_category.IdArtist= artist.IdArtist
		join category on song_artist_category.IdCategory=category.IdCategory
        join storemusic on song_artist_category.IdMusic=storemusic.IdMusic";
        $result = mysqli_query($this->con, $sql);

        // Kiểm tra và xử lý kết quả trả về

        //sử dụng cái này và rồi get id rồi trả về như cái song.js
        $songs = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $song = array(
                    "id" => $row["IdMusic"],
                    "name" => $row["NameMusic"],
                    "artist" => $row["NameArtist"],
                    "path" => "../music/{$row['NameMusic']}-{$row['NameArtist']}.mp3",
                    "image" => $row["NameImageMusic"],
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
        $sql = "select library.NameList, storemusic.NameMusic,storemusic.IdMusic,library.IdList,artist.NameArtist
        FROM song_artist_category join artist on song_artist_category.IdArtist= artist.IdArtist
		join category on song_artist_category.IdCategory=category.IdCategory
        join storemusic on song_artist_category.IdMusic=storemusic.IdMusic
        JOIN listmusic on song_artist_category.IdMusic=listmusic.IdMusic
        join library on listmusic.IdList=library.IdList";
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
                $sql = "INSERT INTO listmusic (IdList, IdMusic) VALUES ('$IdList', '$id')";
                mysqli_query($this->con, $sql);
            }
        } else {
            echo "da ton tai id";
        }
    }


    public function SearchText($val)
    {
        $sql = "select * from storemusic where NameMusic like '%" . $val . "%'";
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

    public function saveMusic($namemusic, $music, $image, $artists, $category)
    {
        // Theo đó thay đổi lại nơi lấy các bài nhạc các thứ: home,library(addmusic)
        // idea sẽ là khi thêm nhạc nếu là 2 tk trở lên thì trong bảng song_artist sẽ
        // có cùng số id với nhau và khi xuất ra thì dựa vào đó để gọi

        //Lưu ca sĩ
        //lưu ca sĩ vào artist khi trong đấy chưa có tên ca sĩ đấy
        $artist = implode(", ", $artists);
        // $addartist="IF NOT EXISTS (SELECT 1 from artist where NameArtist = '$artist' )
        //     insert into artist(NameArtist) values ('$artist');";
        $addartist = " INSERT INTO artist (NameArtist)
            SELECT ?
            WHERE NOT EXISTS (
            SELECT 1 FROM artist WHERE NameArtist = ?
        ) LIMIT 1;";

        // c bị câu truy vấn
        $stmt = $this->con->prepare($addartist);

        // gán giá trị vào dấu ?
        $stmt->bind_param("ss", $artist, $artist);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Ca sĩ được tải lên thành công";
            } else {
                echo "Ca sĩ đã tồn tại";
            }
        } else {
            echo "Error: " . $stmt->error;
        }


        // $msName = addslashes($_FILES["music"]["name"]);
        // $msData = addslashes(file_get_contents($_FILES["music"]["tmp_name"]));
        // $folder_m = 'music/';
        // $file_extension = explode('.', $music['name'])[1];
        // $file_name_m = time() . '.' . $file_extension;
        // $path_file_m = $folder_m . $file_name_m;
        // move_uploaded_file($music["tmp_name"], $path_file_m);
        //đường dẫn tạm thời của tệp hình ảnh đã được gửi lên

        // tên nhạc thì mình sẽ lưu dưới dạng là [tên nhạc]-[tên ca sĩ].[mp3,...]
        $folder_m = 'music/';
        $file_extension = explode('.', $music['name'])[1];
        $file_name_m = $namemusic . '-' . $artist . '.' . $file_extension;
        $path_file_m = $folder_m . $file_name_m;
        move_uploaded_file($music["tmp_name"], $path_file_m);


        // Chuyển ảnh thành dạng số lưu trữ để tránh trùng lặp
        $folder_i = 'img/';
        $imagename = explode('.', $image['name'])[0];
        $file_extension = explode('.', $image['name'])[1];
        $file_name_i = time() . '.' . $file_extension;
        $path_file_i = $folder_i . $file_name_i;
        move_uploaded_file($image["tmp_name"], $path_file_i);
        // Thêm ảnh vào db
        $addimage = $this->con->prepare("INSERT INTO storemusic(NameMusic ,NameImageMusic) VALUES (?,?)");
        $addimage->bind_param("ss", $namemusic, $file_name_i);
        if ($addimage->execute()) {
            echo "Hình ảnh đã được tải lên thành công!</br>";
        } else {
            echo "Error: " . $addimage->error . "</br>";
        }


        //Kiểm tra và thêm category vào db
        // $category= implode(",",$category);

        $addcategory = "INSERT INTO category (NameCategory)
            SELECT ?
            WHERE NOT EXISTS (
            SELECT 1 FROM category WHERE NameCategory=?
            ) LIMIT 1;";

        // Câu truy vấn
        $stmt = $this->con->prepare($addcategory);
        // Gán giá trị vào ??
        $stmt->bind_param("ss", $category, $category);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0)
                echo "Thể loại được tải lên thành công!</br>";
            else
                echo "Thể loại đã tồn tại!</br>";
        } else
            echo "Error: " . $stmt->error. "</br>";



        //Thêm bài nhạc vào danh sách
        //Chưa tính tới trường hợp song ca,...
        $addsong_artist_category = "INSERT INTO song_artist_category (IdMusic, IdArtist, IdCategory)
        SELECT sm.IdMusic, a.IdArtist, c.IdCategory
        FROM storemusic sm
            JOIN artist a ON sm.NameMusic = ? AND a.NameArtist = ?
            JOIN category c ON c.NameCategory = ?
        ORDER BY sm.IdMusic DESC
        LIMIT 1;";

        $stmt = $this->con->prepare($addsong_artist_category);

        $stmt->bind_param("sss", $namemusic, $artist, $category);
        if ($stmt->execute())
            echo "Bài nhạc đã được tải lên";
        else
            echo "Error: " . $stmt->error;
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

    // xóa bài nhạc khỏi hệ thống
    public function DeleteMusic($IdMusic,$IdArtist,$IdCategory){
        $sql_select="SELECT artist.NameArtist, storemusic.NameImageMusic, storemusic.NameMusic
        FROM song_artist_category
            JOIN artist ON song_artist_category.IdArtist = artist.IdArtist
            JOIN storemusic ON song_artist_category.IdMusic = storemusic.IdMusic
            JOIN category ON song_artist_category.IdCategory = category.IdCategory
        WHERE storemusic.IdMusic=? AND artist.IdArtist=? AND category.IdCategory=?";
        $stmt_select= $this->con->prepare($sql_select);
        $stmt_select->bind_param("iii",$IdMusic,$IdArtist,$IdCategory);
        $stmt_select->execute();
        $stmt_select->bind_result($NameArtist,$NameImageMusic,$NameMusic);
        while($stmt_select->fetch()){
            $file_music="music/$NameMusic-$NameArtist.mp3";
            echo $file_music;
            if(file_exists($file_music)){
                if(unlink($file_music))
                    echo "Xóa tập tin nhạc thành công";
                else 
                    echo "Xóa tập tin nhạc thất bại";
            }else
                echo "Tập tin nhạc không tồn tại";
            $file_img="img/$NameImageMusic.jpg";
            echo $file_img;
            if(file_exists($file_img)){
                if(unlink($file_img))
                    echo "Xóa tập tin ảnh thành công";
                else 
                    echo "Xóa tập tin ảnh thất bại";
            }else
                echo "Tập tin ảnh không tồn tại";
        }

        $sql_delsac= "DELETE FROM song_artist_category
        WHERE IdMusic=? and IdArtist=? and IdCategory=?;";
        $stmt_delsac= $this->con->prepare($sql_delsac);
        $stmt_delsac->bind_param("iii",$IdMusic,$IdArtist,$IdCategory);
        if($stmt_delsac->execute())
            echo "Xóa bài nhạc thành công";
        else
            echo "Error: ".$stmt_delsac->error."</br>";
        $sql_delMusic= "DELETE FROM storemusic WHERE IdMusic=?;";
        $stmt_delMusic=$this->con->prepare($sql_delMusic);
        $stmt_delMusic->bind_param("i",$IdMusic);
        if($stmt_delMusic->execute())
            echo "Xóa hoàn toàn thành công";
        else
            echo "Error: ".$stmt_delMusic->error."</br>";
    }
}
