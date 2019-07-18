<?php  
    include 'part/header.php';
?>

<?php     
    if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']); // Turn our post into a local variable
        $email = mysqli_real_escape_string($conn, $_POST['email']); // Turn our post into a local variable

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            // Return Error - Invalid Email
            $msg = 'The email you have entered is invalid, please try again.';
        }else{
            // Return Success - Valid Email
            $hash = md5( rand(0,1000) ); 
            $password = rand(1000,5000); 

            $sql = "INSERT INTO users (name, password, email, hash) 
            VALUES('". mysqli_real_escape_string($conn, $name) ."', '". mysqli_real_escape_string($conn, md5($password)) ."', '". mysqli_real_escape_string($conn, $email) ."', '". mysqli_real_escape_string($conn, $hash) ."')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }


            require_once 'part/verify_mail.php';
            echo '<a href=email='.$email.'&hash='.$hash.'>Link</a>';
            header("location: ./confimation.php");
            $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
        }
    }
             
?>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div class="col-12">
                    <div class="form-group">
                        <div class="py-4">
                            <a href="./index.php" class="btn btn-block btn-lg btn-danger" type="submit">Back to Home</a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="text-center py-4 ">
                        <span class="db"><img src="https://dummyimage.com/178x24/bbbbbb/000000&text=Logo" alt="logo" /></span>
                    </div>
                    <?php 
                        if(isset($msg)){  // Check if $msg is not empty
                            echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and wrap it with a div with the class "statusmsg".
                        } 
                    ?>
                    <!-- Form -->
                    <form class="form-horizontal mt-4" action="" method="POST">
                        <div class="row pb-4">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" required>
                                </div>
                                <!-- email -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="text" name="email" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="py-4">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php  
    include 'part/footer.php';
?>