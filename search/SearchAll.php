
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'music';

$link = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_GET["term"]) && isset($_GET["idList"])) {
    $term = $_GET["term"];

    $sql = "SELECT *
    FROM (
    SELECT 
        storemusic.IdMusic, 
        storemusic.NameMusic, 
        GROUP_CONCAT(artist.NameArtist ORDER BY artist.IdArtist SEPARATOR ' x ') AS NameArtist, 
        category.NameCategory
    FROM song_artist
    JOIN storemusic ON song_artist.IdMusic = storemusic.IdMusic
    JOIN song_category on song_artist.IdMusic= song_category.IdMusic
    JOIN category ON song_category.IdCategory = category.IdCategory
    JOIN artist ON song_artist.IdArtist = artist.IdArtist
    GROUP BY storemusic.IdMusic, storemusic.NameMusic, category.NameCategory
    ) AS subquery
    WHERE 
        subquery.NameMusic LIKE ? 
        OR subquery.NameCategory LIKE ? 
        OR subquery.NameArtist LIKE ?";

    if ($stmt = $link->prepare($sql)) {
        $param_term =  '%' . $term . '%';
        $stmt->bind_param("sss", $param_term, $param_term, $param_term);

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
                echo '</tb><td>';
                echo '<button onclick="playMusic(this)" data-idMusic="' . htmlspecialchars($row['IdMusic']) . '">Play</button>';
                echo '<button onclick="addMusicToDanhSachPhat(this)" data-idMusic="' . htmlspecialchars($row['IdMusic']) . '">Add</button>';
                echo '</td></tr>';
                $stt++;
            }
        }
        $stmt->close();
    }
}
$link->close();
?>