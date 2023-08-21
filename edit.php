<?php
require "connection.php";


$id = $_GET['id'];
$sql = "SELECT * from insertion where id = :id   ";
$stmt = $conn->prepare($sql);
$stmt->execute([':id'=>$id]);
$student=$stmt->fetch(PDO::FETCH_OBJ);
if(isset($_POST['submit']) ){
  $studentid = $_POST['studentid'];
  $studentname = $_POST['studentname'];
  $studentemail = $_POST['studentemail'];

$sql = "SELECT * from insertion where studentid = :studentid AND id != :current_id LIMIT 1 ";
$stmt = $conn->prepare($sql);
$stmt->execute([':studentid'=>$studentid,':current_id'=>$id]);
$stud_user = $stmt->fetch(PDO::FETCH_ASSOC);

if($stud_user){
  echo "employee with this id is already exist";
}
else {

  $sql = "UPDATE insertion SET studentid = :studentid, studentname = :studentname, studentmail = :studentmail WHERE id=:id";
  $stmt_edit = $conn->prepare($sql);
  

  if($stmt_edit->execute([':id'=>$id,':studentid' => $studentid,':studentname'=>$studentname,':studentmail'=>$studentemail])){
    echo "Update Successfully";
    header("location:read.php");
  }
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<form method="post">
    
    <div class="container w-25 mt-5">
      <h2 class="mb-3">UPDATE</h2>
      <div class="mb-3">
      <input type="text"  name="studentid" class="form-control bg-light" value = "<?= $student->studentid;?>">
    </div>
    <div class="mb-3">
      <input type="text"  name="studentname" class="form-control bg-light" value = "<?= $student->studentname;?>">
    </div>
    <div class="mb-3 ">
      <input type="email" name="studentemail" class="form-control bg-light"  value = "<?= $student->studentmail;?>">
    </div>
    <div class="mb-2">
    <button type="submit" name="submit" class="btn btn-danger">UPDATE</button>
    </div>
    <div>
  
</div>
   
  </div>
  </form>
</body>
</html>