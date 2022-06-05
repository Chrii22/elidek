<!DOCTYPE html>
<html lang="en">
<?php
include '../connect.php'
?>

<head>
  <title>ΕΛ.ΙΔ.Ε.Κ One and Done</Main>
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100">

  <?php include "../navbar.php"; ?>


  <br><br>
  <div class="container">
    <h4>One and Done</h4>
  </div>


  <?php
    $query = "SELECT Researcher.firstName as FName,Researcher.lastName as LName, count(ProjectID) AS count
    FROM works_on INNER JOIN researcher ON works_on.ResearcherSIN = Researcher.SIN
    WHERE works_on.ProjectID NOT IN  (SELECT projectID FROM sub_project)
    GROUP BY researcher.SIN
    HAVING count(ProjectID) > 1
    ORDER BY count DESC";
    $conn = connectToDB();
    $executives = mysqli_query($conn, $query);

        echo '<table class="table table-hover">
    <thead class = "table-primary">
    <tr>
    <th scope="col">First Name</th>
    <th scope="col">Last Name</th>
    <th scope="col">No of Projects</th>
    </tr>
    </thead>
    <tbody>';

    foreach ($executives as $key => $row) {
      echo     '<tr>
      <td>' . $row["FName"] . '</td>
      <td>' . $row["LName"] . '</td>
      <td>' . $row["count"] . '</td>
      </tr>';
    }
    echo '</tbody> </table> </div>';
  ?>


</body>


<?php include "../footer.php"; ?>


</html>
