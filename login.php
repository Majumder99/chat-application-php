<?php

$email = $password = '';
?>



<!DOCTYPE html>
<html>

<?php include "header1.php" ?>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <form id="myForm" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <h3 class="mb-5">Sign in</h3>

                            <div class="form-outline mb-4">
                                <label class="form-label margin-label1" for="typeEmailX-2">Email</label>
                                <input onchange="destination_file(<?php echo $destination; ?>)" name="email" value="<?php echo htmlspecialchars($email); ?>" type="email" id="typeEmailX-2" class="form-control form-control-lg" />
                                <div style="color: red;" id="email"></div>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label margin-label2" for="typePasswordX-2">Password</label>
                                <input name="password" value="<?php echo htmlspecialchars($password); ?>" type="password" id="typePasswordX-2" class="form-control form-control-lg" />
                                <div style="color: red;" id="password"></div>
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-start mb-4">
                                <input name="remember" class="form-check-input me-3" type="checkbox" id="remember_check" />
                                <label name="remember" class="form-check-label " for="remember_check"> Remember password </label>
                            </div>

                            <input type="button" value="Login" name="submit" class="btn btn-primary btn-lg btn-block" id="login_button">
                            <br>
                            <span>Don't have an account?</span> <a href="signup.php">Signup here</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php" ?>


<script src="assets/js/login.js">

</script>


</html>