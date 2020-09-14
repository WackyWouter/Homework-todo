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
    $task = [];
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['taskId']) ){
            $task = Get::getTask($_SESSION['id'], $_POST['taskId']);
        }
        else if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['comments']) && isset($_POST['duedate']) && isset($_POST['course']) && isset($_POST['priority'])){
            Edit::editHomework($_SESSION['id'], $_POST['id'], $_POST['name'], $_POST['description'], $_POST['comments'], $_POST['duedate'], $_POST['course'], $_POST['priority']);
            header('location: home.php');
        }
        else{
            header('Location: error.php');
        }
    }
    $categories = Get::getCategories($_SESSION['id']);
    if(!isset($categories)){
       die("no categories found");
       // TODO error logging
    }
    $priorities = ['low', 'medium', 'high'];
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

    <title>Edit Task</title>
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
                        <a class="nav-link dropdown-toggle whiteText" href="#" id="navbarDropdown" role="button"
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
            <div class="col-lg-8 greyBg mt-5 p-4 whiteText">
                <form action="" method="POST" class="mt-4">
                    <h5><?php echo $task['name'] ?></h5>
                    <div class="form-row mt-4">
                        <div class="form-group col-md-9">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" maxlength="50" name="name" id="name" value="<?php echo $task['name']?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="duedate">Duedate</label>
                            <input type="date" class="form-control" name="duedate" id="duedate" value="<?php echo date('Y-m-d', strtotime($task['duedate']));?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control textAreaMedium" name="description" id="description" ><?php echo $task['description']?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select  class="form-control" name="category" id="category" class="form-control">
                            <?php foreach($categories as $category): ?>
                                <?php if($task['category_id'] === $category['id']): ?>
                                    <option selected value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-9 ">
                            <label for="course">Course</label>
                            <input type="text" class="form-control" name="course" id="course" value="<?php echo $task['course']?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="priority">Priority</label>
                            <select  class="form-control" name="priority" id="priority" class="form-control">
                                <?php foreach($priorities as $priority): ?>
                                    <?php if($task['priority'] === $priority): ?>
                                        <option selected value="<?php echo $priority ?>"><?php echo $priority ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $priority ?>"><?php echo $priority ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="comments">Comments</label>
                        <textarea class="form-control textAreaMedium" name="comments" id="comments" ><?php echo $task['comments']?></textarea>
                    </div>

                    <div class="mt-4 ">
                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>" />
                        <button class="btn btn-danger mt-2 float-right" name="editTask" type="submit">Save</button>
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