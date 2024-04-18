

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
 

.box_container{
   
   padding:2% 8%;
   display:grid;
   grid-template-columns: repeat(auto-fit , minmax(15rem, 1fr)); 
   column-gap: 1rem;
}
.box_container .box {
    background-color: #3e5287;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.9); 
    padding: 2rem;
    text-align: center;
    border-radius: 5px;
    margin: 1rem;
}
.dashboard h3{
    text-align:center;
    font-size:2rem;
}
.dashboard p {
    font-size:20px;
    text-transform: capitalize;
    margin: .5rem 0 ; 
}



    </style>




</head>
<body>
    <?php include 'admin_header.php';
    include 'connection.php'; ?>

    <div class="container mt-4">
        <section class="dashboard">
        <h1>WELCOME TO THE ADMIN DASHBOARD</h1>
       <div class="box_container">
        <div class="box">

        <?php
        $total_pendings = 0;
        $select_pendings = mysqli_query($conn, "SELECT * FROM `reservation` WHERE payment_status = 'pendings'")
                          or die('Query failed');
        while ($fetch_pending = mysqli_fetch_assoc($select_pendings)) {
            $total_pendings += $fetch_pending['total_price'];
        }
        


        ?>
        <h3>$<?php echo $total_pendings;?>/-</h3>
        <p>total pendings</p>
        </div>


         <div class="box">
        <?php
        $total_completes= 0;
        $select_completes= mysqli_query($conn, "SELECT * FROM `reservation` WHERE payment_status = 'completes'")
                          or die('Query failed');
        while ($fetch_completes = mysqli_fetch_assoc($select_completes)) {
            $total_completes += $fetch_completes['total_price'];
        }
        


        ?>
        <h3>$<?php echo $total_completes;?>/-</h3>
        <p>total completes</p>
        </div>
        


        <div class="box">  
        <?php
        $select_reservation= mysqli_query($conn, "SELECT * FROM `reservation` ")
                          or die('Query failed');
        
        $num_of_reservation=mysqli_num_rows($select_reservation);
        ?>
        <h3><?php echo $num_of_reservation;?></h3>
        <p>reservation placed</p>
        </div>

        <div class="box">  
        <?php
        $select_voyage= mysqli_query($conn, "SELECT * FROM `voyage` ")
                          or die('Query failed');
        
        $num_of_voyage=mysqli_num_rows($select_voyage);
        ?>
        <h3><?php echo $num_of_voyage;?></h3>
        <p>voyage</p>
        </div>

        <div class="box">  
    <?php
    $select_admins = mysqli_query($conn, "SELECT * FROM `admin` ")
                     or die('Query failed');
    $num_of_admin = mysqli_num_rows($select_admins); // Utilisez $select_admins au lieu de $select_admin
    ?>
    <h3><?php echo $num_of_admin; ?></h3>
    <p>Number of admins</p>
</div>



        <div class="box">  
        <?php
   
        $select_message= mysqli_query($conn, "SELECT * FROM `message` ")
                          or die('Query failed');
        
        $num_of_message=mysqli_num_rows($select_message);
        ?>
        <h3><?php echo $num_of_message;?></h3>
        <p>new messages </p>
        </div>




        



       </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
