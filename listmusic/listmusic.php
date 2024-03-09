<head>
    <link rel="stylesheet" type="text/css" href="./listmusic/listmusic.css">
</head>
<div class="top d-flex justify-content-between mt-2">
    <h2>Danh sách phát</h2>
    <p class="text-secondary">Hiện tất cả</p>
</div>
<div class="list-music row">
    <div class="items col">
        <?php
        $count = 0;
        foreach ($results as $result) {
            echo '<div class="item col-2 mb-3 mx-3">';
            echo '<img style="max-width:100%;height:100%" src= ./img/' . $result['nameimage'] . '><br>';
            echo $result['name'] . "<br>";
            echo $result['artist'] . "<br>";
            echo '</div>';
            $count++;
            if ($count % 5 == 0) {
                echo '<div class="w-100"></div>';
            }
        }
        ?>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const itemList = document.querySelectorAll('.item');
        itemList.forEach((item, index)=> {
            item.addEventListener('click', () => {
                const itemId = index + 1;
                if (itemId) {
                    fetch(`get_product_details.php?id=${itemId}`)
                        .then(Response => Response.json())
                        .then(data => {
                            alert('cc');
                            document.querySelector('detail1').innerHTML = data;
                        })
                        .catch(error => console.error('Error:', error));
                }

            });
        });

    });
</script>