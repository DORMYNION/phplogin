<?php 
    include 'part/header.php';
?>

    <!-- start wrap div -->   
    <div id="wrap">
        <!-- start PHP code -->
        <?php
         
            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                // Verify data
                $email = mysqli_real_escape_string($conn, $_GET['email']); // Set email variable
                $hash = mysqli_real_escape_string($conn, $_GET['hash']); // Set hash variable


                $sql = "SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    $sql = "UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
                    
                    if ($conn->query($sql) === TRUE) {
                        echo "Record updated successfully";
                        echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } else {
                    echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
                }

            }else{
                // Invalid approach
                echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
            }
        ?>
        <!-- stop PHP Code -->
 
         
    </div>
    <!-- end wrap div --> 
    <?php  
        include 'part/conn.php';
    ?>
