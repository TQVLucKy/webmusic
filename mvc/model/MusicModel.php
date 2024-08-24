<?php
class MusicModel extends DB
{
    public function Music()
    {
        $sql = "SELECT storemusic.IdMusic, storemusic.NameMusic, GROUP_CONCAT(DISTINCT artist.NameArtist ORDER BY artist.IdArtist SEPARATOR ' x ') AS NameArtist, category.NameCategory, storemusic.NameImageMusic
            FROM song_artist
            JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
            JOIN song_category ON song_artist.IdMusic  = song_category.IdMusic
            JOIN category on song_category.IdCategory=category.IdCategory
            JOIN artist ON song_artist.IdArtist = artist.IdArtist
            GROUP BY storemusic.IdMusic, storemusic.NameMusic,category.NameCategory, storemusic.NameImageMusic";
        return mysqli_query($this->con, $sql);
    }

    public function Library()
    {
        if (!isset($_SESSION['userid'])) return [];
        if ($_SESSION['userid'] != 1) {
            $sql = "SELECT library.IdList AS Id, library.NameList AS Name
            FROM library 
            JOIN account_library ON library.IdList = account_library.IdList
            WHERE account_library.IdAccount = ?";
        } else {
            $sql = "SELECT album.IdAlbum AS Id,album.NameAlbum AS Name
            FROM album JOIN account_album on album.IdAlbum=account_album.IdAlbum
            WHERE account_album.IdAccount=?";
        }
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $_SESSION['userid']);
        $stmt->execute();
        $result = $stmt->get_result(); // Lấy kết quả từ câu truy vấn

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Trả về tất cả kết quả dưới dạng mảng liên kết
        } else {
            return [];
        }
    }

    public function Album()
    {
        $sql = "SELECT IdAlbum as Id, NameAlbum as Name FROM Album";
        return mysqli_query($this->con, $sql);
    }

    public function Category()
    {
        $sql = "SELECT * FROM Category";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $Category = [];
        while ($row = $result->fetch_assoc()) {
            $Category[] = $row;
        }
        return $Category;
    }
    public function getCategory()
    {
        $IdCategory = htmlspecialchars($_GET['id']);
        $sql = "SELECT storemusic.IdMusic, storemusic.NameMusic, GROUP_CONCAT(artist.NameArtist ORDER BY artist.IdArtist SEPARATOR ' x ') AS NameArtist, category.NameCategory, storemusic.NameImageMusic
            FROM song_artist
            JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
            JOIN song_category ON song_artist.IdMusic = song_category.IdMusic
            JOIN category ON song_category.IdCategory = category.IdCategory
            JOIN artist ON song_artist.IdArtist = artist.IdArtist
            WHERE category.IdCategory=?
            GROUP BY storemusic.IdMusic, storemusic.NameMusic,category.NameCategory, storemusic.NameImageMusic";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $IdCategory);
        $stmt->execute();
        $result = $stmt->get_result(); // Lấy kết quả từ câu truy vấn

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Trả về tất cả kết quả dưới dạng mảng liên kết
        } else {
            return [];
        }
    }
    public function getall()
    {
        $idList = isset($_GET['idList']) ? htmlspecialchars($_GET['idList']) : null;
        if ($idList === null) {
            $sql = "SELECT storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic, GROUP_CONCAT(artist.NameArtist SEPARATOR ' x ') AS NameArtist,storemusic.View,storemusic.state
        FROM song_artist
        JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
        JOIN artist ON song_artist.IdArtist = artist.IdArtist
        GROUP BY storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic";
        } else {
            $sql = "SELECT storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic, GROUP_CONCAT(artist.NameArtist SEPARATOR ' x ') AS NameArtist,storemusic.View,storemusic.state
        FROM listmusic
        JOIN song_artist on listmusic.IdMusic=song_artist.IdMusic
        JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
        JOIN artist ON song_artist.IdArtist = artist.IdArtist
        WHERE listmusic.IdList=?
        GROUP BY storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic";
        }
        $stmt = $this->con->prepare($sql);
        if ($idList !== null)
            $stmt->bind_param('i', $idList);

        $stmt->execute();
        $result = $stmt->get_result();
        $songs = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $song = array(
                    "id" => $row["IdMusic"],
                    "name" => $row["NameMusic"],
                    "artist" => $row["NameArtist"],
                    "view" => $row["View"],
                    "path" => "../music/{$row['NameMusic']}-{$row['NameArtist']}.mp3",
                    "image" => $row["NameImageMusic"],
                    "favorite" => $row["state"]
                );
                array_push($songs, $song);
            }
        }
        return $songs;
    }


    public function getListMusic()
    {
        $sql = "SELECT storemusic.IdMusic,storemusic.NameMusic,category.NameCategory,GROUP_CONCAT(DISTINCT artist.NameArtist SEPARATOR ' x ') AS NameArtist
        FROM song_artist join artist on song_artist.IdArtist= artist.IdArtist
		JOIN song_category ON song_artist.IdMusic = song_category.IdMusic
        join category on song_category.IdCategory=category.IdCategory
        join storemusic on song_artist.IdMusic=storemusic.IdMusic
        JOIN listmusic on song_artist.IdMusic=listmusic.IdMusic
        join library on listmusic.IdList=library.IdList
        join account_library on library.IdList= account_library.IdList
        WHERE IdAccount=? And listmusic.IdList=?
        GROUP BY storemusic.IdMusic,storemusic.IdMusic,category.NameCategory";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ii', $_SESSION['userid'], $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();

        $listMusic = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list = array(
                    "IdMusic" => $row["IdMusic"],
                    "NameMusic" => $row["NameMusic"],
                    "NameArtist" => $row["NameArtist"],
                    "NameCategory" => $row["NameCategory"]
                );
                array_push($listMusic, $list);
            }
        }
        return $listMusic;
    }


    // get list album from library
    public function getAlbumMusic()
    {
        $sql = "SELECT storemusic.IdMusic,storemusic.NameMusic,storemusic.NameImageMusic,category.NameCategory,GROUP_CONCAT(DISTINCT artist.NameArtist ORDER BY artist.IdArtist SEPARATOR ' x ') AS NameArtist,album.NameAlbum
        FROM song_artist join artist on song_artist.IdArtist= artist.IdArtist
		JOIN song_category ON song_artist.IdMusic = song_category.IdMusic
        join category on song_category.IdCategory=category.IdCategory
        join storemusic on song_artist.IdMusic=storemusic.IdMusic
        join album_song on song_artist.IdMusic=album_song.IdMusic
        join album on album_song.IdAlbum=album.IdAlbum
        join account_album on album.IdAlbum=account_album.IdAlbum
        WHERE album_song.IdAlbum=?
        -- WHERE account_album.IdAccount=? and album_song.IdAlbum=?
        GROUP BY storemusic.IdMusic,category.NameCategory,category.NameCategory";
        $stmt = $this->con->prepare($sql);
        // $stmt->bind_param("ii", $_SESSION['userid'], $_GET['id']);
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $AlbumMusic = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $album = array(
                    "IdMusic" => $row["IdMusic"],
                    "NameMusic" => $row["NameMusic"],
                    "NameImageMusic"=> $row["NameImageMusic"],
                    "NameArtist" => $row["NameArtist"],
                    "NameCategory" => $row["NameCategory"],
                    "NameAlbum" => $row["NameAlbum"]
                );
                array_push($AlbumMusic, $album);
            }
        }
        return $AlbumMusic;
    }


    public function AddAlbum($namealbum)
    {

        $sql = "INSERT INTO album(NameAlbum) VALUES (?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $namealbum);
        $stmt->execute();
        $IdAlbum = $stmt->insert_id;
        $sql = "INSERT INTO account_album(IdAccount,IdAlbum) VALUES (?,?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ii', $_SESSION['userid'], $IdAlbum);
        $stmt->execute();
    }
    // Thêm nhạc vào danh sách phát
    public function addMusicToLibrary($IdList, $IdMusic)
    {
        //Sau này sẽ thay đổi lại: khi đã lưu ở trong library nào đó
        //thì khi nhấn vào lại sẽ chuyển sang hủy thêm nào library đó
        //or đã tồn tại trong 1 library thì chuyển nút thêm thành hủy (1 trong 2 cách)

        //chỉnh sửa khi thêm music và xem lại add music
        //làm view show library
        // Kiểm tra xem IdList và IdMusic đã tồn tại chưa
        $userId = $_SESSION['userid'];
        $query = "SELECT COUNT(*) AS count FROM listmusic
            JOIN account_library on listmusic.IdList=account_library.IdList
            WHERE listmusic.IdList = '$IdList' AND IdMusic = '$IdMusic' AND IdAccount='$userId'";
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
                $sql = "INSERT INTO listmusic (IdList, IdMusic) VALUES ('$IdList', '$IdMusic')";
                mysqli_query($this->con, $sql);
                echo "Thêm thành công";
            }
        } else {
            echo "da ton tai IdMusic";
        }
    }

    // Thêm nhạc vào album
    public function addMusicToAlbum($IdAlbum, $IdMusic)
    {
        //chỉnh sửa khi thêm music và xem lại add music
        //làm view show library
        // Kiểm tra xem IdList và IdMusic đã tồn tại chưa
        $userId = $_SESSION['userid'];
        $query = "SELECT COUNT(*) AS count
        FROM album_song 
        JOIN account_album on album_song.IdAlbum=account_album.IdAlbum
        WHERE album_song.IdAlbum = '$IdAlbum' AND IdMusic = '$IdMusic' AND IdAccount='$userId'";
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
                $sql = "INSERT INTO album_song(IdAlbum, IdMusic) VALUES ('$IdAlbum', '$IdMusic')";
                mysqli_query($this->con, $sql);
            }
        } else {
            echo "da ton tai IdMusic";
        }
    }
    // xóa nhạc khỏi danh sách phát
    public function deleteMusicFromLibrary($IdList, $IdMusic)
    {
        $sql = "DELETE FROM listmusic
        WHERE IdList=? and IdMusic=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ii", $IdList, $IdMusic);
        if ($stmt->execute())
            echo "Xóa nhạc ở danh sách phát thành công";
        else
            echo "Error: " . $stmt->error;
    }
    // xóa nhạc khỏi album
    public function deleteMusicFromAlbum($IdAlbum, $IdMusic)
    {
        $sql = "DELETE FROM album_song
        WHERE IdAlbum=? and IdMusic=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ii", $IdAlbum, $IdMusic);
        if ($stmt->execute())
            echo "Xóa nhạc ở album thành công";
        else
            echo "Error: " . $stmt->error;
    }

    public function SearchText($val)
    {
        $sql = "SELECT storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic, GROUP_CONCAT(artist.NameArtist SEPARATOR 'x') AS NameArtists
                FROM song_artist 
                JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
                JOIN artist ON song_artist.IdArtist = artist.IdArtist
                WHERE NameMusic like ?
                GROUP BY storemusic.IdMusic";
        $stmt = $this->con->prepare($sql);
        $val = "%" . $val . "%";
        $stmt->bind_param("s", $val);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'IdMusic' => $row['IdMusic'],
                'NameImageMusic' => $row['NameImageMusic'],
                'NameMusic' => $row['NameMusic'],
                'NameArtists' => $row['NameArtists']
            ];
        }

        return $data;
    }


    public function addList($name)
    {
        // Thêm danh sách mới vào database
        $sql = "insert into library(NameList) values (?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('s', $name);
        if ($stmt->execute()) {
            $idList = $this->con->insert_id;
            echo "danh sách tạo thành công.";

            $sql = "insert into account_library (IdList,IdAccount) values (?,?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param('ii', $idList, $_SESSION['userid']);
            if (!$stmt->execute())
                echo "Lỗi: " . $sql . "<br>" . $this->con->error;
        } else {
            echo "Lỗi: " . $sql . "<br>" . $this->con->error;
        }
    }

    //thêm artist vào db
    public function addArtist($NameArtist, $imageArtist)
    {
        // Chuyển ảnh thành dạng số lưu trữ để tránh trùng lặp
        $folder_i = 'imgartist/';
        $file_extension = explode('.', $imageArtist['name'])[1];
        $file_name_i = time() . '.' . $file_extension;
        $path_file_i = $folder_i . $file_name_i;
        move_uploaded_file($imageArtist["tmp_name"], $path_file_i);

        $sql = "INSERT INTO artist (artist.NameArtist,artist.NameImageArtist) VALUES (?,?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('si', $NameArtist, $file_name_i);
        $stmt->execute();
        echo 'thêm ca sĩ thành công';
    }

    public function saveMusic($namemusic, $music, $image, $artists, $category)
    {
        if (empty($namemusic) || empty($music) || empty($image) || empty($artists) || empty($category)) {
            return "Please fill in all required fields.";
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
        $artists_string = implode(' x ', $artists);
        $file_name_m = $namemusic . '-' . $artists_string . '.' . $file_extension;
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
        $addimage->execute();
        $musicId = $addimage->insert_id;
        echo "musicid" . $musicId;
        echo "Hình ảnh đã được tải lên thành công!</br>";


        //Kiểm tra và thêm category vào db
        // $category= implode(",",$category);

        $stmt = $this->con->prepare("SELECT IdCategory FROM category WHERE NameCategory = ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows() > 0) {
            $stmt->bind_result($categoryId);
            $stmt->fetch();
            echo "Thể loại đã tồn tại!</br>";
        } else {
            $stmt = $this->con->prepare("INSERT INTO category (NameCategory) VALUES (?)");
            $stmt->bind_param("s", $category);
            $stmt->execute();
            $categoryId = $stmt->insert_id;
        }
        echo "categoryid" . $categoryId;

        foreach ($artists as $artist) {
            $stmt = $this->con->prepare("SELECT IdArtist FROM artist WHERE NameArtist=?");
            $stmt->bind_param("s", $artist);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows() > 0) {
                $stmt->bind_result($artistId);
                $stmt->fetch();
                echo "artitstid:" . $artistId;
            } else {
                $stmt = $this->con->prepare("INSERT INTO artist(NameArtist) VALUES (?)");
                $stmt->bind_param("s", $artist);
                $stmt->execute();
                $artistId = $stmt->insert_id;
                echo "artistid:" . $artistId;
            }
            //Thêm nhạc vào bảng song_artist
            $stmt = $this->con->prepare("INSERT INTO song_artist (IdMusic,IdArtist) VALUES (?,?)");
            $stmt->bind_param("ii", $musicId, $artistId);
            $stmt->execute();
            //Thêm nhạc vào bảng song_category
            $stmt = $this->con->prepare("INSERT INTO song_category (IdMusic,IdCategory) VALUES (?,?)");
            $stmt->bind_param("ii", $musicId, $categoryId);
            $stmt->execute();
        }
        echo "Bài hát thêm thành công";
    }

    
    // xóa bài nhạc khỏi hệ thống
    public function DeleteMusic($IdMusic, $IdArtist, $IdCategory)
    {
        $sql_select = "SELECT artist.NameArtist, storemusic.NameImageMusic, storemusic.NameMusic
        FROM song_artist
            JOIN artist ON song_artist.IdArtist = artist.IdArtist
            JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
            JOIN song_category ON song_artist.IdMusic = song_category.IdMusic
            JOIN category ON song_category.IdCategory = category.IdCategory
        WHERE storemusic.IdMusic=? AND artist.IdArtist=? AND category.IdCategory=?";
        $stmt_select = $this->con->prepare($sql_select);
        $stmt_select->bind_param("iii", $IdMusic, $IdArtist, $IdCategory);
        $stmt_select->execute();
        $stmt_select->bind_result($NameArtist, $NameImageMusic, $NameMusic);
        while ($stmt_select->fetch()) {
            $file_music = "music/$NameMusic-$NameArtist.mp3";
            echo $file_music;
            if (file_exists($file_music)) {
                if (unlink($file_music))
                    echo "Xóa tập tin nhạc thành công";
                else
                    echo "Xóa tập tin nhạc thất bại";
            } else
                echo "Tập tin nhạc không tồn tại";
            $file_img = "img/$NameImageMusic.jpg";
            echo $file_img;
            if (file_exists($file_img)) {
                if (unlink($file_img))
                    echo "Xóa tập tin ảnh thành công";
                else
                    echo "Xóa tập tin ảnh thất bại";
            } else
                echo "Tập tin ảnh không tồn tại";
        }

        $sql_delsac = "DELETE FROM song_artist
        WHERE IdMusic=? and IdArtist=? and IdCategory=?;";
        $stmt_delsac = $this->con->prepare($sql_delsac);
        $stmt_delsac->bind_param("iii", $IdMusic, $IdArtist, $IdCategory);
        if ($stmt_delsac->execute())
            echo "Xóa bài nhạc thành công";
        else
            echo "Error: " . $stmt_delsac->error . "</br>";
        $sql_delMusic = "DELETE FROM storemusic WHERE IdMusic=?;";
        $stmt_delMusic = $this->con->prepare($sql_delMusic);
        $stmt_delMusic->bind_param("i", $IdMusic);
        if ($stmt_delMusic->execute())
            echo "Xóa hoàn toàn thành công";
        else
            echo "Error: " . $stmt_delMusic->error . "</br>";
    }

    public function DelDanhSachPhat($IdList)
    {
        $sql = "DELETE FROM listmusic
            WHERE IdList=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $IdList);
        $stmt->execute();

        $sql = "DELETE FROM account_library
        WHERE IdList=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $IdList);
        $stmt->execute();

        $sql = "DELETE FROM library
        WHERE IdList=?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $stmt->bind_param("i", $IdList);
    }


    public function DelAlbum($IdAlbum)
    {
        $sql = "DELETE FROM album_song
        WHERE IdAlbum=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $IdAlbum);
        $stmt->execute();

        $sql = "DELETE FROM account_album
        WHERE IdAlbum=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $IdAlbum);
        $stmt->execute();

        $sql = "DELETE FROM album
        WHERE IdAlbum=?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $stmt->bind_param("i", $IdAlbum);
    }

    public function updateFavorite($IdMusic)
    {
        $sql = "UPDATE storemusic SET state = IF(state = 1, 0, 1) WHERE IdMusic = $IdMusic";
        mysqli_query($this->con, $sql);
    }

    public function getRecommendations($song_id)
    {
        
        $sql = "SELECT IdCategory, IdArtist
        FROM song_artist 
        JOIN song_category on song_artist.IdMusic=song_category.IdMusic
        WHERE song_artist.IdMusic = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $song_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $current_song = $result->fetch_assoc();
        $IdCategory = $current_song['IdCategory'];
        $IdArtist = $current_song['IdArtist'];

        // Lấy các bài hát gợi ý dựa trên thể loại và ca sĩ
        $sql = "SELECT IdMusic, NameImageMusic, NameMusic, NameArtists, View
        FROM (
        SELECT storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic, GROUP_CONCAT(artist.NameArtist ORDER BY artist.IdArtist SEPARATOR ' x ') AS NameArtists, storemusic.View
        FROM song_artist
        JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
        JOIN artist ON song_artist.IdArtist = artist.IdArtist
        JOIN song_category ON song_artist.IdMusic = song_category.IdMusic
        WHERE (song_category.IdCategory = ? OR song_artist.IdArtist = ?) AND storemusic.IdMusic != ?
        GROUP BY storemusic.IdMusic
        ORDER BY RAND()
        LIMIT 10
    ) AS result
    ORDER BY View DESC;"; 
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("iii", $IdCategory, $IdArtist, $song_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $recommendations = [];
        while ($row = $result->fetch_assoc()) {
            $recommendations[] = [
                'IdMusic' => $row['IdMusic'],
                'NameImageMusic' => $row['NameImageMusic'],
                'NameMusic' => $row['NameMusic'],
                'NameArtists' => $row['NameArtists'],
                'View' => $row['View']
            ];
        }
        return $recommendations;
    }

    public function getRecommendedByArtist($artist_id, $song_id)
    {
        $sql = "SELECT storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic, GROUP_CONCAT(artist.NameArtist SEPARATOR ' x ') AS NameArtists,storemusic.View
                FROM song_artist 
                JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
                JOIN artist ON song_artist.IdArtist = artist.IdArtist
                WHERE song_artist.IdArtist = ? AND storemusic.IdMusic != ?
                GROUP BY storemusic.IdMusic
                ORDER BY storemusic.View DESC
                LIMIT 5";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ii", $artist_id, $song_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $recommendedByArtist = [];
        while ($row = $result->fetch_assoc()) {
            $recommendedByArtist[] = [
                'IdMusic' => $row['IdMusic'],
                'NameImageMusic' => $row['NameImageMusic'],
                'NameMusic' => $row['NameMusic'],
                'NameArtists' => $row['NameArtists'] ?? "Unknown Artist",
                'View' => $row['View']
            ];
        }
        return $recommendedByArtist;
    }

    public function getArtists($song_id)
    {
        $sql = "SELECT artist.IdArtist,artist.NameArtist
        FROM artist join song_artist on artist.IdArtist=song_artist.IdArtist
        WHERE song_artist.IdMusic= ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $song_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $getArtists = [];
        while ($row = $result->fetch_assoc()) {
            $getArtists[] = [
                'IdArtists' => $row['IdArtist'],
                'NameArtists' => $row['NameArtist']
            ];
        }
        return  !empty($getArtists) ? $getArtists : null;
    }

    public function getArtist($song_id)
    {
        $sql = "SELECT artist.IdArtist,artist.NameArtist
        FROM artist join song_artist on artist.IdArtist=song_artist.IdArtist
        WHERE song_artist.IdMusic= ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $song_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $getArtist = [];
        while ($row = $result->fetch_assoc()) {
            $getArtist[] = [
                'IdArtists' => $row['IdArtist'],
                'NameArtists' => $row['NameArtist']
            ];
        }
        return  !empty($getArtist) ? $getArtist[0] : null;
    }
    // lấy tất cả bài nhạc của artist
    public function getArtistAll($IDArtist)
    {
        $sql = "SELECT storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic, GROUP_CONCAT(artist.NameArtist SEPARATOR ' x ') AS NameArtists
        FROM song_artist 
        JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
        JOIN artist ON song_artist.IdArtist = artist.IdArtist
        WHERE song_artist.IdArtist = ?
        GROUP BY storemusic.IdMusic
        LIMIT 10";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $IDArtist);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $artistAll[] = [
                'IdMusic' => $row['IdMusic'],
                'NameImageMusic' => $row['NameImageMusic'],
                'NameMusic' => $row['NameMusic'],
                'NameArtists' => $row['NameArtists']
            ];
        }
        return $artistAll;
    }

    public function getAlbumhHasArtist($IdArtist)
    {
        $sql = "SELECT album.IdAlbum, album.NameAlbum, artist.NameArtist
        FROM album_song
        JOIN album on album_song.IdAlbum=album.IdAlbum
        JOIN song_artist ON album_song.IdMusic=song_artist.IdMusic
        JOIN artist on song_artist.IdArtist= artist.IdArtist
        WHERE artist.IdArtist=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $IdArtist);
        $stmt->execute();
        $result = $stmt->get_result();
        $album = [];
        while ($row = $result->fetch_assoc()) {
            $album[] = [
                'IdAlbum' => $row['IdAlbum'],
                'NameAlbum' => $row['NameAlbum'],
                'NameArtist' => $row['NameArtist']

            ];
        }
        return $album;
    }

    public function increaseViews($IdMusic)
    {
        $sql = "UPDATE storemusic
            SET	View=View+1
            WHERE IdMusic=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $IdMusic);
        $stmt->execute();
    }

    public function getSongFromList($idMusic, $idList = null)
    {
        if ($idList != null) {
            $sql = "SELECT storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic, GROUP_CONCAT(artist.NameArtist SEPARATOR ' x ') AS NameArtist,storemusic.state
        FROM listmusic
        JOIN song_artist on listmusic.IdMusic=song_artist.IdMusic
        JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
        JOIN artist ON song_artist.IdArtist = artist.IdArtist
        WHERE song_artist.IdMusic=? AND listmusic.IdList=?
        GROUP BY storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("ii", $idMusic, $idList);
        } else {
            $sql = "SELECT storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic, GROUP_CONCAT(artist.NameArtist SEPARATOR ' x ') AS NameArtist,storemusic.state
        FROM song_artist
        JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
        JOIN artist ON song_artist.IdArtist = artist.IdArtist
        GROUP BY storemusic.IdMusic, storemusic.NameImageMusic, storemusic.NameMusic";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("i", $idMusic);
        }

        $stmt->execute();
        $result = $stmt->get_result();
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

    public function getRandomMusic($IdMusic)
    {
        $sql = "SELECT*,
        GROUP_CONCAT(DISTINCT IdArtist) as artists, 
        GROUP_CONCAT(DISTINCT IdCategory) as categories 
        FROM song_artist
        JOIN song_category on song_artist.IdMusic= song_category.IdMusic
        WHERE song_artist.IdMusic = ?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $IdMusic);
        $stmt->execute();
        $result = $stmt->get_result();
        $musicData = $result->fetch_assoc();

        if ($musicData) {
            $artists = $musicData['artists'];  
            $categories = $musicData['categories']; 

            // Truy vấn để tìm bài nhạc ngẫu nhiên dựa trên IdArtist và IdCategory
            $sql = "SELECT song_artist.IdMusic
            FROM song_artist
            JOIN song_category on song_artist.IdMusic= song_category.IdMusic
            WHERE song_artist.IdMusic != ? 
            AND (FIND_IN_SET(song_artist.IdArtist, ?) OR FIND_IN_SET(song_category.IdCategory, ?))
            ORDER BY RAND()
            LIMIT 1";

            $stmt = $this->con->prepare($sql);
            $stmt->bind_param('iss', $IdMusic, $artists, $categories);
            $stmt->execute();
            $result = $stmt->get_result();
            $song = $result->fetch_assoc();
            if ($song) {
                echo json_encode(['success' => true, 'song' => $song]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
    }
}
