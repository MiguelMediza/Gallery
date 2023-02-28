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
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <title>Galeria</title>

</head>
<div class="main">
    <header>
        <div class="header-container">
            <a href="index.php" class="logo">M Gallery</a>
            <span class="menu-icon"><i name="menu" class="fa-solid fa-bars"></i></span>
            <nav class="navigation">
                    <ul>
                        <li><a href="index.php">Home </a></li>
                        <li><a href="#">Acount<a ></li>
                    </ul>
            </nav >
        </div >
    </header>
    <body>
    <div class="upload">
    <div class="upfrm">
        <?php if(!empty($statusMsg)){?>
            <p class="status-msg"> <?php echo $statusMsg;?> </p>
            <?php } ?>
            <form id="form" class="form" method="post" enctype="multipart/form-data">
                <div class="form-components">
                    <h1 class="form-title">Selecciona una imagen:</h1 >
                    <input class="form-input" type="file" name="files[]" multiple >
                    <input class="form-submit" type="submit" name="submit" value="UPLOAD">
                </div >
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

    <div class="container galeria-container">  
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
                
            <div class="grid-item"><img class="img" data-fancybox="gallery-1" data-caption="<?php echo  $row['file_name'];?>" src="<?php echo $imageURL;?>" alt="">
            <a id="delete" href="delete.php?id=<?php echo  $row['id']; ?>" ><i class="fa-solid fa-delete-left delete"></i><a ></div >
        

            <?php }
            } ?>
            
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
<script src="menu.js"></script>
<script src="js.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/0e1554a48e.js" crossorigin="anonymous"></script>

</body>
</html>