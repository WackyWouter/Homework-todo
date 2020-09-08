<?php
    require '../database/get.php';
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.html');
        exit;
    }
    $task = [];
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['taskId']) ){
            $task = Get::getTask($_SESSION['id'], $_GET['taskId']);
        }else{
            header('Location: error.php');
        }
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

    <title>Task</title>
    <link rel="icon" href="../img/iconR.png">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark greyBg justify-content-between">
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
                        <a class="nav-link" href="profile.php">Profile</a>
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
                <h5><?php echo $task['name'] ?></h5>
                <div class="form-group mt-4">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" readonly><?php echo $task['description']?></textarea>
                </div>
                <div class="form-group ">
                    <label for="comments">Comments</label>
                    <textarea class="form-control" id="comments" readonly><?php echo $task['comments']?></textarea>
                </div>
                <div class="form-group">
                    <label for="duedate">Duedate</label>
                    <p class="form-control" id="duedate"><?php echo date('d-m-Y', strtotime($task['duedate']));?></p>
                </div>
                <div class="form-group ">
                    <label for="course">Course</label>
                    <input type="text" class="form-control" id="course" readonly value="<?php echo $task['course']?>">
                </div>
                <div class="form-group ">
                    <label for="priority">Priority</label>
                    <input type="text" class="form-control" id="priority" readonly value="<?php echo $task['priority']?>">
                </div>
                <div class="form-group ">
                    <label for="status">Status</label>
                    <?php if($task['done']): ?>
                        <input type="text" class="form-control" id="status" readonly value="Finished">
                    <?php elseif(!$task['done']): ?>
                        <input type="text" class="form-control" id="status" readonly value="Still has to be done">
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="adddate">Task was made on</label>
                    <p class="form-control" id="adddate"><?php echo date('d-m-Y H:i:s', strtotime($task['adddate']));?></p>
                </div>
                <div class="form-group">
                    <label for="moddate">Lastest modification was on</label>
                    <p class="form-control" id="moddate"><?php echo date('d-m-Y H:i:s', strtotime($task['moddate']));?></p>
                </div>
                <div class="mt-4 ">
                    <form class="float-right" action="editTask.php" method="POST">
                        <input type="hidden" name="taskId" value="<?php echo $task['id']; ?>" />
                        <button class="btn btn-danger my-sm-2 " name="btn">Edit Task</button>
                    </form>
                    <form class="float-right mr-3" action="" method="POST">
                        <input type="hidden" name="taskId" value="<?php echo $task['id']; ?>" />
                        <button class="btn btn-danger my-sm-2 " name="btn">Delete</button>
                    </form>
                </div>
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