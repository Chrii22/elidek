<!DOCTYPE html>
<html lang="en">
<?php
include '../connect.php'
?>

<head>
  <title>ΕΛ.ΙΔ.Ε.Κ Top Executives</Main>
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
    <h4>Top 5 hard-financing Executives</h4>
    <br>
  </div>


  <?php
    $query = "SELECT Executive.firstName, Executive.lastName, Organization.name as Company, sum(amount) as total_amount
    FROM Project INNER JOIN Executive ON Project.ExecutiveSIN = Executive.SIN
    INNER JOIN Organization ON Project.OrganizationID = Organization.ID
    WHERE Organization.or_type = 'Company'
    GROUP BY Executive.SIN
    ORDER BY sum(amount) DESC limit 5";
    $conn = connectToDB();
    $executives = mysqli_query($conn, $query);

        echo '<table class="table table-hover">
    <thead class = "table-primary">
    <tr>
    <th scope="col">First Name</th>
    <th scope="col">Last Name</th>
    <th scope="col">Company</th>
    <th scope="col">Amount</th>
    </tr>
    </thead>
    <tbody>';

    foreach ($executives as $key => $row) {
      echo     '<tr>
      <td>' . $row["firstName"] . '</td>
      <td>' . $row["lastName"] . '</td>
      <td>' . $row["Company"] . '</td>
      <td>' . $row["total_amount"] . '€</td>
      </tr>';
    }
    echo '</tbody> </table> </div>';
  ?>


</body>


<?php include "../footer.php"; ?>


</html>
