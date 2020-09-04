<?php
  require '../database/get.php';
  require '../database/edit.php'; 

  session_start();
  if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
  }

  $categories = Get::getCategories($_SESSION['id']);
  if(!isset($categories)){
     die("no categories found");
     // TODO error logging
  }
  $chosenCategory = $categories[0]['id'];

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['chosenCategory'])){
        $chosenCategory = $_POST['chosenCategory'];
    }
    else{
        $error = "Not filled in: ";
        if(!isset($_POST['name']) ){
        // TODO check the filled stuff
        }else{
            if(Create::addHomework($_SESSION['id'], $_POST['category'], $_POST['name'], $_POST['description'], $_POST['duedate'], $_POST['course'], $_POST['priority'])){
                header('Location: home.php');
            }else{
                echo "failed";
                // TODO error logging
            }
        }
	}
	
	if(isset($_POST['done'])){
		if(isset($_POST['id'])){
			Edit::doneHomework($_POST['id']);
		}
	}
	if(isset($_POST['undone'])){
		if(isset($_POST['id'])){
			Edit::doneHomework($_POST['id'], 0);
		}
	}
    
}

$todoTasks = Get::getHomework($_SESSION['id'],$chosenCategory, 0);
if(!isset($todoTasks)){
    die("no categories found");
    // TODO error logging
}

$doneTasks = Get::getHomework($_SESSION['id'],$chosenCategory, 1);
if(!isset($doneTasks)){
    die("no categories found");
    // TODO error logging
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
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">

    <title>Homework TODO</title>
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
                        <a class="nav-link whiteText" href="#">Overview <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categoryList.php">Categories</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
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
                <form action="database/logout.php" class="form-inline">
                    <button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
                </form>
            </div>
        </nav>
    </div>

    <div class="container-fluid mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <form action="" method="POST">
                    <?php foreach($categories as $category): ?>
                    <?php if($chosenCategory == $category['id']) : ?>
                    <button class="btn btn-secondary my-2 my-sm-2" name="chosenCategory"
                        value="<?php echo  $category['id']?>"><?php echo $category['name']?></button>
                    <?php else : ?>
                    <button class="btn btn-danger my-2 my-sm-2" name="chosenCategory"
                        value="<?php echo  $category['id']?>"><?php echo $category['name']?></button>
                    <?php endif; ?>

                    <?php endforeach; ?>
                </form>

            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-10 greyBg">

                <div class="row justify-content-between pt-3 pb-2 pr-2 pl-2">
                    <div class="col-4 neonRed font-weight-bold fontSizeM">
                        <h5>TODO</h5>
                    </div>
                    <div class="col-4 whiteText text-right fontSizeM">
                        <?php echo $currentDate ?>
                    </div>
                </div>

                <hr />

                <div class="row justify-content-center">
                    <div class="col-md-12 pb-2 pl-2 pr-2 overflow">
                        <table class="table table-dark greyBg table-borderless table-hover mb-2">
                            <thead>
                                <tr>
                                    <th scope="col" class="pl-3">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Duedate</th>
                                    <th scope="col">Days left</th>
                                    <th scope="col">Done</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($todoTasks) != 0): ?>
                                <?php foreach($todoTasks as $task): ?>
                                <tr>
                                    <td class="pl-3 align-middle"><?php echo $task['name']; ?></td>
                                    <td class="align-middle table-desc"><?php echo $task['description']; ?></td>
                                    <td class="align-middle"><?php echo $task['course']; ?></td>
                                    <td class="align-middle"><?php echo $task['priority']; ?></td>
                                    <td class="align-middle"><?php echo $task['duedate']; ?></td>
                                    <td class="align-middle">
                                        <?php 
							$now = time(); // or your date as well
							$datediff =  strtotime($task['duedate']) - $now;

							$daysleft = round($datediff / (60 * 60 * 24)); 
							echo $daysleft +1;
						?>
                                    </td>

                                    <td class="align-middle">
                                        <form action="home.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $task['id']; ?>" />
                                            <input class="btn btn-danger" type="submit" name="done" value="done" />
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>


        <div class="row justify-content-center mt-4">
            <div class="col-md-10 greyBg">
                <div class="row justify-content-between pt-3 pb-2 pr-2 pl-2">
                    <div class="col-4 neonGreen font-weight-bold fontSizeM">
                        <h5>DONE</h5>
                    </div>
                </div>

                <hr id="greenTop" />

                <div class="row justify-content-center">
                    <div class="col-md-12 pb-2 pl-2 pr-2 overflow">
                        <table class="table table-dark greyBg table-borderless table-hover mb-2">
                            <thead>
                                <tr>
                                    <th scope="col" class="pl-3">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Duedate</th>
                                    <th scope="col">Finished</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($doneTasks) != 0): ?>
                                <?php foreach($doneTasks as $task): ?>
                                <tr>
                                    <td class="pl-3 align-middle"><?php echo $task['name']; ?></td>
                                    <td class="align-middle table-desc"><?php echo $task['description']; ?></td>
                                    <td class="align-middle"><?php echo $task['course']; ?></td>
                                    <td class="align-middle"><?php echo $task['priority']; ?></td>
                                    <td class="align-middle"><?php echo $task['duedate']; ?></td>
                                    <td class="align-middle">
                                        <form action="home.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $task['id']; ?>" />
                                            <input class="btn btn-danger" type="submit" name="undone" value="Undone" />
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
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