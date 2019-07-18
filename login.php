<?php
   ob_start();
   session_start();
?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<?php  
    include 'part/header.php';
?>

<?php
    if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['password']) && !empty($_POST['password'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
                     
        $sql = "SELECT id, email, password, active FROM users WHERE email='".$email."' AND password='".$password."' AND active='1'";
        $result = $conn->query($sql);
        

        if ($result->num_rows > 0) {
            // output data of each row
            $fetch = $result->fetch_array(MYSQLI_ASSOC);
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['id'] = $fetch['id'];
            $_SESSION['email'] =  $fetch['email'];
        // print_r($_SESSION['email']);
            header("location: ./index.php");

            // Set cookie / Start Session / Start Download etc...
        } else {
            $msg = 'Login Failed! Please make sure that you enter the correct details and that you have activated your account.';
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
                <div id="loginform">
                    <div class="text-center py-4">
                        <span class="db"><img src="https://dummyimage.com/178x24/bbbbbb/000000&text=Logo" alt="logo" /></span>
                    </div>
                    <?php 
                        if(isset($msg)){ // Check if $msg is not empty
                            echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and add a div around it with the class statusmsg
                        } 
                    ?>
                    <!-- Form -->
                    <form class="form-horizontal mt-4" id="loginform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="POST">
                        <div class="row pb-4">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="text" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="text" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="pt-4">
                                        <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Lost password?</button>
                                        <button class="btn btn-success float-right" type="submit">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="recoverform">
                    <div class="text-center">
                        <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                    </div>
                    <div class="row mt-4">
                        <!-- Form -->
                        <form class="col-12" action="">
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Email" aria-describedby="basic-addon1">
                            </div>
                            <!-- pwd -->
                            <div class="row mt-4 pt-4 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
                                    <button class="btn btn-info float-right" type="button" name="action">Recover</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <script>
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){
        
        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    </script>
<?php  
    include 'part/footer.php';
?>
