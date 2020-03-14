<?php
  // require 'configuration.php';
  // require 'database.php';
  // var_dump("server" . SERVERNAME);
  // var_dump(database::getCategories(2));

    $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $mydate = date('d-m-Y');
    $day = date('w');
    $currentDate = $daysOfWeek[$day] . ' ' . $mydate;
    $daysleft = 6;
    $amountDone = 2;

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom.css">

    <title>Homework TODO</title>
  </head>
  <body>
    <div class="container-fluid p-0">
      <nav class="navbar navbar-expand-lg navbar-dark greyBg justify-content-between">
        <a class="navbar-brand" href="index.php">Homework TODO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                <p id="currentDate" class="navbar-nav mr-4" style="color: rgba(255,255,255,.75)"><?php echo $currentDate ?></p>
          </div>
          <form class="form-inline">
            <button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
          </form>
        </div>      
      </nav>
    </div>

    <div class="container-fluid mt-4 mb-5">
      <div class="row justify-content-center">
        <div class="col-10">

          <div class="dropdown">
            <a class="dropdown-toggle btn btn-danger" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Category
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Category A</a>
              <a class="dropdown-item" href="#">Category B</a>
            </div>
          </div>

        </div>
      </div>

      <!-- TODO PARTS -->
      <div class="row justify-content-center mt-5">
        <div class="col-10">
          <h5 class="whiteText">TODO</h5>
        </div>
      </div>

      <div class="row justify-content-center mt-4">
        <div class="col-10 greyBg">
          
          <div class="row justify-content-between pt-3 pb-2 pr-2 pl-2">
            <div class="col-4 neonRed font-weight-bold fontSizeM" >
              Days left: <?php echo $daysleft ?>
            </div>
            <div class="col-4 whiteText text-right fontSizeM">
              <?php echo $currentDate ?>
            </div>
          </div>
          
          <hr/>

          <div class="row justify-content-center">
            <div class="col-12 pb-2 pl-2 pr-2">
              <table class="table table-dark greyBg table-borderless table-hover mb-2">
                <thead >
                  <tr>
                    <th scope="col" class="pl-3">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Course</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Done</th>
                  </tr>
                </thead>
                <tbody>
                  <tr >
                    <td class="pl-3 align-middle">Presenteren</td>
                    <td class="align-middle">Presentatie over logica</td>
                    <td class="align-middle">IKLO</td>
                    <td class="align-middle">LOW</td>
                    <td><div class="btn btn-danger">Done<div></td>
                  </tr>
                  <tr>
                    <td class="pl-3 align-middle">Presenteren</td>
                    <td class="align-middle">Presentatie over logica</td>
                    <td class="align-middle">IKLO</td>
                    <td class="align-middle">LOW</td>
                    <td><div class="btn btn-danger">Done<div></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>

      <div class="row justify-content-center mt-4">
        <div class="col-10 greyBg">
          
          <div class="row justify-content-between pt-3 pb-2 pr-2 pl-2">
            <div class="col-4 neonRed font-weight-bold fontSizeM" >
              Days left: <?php echo $daysleft ?>
            </div>
            <div class="col-4 whiteText text-right fontSizeM">
              <?php echo $currentDate ?>
            </div>
          </div>
          
          <hr/>
          
          <div class="row justify-content-center">
            <div class="col-12 pb-2 pl-2 pr-2">
              <table class="table table-dark greyBg table-borderless table-hover mb-2">
                <thead>
                  <tr>
                    <th scope="col" class="pl-3">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Course</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Done</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="pl-3 align-middle">Presenteren</td>
                    <td class="align-middle">Presentatie over logica</td>
                    <td class="align-middle">IKLO</td>
                    <td class="align-middle">LOW</td>
                    <td><div class="btn btn-danger">Done<div></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>

      <!-- DONE PARTS -->
      <div class="row justify-content-center mt-5">
        <div class="col-10">
          <h5 class="whiteText">DONE</h5>
        </div>
      </div>

      <div class="row justify-content-center mt-4">
        <div class="col-10 greyBg">
          <div class="row justify-content-between pt-3 pb-2 pr-2 pl-2">
            <div class="col-4 neonGreen font-weight-bold fontSizeM" >
              Amount done: <?php echo $amountDone ?>
            </div>
          </div>

          <hr id="greenTop"/>

          <div class="row justify-content-center">
            <div class="col-12 pb-2 pl-2 pr-2">
              <table class="table table-dark greyBg table-borderless table-hover mb-2">
                <thead >
                  <tr>
                    <th scope="col" class="pl-3">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Course</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Finished</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="pl-3 align-middle">Presenteren</td>
                    <td class="align-middle">Presentatie over logica</td>
                    <td class="align-middle">IKLO</td>
                    <td class="align-middle">LOW</td>
                    <td><?php echo $currentDate ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

