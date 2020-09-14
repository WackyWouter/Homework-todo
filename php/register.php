<?php
    require '../database/get.php';
    require '../Usefull-PHP/up_check.php';
    require '../database/create.php';

    $error = '';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['submitBtn'])){
            if(isset($_POST['username']) && isset($_POST["password1"]) && isset($_POST["password2"]) && isset($_POST["securityQuestion"]) && isset($_POST["securityAnswer"])){
                if(up_check::checkPasswordMatch($_POST['password1'], $_POST['password2'])){
                    if(up_check::passwordStrength($_POST['password1'])){
                        if(strlen($_POST['securityAnswer'] < 251)){
                            if(Create::addUser($_POST['username'], $_POST['password1'], $_POST['securityQuestion'], $_POST['securityAnswer'])){
                                header('Location: home.php');
                            }else{$error = "Something went wrong please contact the website owner!";}
                        }else{$error = "Security Answer can't be longer then 250 characters!";}
                    }else {$error = "password doesn't meet strength requirements!";}
                }else {$error = "The new passwords dont match!";}
            }else{$error ="Not all fields were filled in!";}
        }
    }

    $securityQuestions = Get::getSecurityQuestions();

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">

    <title>Register</title>
    <link rel="icon" href="../img/iconR.png">
</head>

<body>
    <div class="container-fluid p-0">
        <div id="formRow" class="row justify-content-center">
            <div class="col-lg-8 greyBg mt-5 p-4 whiteText">
                <h5>Register</h5>
                <form action="" method="POST" class="mt-4">
                    <div class="form-group">
                        <!-- name / text -->
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="username" required>
                    </div>
                    <div class="form-group ">
                        <label for="password1">Password</label>
                        <input type="password" class="form-control" id="password1" name="password1" required>
                    </div>
                    <p class="smallText">Password needs to be at least 8 or more characters and it has to have at least one number and one capital letter and must not contain spaces, special characters, or emoji.</p>
                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" required>
                    </div>
                    <div class="form-group">
                        <label for="securityQuestion">Security Question</label>
                        <select class="form-control" id="securityQuestion" name="securityQuestion" required>
                            <?php foreach($securityQuestions as $question): ?>
                                <option value="<?php echo $question['securityQuestion'] ?>"><?php echo $question['securityQuestion'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="securityAnswer">Security Answer</label>
                        <input type="text" class="form-control" id="securityAnswer" name="securityAnswer" maxlength="250" aria-describedby="securityAnswer"
                        required>
                    </div>
                    <?php echo "<p class='neonRed'>$error</p>"; ?>
                    <button class="btn btn-danger mt-2 float-right" name="submitBtn" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>