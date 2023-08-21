<?php
 require "connection.php";

$sql = "SELECT * from insertion";
$stmt = $conn->prepare($sql);
$stmt->execute();
$student = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>READ</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<body>
<div class="container w-50">
  <h4 class="mb-3">STUDENT DETAILS</h4>
<table class="table table-striped ">
  <thead>
    <tr>
      <th>STUDENT ID</th>
      <th>STUDENT NAME</th>
      <th>STUDENT EMAIL</th>
      <th colspan="4">ACTION</th>
      
    </tr>
  </thead>
  <tbody>
    <?php foreach($student as $stud): ?>
    <tr>
      <td><?=$stud->studentid;?></td>
      <td><?=$stud->studentname;?></td>
      <td><?=$stud->studentmail;?></td>
      <td><a href="edit.php?id=<?=$stud->id;?>" class="btn btn-success">EDIT</a></td>
      <td><a href="delete.php" class="btn btn-danger">DELETE</a></td>
    </tr>
    <?php endforeach ?>
    
  </tbody>
 
</table>
<div>
  <a href="index.php" class="btn btn-primary">Back</a>
</div>
</div>

</body>
</html>