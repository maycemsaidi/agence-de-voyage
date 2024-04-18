<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <?php
    include 'connection.php';
    
     //adding voyage to db
     if(isset($_POST['add_voyage'])){

      /*$voyage_id=mysqli_real_escape_string($conn,$_POST['voyage_id']);*/
      $destination=mysqli_real_escape_string($conn,$_POST['destination']);
      $price=mysqli_real_escape_string($conn,$_POST['price']);
      $description=mysqli_real_escape_string($conn,$_POST['description']);
      $image=$_FILES['image']['size'];
      $image_tmp_name=$_FILES['image']['tmp_name'];
      $image_folder='image/' .$image;


      $select_destination=mysqli_query($conn,"SELECT destination FROM `voyage` WHERE destination= '$destination' ") or die ('query failer');
      if(mysqli_num_rows($select_destination)>0){
        $message[]='product already exist';
      }else{
        $insert_voyage=mysqli_query($conn,"INSERT INTO`voyage`(`destination`,`price`,`description`,`image`) 
        VALUES('$destination','$price','$description','$image')")or die ('query failed');
        if($insert_voyage){
            if($image_size>2000000){
                $message[]='image size is too large';
            }else{
              move_uploaded_file($image_tmp_name,$image_folder); 
              $message[]='voyage added successfully';
            }
        }

      }

     }









    
    
    
    
    ?>
    
    
<style>
.add-voyage{
    margin-top:   60px;
    padding-top: 20px;
    padding-bottom: 20px;
    height: auto;
    background-color: #f5f5f5;
    position:relative;
  

}</style>




</head>
<body>
    <?php include 'admin_header.php';
    ?>
    <?php
    if(isset($message)){
        foreach($message as $message){
            echo ' 
            <div class="message">
            <span> ' .$message.' </span>
            <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
            </div>
            ';

        }
    }
    
    ?>
    <div class="line2"></div>
<section class="add-voyage form container">
    <form method="POST" action="" enctype="multipart/form-data">

       

       <div class="input-field">
        <label>Destination</label>
        <input type="text" name="destination" required>
       </div>

       <div class="input-field">
        <label>Price</label>
        <input type="text" name="price" required>
       </div>

       <div class="input-field">
        <label>Description</label>
        <textarea name="description" required></textarea>
       </div>

       <div class="input-field">
        <label>Image</label>
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/webp " required>
       </div><br>

       <input type="submit" name="add_voyage" value="add voyage" class="btn btn-dark" >

        
    </form>
</section><br><br><br><br>
<section class="show_voyage">
    <div class="box-container">
        <?php
        $select_voyage = mysqli_query($conn, "SELECT * FROM `voyage`") or die('Query failed');
        if (mysqli_num_rows($select_voyage) > 0) {
            while ($fetch_voyage = mysqli_fetch_assoc($select_voyage)) {
        ?>
                <div class="box">
                    <img src="image/<?php echo $fetch_voyage['image']; ?>">
                    <p>price:$<?php echo $fetch_voyage['price'];?></p>
                    <h4><?php echo $fetch_voyage['destination'];?></h4>
                    <details><?php echo $fetch_voyage['description'];?></details>
                    <a href="admin_voyage.php?edit=<?php echo $fetch_voyage['voyage_id'];?>" class="edit">edit</a>
                    <a href="admin_voyage.php?delete=<?php echo $fetch_voyage['voyage_id'];?>" class="delete" onclick="return confirm('want to delete this voyage');">delete</a>
                </div>
        <?php
            }
        } else {
            echo '
            <div class="empty">
            <p>0 voyages added</p>
            </div>
            ';
        }
        ?>
    </div>
</section>

<script type ="text/javascript" src="script.js"></script>
</body>
</html>
