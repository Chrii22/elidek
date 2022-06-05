<!DOCTYPE html>
<html lang="en">

<?php
include '../connect.php'
?>

<head>
    <title>ΕΛ.ΙΔ.Ε.Κ views</Main>
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
        <h4>Views</h4>
    </div>
    <div class="container-fluid  card d-flex justify-content-center">
        <div class="card-header d-flex justify-content-center">
            Projects Per Researcher:
        </div>
        <?php
        $conn = connectToDB();
        $query1 = "SELECT * FROM project_per_researcher";
        $projectsPerResearcher = mysqli_query($conn, $query1);

        echo '    <div class="card-body d-flex justify-content-center ">
        <table class="table table-hover">
        <thead class = "table-primary">
        <tr>
        <th scope="col"> ID </th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Project Title</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($projectsPerResearcher as $key => $row) {
            echo     '<tr>
            <td>' . $row["ResearcherSIN"] . '</td>
            <td>' . $row["firstName"] . '</td>
            <td>' . $row["lastName"] . '</td>
            <td>' . $row["title"] . '</td>
            </tr>';
        }
        echo '</tbody> </table> </div>';
        ?>
        <br><br>
        <div class="card-header d-flex justify-content-center">
            Projects Per Organization:
        </div>
        <?php
        $query1 = "SELECT * FROM project_per_organization";
        $projectsPerOrg = mysqli_query($conn, $query1);

        if ($projectsPerOrg === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        echo '    <div class="card-body d-flex justify-content-center ">
        <table class="table table-hover">
        <thead class = "table-primary">
        <tr>
        <th scope="col"> Organization </th>
        <th scope="col">No of Projects</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($projectsPerOrg as $key => $row) {
            echo     '<tr>
            <td>' . $row["name"] . '</td>
            <td>' . $row["count"] . '</td>
            </tr>';
        }
        echo '</tbody> </table> </div>';
        ?>
        <br><br>
        <div class="card-header d-flex justify-content-center">
            Organizations with same number of projects in the last 2 years:
        </div>
        <?php
        $query1 = "SELECT DISTINCT org2.name, org1.count_projects
        FROM (SELECT OrganizationID, count(OrganizationID) as count_projects, Organization.name
                FROM Project INNER JOIN Organization on Project.OrganizationID = Organization.ID
                WHERE TIMESTAMPDIFF(YEAR, Project.startDate, current_timestamp) <= 2
                    GROUP BY OrganizationID
                    having count_projects > 0 ) as org1 INNER JOIN
        (SELECT OrganizationID, count(OrganizationID) as count_projects, Organization.name
                FROM Project INNER JOIN Organization on Project.OrganizationID = Organization.ID
                WHERE TIMESTAMPDIFF(YEAR, Project.startDate, current_timestamp) <= 2
                    GROUP BY OrganizationID
                    having count_projects > 0 ) as org2
        						on org1.count_projects = org2.count_projects
        WHERE org1.OrganizationID < org2.OrganizationID
        ORDER BY org1.count_projects DESC";
        $organizations = mysqli_query($conn, $query1);

        if ($organizations === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        echo '    <div class="card-body d-flex justify-content-center ">
        <table class="table table-hover">
        <thead class = "table-primary">
        <tr>
        <th scope="col"> Organization </th>
        <th scope="col">No of Projects</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($organizations as $key => $row) {
            echo     '<tr>
            <td>' . $row["name"] . '</td>
            <td>' . $row["count_projects"] . '</td>
            </tr>';
        }
        echo '</tbody> </table> </div>';
        ?>
        </div>


        <div class="card-header d-flex justify-content-center">
            Available Programmes:
        </div>
        <?php
        $query1 = "SELECT *
        FROM Programme
        WHERE ID not in (SELECT ProgrammeID FROM Project)";
        $programmes = mysqli_query($conn, $query1);

        if ($programmes === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        echo '    <div class="card-body d-flex justify-content-center ">
        <table class="table table-hover">
        <thead class = "table-primary">
        <tr>
        <th scope="col"> Name </th>
        <th scope="col">Department</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($programmes as $key => $row) {
            echo     '<tr>
            <td>' . $row["name"] . '</td>
            <td>' . $row["department"] . '</td>
            </tr>';
        }
        echo '</tbody> </table> </div>';
        ?>
        </div>

</body>


<?php include "../footer.php"; ?>


</html>
