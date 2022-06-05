<!DOCTYPE html>
<html lang="en">

<?php
include '../connect.php'
?>

<head>
  <title>ΕΛ.ΙΔ.Ε.Κ Hot Topics</Main>
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100">

  <?php include "../navbar.php"; ?>
  <br>
  <div class="container">
    <h4>Hot Topic</h4>
    <p>Type a topic and see the researchers that have worked on project regarding this topic in the last year.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
      <div class="row">
        <div class="col-sm">
          <div class="mb-3">
            <label for="topic" class="form-label">Choose a topic:</label>
            <input type="text" class="form-control" id="topic" name="topic">
          </div>
        </div>
      </div>
      <div class="container d-flex justify-content-center">
        <button class="btn btn-primary" type="submit">Select</button>
      </div>
    </form>
  </div>
 <br>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == 'GET') {

    $conn = connectToDB();
    $topic = $_GET["topic"] ?? "";



    $query1 = "SELECT Researcher.SIN, Researcher.firstName, Researcher.lastName, Query1.title
            FROM Works_on INNER JOIN  (SELECT ProjectID, title
    							FROM Project_Field INNER JOIN Project ON Project_Field.ProjectID = Project.ID INNER JOIN Field ON Project_Field.FieldID = Field.ID
    							WHERE Field.name = ('$topic') and current_timestamp between Project.startDate and Project.endDate )
    				as Query1 ON Works_on.ProjectID = Query1.ProjectID
    				INNER JOIN Researcher ON Works_on.ResearcherSIN = Researcher.SIN
    WHERE TIMESTAMPDIFF(YEAR, Works_on.startDate, CURDATE()) <= 1
    ORDER BY Researcher.SIN";

    $researchers = mysqli_query($conn, $query1);
      if ($topic != ""){
        echo '<div class="container-fluid  card d-flex justify-content-center">
              <div class="card-header d-flex justify-content-center">
                  '. $topic .' Researchers:
              </div>';


          echo '<table class="table table-hover">
    <thead class = "table-primary">
    <tr>
    <th scope="col"> SIN </th>
    <th scope="col"> First Name </th>
    <th scope="col">Last Name</th>
    <th scope="col">Project Title</th>
    </tr>
    </thead>
    <tbody>';
    }
    foreach ($researchers as $key => $row) {
        echo     '<tr>
        <td>' . $row["SIN"] . '</td>
        <td>' . $row["firstName"] . '</td>
        <td>' . $row["lastName"] . '</td>
        <td>' . $row["title"] . '</td>
        </tr>';
    }
    echo '</tbody> </table> </div>';
}
          ?>
</body>


<?php include "../footer.php"; ?>


</html>
