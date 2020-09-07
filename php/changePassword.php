<?php
    require '../database/get.php';
    require '../database/edit.php';
    require '../Usefull-PHP/up_check.php';
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.html');
        exit;
    }

    $error = '';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['changePasword'])){
            if(isset($_POST['oldPassword']) && isset($_POST["newPassword1"]) && isset($_POST["newPassword2"])){
                if(up_check::checkPassword($_SESSION['id'], $_POST['oldPassword'])){
                    if(up_check::checkPasswordMatch($_POST['newPassword1'], $_POST['newPassword2'])){
                        if(up_check::passwordStrength($_POST['newPassword1'])){
                            if(Edit::updatePassword($_SESSION['id'], $_POST['newPassword1'])){
                                header('Location: profile.php');
                            }else{$error = "Something went wrong please contact the website owner!";}
                        }else {$error = "password doesn't meet strength requirements!";}
                    }else {$error = "The new passwords dont match!";}
                }else{$error = "Current Password incorrect!";}
            }else{$error ="Not all fields were filled in!";}
        }
    }

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

    <title>Change Password</title>
    <link rel="icon" href="../img/iconR.png">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark greyBg justify-content-between">
            <a class="navbar-brand" href="home.php">Homework TODO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="home.php">Overview</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link whiteText" href="profile.php">Profile<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categoryList.php">Categories</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            New
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="newCategory.php">Category</a>
                            <a class="dropdown-item" href="newTask.php">Task</a>
                        </div>
                    </li>
                    <li>

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
            <div class="col-md-7 greyBg mt-5 p-4 whiteText">
                <h5>Change Password</h5>
                <form action="" method="POST">
                    <div class="form-group mt-4">
                        <label for="oldPassword">Current Password</label>
                        <?php if(isset($_POST['oldPassword'])) : ?>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" value="<?php echo $_POST['oldPassword'] ?>" required>
                        <?php else : ?>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                        <?php endif ?>
                    </div>
                    <div class="form-group ">
                        <label for="newPassword1">New Password</label>
                        <?php if(isset($_POST['newPassword1'])) : ?>
                            <input type="password" class="form-control" id="newPassword1" name="newPassword1" value="<?php echo $_POST['newPassword1'] ?>" required>
                        <?php else : ?>
                            <input type="password" class="form-control" id="newPassword1" name="newPassword1" required>
                        <?php endif ?>
                    </div>
                    <p class="smallText">Password needs to be at least 8 or more characters and it has to have at least one number and one capital letter.</p>
                    <div class="form-group">
                        <label for="newPassword2">Confirm New Password</label>
                        <?php if(isset($_POST['newPassword2'])) : ?>
                            <input type="password" class="form-control" id="newPassword2" name="newPassword2" value="<?php echo $_POST['newPassword2'] ?>" required>
                        <?php else : ?>
                            <input type="password" class="form-control" id="newPassword2" name="newPassword2" required>
                        <?php endif ?>
                    </div>
                    
                    <?php echo "<p class='neonRed'>$error</p>"; ?>
                    <div class="mt-4">
                        <button class="btn btn-danger my-sm-2 float-right" name="changePasword" >Confirm Password Change</button>
                    </div>
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