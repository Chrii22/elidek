<!DOCTYPE html>
<html lang="en">

<head>
  <title>ΕΛ.ΙΔ.Ε.Κ Main Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        ΕΛ.ΙΔ.Ε.Κ
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent2">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="pages/statistics.php">Statistics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/views.php">Views</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Charts
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
              <li><a class="dropdown-item" href="pages/topics.php">Hot Topics</a></li>
              <li><a class="dropdown-item" href="pages/fields.php">Top Combos</a></li>
              <li><a class="dropdown-item" href="pages/researchers.php">Top Researchers</a></li>
              <li><a class="dropdown-item" href="pages/executives.php">Top Executives</a></li>
              <li><a class="dropdown-item" href="pages/oneAndDone.php">One and Done</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>



  <br><br>
  <div class="container">
    <h4>Welcome to ELIDEK's Web Application</h4>
    <br><br>
    <h4>About</h4>
    <p>Project by team 22. Members: <br>
      • Christina Kostaki <br>
      • Dimitris Matsis <br>
      • Giorgos Kaoukis</p>
  </div>

</body>

<?php include "footer.php"; ?>

</html>
