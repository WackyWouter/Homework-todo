<?php
require '../database/get.php';
require '../database/delete.php';

session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.html');
  exit;
}


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['delete_id'])){
      Delete::deleteCategory($_POST['delete_id'], $_SESSION['id']);
    }
}

$categories = Get::getCategories($_SESSION['id']);
foreach ($categories as &$category){
    $category['done'] = Get::getTaskAmountByCat($_SESSION['id'], $category['id'], 'done');
    $category['todo'] = Get::getTaskAmountByCat($_SESSION['id'], $category['id'], 'todo');
}
$currentDate = date('l d-m-Y');

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/iconR.png">
    <title>Category List</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">

    <title>Homework TODO</title>
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
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link whiteText" href="categoryList.php">Categories<span
                                class="sr-only">(current)</span></a>
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
            <div class="col-md-10 greyBg mt-5 p-4 whiteText overflow">
                <table class="table table-dark greyBg table-borderless table-hover mb-2">
                    <thead>
                        <tr>
                            <th scope="col" class="pl-3">Name</th>
                            <th scope="col">Todo tasks</th>
                            <th scope="col">Done Tasks</th>
                            <th scope="col">Adddate</th>
                            <th scope="col">Moddate</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($categories) != 0): ?>
                        <?php foreach($categories as $cat): ?>
                        <tr>
                            <td class="pl-3 align-middle"><a href="editCategory.php?id=<?= $cat['id'] ?>"><?php echo $cat['name']; ?></a></td>
                            <td class="align-middle"><?php echo $cat['todo']; ?></td>
                            <td class="align-middle"><?php echo $cat['done']; ?></td>
                            <td class="align-middle"><?php echo $cat['adddate']; ?></td>
                            <td class="align-middle"><?php echo $cat['moddate']; ?></td>
                            <td class="align-middle">
                                <form action="categoryList.php" method="post">
                                    <input type="hidden" name="delete_id" value="<?php echo $cat['id']; ?>" />
                                    <input class="btn btn-outline-danger" type="submit" name="delete" value="Delete" />
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?> 
                    </tbody>
                </table>
                <form class="float-right" action="newCategory.php" method="get">
                    <button class="btn btn-danger my-sm-2 ">New Category</button>
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