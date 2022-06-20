<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="bootstrap.css">
    <style media="screen">
      .pagenumber {
        background-color: #dee2e6;
        margin-right: 10px;
        margin-left: 10px;
        padding: 5px;
        color: black;
        border-radius: 5px;
        box-shadow: 2px 2px 2px black;
      }

      a:hover {
        color: #fdfcfa;
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <?php
    // connect to database

    $mysqli = new mysqli('localhost','andreaj2_test2','MerryMango315!!','andreaj2_test2');

    //how many records per page
    $rpp = 10;

    // checks for set page

    isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;

    // checks for page 1

    if($page > 1){
      $start = ($page * $rpp) - $rpp;
    } else {
      $start = 0;
    }

    //Query db for TOTAL Records
    $resultSet = $mysqli->query("SELECT id FROM users");

    //Get total records
    $numRows = $resultSet->num_rows;

    //Get total number of pages
    $totalPages = $numRows / $rpp;

    // Query results
    $resultSet = $mysqli->query("SELECT * FROM users LIMIT $start,$rpp");

    // Start creating table
    echo "<table class='table table-striped'>";

    echo "<tr><td>User ID</td><td>User Real Name</td><td>Username</td></tr>";

    while($rows = $resultSet->fetch_assoc()){
      $id = $rows['id'];
      $realname = $rows['realname'];
      $username = $rows['username'];

      echo "<tr><td>$id.</td><td>$realname</td><td>$username</td></tr>";
    }

    echo "</table><br />";

    for($x = 1; $x <= $totalPages + 1; $x++){
      echo "<a href='?page=$x' class='pagenumber'>$x</a>";
    }
    ?>

  </body>
</html>
