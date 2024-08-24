
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
include '../mvc/code/DB.php';
    
$db=new DB();


if (isset($_GET["term"]) && isset($_GET["idList"])) {
    $term = $_GET["term"];
    $idList = $_GET["idList"];

    $sql = "SELECT *
    FROM (
    SELECT 
        storemusic.IdMusic, 
        storemusic.NameMusic, 
        GROUP_CONCAT(DISTINCT artist.NameArtist ORDER BY artist.IdArtist SEPARATOR ' x ') AS NameArtist, 
        category.NameCategory
    FROM listmusic 
    JOIN song_artist on listmusic.IdMusic=song_artist.IdMusic
    JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
    JOIN song_category on song_artist.IdMusic= song_category.IdMusic
    JOIN category ON song_category.IdCategory = category.IdCategory
    JOIN artist ON song_artist.IdArtist = artist.IdArtist
    WHERE listmusic.IdList = ?
    GROUP BY storemusic.IdMusic, storemusic.NameMusic, category.NameCategory
    ) AS subquery
    WHERE 
        subquery.NameMusic LIKE ? 
        OR subquery.NameCategory LIKE ? 
        OR subquery.NameArtist LIKE ?";

    if ($stmt = $db->con->prepare($sql)) {
        $param_term = '%'.$term . '%';
        $stmt->bind_param("isss", $idList, $param_term, $param_term, $param_term);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $stt = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr><td>';
                echo $stt;
                echo '</td><td>';
                echo htmlspecialchars($row['NameMusic']);
                echo '</td><td>';
                echo htmlspecialchars($row['NameArtist']);
                echo '</td><td>';
                echo htmlspecialchars($row['NameCategory']);
                echo '</td><td>';
                echo '<button onclick="playMusic(this)" data-idMusic="' . htmlspecialchars($row['IdMusic']).'">Play</button>';
                echo '<button onclick="deleteMusicFromDanhSachPhat(this)" data-idMusic="' . htmlspecialchars($row['IdMusic']) . '">Remove</button>';
                echo '</td></tr>';
                $stt++;
            }
        }
        $stmt->close();
    }
}
$db->con->close();
?>