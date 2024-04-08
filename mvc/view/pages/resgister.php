<h2>Resgister</h2>

<form action="./resgister/khachhangdangky" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username" id="username" class="form-control" aria-describedby="emailHelp" placeholder="Enter username">
    <div id="messageUn"></div>
</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">email</label>
    <input type="email" name="email"  class="form-control"  aria-describedby="emailHelp" placeholder="Enter email">
    
</div>
  <div class="form-group">
    <label for="exampleInputEmail1">hoten</label>
    <input type="text" name="hoten" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Hoten">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">diachi</label>
    <input type="text" name="diachi" class="form-control"  aria-describedby="emailHelp" placeholder="Enter diachi">
  </div>
  <button type="text" name="btnresgister" class="btn btn-primary">Submit</button>
</form>

<?php if(isset($data["result"])) { ?>
<h3><?php
    if($data["result"]){
        echo "dk thanh cong";
    }
    else {echo "dk that bai";}
?></h3>
<?php } ?>