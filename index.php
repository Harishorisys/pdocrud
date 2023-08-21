<?php 
require "connection.php";
$msg = "";

if(isset($_POST['submit'])){
    $id = $_POST['studentid'];
    $name = $_POST['studentname'];
    $email = $_POST['studentemail'];

    $sql = "SELECT * from insertion where studentid = :studentid   limit 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['studentid'=>$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user){ 
        // echo "the id is already registered";
        echo "<script type='text/javascript'>alert('The id is already registered')</script> ";
    }else{
      $sql = "SELECT * from insertion where studentmail =:studentemail limit 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['studentemail'=>$email]);
    $usr = $stmt->fetch(PDO::FETCH_ASSOC);
    if($usr){
        // echo "the email is already is registered";
        echo "<script type='text/javascript'>alert('The email is already registered')</script> ";
   }
    else{
        $sql = "INSERT into insertion (studentid,studentname,studentmail) VALUES(:studentid,:studentname,:studentemail)";
    $stmt = $conn->prepare($sql);
    
    if($stmt->execute([':studentid'=>$id,':studentname'=>$name,':studentemail'=>$email])){
        $msg = "THE DATA IS INSERTED";
    }
    }
      
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<form method="post">
    
  <div class="container w-25 mt-5">
  <h5><?php echo $msg;?></h5>
    <h2 class="mb-3">INSERTION</h2>
    <div class="mb-3">
    <input type="text"  name="studentid" class="form-control bg-light" placeholder="StudentId">
  </div>
  <div class="mb-3">
    <input type="text"  name="studentname" class="form-control bg-light" placeholder="StudentName">
  </div>
  <div class="mb-3 ">
    <input type="email" name="studentemail" class="form-control bg-light" placeholder="StudentEmail" >
  </div>
  <div class="mb-2">
  <button type="submit" name="submit" class="btn btn-danger">Insert</button>
  </div>
  <div>
    <a href="read.php" class="btn btn-primary text-dark" >Read Details</a>
  </div>
</div>
</form>
    
</body>
</html>