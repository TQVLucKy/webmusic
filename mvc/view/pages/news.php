<h2>
    <?php
        echo $data["Sothich"][1];
        echo $data["Number"];
    ?>
</h2>

<?php
while($rows= mysqli_fetch_array($data["SV"])){
    echo $rows["hoten"]."</br>";
};
?>