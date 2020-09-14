<?php
    require '../database/create.php';
    require '../database/get.php';

    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.html');
        exit;
    }

    $error = '';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $error = "Not filled in: ";
        if(!isset($_POST['name']) || !isset($_POST['duedate']) || !isset($_POST['category']) ||  !isset($_POST['priority'])){
            $error = "At least on of the required fields is not filled in!";
        }else{
            if(Create::addHomework($_SESSION['id'], $_POST['category'], $_POST['name'], $_POST['description'], $_POST['comments'], $_POST['duedate'], $_POST['course'], $_POST['priority'])){
                header('Location: home.php');
            }else{
                header('Location: error.php?error=Unable to create new task.');
            }
        }
    }

    $categories = Get::getCategories($_SESSION['id']);
    if(!isset($categories)){
        header('Location: error.php?error=Unable to retrieve categories.');
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

    <title>New Task</title>
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
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categoryList.php">Categories</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link whiteText" href="newTask.php">New Task<span
                                class="sr-only">(current)</span></a>
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
                <h5>New Task</h5>
                <form action="" method="POST" class="mt-4">

                    <div class="form-row mt-4">
                        <div class="form-group col-md-9">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" maxlength="50" name="name" id="name" required placeholder="Name">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="duedate">Duedate</label>
                            <input type="date" required class="form-control" name="duedate" id="duedate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control textAreaMedium" name="description" id="description" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select required name="category" required id="category" class="form-control">
                            <!-- generate with categories from DB -->
                            <?php foreach($categories as $category): ?>
                            <option value="<?php echo $category['id'];?>">
                                <?php echo $category['name'];?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-9 ">
                            <label for="course">Course</label>
                            <input type="text" class="form-control" name="course" id="course" placeholder="IPMEDTH">
                        </div>
                        <div class="form-group col-md-3">
                            <!-- priority / enum -->
                            <label for="priority">Priority</label>
                            <select required name="priority" required id="priority" class="form-control">
                                <option value="low">LOW</option>
                                <option value="medium">MEDIUM</option>
                                <option value="high">HIGH</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="comments">Comments</label>
                        <textarea class="form-control textAreaMedium" name="comments" id="comments" placeholder="Comments..."></textarea>
                    </div>
                    <?php echo "<p class='neonRed'>$error</p>"; ?>
                    <button class="btn btn-danger mt-2 float-right" type="submit">Submit Task</button>
                </form>
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