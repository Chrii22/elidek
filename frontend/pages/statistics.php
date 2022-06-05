<!DOCTYPE html>
<html lang="en">

<?php
include '../connect.php'
?>

<head>
  <title>ΕΛ.ΙΔ.Ε.Κ Statistics
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
  <div class="container-md">
    <h4>ELIDEK Statistics</h4>
    <br>
    <p>Fill out the options below to view various programmes' statistics</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div class="row">
        <div class="col-sm">
          <div class="form-group date" name = "startDate" style = "padding-top:5px;">
            <label class="label">Project Start Date</label>
            <input type="date" class = "form-control" name = "startDate" id="startDate">
          </div>
          <div class="form-group date" name = "endDate" style = "padding-top:5px;">
            <label class="label">Project End Date</label>
            <input type="date" class = "form-control" name = "endDate" id="endDate">
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-sm">
          <label class="label">Select Duration (in months):</label>
          <input type="text" class = "form-control" name = "duration" id ="duration">
        </div>
      </div>
      <div class="row">
        <div class="col-sm">
          <label class="label">Select Executive (SIN)</label>
          <input type="text" class = "form-control" name = "executive" id ="executive">
        </div>
      </div>
      <br>
      <div class="container d-flex justify-content-center">
        <button class="btn btn-primary" type="submit">Select</button>
      </div>
    </form>
  </div>
  </div>
  <?php


  if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $conn = connectToDB();
    $executive = $_POST['executive'] ?? "";
    $duration = $_POST['duration'] ?? "";
    $startDate = $_POST['startDate'] ?? "";
    $endDate = $_POST['endDate'] ?? "";


    // if ($endDate != "" and $startDate == ""){
    //   echo "Please input both star and end Dates";
    // }
    $flag = 0;
    switch(true)
    {
      //executive, duration, (startDate, endDate)
    case($executive != "" and $duration =="" and ($startDate == "" and $endDate == "")):
      $query = "SELECT Researcher.firstName, Researcher.lastName, Project.title
      FROM Project INNER JOIN Executive ON Project.ExecutiveSIN = Executive.SIN
      						 INNER JOIN Works_on on Works_on.ProjectID = Project.ID
      						 INNER JOIN Researcher on Researcher.SIN = Works_on.ResearcherSIN
      WHERE Project.ExecutiveSIN = '$executive'";
      $flag = 1;
      break;
    case($executive == "" and $duration !="" and ($startDate == "" and $endDate == "")):
    $query = "SELECT Researcher.firstName, Researcher.lastName, Project.title
    FROM Project INNER JOIN Works_on on Works_on.ProjectID = Project.ID
    						 INNER JOIN Researcher on Researcher.SIN = Works_on.ResearcherSIN
    WHERE duration = '$duration'";
      $flag = 1;
      break;
    case($executive == "" and $duration =="" and ($startDate != "" and $endDate != "")):
      $query = "SELECT Researcher.firstName, Researcher.lastName, Project.title
      FROM Project INNER JOIN Works_on on Works_on.ProjectID = Project.ID
      						 INNER JOIN Researcher on Researcher.SIN = Works_on.ResearcherSIN
      WHERE Project.startDate > '$startDate' and Project.endDate < '$endDate'";
      $flag = 1;
      break;
    }

    if ($flag){
  $sql_response = mysqli_query($conn, $query);

    echo '<div class="card-header d-flex justify-content-center">
        Researchers working on the projects:
    </div>';
    echo '<table class="table table-hover">
  <thead class = "table-primary">
  <tr>
  <th scope="col">First Name</th>
  <th scope="col">Last Name</th>
  <th scope="col">Project Title</th>
  </tr>
  </thead>
  <tbody>';

  foreach ($sql_response as $key => $row) {
  echo     '<tr>
  <td>' . $row["firstName"] . '</td>
  <td>' . $row["lastName"] . '</td>
  <td>' . $row["title"] . '</td>
  </tr>';
  }
  echo '</tbody> </table> </div>';
  }
  else {
    echo '<div class="card-header d-flex justify-content-center">
        Wrong Input!
    </div>';
  }
}


  ?>
</body>

<?php include "../footer.php"; ?>

</html>
