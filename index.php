<?php
include_once 'upload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>

    <title>Galeria</title>

</head>
<header>
    <ul>
        <li class="navigation">Home</li>
        <li class="navigation">Acount</li>
    </ul>
</header>
<body>
<div class="container">
<div class="upfrm">
    <?php if(!empty($statusMsg)){?>
        <p class="status-msg"> <?php echo $statusMsg;?> </p>
        <?php } ?>
        <form id="form"  method="post" enctype="multipart/form-data">
            Select Image Files to Upload:
            <input type="file" name="files[]" multiple >
            <input type="submit" name="submit" value="UPLOAD">
        </form>
</div >
</div >
<script type="text/javascript">
$(document).ready(function() {
    $('#form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'upload.php',
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response);
                // user is logged in successfully in the back-end 
                // let's redirect 
                if (jsonData.success == "1")
                {
                    location.href = 'index.php';
                }
                else
                {
                    alert('selecciona imagen');
                }
           }
       });
     });
});
</script>
<div class="container">  
<div class="gallery">
    <?php
    // Include database configuration file
    require 'conexion.php';
    
    // Retrieve images from the database
    $query = $db->query("SELECT * FROM images WHERE status = 1 ORDER BY uploaded_on DESC");
    
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            $imageURL = 'uploads/'.$row["file_name"];
            
    ?>
        
     <div class="grid-item"><img data-fancybox="gallery-1" data-caption="<?php echo  $row['file_name'];?>" src="<?php echo $imageURL;?>" alt=""></div >
   

    <?php }
    } ?>
</div>
</div>

<script src="js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>



</body>
</html>