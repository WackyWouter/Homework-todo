<?php
    require '../database/get.php';
    require '../database/edit.php';
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.html');
        exit;
    }

    $error = '';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['submitBtn'])){
            if(isset($_POST["securityQuestion"]) && isset($_POST["securityAnswer"])){
                if(Edit::updateSecurity($_SESSION['id'], $_POST['securityQuestion'], $_POST['securityAnswer'])){
                    header('Location: profile.php');
                }else{$error = "Something went wrong please contact the website owner!";}
            }else{$error ="Not all fields were filled in!";}
        }
    }
   
    $securityQuestions = Get::getSecurityQuestions();
    if(count($securityQuestions) == 0){
        header('Location: error.php?error=Unable to retrieve the security questions.');
    }
    $security = get::getSecurity($_SESSION['id']);
    $currentDate = date('l d-m-Y');

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

    <title>Security</title>
    <link rel="icon" href="../img/iconR.png">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-md navbar-dark greyBg justify-content-between">
            <a class="navbar-brand" href="home.php">Homework TODO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="home.php">Overview</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link whiteText" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categoryList.php">Categories</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="newTask.php">New Task</a>
                    </li>

                </ul>
                <div class="form-inline ">
                    <p id="currentDate" class="navbar-nav mr-4" style="color: rgba(255,255,255,.75)">
                        <?php echo $currentDate ?></p>
                </div>
                <form action="../database/logout.php" class="form-inline">
                    <button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
                </form>
            </div>
        </nav>
    </div>

    <div class="container-fluid p-0">
        <div id="formRow" class="row justify-content-center">
            <div class="col-lg-8 greyBg mt-5 p-4 whiteText">
                <h5>Security</h5>
                <form action="" method="POST" class="mt-4">
                    <div class="form-group">
                        <label for="securityQuestion">Security Question</label>
                        <select class="form-control" id="securityQuestion" name="securityQuestion" required>
                            <?php foreach($securityQuestions as $question): ?>
                                <?php if($question['securityQuestion'] === $security['securityQuestion']): ?>
                                    <option selected value="<?php echo $question['securityQuestion'] ?>"><?php echo $question['securityQuestion'] ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $question['securityQuestion'] ?>"><?php echo $question['securityQuestion'] ?></option>
                                <?php endif; ?>
                                
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="securityAnswer">Security Answer</label>
                        <input type="text" class="form-control" id="securityAnswer" name="securityAnswer" maxlength="250" aria-describedby="securityAnswer"
                        required value="<?= $security['securityAnswer'];?>">
                    </div>
                    <?php echo "<p class='neonRed'>$error</p>"; ?>
                    <button class="btn btn-danger mt-2 float-right" name="submitBtn" type="submit">Confirm</button>
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