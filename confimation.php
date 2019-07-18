<?php  
    include 'part/header.php';
?>

<?php     
    // if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email'])){
    //     $name = $_POST['name']; // Turn our post into a local variable
    //     $email = $_POST['email']; // Turn our post into a local variable
?>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div>
                    <div class="text-center py-4 ">
                        <span class="db"><img src="./assets/images/logo.png" alt="logo" /></span>
                    </div>
                    
                    <p>Your account has been registered successfully, <br /> please verify it by clicking the activation link that has been send to your email</p>
                    

                </div>
            </div>
        </div>

<?php      
    // } else {
    //     header("location: ./index.php");
    // }
             
?>


<?php  
    include 'part/footer.php';
?>