<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Terps MSIS</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style.css">
    <?php 
        require('db_con.php');
    ?>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Terps MSIS</h3>
            </div>

            <ul class="list-unstyled components">
                <p></p>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="alumni.php">Alumni</a>
                </li>
                <li class="active">
                    <a href="company.php">Company</a>
                </li>
                <li>
                    <a href="skills.php">Skills</a>
                </li>
                <li>
                    <a href="metrics.php">Important Hiring Metrics</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <form method="POST">
                        <div class="form-group">
                            <label>Type of Job</label>
                            <span style="display: inline-block">
                                <select class="form-control" name="type">
                                    <?php 
                                        $query = "SELECT DISTINCT type FROM hires ORDER BY type";
                                        $res = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo "<option>".$row['type']."</option>";
                                            
                                        }
                                    ?>
                                </select>
                            </span>
                            <label>Company Name</label>
                            <span style="display: inline-block;">
                                <select class="form-control" name="company">                   
                                 <?php 
                                        $query = "SELECT companyName from company ORDER BY companyName";
                                        $res = mysqli_query($conn, $query);
                                        while($row = mysqli_fetch_assoc($res)) {
                                            echo "<option>".$row['companyName']."</option>";
                                        }
                                    ?>

                                </select>
                                
                            </span>
                            <span style="display: inline-block;">
                                <input type="submit" name="Submit" value="Submit" class="btn btn-success">
                            </span>
                        </div>
                    </form>
                </div>
            </nav>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <form method="POST">
                        <div class="form-group row">
                            <label class="col-sm-4">Average Salary for </label>
                            <span style="display: inline-block" class="col">
                                <select class="form-control" name="company1">
                                    <option value="all">All Companies</option>
                                    <?php 
                                        $query = "SELECT companyName from company ORDER BY companyName";
                                        $res = mysqli_query($conn, $query);
                                        while($row = mysqli_fetch_assoc($res)) {
                                            echo "<option>".$row['companyName']."</option>";
                                        }    
                                    ?>
                                </select>
                                
                            </span>
                            <span style="display: inline-block;" class="col">
                                <input type="submit" name="submit4" value="Submit" class="btn btn-success">
                            </span>
                        </div>
                    </form>
                </div>
            </nav>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <form method="POST">
                        <div class="form-group row">
                            <label class="col-sm-4">Job details based on Industry</label>
                            <span style="display: inline-block" class="col col-md-4">
                                <select class="form-control" name="industry">
                                    <?php 
                                        $query = "SELECT DISTINCT industry FROM company ORDER BY industry";
                                        $res = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo "<option>".$row['industry']."</option>";
                                            
                                        }
                                    ?>
                                </select>
                                
                            </span>
                            <span style="display: inline-block;" class="col">
                                <input type="submit" name="submit2" value="Submit" class="btn btn-success">
                            </span>
                        </div>
                    </form>
                </div>
            </nav>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <form method="POST">
                        <div class="form-group row">
                            <label class="col-sm-4">Alumni Hired by Industry</label>
                            <span style="display: inline-block" class="col col-md-4">
                                <select class="form-control" name="industry">
                                    <?php 
                                        $query = "SELECT DISTINCT industry FROM company ORDER BY industry";
                                        $res = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo "<option>".$row['industry']."</option>";
                                            
                                        }
                                    ?>
                                </select>
                                
                            </span>
                            <span style="display: inline-block;" class="col">
                                <input type="submit" name="submit3" value="Submit" class="btn btn-success">
                            </span>
                        </div>
                    </form>
                </div>
            </nav>

            <h2></h2>
            
            
            <div class="line"></div>
            <div>
                <?php 
                    if(isset($_POST['Submit'])) {
                        $type = $_POST['type'];
                        $company = $_POST['company'];
                        $query = "SELECT alumniFName, alumniLName, companyName, title, linkedinURL, workStartDate, workEndDate, type FROM alumni AS a, hires AS b, company AS c 
                        WHERE a.alumniID = b.alumniID AND c.companyID = b.companyID AND c.companyName='".$company."' AND b.type LIKE '".$type."'";
                        $res = mysqli_query($conn, $query);
                        if(mysqli_num_rows($res) > 0) {
                            echo "<p> Alumni Details by Job Type : ".$type." and Company : ".$company."</p>";
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr>";
                                    echo "<th scope='col'>First <br>Name</th>";
                                    echo "<th scope='col'>Last <br>Name</th>";
                                    echo "<th scope='col'>Type</th>";
                                    echo "<th scope='col'>Company <br>Name</th>";
                                    echo "<th scope='col'>Title</th>";
                                    echo "<th scope='col'>Linkedin <br>Profile</th>";
                                    echo "<th scope='col'>Start <br>Date</th>";
                                    echo "<th scope='col'>End <br>Date</th>";
                            echo "</tr></thead><tbody>";
                            while($row = mysqli_fetch_assoc($res)) {
                                if(is_null($row['workEndDate'])) {
                                    $temp = "Currently working here";
                                    echo "<th scope='row'>".$row['alumniFName']."</th><td>".$row['alumniLName']."</td><td>".$row['type']."</td><td>".$row['companyName']."</td><td>".$row['title']."</td><td>".$row['linkedinURL']."</td><td>".$row['workStartDate']."</td><td>".$temp."</td>";
                                }
                                if(!is_null($row['workEndDate'])) {
                                            echo "<th scope='row'>".$row['alumniFName']."</th><td>".$row['alumniLName']."</td><td>".$row['companyName']."</td><td>".$row['type']."</td><td>".$row['linkedinURL']."</td><td>".$row['workStartDate']."</td><td>".$row['workEndDate']."</td>";
                                }
                                echo "</tr>";
                            
                            }
                            echo "</tbody></table>";
                        }
                        else {
                            echo "<div class='alert alert-danger'>The data you requested is not available.</div>";
                        }
                        
                    }

                    if(isset($_POST['submit2'])) {
                        $industry = $_POST['industry'];
                        $query2 = "SELECT C.industry, C.companyName, H.title, H.salary, H.type, H.location FROM hires AS H
                        INNER JOIN company AS C ON H.companyID = C.companyID WHERE C.industry LIKE '".$industry."' ORDER BY C.industry";
                        $res2 = mysqli_query($conn, $query2);
                        echo "<p> Job Details by Industry Type : ".$industry."</p>";
                        echo "<table class='table table-striped'>";
                            echo "<thead><tr>";
                                    echo "<th scope='col'>Industry</th>";
                                    echo "<th scope='col'>Company Name</th>";
                                    echo "<th scope='col'>Title</th>";
                                    echo "<th scope='col'>Salary</th>";
                                    echo "<th scope='col'>Type</th>";
                                    echo "<th scope='col'>Location</th>";
                            echo "<tr></thead><tbody>";
                        while ($row = mysqli_fetch_assoc($res2)) {
                            echo "<tr>";
                            echo "<th scope='row'>".$row['industry']."</td><td>".$row['companyName']."</td><td>".$row['title']."</td><td>".
                            $row['salary']."</td><td>".$row['type']."</td><td>".$row['location']."</td>";
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                    }

                    if(isset($_POST['submit3'])) {
                        $industry = $_POST['industry'];
                        $query2 =   "SELECT  industry, COUNT(alumniID) as 'numAlumni'
                                    FROM hires INNER JOIN company ON
                                    hires.companyID = company.companyID AND company.industry='".$industry."'";
                        $res2 = mysqli_query($conn, $query2);
                        if(mysqli_num_rows($res2) > 0) {
                            echo "<p> Number of Alumni hired by Industry Type : ".$industry."</p>";
                            echo "<table class='table table-striped'>";
                            echo "<thead><tr>";
                            echo "<th scope='col'>Industry</th>";
                            echo "<th scope='col'>Number of Alumni</th>";
                            echo "<tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($res2)) {
                                echo "<tr>";
                                echo "<th scope='row'>".$row['industry']."</td><td>".$row['numAlumni']."</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        }
                        else {
                            echo "<h4>No data exists!</h4>";
                        }
                    }

                    if(isset($_POST['submit4'])) {
                        $cmp = $_POST['company1'];
                        if($cmp == "all") {
                            $query = "SELECT c.companyName, h.location, ROUND(AVG(h.salary),2) AS 'Average Salary'
                                FROM alumni AS a, company AS c, hires AS h
                                WHERE a.alumniID = h.alumniID
                                AND h.companyID = c.companyID
                                GROUP BY c.companyName, h.location
                                ORDER BY AVG(h.salary) DESC";
                            $res = mysqli_query($conn, $query);
                            if(mysqli_num_rows($res) > 0) {
                                echo "<p> Average Salary by Company : ".$cmp."</p>";
                                echo "<table class='table table-striped'>";
                                echo "<thead><tr>";
                                        echo "<th scope='col'>Company Name</th>";
                                        echo "<th scope='col'>Location</th>";
                                        echo "<th scope='col'>Average Salary (in USD)</th>";
                                echo "<tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "<tr>";
                                echo "<th scope='row'>".$row['companyName']."</th><td>".$row['location']."</td><td>".$row['Average Salary']."</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                            }
                            else {
                            echo "<h4>No data exists!</h4>";
                            }
                        }
                        else {
                            $query = "SELECT c.companyName, h.location, ROUND(AVG(h.salary),2) AS 'Average Salary'
                                FROM alumni AS a, company AS c, hires AS h
                                WHERE a.alumniID = h.alumniID
                                AND h.companyID = c.companyID
                                AND c.companyName = '".$cmp."'
                                 GROUP BY c.companyName, h.location
                                ORDER BY AVG(h.salary) DESC";
                            $res = mysqli_query($conn, $query);
                            if(mysqli_num_rows($res) > 0) {
                                echo "<p> Average Salary by Company : ".$cmp."</p>";
                                echo "<table class='table table-striped'>";
                                echo "<thead><tr>";
                                        echo "<th scope='col'>Company Name</th>";
                                        echo "<th scope='col'>Location</th>";
                                        echo "<th scope='col'>Average Salary (in USD)</th>";
                                echo "<tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "<tr>";
                                echo "<th scope='row'>".$row['companyName']."</th><td>".$row['location']."</td><td>".$row['Average Salary']."</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                            }
                            else {
                            echo "<h4>No data exists!</h4>";
                            }    
                        }
                    }
                ?>
            </div>
                                
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>