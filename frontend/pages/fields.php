<!DOCTYPE html>
<html lang="en">

<?php
include '../connect.php'
?>

<head>
  <title>ΕΛ.ΙΔ.Ε.Κ Top Combos</Main>
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">

  <?php include "../navbar.php"; ?>


  <br><br>
  <div class="container">
    <h4>Top Field Combos</h4>
  </div>

  <?php
  $conn = connectToDB();
  $query = "SELECT f1.name as field1name, f2.name as field2name, count
  FROM (SELECT pf1.FieldID as field1, pf2.FieldID as field2, count(*) as count
  			FROM Project_Field as pf1 INNER JOIN Project_Field as pf2 on pf1.ProjectID = pf2.ProjectID
  			WHERE pf1.FieldID < pf2.FieldID
  			GROUP BY pf1.FieldID, pf2.FieldID) as Query
  INNER JOIN Field as f1 on f1.ID = field1 INNER JOIN Field as f2 on f2.ID = field2
  ORDER BY count DESC limit 3";
  $response = mysqli_query($conn, $query);

  echo '<table class="table table-hover">
<thead class = "table-primary">
<tr>
<th scope="col">Field 1 Name</th>
<th scope="col">Field 2 Name</th>
<th scope="col">No of Projects</th>
</tr>
</thead>
<tbody>';

foreach ($response as $key => $row) {
echo     '<tr>
<td>' . $row["field1name"] . '</td>
<td>' . $row["field2name"] . '</td>
<td>' . $row["count"] . '</td>
</tr>';
}
echo '</tbody> </table> </div>';

  ?>
</body>


<?php include "../footer.php"; ?>


</html>
