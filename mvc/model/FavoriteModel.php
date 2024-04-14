<?php
class test extends DB{
    // Hàm để lấy trạng thái favorite từ cơ sở dữ liệu
    public function UpdateFavorite($id) {
        // Kết nối đến cơ sở dữ liệu và thực hiện các thao tác để lấy trạng thái favorite
        // Trong ví dụ này, chúng ta giả sử rằng trạng thái được trả về từ cơ sở dữ liệu là true hoặc false
        // Bạn cần thay đổi code này để phản ánh cách bạn làm việc với cơ sở dữ liệu của mình
        $sql = "UPDATE storemusic SET state = IF(state = 1, 0, 1) WHERE id = $id";
        mysqli_query($this->con,$sql);
        
    }
}
?>
