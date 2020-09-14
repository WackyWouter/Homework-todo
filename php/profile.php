<?php
    require '../database/get.php';
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.html');
        exit;
    }
    $user = Get::getUser($_SESSION['id']);
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

    <title>Profile</title>
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
                        <a class="nav-link whiteText" href="profile.php">Profile<span
                                class="sr-only">(current)</span></a>
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

    <div class="container-fluid p-0 mb-5">
        <div id="formRow" class="row justify-content-center">
            <div class="col-lg-8 greyBg mt-5 p-4 whiteText">
                <h5>Profile</h5>
                <div class="form-row mt-4">
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" value="<?php echo $user['username']?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" readonly value="<?php echo $user['password']?>">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="securityQuestion">Security Question</label>
                    <input type="text" class="form-control" id="securityQuestion" readonly value="<?php echo $user['securityQuestion']?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="securityAnswer">Security Answer</label>
                        <input type="text" class="form-control" id="password" readonly value="<?php echo $user['securityAnswer']?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="adddate">User since</label>
                        <input type="text" class="form-control" id="adddate" readonly value="<?php echo date('d-m-Y H:i:s', strtotime($user['adddate']));?>">
                    </div>
                </div>
                <div class="mt-4 ">
                    <form class="float-right" action="changePassword.php" method="POST">
                        <button class="btn btn-danger my-sm-2 " name="btn">Change Password</button>
                    </form>
                    <form class="float-right mr-3" action="editSecurity.php" method="POST">
                        <button class="btn btn-danger my-sm-2 " name="btn">Security</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-sm-12  text-center">
                <span class="smallText align-self-center ">This website was made and is owned by Wouter Bosch. You can reach him on wfcboschzakelijk@gmail.com</span>
              </div>
          </div>        
      </div>
    </footer>

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