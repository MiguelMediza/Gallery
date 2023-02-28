<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="sweetalert2.min.css">
</head>
<body>

<?php
include_once 'conexion.php'; 

$id=$_GET['id'];

$query = $db->query("SELECT * FROM images WHERE id=".$id.";");

if($query->num_rows > 0){
  while($row = $query->fetch_assoc()){
      $imageURL = 'uploads/'.$row["file_name"];
  }
}
if(!empty($id)){
$insert = $db->query("DELETE FROM images WHERE id=".$id.";"); 


unlink($imageURL);



}

?>

<script src="sweetalert2.all.min.js"></script>
</body>
</html>

